<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Data</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Order List</h2>

    <?php
    $host = "localhost";
    $dbname = "testdb";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create the orders table if not exists
        $createTableSQL = "CREATE TABLE IF NOT EXISTS orders (
            order_id INT PRIMARY KEY,
            customer_id INT,
            product_id INT,
            order_date DATE
        )";
        $conn->exec($createTableSQL);

        $stmt = $conn->query("SELECT * FROM orders");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<table>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Product ID</th>
                    <th>Order Date</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['id']}</td>
                    <td>{$row['product_id']}</td>
                    <td>{$row['order_date']}</td>
                </tr>";
        }
        echo "</table>";
        

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>

    <div class="button-container">
        <a href="place_order.php" class="add-button">Place Order</a>
        <a href="welcome.php" class="add-button">Home</a>
    </div>
</div>

</body>
</html>
