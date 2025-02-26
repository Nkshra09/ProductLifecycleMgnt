<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Expiry Checker</title>
  <link rel="stylesheet" href="..static/css/expiry.css">
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

      <button onclick="addProduct()">Add Product</button>
    </div>

    <h2>Products List</h2>
    <ul id="productList" class="product-list"></ul>

    <button onclick="checkExpiries()">Check Expiry Dates</button>
  </div>
   <a href="index.html">Back</a>
  <?php
include 'dashboard.html';

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

</body>
</html>
