<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> State</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">State</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">
                    

                        <?php
                        
                         if (isset($state_data)) { ?><!-- $editdepartment -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit State</h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors();
                             
                             ?>
                                <div class="card-body">
                                <!-- action="<?php echo base_url();?>organization/Update_dep" -->
                                    <form method="post" id="editstate"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                                 <label class="">Country</label>
                                                        <select name="country" id="country" value="" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                                            <option>Select Country</option>
                                                             <?Php foreach($countryvalue as $value): ?>
                                                             <option value="<?php echo $value->id ?>"  <?php if(( $value->id == $state_data->country_id)){ echo 'selected';} ?> ><?php echo $value->country_name ?></option>
                                                            <?php endforeach; ?> 
                                                        </select>
                                                    </div>
                                                   <div class="form-group">
                                                 
                                                        <label class="control-label">State Name</label>
                                                       <input type="text" name="state_name" id="state_name" value="<?php  echo $state_data->state_name?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $state_data->id?>">
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_state"> <i class="fa fa-check"></i> Save</button>
                                        <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>settings/State" class="btn btn-rounded btn-info">Add New State</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add State</h4>
                            </div>
                    
                            

                            <div class="card-body">
                                    <form method="post" action="" id="stateform" enctype="multipart/form-data">
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
                                             <label class="control-label">State Name</label>
                                            <input type="text" name="state_name" id="state_name" value="" class="form-control" placeholder="" minlength="3" >
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="save_state" > <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; State List</h4>
                            </div>         
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                               <th>Country Name</th> 
                                                <th>State Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                     <tbody>
                                            <?php foreach ($state_veiw as $value) { ?>
                                            <tr>
                                             
                                                <td><?php $id = $value->country_id;
                                                $data = $this->settings_model->matchcountry($id); if($data) {echo $data->country_name; }?></td>
                                                <td><?php echo $value->state_name;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>Settings/State_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                               
                                                 
                                                    <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light delstate" >
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    <input type="hidden" name="dep_id" value="<?php echo $value->id;?>" id="id">
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
    
   $(document).on('click','#save_state',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_state");?>',
    data: $("#stateform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#state_name').val();
    $('#stateform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'State Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#state_name").after(data.error);
        $('#state_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#state_name").next().remove();
          $('#stateform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_state',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Update_state");?>',
    data: $("#editstate").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var dep = $('#state_name').val();
    $('#editstate')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'State Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#state_name").after(data.error);
        $('#state_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#state_name").next().remove();
          $('#editstate')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
   //delete
    $(document).on('click','.delstate', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this state?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Settings/Delete_state') ?>',
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
    </script>