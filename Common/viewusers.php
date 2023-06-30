<?php
//View supplier
require('pages/Auth.php');
include('config/dbconnection.php');
// require('pages/functions/viewusers_functions.php');

include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
require('pages/css/viewusers_css.php');

?>
           <!-- Include jQuery -->
           <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
                                                        url: 'emp_delete.php?id=' + id,
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>

<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <span><i class="bi bi-table me-2"></i></span> Employees
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-12">
                                  
                                    <div class="form-group row" id="custom-input">
                                        <div class="col-sm-5">
                                            <a href="supplier_save.php" class="btn btn-success" value="Submit"> + Add User</a>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered" id="userTable">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Telephone</th>
                                                <th scope="col" class="col-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php tbldata($con); ?>
                                        </tbody>
                                    </table>

                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('#userTable').DataTable();
});
</script>



<?php

function tbldata($con)
{
    // Fetch latest supplier records from the database
    $query = 'SELECT * FROM employee';
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    // Generate the HTML markup for supplier records
    $html = '';
    $number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $html .= '<tr>';
        $html .= '<td>' . $number . '</td>';
        $html .= '<td>' . $row['callingname'] . '</td>';
        $html .= '<td>' . $row['address'] . '</td>';
        $html .= '<td>' . $row['mobile'] . '</td>';
        $html .= '<td>
                    <a class="viewBtn btn btn-info btn-sm" href="emp_view_single.php?id=' . $id . '"><i class="far fa-eye"></i></button>                                             
                    <a class="updateBtn btn btn-warning btn-sm" href="supplier_update.php?id=' . $id . '"><i class="fas fa-pencil-alt"></i></a>
                    <a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a>
                  </td>';
        $html .= '</tr>';
        $number++;
    }

    echo '<script>$("#userTable tbody").html(`' . $html . '`);</script>';
}?>



<?php
include('Pages/Footer.php');
?>

