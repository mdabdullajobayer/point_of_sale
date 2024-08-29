<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 50px 20px;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        p {
            font-size: 18px;
            margin-bottom: 40px;
            color: #7f8c8d;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        .feature-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .feature-box h3 {
            margin-bottom: 15px;
            color: #2980b9;
        }

        .feature-box p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to X-Bakery POS</h1>
        <p>Your all-in-one solution for easy and efficient point of sale management.</p>
        <a href="/login" class="btn">Get Started</a>

        <div class="features">
            <div class="feature-box">
                <h3>Easy Invoicing</h3>
                <p>Create and manage invoices with just a few clicks.</p>
            </div>
            <div class="feature-box">
                <h3>Sales Tracking</h3>
                <p>Monitor your sales in real-time with detailed reports.</p>
            </div>
            <div class="feature-box">
                <h3>Inventory Management</h3>
                <p>Keep track of your stock levels and never run out of products.</p>
            </div>
        </div>
    </div>
</body>

</html>
