<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
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
            max-width: 800px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>

<body>

    <div id="container">
        <h2 style="text-align: center;">View Appointments</h2>

        <?php
include 'includes/db_connection.php';

try {
    $conn = connectDB(); // Assuming you have a connectDB function

    if ($conn) {
        $sql = "SELECT appointement_table.a_id, patient_table.p_name, patient_table.p_email, schedule_table.s_date, schedule_table.s_status
                FROM    
                appointement_table
                INNER JOIN patient_table ON appointement_table.p_id = patient_table.p_id
                INNER JOIN schedule_table ON appointement_table.s_id = schedule_table.s_id";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['a_id']}</td>
                    <td>{$row['p_name']}</td>
                    <td>{$row['s_date']}</td>
                    <td>{$row['s_status']}</td>
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


    </div>

</body>

</html>
