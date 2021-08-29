
<?php
    $cakeDescription = __d('cake_dev', 'American Telecom:');
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8" name="www.massiveelectronicsbd.com">
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
    </title>


    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    
    <!-- Ionicons -->
    <?php echo $this->Html->meta('icon'); ?>

    
    <?php echo $this->Html->css(
            [
                'uy-sys',
                'check_box',
                'dashboard_test',
                '../AdminLTE/plugins/fontawesome-free/css/all.min',
                '../AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min',
                '../AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min',
                '../AdminLTE/plugins/jqvmap/jqvmap.min',
                '../AdminLTE/dist/css/adminlte.min',
                '../AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min',
                '../AdminLTE/plugins/daterangepicker/daterangepicker',
                '../AdminLTE/plugins/summernote/summernote-bs4',
                '../AdminLTE/plugins/jsgrid/jsgrid.min',
                '../AdminLTE/plugins/jsgrid/jsgrid-theme.min',
                '../AdminLTE/plugins/daterangepicker/daterangepicker.css'
            ]
        );
    ?>

    <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

    ?>

    

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-blue navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>


                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $this->base;?>/testings/dashboard" class="nav-link">Home</a>
                </li>

                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->

            </ul>


            <!-- SEARCH FORM -->
            <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'testings', 'action'=>'search_bts')), array('class'=>'searchForm','data-role'=>'form')); ?>
                
                <div class="input-group input-group-sm">
                    <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'aria-label'=>'Search','class'=>'form-control form-control-navbar', 'placeholder'=>'Search key words'));?>
                    
  
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                </div>

            <?php echo $this->Form->end(); ?>



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
            <a href="<?php echo $this->base;?>/testings/dashboard" class="brand-link">
                <?php echo $this->Html->image('../AdminLTE/dist/img/AdminLTELogo.png', ['class' => 'user-image brand-image img-circle elevation-3','style'=>'opacity:0.8']); ?>
                <span class="brand-text font-weight-light">American Telecom</span>
            </a>


            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $this->Html->image('logo.png', ['class' => 'user-image']); ?>
                <?php $this->User = ClassRegistry::init('User');?>
                <span class="hidden-xs">
                    <?php if (AuthComponent::user('id')): ?>
                    <?= AuthComponent::user('username') ?>
                <?php endif; ?>
                </span>
            </a> -->
                            


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                

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


                        <!-- <li class="nav-item has-treeview menu-open">

                            <a href="<?php echo $this->base;?>/reports/index" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Reports</p>
                            </a>
                            
                        </li> -->



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
                                            <a href="<?php echo $this->base;?>/zones/add" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p> Add Zone </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo $this->base;?>/zones/index" class="nav-link">
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

                        <!-- <li class="nav-item">
                            <a href="../AdminLTE/pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li> -->

                

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
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                    
                </div><!-- /.container-fluid -->
            </section>
        </div>




        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://massiveelectronicsbd.com/">American Telecom</a>.</strong>
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

    <?php echo $this->Html->script(
            [
                '../AdminLTE/plugins/jquery/jquery.min',
                '../AdminLTE/plugins/jquery-ui/jquery-ui.min',
                '../AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min',
                '../AdminLTE/plugins/chart.js/Chart.min',
                '../AdminLTE/plugins/sparklines/sparkline',
                '../AdminLTE/plugins/jqvmap/jquery.vmap.min',
                '../AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa',
                '../AdminLTE/plugins/jquery-knob/jquery.knob.min',
                '../AdminLTE/plugins/moment/moment.min',
                '../AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min',
                '../AdminLTE/plugins/summernote/summernote-bs4.min',
                '../AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
                '../AdminLTE/dist/js/adminlte',
                '../AdminLTE/dist/js/demo',
                '../AdminLTE/plugins/jsgrid/demos/db',
                '../AdminLTE/plugins/jsgrid/jsgrid.min',
                '../AdminLTE/plugins/daterangepicker/daterangepicker',
                '../AdminLTE/plugins/select2/js/select2.full.min',
                '../AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min'
            ]
        );
    ?>
    
    <!-- Js Grid -->
    <!--<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
    
</body>
</html>

