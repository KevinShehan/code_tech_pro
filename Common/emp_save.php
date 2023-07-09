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
            <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="validateForm(event); return false;">

              <div class="form-group row" id="custom-input">
                <label for="email" class="control-label col-sm-2 text-end"><b>Code :</b> </label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Code " required class="form-control" name="emp_code" id="codeInput" readonly />
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b> Name Title :</b></label>
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
                <label for="gender" class="col-sm-2 col-form-label  text-end">
                  <b> Call Name:</b>
                  <span style="color: red">*</span></label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Calling Name" required class="form-control" name="callname" id="callname" required />
                  <div id="callname-validation" class="invalid-feedback">
                    Please enter a valid Call Name with only alphabetic letters (no special characters or spaces).
                  </div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b>Full Name :</b>
                  <span style="color: red">*</span></label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Full Name " required class="form-control" id="fullname" name="fullname" required />
                  <div id="callname-validation" class="invalid-feedback">
                    Please enter a valid Call Name with only alphabetic letters (no special characters or spaces).
                  </div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">
                  <b>Gender :</b> </label>
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
                <label for="nicNumber" class="col-sm-2 col-form-label text-end"><b>NIC:</b></label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter NIC" required class="form-control" id="nicNumber" name="nic" oninput="autoFillBirthday()" required />
                  <div class="invalid-feedback">Please enter a valid Sri Lankan NIC number.</div>
                  <div class="valid-feedback">Valid NIC number!</div>
                </div>
              </div>





              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b>Civil Status :</b> </label>
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
                <label for="exampleFormControlFile1" class="col-sm-2 col-form-label text-end"><b>Image:</b></label>
                <div class="col-sm-5">
                  <div id="thumbnailContainer" style="width: 20%">
                    <img id="preview" src="#" alt="Image Preview" style="width: 100px; display: none;">
                  </div>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="image/*" onchange="previewImage(event)" name="proimg" required />
                  <div class="invalid-feedback">Please select an image file.</div>
                  <div class="valid-feedback">Valid image selected!</div>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b>Date of Birth :</b> </label>
                <div class="col-sm-5">
                  <input type="date" class="form-control datepicker" placeholder="Select a date" id="birthday" name="dob" readonly required />
                  <div id="dob-validation" class="invalid-feedback">
                    Please enter a valid Date of Birth.
                  </div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b>Email Address :</b> </label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Email Address" required class="form-control" name="username" id="email" required />
                  <div id="email-validation" class="invalid-feedback">
                    Please enter a valid Email Address.
                  </div>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="address" class="col-sm-2 col-form-label text-end"><b>Postal Address:</b></label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Postal Address" required class="form-control" name="address" required />
                  <div class="invalid-feedback">Please enter a postal address.</div>
                  <div class="valid-feedback">Valid postal address!</div>
                </div>
              </div>


           


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b>Land :</b> </label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Land Phone Number " required class="form-control" name="land" id="land" required />
                  <div class="invalid-feedback">Please enter a 10-digit number.</div>
                  <div class="valid-feedback">Valid telephone number!</div>
                </div>
              </div>

             

              <div class="form-group row" id="custom-input">
                <label for="mobile1" class="col-sm-2 col-form-label text-end"><b>Mobile:</b></label>
                <div class="col-sm-5">
                  <input type="tel" pattern="[0-9]{10}" placeholder="Enter Mobile 1" required class="form-control" id="mobile1" name="mobile1" required />
                  <div class="invalid-feedback">Please enter a 10-digit number.</div>
                  <div class="valid-feedback">Valid telephone number!</div>
                </div>
              </div>


              <!-- <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end"><b></b> Mobile2 :</label>
                <div class="col-sm-5">
                  <input type="text" placeholder="Enter Mobile 2 " required class="form-control" name="mobile2" />
                </div>
              </div> -->


            

              <div class="form-group row" id="custom-input">
                <label for="password" class="col-sm-2 col-form-label text-end"><b>Password:</b></label>
                <div class="col-sm-5">
                  <input type="password" placeholder="Enter Password" required class="form-control" name="password" required />
                  <div class="invalid-feedback">Password must be at least 10 characters long.</div>
                  <div class="valid-feedback">Valid password!</div>
                </div>
              </div>



              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">
                  <b> Role :</b></label>
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
                <label for="dorecruite" class="col-sm-2 col-form-label text-end"><b>Date of Recruitment:</b></label>
                <div class="col-sm-5">
                  <input type="date" class="form-control datepicker" placeholder="Select a date" name="dorecruite" required>
                  <div class="invalid-feedback">Please select a date.</div>
                  <div class="valid-feedback">Valid date!</div>
                </div>
              </div>


              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label  text-end">
                  <b>Employee Status :</b> </label>
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

              <!-- <script>
                function validateForm() {
                  var isValid = true;

                  // Perform your validation checks
                  // Example: Check if the callname input is empty
                  var callname = document.getElementById("callname").value;
                  if (callname.trim() === "") {
                    document.getElementById("callname-validation").style.display = "block";
                    isValid = false;
                  } else {
                    document.getElementById("callname-validation").style.display = "none";
                  }

                  // Add more validation checks for other fields

                  // Enable/disable the submit button based on the validation status
                  var submitButton = document.getElementById("submitButton");
                  submitButton.disabled = !isValid;

                  // Return false to prevent the form submission if validation fails
                  return isValid;
                }
              </script> -->
           
              <div class="form-group row" id="custom-input">
                <div class="col-sm-5 offset-sm-2">
                  <button type="submit" class="btn btn-primary shadow" value="Submit">Register</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</main>

