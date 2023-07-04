<?php
// Include the necessary database connection and configuration files
include('config/dbconnection.php');

// Check if the ID parameter is set
if (isset($_GET['id'])) {
  // Sanitize the ID value to prevent SQL injection
  $categoryId = mysqli_real_escape_string($con, $_GET['id']);

  // Query to retrieve the category details based on the provided ID
  $query = "SELECT * FROM category WHERE id = '$categoryId'";
  $result = mysqli_query($con, $query);

  if ($result) {
    // Check if any category record was found
    if (mysqli_num_rows($result) > 0) {
      // Fetch the category details as an associative array
      $category = mysqli_fetch_assoc($result);

      // Prepare the category details as a JSON response
      $response = array(
        'id' => $category['id'],
        'cat_code' => $category['code'],
        'cat_name' => $category['name']
      );

      // Return the JSON response
      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      // No category record found with the provided ID
      $response = array(
        'error' => 'No category found with the provided ID'
      );

      // Return the JSON response with an error message
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  } else {
    // Query execution error
    $response = array(
      'error' => 'An error occurred while retrieving category details'
    );

    // Return the JSON response with an error message
    header('Content-Type: application/json');
    echo json_encode($response);
  }
} else {
  // ID parameter not provided
  $response = array(
    'error' => 'No category ID provided'
  );

  // Return the JSON response with an error message
  header('Content-Type: application/json');
  echo json_encode($response);
}
