<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php
        $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
        $cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());

    ?>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css(array('AdminLTE.min', '_all-skins.min','morris','style'));
        echo $this->Html->script(array('jquery-1.11.3.min.js', 'bootstrap.min', 'jquery-ui.min','app.min.js','jquery.slimscroll.min.js','demo.js'));
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

    <link rel="stylesheet" href="Login_CSS/bootstrap/css/bootstrap.min.css">

</head>

<style>
    .image{
        background: url(Login_CSS/20200222_162516_new_1.jpg);   
        background-repeat: no-repeat;
        opacity: 0.8; 
    }   
</style>


<body class="hold-transition login-page image">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>American</b>Telecom</a>
        </div>
        <div class="panel panel-default" style="opacity:1.0">
                
            <div class="panel-heading " ><span class="glyphicon glyphicon-lock" style="font-size: 12px;"></span><?php echo ' ';?> Login
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('User', array(
                    'url' => array(
                        'controller' => 'users',
                        'action' => 'login'
                        )
                    )
                );?>
                <div class="form-group has-feedback">
                    <?php echo $this->Form->input('username',array('class' => 'form-control','placeholder'=>'Username','label' => false));?>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>


                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?php echo $this->Form->input('password',array('class' => 'form-control','placeholder'=>'Password','label' => false));?>
                </div>


                <div class="row">
                
                    <div class="col-xs-3" >
                        <img src="Login_CSS/logo.png" style="height: 30px; margin-top: 10px;">
                    </div>


                    <div class="col-xs-4" style="padding-left: 30px;">
                        <?php echo $this->Form->button('Reset',array('type'=>'reset','class' => 'btn btn-primary btn-block btn-flat btn-warning','label'=>false,'style' =>'margin-top: 28px; border-radius: 5px; width: 90px; font-size: 16px;'));?>
                    </div>
                
                    <div class="col-xs-5" style="padding-left: 30px;">
                        <?php echo $this->Form->button('Sign In',array('type'=>'submit','class'=>'btn btn-primary btn-block btn-flat btn-success','label'=>false,'style' =>'margin-top: 28px; border-radius: 5px; width: 90px; font-size: 16px;')); ?>
                        <?php echo $this->Form->end();?>
                    </div>
                        
                    <!-- /.col -->
                </div>
            </div>
        </div>
    <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->

    <script rel="stylesheet" href="Login_CSS/dist/css/AdminLTE.min.css"></script>


    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
    $(function () {
        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
        });
    });
    </script>
</body>
</html>