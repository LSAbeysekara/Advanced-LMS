<?php
// Include database connection and constants file
include('config/constant.php');

// Function to limit text
function limit_text($text, $limit) {
    if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit) . '...';
    }
    return $text;
}

// Number of products per page
$productsPerPage = 9;

// Get page number from URL, if not present set to 1
$pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate offset for pagination
$offset = ($pageNumber - 1) * $productsPerPage;

// Get category from URL parameter
$cat = isset($_GET['cat']) ? $_GET['cat'] : null;

// Build SQL query based on category
if ($cat !== null) {
    $sql = "SELECT * FROM `tb_product` WHERE `status` = 'Active' AND `category` = '$cat' LIMIT $offset, $productsPerPage";
} else {
    $sql = "SELECT * FROM `tb_product` WHERE `status` = 'Active' LIMIT $offset, $productsPerPage";
}

// Query to fetch products
$qset = $conn->query($sql);

// Check for errors in query execution
if (!$qset) {
    die("Query failed: " . $conn->error);
}

// Debugging: Print the SQL query
echo "SQL Query: $sql";

// Check if any rows are returned
if ($qset->num_rows > 0) {
    while ($row = $qset->fetch_assoc()) {
        // Process each row of the result
        // Your code for displaying products goes here
        echo "Product ID: " . $row['id'] . "<br>";
        echo "Product Name: " . $row['productname'] . "<br>";
        // Display other product details as needed
    }
} else {
    // No products found
    echo "No products found";
}
?>
