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
<?php
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            
            <h1>
            <span><i class="bi bi-table me-2"></i></span> Employee Registration</h1>
          </div>
          <div class="card-body">

            <style>
              body {
                background-color: lightcyan;
              }
            </style>
            <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group row" id="custom-input">
                <label for="email" class="control-label col-sm-2">Code :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Code " required class="form-control" name="emp_code" id="emp_code" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
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

              <div class="form-group row" id="custom-input">
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

              <div class="form-group row" id="custom-input">
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


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Call Name :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Calling Name " required class="form-control" name="callname" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
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

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Date of Birth :</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control datepicker" placeholder="Select a date" name="dob">
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">email :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="username" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Address :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="address" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Password :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="password" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">NIC :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="nic" />
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Land :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="land" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Mobile1 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="mobile1" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Mobile2 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" name="mobile2" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
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


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Date of Recruite :</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control datepicker" placeholder="Select a date" name="dorecruite">
                </div>
              </div>

              <div class="form-group row" id="custom-input">
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

              <div class="form-group row" id="custom-input">
                <div class="col-sm-5 offset-sm-2">
                  <input type="submit" class="btn btn-primary" value="Submit">Register</input>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>
<script>
  document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    Swal.fire({
      title: "Confirm Submission",
      text: "Are you sure you want to submit the form?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Submit",
      cancelButtonText: "Cancel"
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms submission, submit the form
        document.getElementById("myForm").submit();
      }
    });
  });
</script>
<?php
require('pages/footer.php');
?>

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



  // $user_id = "SELECT id FROM user WHERE username = '$username'";


  // $profilePicturePath = "";
  // if ($_FILES["proimg"]["size"] > 0) {
  //   $targetDir = "uploads/";
  //   $profilePicturePath = $targetDir . basename($_FILES["proimg"]["name"]);
  //   move_uploaded_file($_FILES["proimg"]["tmp_name"], $profilePicturePath);
  // }

  // Save customer information to the database
  // $sql = "INSERT INTO customers (name, email, profile_picture) VALUES (?, ?, ?)";
  // $stmt = $conn->prepare($sql);
  // $stmt->execute([$name, $email, $profilePicturePath]);





  // $sql2 = "INSERT INTO employee ( code, nametitle_id ,callname, fullname, civilstatus_id, photo, 
  // dob, gender_id, nic, land, mobile1, mobile2, email, address, role_id, dorecruite, 
  // employeestatus_id, user_id, tocreation) VALUES
  //  ($emp_code,
  //   $nametitle,
  //   $callname,
  //   $fullname,
  //   $civilstatus,
  //   $proimg,
  //   $dob,
  //   $gender,
  //   $nic,
  //   $land,
  //   $mobile1,
  //   $mobile2,
  //   $username,
  //   $address,
  //   $role,
  //   $dorecruite,
  //   $employeestatus_id,
  //   $user_id,
  //   CURRENT_TIMESTAMP)";



  // $stmt2 = $con->prepare($sql2);
  // $stmt->execute([$name, $email, $profilePicturePath]);

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