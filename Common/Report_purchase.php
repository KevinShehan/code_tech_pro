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
                                    <th scope="col">id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Supplier Name</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="col">id</td>
                                    <td scope="col">2022-05-11</td>
                                    <td scope="col">KODAK SSD</td>
                                    <td scope="col">Amila Narangoda</td>
                                    <td scope="col">Rs 20000.00</td>
                                </tr>
                                <tr>
                                    <td scope="col">id</td>
                                    <td scope="col">2022-06-11</td>
                                    <td scope="col">PC Case</td>
                                    <td scope="col">Amila Narangoda</td>
                                    <td scope="col">Rs 5000.00</td>
                                </tr>
                                <tr>
                                    <td scope="col">id</td>
                                    <td scope="col">2022-05-11</td>
                                    <td scope="col">KBD  MPUse</td>
                                    <td scope="col">Amila Narangoda</td>
                                    <td scope="col">Rs 10000.00</td>
                                </tr>
                                <tr>
                                    <td scope="col">id</td>
                                    <td scope="col">2022-08-11</td>
                                    <td scope="col">Motherboard</td>
                                    <td scope="col">Amila Narangoda</td>
                                    <td scope="col">Rs 6000.00</td>
                                </tr>
                                <tr>
                                    <td scope="col">id</td>
                                    <td scope="col">2022-09-11</td>
                                    <td scope="col">Ear Bud</td>
                                    <td scope="col">Chethiya Kusal</td>
                                    <td scope="col">Rs 25000.00</td>
                                </tr>
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