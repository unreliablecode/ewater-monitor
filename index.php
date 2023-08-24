<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #222;
            color: white;
            font-family: Arial, sans-serif;
        }
        .grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }
        .box {
            width: 100px;
            height: 20px;
            margin-right: 10px;
        }
        .green {
            background-color: green;
        }
        .red {
            background-color: red;
        }
        .pump-container {
            margin-bottom: 20px;
        }
        .pump-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .pump-status {
            display: flex;
            gap: 10px;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
<div class="grid">
    <?php
    $servername = "localhost";
    $username = "ewatermonitor";
    $password = "ewatermonitor";
    $dbname = "ewatermonitor";

    // Number of items per page
    $itemsPerPage = 5;

    // Get the current page number from query parameter
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Calculate the offset
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, pressure, status, active FROM maintable LIMIT $itemsPerPage OFFSET $offset";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $pressure = $row["pressure"];
            $status = $row["status"];
            $active = $row["active"];

            echo '<div class="pump-container">';
            echo '<div class="pump-details">';
            echo "<h2>ID: " . $id . "</h2>";
            echo '<div class="pump-status">';
            echo '<div class="box ' . ($active == 1 ? "green" : "red") . '">' . ($active == 1 ? "Active" : "Inactive") . '</div>';
            echo '<div class="box ' . ($status == 1 ? "green" : "red") . '">' . ($status == 1 ? "Normal" : "ERROR") . '</div>';
            echo '<div>Pressure: ' . $pressure . ' BAR</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</div>
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="?page=<?php echo $currentPage - 1; ?>">Back</a>
    <?php endif; ?>

    <?php if ($result->num_rows >= $itemsPerPage): ?>
        <a href="?page=<?php echo $currentPage + 1; ?>">Next</a>
    <?php endif; ?>
</div>
</body>
</html>
