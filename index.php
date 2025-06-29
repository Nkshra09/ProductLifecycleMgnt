<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Admin </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="/ProductLifecycleMgnt/templatemo-style.css">
	
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
</head>

<body id="reportsPage" class="indexBody">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="index.php">
                    <h1 class="tm-site-title mb-0">Product Admin</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>
                                Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="sales.php" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-file-alt"></i>
                                <span>
                                    Reports <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/ProductLifecycleMgnt/yearly-sales-chart.html">Daily Report</a>
                                <a class="dropdown-item" href="#">Weekly Report</a>
                                <a class="dropdown-item" href="#">Yearly Report</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </a>
                        </li>

                        
                        <li class="nav-item ">
                            <a class="nav-link " href="ExpiryCheck.php" >
                                <i class="fas fa-cog"></i>
                                <span>
                                    Expiry Status <i class="fas fa-angle-down"></i>
                                </span>
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                </div>
            </div>
            <!-- row -->
<!--             <div class="row tm-content-row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Latest Hits</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div> -->
		<div class="row d-flex flex-wrap">
<!--                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Performance</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div> -->
<!--                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
                        <h2 class="tm-block-title">Storage Information</h2>
                        <div id="pieChartContainer">
                            <canvas id="pieChart" class="chartjs-render-monitor" width="200" height="200"></canvas>
                        </div>                        
                    </div> -->
			<div class="tm-block-col">
  <div class="tm-bg-primary-dark tm-block">
    <h2 class="tm-block-title">Product Category Overview</h2>

    <?php
    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "productdb");

    // Get selected category or default to All
    $selectedCategory = $_GET['category'] ?? 'All';

    // Get distinct categories for the dropdown
    $catQuery = "SELECT DISTINCT category FROM product1";
    $catResult = $conn->query($catQuery);
    $categories = [];
    while ($row = $catResult->fetch_assoc()) {
        $categories[] = $row['category'];
    }

    // Fetch product data based on selected category
    $query = ($selectedCategory === 'All')
      ? "SELECT pname, quantity FROM product1"
      : "SELECT pname, quantity FROM product1 WHERE category='$selectedCategory'";
    $result = $conn->query($query);

    $labels = [];
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['pname'];
        $data[] = $row['quantity'];
    }
    ?>

    <!-- Category Dropdown -->
    <form method="GET" class="mb-3">
      <select name="category" class="form-control" onchange="this.form.submit()">
        <option value="All">All</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat ?>" <?= ($selectedCategory === $cat) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </form>

    <!-- Chart Canvas -->
	   <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller">
<!--                         <h2 class="tm-block-title">Storage Information</h2> -->
                        <div id="pieChartContainer">
                             <canvas id="productChart" height="250"></canvas>
                        </div>                        
                    </div> 
<!--     <canvas id="productChart" height="250"></canvas> -->
  </div>
</div>
                </div>
<!-- 			<div class="tm-block-col">
  <div class="tm-bg-primary-dark tm-block">
    <h2 class="tm-block-title">Product Category Overview</h2>

    <!-- Category Filter -->
    <form method="GET" class="mb-3">
      <select name="category" onchange="this.form.submit()" class="form-control">
        <option value="All">All</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat ?>" <?= $selectedCategory === $cat ? 'selected' : '' ?>>
            <?= $cat ?>
          </option>
        <?php endforeach; ?>
      </select>
    </form>

    <!-- Chart Canvas -->
    <canvas id="productChart" height="250"></canvas>
  </div>
</div> -->



		</div>
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER NO.</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">OPERATORS</th>
                                    <th scope="col">LOCATION</th>
                                    <th scope="col">DISTANCE</th>
                                    <th scope="col">START DATE</th>
                                    <th scope="col">EST DELIVERY DUE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><b>#122349</b></th>
                                    <td>
                                        <div class="tm-status-circle moving">
                                        </div>Moving
                                    </td>
                                    <td><b>Oliver Trag</b></td>
                                    <td><b>London, UK</b></td>
                                    <td><b>485 km</b></td>
                                    <td>16:00, 12 NOV 2018</td>
                                    <td>08:00, 18 NOV 2018</td>
                                </tr>
                                <tr>
                                    <th scope="row"><b>#122348</b></th>
                                    <td>
                                        <div class="tm-status-circle pending">
                                        </div>Pending
                                    </td>
                                    <td><b>Jacob Miller</b></td>
                                    <td><b>London, UK</b></td>
                                    <td><b>360 km</b></td>
                                    <td>11:00, 10 NOV 2018</td>
                                    <td>04:00, 14 NOV 2018</td>
                                </tr>
                                <tr>
                                    <th scope="row"><b>#122347</b></th>
                                    <td>
                                        <div class="tm-status-circle cancelled">
                                        </div>Cancelled
                                    </td>
                                    <td><b>George Wilson</b></td>
                                    <td><b>London, UK</b></td>
                                    <td><b>340 km</b></td>
                                    <td>12:00, 22 NOV 2018</td>
                                    <td>06:00, 28 NOV 2018</td>
                                </tr>
                                <tr>
                                    <th scope="row"><b>#122346</b></th>
                                    <td>
                                        <div class="tm-status-circle moving">
                                        </div>Moving
                                    </td>
                                    <td><b>William Aung</b></td>
                                    <td><b>London, UK</b></td>
                                    <td><b>218 km</b></td>
                                    <td>15:00, 10 NOV 2018</td>
                                    <td>09:00, 14 NOV 2018</td>
                                </tr>
                               
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="tm-footer row tm-mt-small">
            <div class="col-12 font-weight-light">
                <p class="text-center text-white mb-0 px-4 small">
                     
                    
                     <a rel="nofollow noopener" href="#" class="tm-footer-link">Product Admin</a>
                </p>
            </div>
        </footer>
    </div>
<!-- 	<script>
var ctx = document.getElementById('productChart').getContext('2d');
new Chart(ctx, {
  type: 'pie',
  data: {
    labels: <?= json_encode($labels); ?>,
    datasets: [{
      data: <?= json_encode($data); ?>,
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#E91E63', '#3F51B5']
    }]
  },
  options: {
    responsive: true,
    legend: { position: 'bottom' },
    title: {
      display: true,
      text: 'Products in <?= $selectedCategory ?>'
    }
  }
});
</script> -->
<script>
const ctx = document.getElementById('productChart').getContext('2d');
new Chart(ctx, {
  type: 'pie',
  data: {
    labels: <?= json_encode($labels); ?>,
    datasets: [{
      data: <?= json_encode($data); ?>,
      backgroundColor: [
        '#F94144', '#F3722C', '#F9C74F',
        '#90BE6D', '#43AA8B', '#577590',
        '#A569BD', '#2ECC71', '#E67E22'
      ]
    }]
  },
  options: {
    responsive: true,
    legend: { position: 'bottom' },
    title: {
      display: true,
      text: 'Products in <?= $selectedCategory ?>'
    }
  }
});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="/ProductLifecycleMgnt/tooplate-scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<!--     <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart

            $(window).resize(function () {
                updateLineChart();
                updateBarChart();                
            });
        })
    </script> -->
</body>

</html>
