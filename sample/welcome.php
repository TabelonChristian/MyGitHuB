<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .button {
            background-color: #2b2b2b;
            display: flex;
            justify-content: space-around;  /* Adjust as needed */
            margin: 10px;
            padding: 20px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div id="container">
    <h2>Welcome </h2>
    <div class="button">
        <!-- Buttons to navigate to other pages -->
        <a href="index.php">Go to Index</a><br>
        <a href="orders.php">Go to Orders</a><br>
        <a href="product.php">Go to Products</a>
    </div>
</div>

</body>
</html>
