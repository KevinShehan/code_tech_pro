<?php
//register supplier
require('pages/Auth.php');
require('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>



<?php
// Retrieve the supplier ID from the URL parameter
$empId = $_GET['id'];

// Fetch the relevant data of the supplier based on the ID
$query = "SELECT * from employee where id='$empId'";
$supplierData = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($supplierData)) {
  $code = $row['code'];
  $nametitle = $row['nametitle_id'];
  $name = $row['callingname'];
  $fullname = $row['fullname'];
  $contact1 = $row['mobile'];
  $contact2 = $row['land'];
  $address = $row['address'];
  $email = $row['email'];
  $civilstatus_id = $row['civilstatus_id'];
  $dob = $row['dob'];
  $gender_id = $row['gender_id'];
  $nic=$row['nic'];
  $employeestatus_id=$row['employeestatus_id'];
}


$query2 = "SELECT nametitle.name from nametitle where id=' $nametitle'";
$result2 = mysqli_query($con, $query2);
$row = mysqli_fetch_assoc($result2);
$nametitlenew = $row['name'];


$query3 = "SELECT civilstatus.name from civilstatus where id='$civilstatus_id'";
$result3 = mysqli_query($con, $query3);
$row = mysqli_fetch_assoc($result3);
$civilstatusnew = $row['name'];


$query4 = "SELECT gender.name from gender where id='$gender_id'";
$result4 = mysqli_query($con, $query4);
$row = mysqli_fetch_assoc($result4);
$gendernew = $row['name'];


$query5 = "SELECT employeestatus.name from employeestatus where id='$employeestatus_id'";
$result5 = mysqli_query($con, $query5);
$row = mysqli_fetch_assoc($result5);
$employeestatusnew = $row['name'];

// Replace the code below with your database query to fetch the supplier data
// $supplierData = fetchSupplierData($supplierId);

// Populate the form fields with the retrieved data

// Add more fields as needed

// $query6 = "SELECT role.name from user where Employee_id='$empId'";
$query6 = "SELECT role.name 
          FROM user 
          INNER JOIN role ON user.role_id = role.id 
          WHERE user.employee_id = '$empId'";
$result6 = mysqli_query($con, $query6);
$row = mysqli_fetch_assoc($result6);
$employeerole = $row['name'];
?>


<!-- <script>
    // Add event listener to the delete button
    document.getElementById('deleteButton').addEventListener('click', function() {
        // Display the confirmation dialog
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(willDelete) {
            if (willDelete) {
                // User confirmed the delete operation
                // Load delete.php on the same page
                window.location.href = "delete.php";
            } else {
                // User canceled the delete operation
                swal("Your record is safe.", {
                    icon: "success",
                });
            }
        });
    });
</script> -->
<!-- Include SweetAlertJS library -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Delete button -->
<!-- <button id="deleteButton">Delete User</button> -->

<!-- JavaScript code -->
<!-- <script>
    // Function to handle the delete operation
    function deleteUser() {
        // Send an AJAX request to delete.php
        $.ajax({
            url: 'employee_delete.php',
            type: 'POST',
            dataType: 'json',
            data: {
                userId: <?php   // echo $Id; 
                        ?>
            }, // Pass the user ID to delete.php
            success: function(response) {
                // Display SweetAlertJS popup message
                swal("Success", response.message, "success");

                // Reload the current page after the successful deletion
                location.reload();
            },
            error: function(xhr, status, error) {
                // Display error message if the AJAX request fails
                swal("Error", "An error occurred while deleting the user.", "error");
                console.log(xhr.responseText);
            }
        });
    }

    // Attach event listener to the delete button
    document.getElementById('deleteButton').addEventListener('click', function() {
        // Confirm deletion using SweetAlertJS
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // User confirmed deletion, call the deleteUser function
                    deleteUser();
                }
            });
    });
</script> -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h4>
              <span>
                <i class="fas fa-user"></i>
              </span> View Single User
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
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nametitlenew) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>Full Name:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($fullname) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>Civil Status: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($civilstatusnew) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>Date of Birth: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($dob) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Gender:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($gendernew) ?>" readonly>
              </div>
            </div>


            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Mobile: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($contact1) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b>Land:</b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($contact2) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Address: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($address) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> E-mail: </b>
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($email) ?>" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                 <b>NIC: </b> 
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($nic) ?>" readonly>
              </div>
            </div>




            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                  <b> Employee Status:  </b> 
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($employeestatusnew) ?>" readonly>
              </div>
            </div>



            <div class="row mb-3">
              <div class="col-sm-4 text-end">
                <label for="gender" class="col-form-label font-weight-bold">
                <b>Employee Role:   </b> 
                </label>
              </div>
              <div class="col-sm-8">
                <input type="text" name="" id="" class="form-control" value="<?php echo ($employeerole) ?>" readonly>
              </div>
            </div>


            <!-- Remaining label and input field pairs -->

            <!-- <div class="form-group row mb-3">
              <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-success" name="submit"> Edit Employee </button>
              </div>
            </div> -->


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
          $query = "SELECT employee.photo FROM employee JOIN user ON employee.id = user.employee_id  WHERE user.username = '$username'";
          $result = mysqli_query($con, $query);

          if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['photo'];

            if (file_exists($imagePath)) {
              // Step 3: Create the image tag
              $imageTag = '<img src="' . $imagePath . '" alt="profile_image" style="width:150px;height:150px; border-radius: 50%; object-fit: cover; float: left;" class="shadow">';
            } else {
              $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:150px;height:150px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
            }
          } else {
            $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:150px;height:150px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
          }

          // Step 4: Output the image tag
          echo $imageTag;
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