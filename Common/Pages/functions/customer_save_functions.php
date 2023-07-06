<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_SESSION["username"];
  // Execute the SQL query
  $query2 = "SELECT user.id from user WHERE user.username = '$username'";
  $result2 = mysqli_query($con, $query2);
  $row2 = mysqli_fetch_assoc($result2);
  // Check if a row was returned
  if ($row2) {
    $user_id = $row2['id'];
    $_SESSION['user_id'] = $user_id;
    // echo $user_id ;
  }
  // else {
  //   echo "Failed";
  // }

  // Access the submitted values
  $cus_code = $_POST['cus_code'];

  //should get values from foreign tables id's
  $nametitle = $_POST['nametitle'];
  $fullname = $_POST['fullname'];
  $nic = $_POST['nic'];
  $gender = $_POST['gender'];
  $contact1 = $_POST['mobile1'];
  $address = $_POST['address'];



  $customertype = $_POST['customertype'];
  $description = $_POST['description'];

  $sql = "INSERT INTO customer ( code, nametitle_id, name,gender_id, nic, mobile1,
    address, user_id,description,customertype_id) VALUES ('$cus_code',$nametitle, 
     '$fullname','$gender','$nic','$contact1','$address','$user_id','$description',
     $customertype)";
  $result = mysqli_query($con, $sql);

  // Print the query statement
  // echo "Query: " . $sql . "<br>";
  if ($result) {
    // Display SweetAlert success message
    echo "
<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' ></script>
<script>
    swal({
        title: 'Success!',
        text: 'Query executed successfully.',
        icon: 'success',
    }).then(function() {
        // Redirect to view.php
        window.location.href = 'customer_view.php';
    });
</script>
";
    //Close connection
  } else {
    // Display SweetAlert error message
    echo "
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script>
        $(document).ready(function() {
            swal({
                title: 'Error!',
                text: 'Customer Not Saved.',
                icon: 'error',
            });
        });
    </script>
    ";
  }
}
$con->close();
?>