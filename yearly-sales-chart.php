<?php
include 'dashboard.php';


// Fetch yearly sales data
$sql = "SELECT YEAR(DateOfMFG) AS year, SUM(price * quantity) AS total_sales 
        FROM product1 
        GROUP BY YEAR(DateOfMFG) 
        ORDER BY year ASC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return data as JSON for Chart.js
echo json_encode($data);
$conn->close();
?>
