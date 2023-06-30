<?php 
require('pages/Auth.php');
  require('config/dbconnection.php');
  
  if (isset($_POST['id'])) {
    $categoryId = $_POST['id'];
  
    // Retrieve the category details based on the categoryId
    $query = "SELECT * FROM categories WHERE id = $categoryId";
    $result = mysqli_query($con, $query);
    $category = mysqli_fetch_assoc($result);
  
    // Close the connection
    mysqli_close($con);
  
    // Return the category details as JSON
    echo json_encode($category);
  }
?>
