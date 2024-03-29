<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Education</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Education</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">

                        <?php
                         $id = $this->uri->segment(3);
                         if (isset($id)) { ?><!-- $editEducation -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Education</h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors(); ?>
                      
                        <div class="card-body">
                                <form method="post" id="edit_edufrom"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                 
                                                 
                                                        <label class="control-label">Education Name</label>
                                                       <input type="text" name="education" id="education" value="<?php  echo $edu_data->education ?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $edu_data->id?>">
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_edu"> <i class="fa fa-check"></i> Save</button>
                                             <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>organization/Education" class="btn btn-rounded btn-info">Add New Education</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Education</h4>
                            </div>
                            <div class="card-body">
                                    <form method="post" action="" id="educationform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Education Name</label>
                                                        <input type="text" name="education" id="education" value="" class="form-control" placeholder="" minlength="3" >
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="save_edu" > <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Education List</h4>
                            </div>
                       
                        <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Education Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach ($eduselect as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->education;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>organization/Education_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                    <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light deledu" >
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
    $('.table').DataTable({
    "pagingType": "full_numbers"
    });
    });
   $(document).on('click','#save_edu',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Education");?>',
    data: $("#educationform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#education').val();
    $('#educationform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Education Added successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#education").after(data.error);
        $('#education').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#education").next().remove();
          $('#educationform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_edu',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_edu");?>',
    data: $("#edit_edufrom").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#education').val();
    $('#edit_edufrom')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Education Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#education").after(data.error);
        $('#education').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#education").next().remove();
          $('#edit_edufrom')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
   //delete
    $(document).on('click','.deledu', function (e) {
    var dep_id = $(this).parents('tr').find('#id').val();
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure delete education?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_edu') ?>',
    data: {dep_id:dep_id},
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
    message: "This department already used",
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