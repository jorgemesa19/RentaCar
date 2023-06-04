<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href='../dashboard/dashboard.php' class='nav-link'><p style='font-size:20px;'>Car Rental System</p></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="../uploads/<?php echo $profile_image;?>" class="img-circle elevation-2" alt="User Image" style="height:35px;">
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="card-body box-profile">

                <h3 class="profile-username text-center"><?php echo $user_full_name; ?></h3>


                <ul class="list-group list-group-unbordered mb-3">
                </ul>
                <a href="../login/login.php" class="btn btn-sm btn-primary btn-block"><b>Logout</b></a>
              </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-1">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
       Car Rental System
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
        <?php
        if ($_SESSION['user_type'] == "Administrator"){
            include 'sidebar-admin.php';
        }
        if ($_SESSION['user_type'] == "Owner"){
            include 'sidebar-owner.php';
        }
        if ($_SESSION['user_type'] == "Customer"){
            include 'sidebar-customer.php';
        }
        ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar         -->
  </aside>