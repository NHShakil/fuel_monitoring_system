<?php
    $cakeDescription = __d('cake_dev', 'Massive Electronics: Save,for live');
?>

<!DOCTYPE html>
<html>
<head>  
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
    </title>

    <?php
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css(
            [
                'uy-sys',
                'check_box',
                '/bootstrap/css/bootstrap.min',
                '/bootstrap/css/bootstrap-theme.min',
                '/css/font-awesome/css/font-awesome.min.css'
            ]
        );

        echo $this->Html->css(
            [
                '/Dropdown/jquery.lwMultiSelect'
            ]
        );


        echo $this->Html->css('uy-sys');
        echo $this->Html->css(array('AdminLTE.min', '_all-skins.min','morris','style','treemenu'));
        echo $this->Html->meta('icon');
        echo $this->Html->script(array('jquery','layout','jquery.lwMultiSelect','treeView','treeviewjs'));
        echo $this->Html->script(array('bootstrap.min', 'jquery-ui.min','app.min','jquery.slimscroll.min','demo'));
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
		    <a href="<?php echo $this->base;?>/testings/dashboard" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>M</b>ass</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Massive</b><small>Electronics</small></span>
        	</a>

        	<nav class="navbar navbar-static-top" role="navigation">
        		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        		<span class="sr-only">Toggle navigation</span>
        		</a>
        		<div class="navbar-custom-menu">
        			<ul class="nav navbar-nav">
         				<li class="dropdown user user-menu">

        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $this->Html->image('logo.png', ['class' => 'user-image']); ?>
         						<?php $this->User = ClassRegistry::init('User');?>
        						<span class="hidden-xs">
        							<?php if (AuthComponent::user('id')): ?>
        							<?= AuthComponent::user('username') ?>
        						<?php endif; ?>
        						</span>
        					</a>


         					<ul class="dropdown-menu">
        						<li class="user-header">
                                    <?php echo $this->Html->image('logo.png', ['class' => 'img-square']); ?>
                                    <br>
        						    <p>
        							    <?= AuthComponent::user('username') ?>
        						    </p>
        						</li>
        						<li class="user-footer">
        							<div class="pull-left">
        								<?php
                                            echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit</span>', array('controller'=>'profiles','action' => 'edit', AuthComponent::user('id')), array('escape'=>false,'class'=>'btn btn-info'));
                                    	?>
        							</div>
        							<div class="pull-right">
                                        <?php
                                            echo $this->Html->link('<span> Log Out</span>', array('controller'=>'users','action'=>'logout'), array('escape'=>false,'class'=>'btn btn-danger'));
                                        ?>
                                    </div>
        						</li>
        					</ul>
        				</li>
        			</ul>
        		</div>
        	</nav>
		</header>
 		<aside class="main-sidebar">
			<section class="sidebar" style="font-size: 14px; font-family: 'Cambria', Georgia, Serif;">
				<ul class="sidebar-menu" >
					<li class="header">MAIN NAVIGATION</li>
                    <li class="active"><a href="<?php echo $this->base;?>/testings/dashboard"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>

                    <li class="active"><a href="<?php echo $this->base;?>/reports/index"><i class="fa fa-file"></i><span>Report</span></a></li>


                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cog"></i><span>Site Management</span><i class="fa fa-angle-left pull-right"></i>
                        </a>


                        <ul class="treeview-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-cog"></i><span>Site</span><i class="fa fa-angle-left pull-right"></i>
                                </a>

                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo $this->Html->link('Add Site',array('controller' => 'sites', 'action' => 'add'));?>                              
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link(' Manage Site',array('controller'=>'sites','action'=> 'index'));?>                                
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-cogs"></i><span>Zone</span><i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo $this->Html->link('Add Zone',array('controller' => 'zones', 'action' => 'add'));?>          
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link(' Manage Zone',array('controller'=>'zones','action'=>'index'));?> 
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Users Management</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-edit"></i> <span>Users Role</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <?php echo $this->Html->link('Add roles',array('controller' => 'roles', 'action' => 'add'));?>
                                            
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link('Manage roles',array('controller'=>'roles','action'=>'index'));?>
                                    </li>
                                </ul>
                            </li>


                            <li>
                                <a href="#">
                                    <a href="<?php echo $this->base;?>/logintables/index"><i class="fa fa-users"></i><span>Users Login History</span></a>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <a href="<?php echo $this->base;?>/users/index"><i class="fa fa-users"></i><span>All Users Profile</span></a>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo $this->base;?>/users/logout"><i class="fa fa-times-circle-o"></i> <span>Log Out</span></a>
                    </li>
                </ul>
			</section>
        </aside>
        

        <div class="control-sidebar-bg"></div>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2015 <a href="http://massiveelectronicsbd.com/" target="_blank">American Telecom</a>.</strong> All rights reserved.
        </footer>
	</div>

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>   
</body>
</html>

