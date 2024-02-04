<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $sid = $_POST[""]; // Replace with the actual name of the form field for schedule ID
    $sdate = $_POST[""]; // Replace with the actual name of the form field for schedule date
    $sstatus = $_POST[""]; // Replace with the actual name of the form field for schedule status
  
    // Perform database update
    try {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE schedule_table SET s_date = :sdate, s_status = :sstatus WHERE schedule_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $sid);
        $stmt->bindParam(':sdate', $sdate);
        $stmt->bindParam(':sstatus', $sstatus);

        $stmt->execute();

        // Redirect to the page displaying the updated schedule or any other page
        header("Location: ../appointments.php?error=success"); // Change the location as needed
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

