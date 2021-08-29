<?php
 $this->assign('title', 'Log In To Continue');
?>




<?php 
    // include the BotDetect layout stylesheet
    echo $this->Html->css(captcha_layout_stylesheet_url(), array('inline' => true));
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Massive</title>

        <!-- CSS -->
        <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <link rel="shortcut icon" href="assets/ico/favicon.ico">
    </head>

    <body>

        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User'); ?>
        <div class="top-content">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Login Form</strong></h1>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <div class="form-group">                                
                                    <label class="sr-only" for="form-username">Username</label>
                                    <?php echo $this->Form->input('username', array('class' => 'form-control','placeholder'=>'Enter Username','autocomplete'=>'off','label' => false));?>
                                </div>
                                <div class="form-group">
                                     <label class="sr-only" for="form-password">Password</label>

                                     <?php echo $this->Form->input('password', array('class' => 'form-control','placeholder'=>'Enter Password','label' => false)); ?>
                                </div>
                                <br>

                                <!-- Captcha Start Here -->

                                <!-- <?php //echo $this->Html->div('captcha', captcha_image_html(), false);
                                ?> -->
                                <!-- <?php
                                  //echo $this->Form->input('CaptchaCode', array(                                       
                                        //'maxlength' => '10',
                                        //'autocomplete'=>'off',
                                        //'label'=>false,
                                        //'placeholder'=>'Retype the characters',
                                        //'style' => 'width: 252px; text-transform: uppercase;'
                                    //)
                                //);
                                //?> -->
                                <!-- Captcha end Here -->

                                <?php echo $this->Form->button('Login',array('type'=>'submit','class'=>'btn','label'=>false)); ?>
                                <?php echo $this->Form->button('Reset',array('type'=>'reset','class'=>'btn','label'=>false)); ?>
                                <?php  echo $this->Form->end();?>
                            </div>
                        </div>
                    </div>
                </div>
            
    <!-- </div> -->
        </div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
    <?php echo $this->Html->link( "Add A New User",   array('action'=>'add') ); ?>

</html>





