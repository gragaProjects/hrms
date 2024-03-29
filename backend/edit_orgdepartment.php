<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Edit Department </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Department</li> -->
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Department  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    <form  id="editdepform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                     
                                        <div class="form-group clearfix m-3">
                                           <div class="row"> 
                                           
                                            
                                         <div class="col-md-3">
                                        <label class="">Business Unit</label>
                                        <select name="busunit_id" id="busunit_id" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Business Unit</option>
                                      
                                             <?Php foreach($businessunitvalue as $value): ?>
                                                <option value="<?php echo $value->id ?>" <?php if($getorgdep->busunit_id == $value->id){echo 'selected';}?>> <?php echo $value->name ?></option>
                                         
                                            <?php endforeach; ?> 
                                        </select>
                                        <label id="busunit_id-error" class="error" for="busunit_id" style="display: none;">This field is required.</label>
                                    
                                      </div>
                                           <div class="col-md-3">
                                                 <label for="title" class="">Department Name</label>
                                                <input type="text" class="form-control validate" name="depname"  id="depname" placeholder=""  minlength="3" maxlength="120" <?php if(isset($getorgdep->depname)){ ?>value="<?php echo $getorgdep->depname; ?>" <?php }?>>
                                            </div>
                                          <div class="col-md-3">
                                                 <label for="title" class="">Deparment Code</label>
                                                <input type="text" class="form-control validate" name="depcode" id="depcode" placeholder=""  minlength="3" maxlength="120"
                                                <?php if(isset($getorgdep->depcode)){ ?>value="<?php echo $getorgdep->depcode; ?>" <?php }?> >
                                            </div>
                                               <div class="col-md-3">
                                        <label class="">Department Head</label>
                                        <select name="dephead_id" id="dephead_id" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Department Head</option>
                                            
                                             <?Php foreach($empvalue as $value): ?>
                                                <option value="<?php echo $value->em_id ?>" <?php if($getorgdep->dephead_id == $value->em_id ){echo 'selected';}?>> <?php echo $value->first_name.' '.$value->last_name ?></option>
                                         
                                            <?php endforeach; ?> 
                                        </select>
                                        <label id="dephead_id-error" class="error" for="dephead_id" style="display: none;">This field is required.</label>
                                         </div>
                                           </div>
                                         
                                        </div>                                    
                                 
                                          <div class="form-group clearfix m-3">
                                           <div class="row">
                                           
                                         
                                               <div class="col-md-3">
                                                 <label for="contact" class="">Started On</label>
                                                <input type="date" class="form-control" name="startedon" <?php 
                                               $newdate = date("Y-m-d", strtotime($getorgdep->startedon));
                                                if(isset($newdate)){ ?> value="<?php echo $newdate ?>" <?php }?> id="startedon" >
                                            </div>
                                             <div class="col-md-3">
                                                  <label for="description" class="">Description</label>
                                                <textarea class="form-control validate" id="description"  name="description" rows="1" required maxlength="200"><?php if(isset($getorgdep->description)){ ?><?php echo $getorgdep->description; ?> <?php }?></textarea>
                                            </div>  
                                              <div class="col-md-3">
                                             <label class="">Status</label>
                                               <select name="status" id="status" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                                
                                                <option value="1" <?php if($getorgdep->Active_status == "1"){echo 'selected';}?> >ACTIVE</option>
                                                <option value="0" <?php if($getorgdep->Active_status == "0"){echo 'selected';}?> >INACTIVE</option>
                                               </select>
                                            </div>
                                    
                                           </div>
                                         
                                        </div>  
                                                                                   
                                   
                                   
                                     
                                            <div class="form-group clearfix m-3">
                                                <div class="row">
                                          
                                           
                                                                                  
                                          </div> 
                                        </div> 

                                     
                                   
                                                                          
                                        <div class="form-group clearfix">
                                           
                                        </div>                                    
                                         <div class="form-group clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id"  id="id" value="<?php echo $getorgdep->id; ?>"/>
                                                <button type="submit" name="update_orgdep" id="update_orgdep" class="btn btn-info">Submit</button>
                                                 <a href="<?php echo base_url()?>settings/OrganisationDepartment" class="btn btn-info">Back</a>
                                                
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <div id="countrymodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <div id="statemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <div id="districtmodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                  <div id="citymodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <div id="depheadmodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Department Head</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="timezoneform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label">Department Head</label>
                                          <input type="text" name="departmenthead" id="departmenthead" value="" class="form-control" placeholder="" minlength="3" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                               
                                <button type="button" class="btn btn-info" id="add_dephead">Save</button>
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

   
    $(document).on('click','#update_orgdep',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Update_Orgdepartment");?>',
    data: new FormData($("#editdepform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#bussinessunitform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Department Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

      setTimeout(function(){
        window.location.href = '<?php echo base_url('settings/OrganisationDepartment')?>';
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
    return false;
    })  
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
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Country Added successfully',
    autohideDelay: 1000,
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
    $('[name="state"]').append("<option value="+data.state_success+">" + country + "</option>");
    $('#stateform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'State Added successfully',
    autohideDelay: 1000,
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

 
    var country = $('#city_name').val();
    $("#city").append("<option value="+data.state_success+">" + country + "</option>");
    $('[name="city"]').append("<option value="+data.state_success+">" + country + "</option>");
    $('#cityform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'City Added successfully',
    autohideDelay: 1000,
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
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Timezone Added successfully',
    autohideDelay: 1000,
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
    autohideDelay: 1000,
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
    autohideDelay: 1000,
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
