<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Course </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Couse</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">
                        <?php if (isset($editcourse)) { ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Course Name </h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                         
                            
                         <?php $depvalue = $this->employee_model->geteducationmaster(); ?>

                            <div class="card-body">
                                    <form method="post" id="editcourse" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                          <label class="control-label">Education Level</label>
                                                        <select name="edulevel" id="edulevel" class="form-control custom-select" required>
                                                       
                                                               <option value="">Select Education Level</option>
                                                                <?Php foreach($depvalue as $value): ?>
                                                                 <option value="<?php echo $value->id ?>"><?php echo $value->education ?></option>
                                                                <?php endforeach; ?>
                                                        </select>
                                                        </div> 
                                                        <div class="form-group">


                                                        <label class="control-label">Course Name</label>
                                                        <input type="text" name="coursename"id="coursename" value="<?php  echo $editcourse->courseName;?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $editcourse->cId;?>">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="update_course"> <i class="fa fa-check"></i> Save</button>
                                             <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>organization/Course" class="btn btn-rounded btn-info">Add New Course</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add New Course</h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                            <?php $depvalue = $this->employee_model->geteducationmaster(); ?>
                        <div class="card-body">
                                    <form method="post" id="courseform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Education Level</label>
                                                        <select name="edulevel" id="edulevel" class="form-control custom-select" required>
                                                       
                                                               <option value="">Select Education Level</option>
                                                                <?Php foreach($depvalue as $value): ?>
                                                                 <option value="<?php echo $value->id ?>"><?php echo $value->education ?></option>
                                                                <?php endforeach; ?>
                                                        </select> 
                                                    </div>
                                                     <div class="form-group">

                                                        <label class="control-label">Course Name</label>
                                                        <input type="text" name="coursename"id="coursename" class="form-control" placeholder="Ex: Bachelor or Arts" minlength="3" >
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="add_course"> <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Course Details</h4>
                            </div>
                   
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Education Level</th>
                                                <th>Course Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach ($coursetype as $value) { ?>
                                            <tr>
                                          
                                              <td><?php $id = $value->eLevelid;
                                                $data = $this->employee_model->matcheducation($id); echo $data->education; ?></td>
                                                <td><?php echo $value->courseName;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>organization/course_edit/<?php echo $value->cId;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delcourse"><i class="fa fa-trash-o"></i></button>
                                                     <input type="hidden" name="" value="<?php echo $value->cId;?>" id="id">
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
$(document).on('click','#add_course',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/SaveCourse");?>',
    data: $("#courseform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var pre = $('#coursename').val();
    $('#courseform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Course Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#coursename").after(data.error);
        $('#coursename').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#coursename").next().remove();
          $('#courseform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#update_course',function(){
    event.preventDefault();

    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_course");?>',
    data: $("#editcourse").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
     var des = $('#coursename').val();
    $('#editcourse')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Course Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#coursename").after(data.error);
        $('#coursename').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#coursename").next().remove();
          $('#editcourse')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
      //delete
    $(document).on('click','.delcourse', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this  course?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_course') ?>',
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
    message: "This Course Already Used",
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