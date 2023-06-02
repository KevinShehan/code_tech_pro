<?php
//update supplier

include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

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

<div class="content">
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-sitemap  " aria-hidden="true"></i><a href="#">Supplier</a></li>
          
        </ul>
    </div>
</div> 

                <div class="row">
                
                                <div class="alert alert-warning m-none">
                                    Update Supplier
                                </div>
                           
                    <div class="col-md-8 col-md-offset-2 col-lg-12 col-lg-offset-0">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form class="form-horizontal form-stripe" method="post" enctype='multipart/form-data'>
                                        <h6 class="mb-xlg text-center"><b> </b></h6>
										
										<div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Supplier ID
											
											</label>
											
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="supplier_id" value="<?php echo($supplier_id)?>" readonly>
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Supplier Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="supplier_name" value="<?php echo($supplier_name)?>" >
                                            </div>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">Supplier Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"  name="supplier_address" value="<?php echo($supplier_address)?>" required>
                                            </div>
                                        </div>
										
										
										
									 <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label">Supplier Contact</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"  name="supplier_contact" value="<?php echo($supplier_contact)?>" onkeypress="return isNumberKey(evt)" onchange="phonenumber()" id="txtTell" required >
                                            </div>
                                        </div>	
										
										
                                      
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary" name="submit" >  Update Supplier </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>





<?php
require('pages/footer.php');
?>