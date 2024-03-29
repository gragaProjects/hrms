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
   <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/css/style.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/scss/icons/font-awesome/css/font-awesome.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/passwordvalidate.css">
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
                    <div class="fxt-content" style="max-width:450px">
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
                            <form class="form-horizontal form-material" method="post" id="Reset_pass" ><!-- action="login/Login_Auth" -->
                                 <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input class="form-control" name="password" id="pswd" type="password" required placeholder="Enter New Password">
                                      
                                      <label> <span id="popover-password-top" class="hide pull-right block-help text-danger"><!-- <i class="fa fa-info-circle text-danger" aria-hidden="true"></i> --> Enter a strong password</span></label>
                                     </div> 

                                    <div id="pswd_info" style="display: none;">
                                <h4>Password must contain:</h4>
                                <ul>
                                  <li id="letter" class="valid">At least <strong>one letter</strong></li>
                                  <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                  <li id="number" class="invalid">At least <strong>one number</strong></li>
                                  <li id="special" class="invalid">At least <strong>one special character</strong></li>
                                  <li id="length" class="invalid">At least <strong>8 characters</strong></li>
                                </ul>
                          </div>
                             

                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input class="form-control" name="cpassword" id="cpassword" type="password" required placeholder="Enter Confrim Password">
                                        <label><span id="popover-cpassword" class=" hide pull-right block-help text-danger"><!-- <i class="fa fa-info-circle text-danger" aria-hidden="true"></i> --> Password don't match</span></label>
                                        
                                    </div>
                                  
                             </div> 
                            

                             <div class="form-group">
                                	
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <div class="fxt-content-between">
                                            <button class="fxt-btn-fill btn btn-sm" type="submit" id="savepass">Submit</button>
                                            <input type="hidden" name="code" value="<?php if($this->input->get('c')){ echo base64_decode( $_GET['c']);} ?>">
                                            <a href="<?php echo base_url(); ?>" class="switcher-text2 float-right mt-4">Back to login</a>
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
    $(document).ready(function() {
        $('#popover-password-top').hide();
           $('#popover-cpassword').hide();
            //$('#savepass').prop('disabled', true);

          $('#pswd').keyup(function() {
            var pswd = $('#pswd').val();
            if (checkStrength(pswd) == false) {
                $('#savepass').attr('disabled', true);
               
            }else
            {
                $('#savepass').attr('disabled', false);
            }
        }).focus(function() {
            $('#pswd_info').show();
          }).blur(function() {
            $('#pswd_info').hide();
          });
             
        //check strong
      /*  if(!checkStrength(pswd)){
            $('#savepass').prop('disabled', true);  
        }*/
      
        $('#cpassword').blur(function() {
            if ($('#pswd').val() !== $('#cpassword').val()) {
                $('#popover-cpassword').removeClass('hide');
                $('#popover-cpassword').show();
                $('#savepass').attr('disabled', true);
            } else {
                $('#popover-cpassword').addClass('hide');
                $('#popover-cpassword').hide();
            }

        });
            $('#cpassword').on("change",function() {
            if ($('#pswd').val() === $('#cpassword').val()) {
               $('#popover-cpassword').addClass('hide');
                 $('#popover-cpassword').show();
                $('#savepass').attr('disabled', false);
            } else {
                $('#popover-cpassword').addClass('hide');
                  $('#popover-cpassword').hide();
            }
            
        });
 

  //you have to use keyup, because keydown will not catch the currently entered value
  //$('#pswd').keyup(function() {

    // set password variable
   // var pswd = $(this).val();

    //validate the length
     function checkStrength(pswd) {

    if (pswd.length < 8) {
      $('#length').removeClass('valid').addClass('invalid');
      $('#popover-password-top').show();
        $('#savepass').attr('disabled', true);
      
    } else {
      $('#length').removeClass('invalid').addClass('valid');
      $('#popover-password-top').hide();

    }

    //validate letter
    if (pswd.match(/[A-z]/)) {
      $('#letter').removeClass('invalid').addClass('valid');
    } else {
      $('#letter').removeClass('valid').addClass('invalid');
       $('#popover-password-top').show();
         $('#savepass').attr('disabled', true);
    }

    //validate uppercase letter
    if (pswd.match(/[A-Z]/)) {
      $('#capital').removeClass('invalid').addClass('valid');
    } else {
      $('#capital').removeClass('valid').addClass('invalid');
       $('#popover-password-top').show();
         $('#savepass').attr('disabled', true);
    }

    //validate number
    if (pswd.match(/\d/)) {
      $('#number').removeClass('invalid').addClass('valid');
    } else {
      $('#number').removeClass('valid').addClass('invalid');
       $('#popover-password-top').show();
         $('#savepass').attr('disabled', true);
    }
    //validate special char
    if (pswd.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
     $('#special').removeClass('invalid').addClass('valid');
    } else {
      $('#special').removeClass('valid').addClass('invalid');
       $('#popover-password-top').show();
         $('#savepass').attr('disabled', true);
    }

    }
  });

	
 $(document).on('click','#savepass',function(){
        event.preventDefault();
           $("#Reset_pass").valid();
            var password=$("#pswd").val();
            var confirmpassword=$('#cpassword').val();
           

        if(password != '' && confirmpassword != '' ){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Login/Reset_password_validation");?>',
        data: new FormData($("#Reset_pass")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#Reset_pass')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 3000,
        position: 'top-right'

        });
        setTimeout(function(){
        window.location.href = '<?php echo base_url()?>';
        },3000);
       }else if(data.status == 'error'){
      
              $.wnoty({
                    type: 'error',
                    message: data.message,
                    autohideDelay: 3000,
                    position: 'top-right'

                    });
        }else if(data.status == 'valid'){
             $.wnoty({
                    type: 'error',
                    message: data.message,
                    autohideDelay: 3000,
                    position: 'top-right'

                    });
        }
        },
        });
        }
     
        return false;
        })
</script>