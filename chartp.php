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
