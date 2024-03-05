<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Demo - Electronics</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>

    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
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

.demo-form {
    max-width: 600px;
    margin: 0 auto;
}

.demo-form h2 {
    margin-top: 0;
}

.demo-form p {
    margin-bottom: 20px;
}

.demo-form label {
    font-weight: bold;
}

.demo-form input,
.demo-form textarea {
    width: 100%;
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.demo-form button {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.demo-form button:hover {
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
</head>
<body>
    <header>
        <h1>Book a Demo - Electronics</h1>
    </header>
    <main>
        <section class="demo-form">
            <h2>Request a Demo</h2>
            <p>Please fill out the form below to request a demo for our electronics products.</p>
            <form action="submit_demo_request.php" method="POST">
                <label for="name">Your Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                
                <label for="email">Your Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                
                <label for="phone">Your Phone Number:</label><br>
                <input type="tel" id="phone" name="phone" required><br>
                
                <label for="product">Product of Interest:</label><br>
                <input type="text" id="product" name="product" required><br>
                
                <label for="message">Additional Message (if any):</label><br>
                <textarea id="message" name="message" rows="4"></textarea><br>
                
                <button type="submit">Submit</button>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2024 ShopFlix. All rights reserved.</p>
    </footer>
</body>
</html>
