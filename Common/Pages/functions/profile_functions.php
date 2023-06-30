<?php


// Get the database Connection
// $con = getDBConnection();

// Retrieve data from the SQL table
// $query_gender = "SELECT id,name FROM gender";
// $query_civilstatus = "SELECT id,name FROM civilstatus";
// $query_nametitle = "SELECT id,name FROM nametitle";
// $query_role = "SELECT id,name FROM role";
// $query_employeestatus = "SELECT id,name FROM employeestatus";
// $result_gender = mysqli_query($con, $query_gender);
// $result_civilstatus = mysqli_query($con, $query_civilstatus);


include('config/dbconnection.php');
$username = $_SESSION['username'];


$query = "SELECT * from employee where email='$username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $callingname = $row['callingname'];
  $fullname = $row['fullname'];
  $nametitle = $row['nametitle_id'];
  $civilstatus = $row['civilstatus_id'];
  $gender = $row['gender_id'];
  $email = $row['email'];
  $address = $row['address'];
  $mobile = $row['mobile'];
  $land = $row['land'];
  $nic = $row['nic'];
  $dob = $row['dob'];
  $code = $row['code'];

  $query_nametitle = "SELECT name FROM nametitle WHERE id='$nametitle'";
  $result_nametitle = mysqli_query($con, $query_nametitle);
  $row_nametitle = mysqli_fetch_assoc($result_nametitle);
  $nametitle_new = $row_nametitle['name'];



  $query_civilstatus = "SELECT name FROM civilstatus WHERE id='$civilstatus'";
  $result_civilstatus = mysqli_query($con, $query_civilstatus);
  $row_civilstatus = mysqli_fetch_assoc($result_civilstatus);
  $civilstatus_new = $row_civilstatus['name'];


  $query_gender = "SELECT name FROM gender WHERE id='$gender'";
  $result_gender = mysqli_query($con, $query_gender);
  $row_gender = mysqli_fetch_assoc($result_gender);
  $gender_new = $row_gender['name'];

  $query_gender = "SELECT name FROM gender WHERE id='$gender'";
  $result_gender = mysqli_query($con, $query_gender);
  $row_gender = mysqli_fetch_assoc($result_gender);
  $gender_new = $row_gender['name'];



  $concatenatedValue = $nametitle_new.' ' . $fullname;
}


function proimage($con){
      // Assuming you have established a database connection
      $username = $_SESSION["username"];

      // Fetch the employee data from the database
      $query = "SELECT employee.photo FROM employee JOIN user ON employee.id = user.employee_id  WHERE user.username = '$username'";
      $result = mysqli_query($con, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['photo'];

        if (file_exists($imagePath)) {
          // Step 3: Create the image tag
          $imageTag = '<img src="' . $imagePath . '" alt="profile_image" style="width:150px;height:150px;  object-fit: cover; float: left;" class="shadow">';
        } else {
          $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:150px;height:150px; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
        }
      } else {
        $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:150px;height:150px; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
      }

      // Step 4: Output the image tag
      echo $imageTag;
}

?>