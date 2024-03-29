<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Edit Business Unit</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Business Unit</li> -->
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Edit Business Unit  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    <form  id="bussinessunitform" name="bussinessunitform"  method="post" enctype="multipart/form-data" >
                     
                                        <div class="form-group clearfix m-3">
                                           <div class="row"> 
                                           	   <div class="col-md-3">
                                            	 <label for="title" class="">Name</label>
                                                <input type="text" class="form-control validation" name="name"  id="name" placeholder=""  minlength="" maxlength="120" <?php if(isset($Getbusinessunit->name)){ ?>value="<?php echo $Getbusinessunit->name; ?>" <?php }?>>
                                               
                                            </div>
                                               <div class="col-md-3">
                                            	 <label for="title" class="">Code</label>
                                                <input type="text" class="form-control validation" name="code" id="code" placeholder=""  minlength="" maxlength="120" <?php if(isset($Getbusinessunit->code)){ ?>value="<?php echo $Getbusinessunit->code; ?>" <?php }?>>
                                                     
                                            </div>
                                                   <div class="col-md-3">
                                                 <label for="contact" class="">Started On</label><span class="error"> *</span>
                                                <input type="date" class="form-control validation" name="startedon" <?php 
                                               $newdate = date("Y-m-d", strtotime($Getbusinessunit->startedon));
                                                if(isset($newdate)){ ?> value="<?php echo $newdate ?>" <?php }?>  id="startedon" placeholder="">
                                                      <span class="reqst"></span>
                                            </div>
                                            <div class="col-md-3">
                                        <label class="">Time Zone</label>
                                        <select name="timezoneid" id="timezoneid" value="" class="form-control custom-select search validation" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select timezone</option>

                                             <?Php foreach($timezonevalue as $value): ?>
                                                <option value="<?php echo $value->id ?>" <?php if($Getbusinessunit->timezoneid == $value->id){echo 'selected';}?>><?php echo $value->timezone ?></option>
                                         
                                            <?php endforeach; ?> 
                                      
                                        </select>
                                              <span class="reqst"></span>
                                        <a href="" data-target="#timezonemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add timezone</a>
                                      </div>
                                           </div>
                                         
                                        </div>                                    
                                        <div class="form-group clearfix m-3">
                                            <div class="row">
                                         
                                                <div class="col-md-3">
                                        <label class="">Country</label>
                                        <select name="country" id="country"  class="form-control custom-select search  " style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                       
                                             <?Php foreach($countryvalue as $value): ?>
                                                <option value="<?php echo $value->id ?>" <?php if($Getbusinessunit->country == $value->id){echo 'selected';}?>><?php echo $value->country_name ?></option>
                                         
                                            <?php endforeach; ?> 
                                        </select>
                                        <span class="reqst"></span>
                                        <a href="" data-target="#countrymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add Country</a>
                                             
                                      </div>
                                      
                                        <div class="col-md-3">
                                             <label class="">State</label>
                                        <select name="state" id="state" value="" class="form-control custom-select search validation state" style="width: 100%; min-height: 38px;" >
                                          <!--   <option value="">Select State</option> -->
                                            <option value="<?php echo $Getbusinessunit->state; ?>"> <?php 
                                          if($Getbusinessunit->state){   $id = $Getbusinessunit->state;
                                                $data = $this->settings_model->matchstate($id); echo $data->state_name; 
                                        }?></option>

                                        
                                        </select>
                                              <span class="reqst"></span>
                                        <a href="" data-target="#statemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add State</a>
                                       </div> 
                                           <div class="col-md-3">
                                             <label class="">District</label>
                                        <select name="district" id="district" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                          <option value="<?php if($Getbusinessunit->district){ echo $Getbusinessunit->district;} ?>"> <?php 
                                          if($Getbusinessunit->district){ 
                                              $id = $Getbusinessunit->district;
                                                $data = $this->settings_model->matchdistrict($id); echo $data->district_name; }
                                        ?></option>
                                    
                                        </select>
                                        <a href="" data-target="#districtmodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add District</a>
                                       </div>
                                        <div class="col-md-3">
                                                        <label class="">City</label>
                                                        <select name="city" id="city" value="" class="form-control custom-select search validation city" style="width: 100%; min-height: 38px;" >
                                                            <!-- <option value="">Select City</option> -->
                                                            <option value="<?php echo $Getbusinessunit->city; ?>"> <?php
                                                            if($Getbusinessunit->state){ $id = $Getbusinessunit->city;
                                                            $data = $this->settings_model->matchcity($id); echo $data->city_name; }?></option>
                                                            
                                                        </select>
                                                        <span class="reqst"></span>
                                                        <a href="" data-target="#citymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right">Add City</a>
                                                    </div>
                                                                    
                                            </div>                                        
                                        </div> 
                                     
                                   
                                        <div class="form-group clearfix m-3">
                                        	<div class="row">
                                                   <div class="col-md-3">
                                                <label for="description" class="">Description</label>
                                                <textarea class="form-control " id="description"  name="description" rows="1"  minlength="" maxlength="200"><?php if(isset($Getbusinessunit->description)){ ?><?php echo $Getbusinessunit->description; ?> <?php }?></textarea>
                                            </div> 
                                                   
                                        		  <div class="col-md-3">
                                            	  <label for="description" class="">Street  Address1</label>
                                                <textarea class="form-control validation" id="address1"  name="address1" rows="1" required minlength="" maxlength="512"><?php if(isset($Getbusinessunit->address1)){ ?><?php echo $Getbusinessunit->address1; ?> <?php }?></textarea>

                                            </div>  
                                                  <span class="reqst"></span>
                                        		 <div class="col-md-3">
                                            	<label for="description" class="">Street Address2</label>
                                                <textarea class="form-control " id="address2"  name="address2" rows="1" maxlength="512"><?php if(isset($Getbusinessunit->address2)){ ?><?php echo $Getbusinessunit->address2; ?> <?php }?></textarea>
                                            </div>
                                             <div class="col-md-3">
                                                <label for="description" class="">Street Address3</label>
                                                <textarea class="form-control " id="address3"  name="address3" rows="1" maxlength="512" ><?php if(isset($Getbusinessunit->address3)){ ?><?php echo $Getbusinessunit->address3; ?> <?php }?></textarea>
                                            </div> 
                                          
                                        	</div>
                                            
                                                                                  
                                        </div>
                                                       <div class="form-group clearfix m-3  ">
                                         <div class="row ">
                                            <div class="col-md-3">
                                                   <label>Leave Structure</label>
                                            <select class="form-control custom-select assignleave"  tabindex="1" name="leavestructureid" id="leavestructureid" >
                                                <option value="">Select Here..</option>
                                                
                                                     <?php foreach($leavestruc as $value): ?>

                                                <option value="<?php echo $value->id ?>"  <?php if($Getbusinessunit->leavestructureid == $value->id){echo 'selected';}?> ><?php echo $value->leavestructure ?></option>
                                                 <?php endforeach; ?>
                                                
                                            </select>
                                         </div>   
                                         <div class="col-md-3">
                                         <label>Holiday Structure</label>
                                            <select class="form-control custom-select assignleave"  tabindex="1" name="holidaystructureid" id="holidaystructureid" >
                                                <option value="">Select Here..</option>
                                                    <?php if(isset($Getbusinessunit->holidaystructureid)){?>
                                                <?php foreach($holidaystruc as $holidayvalue): ?>

                                                <option value="<?php echo $holidayvalue->id ?>"  <?php if($Getbusinessunit->holidaystructureid == $holidayvalue->id){echo 'selected';}?>><?php echo $holidayvalue->holidaystructure ?></option>

                                                <?php endforeach; ?>
                                            <?php } else {?>
                                                 <?php foreach($holidaystruc as $value): ?>

                                                <option value="<?php echo $value->id ?>"  ><?php echo $value->holidaystructure ?></option>

                                                <?php endforeach; ?>
                                            <?php } ?>

                                            </select>
                                         </div>
                                        <!--   <div class="col-md-3">
                                            <label> Busniess Unit HR</label><span class="error"> *</span>
                                            <select name="hr" id="hr"  class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                                
                                               </select>
                                            <label id="hr-error" class="error" style="display: none;" for="hr">This field is required.</label>
                                             </div> -->
                                          <div class="col-md-3">
                                             <label class="">Status</label><span class="error"> *</span>
                                           <select name="status" id="status" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                            
                                            <option value="1" <?php if($Getbusinessunit->Active_status == "1"){echo 'selected';}?> >ACTIVE</option>
                                            <option value="0" <?php if($Getbusinessunit->Active_status == "0"){echo 'selected';}?> >INACTIVE</option>

         
                                        </select>
                                        </div>
                                           
                                        </div>  
                                        </div>
                                           
                                              
                                   
                                         <div class="form-group clearfix mt-3">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id" value="<?php echo $Getbusinessunit->id; ?>" 
                                                />
                                                <button type="submit" name="update_businessunit" id="update_businessunit" class="btn btn-info">Submit</button>
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
                   <div id="timezonemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    $(document).on('click','#update_businessunit',function(){
    event.preventDefault();
      $("#bussinessunitform").valid();
    if($('#hr').val() != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Update_businessunit");?>',
    data: new FormData($("#bussinessunitform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#bussinessunitform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Business Unit Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

       setTimeout(function(){
        window.location.href = '<?php echo base_url('settings/BusinessUnit')?>';
        },2000);
       
    /* setTimeout(function(){
     location.reload(true);
    },3000);*/
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
    }
    return false;
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
    setTimeout(function(){
    var country = $('#country_name').val();
     $("#country").append("<option value="+data.country_success+">" + country + "</option>");
    $('[name="country"]').append("<option value="+data.country_success+">" + country + "</option>");
    $('#countryform')[0].reset();
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Country Added Successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
     },2000);
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

    var state = $('#state_name').val();
     $("#state").append("<option value="+data.state_success+">" + state + "</option>");
   $("#stateid").append("<option value="+data.state_success+">" + state + "</option>");
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
      /*//city
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
    })*/
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
    setTimeout(function(){
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
     },2000);
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
      console.log(country);
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

    //HR
        //Reporting employee
        $(document).ready(function(){
     /*   $("#busunit").change(function(){
        
        var busunit = $(this).val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/GetReportEmp");?>",
        data: { busunit : busunit },
        success:function(data){
        var info=$.parseJSON(data);
        $("#hr").html(info.content);
        }
        })
            
        });*/
       //default
        var busunit = <?php echo $busid ?>;
        var hr = '<?=$Getbusinessunit->hr;?>';
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/Gethr");?>",
        data: { busunit : busunit,hr:hr },
        success:function(data){
        var info=$.parseJSON(data);
        $("#hr").html(info.content);
        }
        })
        });

    </script>
