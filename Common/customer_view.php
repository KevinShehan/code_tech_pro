<?php
//Auth employee
require('pages/Auth.php');

include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');

require('pages/js/customer_view_js.php');
require('pages/css/customer_save_css.php');
require('pages/functions/customer_view_functions.php');
?>


<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <span><i class="fas fa-user-friends"></i></span> Customers
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <style>
                                body {
                                    background-color: lightcyan;
                                }
                            </style>
                            <div class="form-group row" id="custom-input">
                                <div class="col-sm-5 ">
                                    <a href="customer_save.php" class="btn btn-success" value="Submit"> + Add Customer</a>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered" id="supplierTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    tbldata($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>



<?php
require('pages/footer.php');
?>