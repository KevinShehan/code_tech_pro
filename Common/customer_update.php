<?php
//update customer
// require('pages/Auth.php');

require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');

require('pages/js/customer_save_js.php');
// require('pages/css/customer_save_css.php');
// require('pages/functions/customer_save_functions.php');
?>


<?php
// Retrieve data from the SQL table
$query_gender = "SELECT id,name FROM gender";
$query_nametitle = "SELECT id,name FROM nametitle";
$query_customerstatus = "SELECT id,name FROM customertype";

$result_gender = mysqli_query($con, $query_gender);
$result_nametitle = mysqli_query($con, $query_nametitle);
$result_customerstatus = mysqli_query($con, $query_customerstatus);
// Retrieve the supplier ID from the URL parameter
$cusId = $_GET['id'];

// Fetch the relevant data of the supplier based on the ID
$query = "SELECT * from customer where id='$cusId'";
$CustomerData = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($CustomerData)) {
  $code = $row['code'];
  $nametitle = $row['nametitle_id'];
  $name = $row['name'];
  $gender_id = $row['gender_id'];
  $contact1 = $row['Mobile1'];
  $address = $row['address'];
  $description = $row['description'];



  $nic = $row['nic'];
  $customertype_id = $row['customertype_id'];
}


$query2 = "SELECT nametitle.name from nametitle where id=' $nametitle'";
$result2 = mysqli_query($con, $query2);
$row = mysqli_fetch_assoc($result2);
$nametitlenew = $row['name'];


$query4 = "SELECT gender.name from gender where id='$gender_id'";
$result4 = mysqli_query($con, $query4);
$row = mysqli_fetch_assoc($result4);
$gendernew = $row['name'];


$query5 = "SELECT customertype.name from customertype where id='$customertype_id'";
$result5 = mysqli_query($con, $query5);
$row = mysqli_fetch_assoc($result5);
$customertypenew = $row['name'];

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>
              <span>
                <i class="fas fa-user"></i>
              </span> View Single Customer
            </h4>
          </div>
          <div class="card-body">

            <a href="viewusers.php" class="btn btn-purple">
              <i class="fas fa-arrow-left"></i>
              Return Employee List
            </a>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Code:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($code) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end ">
                <label for="gender" class="col-form-label  font-weight-bold">
                  <b> Name Title: </b>
                </label>
              </div>

              <div class="col-sm-8">

                <select class="form-control" name="nametitle">
                  <?php
                  // Loop through the query result and display data within <option> tags

                  while ($row = mysqli_fetch_assoc($result_nametitle)) {
                    $selected = ($row['name'] === $nametitlenew) ? 'selected' : ''; // Check if the current option matches the $name variable
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                  }
                  ?>
                </select>

              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>Full Name:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($name) ?>">

              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Gender:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <select class="form-control" name="gender">
                  <?php
                  // Loop through the query result and display data within <option> tags
                  while ($row = mysqli_fetch_assoc($result_gender)) {
                    $selected = ($row['name'] === $gendernew) ? 'selected' : ''; // Check if the current option matches the $name variable
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Mobile: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($contact1) ?>">
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Address: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($address) ?>">
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>NIC: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nic) ?>">
              </div>
            </div>




            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Description: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($description) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>Customer Type: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <select class="form-control" name="customertype">
                  <?php
                  while ($row = mysqli_fetch_assoc($result_customerstatus)) {
                    $selected = ($row['name'] === $customertypenew) ? 'selected' : ''; // Check if the current option matches the $name variable
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>


            <!-- Remaining label and input field pairs -->

            <div class="form-group row mb-3">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-success" name="submit"> Update Customer </button>
              </div>
            </div>
          </div>
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
require('pages/footer.php');
?>