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
   <!--  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.ico"> -->
   <title>HR Management System - Powered by AGM Technical Solutions</title>
    <!-- Custom CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/fav.png">
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

    <link href="<?php echo base_url(); ?>assets/wnoty/wnoty.css" rel="stylesheet" type="text/css" />  
   <link href="<?php echo base_url(); ?>assets/wnoty/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
   <style>
     .error{
        color: red;
     }
         .fxt-template-layout1 .fxt-content {
            max-width: 380px;
            width: 100%;
        }
   </style>  
</head>
<body>
    <section class="fxt-template-layout1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12 fxt-none-767 fxt-bg-img" style="text-align:center;" data-bg-image="<?php echo base_url(); ?>assets/images/background/loginbg4.jpg"></div>
                <div class="col-md-6 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header" style="margin-bottom:30px; display: flex;
      justify-content: center;">
                            <img src="<?php echo base_url(); ?>assets/images/logo/logo-white.png" style="height:80px;" alt="Logo"><!--  <img src="<?php echo base_url(); ?>assets/images/LogoBlack.png" style="height:110px;" alt="Logo"> -->
                        </div>
                        <div class="fxt-form">
                            <h2 style="text-align: center; padding-bottom: 20px;">HR Management System</h2>
                            
                            <?php if(!empty($this->session->flashdata('feedback'))){ ?>
                            <div class="message">
                                <strong style="color:red;"><?php echo $this->session->flashdata('feedback')?></strong>
                            </div>
                            <?php } ?>    
                            <form class="form-horizontal form-material" method="post" id="verify" ><!-- action="login/Login_Auth" -->
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input class="form-control" name="code" id="code" minlength="6" type="text" required placeholder="Enter Verify Code">
                                        <input type="hidden" name="emp_email" id="emp_email" value="<?=
                                         $this->session->userdata('emp_email')?>">
                                         <div class="error"></div>
                                    </div>
                                </div>
                             <div class="form-group">
                                	 <a href="<?php echo base_url(); ?>" class="switcher-text2 float-right">Back to login</a>
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <div class="fxt-content-between">
                                            <button class="fxt-btn-fill" type="submit" id="verifycode">Submit</button><!-- forgot-password-1.html -->
                                           
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      <div class="fxt-footer">
                 
                            <p style="padding-top:; font-size: 14px;"><?php echo date('Y'); ?>  &#169;

                                 <a href="https://agmtechnical.com/" target="_blank"> <img src="<?php echo base_url(); ?>assets/images/logo/logo-white.png" style="height: ;width: 80px;" alt="Logo"></a>

                                <a href="https://agmtechnical.com/" target="_blank">AGM Technical Solutions</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
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
       <script src="<?php echo base_url(); ?>assets/wnoty/wnoty.js"></script> 
   <script src="<?php echo base_url(); ?>assets/wnoty/jquery-confirm.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/loginassets/js/jquery.validate.min.js"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
    $(document).on('click', '#verifycode', function(e) {
    //$('#bussinessunitform').submit(function(event) {
    e.preventDefault();
     //$("#verify").valid();
    var code=$("#code").val();
   
   if(code != '' ){
  /* if($("#code").length < 6 ){ 
    $(".error").text('Please Enter Minimum 6 Values').css('color','red');//<div class="error"></div>
  
    return false;
    }*/
       
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Login/Verificationcode");?>',
    data: new FormData($("#verify")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#verify')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
    window.location.href = '<?php echo base_url('Login/Reset_password?c=')?>' + btoa(code);
    },2000);
  
   }else if(data.status = 'error'){
  $('#verify')[0].reset();
          $.wnoty({
                type: 'error',
                message: data.message,
                autohideDelay: 3000,
                position: 'top-right'

                });
    }else if(data.valid){
         $.wnoty({
                type: 'error',
                message: data.valid,
                autohideDelay: 3000,
                position: 'top-right'

                });
    }
    },
    });
    }
    
 
    return false;
    })
    })
   
    //expire
    $(document).ready(function () {
    setTimeout(function(){
   var emp_email = $('#emp_email');
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Login/Expirecode")?>',
    data: new FormData($("#verify")[0]),
    contentType: false,
    processData: false,  
    success:function(response){
    var data=$.parseJSON(response);
    if(data.status == 'error'){
    //$('#verify')[0].reset();
    $.wnoty({
    type: 'warning',
    message: data.message,
    autohideDelay: 2000,
    position: 'top-right'

    })
    setTimeout(function(){
    window.location.href = '<?php echo base_url('Login/forgotten_page')?>';
    },2000);
   }
   }
   })
   },600000);//600000
   })
</script>