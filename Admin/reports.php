<?php
include_once './include/connection.php';
include("./include/navbar.php");

$from_date = "";
$to_date = "";
$report_type = "";
$chartDataAmount = [];
$chartDataCount = [];

if (isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['report_type'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $report_type = $_POST['report_type'];

    if ($report_type == 'all') {
        $sql = "SELECT booked_date, SUM(total_amount) as total, COUNT(*) as count FROM booked_flights WHERE DATE(booked_date) BETWEEN '$from_date' AND '$to_date' GROUP BY booked_date";
    } elseif ($report_type == 'paid') {
        $sql = "SELECT booked_date, SUM(total_amount) as total, COUNT(*) as count FROM booked_flights WHERE DATE(booked_date) BETWEEN '$from_date' AND '$to_date' AND payment_status = 1 GROUP BY booked_date";
    } elseif ($report_type == 'unpaid') {
        $sql = "SELECT booked_date, SUM(total_amount) as total, COUNT(*) as count FROM booked_flights WHERE DATE(booked_date) BETWEEN '$from_date' AND '$to_date' AND payment_status = 0 GROUP BY booked_date";
    }
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    } else {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $chartDataAmount[$row['booked_date']] = $row['total'];
                $chartDataCount[$row['booked_date']] = $row['count'];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 70px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <?php include_once './include/navbar.php'; ?> <!-- Include navbar -->
    <div class="container mt-5">
        <h2>Generate Report</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="report_type">Select Report Type:</label>
                <select class="form-control" id="report_type" name="report_type">
                    <option value="all" <?php if ($report_type == 'all') echo 'selected'; ?>>All Booked Flights</option>
                    <option value="paid" <?php if ($report_type == 'paid') echo 'selected'; ?>>Paid Booked Flights</option>
                    <option value="unpaid" <?php if ($report_type == 'unpaid') echo 'selected'; ?>>Unpaid Booked Flights</option>
                </select>
            </div>
            <div class="form-group">
                <label for="from_date">From Date:</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo $from_date; ?>" required>
            </div>
            <div class="form-group">
                <label for="to_date">To Date:</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo $to_date; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        // Get the chart data from PHP
        var chartDataAmount = <?php echo json_encode($chartDataAmount); ?>;
        var chartDataCount = <?php echo json_encode($chartDataCount); ?>;
        var labels = Object.keys(chartDataAmount);
        var dataAmount = Object.values(chartDataAmount);
        var dataCount = Object.values(chartDataCount);

        // Draw chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Amount',
                    data: dataAmount,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    yAxisID: 'y-axis-1',
                    fill: false
                }, {
                    label: 'Number of Flights',
                    data: dataCount,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    yAxisID: 'y-axis-2',
                    fill: false
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        type: 'linear',
                        display: true,
                        position: 'left',
                        id: 'y-axis-1',
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                        }
                    }, {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        id: 'y-axis-2',
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    </script>

</body>

</html>
