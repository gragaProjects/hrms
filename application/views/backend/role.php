<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Role</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Role</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">         
    <div class="row">
        <div class="col-lg-5">
            <?php if (isset($editrole)) { ?>
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Role</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
               
               <div class="card-body">
                            <form method="post" id="editform" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Role Name</label>
                                                <input type="text" name="role" id="editrole" value="<?php  echo $editrole->role;?>" class="form-control" placeholder="">
                                                <input type="hidden" name="id" value="<?php  echo $editrole->id;?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info" id="edit_role"> <i class="fa fa-check"></i> Save</button>
                                     <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                    <a style="float:right;" href="<?php echo base_url();?>organization/Role" class="btn btn-rounded btn-info">Add New Role</a><!--  -->
                                </div>
                            </form>
                    </div>
                </div>
                <?php } else { ?>                        

                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Role</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
            
               <div class="card-body">
                            <form method="post" id="roleform" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Role Name</label>
                                                <input type="text" name="role" id="role" class="form-control" placeholder="" minlength="3" >
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info" 
                                    id="addrole"> <i class="fa fa-check"></i> Save</button>
                                     <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                </div>
                            </form>
                    </div>
                </div>
            <?php }?>
        </div>

        <div class="col-7">
            <div class="card card-outline-info">
                <div class="card-header">
                      <h4 class="m-b-0 text-white">&nbsp;&nbsp; Role List</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Role </th>
                                    <th class="text-center ">Action</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                <?php foreach ($role as $value) {?>
                                <tr>
                                    <td><?php echo $value->role;?></td>
                                    <td class="text-center ">
                                        <a href="<?php echo base_url();?>Permission/Role_Permissions/<?php echo $value->id?>" title="Assign Permission" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-tag"></i></a>
                                        <a href="<?php echo base_url();?>organization/Edit_role/<?php echo $value->id?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                        <button  title="Delete" class="btn btn-sm btn-info waves-effect waves-light deleterole"><i class="fa fa-trash-o"></i></button>
                                        <input type="hidden" name="" value="<?php echo $value->id;?>" id="id">
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
    $('.table').DataTable({
    "pagingType": "full_numbers"
    });
    });
   $(document).on('click','#addrole',function(){
    
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_role");?>',
    data: $("#roleform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var role = $('#role').val();
    $('#roleform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Role Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#role").after(data.error);
        $('#role').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#role").next().remove();
          $('#roleform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_role',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_role");?>',
    data: $("#editform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
     var des = $('#editrole').val();
    $('#editform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Role Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#editrole").after(data.error);
        $('#editrole').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#editrole").next().remove();
          $('#editform')[0].reset();
        
         },2000);
       
    } 
    },
    });
    return false;
    })  
      //delete
    $(document).on('click','.deleterole', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var role_id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this role?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Role_delete') ?>',
    data: {role_id:role_id},
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
    message: "This Role Already Used",
    autohideDelay: 1000,
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