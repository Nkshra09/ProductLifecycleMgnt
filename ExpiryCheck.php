<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Expiry Checker</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/templatemo-style.css">
    <link rel="stylesheet" href="/ProductLifecycleMgnt/expiry.css">
</head>
<body>
  <div class="container">
    <h1>Product Expiry Checker</h1>
    <p>Please enter the product name and expiry date:</p>

    <div class="product-entry">
      <label for="productName">Product Name:</label>
      <input type="text" id="productName" placeholder="Enter product name" required>

      <label for="expiryDate">Expiry Date:</label>
      <input type="date" id="expiryDate" required>

     <!-- <button onclick="addProduct()">Add Product</button> -->
    </div>

    <h2>Products List</h2>
    <ul id="productList" class="product-list"></ul>

    <button onclick="checkExpiries()">Check Expiry Dates</button>
  </div>
   <a href="index.php">Back</a>
  <?php
include 'dashboard.php';

$sql = "SELECT ProductID, ProductName, DateOfExp FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $isExpired = (new DateTime($row['DateOfExp']) < new DateTime()) ? "Expired" : "Valid";
        echo "<li>{$row['ProductName']} - Expiry Date: {$row['DateOfExp']} <span style='color:" . ($isExpired == "Expired" ? "red" : "green") . ";'>($isExpired)</span></li>";
    }
} else {
    echo "No products found.";
}

$conn->close();
?>
<script src="..static/js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="/ProductLifecycleMgnt/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="/ProductLifecycleMgnt/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="/ProductLifecycleMgnt/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="/ProductLifecycleMgnt/tooplate-scripts.js"></script>
</body>
</html>
