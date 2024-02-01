<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select, date {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Add Order</h2>

    <form action="orders.php" method="post">
    <label for="customer_name">Customer Name:</label>
    <input type="text" name="customer_name" id="customer_name" required>

    <label for="select_product">Select Product:</label>
    <select name="select_product" id="select_product">
        <!-- Populate options dynamically from the database -->
        <?php
        include('includes/db_connection.php');

        try {
            $conn = connectDB();
            $stmt = $conn->query("SELECT * FROM products");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        foreach ($result as $row) {
            echo "<option value='{$row['product_id']}'>{$row['product_name']}</option>";
        }
        ?>
    </select>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" required>

    <label for="order_date">Order Date:</label>
    <input type="date" name="order_date" id="order_date" required>

    <div class="button-container">
        <button type="submit">Place Order</button>
    </div>
</form>
    <div class="button-container">
        <a href="orders.php">Back to Order List</a>
    </div>
</div>

</body>
</html>
