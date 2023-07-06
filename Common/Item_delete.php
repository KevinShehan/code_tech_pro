<?php
 // require('pages/Auth.php');
 require('config/dbconnection.php');

 $response = array();
 
 if (isset($_GET['id'])) {
     $id = $_GET['id'];
     $delete_query = "DELETE FROM item WHERE id = '$id'";
     $result = mysqli_query($con, $delete_query);
 
     if ($result) {
         // Deletion is successful
         $response['success'] = true;
     } else {
         // Deletion failed
         $response['success'] = false;
     }
 } else {
     // If the row ID is not provided, return an error response
     $response['success'] = false;
 }
 
 // Return the response as JSON
 echo json_encode($response);

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








?>