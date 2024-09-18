<?php include('../config/constant.php'); ?>

<?php
// Initialize an empty array to store search results
$searchResults = array();

// Query to fetch search results based on the search query
$searchQuery = $_GET['query'];
$location = $_GET['location'];
$sql =  "SELECT * FROM tb_courses WHERE c_type = 'acom' AND location = '$location' AND status = 'active' AND c_name LIKE '%$searchQuery%'";
$res = mysqli_query($conn, $sql);

// Fetch search results and add them to the searchResults array
while ($row = mysqli_fetch_assoc($res)) {
    $searchResults[] = $row;
}

// Return the search results as JSON
echo json_encode($searchResults);
?>
