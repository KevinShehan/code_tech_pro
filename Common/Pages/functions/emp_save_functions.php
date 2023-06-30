<?php
// Retrieve data from the SQL table
$query_gender = "SELECT id,name FROM gender";
$query_civilstatus = "SELECT id,name FROM civilstatus";
$query_nametitle = "SELECT id,name FROM nametitle";
$query_role = "SELECT id,name FROM role";
$query_employeestatus = "SELECT id,name FROM employeestatus";


$result_gender = mysqli_query($con, $query_gender);
$result_civilstatus = mysqli_query($con, $query_civilstatus);
$result_nametitle = mysqli_query($con, $query_nametitle);
$result_role = mysqli_query($con, $query_role);
$result_employeestatus = mysqli_query($con, $query_employeestatus);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  // Access the submitted values
  $emp_code = $_POST['emp_code'];

  //should get values from foreign tables id's
  $gender = $_POST['gender'];
  $civilstatus = $_POST['civilstatus'];
  $nametitle = $_POST['nametitle'];


  $callname = $_POST['callname'];
  $fullname = $_POST['fullname'];
  // $proimg = $_POST['proimg'];
  $image = $_FILES['proimg']['name'];
  $image_tmp = $_FILES['proimg']['tmp_name'];

  $dob = $_POST['dob'];


  $username = $_POST['username'];
  $address = $_POST['address'];
  $password = $_POST['password'];

  $nic = $_POST['nic'];
  $land = $_POST['land'];
  $mobile1 = $_POST['mobile1'];
  $mobile2 = $_POST['mobile2'];
  $role = $_POST['role'];
  $dorecruite = $_POST['dorecruite'];
  $employeestatus_id = $_POST['employeestatus'];


  // Retrieve the uploaded image

  $image = $_FILES['proimg']['name'];

  // Read the image content
  // $imageData = file_get_contents($image);



  // Process and save the image
  $targetDir = "db_data/employee/"; // Path to the folder where you want to save the images
  $fileName = basename($_FILES["proimg"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  // Check if the file is an actual image
  $check = getimagesize($_FILES["proimg"]["tmp_name"]);


  if ($check !== false) {
    if (move_uploaded_file($_FILES["proimg"]["tmp_name"], $targetFilePath)) {


      $employeeInsertQuery = "INSERT INTO employee (code, nametitle_id, callingname, fullname,
    civilstatus_id, photo, dob, gender_id, nic, mobile, land, email, address ,dorecruite, employeestatus_id) 
    VALUES ('$emp_code', '$nametitle', '$callname',' $fullname',' $civilstatus','$targetFilePath',
    '$dob','$gender','$nic','$mobile1','$land','$username','$address','$dorecruite','$employeestatus_id')";
    }
  }

  // $stmt1 = $con->prepare($sql1);
  // $stmt1->bind_param("ss", $username,  $hashedPassword);
  // $stmt1->execute();


  // Execute the user registration query
  if (mysqli_query($con, $employeeInsertQuery)) {
    // Get the inserted user's ID
    $userId = mysqli_insert_id($con);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userInsertQuery = "INSERT INTO user (username, password,Employee_id, role_id) VALUES ('$username','$hashedPassword','$userId','$role' )";

    // Execute the employee registration query
    if (mysqli_query($con, $userInsertQuery)) {

      echo "
      <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' ></script>
      <script>
               swal({
               title: 'Success!',
              text: 'User Saved successfully.',
               icon: 'success',
               }).then(function() {
             // Redirect to view.php
              window.location.href = 'emp_view.php';
            });
        </script>
          ";
    } else {
      echo "
      <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' ></script>
      <script>
               swal({
               title: 'Error!',
              text: 'User Not Saved !.',
               icon: 'success',
               }).then(function() {
             // Redirect to view.php
              window.location.href = 'emp_view.php';
            });
        </script>
          ";
    }
  } else {
    echo "
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' ></script>
    <script>
             swal({
             title: 'Error !',
            text: 'Query executed successfully.',
             icon: 'success',
             }).then(function() {
           // Redirect to view.php
            window.location.href = 'emp_view.php';
          });
      </script>
        ";
  }
}

//Close connection

?>