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
                            <span><i class="fas fa-building"></i></span> Suppliers
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
                                            <a href="supplier_save.php" class="btn btn-success" value="Submit"> + Add Supplier</a>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered" id="supplierTable">
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
                                                $html .= '<td>' . $row['address'] . '</td>';
                                                $html .= '<td>' . $row['contact1'] . '</td>';
                                                $html .= '<td>
                                                        <button class="viewBtn btn btn-info btn-sm" href="supplier_single_view.php?id=' . $id . '"><i class="far fa-eye"></i></button>                                             
                                                        <a class="updateBtn btn btn-warning btn-sm" href="supplier_update.php?id=' . $id . '"><i class="fas fa-pencil-alt"></i></a>
                                                        <a class="deleteBtn btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="fas fa-trash-alt"></i></a>
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
            <!-- <div class="col-md-4 mb-3">
                <div class="card sup_single">
                    <div class="card-header">
                        <h4>
                            <span><i class="bi bi-funnel me-2"></i></span> Supplier View
                        </h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Name</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_name" placeholder="Enter name" readonly>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Description</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_description" placeholder="Description" readonly>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Gender</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_gender" placeholder="Gender" readonly>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Contact 1</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_contact1" placeholder="Contact1" readonly>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Contact 2</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_contact2" placeholder="Contact2" readonly>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Address</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_address" placeholder="Address" readonly>

                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Email</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_email" placeholder="Email" readonly>

                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="searchInput" class="form-label">Fax</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control me-2" id="sup_fax" placeholder="FAX" readonly>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</main>

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#supplierTable').DataTable({
            "paging": true,
            "pageLength": 8
        });
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

        function loadSupplierDetails(id) {
            $.ajax({
                url: 'supplier_single_view.php?id=' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Display the supplier details in the sup_single card
                        $('#sup_name').val(response.data.name);
                        $('#sup_description').val(response.data.description);
                        $('#sup_gender').val(response.data.gender);
                        $('#sup_contact1').val(response.data.contact1);
                        $('#sup_contact2').val(response.data.contact2);
                        $('#sup_address').val(response.data.address);
                        $('#sup_email').val(response.data.email);
                        $('#sup_fax').val(response.data.fax);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to load supplier details',
                            icon: 'error'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while loading the supplier details',
                        icon: 'error'
                    });
                }
            });
        }






        $(document).on('click', '.viewBtn', function(event) {
            event.preventDefault();

            var id = $(this).attr('href').split('?id=')[1];

            // Call the function to load and display the supplier details
            loadSupplierDetails(id);
        });












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