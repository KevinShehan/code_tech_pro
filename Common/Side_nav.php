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
                <div class="card text-dark " style="width: 60px; height:60px;">
                  <div class="card-body">
                    <img src="assets/images/dashboard/user_logo.png" alt="" srcset="" style="width: 30px; margin: 5px;">
                  </div>
                </div>
                Kevin Perera
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
            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="my-5">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            Employee Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#employeeMenu">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
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
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>View Employee</span>
                </a>
              </li>
              <li>
                <a href="emp_save.php" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
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
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#SupplierMenu">
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
            Sales Management
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Sales</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="layouts">
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