<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO orders (product_name, quantity, customer_id, order_date) 
                VALUES (:productName, :quantity, :customerID, NOW())"; // Assuming NOW() provides the current date
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':customerID', $customerID); // You need to set $customerID with the actual customer ID

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
?>
