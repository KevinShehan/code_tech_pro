<?php
//View supplier
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
                <div class="card shadow">
                    <div class="card-header">
                        <h4>
                            <span><i class="fas fa-building"></i></span> Sales Invoice
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-12">
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
                                    <div class="form-group row" id="custom-input">
                                        <div class="col-sm-5">
                                            <a href="invoice sale test.php" class="btn btn-success" value="Submit"> + Add Invoices</a>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered" id="supplierTable">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">Purchase Date</th>
                                                <th scope="col">Invoice Code</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Total</th>
                                                <th scope="col" class="col-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
$query = 'SELECT invoice.*, customer.name AS customer_name FROM invoice LEFT JOIN customer ON invoice.customers_id = customer.id';
$result = mysqli_query($con, $query);

if (!$result) {
    die('Error: ' . mysqli_error($con));
}

// Generate the HTML markup for invoice records
$html = '';
$number = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $html .= '<tr>';
    $html .= '<td>' . $row['date'] . '</td>';
    $html .= '<td>' . $row['code'] . '</td>';
    $html .= '<td>' . $row['customer_name'] . '</td>';
    $html .= '<td class="text-end">' . $row['total'] . '</td>';
    $html .= '<td>';
    $html .= ' <a href="sales_Slip.php?id='.$id.'"  class="btn btn-success btn-sm" name="btn_edit"><i class="fa fa-lg fa-print"></i></a>&nbsp;';
   
    $html .= '<a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a>';
    $html .= '</td>';
    $html .= '</tr>';
    $number++;
}

echo $html;
?>

                                        </tbody>
                                    </table>


                                    <!-- Include SweetAlert JS -->
                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            $('#supplierTable').DataTable({
                                                "paging": true,
                                                "pageLength": 8
                                            });

                                            // Refresh supplier records periodically
                                            setInterval(function() {
                                                loadSupplierRecords();
                                            }, 5000); // Refresh every 5 seconds
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
                                                        url: 'sales_delete.php?id=' + id,
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
    </div>
</main>


<?php
require('pages/footer.php');
?>