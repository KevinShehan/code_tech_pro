<?php
//register employee
include('config/dbconnection.php');
include('pages/Header.php');

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
// $result_nametitle = mysqli_query($con, $query_nametitle);
// $result_role = mysqli_query($con, $query_role);
// $result_employeestatus = mysqli_query($con, $query_employeestatus);




include('config/dbconnection.php');
$username=$_SESSION['username'];


$query="SELECT * from employee where email='$username'";
$result= mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $callingname = $row['callingname'];
  $nametitle = $row['nametitle_id'];
}

$query_nametitle="SELECT nametitle.name from nametitle JOIN employee ON nametitle.id=employee.nametitle_id where nametitle_id='$nametitle'";
$result_nametitle= mysqli_query($con, $query_nametitle);
$row_nametitle = mysqli_fetch_assoc($result_nametitle);
$nametitle_new = $row['nametitle'];




?>

<?php
include('Top_nav.php');
include('Side_nav.php');
?>

<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>
              <span>
                <i class="fas fa-store"></i>
              </span> Profile View
            </h4>
          </div>
          <div class="card-body">

            <a href="dashboard.php" class="btn btn-purple">
              <i class="fas fa-arrow-left"></i>
              Return Dashboard
            </a>

            <div class="row mb-3">
              <div class="col-sm-4 text-end font-weight-bold">
                <label for="gender" class="col-form-label  ">
                  <b> Name Title: </b>
                </label>
              </div>

              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle_new) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b> Name: </b></label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Description:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Logo:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Gender:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Contact Number1:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Contact Number 2:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Address:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly >
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  E-mail:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly >
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  E-mail:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($callingname) ?>" readonly>
              </div>
            </div>




            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Supplier Status:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Supplier Type:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle) ?>" readonly>
              </div>
            </div>


            <!-- Remaining label and input field pairs -->

            <div class="form-group row mb-3">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-success" name="submit">Edit User</button>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <?php

          include('config/dbconnection.php');
          // Assuming you have established a database connection
          $username = $_SESSION["username"];
          // Fetch the employee data from the database

          $query = "SELECT employee.photo FROM employee JOIN user ON employee.id = user.employee_id WHERE user.username = '$username'";
          $result = mysqli_query($con, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['photo'];

            // Step 3: Create the image tag
            $imageTag = '<img src="' . $imagePath . '" alt="profile _image" class="shadow">';

            // Step 4: Output the image tag
            echo $imageTag;
          } else {
            echo "Image not found.";
          }

          ?>
        </div>
      </div>
    </div>
  </div>
</main>



<style>
  .btn-purple {
    color: #fff;
    background-color: purple;
    border-color: purple;
  }

  .btn-purple:hover {
    color: #fff;
    background-color: darkviolet;
    border-color: darkviolet;
  }

  body {
    background-color: lightcyan;
  }
</style>

<?php
include('pages/Footer.php');
?>
