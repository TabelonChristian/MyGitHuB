<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: 0 auto;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div id="container">
    <h2>Add Product</h2>

    <form action="product.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>

        <label for="product_stocks">Stocks:</label>
        <input type="number" name="product_stocks" id="product_stocks" required>

        <button type="submit">Add Product</button>
    </form>

    <a href="product.php">Back to Product List</a>
</div>

</body>
</html>
