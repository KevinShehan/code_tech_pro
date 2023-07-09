<?php
//register supplier
require('pages/Auth.php');
require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>



<?php
// Retrieve data from the SQL table
$query_gender = "SELECT id,name FROM gender";
$query_nametitle = "SELECT id,name FROM nametitle";
$query_customerstatus = "SELECT id,name FROM suppliertype";

$result_gender = mysqli_query($con, $query_gender);
$result_nametitle = mysqli_query($con, $query_nametitle);
$result_customerstatus = mysqli_query($con, $query_customerstatus);
// Retrieve the supplier ID from the URL parameter
// Retrieve the supplier ID from the URL parameter
$supplierId = $_GET['id'];

// Fetch the relevant data of the supplier based on the ID
$query = "SELECT * from supplier where id='$supplierId'";
$supplierData = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($supplierData)) {
  $code = $row['code'];
  $nametitle = $row['nametitle_id'];
  $name = $row['name'];
  $description = $row['description'];
  $contact1 = $row['contact1'];
  $contact2 = $row['contact2'];
  $address = $row['address'];
  $email = $row['email'];
  $fax = $row['fax'];

  $supplierstatus_id = $row['supplierstatus_id'];
  $Suppliertype_id = $row['Suppliertype_id'];

}



$query2 = "SELECT gender.name from supplier where id='$supplierId'";
// Replace the code below with your database query to fetch the supplier data
// $supplierData = fetchSupplierData($supplierId);

// Populate the form fields with the retrieved data

// Add more fields as needed
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</script> 
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>
              <span>
                <i class="fas fa-store"></i>
              </span> Update Supplier
            </h4>
          </div>
          <div class="card-body">

            <a href="supplier_view.php" class="btn btn-purple">
              <i class="fas fa-arrow-left"></i>
              Return Supplier List
            </a>

            <div class="row mb-3">
              <div class="col-sm-4 text-end font-weight-bold">
                <label for="gender" class="col-form-label  ">
                  <b> Name Title: </b>
                </label>
              </div>

             


              <div class="col-sm-8">
               
                <select class="form-select" aria-label="Select Option">
                <option selected>Select Option</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
              </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  <b> Name: </b></label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($name) ?>">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Description:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($description) ?>">
              </div>
            </div>

            <!-- <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Logo:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php //echo ($nametitle) ?>">
              </div>
            </div> -->


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Gender:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitle) ?>">
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Contact Number1:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($contact1) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Contact Number 2:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($contact2) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Address:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($address) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  E-mail:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($email) ?>">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  E-mail:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($fax) ?>">
              </div>
            </div>




            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Supplier Status:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ( $supplierstatus_id) ?>">
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label">
                  Supplier Type:</label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ( $Suppliertype_id) ?>">
              </div>
            </div>


            <!-- Remaining label and input field pairs -->

            <div class="form-group row mb-3">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-success" name="submit">Update Supplier</button>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <img src="Assets/images/Login/user.png" class="card-img-top" alt="Image">
        </div>
      </div>
    </div>
  </div>
</main>
!-- Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>

<script>
  // Regex patterns
  var nameRegex = /^[A-Za-z\s]+$/;
  var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var passwordRegex = /^.{8,}$/;

  // Form validation
  var form = document.getElementById('myForm');
  var errorMessage = document.getElementById('errorMessage');

  form.addEventListener('submit', function(event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
      errorMessage.style.display = 'block';
    } else {
      showConfirmation();
    }
    form.classList.add('was-validated');
  });

  // Real-time validation
  var nameInput = document.getElementById('fullname');
  var emailInput = document.getElementById('emailInput');
  var passwordInput = document.getElementById('passwordInput');
  var confirmPasswordInput = document.getElementById('confirmPasswordInput');

  nameInput.addEventListener('input', function() {
    validateInput(nameInput, nameRegex, 'nameError');
  });

  emailInput.addEventListener('input', function() {
    validateInput(emailInput, emailRegex, 'emailError');
  });

  passwordInput.addEventListener('input', function() {
    validateInput(passwordInput, passwordRegex, 'passwordError');
  });

  confirmPasswordInput.addEventListener('input', function() {
    validatePasswordConfirmation();
  });

  function validateInput(input, regex, errorId) {
    var errorElement = document.getElementById(errorId);
    if (regex.test(input.value)) {
      input.classList.add('is-valid');
      input.classList.remove('is-invalid');
      errorElement.style.display = 'none';
    } else {
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
      errorElement.style.display = 'block';
    }
  }

  function validatePasswordConfirmation() {
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    if (passwordInput.value === confirmPasswordInput.value) {
      confirmPasswordInput.classList.add('is-valid');
      confirmPasswordInput.classList.remove('is-invalid');
      confirmPasswordError.style.display = 'none';
    } else {
      confirmPasswordInput.classList.add('is-invalid');
      confirmPasswordInput.classList.remove('is-valid');
      confirmPasswordError.style.display = 'block';
    }
  }

  function showConfirmation() {
    Swal.fire({
      title: 'Confirm Submission',
      text: 'Are you sure you want to submit the form?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Submit',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user confirms submission, submit the form
        document.getElementById('myForm').submit();
      }
    });
  }
</script>



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



<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to load and update supplier records
    function loadSupplierRecords() {
      $.ajax({
        url: '',
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#supplierTable tbody').html(response);
        },
        error: function() {
          Swal.fire({
            title: 'Error',
            text: 'Failed to load supplier records',
            icon: 'error'
          });
        }
      });
    }

    // Load initial supplier records
    loadSupplierRecords();

    // Refresh supplier records periodically
    setInterval(function() {
      loadSupplierRecords();
    }, 5000); // Refresh every 5 seconds
  });
</script>
<!-- 
<script>
    // Handle button clicks using event delegation
    $(document).on('click', '.updateBtn', function() {
        var supplierId = $(this).data('id');

        // Fetch the content of update.php via AJAX
        $.ajax({
            url: 'supplier_update.php',
            type: 'GET',
            data: {
                id: supplierId
            },
            success: function(response) {
                // Create a Bootstrap modal and inject the response HTML
                var modal = $('<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true"></div>');
                modal.html(response);
                $('body').append(modal);

                // Show the modal
                $('#updateModal').modal('show');
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to open update form',
                    icon: 'error'
                });
            }
        });
    });
</script> -->


<?php
require('pages/footer.php');
?>