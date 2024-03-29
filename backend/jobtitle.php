<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> Job Title</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Job Title </li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">
                        <?php if (isset($editjobtitle)) { ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Job Title </h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                       
                        <div class="card-body">
                                    <form method="post" id="editform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Job Title Name</label>
                                                        <input type="text" name="jobtitle" id="jobtitle" value="<?php  echo $editjobtitle->jobtitle_name;?>" class="form-control" placeholder="" required>
                                                        <input type="hidden" name="id" value="<?php  echo $editjobtitle->id;?>">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_job"> <i class="fa fa-check"></i> Save</button>
                                            <button type="reset" class="btn btn-info">Cancel</button>
                                            <a style="float:right;" href="<?php echo base_url();?>organization/JobTitle" class="btn btn-rounded btn-info">Add New Job Title</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add New Job Title </h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                          <div class="card-body">
                                    <form method="post" id="jobform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Job Title  Name</label>
                                                        <input type="text" name="jobtitle" id="jobtitle" value="" class="form-control" placeholder="" minlength="3" required>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="add_job"> <i class="fa fa-check"></i> Save</button>
                                            <button type="reset" class="btn btn-info">Cancel</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php }?>
                    </div>

                    <div class="col-7">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Job Title List</h4>
                            </div>
                       
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Job Title Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach ($jobtitle as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->jobtitle_name;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>organization/JobTitle_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletejob"><i class="fa fa-trash-o"></i></button>
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
   $(document).on('click','#add_job',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_JobTitle");?>',
    data: $("#jobform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var des = $('#jobtitle').val();
    $('#jobform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'JobTitle Added successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#jobtitle").after(data.error);
        $('#jobtitle').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#jobtitle").next().remove();
          $('#jobform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_job',function(){
    event.preventDefault();

    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_jobtitle");?>',
    data: $("#editform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
     var des = $('#jobtitle').val();
    $('#editform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'JobTitle Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#jobtitle").after(data.error);
        $('#jobtitle').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#jobtitle").next().remove();
          $('#editform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
      //delete
    $(document).on('click','.deletejob', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var job_id = $(this).parents('tr').find('#id').val();
    //console.log(job_id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this jobtitle?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_jobtitle') ?>',
    data: {job_id:job_id},
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
    message: "This JobTitle already used",
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
