<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin | Dashboard</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="stylesheet" href="/css/custom.css">

   

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper"  id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/images/shield.png" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CTM Ministry</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/man.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{ Auth::user()->name}} 
            
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
           Dashboard
            </p>
        </a>
        </li>
        <li class="nav-item">
            <a href="/children" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Children
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/guardians" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Guardians
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/teachers" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                Teachers
                </p>
            </a>
        </li>
        <li class="nav-item">
          <a href="/attendance" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
              Attendance
              </p>
          </a>
      </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                    Administrative
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/users" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Manage User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/change-password')}}" class="nav-link">
                  <i class="nav-icon fa-user"></i>
                  <p>Change Password</p>
                </a>
              </li>
            
            </ul>
          </li>
          <li class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="nav-icon fa fa-power-off"></i>
                    <p>
                            Logout
                    </p>
                </a>
            </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        @yield('content')

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="">Admin Dashboard</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/js/app.js"></script>
<script src="/js/adminlte.min.js"></script>
<script src="/js/select2.full.min.js"></script>

</body>
</html>
