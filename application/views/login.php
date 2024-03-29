<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
  <!--   <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.ico"> -->
    <title>HR Management System - Powered by AGM Technical Solutions</title>
    <!-- Custom CSS -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.png"> -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/css/style.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/css/fontawesome-all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/style.css">
    <style type="text/css">
        .fxt-template-layout1 .fxt-content {
            max-width: 380px;
            width: 100%;
        }
    </style>
</head>
<body>
   <?php  $organisationvalue = $this->settings_model->GetOrganisationValue(); ?>
    <section class="fxt-template-layout1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12 fxt-none-767 fxt-bg-img" style="text-align:center;" data-bg-image="<?php echo base_url(); ?>assets/images/background/loginbg4.jpg">
                  <!--   <img src="<?php echo base_url(); ?>assets/images/logo/logo-white.png" style="height:150px;" alt=""
                            > -->
                </div>
                <div class="col-md-6 col-12 fxt-bg-color" style="justify-content: center;">
                    <div class="fxt-content">
                        <div class="fxt-header" style="margin-bottom:30px; display: flex;
      justify-content: center;">
                            <!-- <img src="<?php echo base_url(); ?>assets/images/logo/logo-white.png" style="height:80px;" alt="Logo"
                            > -->

                            <?php if(isset($organisationvalue->logo)){ ?>
                            <img src="<?php echo base_url(); ?>assets/uploads/logo/<?php echo $organisationvalue->logo ?>" style= "height:80px">
                            <?php } else { ?>
                            <img src="<?php echo base_url();?>assets/logo.png" alt=""  style= "height:80px;"/>
                            <?php } ?>
                        </div>
                        <div class="fxt-form" style="margin-bottom:unset;">
                            <h2 style="text-align: center; padding-bottom: 20px;">HR Management System</h2>
                            
                            <?php if(!empty($this->session->flashdata('feedback'))){ ?>
                            <div class="message">
                                <strong style="color:red;"><?php echo $this->session->flashdata('feedback')?></strong>
                            </div>
                            <?php } ?>    
                            <form class="form-horizontal form-material" method="post" id="loginform" action="login/Login_Auth">
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input class="form-control" name="email" value="<?php if(!empty($this->input->cookie('email'))) { echo $this->input->cookie('email'); } ?>" type="text" required placeholder="Email">
                                        <i class="flaticon-envelope"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input class="form-control" name="password" value="<?php if(!empty($this->input->cookie('password'))) { echo base64_decode($this->input->cookie('password')); } ?>" type="password" required placeholder="Password">
                                        <!-- <i class="flaticon-padlock"></i> -->
                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember-me" <?php if(!empty($this->input->cookie('email') && $this->input->cookie('password'))) { echo 'checked'; }?> >
                                    <label class="form-check-label" for="remember-me">Remember</label>
                                      <a href="<?php echo base_url(); ?>Login/forgotten_page" class="switcher-text2 float-right">Forgot Password</a>
                                </div>  
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <div class="fxt-content-between">
                                            <button class="fxt-btn-fill" type="submit">Log In</button>
                                           
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="fxt-footer">
                        
                            <p style="padding-top:; font-size: 14px;"><?php echo date('Y'); ?>  &#169;

                                 <a href="<?php  if($organisationvalue->website) { echo $organisationvalue->website; } else { echo '#'; } ?>" target="_blank"> 
                                    <!-- <img src="<?php echo base_url(); ?>assets/images/logo/logo-white.png" style="height: ;width: 80px;" alt="Logo"> -->
                                    <?php if(isset($organisationvalue->logo)){ ?>
                                    <img src="<?php echo base_url(); ?>assets/uploads/logo/<?php echo $organisationvalue->logo ?>" style= "width: 80px;" alt="Logo">
                                    <?php } else { ?>
                                    <img src="<?php echo base_url();?>assets/logo.png" alt=""  style= "width: 80px;" alt="Logo"/>
                                    <?php } ?>
                                </a>
                                <!-- website -->

                                <a href="<?php echo ($organisationvalue->website) ? $organisationvalue->website : '#' ?>" target="_blank" style="color:black"><?php echo ($organisationvalue->organisation) ? $organisationvalue->organisation : '' ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section>
         <div class="row">
            <div class="col-md-6 vcenter" style="text-align: center; vertical-align: middle; margin-top: auto;
margin-bottom: auto;">
                <img src="<?php echo base_url(); ?>assets/images/background/loginbg1.jpg">
            </div>
            <div class="col-md-6" class="login-register" style="height: auto;">
                <div class="login-box card">
                    <div class="card-body">
                                    <?php if(!empty($this->session->flashdata('feedback'))){ ?>
                                    <div class="message">
                                    <strong>Danger! </strong><?php echo $this->session->flashdata('feedback')?>
                                    </div>
                                    <?php
                                    }
                                    ?>                                          
                        <form class="form-horizontal form-material" method="post" id="loginform" action="login/Login_Auth">
                            <a href="javascript:void(0)" class="text-center db"><br/><img src="<?php echo base_url(); ?>assets/images/HRLogo.png" alt="Home" /></a>
                            <div class="form-group m-t-40">
                                <div class="col-xs-12">
                                    <input class="form-control" name="email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>" type="text" required placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" type="password" required placeholder="Password">
                                </div>
                            </div>
                         <div class="form-check">
                             <input type="checkbox" name="remember" class="form-check-input" id="remember-me">
                             <label class="form-check-label" for="remember-me">Remember me !</label>
                         </div>                     
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-sml btn-login btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <script src="<?php echo base_url(); ?>assets/loginassets/js/jquery-3.5.0.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url(); ?>assets/loginassets/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>assets/loginassets/js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="<?php echo base_url(); ?>assets/loginassets/js/imagesloaded.pkgd.min.js"></script>
    <!-- Validator js -->
    <script src="<?php echo base_url(); ?>assets/loginassets/js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/loginassets/js/main.js"></script>
</body>


</html>
<script type="text/javascript">
    $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
          $(this).removeClass('fa-eye-slash');
          $(this).addClass('fa-eye');
    } else {
        input.attr("type", "password");
         $(this).addClass('fa-eye-slash');
    }
});
</script>