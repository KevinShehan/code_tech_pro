<style>
  .card-row1:hover {
    transform: scale(1.1);
  }

  a {
    text-decoration: none;
  }
</style>
<!-- offcanvas -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4>Dashboard
        </h4>
      </div>
    </div>



    <div class="row">
      <div class="col-md-3 mb-3">
        <div class="card t-card bg-primary text-white h-100 ">
          <div class="card-body ">
            <div>
              <style>
                @keyframes shake {
                  0% {
                    transform: translateX(0);
                  }

                  25% {
                    transform: translateX(-1px) rotate(-1deg);
                  }

                  50% {
                    transform: translateX(1px) rotate(1deg);
                  }

                  75% {
                    transform: translateX(-1px) rotate(-1deg);
                  }

                  100% {
                    transform: translateX(0);
                  }
                }

                .shake-image {
                  animation: shake 3.0s infinite;
                }
              </style>

              <img src="Pages/dash_card/team.png" id="shake-image" class="card-img-top card-row1" alt="Image Description" style="width:25%; float: right;">

              <script>
                window.onload = function() {
                  const image = document.getElementById('shake-image');
                  image.classList.add('shake-image');
                };
              </script>

            </div>
            <div class="mt-5">
              <h6>
                Customers
              </h6>
            </div>
            <?php
            //offcanvas data calculation
            include('config/dbconnection.php');


            $query_supplier = "SELECT COUNT(*) supplier_count FROM v3.customer";
            // $result_supplier = mysqli_query($con, $query_supplier);

            $result = $con->query($query_supplier);

            if ($result) {
              // Fetch the count value
              $row = $result->fetch_assoc();
              $supplierCount = $row['supplier_count'];

              // Convert the count to a string
              $countAsString = strval($supplierCount);

              // Display the count on the web page
              echo '<h2>' . $countAsString . '</h2>';

              // Free the result set
              $result->free_result();
            } else {
              // Handle the query error
              echo "Error: " . $con->error;
            }

            ?>
          </div>
          <?php $x = 1;
          if ($x == 2) { ?>
            <div class=" card-footer d-flex">
              <a href="../common/viewusers.php" class="text-light">
                View Details
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </a>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark h-100">
          <div class="card-body">
            <div>
              <img src="Pages/dash_card/supplier.png" class="card-img-top card-row1" alt="Image Description" style="width:25%; float: right;">
            </div>
            <div class="mt-5">
              <h6>
                Suppliers
              </h6>
            </div>

            <?php
            //offcanvas data calculation
            include('config/dbconnection.php');


            $query_supplier = "SELECT COUNT(*) supplier_count FROM v3.Supplier";
            // $result_supplier = mysqli_query($con, $query_supplier);

            $result = $con->query($query_supplier);

            if ($result) {
              // Fetch the count value
              $row = $result->fetch_assoc();
              $supplierCount = $row['supplier_count'];

              // Convert the count to a string
              $countAsString = strval($supplierCount);

              // Display the count on the web page
              echo '<h2>' . $countAsString . '</h2>';

              // Free the result set
              $result->free_result();
            } else {
              // Handle the query error
              echo "Error: " . $con->error;
            }

            ?>

          </div>
          <?php $x = 1;
          if ($x == 2) { ?>
          <div class="card-footer d-flex">
            <a href="../common/supplier_view.php" class="text-light">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </a>
          </div>
          <?php }?>
        </div>

      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
          <div class="card-body ">
            <div>
              <img src="Pages/dash_card/Stand.png" class="card-img-top card-row1" alt="Image Description" style="width:25%; float: right;">
            </div>
            <div class="mt-5">
              <h6>
                Catergory
              </h6>
            </div>
            <?php
            //offcanvas data calculation
            include('config/dbconnection.php');


            $query_supplier = "SELECT COUNT(*) supplier_count FROM v3.category";
            // $result_supplier = mysqli_query($con, $query_supplier);

            $result = $con->query($query_supplier);

            if ($result) {
              // Fetch the count value
              $row = $result->fetch_assoc();
              $supplierCount = $row['supplier_count'];

              // Convert the count to a string
              $countAsString = strval($supplierCount);

              // Display the count on the web page
              echo '<h2>' . $countAsString . '</h2>';

              // Free the result set
              $result->free_result();
            } else {
              // Handle the query error
              echo "Error: " . $con->error;
            }

            ?>
          </div>
          <?php $x = 1;
          if ($x == 2) { ?>
          <div class="card-footer d-flex">
            <a href="../common/category_views.php" class="text-light">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </a>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white h-100">
          <div class="card-body ">
            <div>
              <img src="Pages/dash_card/pc-tower.png" class="card-img-top card-row1" alt="Image Description" style="width:25%; float: right;">
            </div>
            <div class="mt-5">
              <h6>
                Items
              </h6>
            </div>
            <?php
            //offcanvas data calculation
            include('config/dbconnection.php');


            $query_supplier = "SELECT COUNT(*) supplier_count FROM v3.item";
            // $result_supplier = mysqli_query($con, $query_supplier);

            $result = $con->query($query_supplier);

            if ($result) {
              // Fetch the count value
              $row = $result->fetch_assoc();
              $supplierCount = $row['supplier_count'];

              // Convert the count to a string
              $countAsString = strval($supplierCount);

              // Display the count on the web page
              echo '<h2>' . $countAsString . '</h2>';

              // Free the result set
              $result->free_result();
            } else {
              // Handle the query error
              echo "Error: " . $con->error;
            }

            ?>
          </div>
          <?php $x = 1;
          if ($x == 2) { ?>
          <div class="card-footer d-flex">
            <a href="../common/supplier_view.php" class="text-light">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </a>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <div class="card h-100">
          <div class="card-header">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
          
            Monthly Sales Details
          </div>
          <div class="card-body">
          <div id="bar_chart_div" style="width: 100%; height: 100%;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card h-100">
          <div class="card-header">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
            Purchased Item Analyze
          </div>

          <div class="card-body">
            <!-- <canvas class="chart" width="400" height="200"></canvas> -->
  
   
 
            <div id="pie_chart_div" style="width: 100%; height: 100%;"></div>


            <!-- <div id="piechart" style="width: 100%; height: 100%;"></div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            <span><i class="bi bi-table me-2"></i></span> Data Table
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped data-table" style="width: 100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </thead>
                <tbody>
                 
         
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</main>