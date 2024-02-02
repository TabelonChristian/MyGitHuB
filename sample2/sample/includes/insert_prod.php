<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST['s_date'];
    $stock = $_POST['s_status'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO schedule_table   (s_date, s_status) VALUES (:s_date, :s_status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':s_date', $pname);
        $stmt->bindParam(':s_status', $stock);
        $stmt->execute();

        // Redirect back to the user data page after successful insertion
        header("Location: ../product.php");
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