<script>
  $(document).ready(function() {
    // Function to validate the name input
    function validateName() {
      var nameInput = $("#fullname");
      var name = nameInput.val().trim();
      var isValid = /^[A-Za-z\s]+$/.test(name); // Regular expression to check if name contains only letters and spaces

      if (isValid) {
        // Remove any existing error classes and hide the error message
        nameInput.removeClass("is-invalid").addClass("is-valid");
        $("#name-error").hide();
        return true; // Name is valid
      } else {
        // Add error classes and show the error message
        nameInput.removeClass("is-valid").addClass("is-invalid");
        $("#name-error").show();
        return false; // Name is invalid
      }
    }
    function validatecallName() {
      var nameInput = $("#callname");
      var name = nameInput.val().trim();
      var isValid = /^[A-Za-z\s]+$/.test(name); // Regular expression to check if name contains only letters and spaces

      if (isValid) {
        // Remove any existing error classes and hide the error message
        nameInput.removeClass("is-invalid").addClass("is-valid");
        $("#name-error").hide();
        return true; // Name is valid
      } else {
        // Add error classes and show the error message
        nameInput.removeClass("is-valid").addClass("is-invalid");
        $("#name-error").show();
        return false; // Name is invalid
      }
    }

    // Function to validate NIC
    function validateNIC(nic) {
      var pattern = /^\d{9}[vVxX]$/; // Regular expression for NIC validation
      return pattern.test(nic);
    }

    // Function to handle NIC validation
    function handleNICValidation() {
      var nicInput = $("#nicNumber");
      var nicValue = nicInput.val();

      if (validateNIC(nicValue)) {
        nicInput.removeClass("is-invalid").addClass("is-valid");
        $("#nic-error").text("").hide();
        return true; // NIC is valid
      } else {
        nicInput.removeClass("is-valid").addClass("is-invalid");
        $("#nic-error").text("Invalid NIC format!").show();
        return false; // NIC is invalid
      }
    }

    // Function to handle address validation
    function handleAddressValidation() {
      var addressInput = $("input[name='address']");
      var addressValue = addressInput.val();

      if (addressValue.trim() === "") {
        addressInput.removeClass("is-valid").addClass("is-invalid");
        $("#address-error").show();
        $("#address-check").hide();
        return false; // Address is invalid
      } else {
        addressInput.removeClass("is-invalid").addClass("is-valid");
        $("#address-error").hide();
        $("#address-check").show();
        return true; // Address is valid
      }
    }

    // Function to handle telephone number validation
    function handleTelephoneValidation() {
      var telephoneInput = $("#mobile1");
      var telephoneValue = telephoneInput.val();

      // Remove any non-digit characters
      var sanitizedValue = telephoneValue.replace(/\D/g, "");

      if (sanitizedValue.length === 10) {
        telephoneInput.removeClass("is-invalid").addClass("is-valid");
        $("#mobile1-error").hide();
        return true; // Telephone number is valid
      } else {
        telephoneInput.removeClass("is-valid").addClass("is-invalid");
        $("#mobile1-error").show();
        return false; // Telephone number is invalid
      }
    }

    // Event listener for form submission
    $("form").submit(function(event) {
      // Perform validation checks
      var isNameValid = validateName();
      var isNICValid = handleNICValidation();
      var isAddressValid = handleAddressValidation();
      var isTelephoneValid = handleTelephoneValidation();

      // Prevent form submission if any validation fails
      if (!isNameValid || !isNICValid || !isAddressValid || !isTelephoneValid) {
        event.preventDefault();
        // Optionally, you can display an error message indicating the reason for the form not being submitted.
        // For example: $("#error-message").text("Please fix the errors before submitting the form.").show();
      } else {
        // If all validations pass, show a confirmation dialog
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
      }
    });

    // Call the validateName function whenever the name input changes
    $("#fullname").on("input", validateName);

    // Call the handleNICValidation function whenever the NIC input changes
    $("#nicNumber").on("input", handleNICValidation);

    // Call the handleAddressValidation function whenever the address input changes
    $("input[name='address']").on("input", handleAddressValidation);

    // Call the handleTelephoneValidation function whenever the telephone number input changes
    $("#mobile1").on("input", handleTelephoneValidation);
    
    validatecallName

    // Function to automatically fill the birthday field based on the NIC number
    function autoFillBirthday() {
      var nicNumber = $("#nicNumber").val();

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
        $("#birthday").val(birthDate);
      } else {
        $("#birthday").val(""); // Clear the birthday field if NIC number is invalid
      }
    }

    // Call the autoFillBirthday function whenever the NIC input changes
    $("#nicNumber").on("input", autoFillBirthday);

    // Function to preview selected image
    function previewImage(event) {
      const input = event.target;
      const previewImage = $("#preview");

      if (input.files && input.files[0]) {
        previewImage.attr("src", URL.createObjectURL(input.files[0]));
        previewImage.css("display", "block");
      } else {
        previewImage.attr("src", "#");
        previewImage.css("display", "none");
      }
    }

    // Call the previewImage function whenever the image input changes
    $("#exampleFormControlFile1").on("change", previewImage);
  });
</script>

<?php
require('pages/footer.php');
?>