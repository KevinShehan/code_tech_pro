<?php

include('config/dbconnection.php');
require('pages/Header.php');
require('Top_nav.php');
require('Side_nav.php');

?>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <span><i class="bi bi-table me-2"></i></span> Customer Report
                    </div>
                    <div class="card-body">
                        <table class="table" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">CustomerType</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // Fetch data from table
                                $sql = "SELECT * FROM v3.customer";
                                $result =  mysqli_query($con, $sql);

                                // Check if there are any records
                                if ($result->num_rows > 0) {

                                    $number = 1;
                                    // Loop through each record
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Display table row for each record
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $address = $row['address'];
                                        $contact = $row['Mobile1'];
                                        $customertype = $row['customertype_id'];


                                        $cus="select name from customertype where id=' $customertype'";
                                        $cus_result=mysqli_query($con,$cus);
                                        $row1 = mysqli_fetch_assoc($cus_result)['name'];
                                        echo '<tr>';
                                        echo '<td>' . $number . '</td>';
                                        echo '<td>' . $name . '</td>';
                                        echo '<td>' . $address . '</td>';
                                        echo '<td>' . $contact . '</td>';
                                        echo '<td>' .  $row1 . '</td>';
                                        echo '</tr>';
                                        $number++;
                                    }
                                } else {
                                    echo '<tr><td colspan="4">No records found.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <button class="no-print btn btn-primary  btn-lg float-right" onclick="printPage()">Print</button>
                        <script>
                            function printPage() {
                                var buttons = document.querySelector('.no-print');
                                buttons.style.display = 'none';
                                window.print();
                                buttons.style.display = 'block';
                            }
                        </script>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require('pages/Footer.php');
?>