<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $sid = $_POST["schedule_id"];
    $sdate = $_POST["s_date"];
    $sstatus = $_POST["s_status"];
    
    // Perform database update
    try {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE schedule_table SET s_date = :s_date, s_status = :s_status WHERE s_id = :schedule_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':schedule_id', $sid);
        $stmt->bindParam(':s_date', $sdate);
        $stmt->bindParam(':s_status', $sstatus);

        $stmt->execute();

        // Redirect to the page displaying the updated schedule or any other page
        header("Location: ../product.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
