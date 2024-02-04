<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input, select {
            padding: 10px;
            margin-bottom: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .button-container {
            text-align: center;
        }

        .update-button {
            background-color: #2196f3;
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

<!-- Rest of your code remains unchanged -->


<div id="container">
    <h2 style="text-align: center;">Edit Schedule </h2>

    <?php
    include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['edit_product_id'])) {
            $scheduleID = $_POST['edit_product_id'];
            $sql = "SELECT s_id, s_date, s_status FROM schedule_table WHERE s_id = :schedule_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':schedule_id', $scheduleID);
            $stmt->execute();

            $scheduleData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($scheduleData) {
                // Schedule data found, render the edit form
    ?>
                 <form action="includes/update_prod.php" method="post">
                    <input type="hidden" name="schedule_id" value="<?php echo $scheduleData['s_id']; ?>">
                    
                    <label for="s_date">Date:</label>
                    <input type="date" name="s_date" id="s_date" value="<?php echo $scheduleData['s_date']; ?>">
                    
                    <label for="s_status">Status:</label>
                    <select name="s_status" id="s_status">
                        <option value="Available" <?php echo ($scheduleData['s_status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                        <option value="Unavailable" <?php echo ($scheduleData['s_status'] == 'Unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                    </select>

                    <div class="button-container">
                        <button type="submit" class="update-button">Update Schedule</button>
                    </div>
                </form>
    <?php
            } else {
                echo "<p>Schedule not found.</p>";
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