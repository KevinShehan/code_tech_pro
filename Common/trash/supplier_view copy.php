<?php
//register supplier

include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>




<?php
//register supplier

include('config/dbconnection.php');
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
                userId: <?php echo $Id; ?>
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



<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">

                        <h1>
                            <span><i class="bi bi-table me-2"></i></span> Suppliers
                        </h1>
                    </div>
                    <div class="card-body">

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
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php /*

                                // Fetch data from table
                                $sql = "SELECT * FROM v3.supplier";
                                $result =  mysqli_query($con, $sql);

                                // Check if there are any records
                                if ($result->num_rows > 0) {

                                    // Loop through each record
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Display table row for each record
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $address = $row['address'];

                                        echo '<tr>';
                                        echo '<td>' . $id . '</td>';
                                        echo '<td>' . $name . '</td>';
                                        echo '<td>' . $address . '</td>';
                                        echo '<td>
                                            <a class="btn btn-info" onclick="return confirm("Are you sure to view?")" href="Supplier_view.php?id=<?php echo $id; ?>">View</a>
                                            <a class="btn btn btn-warning" onclick="return confirm("Are you sure to Update?")" href="Supplier_update.php?id=<?php echo $id; ?>">Update</a>
                                            <button  class="deleteBtn btn btn-danger" data-id="' . $row['id'] . '"> Delete</button>
                                    </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">No records found.</td></tr>';
                                } */


                                // Fetch latest supplier records from the database
                                $query = 'SELECT * FROM supplier';
                                $result = mysqli_query($con, $query);

                                if (!$result) {
                                    die('Error: ' . mysqli_error($con));
                                }

                                // Generate the HTML markup for supplier records
                                $html = '';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $html .= '<tr>';
                                    $html .= '<td>' . $row['id'] . '</td>';
                                    $html .= '<td>' . $row['name'] . '</td>';
                                    $html .= '<td>' . $row['name'] . '</td>';
                                    $html .= '<td>
                                    <button class=" btn ">
                                     <a class="deleteBtn btn btn-info"  href="supplier_single_view.php">View</a></button>
                                   
                                    <button class="deleteBtn btn btn-warning" data-id="' . $row['id'] . '">Update</button>
                                    <button class="deleteBtn btn btn-danger" data-id="' . $row['id'] . '">Delete</button>
                                    </td>';
                                    $html .= '</tr>';
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
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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
</script>
<?php
require('pages/footer.php');
?>