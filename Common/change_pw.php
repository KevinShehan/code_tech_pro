<?php
//register supplier

// use LDAP\Result;

require('pages/Auth.php');
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>
<style>
  .card {
    width: 80%;
  }

  body {
    background-color: lightcyan;
  }

  .align-right {
    text-align: right;
  }

  /* Purple button */
  .btn-purple {
    background-color: purple;
    color: white;
  }

  /* Hover effect */
  .btn-purple:hover {
    background-color: #6c3483;
    color: white;
  }
</style>

<!-- HTML and JavaScript Part -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->

<script>
  $(document).ready(function() {
    // Event listener for current password field
    $('#currentPassword').on('input', function() {
      var currentPassword = $(this).val();
      var errorMessage = '';

      // Check if the current password field is empty
      if (currentPassword === '') {
        errorMessage = 'Current password field cannot be empty';
      } else if (currentPassword.length < 10) {
        errorMessage = 'Current password must contain at least 10 characters';
      }

      showError($('#currentPasswordError'), errorMessage);
    });

    // Event listener for new password field
    $('#newPassword').on('input', function() {
      var newPassword = $(this).val();
      var errorMessage = '';

      // Check if the new password field is empty
      if (newPassword === '') {
        errorMessage = 'New password field cannot be empty';
      } else if (newPassword.length < 10) {
        errorMessage = 'New password must contain at least 10 characters';
      }

      showError($('#newPasswordError'), errorMessage);
    });

    // Event listener for re-enter password field
    $('#reenterPassword').on('input', function() {
      var newPassword = $('#newPassword').val();
      var reenterPassword = $(this).val();
      var errorMessage = '';

      // Check if the re-enter password field is empty
      if (reenterPassword === '') {
        errorMessage = 'Re-enter password field cannot be empty';
      } else if (newPassword !== reenterPassword) {
        errorMessage = 'Passwords do not match';
      }

      showError($('#reenterPasswordError'), errorMessage);
    });

    // Event listener for form submission
    $('#passwordForm').submit(function(event) {
      event.preventDefault(); // Prevent form submission

      // Check if any error message is displayed
      if ($('#currentPasswordError').hasClass('d-none') &&
        $('#newPasswordError').hasClass('d-none') &&
        $('#reenterPasswordError').hasClass('d-none')) {
        // Form is valid, perform the necessary action (e.g., AJAX request to change the password)
        // ...
        console.log('Form submitted successfully');
        this.submit(); // Submit the form
      } else {
        // Form has validation errors, display a general error message
        $('#errorMessage').text('Please correct the errors before submitting.').removeClass('d-none');
      }
    });

    // Function to show error messages
    function showError(element, errorMessage) {
      element.text(errorMessage);
      if (errorMessage !== '') {
        element.removeClass('d-none');
      } else {
        element.addClass('d-none');
      }
    }


    // Function to show error messages and apply styles to fields
    function showError(element, errorMessage) {
      element.text(errorMessage);
      if (errorMessage !== '') {
        element.removeClass('d-none');
        element.addClass('text-danger');
        element.closest('.form-group').find('input').addClass('is-invalid');
        element.closest('.form-group').find('input').removeClass('is-valid');
      } else {
        element.addClass('d-none');
        element.removeClass('text-danger');
        element.closest('.form-group').find('input').removeClass('is-invalid');
        element.closest('.form-group').find('input').addClass('is-valid');
      }
    }
  });
</script>



<script>
  $(document).ready(function() {
    // Event listener for form submission
    $('#passwordForm').submit(function(event) {
      event.preventDefault(); // Prevent form submission

      // Check if any input field is empty
      var currentPassword = $('#currentPassword').val();
      var newPassword = $('#newPassword').val();
      var reenterPassword = $('#reenterPassword').val();

      if (currentPassword === '' || newPassword === '' || reenterPassword === '') {
        // Display SweetAlert popup error message
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please fill in all the fields.',
          showConfirmButton: false,
          timer: 2000,
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
          showCancelButton: true,
          cancelButtonText: 'Close'
        }).then(function(result) {
          if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.reload();
          }
        });
      } else {
        // All fields are filled, submit the form
        this.submit();
      }
    });
  });
