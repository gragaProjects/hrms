<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> Position Title</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Position Title </li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">
                        <?php if (isset($editpositiontitle)) { ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Position Title </h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                    
                            
                            

                            <div class="card-body">
                                    <form method="post" id="editposition" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Position Title Name</label>
                                                        <input type="text" name="positiontitle" id="positiontitle" value="<?php  echo $editpositiontitle->position_name;?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $editpositiontitle->id;?>">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_pos"> <i class="fa fa-check"></i> Save</button>
                                            <button type="reset" class="btn btn-info">Cancel</button>
                                            <a style="float:right;" href="<?php echo base_url();?>organization/Position" class="btn btn-rounded btn-info">Add New Position</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add New Position Title </h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                            
                            

                            <div class="card-body">
                                    <form method="post" id="positionform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Position Title  Name</label>
                                                        <input type="text" name="positiontitle" id="positiontitle" value="" class="form-control" placeholder="" minlength="3" >
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="add_position"> <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Position Title List</h4>
                            </div>
                

                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Position Title Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach ($position as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->position_name;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>organization/PositionTitle_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button  title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletepos"><i class="fa fa-trash-o"></i></button>
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
   $(document).on('click','#add_position',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_PositionTitle");?>',
    data: $("#positionform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var pre = $('#positiontitle').val();
    $('#positionform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Position Added successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#positiontitle").after(data.error);
        $('#positiontitle').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#positiontitle").next().remove();
          $('#positionform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_pos',function(){
    event.preventDefault();

    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_positiontitle");?>',
    data: $("#editposition").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
     var des = $('#positiontitle').val();
    $('#editposition')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Position Updated successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $("#positiontitle").after(data.error);
        $('#positiontitle').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#positiontitle").next().remove();
          $('#editposition')[0].reset();
        
         },2000); 
       
    } 
    },
    });
    return false;
    })  
      //delete
    $(document).on('click','.deletepos', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this position?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_positiontitle') ?>',
    data: {id:id},
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
    message: "This Position already used",
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