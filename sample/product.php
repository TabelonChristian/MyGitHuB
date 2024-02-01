<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Data</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
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

        .add-button, .edit-button, .order-button {
            display: inline-block;
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
        }

        .add-button:hover, .edit-button:hover, .order-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div id="container">
    <h2>Product Data</h2>

    <?php
    include 'includes/db_connection.php';

    // Check if the form for adding a new product is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_name']) && isset($_POST['product_stocks'])) {
        $pname = $_POST['product_name'];
        $stock = $_POST['product_stocks'];

        try {
            // Use the function to get a PDO connection
            $conn = connectDB();

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO products (product_name, product_stock) VALUES (:prod, :sto)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':prod', $pname);
            $stmt->bindParam(':sto', $stock);
            $stmt->execute();

            // Redirect back to the product data page after successful insertion
            header("Location: product.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Always close the connection
            if ($conn) {
                $conn = null;
            }
        }
    }

    // Display the product data
    try {
        $conn = connectDB();

        if ($conn) {
            $sql = "SELECT product_id, product_name, product_stock FROM products";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<table>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Stocks</th>
                    <th>Action</th>
                </tr>";
            foreach ($result as $row) {
                echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_stock']}</td>
                    <td>
                    <form action='edit_product.php' method='post' style='display: inline;'>
                    <input type='hidden' name='edit_product_id' value='{$row['product_id']}'>
                    <button type='submit' class='edit-button'>Edit</button>
                </form>
                        <a href='orders.php?product_id={$row['product_id']}' class='order-button'>Order</a>
                    </td>
                </tr>";
            }
            echo "</table>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>

    <div class="button-container">
        <a href="add_product.php" class="add-button">Add Product</a>
        <a href="welcome.php" class="add-button">Home</a>
    </div>

</div>

</body>
</html>
