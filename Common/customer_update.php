<?php
//update customer
// require('pages/Auth.php');

require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');

// require('pages/js/customer_save_js.php');
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
$_SESSION['cusid']=$cusId;

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

            <a href="customer_view.php" class="btn btn-purple">
              <i class="fas fa-arrow-left"></i>
              Return Employee List
            </a>
            <form class="form-horizontal mt-2" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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
                    <b>Full Name:<span style="color: red;">*</span>
</b>
                  </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo ($name) ?>">
                  <div class="alert alert-danger mt-2" id="name-error" style="display: none;">Please enter a valid name (only letters and spaces).</div>
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
                    <b> Mobile: <span style="color: red;">*</span>
</b>
                  </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" name="mobile1" id="mobile1" class="form-control" value="<?php echo ($contact1) ?>">
                  <div class="alert alert-danger mt-2" id="mobile1-error" style="display: none;">Please enter a valid mobile number.</div>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col-sm-4 text-end">
                  <label for="gender" class="col-form-label font-weight-bold">
                    <b> Address: <span style="color: red;">*</span>
</b>
                  </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" name="address" id="address" class="form-control" value="<?php echo ($address) ?>">
                  <div class="alert alert-danger mt-2" id="address-error" style="display: none;">Address Field Cannot BE nulled.</div>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col-sm-4 text-end">
                  <label for="gender" class="col-form-label font-weight-bold">
                    <b>NIC: <span style="color: red;">*</span>
</b>
                  </label>
                </div>
                <div class="col-sm-8">
                  <input type="text" name="nic" id="nic" class="form-control" value="<?php echo ($nic) ?>">
                  <div class=" erro alert alert-danger mt-2" id="nic-error" style="display: none;">Please Enter Correct NIC</div>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col-sm-4 text-end">
                  <label for="gender" class="col-form-label font-weight-bold">
                    <b> Description: </b>
                  </label>
                </div>
                <div class="col-sm-8">
                  <textarea class="form-control" id="message" name="description" rows="4" cols="50" value="<?php echo ($description) ?>"></textarea>
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
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  function generateUniqueCode() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var counter = 1;
    var code = 'CU';

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

    // Function to validate NIC
    function validateNIC(nic) {
      var pattern = /^\d{9}[vVxX]$/; // Regular expression for NIC validation
      return pattern.test(nic);
    }

    // Function to handle NIC validation
    function handleNICValidation() {
      var nicInput = $("#nic");
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
      var addressInput = $("#address");
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
        // For example: $("#error-message").text("Please fix the errors before submitting theform.").show();
      } else {

        // event.preventDefault(); // Prevent the form from submitting immediately

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
            $("form").submit();
          }
        });
      }
    });

    // Call the validateName function whenever the name input changes
    $("#fullname").on("input", validateName);

    // Call the handleNICValidation function whenever the NIC input changes
    $("#nic").on("input", handleNICValidation);

    // Call the handleAddressValidation function whenever the address input changes
    $("#address").on("input", handleAddressValidation);

    // Call the handleTelephoneValidation function whenever the telephone number input changes
    $("#mobile1").on("input", handleTelephoneValidation);
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>


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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $custID= $_SESSION['cusid'];
  $username = $_SESSION["username"];
  // Execute the SQL query
  $query2 = "SELECT user.id from user WHERE user.username = '$username'";
  $result2 = mysqli_query($con, $query2);
  $row2 = mysqli_fetch_assoc($result2);
  // Check if a row was returned
  if ($row2) {
    $user_id = $row2['id'];
    $_SESSION['user_id'] = $user_id;
    // echo $user_id ;
  }
  // else {
  //   echo "Failed";
  // }

  

  //should get values from foreign tables id's
  $nametitle = $_POST['nametitle'];
  $fullname = $_POST['fullname'];
  $nic = $_POST['nic'];
  $gender = $_POST['gender'];
  $contact1 = $_POST['mobile1'];
  $address = $_POST['address'];



  $customertype = $_POST['customertype'];
  $description = $_POST['description'];

  $sql = "UPDATE customer set nametitle_id ='$nametitle', name='$fullname',gender_id='$gender', nic='$nic', mobile1='$contact1',
    address='$address', user_id='$user_id',description='$description',customertype_id='$customertype' WHERE id =  $custID";
  $result = mysqli_query($con, $sql);

  // Print the query statement
  // echo "Query: " . $sql . "<br>";
  if ($result) {
    // Display SweetAlert success message
    echo "
<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js' ></script>
<script>
    swal({
        title: 'Success!',
        text: 'Customer Updated successfully.',
        icon: 'success',
    }).then(function() {
        // Redirect to view.php
        window.location.href = 'customer_view.php';
    });
</script>
";
    //Close connection
  } else {
    // Display SweetAlert error message
    echo "
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script>
        $(document).ready(function() {
            swal({
                title: 'Error!',
                text: 'Customer Not Saved.',
                icon: 'error',
            });
        });
    </script>
    ";
  }
}
$con->close();
?>



<?php
require('pages/Footer.php');
?>