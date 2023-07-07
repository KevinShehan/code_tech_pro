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
                        <span><i class="bi bi-table me-2"></i></span>Sales Report
                    </div>
                    <div class="card-body">
                        <table class="table" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // Fetch data from table MONTH(date) = 2
                                $sql = "SELECT * FROM v3.invoice ";
                                $result =  mysqli_query($con, $sql);

                                // Check if there are any records
                                if ($result->num_rows > 0) {

                                    $number = 1;
                                    // Loop through each record
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Display table row for each record
                                        $id = $row['id'];
                                        $code = $row['code'];
                                        $customers_id = $row['customers_id'];
                                        $total = $row['total'];
                                        $date = $row['date'];


                                        $cus = "SELECT  name FROM customer WHERE id = $customers_id ";
                                        $cus_result=mysqli_query($con,$cus);
                                        $row1 = mysqli_fetch_assoc($cus_result)['name'];
                                        echo '<tr>';
                                        echo '<td>' . $number . '</td>';
                                        echo '<td>' . $code . '</td>';
                                        echo '<td>' .  $row1 . '</td>';
                                        echo '<td>' . $total . '</td>';
                                        echo '<td>' . $date . '</td>';
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