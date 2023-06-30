<?php

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     if (isset($_GET['id'])) {
//         $id = $_GET['id'];
//         $delete_query = "DELETE FROM supplier WHERE id=$id";
//         $result = mysqli_query($con, $delete_query);

//         if ($result) {
//             //             //     echo "
//             //             // <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
//             //             // <script>
//             //             // swal({
//             //             //     title: 'Success!',
//             //             //     text: 'Query Deleted successfully.',
//             //             //     icon: 'success',
//             //             // }).then(function() {
//             //             //     // Redirect to view.php
//             //             //     window.location.href = 'supplier_view.php';
//             //             // });
//             //             // </script>
//             //             //     ";
//             //             // Return a JSON response indicating success
//             //             $response = array('message' => 'User deleted successfully.');
//             //             echo json_encode($response);
//             $response = ['success' => true];
//             echo json_encode($response);
//         }
//     }
// }

// echo '<script type="text/javascript">
// swal("Deleted!", "Supplier Successfully Deleted" , "success");
//   </script>';

// // echo '<script>
//  setTimeout(function(){
//  window.location.href = "Supplier_View.php";
// }, 1000);
// </script>';

  require('pages/Auth.php');
  require('config/dbconnection.php');
  
  if (isset($_GET['id'])) {
      $delete_query = "DELETE FROM employee WHERE id = '".$_GET['id']." '";
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

  // if (isset($_GET['id'])) {
  //   $id = $_GET['id'];
    
//     // Perform the deletion operation on the "employee" table
//     $delete_query = "DELETE FROM employee WHERE id = '$id'";
//     $result = mysqli_query($con, $delete_query);
  
//     // Check if the deletion was successful
//     if ($result) {
//         $success = true;
        
//         // Perform the deletion operation on the "user" table
//         $delete_user_query = "DELETE FROM user WHERE employee_id = '$id'";
//         $result_user = mysqli_query($con, $delete_user_query);
        
//         // Check if the deletion from the "user" table was successful
//         if (!$result_user) {
//             $success = false;
//         }
//     } else {
//         $success = false;
//     }
  
//     // Return the response as JSON
//     $response = ['success' => $success];
//     echo json_encode($response);
// } else {
//     // If the row ID is not provided, return an error response
//     $response = ['success' => false];
//     echo json_encode($response);
// }





// mysqli_query($con,"DELETE FROM supplier WHERE id = '".$_GET['id']." '")or die(mysqli_error($con));
//         $_SESSION['delete_msg']='Supplier Successfully Deleted';
        // Simulate a successful deletion for demonstration purposes
// $response = ['success' => true];

// Return the response as JSON
// echo json_encode($response);
//         echo '<script type="text/javascript">
//         swal("Deleted!", "Supplier Successfully Deleted" , "success");
//           </script>';

//         echo '<script>
//          setTimeout(function(){
//          window.location.href = "Supplier_View.php";
//         }, 8000);
//         </script>';
