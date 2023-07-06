<?php
//register supplier
session_start();
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <!-- <div class="alert alert-warning m-none">
                            New Sale
                        </div> -->
                        <h3>
                            <span><i class="fas fa-shopping-basket"></i></span> Items View
                        </h3>
                    </div>
                    <div class="card-body">


                        <table class="table table-striped table-bordered" id="categoryTable">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col" class="col-1">No</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Reorder</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" class="col-3">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch latest category records from the database
                                $query = 'SELECT * FROM item';
                                $result = mysqli_query($con, $query);

                                if (!$result) {
                                    die('Error: ' . mysqli_error($con));
                                }

                                // Generate the HTML markup for category records
                                $number = 1;
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $catid=$row['category_id'];
                                    $query2 = "SELECT category.name from category where id='$catid'";
                                    $result2 = mysqli_query($con, $query2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $category = $row2['name'];


                                    echo "<tr>";
                                    echo '<td>' . $number . '</td>';
                                    echo '<td>' . $row['code'] . '</td>';
                                    echo '<td>' . $row['name'] . '</td>';
                                    echo '<td>' .  $category. '</td>';
                                    echo '<td>' . $row['qty'] . '</td>';
                                    echo '<td>' . $row['reorder'] . '</td>';
                                    echo '<td>' . $row['rop'] . '</td>';
                                    echo '<td>' .
                                    ' <a class="updateBtn btn btn-warning btn-sm" data-id="' . $row['id'] . '"  href="item_update.php?id=' . $row['id'] . '"><i class="fas fa-pencil-alt"></i></a>' .
                                    '&nbsp;' .
                                    '<a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a></td>';
                                    echo '</tr>';
                                    $number++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable();
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
          url: 'item_delete.php?id=' + id,
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
</script>



<?php
include('pages/footer.php');
?>