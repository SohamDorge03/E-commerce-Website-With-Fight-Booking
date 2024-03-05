<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24/7 Support - ShopFlix</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="styles.css">
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #260474;
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

header h1 {
    margin: 0;
}

main {
    padding: 20px;
}

.support-form {
    max-width: 600px;
    margin: 0 auto;
}

.support-form h2 {
    margin-top: 0;
}

.support-form p {
    margin-bottom: 20px;
}

.support-form label {
    font-weight: bold;
}

.support-form input,
.support-form select,
.support-form textarea {
    width: 100%;
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.support-form button {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.support-form button:hover {
    background-color: #555;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

    </style>
<body>
    <header>
        <h1>Contact Support - 24/7</h1>
    </header>
    <main>
        <section class="support-form">
            <h2>Get Support</h2>
            <p>Please fill out the form below to get support for electronic, furniture, gym equipment, or flight booking queries.</p>
            <form action="submit_support.php" method="POST">
                <label for="name">Your Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                
                <label for="email">Your Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                
                <label for="category">Select Category:</label><br>
                <select id="category" name="category" required>
                    <option value="Electronic">Electronic</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Gym Equipment">Gym Equipment</option>
                    <option value="Flight Booking">Flight Booking</option>
                </select><br>
                
                <label for="message">Your Message:</label><br>
                <textarea id="message" name="message" rows="4" required></textarea><br>
                
                <button type="submit">Submit</button>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2024 ShopFlix. All rights reserved.</p>
    </footer>
</body>
</html>
