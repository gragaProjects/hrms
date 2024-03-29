<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Attendance</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li> -->
                    </ol>
                </div>
            </div>
            <div class="container-fluid">

                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>attendance/Attendance" class="text-white"><i class="" aria-hidden="true"></i>  Attendance List</a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Application" class="text-white"><i class="" aria-hidden="true"></i>  Leave Application</a></button>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-6">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Attendance </h4>
                            </div>
                            <div class="card-body">
                                    <form method="post" id="Add_Attendanceform" enctype="multipart/form-data">
                                    <div class="modal-body">
			                                    <div class="form-group">
			                                        <label>Employee</label><span class="error"> *</span>
                                                <select class="form-control custom-select search" data-placeholder="Choose a Employee" tabindex="1" name="emid" id="emid" required>
                                                   
                                                   <?php if(!empty($attval->em_id)){ ?>
                                                    <option value="<?php echo $attval->em_id ?>"><?php echo $attval->first_name.' '.$attval->last_name ?></option>           
                                                   <?php } else { ?>
                                                   <option value="">Select Here</option>
                                                    <?php foreach($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name ?></option>
                                                    <?php endforeach; ?>
                                                    <?php } ?>
                                                </select>
			                                    </div>
                                            <label>Select Date: </label><span class="error"> *</span>
                                            <div id="" class="form-group input-group " >
                                                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input name="attdate" id="attenddate" class="form-control mydatetimepickerFull  " value="<?php if(!empty($attval->atten_date)) { 
                                                $old_date_timestamp = strtotime($attval->atten_date);
                                                $new_date = date('Y-m-d', $old_date_timestamp);    
                                                echo $new_date; } ?>"  autocomplete = 'off' >
                                               <label class="error" id="error"></label>
                                            </div>
                                        <div class="form-group" >
                                           <label class="m-t-20">Sign In Time</label><span class="error"> *</span>
                                            <input class="form-control single-input" name="signin" id="single-input" value="<?php if(!empty($attval->signin_time)) { echo  $attval->signin_time;} ?>" placeholder="Now" required>
                                        </div>
                                        <div class="form-group">
                                        <label class="m-t-20">Sign Out Time</label><span class="error"> *</span>
                                    
                                            <input type="text" name="signout" id="signout"   class="form-control single-input" value="<?php if(!empty($attval->signout_time)) { echo  $attval->signout_time;} ?>" required>
                                        
                                        </div> 
                                        <div class="form-group">
                                                    <label>Place</label><span class="error"> *</span>
                                                <select class="form-control custom-select" data-placeholder="" tabindex="1" name="place" id="place" required>
                                                    <option value="office" <?php if(isset($attval->place) && $attval->place == "office") { echo "selected"; } ?>>Office</option>
                                                    <option value="field"  <?php if(isset($attval->place) && $attval->place == "field") { echo "selected"; } ?>>Field</option>
                                                </select>
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id" value="<?php if(!empty($attval->id)){ echo  $attval->id;} ?>" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="attendanceUpdate" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                        

<script>
       $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })
      $(document).on('click','#attendanceUpdate',function(){
        event.preventDefault();
           $("#Add_Attendanceform").valid();
          /* var attenddate =$("#attenddate").val();
           if(attenddate === '')
           {
            ('#attenddate').next('<span class="error">This field is required<span>');
           }*/
            var emid=$("#emid").val();
            var signin=$('#single-input').val();
            var signout=$('#signout').val();
            var place=$('#place').val();
            var attenddate =$("#attenddate").val()

        if(emid != '' && signin != '' && signout != '' && place != ''&& attenddate != ''){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Attendance/Add_Attendance");?>',
        data: new FormData($("#Add_Attendanceform")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#Add_Attendanceform')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 3000,
        position: 'top-right'

        });
        /* setTimeout(function(){
         location.reload(true);
        },3000);*/
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
                          
<?php $this->load->view('backend/footer'); ?>