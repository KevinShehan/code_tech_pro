<?php
require('pages/Auth.php');
//Profile
include('config/dbconnection.php');
include('pages/Header.php');
include('Top_nav.php');
include('Side_nav.php');

require('pages/functions/profile_functions.php');
require('pages/css/profile_css.php');
?>

<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>
              <span>
                <i class="fas fa-user"></i>
              </span> Profile View
            </h4>
          </div>
          <div class="card-body">

            <a href="dashboard.php" class="btn btn-purple btn-sm">
              <i class="fas fa-arrow-left"></i>
              Return Dashboard
            </a>

            <!-- <div class="row mb-3">
              <div class="col-sm-4 text-end font-weight-bold">
                <label for="gender" class="col-form-label  ">
                  <b> Name Title: </b>
                </label>
              </div>

              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php //echo ($nametitle_new) 
                                                                              ?>" readonly>
              </div>
            </div> -->

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Employee Codel: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($code) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b> Name: </b></label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($concatenatedValue) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>NIC: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nic) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Date of Birth: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($dob) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>CivilStatus: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($civilstatus_new) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Gender: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($gender_new) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Mobile Number:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($mobile) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Land Number :</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($land) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>Address:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($address) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>E-mail: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($email) ?>" readonly>
              </div>
            </div>







            <!-- <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b>User Status:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle) ?>" readonly>
              </div>
            </div> -->

            <!-- Remaining label and input field pairs -->

            <div class="form-group row mb-3">
              <div class="offset-sm-4 col-sm-8">
                <a href="profile_edit.php" class="btn btn-success" name="submit">Edit Profile</a>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <?php
          proimage($con);
          ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include('pages/Footer.php');
?>