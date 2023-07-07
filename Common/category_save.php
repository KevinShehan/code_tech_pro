<?php
//Authentication
require('pages/Auth.php');
//Profile
include('config/dbconnection.php');
include('pages/Header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<style>
  body {
    background-color: lightcyan;
  }


  .dataTables_wrapper {
    margin-top: 20px;
    /* Adjust the margin value as per your needs */
  }

  .dataTables_filter {
    margin-bottom: 10px;
    /* Adjust the margin value as per your needs */
  }
</style>


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h3>
              <span><i class="fas fa-folder"></i>
              </span> Category Information
            </h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Category Name:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <div class="col-sm-2">
                      <input type="text" placeholder="Code" required class="form-control col-sm-2" name="cat_code" readonly id="codeInput">

                      <script>
                        function generateUniqueCode() {
                          var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                          var counter = 1;
                          var code = 'CA';

                          function incrementCounter() {
                            var number = counter.toString().padStart(2, '0');
                            counter++;
                            return number;
                          }
                          code += incrementCounter();
                          for (var i = 0; i < 2; i++) {
                            code += characters.charAt(Math.floor(Math.random() * characters.length));
                          }
                          document.getElementById('codeInput').value = code;
                        }
                        // Automatically generate code when the page loads
                        window.addEventListener('load', generateUniqueCode);
                      </script>
                    </div>
                    <input type="text" placeholder="Enter Category" required class="form-control col-sm-5" name="cat_name">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-success shadow" value="Submit" style="background-color: #428bca; color: #ffffff; margin-left: 10px;" onmouseover="this.style.backgroundColor='#245269';" onmouseout="this.style.backgroundColor='#428bca';">+ Add Category</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>
            <script>
              document.getElementById("myForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately
                Swal.fire({
                  title: "Confirm Submission",
                  text: "Are you sure you want to save the category?",
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
              });
            </script>


            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['cat_name'])) {
              // Access the submitted values
              $cat_code = $_POST['cat_code'];
              $cat_name = $_POST['cat_name'];
              $query_cat = "INSERT into category(code,name) values('$cat_code', '$cat_name' );";

              if ($result_cat = mysqli_query($con, $query_cat)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
                echo '<script>';
                echo 'window.onload = function() {';
                echo '  Swal.fire({';
                echo '    icon: "success",';
                echo '    title: "Success",';
                echo '    text: "Category saved successfully"';
                echo '  }).then(function() {';
                echo '    location.href = "Category_save.php";';
                echo '  });';
                echo '};';
                echo '</script>';
              } else {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.14/dist/sweetalert2.min.js"></script>';
                echo '<script>';
                echo 'window.onload = function() {';
                echo '  Swal.fire({';
                echo '    icon: "error",';
                echo '    title: "Error",';
                echo '    text: "An error occurred while saving the category"';
                echo '  });';
                echo '};';
                echo '</script>';
              }
            }
            ?>


            <table class="table table-striped table-bordered" id="categoryTable">
              <thead>
                <tr class="table-primary">
                  <th scope="col" class="col-1">No</th>
                  <th scope="col">Code</th>
                  <th scope="col">Category</th>
                  <th scope="col" class="col-3">Actions</th>
                </tr>
              </thead>
              <tbody>
  <?php
  // Fetch latest category records from the database
  $query = 'SELECT * FROM category';
  $result = mysqli_query($con, $query);

  if (!$result) {
    die('Error: ' . mysqli_error($con));
  }

  // Generate the HTML markup for category records
  $number = 1;
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo '<td>' . $number . '</td>';
    echo '<td>' . $row['code'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' .
      '<button class="updateBtn btn btn-sm" style="background-color: purple;color:#ffffff;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' . $row['id'] . '"><i class="fas fa-pencil-alt"></i></button>' .
      '&nbsp;' .
      '<a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a></td>';
    echo "</tr>";
    $number++;
  }
  ?>
</tbody>
</table>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" name="updateCategoryForm">
          <div class="mb-3">
            <label for="modalCode" class="form-label">Code</label>
            <input type="text" class="form-control" id="modalCode" name="updatedCode" readonly>
          </div>
          <div class="mb-3">
            <label for="modalCategory" class="form-label">Category</label>
            <input type="text" class="form-control" id="modalCategory" name="updatedName">
          </div>

          <!-- Add a hidden input field to store the category ID -->
          <input type="hidden" id="categoryId" name="categoryId">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="updateCategoryForm">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).on('click', '.updateBtn', function() {
    // Get the category code and name
    var code = $(this).closest('tr').find('td:eq(1)').text();
    var category = $(this).closest('tr').find('td:eq(2)').text();

    // Get the category ID
    var categoryId = $(this).data('id');

    // Populate the modal with the category code, name, and ID
    $('#modalCode').val(code);
    $('#modalCategory').val(category);
    $('#categoryId').val(categoryId);

    // Open the modal
    $('#exampleModal').modal('show');
  });
</script>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCategoryForm'])) {
  // Get the updated category code and name from the form
  $updatedCode = $_POST['updatedCode'];
  $updatedName = $_POST['updatedName'];

  // Get the category ID from the form
  $categoryId = $_POST['categoryId'];

  // Perform the update query
  $updateQuery = "UPDATE category SET name = '$updatedName' WHERE id = '$categoryId'";

  // Execute the update query
  $updateResult = mysqli_query($con, $updateQuery);

  if ($updateResult) {
    // Update successful
    echo "Category updated successfully!";
  } else {
    // Update failed
    echo "Error updating category: " . mysqli_error($con);
  }
}
?>

        </div>
      </div>
    </div>

</main>



<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.js"></script>
<script>
  $(document).ready(function() {
    // Button click event handler
    $(document).on('click', '.deleteBtn', function() {
      var button = $(this);
      var id = button.data('id');

      // Display the confirmation dialog
      Swal.fire({
        title: 'Are you sure?',
        text: 'Once deleted, you will not be able to recover this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // User confirmed the delete operation
          // Call the delete function
          deleteRecord(id);
        }
      });


      function deleteRecord(id) {
        // Send AJAX request to delete.php with the ID parameter
        $.ajax({
          url: 'category_delete.php?id=' + id,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              // Show SweetAlert popup
              Swal.fire({
                title: 'Success',
                text: 'Record deleted successfully',
                icon: 'success'
              }).then(function() {
                // Refresh the page
                location.reload();
              });
            } else {
              // Show error message if deletion fails
              Swal.fire({
                title: 'Error',
                text: 'An error occurred while deleting the record',
                icon: 'error'
              });
            }
          },
          error: function() {
            // Show error message if the request fails
            Swal.fire({
              title: 'Error',
              text: 'An error occurred while deleting the record',
              icon: 'error'
            });
          }
        });
      }
    });
  });




  $(document).ready(function() {
    $('#categoryTable').DataTable();
  });
</script>




<?php include('pages/Footer.php'); ?>