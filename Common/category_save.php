<?php
//Authentication
require('pages/Auth.php');
//Database Connection
require('config/dbconnection.php');
//HTML HEAD SEACtion include Body tag
include('pages/header.php');
//HTML Navigation Bar
include('Top_nav.php');
//HTML Side Navigation Bar
include('Side_nav.php');
?>

<style>
  body {
    background-color: lightcyan;
  }

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
            <form class="form-horizontal" id="myForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group row" id="custom-input">
                <label for="gender" class="col-sm-2 col-form-label">Category Name:</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <div class="col-sm-2">
                    <input type="text" placeholder="Code" required class="form-control col-sm-2" name="cat_name" readonly>
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
                <tr>
                  <?php
                  // Fetch latest supplier records from the database
                  $query = 'SELECT * FROM category';
                  $result = mysqli_query($con, $query);

                  if (!$result) {
                    die('Error: ' . mysqli_error($con));
                  }

                  // Generate the HTML markup for supplier records
                  $html = '';
                  $number = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['code'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' .
                      '<button class="btn btn-warning" style="background-color: purple;color:#ffffff;"><i class="fas fa-pencil-alt"></i></button>' .
                      '&nbsp;'.
                      '<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>';
                    echo "</tr>";
                  }
                  echo '<script>$("#supplierTable tbody").html(`' . $html . '`);</script>';
                  ?>
              </tbody>
            </table>
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
<?php
require('pages/footer.php');
?>
