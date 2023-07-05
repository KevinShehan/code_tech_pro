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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      <i class="fas fa-folder"></i>&nbsp; Category Update
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <?php
                    if (isset($_GET['id'])) {
                      $categoryId = $_GET['id'];
                      // Retrieve the category details based on the categoryId
                      $query = "SELECT * FROM category WHERE id = $categoryId";
                      $result = mysqli_query($con, $query);
                      $row = mysqli_fetch_assoc($result);
                    ?>
                      <form id="categoryForm">
                        <div class="mb-3">
                          <label for="code" class="form-label">CODE</label>
                          <input type="text" class="form-control" id="code" name="code" value="<?php echo $row['code']; ?>">
                        </div>
                        <div class="mb-3">
                          <label for="categoryName" class="form-label">Category Name</label>
                          <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $row['name']; ?>">
                        </div>
                        <div class="mb-3">
                          <label for="brand" class="form-label">Brand</label>
                          <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $row['brand']; ?>">
                        </div>
                        <input type="hidden" id="categoryId" name="categoryId" value="<?php echo $categoryId; ?>">
                      </form>
                    <?php
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Include Bootstrap JS -->



    </div>
  </div>
  </div>
  </div>
  </div>
</main>
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





  $(document).on('click', '.updateBtn', function() {
    var button = $(this);
    var id = button.data('id');

    $.ajax({
      url: 'category_get.php',
      type: 'GET',
      data: {
        id: id
      },
      dataType: 'json',
      success: function(response) {
        $('#categoryIdUpdate').val(response.id);
        $('#cat_code').val(response.cat_code);
        $('#cat_name').val(response.cat_name);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });




  $(document).ready(function() {
    $('#categoryTable').DataTable();
  });
</script>




<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<?php include('pages/Footer.php'); ?>