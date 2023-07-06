<?php
//Authentication
require('pages/Auth.php');
//Profile
include('config/dbconnection.php');
include('pages/Header.php');
include('Top_nav.php');
include('Side_nav.php');
?>

<style>
  body {
    background-color: lightcyan;
  }


  .dataTables_wrapper {
    margin-top: 20px;
    /* Adjust the margin value as per your needs */
  }

  .dataTables_filter {
    margin-bottom: 10px;
    /* Adjust the margin value as per your needs */
  }
</style>


<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h3>
              <span><i class="fas fa-folder"></i>
              </span> Category Update
            </h3>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" class="form-control" id="code" placeholder="Enter code" readonly>
              </div>
              <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" placeholder="Enter category">
              </div>
              <button type="button" class="btn btn-primary mt-2">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<?php include('pages/Footer.php'); ?>