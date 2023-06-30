<?php
//register supplier

// use LDAP\Result;

require('pages/Auth.php');
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');

require('pages/functions/change_pw_functions.php');
require('pages/css/change_pw_css.php');
require('pages/js/change_pw_js.php');
?>

<!-- HTML and JavaScript Part -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h4>
              <span><i class="fas fa-key"></i></span> Change Password
            </h4>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="passwordForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-3 col-form-label text-end">Current Password:<span style="color: red;">*</span></label>
                <div class="col-sm-5">
                  <input type="password" id="currentPassword" name="currentPassword" class="form-control form-control-sm" placeholder="Enter current password">
                  <div id="currentPasswordError" class="alert alert-danger d-none  alert-sm"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-3 col-form-label text-end">New Password :<span style="color: red;">*</span></label>
                <div class="col-sm-5">
                  <input type="password" id="newPassword" name="newPassword" class="form-control form-control-sm" placeholder="Enter new password">
                  <div id="newPasswordError" class="text-danger"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-3 col-form-label text-end">Reenter Password :<span style="color: red;">*</span></label>
                <div class="col-sm-5">
                  <input type="password" id="reenterPassword" name="reenterPassword" class="form-control form-control-sm" placeholder="Re-enter new password">
                  <div id="reenterPasswordError" class="text-danger"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <div class="col-sm-5 offset-sm-6"> <!-- Add offset-sm-7 class for right alignment -->
                  <button type="submit" class="btn btn-purple btn-sm">
                    <i class="fas fa-key"></i></span>
                    Change Password</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<!-- Backend Part -->
<?php
require('pages/footer.php');
?>