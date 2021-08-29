<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../AdminLTE/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../AdminLTE/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../AdminLTE/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>


                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../AdminLTE/index3.html" class="nav-link">Home</a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
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

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../AdminLTE/index3.html" class="brand-link">
                <img src="../AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <li class="nav-item has-treeview menu-open">

                            <a href="<?php echo $this->base;?>/testings/dashboard" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                            
                        </li>


                        <li class="nav-item has-treeview menu-open">

                            <a href="<?php echo $this->base;?>/reports/index" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Reports</p>
                            </a>
                            
                        </li>



                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Sites And Zone
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>


                            <ul class="nav nav-treeview">
                            
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Sites
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>


                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo $this->base;?>/sites/add" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Add Site </p>
                                            </a>
                                        </li>


                                        <li class="nav-item">
                                            <a href="<?php echo $this->base;?>/sites/index" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Manage Site</p>
                                            </a>
                                        </li>
                                
                                    </ul>
                                </li>


                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Zones
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p> Add Zone </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Manage Zone</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>


                            <ul class="nav nav-treeview">
                            
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>
                                            Users Role
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>


                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?php echo $this->base;?>/roles/add" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add Role </p>
                                            </a>
                                        </li>


                                        <li class="nav-item">
                                            <a href="<?php echo $this->base;?>/roles/index" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Manage Roles</p>
                                            </a>
                                        </li>
                                
                                    </ul>
                                </li>


                                <li class="nav-item has-treeview">
                                    <a href="<?php echo $this->base;?>/logintables/index" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>Users Login History</p>
                                    </a>
                                </li>

                                <li class="nav-item has-treeview">
                                    <a href="<?php echo $this->base;?>/users/index" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>All Users Profile</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-item has-treeview menu-open">

                            <a href="<?php echo $this->base;?>/users/logout" class="nav-link">
                                <i class="nav-icon fas fa-circle-o"></i>
                                <p>Logout</p>
                            </a>
                            
                        </li>

                

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../AdminLTE/pages/charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="../AdminLTE/pages/charts/flot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Flot</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="../AdminLTE/pages/charts/inline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inline</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->



                        <!-- <li class="nav-item has-treeview">

                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="pages/tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="pages/tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DataTables</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="pages/tables/jsgrid.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>jsGrid</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->



                        <!-- <li class="nav-header">EXAMPLES</li>

                        <li class="nav-item">
                            <a href="../AdminLTE/pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../AdminLTE/pages/gallery.html" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Gallery
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-info"></i>
                                <p>Informational</p>
                            </a>
                        </li> -->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid"> 
                    Noman
                </div><!-- /.container-fluid -->
            </section>
        </div>




        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://massiveelectronicsbd.com/">Massive Electronics</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
            </div>
        </footer>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../AdminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../AdminLTE/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../AdminLTE/plugins/moment/moment.min.js"></script>
    <script src="../AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../AdminLTE/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../AdminLTE/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../AdminLTE/dist/js/demo.js"></script>
</body>
</html>
