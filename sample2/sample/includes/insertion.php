<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST['name'];
    $patientEmail = $_POST['email'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert patient into the patient_table
        $sql = "INSERT INTO patient_table (p_name, p_email) VALUES (:p_name, :p_email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':p_name', $patientName);
        $stmt->bindParam(':p_email', $patientEmail);
        $stmt->execute();

        // Redirect back to the appointment data page after successful insertion
        header("Location: ../appointment.php");
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
