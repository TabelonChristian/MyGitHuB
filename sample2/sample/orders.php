<?php
include('includes/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST['selectOption'];
    $product = $_POST['product'];

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert data into the schedule_table
        $sql = "INSERT INTO schedule_table (s_id, s_date, s_status) VALUES (:s_id, :s_date, :s_status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':s_id', $selectedOption);
        $stmt->bindParam(':s_date', $product);
        $stmt->bindParam(':s_status', $status); // Provide a value for status

        $stmt->execute();

        // Redirect back to the schedule data page after successful insertion
        header("Location: ../schedule.php");
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

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedule</title>
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
            max-width: 600px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">SCHEDULE</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="selectOption">Select Customer:</label>
        <select name="selectOption" id="selectOption">
            <?php
            try {
                $conn = connectDB();
                $stmt = $conn->query("SELECT * FROM users");
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }

            foreach ($result as $row) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>

        <label for="product">Schedule Date:</label>
        <input type="date" id="product" name="product" required>

        <button type="submit">Insert</button>
    </form>
</div>

</body>
</html>
