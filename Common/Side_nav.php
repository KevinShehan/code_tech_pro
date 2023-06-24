<style>
  .li-top:hover {
    background-color: #0070fc;
    color: white;
    /* Background color on hover */
  }
</style>

<?php


function privilledge()
{
  if ($_SESSION['user_role'] == 'admin') {
  } else {
    if ($_SESSION['user_role'] == 'cashier') {
    } else {
      if ($_SESSION['user_role'] == 'technician') {
      } else {
      }
    }
  }
}
?>


<div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <!-- Menu items -->
        <li>
          <!-- Profile card -->
          <div class="card" style="background-color: #202529;color:aliceblue; border-color:aqua">
            <div class="card-body">
              <a href="Profile.php" target="_self" rel="noopener noreferrer" style=" text-decoration: none; color:white;">



                <!-- <img src="assets/images/dashboard/user_logo.png" alt="" srcset="" style="width: 30px; margin: 5px;"> -->
                <?php
                include('config/dbconnection.php');

                // Assuming you have established a database connection
                $username = $_SESSION["username"];

                // Fetch the employee data from the database
                $query = "SELECT employee.photo FROM employee JOIN user ON employee.id = user.employee_id  WHERE user.username = '$username'";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $imagePath = $row['photo'];

                  if (file_exists($imagePath)) {
                    // Step 3: Create the image tag
                    $imageTag = '<img src="' . $imagePath . '" alt="profile_image" style="width:50px;height:50px; border-radius: 50%; object-fit: cover; float: left;" class="shadow">';
                  } else {
                    $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:50px;height:50px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
                  }
                } else {
                  $imageTag = '<img src="Assets/images/dashboard/user_logo.png" alt="profile_image_alt" style="width:50px;height:50px; border-radius: 50%; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); float: left;" class="shadow">';
                }

                // Step 4: Output the image tag
                echo $imageTag;
                ?>


                <div style="float: right;">
                  <?php


                  $username = $_SESSION["username"];

                  // Execute the SQL query
                  $query = "SELECT employee.callingname FROM employee JOIN user ON user.employee_id = employee.id WHERE user.username = '$username'";
                  $result1 = mysqli_query($con, $query);

                  // Check if any rows were returned
                  if (mysqli_num_rows($result1) > 0) {
                    // Fetch the calling name from the query result
                    $row = mysqli_fetch_assoc($result1);
                    $callingName = $row['callingname'];

                    // Output the calling name
                    echo $callingName;
                  }
                  ?>
                <br/>



                  <span class="text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                      <circle cx="4" cy="4" r="4" />
                    </svg>
                  </span>
                  <?php
                  echo $_SESSION["user_role"]; ?>
                </div>

              </a>
            </div>
          </div>
        </li>
        <li>
          <!-- Overview item -->
          <div class="text-muted small fw-bold text-uppercase px-3">
            OVERVIEW
          </div>
        </li>
        <li>
          <!-- Dashboard item -->
          <a href="dashboard.php" class="nav-link px-3 active">
            <span class="me-2"> <i class="fa fa-tachometer-alt"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="my-2">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3 ">
            <i class="fas fa-users"></i>
            Employee Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#employeeMenu">
            <span class="me-2"> <i class="fas fa-users"></i></i></span>
            <span>Employee</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="employeeMenu">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="viewusers.php" class="nav-link px-3">
                  <span class="me-2"><i class="fa fa-address-book"></i></span>
                  <span>View Employees</span>
                </a>
              </li>
              <li>
                <a href="emp_save.php" class="nav-link px-3">
                  <span class="me-2"><i class="fa fa-user-plus"></i></i></span>
                  <span>Add Employee</span>
                </a>
              </li>
            </ul>
          </div>
        </li>







        <li class="my-6">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Suplier Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#SupplierMenu">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Supplier</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="SupplierMenu">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="supplier_save.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Add Supplier</span>
                </a>
              </li>
              <li>
                <a href="supplier_view.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>View Supplier List</span>
                </a>
              </li>
            </ul>
          </div>
        </li>




        <li class="my-6">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Item Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#itemsMenu">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Items</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="itemsMenu">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="item_add.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>New Item</span>
                </a>
              </li>
              <li>
                <a href="supplier_view.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>View Items</span>
                </a>
              </li>
            </ul>
          </div>
        </li>



        <li class="my-6">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Sales Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#salesMenu">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Sales</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="salesMenu">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="sales_save.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>New Invoices</span>
                </a>
              </li>
              <li>
                <a href="supplier_view.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Sales Invoices</span>
                </a>
              </li>
            </ul>
          </div>
        </li>



        <li class="my-7">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Purchase Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#purchaseMenu">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Purchase</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="purchaseMenu">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="sales_save.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Supplier Report</span>
                </a>
              </li>
              <li>
                <a href="supplier_view.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Employee Reports</span>
                </a>
              </li>
            </ul>
          </div>
        </li>


        <li class="my-8">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            <i class="fa fa-chart-line"></i>
            Report Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#reportMenu">
            <span class="me-2"> <i class="fa fa-chart-line"></i></span>
            <span>Report</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="reportMenu">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="change_pw.php" class="nav-link px-3">
                  <span class="me-2"> <i class="fa fa-chart-line"></i></span>
                  <span>Customer Report</span>
                </a>
              </li>
              <li>
                <a href="supplier_view.php" class="nav-link px-3">
                  <span class="me-2"> <i class="fa fa-chart-line"></i></span>
                  <span>Supplier Reports</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="my-8">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Profile Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#layouts">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Profile</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="layouts">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="change_pw.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Change Password</span>
                </a>
              </li>
              <li>
                <a href="supplier_view.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Employee Reports</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- Pages item -->

        <!-- Other menu items -->
      </ul>
    </nav>
  </div>
</div>

<script>
  // Get all sidebar links with collapse behavior
  const sidebarLinks = document.querySelectorAll('.sidebar-link[data-bs-toggle="collapse"]');

  // Add click event listener to each sidebar link
  sidebarLinks.forEach(link => {
    link.addEventListener('click', () => {
      const targetId = link.getAttribute('href');

      // Collapse all menus
      sidebarLinks.forEach(otherLink => {
        const otherTargetId = otherLink.getAttribute('href');
        if (otherTargetId !== targetId) {
          const otherMenu = document.querySelector(otherTargetId);
          if (otherMenu.classList.contains('show')) {
            otherLink.click();
          }
        }
      });
    });
  });
</script>