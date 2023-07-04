<?php

//Auth employee
require('pages/Auth.php');


require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');

require('pages/js/emp_save_js.php');
require('pages/css/emp_save_css.php');
require('pages/functions/emp_save_functions.php');

?>
<script>
  function autoFillBirthday() {
  var nicNumber = document.getElementById("nicNumber").value;

  if (nicNumber.length === 10) {
    var year = parseInt(nicNumber.substr(0, 2));
    var days = parseInt(nicNumber.substr(2, 3));
    var isMale = parseInt(nicNumber.substr(9, 1)) < 5;

    var birthYear = year < 20 ? 2000 + year : 1900 + year;
    var birthMonth = "";
    
    if (days > 500) {
      birthYear += 1;
      days -= 500;
    }

    if (days <= 31) {
      birthMonth = "01";
    } else if (days <= 59) {
      birthMonth = "02";
      days -= 31;
    } else if (days <= 90) {
      birthMonth = "03";
      days -= 59;
    }
    
    // ... Repeat the above for the remaining months (04 to 12)

    var birthDate = birthYear + "-" + birthMonth.padStart(2, '0') + "-" + days.toString().padStart(2, '0');
    document.getElementById("birthday").value = birthDate;
  } else {
    document.getElementById("birthday").value = ""; // Clear the birthday field if NIC number is invalid
  }
}

</script>
<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            <h4>
              <span><i class="fas fa-user"></i>
              </span> Employee Registration
            </h4>
          </div>

          <div class="card-body">
            <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

              <div class="form-group row" id="custom-input">
                <label for="email" class="control-label col-sm-2 text-end">Code :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Code " required class="form-control" name="emp_code" id="codeInput" readonly />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Name Title:</label>
                <div class="col-sm-5">
                  <select class="selectpicker custom-selectpicker" name="nametitle">
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
                <label for="gender" class="col-sm-2 col-form-label  text-end">Call Name:</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Calling Name" required class="form-control" name="callname" id="callname" />
                  <div id="callname-validation" class="invalid-feedback">
                    Please enter a valid Call Name with only alphabetic letters (no special characters or spaces).
                  </div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Full Name</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" />
                  <div id="callname-validation" class="invalid-feedback">
                    Please enter a valid Call Name with only alphabetic letters (no special characters or spaces).
                  </div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Gender :</label>
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
                <label for="gender" class="col-sm-2 col-form-label  text-end">Civil Status :</label>
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
                <label for="gender" class="col-sm-2 col-form-label  text-end">Image :</label>
                <div class="col-sm-5">
                  <div id="thumbnailContainer" style="width:20%">
                    <img id="preview" src="#" alt="Image Preview" style="width: 100px; display: none;">
                  </div>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="image/*" onchange="previewImage(event)" placeholder="s " name="proimg" />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Date of Birth:</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control datepicker" placeholder="Select a date"  id="birthday" name="birthday" readonly />
                  <div id="dob-validation" class="invalid-feedback">
                    Please enter a valid Date of Birth.
                  </div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Email Address:</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Email Address" required class="form-control" name="username" id="email" />
                  <div id="email-validation" class="invalid-feedback">
                    Please enter a valid Email Address.
                  </div>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Postal Address :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Postal Address " required class="form-control" name="address" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">NIC :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter NIC " required class="form-control" id="nicNumber" name="nicNumber" oninput="autoFillBirthday()" required />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Land :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Land Phone Number " required class="form-control" name="land" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Mobile1 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Mobile 1 " required class="form-control" name="mobile1" />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Mobile2 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Mobile 2 " required class="form-control" name="mobile2" />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Password :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Password " required class="form-control" name="password" />
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Role :</label>
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
                <label for="gender" class="col-sm-2 col-form-label  text-end">Date of Recruite :</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control datepicker" placeholder="Select a date" name="dorecruite">
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">Employee Status :</label>
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

<?php
require('pages/footer.php');
?>