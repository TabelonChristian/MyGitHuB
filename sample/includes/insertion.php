<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'name' and 'email' are present in the POST data
    if (isset($_POST['name']) && isset($_POST['email'])) {
        // Handle user insertion
        $name = $_POST['name'];
        $email = $_POST['email'];

        try {
            // Use the function to get a PDO connection
            $conn = connectDB();

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Redirect back to the user data page after successful insertion
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Always close the connection
            if ($conn) {
                $conn = null;
            }
        }
    } elseif (isset($_POST['productName']) && isset($_POST['quantity'])) {
        // Handle order insertion
        $productName = $_POST['productName'];
        $quantity = $_POST['quantity'];

        try {
            // Use the function to get a PDO connection
            $conn = connectDB();

            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO orders (product_name, quantity) VALUES (:productName, :quantity)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();

            // Redirect back to the order data page after successful insertion
            header("Location: ../order.php");
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
}
?>
