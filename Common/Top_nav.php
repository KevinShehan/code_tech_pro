<!-- top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
    </button>
    <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold shadow" href="Dashboard.php">Code Technology</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="topNavBar">
      <!-- <form class="d-flex ms-auto my-3 my-lg-0">
        <div class="input-group">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form> -->
      <!-- <div class="d-flex justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">
                  <i class="fas fa-user"></i>
                  Profile</a>
              </li>
              <li><a class="dropdown-item" href="#">
                  <i class="fas fa-cog"></i>
                  Setting</a>
              </li>
              <li>
                <a class="dropdown-item" href="Pages/Logout.php">
                  <i class="fas fa-sign-out-alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div> -->


      <div class="container d-flex justify-content-end">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-fill"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="Profile.php">
            <i class="fas fa-user"></i>
            Profile
          </a>
          <a class="dropdown-item" href="Profile_edit.php">
            <i class="fas fa-cog"></i>
            Setting
          </a>
          <a class="dropdown-item" href="Pages/Logout.php">
            <i class="fas fa-sign-out-alt"></i> Log Out
          </a>
        </div>
      </li>
    </ul>
  </div>

    </div>
  </div>
</nav>