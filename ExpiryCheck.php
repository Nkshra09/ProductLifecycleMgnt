<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Expiry Checker</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/templatemo-style.css">
   <!-- <link rel="stylesheet" href="/ProductLifecycleMgnt/expiry.css"> -->
  <style>
    .expired {
        color: red;
        font-weight: bold;
    }

    .valid {
        color: green;
        font-weight: bold;
    }
</style>

</head>
  <body id="reportsPage" class="expiryBody">
  <nav class="navbar navbar-expand-xl">
    <div class="container h-100">
      <a class="navbar-brand" href="index.php">
        <h1 class="tm-site-title mb-0">Product Admin</h1>
      </a>
      <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars tm-nav-icon"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto h-100">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="fas fa-tachometer-alt"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="far fa-file-alt"></i>
              <span> Reports <i class="fas fa-angle-down"></i> </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Daily Report</a>
              <a class="dropdown-item" href="#">Weekly Report</a>
              <a class="dropdown-item" href="#">Yearly Report</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle" href="products.php">
              <i class="fas fa-shopping-cart"></i> Products
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link active" href="ExpiryCheck.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cog"></i>
              <span> Expiry Status <i class="fas fa-angle-down"></i> </span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link d-block" href="login.php">
              Admin, <b>Logout</b>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row tm-content-row">
      <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
        <div class="tm-bg-primary

  <div class="container mt-5">
        <h1>Product Expiry Checker</h1>
<!--         <p>Please enter the product name and expiry date:</p> -->

        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col"></th>  
                                    <th scope="col">PRODUCT NAME</th>
                                    <th scope="col">UNIT SOLD</th>
                                    <th scope="col">IN STOCK</th>
                                    <th scope="col">Date Of MFG</th>
                                    <th scope="col">EXPIRE DATE</th>
                                    <th scope="col"></th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'dashboard.php';
                                // Fetch product data
                                $sql = "SELECT * FROM product1";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $isExpired = (new DateTime($row['DateOfExp']) < new DateTime()) ? "Expired" : "Valid";
                                        $statusClass = ($isExpired == "Expired") ? "expired" : "valid";
                                        echo "<tr>";
                                        echo "<th scope='row'><input type='checkbox' /></th>";
                                        echo "<td class='tm-product-name'>" . htmlspecialchars($row["pname"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["DateOfMFG"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($row["DateOfExp"]) . "</td>";
                                        echo "<td><a href='#' class='tm-product-delete-link'><i class='far fa-trash-alt tm-product-delete-icon'></i></a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No products found</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>

       


        
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
