<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> TimeSheet Master</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">TimeSheet Master</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">

                        <?php
                         //$id = $this->uri->segment(3);
                         if (isset($timemaster_edit)) { ?><!-- $editdepartment -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit TimeSheet Master</h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors(); ?>
                          

                            <div class="card-body">
                                <!-- action="<?php echo base_url();?>organization/Update_dep" -->
                                    <form method="post" id="edittimemaster"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                 
                                                 
                                                        <label class="control-label">Country Name</label>
                                                       <input type="text" name="typename" id="typename" value="<?php  echo $timemaster_edit->typename?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $timemaster_edit->id?>">
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_country"> <i class="fa fa-check"></i> Save</button>
                                            <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>TimeSheet/TimeSheetMaster" class="btn btn-rounded btn-info">Add New</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Timesheet Master</h4>
                            </div>
                    
                            

                            <div class="card-body">
                                    <form method="post" action="" id="timesheetmasterform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"> Name</label>
                                                        <input type="text" name="typename" id="typename" value="" class="form-control" placeholder=""  >
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="save_country" > <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Timesheet Master List</h4>
                            </div>         
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                       <tbody>
                                            <?php foreach ($timemasterselect as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->typename;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>TimeSheet/timesheet_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                               
                                                 
                                                    <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light delcountry" >
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
   $(document).on('click','#save_country',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("TimeSheet/Save_timemaster");?>',
    data: $("#timesheetmasterform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#typename').val();
    $('#timesheetmasterform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#typename").after(data.error);
        $('#typename').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#typename").next().remove();
          $('#timesheetmasterform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_country',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("TimeSheet/Update_timemaster");?>',
    data: $("#edittimemaster").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var dep = $('#typename').val();
    $('#edittimemaster')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#typename").after(data.error);
        $('#typename').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#typename").next().remove();
          $('#edittimemaster')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
   //delete
    $(document).on('click','.delcountry', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this timesheet ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('TimeSheet/Delete_timemaster') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message:  data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },2000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: data.message,
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