</script>


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h4>
              <span><i class="fas fa-key"></i>
              </span> Change Password
            </h4>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="passwordForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-3 col-form-label">Current Password:</label>
                <div class="col-sm-5">
                  <input type="password" id="currentPassword" name="currentPassword" class="form-control form-control-sm" placeholder="Enter current password">
                  <div id="currentPasswordError" class="alert alert-danger d-none  alert-sm"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-3 col-form-label">New Password :</label>
                <div class="col-sm-5">
                  <input type="password" id="newPassword" name="newPassword" class="form-control form-control-sm" placeholder="Enter new password">
                  <div id="newPasswordError" class="text-danger"></div>
                </div>
              </div>

              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-3 col-form-label">Reenter Password :</label>
                <div class="col-sm-5">
                  <input type="password" id="reenterPassword" name="reenterPassword" class="form-control form-control-sm" placeholder="Re-enter new password">
                  <div id="reenterPasswordError" class="text-danger"></div>
                </div>

                <div class="form-group row" id="custom-input">
                  <div class="col-sm-5 offset-sm-6"> <!-- Add offset-sm-7 class for right alignment -->
                    <button type="submit" class="btn btn-purple btn-sm">Change Password</button>
                  </div>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Assuming you have retrieved the current user's password from the database
  $user_current_pw = $_POST['currentPassword'] ?? '';
  $user_new_pw = $_POST['newPassword'] ?? '';
  $user_reenter_pw = $_POST['reenterPassword'] ?? '';
  $username = $_SESSION["username"];


  // Query the database to get the current user's password
  $query = "SELECT password FROM user WHERE username = '$username'";
  $result = mysqli_query($con, $query);

  // Check if the query executed successfully
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentPasswordFromDatabase = $row['password'];

    // Verify if the user-entered current password matches the current user's password
    if (password_verify($user_current_pw, $currentPasswordFromDatabase)) {
      // Passwords match, perform the necessary action (e.g., change the password)
      // Hash the new password
      $hashedPassword = password_hash($user_new_pw, PASSWORD_DEFAULT);

      // Update the user's password in the database
      $updateQuery = "UPDATE user SET password = '$hashedPassword' WHERE username = '$username'";
      $updateResult = mysqli_query($con, $updateQuery);

      if ($updateResult) {
        // Password changed successfully
        echo '<script>
                window.onload = function() {
                  Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Password changed successfully.",
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showCancelButton: true,
                    cancelButtonText: "Close"
                  }).then(function(result) {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                      window.location.href = "profile.php";
                    }
                  });
                }
              </script>';
      } else {
        // Error updating the password
        echo '<script>
                window.onload = function() {
                  Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error updating the password. Please try again.",
                    showConfirmButton: false,
                    timer: 2000,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showCancelButton: true,
                    cancelButtonText: "Close"
                  }).then(function(result) {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                      window.location.reload();
                    }
                  });
                }
              </script>';
      }
    } else {
      // Password is incorrect
      echo '<script>
              window.onload = function() {
                Swal.fire({
                  icon: "error",
                  title: "Incorrect Password",
                  text: "Please enter the correct current password.",
                  showConfirmButton: false,
                  timer: 2000,
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: false,
                  showCancelButton: true,
                  cancelButtonText: "Close"
                }).then(function(result) {
                  if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.reload();
                  }
                });
              }
            </script>';
    }
  } else {
    // Error executing the query
    echo '<script>
            window.onload = function() {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error executing the query. Please try again.",
                showConfirmButton: false,
                timer: 2000,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: true,
                cancelButtonText: "Close"
              }).then(function(result) {
                if (result.dismiss === Swal.DismissReason.cancel) {
                  window.location.reload();
                }
              });
            }
          </script>';
  }
}
?>


<!-- Backend Part -->
<?php
require('pages/footer.php');
?>