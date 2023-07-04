<?php
include('config/dbconnection.php');
require('pages/functions/priveleges_functions.php');
require('pages/functions/side_nav_functions.php');
require('pages/css/side_nav_css.php');
?>

<!-- <div id="sideNavigation" class="simplebar"> -->
<!-- Your side navigation content here -->

<?php
$username = $_SESSION["username"];
$status_query = "SELECT employeestatus_id from employee where  email='$username' ";
$status_result = mysqli_query($con, $status_query);
// Check if the query executed successfully
if ($status_result) {
  // Fetch the result
  $row = mysqli_fetch_assoc($status_result);
  $employeestatus_id = $row['employeestatus_id'];
  $_SESSION["employeestatus_id"] = $employeestatus_id;

  // Echo the result
  echo $employeestatus_id;
} else {
  // Query execution failed
  echo "Error executing query: " . mysqli_error($con);
}
?>

<div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar" style="background-color: #1e2d32;width: 250px;">
  <div class="offcanvas-body p-2" style="background-color: #1e2d32;width: 250px;">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <!-- Menu items -->
        <li>
          <!-- Profile card -->
          <div class="card" style="background-color: #202529;color:aliceblue; border-color:aqua">
            <div class="card-body">
              <a href="Profile.php" target="_self" rel="noopener noreferrer" style=" text-decoration: none; color:white;">
                <!-- <img src="assets/images/dashboard/user_logo.png" alt="" srcset="" style="width: 30px; margin: 5px;"> -->
                <?php image($con); ?>

                <div style="float: right;">
                  <?php callname($con); ?>


                  <br />
                  <?php $status = $_SESSION["employeestatus_id"];
                  if ($status == 1) {
                    echo ' <span class="text-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                      <circle cx="4" cy="4" r="4" />
                    </svg>
                  </span>';
                  } else {
                    echo '  <span class="text-success shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-circle-fill" viewBox="0 0 16 16">
                      <circle cx="4" cy="4" r="4" />
                    </svg>
                  </span>';
                  }

                  echo $_SESSION["user_role"]; ?>
                </div>
              </a>
            </div>
          </div>
        </li>
        <?php
        if ($status == 1) {
        ?>
          <li>
            <!-- Overview item -->
            <div class="text-muted small fw-bold text-uppercase px-3 mt-2">
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




          <!-- <li class="my-1" id="">
          <hr class="dropdown-divider bg-light" />
        </li> -->
          <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3 ">
            <i class="fas fa-users"></i>
            Employee Management
          </div>
        </li> -->

          <?php if (in_array('view_customer', $allowedUseCases)) : ?>
            <li class="my-7">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Purchase Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#customerMenu">
                <span class="me-2"><span class="fas fa-person-booth"></span></span>
                <span>Customer</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="customerMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('create_customer', $allowedUseCases)) : ?>
                    <li>
                      <a href="sales_save.php" class="nav-link px-3">
                        <span class="me-2"><span class="fas fa-plus-circle"></span></span>
                        <span>Add Customer</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('view_customer', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"><span class="fas fa-table"></span></span>
                        <span>View Customers</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>



          <?php if (in_array('view_sale', $allowedUseCases)) : ?>
            <li class="my-6">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Sales Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#salesMenu">
                <span class="me-2"><span class="fas fa-dollar-sign"></span></span>
                <span>Sales</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="salesMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('create_sale', $allowedUseCases)) : ?>
                    <li>
                      <a href="sales_save.php" class="nav-link px-3">
                        <span class="me-2"> <span class="fas fa-file-invoice-dollar"></span> </span>
                        <span>New Invoices</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('view_sale', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"> <span class="fas fa-list"></span></span>
                        <span>Sales Invoices</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>



          <?php if (in_array('view_item', $allowedUseCases)) : ?>
            <li class="my-6">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Item Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#itemsMenu">
                <span class="me-2"><i class="fas fa-shopping-basket"></i></span>
                <span>Items</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="itemsMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('create_item', $allowedUseCases)) : ?>
                    <li>
                      <a href="item_add.php" class="nav-link px-3">
                        <span class="me-2"> <span class="fas fa-plus"></span> </span>
                        <span>New Item</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('view_item', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"><span class="fas fa-eye"></span></span>
                        <span>View Items</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>



          <?php if (in_array('view_sale', $allowedUseCases)) : ?>
            <li class="my-6">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Sales Management
          </div>
        </li> -->
            <li id="delete_supplier">
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#categoryMenu">
                <span class="me-2"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                <span>Category</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="categoryMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('view_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="category_save.php" class="nav-link px-3">
                        <span class="me-2"><span class="fas fa-tags"></span></span>
                        <span>Categories</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <!-- <li>
                <a href="category_view.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>View Categories</span>
                </a>
              </li> -->
                </ul>
              </div>
            </li>
          <?php endif; ?>
























          <?php if (in_array('create_user', $allowedUseCases)) : ?>
            <li class="my-6">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Suplier Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#QuotationMenu">
                <span class="me-2"><span class="fas fa-file-invoice"></span></span>
                <span>Quotation</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="QuotationMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('view_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="Quotation_add.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-chat-left-quote"></i></span>
                        <span>New Quotation</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('create_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="Quotation_view.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-list"></i></span>
                        <span>Quotation List</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>



          <?php if (in_array('create_user', $allowedUseCases)) : ?>
            <li class="my-6">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Suplier Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#SupplierMenu">
                <span class="me-2"><span class="fas fa-truck"></span></span>
                <span>Supplier</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="SupplierMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('view_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_save.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-truck"></i></span>
                        <span>Add Supplier</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('create_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-users"></i></span>
                        <span>View Supplier List</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>






          <?php if (in_array('create_user', $allowedUseCases)) : ?>
            <li class="my-7">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Purchase Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#purchaseMenu">
                <span class="me-2"><span class="fas fa-shopping-cart"></span></span>
                <span>Purchase</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="purchaseMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('view_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="sales_save.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-cart-plus"></i></span>
                        <span>Create Purchase</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('create_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-history"></i></span>
                        <span>Purchase History</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>





          <?php if (in_array('create_user', $allowedUseCases)) : ?>
            <li class="my-7">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Purchase Management
          </div>
        </li> -->
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#returnMenu">
                <span class="me-2"><span class="fas fa-undo"></span></span>
                <span>Return</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="returnMenu">
                <ul class="navbar-nav ps-3">
                  <?php if (in_array('view_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="sales_save.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-reply"></i>
                        </span>
                        <span>Create return</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('create_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-history"></i>
                        </span>
                        <span>Return history</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>




          <?php if (in_array('create_user', $allowedUseCases)) : ?>
            <li class="my-7">
              <hr class="dropdown-divider bg-light" />
            </li>
            <li>
              <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#employeeMenu">
                <span class="me-2"> <i class="fas fa-users"></i></i></span>
                <span>Users</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="employeeMenu">
                <ul class="navbar-nav ps-3">
                <?php if (in_array('update_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="emp_save.php" class="nav-link px-3">
                        <span class="me-2"><i class="fa fa-user-plus"></i><i class="fa fa-sitemap" ></i></span>
                        <span>Add User</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('read_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="viewusers.php" class="nav-link px-3">
                        <span class="me-2"><i class="fa fa-address-book"></i></span>
                        <span>View Users</span>
                      </a>
                    </li>
                  <?php endif; ?>
               
                </ul>
              </div>
            </li>
          <?php endif; ?>



          <?php if (in_array('create_user', $allowedUseCases)) : ?>
            <li class="my-8">
              <hr class="dropdown-divider bg-light" />
            </li>
            <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            <i class="fa fa-chart-line"></i>
            Report Management
          </div>
        </li> -->
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
                  <?php if (in_array('view_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="change_pw.php" class="nav-link px-3">
                        <span class="me-2"> <i class="fas fa-chart-pie"></i>
                        </span>
                        <span>Customer Report</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array('create_user', $allowedUseCases)) : ?>
                    <li>
                      <a href="supplier_view.php" class="nav-link px-3">
                        <span class="me-2"><i class="fas fa-chart-pie"></i>
                        </span>
                        <span>Supplier Reports</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>

        <?php  } ?>
        <?php if (in_array('create_user', $allowedUseCases)) : ?>
          <li class="my-8">
            <hr class="dropdown-divider bg-light" />
          </li>
          <!-- <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Profile Management
          </div>
        </li> -->
          <li>
            <a class="nav-link px-3 sidebar-link li-top" data-bs-toggle="collapse" href="#layouts">
              <span class="me-2"><i class="fas fa-cog"></i></span>
              <span>Profile</span>
              <span class="ms-auto">
                <span class="right-icon">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </span>
            </a>
            <div class="collapse" id="layouts">
              <ul class="navbar-nav ps-3">
                <?php if (in_array('view_user', $allowedUseCases)) : ?>
                  <li>
                    <a href="change_pw.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-lock"></i></span>
                      <span>Change Password</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if (in_array('create_user', $allowedUseCases)) : ?>
                  <li>
                    <a href="profile.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-cog"></i></span>
                      <span>Profile Setting</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        <!-- Pages item -->

        <!-- Other menu items -->
      </ul>
    </nav>
  </div>
</div>



<!-- </div> -->
<?php
require('pages/js/side_nav_js.php'); ?>