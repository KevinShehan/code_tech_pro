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
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Item Name</th>
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
            </div>
</main>

<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable();
    });
</script>






<?php
include('pages/footer.php');
?>