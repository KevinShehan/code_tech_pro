<?php
//register supplier

require('pages/Auth.php');
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<!-- Include SweetAlertJS library -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <span><td><i class="fas fa-users"></i> </span> Suppliers
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-8">


                                    <style>
                                        body {
                                            background-color: lightcyan;
                                        }
                                    </style>
                                    <div class="form-group row" id="custom-input">
                                        <div class="col-sm-5 ">
                                            <a href="supplier_save.php" class="btn btn-success" value="Submit"> + Add Supplier</a>
                                        </div>
                                    </div>

                                    <table class="table" id="supplierTable">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">id</th>
                                                <th scope="col">First</th>
                                                <th scope="col">Last</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch latest supplier records from the database
                                            $query = 'SELECT * FROM supplier';
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
                                                $html .= '<td>' . $row['name'] . '</td>';
                                                $html .= '<td>' . $row['name'] . '</td>';
                                                $html .= '<td>
                                    <button class=" btn ">
                                     <a class="viewBtn btn btn-info" href="supplier_single_view.php?id=' . $id . '"><i class="far fa-eye"></i>
                                     </a></button>
                                   
                                    <button class="updateBtn btn btn-warning" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="deleteBtn btn btn-danger" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i>
                                    </button>
                                    </td>';
                                                $html .= '</tr>';
                                                $number++;
                                            }

                                            echo '<script>$("#supplierTable tbody").html(`' . $html . '`);</script>';
                                            ?>
                                        </tbody>
                                    </table>

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
                                                        url: 'supplier_delete.php?id=' + id,
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Supplier Update Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
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
<?php
require('pages/footer.php');
?>