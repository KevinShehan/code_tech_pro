<?php
require('pages/Auth.php');
require('config/dbconnection.php');






if (isset($_GET['id'])) {
    // $id = $_GET['id'];
    $delete_query = "DELETE FROM purchase WHERE id = '".$_GET['id']." '";
    $result = mysqli_query($con, $delete_query);  
    // Perform the deletion operation based on the provided row ID
    // Implement your logic here
  
    // Set the $success variable based on the deletion status
    $success = true; // Set to true if deletion is successful, false otherwise
  
    // Return the response as JSON
    $response = ['success' => $success];
    echo json_encode($response);
  } else {
    // If the row ID is not provided, return an error response
    $response = ['success' => false];
    echo json_encode($response);
  }

