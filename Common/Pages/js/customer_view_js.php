
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
                // Send AJAX request to emp_delete.php with the ID parameter
                $.ajax({
                    url: 'customer_delete.php?id=' + id,
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
        $('#supplierTable').DataTable();
    });


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
