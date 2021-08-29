<?php

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());

?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
    echo $this->Html->css(array('AdminLTE.min', '_all-skins.min','morris','style'));
    echo $this->Html->script(array('jquery-1.11.3.min.js', 'bootstrap.min', 'jquery-ui.min','app.min.js','jquery.slimscroll.min.js','demo.js'));

    echo $this->Html->script("https://oss.maxcdn.com/respond/1.4.2/respond.min.js");

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Massive</b>Electronics</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php echo $this->Session->flash(); ?>
    <?php        echo $this->Form->create('User', array(
        'url' => array(
            'controller' => 'users',
            'action' => 'login'
        )
    ));?>

        <div class="form-group has-feedback">
    <?php echo $this->Form->input('username',array('class' => 'form-control','placeholder'=>'Username','autocomplete'=>'off','label' => false));?>

           <span class="form-control-feedback"> <i class="fa fa-user"></i></span>
        </div>

        <div class="form-group has-feedback">
            <span class="form-control-feedback"> <i class="fa fa-lock"></i></span>
    <?php echo $this->Form->input('password',array('class' => 'form-control','placeholder'=>'Password','label' => false));?>

</div>

    <div class="row" style="    margin-top: 15px; ">

        <div class="col-xs-4" style="float: right">
            <?php    $options = array(
                'label' => 'Sign In',
                'class' => 'btn btn-primary btn-block btn-flat');?>
            <?php  echo $this->Form->end($options);?>
        </div>
    </div>
    </div>

</div>

</body>







