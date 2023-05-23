<?php
//register employee
include('config/dbconnection.php');

// Get the database Connection
// $con = getDBConnection();

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script>
    function generatePassword() {
      var length = 10; // Change this value to adjust the password length
      var charset =
        "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-+=<>?"; // Characters to include in the password
      var password = "";

      for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * charset.length);
        password += charset.charAt(randomIndex);
      }

      document.getElementById("passwordInput").value = password;
    }
  </script>
  <title>Code Technologies</title>
</head>

<body>
  <style>
    body {
      background-color: lightcyan;
    }
  </style>
  <h1>Employee Registration</h1>
  <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">>
    <div class="form-group row">
      <label for="email" class="control-label col-sm-2">Code :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Code " required class="form-control" name="emp_code" id="emp_code" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Gender :</label>
      <div class="col-sm-5">
        <select class="form-control" name="gender">
          <?php
          // Loop through the query result and display data within <option> tags
          while ($row = mysqli_fetch_assoc($result_gender)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Civil Status :</label>
      <div class="col-sm-5">
        <select class="form-control" name="civilstatus">
          <?php
          // Loop through the query result and display data within <option> tags
          while ($row = mysqli_fetch_assoc($result_civilstatus)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Name Title :</label>
      <div class="col-sm-5">
        <select class="form-control" name="nametitle">
          <?php
          // Loop through the query result and display data within <option> tags
          while ($row = mysqli_fetch_assoc($result_nametitle)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>


    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Call Name :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Calling Name " required class="form-control" name="callname" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Full Name</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Image :</label>
      <div class="col-sm-5">
        <div id="thumbnailContainer"></div>
        <input type="file" class="form-control-file" id="exampleFormControlFile1 accept=" image/*" onchange="previewImage(event)" placeholder="s " name="proimg" />
      </div>
    </div>

    <script>
      // Image Preview Script
      function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
          var img = document.createElement("img");
          img.src = reader.result;
          img.classList.add("thumbnail");

          var container = document.getElementById("thumbnailContainer");
          container.innerHTML = "";
          container.appendChild(img);
        };

        reader.readAsDataURL(input.files[0]);
      }
    </script>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Date of Birth :</label>
      <div class="col-sm-5">
        <input type="date" class="form-control datepicker" placeholder="Select a date" name="dob">
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">email :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" name="username" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Address :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" name="address" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Password :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" name="password" />
      </div>


      <div class="form-group row">
        <label for="gender" class="col-sm-2 col-form-label">NIC :</label>
        <div class="col-sm-5">
          <input type="text" placeholder="Enter Full Name " required class="form-control" name="nic" />
        </div>
      </div>

    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Land :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" name="land" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Mobile1 :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" name="mobile1" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Mobile2 :</label>
      <div class="col-sm-5">
        <input type="text" placeholder="Enter Full Name " required class="form-control" name="mobile2" />
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Role :</label>
      <div class="col-sm-5">
        <select class="form-control" name="role">
          <?php
          // Loop through the query result and display data within <option> tags
          while ($row = mysqli_fetch_assoc($result_role)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>


    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Date of Recruite :</label>
      <div class="col-sm-5">
        <input type="date" class="form-control datepicker" placeholder="Select a date" name="dorecruite">
      </div>
    </div>

    <div class="form-group row">
      <label for="gender" class="col-sm-2 col-form-label">Employee Status :</label>
      <div class="col-sm-5">
        <select class="form-control" name="employeestatus">
          <?php
          // Loop through the query result and display data within <option> tags
          while ($row = mysqli_fetch_assoc($result_employeestatus)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-5 offset-sm-2">
        <button type="submit" class="btn btn-primary" onclick="generatePassword()">Register</button>
      </div>
    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>

<?php

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

  echo "Name: " . $username . "<br>";
  echo "Email: " . $password;
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql1 = "INSERT INTO user (username, password) VALUES (?, ?)";
  $stmt1 = $con->prepare($sql1);
  $stmt1->bind_param("ss", $username,  $hashedPassword);
  $stmt1->execute();



  $user_id = "SELECT id FROM user WHERE username = '$username'";


  $profilePicturePath = "";
  if ($_FILES["proimg"]["size"] > 0) {
    $targetDir = "uploads/";
    $profilePicturePath = $targetDir . basename($_FILES["proimg"]["name"]);
    move_uploaded_file($_FILES["proimg"]["tmp_name"], $profilePicturePath);
  }

  // Save customer information to the database
  $sql = "INSERT INTO customers (name, email, profile_picture) VALUES (?, ?, ?)";
  // $stmt = $conn->prepare($sql);
  // $stmt->execute([$name, $email, $profilePicturePath]);





  $sql2 = "INSERT INTO employee ( code, nametitle_id ,callname, fullname, civilstatus_id, photo, 
  dob, gender_id, nic, land, mobile1, mobile2, email, address, role_id, dorecruite, 
  employeestatus_id, user_id, tocreation) VALUES
   ($emp_code,
    $nametitle,
    $callname,
    $fullname,
    $civilstatus,
    $proimg,
    $dob,
    $gender,
    $nic,
    $land,
    $mobile1,
    $mobile2,
    $username,
    $address,
    $role,
    $dorecruite,
    $employeestatus_id,
    $user_id,
    CURRENT_TIMESTAMP)";



  $stmt2 = $con->prepare($sql2);
  $stmt->execute([$name, $email, $profilePicturePath]);

  // $stmt2->bind_param(
  //   "sssssbssssssssssssss",


  // $result = mysqli_query($con, $sql2); // Replace $connection with your database connection variable

  // Check if the query was successful
  // if ($result) {
  //     echo "Current date and time stored successfully.";
  // } else {
  //     echo "Error storing current date and time: " . mysqli_error($connection);
  // }
  // );
  // $sql2->execute();

  // if ($stmt2->affected_rows > 0) {
  //   echo "Data saved successfully!";
  // } else {
  //   echo "Error saving data: " . $stmt2->error;
  // }

  // Close statement
  $stmt1->close();
  // $stmt2->close();
}

//Close connection
$con->close();


?>