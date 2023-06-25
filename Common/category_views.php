<?php

//Auth employee
require('pages/Auth.php');


require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');

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



<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">

            <h1>
              <span><i class="bi bi-table me-2"></i></span> Employee Registration
            </h1>
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
                  <input type="text" placeholder="Enter Code " required class="form-control" name="emp_code" id="codeInput" readonly />
                </div>
              </div>


              <script>
                function generateUniqueCode() {
                  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                  var counter = 1;
                  var code = 'EM';

                  function incrementCounter() {
                    var number = counter.toString().padStart(2, '0');
                    counter++;
                    return number;
                  }
                  code += incrementCounter();
                  for (var i = 0; i < 3; i++) {
                    code += characters.charAt(Math.floor(Math.random() * characters.length));
                  }
                  document.getElementById('codeInput').value = code;
                }
                // Automatically generate code when the page loads
                window.addEventListener('load', generateUniqueCode);
              </script>



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
                <label for="gender" class="col-sm-2 col-form-label">Image :</label>
                <div class="col-sm-5">
                  <div id="thumbnailContainer" style="width:20%">
                    <img id="preview" src="#" alt="Image Preview" style="width: 100px;">
                  </div>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1 accept=" image/*" onchange="previewImage(event)" placeholder="s " name="proimg" />
                </div>
              </div>

              <script>
                function previewImage(event) {
                  var reader = new FileReader();
                  var imageElement = document.getElementById("preview");

                  reader.onload = function() {
                    imageElement.src = reader.result;
                  }

                  if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                  }
                }
              </script>
             

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Email Address:</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Email Address " required class="form-control" name="username" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Postal Address :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Postal Address " required class="form-control" name="address" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">NIC :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter NIC " required class="form-control" name="nic" />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Land :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Land Phone Number " required class="form-control" name="land" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Mobile1 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Mobile 1 " required class="form-control" name="mobile1" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Mobile2 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Mobile 2 " required class="form-control" name="mobile2" />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Password :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Password " required class="form-control" name="password" />
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
                  <button type="submit" class="btn btn-primary" value="Submit">Register</button>
                </div>
              </div>
            </form>
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


  // Retrieve the uploaded image

  $image = $_FILES['proimg']['name'];

  // Read the image content
  // $imageData = file_get_contents($image);


  $employeeInsertQuery = "INSERT INTO employee (code, nametitle_id, callingname, fullname,
  civilstatus_id, photo, dob, gender_id, nic, mobile, land, email, address ,dorecruite, employeestatus_id) 
  VALUES ('$emp_code', '$nametitle', '$callname',' $fullname',' $civilstatus',' $image',
  '$dob','$gender','$nic','$mobile1','$land','$username','$address','$dorecruite','$employeestatus_id')";


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