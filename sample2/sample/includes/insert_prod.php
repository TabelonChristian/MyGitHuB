<?php
include 'db_connection.php';

// ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST['s_date'];
    $status = $_POST['s_status'];

    // Assuming you have a patient ID, retrieve it from the session or wherever it's stored
    $patientId = 1; // Replace with actual patient ID retrieval

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert appointment into the schedule_table
        $sql = "INSERT INTO schedule_table (s_id, s_date, s_status) VALUES (:s_id, :s_date, COALESCE(:s_status, 'default_value'))";
        $stmt = $conn->prepare($sql);
      // ...
$stmt->bindParam(':s_id', $selectedOption);
$stmt->bindParam(':s_date', $selectedDate);
$stmt->bindParam(':s_status', $status);
// ...

$stmt->execute();

        // Redirect back to the schedule data page after successful insertion
        header("Location: ../orders.php");
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
// ...

?>
