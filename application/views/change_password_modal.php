<!-- In the change_password_modal.php view file -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password Modal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
       <link href="<?php echo base_url(); ?>assets/wnoty/wnoty.css" rel="stylesheet" type="text/css" />  
   <link href="<?php echo base_url(); ?>assets/wnoty/jquery-confirm.min.css" rel="stylesheet" type="text/css" />
       <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/loginassets/css/fontawesome-all.min.css">
     <style type="text/css">
     	.hide{
     		display: none;
     	}
     	.error{
     		color: red;
     	}
     </style>
</head>
<body>

    <!-- Bootstrap Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="changePasswordModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Your Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields and submit button for changing the password -->
                   <form class="form-horizontal form-material" method="post" id="Reset_pass" >
                       <!--  <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div> -->
                        <div class="form-group ">
								<label class=" control-label" for="passwordinput">Password </label>
									<!-- <span id="popover-password-top" class="hide pull-right block-help"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter a strong password</span> -->
								
								<input id="password" name="new1" type="password" placeholder="" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
								
								
							<!-- 	<div id="popover-password">
									<p>Password Strength: <span id="result"> </span></p>
									<div class="progress">
										<div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
										</div>
									</div>
									<ul class="list-unstyled">
										<li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; 1 lowercase &amp; 1 uppercase</li>
										<li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 number (0-9)</li>
										<li class=""><span class="one-special-char"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 Special Character (!@#$%^&*).</li>
										<li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; Atleast 8 Character</li>
									</ul>
								</div> -->
								
							</div>
							<div class="form-group ">
								<label class=" control-label" for="passwordinput">Password Confirmation <span id="popover-cpassword" class="hide pull-right block-help error"> Password don't match</span></label>
								
								<input id="confirm-password" name="new2" type="password" placeholder="" class="form-control input-md">
								
							</div>
							<div class="form-check mt-2">
									<input type="checkbox" class="form-check-input  toggle-password" id="exampleCheck1">
									<label class="form-check-label" for="exampleCheck1">Show Password</label>
								</div>
                            	<input type="hidden" name="emid" value="<?php echo $this->session->userdata('user_login_id'); ?>">
                          <button class="fxt-btn-fill btn btn-sm btn-primary" type="submit" id="savepass">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <!-- JavaScript to automatically show the modal when the page loads -->
    <script>
        $(document).ready(function(){
            $('#changePasswordModal').modal('show');
        });

     //password validation
   $(document).ready(function() {

        $('#password').keyup(function() {
            var password = $('#password').val();
            // if (checkStrength(password) == false) {
            //     $('#savepass').attr('disabled', true);
            // }
        });
        $('#confirm-password').blur(function() {
            if ($('#password').val() !== $('#confirm-password').val()) {
                $('#popover-cpassword').removeClass('hide');
                $('#savepass').attr('disabled', true);
            } else {
                $('#popover-cpassword').addClass('hide');
            }

        });
            $('#confirm-password').on("change",function() {
            if ($('#password').val() === $('#confirm-password').val()) {
               $('#popover-cpassword').addClass('hide');
                $('#savepass').attr('disabled', false);
            } else {
                $('#popover-cpassword').addClass('hide');
            }
            
        });
 
 

    });
     $(document).on('click','#savepass',function(){
        event.preventDefault();
           $("#Reset_pass").valid();
            var password=$("#password").val();
            var confirmpassword=$('#confirm-password').val();
            var usertype=$('#usertype').val();
            var currentpass=$('#currentpass').val();

        if(password != '' && confirmpassword != ''){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Employee/Password_Reset_Model");?>',
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
        autohideDelay: 1000,
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


   $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if ($('.toggle-password').is(":checked")) {
      $('#password').attr('type','text');
      $('#confirm-password').attr('type','text');   
    }else{
         $('#password').attr('type','password');
         $('#confirm-password').attr('type','password');
    }
   

});

	
 // $(document).on('click','#savepass',function(){
 //        event.preventDefault();
 //           $("#Reset_pass").valid();
 //            var password=$("#pswd").val();
 //            var confirmpassword=$('#cpassword').val();
           

 //        if(password != '' && confirmpassword != '' ){
          
 //         $.ajax({
 //        type:'post',
 //        url: '<?php echo base_url("Login/Reset_password_validation");?>',
 //        data: new FormData($("#Reset_pass")[0]),
 //        contentType: false,
 //        processData: false, 
 //        success:function(resp){
 //        var data=$.parseJSON(resp);
 //        if(data.status == 'success'){
 //        $('#Reset_pass')[0].reset();
 //        $.wnoty({
 //        type: 'success',
 //        message: data.message,
 //        autohideDelay: 3000,
 //        position: 'top-right'

 //        });
 //        setTimeout(function(){
 //        window.location.href = '<?php echo base_url()?>';
 //        },3000);
 //       }else if(data.status == 'error'){
      
 //              $.wnoty({
 //                    type: 'error',
 //                    message: data.message,
 //                    autohideDelay: 3000,
 //                    position: 'top-right'

 //                    });
 //        }else if(data.status == 'valid'){
 //             $.wnoty({
 //                    type: 'error',
 //                    message: data.message,
 //                    autohideDelay: 3000,
 //                    position: 'top-right'

 //                    });
 //        }
 //        },
 //        });
 //        }
     
 //        return false;
 //        })
    </script>

</body>
</html>
