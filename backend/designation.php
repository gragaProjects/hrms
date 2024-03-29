<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Designation</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Designation</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">         
    <div class="row">
        <div class="col-lg-5">
            <?php if (isset($editdesignation)) { ?>
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Designation</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
             
              <div class="card-body">
                            <form method="post"  id ="editdes" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Designation Name</label>
                                                <input type="text" name="designation" id="designation" value="<?php  echo $editdesignation->des_name;?>" class="form-control" placeholder="">
                                                <input type="hidden" name="id" value="<?php  echo $editdesignation->id;?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info" id="edit_des"> <i class="fa fa-check"></i> Save</button>
                                    <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                    <a style="float:right;" href="<?php echo base_url();?>organization/Designation" class="btn btn-rounded btn-info">Add New Designation</a><!--  -->
                                </div>
                            </form>
                    </div>
                </div>
                <?php } else { ?>                        

                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Designation</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
               
                    

                    <div class="card-body">
                            <form method="post" id="desform" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Designation Name</label>
                                                <input type="text" name="designation" id="designation" value="" class="form-control" placeholder="" minlength="3" >
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info" id="save_des"> <i class="fa fa-check"></i> Save</button>
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
                      <h4 class="m-b-0 text-white">&nbsp;&nbsp; Designation List</h4>
                </div>
                <div>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Designation </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <?php foreach ($designation as $value) {?>
                                <tr>
                                    <td><?php echo $value->des_name;?></td>
                                    <td class="jsgrid-align-center ">
                                        <a href="<?php echo base_url();?>organization/Edit_des/<?php echo $value->id?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                        <!-- onclick="return confirm('Are you sure to delete this data?')"  -->
                                        <button   title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletedes"><i class="fa fa-trash-o"></i></button>
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
   $(document).on('click','#save_des',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_des");?>',
    data: $("#desform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var des = $('#designation').val();
    $('#desform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Designation Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#designation").after(data.error);
        $('#designation').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#designation").next().remove();
          $('#desform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_des',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_des");?>',
    data: $("#editdes").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
     var des = $('#designation').val();
    $('#editdes')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Designation Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#designation").after(data.error);
        $('#designation').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#designation").next().remove();
          $('#editdes')[0].reset();
        
         },2000); 
     } 
    },
    });
    return false;
    })  
      //delete
    $(document).on('click','.deletedes', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var des_id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this designation?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/des_delete') ?>',
    data: {des_id:des_id},
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
    message: "This Designation already used",
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