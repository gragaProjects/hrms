<!-- Roles permission -->

<?php if(!$this->role->User_Permission('employee_list','can_edit') || !$this->role->User_Permission('employee_list','can_add') ){?>
<script type="text/javascript">
    $("#em_code,#joindate,#leavedate,#joindate").prop('readonly', true);
    $('#busunit,#em_status,#role,#prefix,#dept,#deg,#status,#reportto').prop('disabled', true);
    /*offical doc*/
    $('#gov_id,#govtid').prop('disabled', true);
    $("#em_code,#gid_number,#gov_doc,#gid_expiry").prop('readonly', true);
    
    /*Salary*/
    $('#typeid,#currencytype,#addsalary').prop('disabled', true);
    $('[name="basic"],[name="houserent"]').prop('readonly', true);

    /*Bank*/
    $('#save_bank_info').prop('disabled', true);
    $('[name="holder_name"],[name="bank_name"],[name="branch_name"],[name="account_number"],[name="account_type"],[name="ifsc"],[name="swift"]').prop('readonly', true);

   /*modal btn*/
    $('.modalbtn').hide() 
</script>
<?php } ?>
<!-- Roles permission -->


<!-- offical details -->
<!-- add emp -->
<script >

    //validation
      $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })

    //add employee
   $(document).on('click','#add_employee',function(){
     //validateForm();
    event.preventDefault();
    $("#employee_form").valid();
    var busunit   =$('#busunit').val();
    var em_code   =$('#em_code').val();
    var em_status =$('#em_status').val();
    var role      =$('#role').val();
    var prefix    =$('#prefix').val();
    var fname     =$('#fname').val();
    var lname     =$('#lname').val();
    var dept      =$("#dept").val();
    var deg       =$("#deg").val();
    var joindate  =$("#joindate").val();
    var contact   =$('#contact').val();
    var email     =$('#email').val();
    var reportto  = $('#reportto').val();

    //var status=0;
    if(busunit != '' && em_code != ''  && em_status != '' && role != '' && prefix != '' && fname != '' && lname != '' && dept != '' && deg != '' && joindate != ''&& email != ''&& contact != '' ){
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Save");?>',
    data: new FormData($("#employee_form")[0]),
    contentType: false,
    processData: false,     //$("#employee_form").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    //var dep = $('#department').val();
    //$('#employee_form')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Employee Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
   
    $(".eid").val(data.eid);
    //  setTimeout(function(){
    //  location.reload(true);
    // },3000);
   }else if(data.status == 'error'){

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
   //emp code
     $(document).ready(function(){
    $("#busunit").change(function(){
       
      var id = $(this).val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Employee/get_businesscode");?>",
            data: { id : id },
             success:function(data){
                var info=$.parseJSON(data);
                $("#em_code").val(info.content+'/'+info.code);
             } 
        })
    });
 
    }); 
</script>
<script>
     //update offical details
    $(document).on('click','#update_employee',function(){

    $("#em_code,#joindate,#leavedate,#joindate").prop('readonly', false);
    $('#busunit,#em_status,#role,#prefix,#dept,#deg,#status,#reportto').prop('disabled', false);

    event.preventDefault();

    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update");?>',
    data: new FormData($("#upd_emp_form")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    $('#upd_emp_form')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Employee Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.status = 'error'){
         $.wnoty({
    type: 'error',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
    } 
    },
    });
    return false;
    })  

   $('.custom-select').on('change',function(){

       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })
   //persnal details
        $("#same_address").on("change", function(){
         $('#same_address').attr('checked');
        if (this.checked) {
            $('#presentaddress,.presentcountry,.presentstate,.presentdistrict,.presentpincode,.presentcity').removeClass('error');
             $('#presentaddress,.presentcountry,.presentstate,.presentcity,.presentdistrict,.presentpincode').addClass('valid');
             $('#presentaddress,.presentcountry,.presentstate,.presentcity,.presentdistrict,.presentpincode').next('.error').css({display:'none'});
         // if ($("#same_address").is(":checked")) {
            
            $('#presentaddress').text($('#permanentaddress').val());
            //$('.presentcountry').val($('.permanentcountry').val());
            $('.presentcountry').html('<option value='+$('.permanentcountry').val()+' selected>'+$('.permanentcountry :selected').text()+'</option>');
           // $('.presentcountry').html('<option value='+$('.permanentcountry').val()+' selected>'+$('.permanentcountry :selected').text()+'</option>');
            $('.presentstate').html('<option value='+$('.permanentstate').val()+' selected>'+$('.permanentstate :selected').text()+'</option>');
            $('.presentdistrict').html('<option value='+$('.permanentdistrict').val()+' selected>'+$('.permanentdistrict :selected').text()+'</option>');
            $('.presentcity').html('<option value='+$('.permanentcity').val()+' selected>'+$('.permanentcity :selected').text()+'</option>');
            $('.presentpincode').val($(".permanentpincode").val());
            
            //$('.presentcity').val($('.permanentcity').val());
            $('#presentaddress,#presentcountry,#presentstate,#presentcity,#presentdistrict,#presentpincode').attr('disabled', 'disabled');
          } else {
            //$('#billingaddress').removeAttr('disabled');
         $('#presentaddress,.presentcountry,.presentstate,.presentcity,.presentdistrict,.presentpincode').removeAttr('disabled');

          
          }
        

      });
        $('#permanentaddress,.permanentcountry,.permanentstate,.permanentcity,.permanentdistrict ,.permanentpincode').on("change", function(){
                $('#same_address').removeAttr('disabled');
        })

        // When the checkbox is clicked
        $('#same_address').on('click', function() {
          
          // If the checkbox is unchecked
          if (!$(this).is(':checked')) {
            
            $('#presentaddress,#presentcountry,#presentstate,#presentcity,#presentdistrict,#presentpincode').empty();
           
            $('#presentstate').html('<option value="">Select State</option>');
            $('#presentdistrict').html('<option value="">Select District</option>');
            $('#presentcity').html('  <option value="">Select City</option>');
            $('#presentpincode').val('');
            // Perform some action
            //console.log('Checkbox is unchecked');
            //get country 
             $.ajax({
                type:'post',
                url: '<?php echo base_url("employee/get_country");?>',
                data: '',
                success:function(resp){
                var data=$.parseJSON(resp);
               // if(data.status == 'success'){
                 $('.presentcountry').html(data.content);
               // }
                },
                });
            
          }
          
        });
        //new
        if($('#permanentaddress,.permanentcountry,.permanentstate,.permanentcity,.permanentdistrict ,.permanentpincode') == '' ){
        $('#same_address').attr('disabled');
        }

    
    // add personal details
      $(".search").select2({
          theme:"bootstrap"
      });
    $(document).ready(function () {
 
    $(document).on('click', '#add_personal', function(e) {
    //$('#depform').submit(function(event) {
    e.preventDefault();
     $("#personal_data").valid();
    $('#presentaddress,#presentcountry,#presentstate,#presentcity,#presentdistrict,#presentpincode').attr('disabled', false);
    //console.log($('#presentdistrict').val());
    var gender=$("#gender").val();
    var nationality=$("#nationality").val();
    var dob=$("#dob").val();
    var maritalstatus=$("#maritalstatus").val();
    var permanentaddress=$("#permanentaddress").val();
    var permanentcountry=$("#permanentcountry").val();
    var permanentstate=$("#permanentstate").val();
    var permanentdistrict=$("#permanentdistrict").val();
    var permanentcity=$("#permanentcity").val();
    var permanentpincode=$("#permanentpincode").val();
    var presentaddress=$("#presentaddress").val();
    var presentcountry=$("#presentcountry").val();
    var presentstate=$("#presentstate").val(); 
    var presentdistrict=$("#presentdistrict").val(); 
    var presentcity=$("#presentcity").val();
    var presentpincode=$("#presentpincode").val();
    var contactname=$("#contactname").val();
    var contactno=$("#contactno").val();
    var contactemail=$("#contactemail").val();
  if(nationality != '' && gender != '' && dob != ''  && maritalstatus != ''  && permanentaddress != ''  && permanentcountry != '' && permanentstate != ''&& permanentdistrict != '' && permanentcity != ''&& permanentpincode != '' && presentaddress != '' && presentcountry!= '' && presentdistrict != ''&& presentstate != '' && presentcity != '' && presentpincode != '' && contactname != '' && contactno!= '' ){//&& contactemail != ''
   $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Save_Personalinfo");?>',
    data: new FormData($("#personal_data")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#personal_data')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
  
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: 'This  is already Exist',
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
   //gov document
    $('#gov_id').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })

/*$('#gov_id, #gid_number,#gid_expiry').on('input',function(){
        $('#gov_id, #gid_number,#gid_expiry,gov_doc').each(function(){
        var v=$(this).val();
        if(v !=''){
        $(this).next('.red').remove()
         }
         })
        })*/
   $(document).on('click','#govtid',function(){
    event.preventDefault();
      $("#govtid_form").valid();
        var gid=$("#gov_id").val();
        var gid_number=$('#gid_number').val();
        var gid_expiry=$('#gid_expiry').val();
        var gov_doc=$('#gov_doc').val();
    if(gid !='' && gid_number !='' && gid_expiry !=''){

    
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_GovIdentityCard");?>',
    data: new FormData($("#govtid_form")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var govdata=$.parseJSON(resp);
    if(govdata.status == 'success'){
    //var dep = $('#department').val();
    $('#govtid_form')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Govt Document Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(govdata.error){
  
          $.wnoty({
                type: 'error',
                message: 'This Govt ID Type is already Exist',
                autohideDelay: 1000,
                position: 'top-right'

                });
    }else if(govdata.valid){
         $.wnoty({
                type: 'error',
                message: govdata.valid,
                autohideDelay: 1000,
                position: 'top-right'

                });
    }
    },
    });
    }
 
    return false;
    })
    //update gov documents
    $(document).on('click','#btn_govtid',function(){
    event.preventDefault();
    //$('GIDType').removeAttr('readonly');
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_GovIdentityCard");?>',
    data: new FormData($("#identitycardmodal")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    ///var dep = $('#department').val();
    $('#identitycardmodal')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Goverment Document Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }
    },
    });
    return false;
    })  
   //delete gov documents
    $(document).on('click','.del_gid', function (e) {
    var gid = $(this).parents('tr').find('#gid').val();
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this documents?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/Delete_GovIdentityCard') ?>',
    data: {gid:gid},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    });

    /*Document tab*/
    $(document).on('click','#addfile',function(){
    event.preventDefault();
    $("#Add_File").valid();

    var title=$("#title").val();
    var file_url=$("#file_url").val();

   if(title != '' && file_url != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Add_File");?>',
    data: new FormData($("#Add_File")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
   
    $('#Add_File')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Document Added successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
     
    } 
    },
    }); 
   }
    return false;
    })
