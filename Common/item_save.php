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

                        <div class="alert alert-warning m-none">
                            New Sale
                        </div>
                        <h1>
                            <span><i class="bi bi-table me-2"></i></span> Sales Invoice
                        </h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-sm">
                                <div>
                                    <div class="col-md-6">
                                        <label for="">Name :-</label>
                                        <div class="col-md-4">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected>Mr.</option>
                                                <option value="1">Mrs.</option>
                                                <option value="2">Miss.</option>
                                            </select>
                                            <input type="Text" name="telephone" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>

                                <div>
                                    <label for="">Gender</label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Male</option>
                                        <option value="1">Female</option>
                                        <option value="2">Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="">NIC</label>
                                    <input type="tel" name="telephone" id="" class="form-control" required>
                                </div>

                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>


                            </div>
                            <div class="col-sm">
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                                <div>
                                    <label for="">Telephone</label>
                                    <input type="tel" name="telephone" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1" class="form-label "><b></b></label>
                                        <select class="form-select form-select-sm " aria-label=".form-select-sm example">
                                            <option selected>Mr.</option>
                                            <option value="1">Mrs.</option>
                                            <option value="2">Miss.</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1" class="form-label"><b> Quantity</b></label>
                                        <input type="number" name="quantity" min="0" max="100" step="1" class="form-control">

                                    </div>

                                </div>

                                <!-- <div class="input-group">
                                    <input type="number" class="form-control" name="quantity" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fas fa-caret-up"></i></button>
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-caret-down"></i></button>
                                    </div>
                                </div> -->

                                <button type="button" class="btn btn-outline-primary">+Add to List</button>

                            </div>
                        </div>
                        <form action="">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <td>No</td>
                                        <td>Item Name</td>
                                        <td>Warrenty</td>
                                        <td>Unit Price</td>
                                        <td>Total ( P X Q )</td>
                                        <td>-</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;

                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td><button class="btn btn-danger rounded-circle">
                                                -
                                            </button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-success">Print</button>
                            <button class="btn btn-success">Print</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
</main>







<?php
include('pages/footer.php');
?>