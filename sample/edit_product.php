<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .update-button {
            background-color: #007BFF; /* Use the primary color of your design */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .update-button:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
</head>
<body>

<div id="container">
    <h2>Edit Product</h2>

    <?php
    include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['edit_product_id'])) {
            $prodID = $_POST['edit_product_id'];
            $sql = "SELECT product_id, product_name, product_stock FROM products WHERE product_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $prodID);
            $stmt->execute();

            $productData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($productData) {
                // Product data found, render the edit form
    ?>
                <form action="product.php" method="post">
                    <input type="hidden" name="pid" value="<?php echo $productData['product_id']; ?>">
                    <label for="pname">Name:</label>
                    <input type="text" name="pname" id="pname" value="<?php echo $productData['product_name']; ?>">

                    <label for="pstock">Stock:</label>
                    <input type="text" name="pstock" id="pstock" value="<?php echo $productData['product_stock']; ?>">

                    <div class="button-container">
                        <button type="submit" class="update-button">Update</button>
                    </div>
                </form>
    <?php
            } else {
                echo "<p>Product not found.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>
</div>

</body>
</html>