</script>
<!-- add education -->
<script>
    $('.tool').tooltip();
    //select match course
      
    $(document).ready(function(){
    $("#edulevel").change(function(){
       
      var edulevel = $("#edulevel").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Employee/get_match_course");?>",
            data: { edulevel : edulevel },
             success:function(data){
                var info=$.parseJSON(data);
                $("#course").html(info.content);
             } 
        })
    });
 
    }); 
    //save education
    $(document).on('click','#add_edu',function(){
    event.preventDefault();
       $("#insert_education").valid();
        var edulevel=$("#edulevel").val();
        var course=$('#course').val();
        var institute=$('#institute').val();
        var from_year=$('#from_year').val();
        var to_year=$('#to_year').val();
        var percentage=$('#percentage').val();
    if(edulevel != '' && course != '' && institute!= '' && from_year != '' && to_year!= '' ){
      
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Education");?>',
    data: new FormData($("#insert_education")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#insert_education')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Education Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.error,
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
   //send id to model
    $(document).ready(function () {
  $(document).on('click', '.edu_doc', function(e) {
      e.preventDefault();
     var tr=$(this).parents('tr');
     var enrollno=$(tr).find('td:eq(0)').text();
        var eduid = $(this).val();
          
    $('#edudocmodel').find('[name="edu_id"]').val(eduid).end();
    //alert('clicked');
    })
    })
    //save education doc
    $(document).ready(function () {
    $(document).on('click', '#save_edudoc', function(e) {
    e.preventDefault();
     $("#edudocform").valid();
    var eduid = $('#edu_id').val();
    var name=$("#edudoc_name").val();
    var code=$("#edufiles").val();
   if(name != '' && code != ''){
   $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Edudocument");?>',
    data: new FormData($("#edudocform")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#edudocmodel').modal('hide');
     $(".modal-backdrop").remove(); 
    $('#edudocform')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: 'Education Document Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
  
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: 'This  is already Exist',
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
    //get education doc
    $(document).on('click','#view_edu',function(){
    var edu_id = $(this).val();
    var em_id=$(this).parents('tr').find('#em_id').val();
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Get_EducationDoc");?>',
    data: {edu_id:edu_id,em_id:em_id},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
     $('#edudocview').html(data.content);
    }
    },
    });
    return false;
    }) 
     //delete education document
    $(document).on('click','.deledudocument', function (e) {
    var id = $(this).attr('data-id');
     $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this education documents?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/DeleteEducationDoc') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    }); 
    //update education
    $(document).on('click','#update_edu',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_Education");?>',
    data: new FormData($("#educationmodal")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    $('#educationmodal')[0].reset();
    $('#EduModal').modal('hide');
     $(".modal-backdrop").remove();
    $.wnoty({
    type: 'success',
    message: 'Education Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }
    },
    });
    return false;
    })  
   //delete education
    $(document).on('click','.deledu', function (e) {
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this education?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/DeleteEducation') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){
    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    });
    /*Experience*/

   $(document).on('click','#save_exp',function(){
    event.preventDefault();
       $("#Experience_form").valid();
    

        var exp_company=$("#exp_company").val();
        var exp_com_position=$('#exp_com_position').val();
        var workstart=$('#workstart').val();
        var workend=$('#workend').val();
        var leaving_reason=$('#leaving_reason').val();
       
    if(exp_company != '' && exp_com_position != '' && workstart!= '' && workend != '' && leaving_reason != ''){
      
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Experience");?>',
    data: new FormData($("#Experience_form")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#Experience_form')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Experience Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.error,
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
    //update experience
    $(document).on('click','#update_exp',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_Experience");?>',
    data: new FormData($("#experiencemodal")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    $('#experiencemodal')[0].reset();
     $('#ExpModal').modal('hide');
     $(".modal-backdrop").remove(); 
    $.wnoty({
    type: 'success',
    message: 'Experience Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }
    },
    });
    return false;
    })  
      //delete experience
    $(document).on('click','.deletexp', function (e) {
     var id = $(this).attr('data-id');

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this experience?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/DeleteEducation') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    });
     //send id to model experience
    $(document).ready(function () {
    $(document).on('click', '.exp_doc', function(e) {
      e.preventDefault();
     var tr=$(this).parents('tr');
     var enrollno=$(tr).find('td:eq(0)').text();
        var expid = $(this).val();
         
    $('#expdocmodel').find('[name="exp_id"]').val(expid).end();
    //alert('clicked');
    })
    })
    
    //save experience doc
    $(document).ready(function () {
    $(document).on('click', '#save_expdoc', function(e) {
    e.preventDefault();
     $("#expdocform").valid();
 
    var expid = $('#exp_id').val();
    var name=$("#expdoc_name").val();
    var file=$("#expfiles").val();

   if(name != '' && file != ''){
    
   $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Expdocument");?>',
    data: new FormData($("#expdocform")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#expdocmodel').modal('hide');
     $(".modal-backdrop").remove(); 
    $('#expdocform')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: 'Experience Document Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
  
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: 'This  is already Exist',
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
    //get experience doc
    $(document).on('click','#view_exp',function(){
    var exp_id = $(this).val();
    //console.log(eduid);
    var em_id=$(this).parents('tr').find('#em_id').val();
     //console.log(em_id);
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Get_ExperienceDoc");?>',
    data: {exp_id:exp_id,em_id:em_id},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
     $('#expdocview').html(data.content);
    }
    },
    });
    return false;
    }) 
     //delete experience document
    $(document).on('click','.delexpdocument', function (e) {
     var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this experience documents?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/DeleteExperienceDoc') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    }); 
    /*certification*/
   /* $('.certificate_validate').on('input',function(){
        $('.certificate_validate').each(function(){
        var v=$(this).val();
        if(v !=''){
        $(this).next('.red').remove()
         }
         })
        })*/
   $(document).on('click','#add_certificate',function(){
    event.preventDefault();
     $("#certification_form").valid();
 
      var certificate_name=$("#certificate_name").val();
        var certificate_no=$('#certificate_no').val();
        var certificate_expdate=$('#certificate_expdate').val();

 
    
     
      
    if(certificate_name != '' &&  certificate_no != ''){
    
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Certification");?>',
    data: new FormData($("#certification_form")[0]),
    contentType: false,
    processData: false, 
    success:function(res){
    var data=$.parseJSON(res);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#certification_form')[0].reset();
    $.wnoty({
    type: 'success',
    message: ' Certificate Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: 'This Certificate is already Exist',
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
   //update  certificate
    $(document).on('click','#update_certificate',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_Certification");?>',
    data: new FormData($("#certificateform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    ///var dep = $('#department').val();
    $('#certificateform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Certificate Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }/*else if(data.error){
        $("#department").after(data.error);
        $('#department').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#department").next().remove();
          $('#identitycardmodal')[0].reset();
        
         },2000); 
    }*/ 
    },
    });
    return false;
    })  
   //delete certificate
    $(document).on('click','.delcertificate', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this certificate?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/Delete_Certification') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    });

    // add skills
    $(document).ready(function () {
   $(document).on('click', '#add_skill', function(e) {
    e.preventDefault();
     $("#empskill").valid();
    
    var name=$("#name").val();
    var yearofexp=$("#yearofexp").val();
  
  if(yearofexp != '' && name != '' ){
   $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Save_skills");?>',
    data: new FormData($("#empskill")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#empskill')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: 'Skill Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
  
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: 'This  is already Exist',
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
 

 //update skills
    $(document).on('click','#update_skill',function(event){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_Skills");?>',
    data: new FormData($("#skillsform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    $('#skillsform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Skills  Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   } 
    },
    });
    return false;
    })  
   //delete skills
    $(document).on('click','.delskill', function (e) {
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this skill?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/DeleteSKills') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });
    });

  /*salary*/ //blur
/*  $('.salary').keypress(function () {
    var sum = 0;
    $('.salary').each(function() {
        if($(this).val()!="")
         {
            sum += parseFloat($(this).val());
         }

    });
        //console.log(sum);
        $('#total').val(sum);
   });*/
   $(document).on('keyup','.salary',function(){
    var sum = 0;
    $('.salary').each(function() {
        if($(this).val()!="")
         {
            sum += parseFloat($(this).val());
         }

    });
        //console.log(sum);
        $('#total').val(sum);
   })
  //salary

   $(document).on('click','#addsalary',function(){
    event.preventDefault();
       $("#Add_Salary").valid();
        
        var typeid=$("#typeid").val();
        var currencytype=$('#currencytype').val();
     
      if(typeid != '' && currencytype != '' ){
      
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Salary");?>',
    data: new FormData($("#Add_Salary")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#Add_Salary')[0].reset();
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.error,
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
     //Add Bank info

   $(document).on('click','#save_bank_info',function(){
    event.preventDefault();
       $("#Add_bank_info").valid();
        
        var holder_name=$("#holder_name").val();
        var bank_name=$('#bank_name').val();
        var branch_name=$("#branch_name").val();
        var account_number=$('#account_number').val();
        var account_type=$('#account_type').val();
     
      if(holder_name != '' && bank_name != '' && branch_name != '' && account_number != '' && account_type != '' ){
      
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_bank_info");?>',
    data: new FormData($("#Add_bank_info")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#Add_bank_info')[0].reset();
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.error,
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
   //Dependency
    $(document).on('click','#save_dependency',function(){
    event.preventDefault();
       $("#add_dependency").valid();
        var name=$("#dependentname").val();
        var relation=$('#dependentrelation').val();
        var dob=$('#dependentdob').val();
        var age=$('#dependentage').val();

    if(name != '' && relation != '' && dob!= '' && age != ''){
      
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Dependency");?>',
    data: new FormData($("#add_dependency")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#add_dependency')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Dependency Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.error,
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
    $(document).on('click','#update_dependency',function(event){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_Dependency");?>',
    data: new FormData($("#dependencyform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#DependencyModal').modal('hide');
     $(".modal-backdrop").remove(); 
    $('#dependencyform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Dependency  Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }
    },
    });
    return false;
    })  
   //delete dependency
    $(document).on('click','.deldependency', function (e) {
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this dependency?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/Deletedependency') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){
    
    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },5000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });
    });
    //disability
    $(document).on('click','#save_disablity',function(){
    event.preventDefault();
       $("#Add_Disability").valid();
        var name=$("#disability_name").val();
        var type=$('#disability_type').val();
     

    if(name != '' && type != '' ){
      
     $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_Disablity");?>',
    data: new FormData($("#Add_Disability")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#Add_Disability')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Disability Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.error,
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
    $(document).on('click','#update_disability',function(event){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_Disablity");?>',
    data: new FormData($("#disabilityform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#DisabilityModal').modal('hide');
     $(".modal-backdrop").remove(); 
    $('#disabilityform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Disability  Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }
    },
    });
    return false;
    })  
   //delete dependency
    $(document).on('click','.deldisability', function (e) {
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this disablity?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/Deletedisablity') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){
    
    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 1000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },2000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });
    });
    //password validation
   $(document).ready(function() {

        $('#password').keyup(function() {
            var password = $('#password').val();
            if (checkStrength(password) == false) {
                $('#savepass').attr('disabled', true);
            }
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
 
   

   

        function checkStrength(password) {
            var strength = 0;


            //If password contains both lower and uppercase characters, increase strength value.
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                $('.low-upper-case').addClass('text-success');
                $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');


            } else {
                $('.low-upper-case').removeClass('text-success');
                $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has numbers and characters, increase strength value.
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
                strength += 1;
                $('.one-number').addClass('text-success');
                $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-number').removeClass('text-success');
                $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has one special character, increase strength value.
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                strength += 1;
                $('.one-special-char').addClass('text-success');
                $('.one-special-char i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-special-char').removeClass('text-success');
                $('.one-special-char i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            if (password.length > 7) {
                strength += 1;
                $('.eight-character').addClass('text-success');
                $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.eight-character').removeClass('text-success');
                $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }




            // If value is less than 2

            if (strength < 2) {
                $('#result').removeClass()
                $('#password-strength').addClass('progress-bar-danger');

                $('#result').addClass('text-danger').text('Very Weak');
                $('#password-strength').css('width', '10%');
            } else if (strength == 2) {
                $('#result').addClass('good');
                $('#password-strength').removeClass('progress-bar-danger');
                $('#password-strength').addClass('progress-bar-warning');
                $('#result').addClass('text-warning').text('Week')
                $('#password-strength').css('width', '60%');
                return 'Week'
            } else if (strength == 4) {
                $('#result').removeClass()
                $('#result').addClass('strong');
                $('#password-strength').removeClass('progress-bar-warning');
                $('#password-strength').addClass('progress-bar-success');
                $('#result').addClass('text-success').text('Strength');
                $('#password-strength').css('width', '100%');

                return 'Strong'
            }

        }

    });
     $(document).on('click','#savepass',function(){
        event.preventDefault();
           $("#Reset_pass").valid();
            var password=$("#password").val();
            var confirmpassword=$('#confirm-password').val();
            var usertype=$('#usertype').val();
            var currentpass=$('#currentpass').val();

        if(password != '' && confirmpassword != '' && usertype != '' || currentpass != ''){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Employee/Password_Reset");?>',
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
         location.reload(true);
        },2000);
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

</script>
<script type="text/javascript">
 
    //personal document

     $(document).on('click','#update_personal',function(event){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("employee/Update_File");?>',
    data: new FormData($("#personaldocform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#personaldoc_modal').modal('hide');
     $(".modal-backdrop").remove(); 
    $('#personaldocform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }
    },
    });
    return false;
    })  

    //delete personal
    $(document).on('click','.delpersonal', function (e) {
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('employee/Deletepersonal') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){
    
    $.wnoty({
    type: 'success',
    message: "Successfully Deleted",
    autohideDelay: 1000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },2000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "Not deleted",
    autohideDelay: 3000,
    position: 'top-right'

    });
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });
    });
</script>
