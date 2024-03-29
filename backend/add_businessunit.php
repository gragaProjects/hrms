<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Add Business Unit</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Business Unit</li> -->
                    </ol>
                </div>
            </div>
           <?php echo validation_errors(); ?>
           <?php echo $this->upload->display_errors(); ?>
          
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Add Business Unit  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    <form  id="bussinessunitform" name="bussinessunitform"  method="post" enctype="multipart/form-data" >
                     
                                        <div class="form-group clearfix m-3">
                                           <div class="row"> 
                                           	   <div class="col-md-3">
                                            	 <label for="title" class="">Name</label><span class="error"> *</span>
                                                <input type="text" class="form-control validation" name="name"  id="name" placeholder=""  minlength="" maxlength="120" style="text-transform: capitalize;" required>
                                                   <span class="reqst"></span>
                                            </div>
                                               <div class="col-md-3">
                                            	 <label for="title" class="">Code</label><span class="error"> *</span>
                                                <input type="text" class="form-control validation" name="code" id="code" placeholder=""  minlength="" maxlength="120" required>
                                                     <span class="reqst"></span>

                                            </div>
                                                   <div class="col-md-3">
                                                 <label for="contact" class="">Started On</label><span class="error"> *</span>
                                                <input type="date" class="form-control validation" name="startedon" <?php 
                                               $newdate = date("Y-m-d", strtotime(isset($organisationvalue->startedon)));
                                                if(isset($newdate)){ ?> value="<?php //echo $newdate ?>" <?php }?>  id="startedon" placeholder="" required>
                                                      <span class="reqst"></span>
                                            </div>
                                            <div class="col-md-3">
                                        <label class="">Time Zone</label><span class="error"> *</span>
                                        <select name="timezoneid" id="timezoneid" value="" class="form-control custom-select search validation" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select timezone</option>

                                             <?Php foreach($timezonevalue as $value): ?>
                                                <option value="<?php echo $value->id ?>" ><?php echo $value->timezone ?></option>
                                         
                                            <?php endforeach; ?> 
                                      
                                        </select>
                                        <label id="timezoneid-error" class="error" for="timezoneid" style="display: none;">This field is required.</label>
                                        
                                              <span class="reqst"></span>
                                                <a href="" data-target="#timezonemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add timezone</a>
                                              </div>
                                           </div>
                                         
                                        </div>                                    
                                                                                  
                                      <div class="form-group clearfix m-3">
                                        <div class="row">
                                          
                                       
                                         <div class="col-md-3">
                                        <label class="">Country</label><span class="error"> *</span>
                                        <select name="country" id="country"  class="form-control custom-select search  " style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                      
                                             <?Php foreach($countryvalue as $value): ?>
                                                <option value="<?php echo $value->id ?>" ><?php echo $value->country_name ?></option>
                                         
                                            <?php endforeach; ?> 
                                        </select>
                                        <label id="country-error" class="error" for="country" style="display: none;">This field is required.</label>
                                        <span class="reqst"></span>
                                        <a href="" data-target="#countrymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add Country</a>
                                             
                                      </div>
                                      
                                        <div class="col-md-3">
                                             <label class="">State</label><span class="error"> *</span>
                                        <select name="state" id="state" value="" class="form-control custom-select search validation state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select State</option>

                                        
                                        </select>
                                          <label id="state-error" class="error" for="state" style="display: none;">This field is required.</label>
                                              <span class="reqst"></span>
                                        <a href="" data-target="#statemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add State</a>
                                       </div> 
                                            <div class="col-md-3">
                                             <label class="">District</label> <span class="error"> *</span>
                                        <select name="district" id="district" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                           <!--  <option value="">Select State</option> -->
                                    
                                        </select>
                                          <label id="district-error" class="error" for="district" style="display: none;">This field is required.</label>
                                        <a href="" data-target="#districtmodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add District</a>
                                       </div>
                                              <div class="col-md-3">
                                             <label class="">City</label><span class="error"> *</span>
                                        <select name="city" id="city" value="" class="form-control custom-select search validation city" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select City</option>

         
                                        </select>
                                          <label id="city-error" class="error" for="city" style="display: none;">This field is required.</label>
                                              <span class="reqst"></span>
                                        <a href="" data-target="#citymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add City</a>
                                       </div>
                                     
                                        </div>
                                     </div>                             
                                      
                                   
                                        <div class="form-group clearfix m-3">
                                        	<div class="row">
                                            
                                         <div class="col-md-3">
                                                    <label for="description" >Description</label>
                                                <textarea class="form-control " id="description"  name="description" rows="1"   maxlength="200"></textarea>
                                            </div>
                                        		  <div class="col-md-3">
                                            	  <label for="description" class="">Street  Address1</label>
                                                <textarea class="form-control validation" id="address1"  name="address1" rows="1" required  maxlength="512"></textarea>

                                            </div>  
                                                  <span class="reqst"></span>
                                        		 <div class="col-md-3">
                                            	<label for="description" class="">Street Address2</label>
                                                <textarea class="form-control " id="address2"  name="address2" rows="1"   maxlength="512"></textarea>
                                            </div>
                                                 <div class="col-md-3">
                                                <label for="description" class="">Street Address3</label>
                                                <textarea class="form-control " id="address3"  name="address3" rows="1"   maxlength="512"></textarea>
                                            </div> 
                                                     
                                      
                                        	       
                                        	</div>
                                           </div>
                                        
                                         <div class="form-group clearfix m-3  ">
                                         <div class="row ">
                                            <div class="col-md-3">
                                                   <label>Leave Structure</label>
                                            <select class="form-control custom-select assignleave"  tabindex="1" name="leavestructureid" id="leavestructureid" >
                                                <option value="">Select Here..</option>
                                                <?php if(isset($organisationvalue->leavestructureid)){?>
                                                <?php foreach($leavestruc as $leavevalue): ?>

                                                <option value="<?php echo $leavevalue->id ?>"  <?php if($organisationvalue->leavestructureid == $leavevalue->id){echo 'selected';}?>><?php echo $leavevalue->leavestructure ?></option>

                                                <?php endforeach; ?>
                                                <?php  }else{?>
                                                     <?php foreach($leavestruc as $value): ?>

                                                <option value="<?php echo $value->id ?>"  ><?php echo $value->leavestructure ?></option>
                                                 <?php endforeach; ?>
                                                <?php } ?>
                                            </select>
                                                <a href="<?php echo base_url('leave/HolidayStructure')?>" target="_blank"  class="float-right holidaystruc">Add Holiday Structure</a>
                                         </div>   
                                         <div class="col-md-3">
                                         <label>Holiday Structure</label>
                                            <select class="form-control custom-select assignleave"  tabindex="1" name="holidaystructureid" id="holidaystructureid" >
                                                <option value="">Select Here..</option>
                                                    <?php if(isset($organisationvalue->holidaystructureid)){?>
                                                <?php foreach($holidaystruc as $holidayvalue): ?>

                                                <option value="<?php echo $holidayvalue->id ?>"  <?php if($organisationvalue->holidaystructureid == $holidayvalue->id){echo 'selected';}?>><?php echo $holidayvalue->holidaystructure ?></option>

                                                <?php endforeach; ?>
                                            <?php } else {?>
                                                 <?php foreach($holidaystruc as $value): ?>

                                                <option value="<?php echo $value->id ?>"  ><?php echo $value->holidaystructure ?></option>

                                                <?php endforeach; ?>
                                            <?php } ?>

                                            </select>
                                                <a href="<?php echo base_url('leave/LeaveStructure')?>" target="_blank"  class="float-right leavestruc">Add Leave Structure</a>
                                         </div>
                                           <!--  <div class="col-md-3">
                                            <label> Busniess Unit HR</label><span class="error"> *</span>
                                            <select name="hr" id="hr"  class="form-control custom-select search" style="width: 100%; min-height: 38px;" disabled >
                                                
                                                <option value="">Select Employee</option>

                                          
                                    
                                            </select>
                                            
                                             </div> -->
                                          <div class="col-md-3">
                                             <label class="">Status</label><span class="error"> *</span>
                                            <select name="status" id="status" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                            
                                            <option value="1" selected>ACTIVE</option>
                                            <option value="0">INACTIVE</option>
                                        </select>
                                        </div>
                                       
                                        </div>  
                                        </div>  
                                   
                                                                          
                                        <div class="form-group clearfix">
                                           
                                        </div>                                    
                                         <div class="form-group clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id" 
                                                />
                                                <button type="submit" name="add_businessunit" id="add_businessunit" class="btn btn-info">Submit</button> 
                                                 <a href="<?php echo base_url()?>settings/BusinessUnit" class="btn btn-info">Back</a>
                                                
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <div id="countrymodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Country</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="countryform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label">Country Name</label>
                                          <input type="text" name="country_name" id="country_name" value="" class="form-control" placeholder="" minlength="3" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                           
                                <button type="button" class="btn btn-info" id="add_country">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            </div>
                             </form>
                        </div>
                    </div>
                </div>     
                <div id="statemodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add State</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="stateform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="country" value="" class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option>Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                          <input type="text" name="state_name" id="state_name" value="" class="form-control" placeholder="" minlength="3" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-info" id="add_state">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                               
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                          <div id="districtmodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add District</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="districtform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="districtmodel_country"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                           <select name="state" id="districtmodel_state" value="" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select State</option>

                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                     <label class="control-label">District Name</label>
                                            <input type="text" name="district_name" id="district_name" value="" class="form-control" placeholder="" minlength="3" >

                                     </div>
                               
                            </div>
                            <div class="modal-footer">
                          
                                <button type="button" class="btn btn-primary" id="add_district">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                  <div id="citymodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add City</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="cityform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="citymodel_country"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                           <select name="state" id="citymodel_state" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select State</option>

                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">District Name</label>
                                           <select name="district" id="citymodel_district" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select District</option>

                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                     <label class="control-label">City Name</label>
                                            <input type="text" name="city_name" id="city_name"  class="form-control" placeholder="" minlength="3" >

                                     </div>
                               
                            </div>
                            <div class="modal-footer">
                          
                                <button type="button" class="btn btn-primary" id="add_city">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                   <div id="timezonemodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Timezone</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="timezoneform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label">Time zone</label>
                                          <input type="text" name="timezone" id="timezone" value="" class="form-control" placeholder="" minlength="3" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                               
                                <button type="button" class="btn btn-info" id="add_timezone">Save</button>
                                 <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            </div>
                             </form>
                        </div>
                    </div>
                </div> 
                
    <?php $this->load->view('backend/footer'); ?>
  
    <script type="text/javascript">
         $(".search").select2({
          theme:"bootstrap"
      });

    $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })


   //$(document).on('submit','#bussinessunitform',function(){
    $(document).ready(function () {
 
    $(document).on('click', '#add_businessunit', function(e) {
    //$('#bussinessunitform').submit(function(event) {
    e.preventDefault();
     $("#bussinessunitform").valid();
    var name=$("#name").val();
    var code=$("#code").val();
    var startedon=$("#startedon").val();
    var timezoneid=$("#timezoneid").val();
    var country=$("#country").val();
    var state=$("#state").val();
    var city=$("#city").val();
    var address1=$("#address1").val();
   if(name != '' && code != ''  && startedon != '' && timezoneid != '' && country != '' && state != '' && city!= '' && address1 != ''){
    
   $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Save_Businessunit");?>',
    data: new FormData($("#bussinessunitform")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#bussinessunitform')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: 'Business Unit Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

    setTimeout(function(){
        window.location.href = '<?php echo base_url('settings/BusinessUnit')?>';
        },2000);
       
  
   }else if(data.status == 'error'){

        $.wnoty({
        type: 'error',
        message: data.message,
        autohideDelay: 1000,
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
    //add Bussiness Unit
 
    //country
    $(document).on('click','#add_country',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_Country");?>',
    data: $("#countryform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#countrymodel').modal('hide');
    $(".modal-backdrop").remove();
   
    var country = $('#country_name').val();
    $("#country").append("<option value="+data.country_success+">" + country + "</option>");
    $('[name="country"]').append("<option value="+data.country_success+">" + country + "</option>");
    $('#countryform')[0].reset();
    //alert('Department Added Successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Country Added Successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
  
    //  
    }else if(data.error){
        $("#country_name").after(data.error);
        $('#country_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#country_name").next().remove();
          $('#countryform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
    //state
     $(document).on('click','#add_state',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_state");?>',
    data: $("#stateform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#statemodel').modal('hide');
    $(".modal-backdrop").remove();
  
    var country = $('#state_name').val();
   $("#state").append("<option value="+data.state_success+">" + country + "</option>");
   $("#stateid").append("<option value="+data.state_success+">" + country + "</option>");
    $('#stateform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'State Added Successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
  
  
    //  
    }else if(data.error){
        $("#state_name").after(data.error);
        $('#state_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#state_name").next().remove();
          $('#stateform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
      
     //timezone
    $(document).on('click','#add_timezone',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_timezone");?>',
    data: $("#timezoneform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#timezonemodel').modal('hide');
    $(".modal-backdrop").remove();
   
    var timezone = $('#timezone').val();
    $("#timezoneid").append("<option value="+data.message+">" + timezone + "</option>");
    $('#timezoneform')[0].reset();
    //alert('Department Added Successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Timezone Added Successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
    
    //  
    }else if(data.error){
        $("#timezone").after(data.error);
        $('#timezone').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#timezone").next().remove();
          $('#timezoneform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })

     //save district
    $(document).on('click','#add_district',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_district");?>',
    data: $("#districtform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
   $('#districtmodel').modal('hide');
    $(".modal-backdrop").remove();
    var district = $('#district_name').val();
    $('#districtform')[0].reset();
     $("#district").append("<option value="+data.state_success+">" + district + "</option>");
    $.wnoty({
    type: 'success',
    message: 'District Added Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
   
   }else if(data.error){
        $("#district_name").after(data.error);
        $('#district_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#district_name").next().remove();
          $('#districtform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
     //city
     $(document).on('click','#add_city',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_city");?>',
    data: $("#cityform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#citymodel').modal('hide');
    $(".modal-backdrop").remove();

    var city = $('#city_name').val();
    $("#city").append("<option value="+data.state_success+">" + city + "</option>");
    $('#cityform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'City Added Successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
  
  
    //  
    }else if(data.error){
        $("#city_name").after(data.error);
        $('#city_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#city_name").next().remove();
          $('#cityform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })

    //select matched state
    $(document).ready(function(){
    $("#country").change(function(){
       
      var country = $("#country").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#state").html(info.content);
             } 
        })
    });
 
    });   
     //select matched state modal
    $(document).ready(function(){
    $("#districtmodel_country").change(function(){
       
      var country = $(this).val();
      console.log(country);
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $('#districtmodel_state').html(info.content);
             } 
        })
    });
 
    });  
    $(document).ready(function(){
    $("#citymodel_country").change(function(){
       
      var country = $(this).val();
      //console.log(country);
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $('#citymodel_state').html(info.content);
             } 
        })
    });
 
    });
  /* var country = $("#country option:selected").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#state").html(info.content);
             } 
        })*/
 
   //select matched district
    $(document).ready(function(){
    $("#state").change(function(){
       
      var state = $("#state").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_district");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $("#district").html(info.content);
             } 
        })
    });
 
    }); 
   //select matched district modal
    $(document).ready(function(){
    $('#citymodel_state').change(function(){
       
      var state = $(this).val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_district");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $('#citymodel_district').html(info.content);
             } 
        })
    });
 
    });

    //select matched city
    $(document).ready(function(){
    $("#district").change(function(){
       
      var district = $("#district").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { district : district },
             success:function(data){
                var info=$.parseJSON(data);
                $("#city").html(info.content);
             } 
        })
    });
 
    });    
    $(document).ready(function(){
    $("#citymodel_district").change(function(){
       
      var district = $(this).val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { district : district },
             success:function(data){
                var info=$.parseJSON(data);
                $("#citymodel_city").html(info.content);
             } 
        })
    });
 
    });
    
    </script>
