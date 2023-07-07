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
                        <span><i class="bi bi-table me-2"></i></span> Purchase Report
                    </div>
                    <div class="card-body">
                        <table class="table" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Supplier Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // Fetch data from table
                                $sql = "SELECT * FROM v3.purchase";
                                $result =  mysqli_query($con, $sql);

                                // Check if there are any records
                                if ($result->num_rows > 0) {

                                    $number = 1;
                                    // Loop through each record
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Display table row for each record
                                        $id = $row['id'];
                                        $date = $row['date'];
                                        $total = $row['total'];
                                        $supplier_id = $row['Supplier_id'];

                                        $sup = "SELECT DISTINCT name FROM supplier WHERE id = $supplier_id";
                                        $sup_result=mysqli_query($con,$sup);
                                        $row1 = mysqli_fetch_assoc($sup_result)['name'];
                                     
                                        echo '<tr>';
                                        echo '<td>' . $number . '</td>';
                                        echo '<td>' . $date . '</td>';
                                        echo '<td>' .  $row1 . '</td>';
                                        echo '<td>' . $total  . '</td>';
                                      
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