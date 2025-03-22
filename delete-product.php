<?php
// Start the session
session_start();

// Include the database connection file
include 'dashboard.php'; // Ensure this file contains your database connection logic

// Check if the ID is set in the URL
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    // Prepare the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM product1 WHERE pid = ?");
    $stmt->bind_param("i", $pid); // Assuming 'id' is an integer

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the product list page with a success message
        $_SESSION['message'] = "Product deleted successfully.";
        header("Location: products.php"); // Change to your product list page
        exit();
    } else {
        // Handle error
        $_SESSION['error'] = "Failed to delete product.";
        header("Location: products.php"); // Change to your product list page
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // If no ID is provided, redirect with an error
    $_SESSION['error'] = "No product ID provided.";
    header("Location: products.php"); // Change to your product list page
    exit();
}

// Close the database connection
$conn->close();
?>
