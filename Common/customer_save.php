<?php
//Auth employee
require('pages/Auth.php');
//register employee
include('config/dbconnection.php');

// Retrieve data from the SQL table
$query_gender = "SELECT id,name FROM gender";
$query_nametitle = "SELECT id,name FROM nametitle";
$query_customerstatus = "SELECT id,name FROM customertype";

$result_gender = mysqli_query($con, $query_gender);
$result_nametitle = mysqli_query($con, $query_nametitle);
$result_customerstatus = mysqli_query($con, $query_customerstatus);

include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');



require('pages/js/customer_save_js.php');
require('pages/css/customer_save_css.php');
require('pages/functions/customer_save_functions.php');
?>


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h3>
              <span>
                <i class="fas fa-user-friends"></i>
              </span>
              Customer Registration
              <?php ?>
            </h3>
          </div>
          <div class="card-body">

            <a href="customer_view.php" class="btn btn-purple" style="color: white;">
              <i class="fas fa-arrow-left"></i>
              Return Customer List
            </a>

            <form class="form-horizontal mt-2" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group row" id="custom-input">
                <label for="email" class="control-label col-sm-2 text-end" style="font-weight: bold;">Code :</label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Code " required class="form-control" name="cus_code" id="codeInput" readonly />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Name Title :</label>
                <div class="col-sm-10">
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
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Name :<span style="color: red;">*</span></label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" />
                  <div class="alert alert-danger mt-2" id="name-error" style="display: none;">Please enter a valid name (only letters and spaces).</div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">NIC :<span style="color: red;">*</span></label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter NIC " required class="form-control" name="nic" id="nic" />
                  <div class=" erro alert alert-danger mt-2" id="nic-error" style="display: none;">Please Enter Correct NIC</div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Gender :</label>
                <div class="col-sm-10">
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
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Address :<span style="color: red;">*</span>
                </label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Address" required class="form-control" name="address" id="address" />
                  <div class="alert alert-danger mt-2" id="address-error" style="display: none;">Address Field Cannot BE nulled.</div>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Mobile :<span style="color: red;">*</span>
                </label>
                <div class="col-sm-10">
                  <input type="text" placeholder="Enter Mobile1" required class="form-control" name="mobile1" id="mobile1" />
                  <div class="alert alert-danger mt-2" id="mobile1-error" style="display: none;">Please enter a valid mobile number.</div>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Description :</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="message" name="description" rows="4" cols="50"></textarea>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label text-end" style="font-weight: bold;">Customer Type :</label>
                <div class="col-sm-10">
                  <select class="form-control" name="customertype">
                    <?php
                    // Loop through the query result and display data within <option> tags
                    while ($row = mysqli_fetch_assoc($result_customerstatus)) {
                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <div class="col-sm-5 offset-sm-2">
                  <button type="submit" class="btn btn-primary btn-purple" value="Register">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<?php
require('pages/footer.php');


?>