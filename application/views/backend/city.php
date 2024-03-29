<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> City</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">City</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">
                    

                        <?php
                        
                         if (isset($city_data)) { ?><!-- $editdepartment -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit City</h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors();
                             
                             ?>
                                <div class="card-body">
                                <!-- action="<?php echo base_url();?>organization/Update_dep" -->
                                    <form method="post" id="editcity" name="editcity"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                 <label class="">Country</label>
                                        <select name="country" id="country" value="" class="form-control custom-select search editcountry" style="width: 100%; min-height: 38px;" required>
                                            <option>Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"  <?php if(( $value->id == $city_data->country_id)){ echo 'selected';} ?> ><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>  
                                        </div>
                                          <div class="form-group"> 

                                        <label class="">State</label>
                                        <select name="state" id="state" value="" class="form-control custom-select search editstate" style="width: 100%; min-height: 38px;" required>
                                            
                                     <?php if($city_data->state_id > 0){ ?>
                                            <option value="<?php echo $city_data->state_id; ?>"> <?php 
                                            $id = $city_data->state_id; 
                                                $data = $this->settings_model->matchstate($id); echo $data->state_name; 
                                            }
                                        ?></option>
                                        </select>
                                        </div>
                                        <div class="form-group">   
                                          <label class="">District</label>
                                        <select name="district" id="district" value="" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                            <?php if($city_data->district_id > 0){ ?>
                                              <option value="<?php   if(isset($city_data->district_id)){ echo $city_data->district_id;} ?>"> <?php 
                                              if(isset($city_data->district_id)){
                                            $id = $city_data->district_id; 
                                                $data = $this->settings_model->matchdistrict($id); echo $data->district_name;
                                                } }
                                        ?>
                                         
                                        </select>
                                       </div>
                                          <div class="form-group">
                                            <label class="control-label">City Name</label>
                                            <input type="text" name="city_name" id="city_name" value="<?php  echo $city_data->city_name?>" class="form-control" placeholder="" minlength="3" >
                                             <input type="hidden" name="id" value="<?php  echo $city_data->id?>">
                                         </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_city"> <i class="fa fa-check"></i> Save</button>
                                         <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                             <a style="float:right;" href="<?php echo base_url();?>settings/city" class="btn btn-rounded btn-info">Add New city</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add City</h4>
                            </div>
                      <div class="card-body">
                                    <form method="post"  id="cityform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                 <label class="">Country</label>
                                        <select name="country" id="country" value="" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                            <option>Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                        </div>
                                          <div class="form-group">   
                                          <label class="">State</label>
                                        <select name="state" id="state" value="" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                            <option>Select State</option>
                                           <!--   <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?>  -->
                                        </select>
                                       </div>  
                                        <div class="form-group">   
                                          <label class="">District</label>
                                        <select name="district" id="district" value="" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                            <option>Select District</option>
                                           <!--   <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?>  -->
                                        </select>
                                       </div>
                                      <div class="form-group">
                                            <label class="control-label">City Name</label>
                                            <input type="text" name="city_name" id="city_name" value="" class="form-control" placeholder="" minlength="3" >
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="save_city" > <i class="fa fa-check"></i> Save</button>
                                            <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php }?>
                    </div>

                    <div class="col-7">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; City List</h4>
                            </div>         
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                               <th>Country Name</th> 
                                                <th>State Name</th>
                                              <th>District Name</th>
                                                <th>City Name</th>
                                     
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                     <tbody>
                                            <?php foreach ($city_veiw as $value) { ?>
                                            <tr>
                                             
                                                <td><?php $id = $value->country_id;
                                                $data = $this->settings_model->matchcountry($id); if($data) {echo $data->country_name; }?></td>
                                                <td><?php $id = $value->state_id;
                                                $data = $this->settings_model->matchstate($id); if($data) { echo $data->state_name; }?></td> 
                                                <td><?php $id = $value->district_id; 
                                                $data = $this->settings_model->matchdistrict($id); if($data) { echo $data->district_name;}?></td>
                                                
                                                <td><?php echo $value->city_name;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>Settings/city_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                               
                                                 
                                                    <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light delcity" >
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    <input type="hidden" name="id" value="<?php echo $value->id;?>" id="id">
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php $this->load->view('backend/footer'); ?>
    <script>

  //table
    $(document).ready(function() {
       $('#deptable').DataTable({
    "pagingType": "full_numbers"
  });
});
    
   $(document).on('click','#save_city',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/save_city");?>',
    data: $("#cityform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#city_name').val();
    $('#cityform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'City Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#city_name").after(data.error);
        $('#city_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#city_name").next().remove();
          $('#cityform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_city',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Update_city");?>',
    data: $("#editcity").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var dep = $('#city_name').val();
    $('#editcity')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'City Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#city_name").after(data.error);
        $('#city_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#city_name").next().remove();
          $('#editcity')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
   //delete
    $(document).on('click','.delcity', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this city?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Settings/Delete_city') ?>',
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
    message:  data.message,
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

    
 /*   if($('#editcity').attr('name') == 'editcity'){
   var country = $(".editcountry").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $(".editstate").html(info.content);
             } 
        })
   }*/
    </script>