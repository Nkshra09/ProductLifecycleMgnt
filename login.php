<?php
// session_start();
$message = "";
include('dashboard.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        $sql = "SELECT * FROM adminlogin1 WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password) {
                $_SESSION['username'] = $username;
                $message="login successfull";
                header("Location: index.html");
                exit;
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "Invalid username.";
        }
        // $stmt->close;
     } catch (mysqli_sql_exception $e) {
        $message = "Error: Could not perform the login operation. Please try again.";
     }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php session_start(); ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Page - Product Admin Template</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">	  
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body class="loginBody">
    <div>
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="index.php">
            <h1 class="tm-site-title mb-0">Product Admin</h1>
          </a>
          <button
            class="navbar-toggler ml-auto mr-0"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation" >
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
              <!-- Reports Link -->
<li class="nav-item dropdown">
  <a
    class="nav-link dropdown-toggle <?php echo !isset($_SESSION['username']) ? 'disabled-link' : ''; ?>"
    href="#"
    id="navbarDropdown"
    role="button"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false">
    <i class="far fa-file-alt"></i>
    <span> Reports <i class="fas fa-angle-down"></i> </span>
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="#">Daily Report</a>
    <a class="dropdown-item" href="#">Weekly Report</a>
    <a class="dropdown-item" href="#">Yearly Report</a>
  </div>
</li>

<!-- Products -->
<li class="nav-item">
  <a
    class="nav-link <?php echo !isset($_SESSION['username']) ? 'disabled-link' : ''; ?>"
    href="products.php">
    <i class="fas fa-shopping-cart"></i> Products
  </a>
</li>

<!-- Expiry Status -->
<li class="nav-item dropdown">
  <a
    class="nav-link dropdown-toggle <?php echo !isset($_SESSION['username']) ? 'disabled-link' : ''; ?>"
    href="ExpiryCheck.php"
    id="navbarDropdown"
    role="button"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false">
    <i class="fas fa-cog"></i>
    <span> Expiry Status <i class="fas fa-angle-down"></i> </span>
  </a>
</li>

            </ul>
          </div>
        </div>
      </nav>
    </div>

    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                <h2 class="tm-block-title mb-4">Welcome to Dashboard, Login</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form action="index.php" method="post" class="tm-login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input
                      name="username"
                      type="text"
                      class="form-control validate"
                      id="username"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input
                      name="password"
                      type="password"
                      class="form-control validate"
                      id="password"
                      value=""
                      required
                    />
                  </div>
                  <div class="form-group mt-4">
                    <button
                      type="submit"
                      class="btn btn-primary btn-block text-uppercase"
                    >
                      Login
                    </button>
                  </div>
                  <button class="mt-5 btn btn-primary btn-block text-uppercase">
                    Forgot your password?
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
          Copyright &copy; <b>2018</b> All rights reserved. 
          
          Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
      </div>
    </footer>
    <script src="/ProductLifecycleMgnt/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="/ProductLifecycleMgnt/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
