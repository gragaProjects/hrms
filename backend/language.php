<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Language</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Language</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">
                        <?php if (isset($editlanguage)) { ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Language </h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                     

                            <div class="card-body">
                                    <form method="post" id='editlanguage' enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Language </label>
                                                        <input type="text" name="language" id="language"  value="<?php  echo $editlanguage->language_name;?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $editlanguage->id;?>">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_lang"> <i class="fa fa-check"></i> Save</button>
                                             <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                             <a style="float:right;" href="<?php echo base_url();?>organization/Language" class="btn btn-rounded btn-info">Add New Language</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add New Language</h4>
                            </div>
                            
                            <?php echo validation_errors(); ?>
                            <?php echo $this->upload->display_errors(); ?>
                          
                        

                            <div class="card-body">
                                    <form method="post" id="addlanguage" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Language </label>
                                                        <input type="text" name="language" id="language"class="form-control" placeholder="" minlength="3" >
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="add_lang"> <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Language List</h4>
                            </div>
                 
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Language Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach ($language as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->language_name;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>organization/Language_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletelang"><i class="fa fa-trash-o"></i></button>
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
$(document).on('click','#add_lang',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Language");?>',
    data: $("#addlanguage").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var pre = $('#language').val();
    $('#addlanguage')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Language Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#language").after(data.error);
        $('#language').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#language").next().remove();
          $('#addlanguage')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_lang',function(){
    event.preventDefault();

    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_Language");?>',
    data: $("#editlanguage").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
     var des = $('#language').val();
    $('#editlanguage')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Language Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#language").after(data.error);
        $('#language').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#language").next().remove();
          $('#editlanguage')[0].reset();
        
         },2000); 
       
    } 
    },
    });
    return false;
    })  
      //delete
    $(document).on('click','.deletelang', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure delete Language?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_Language') ?>',
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
    message: "This Language Already Used",
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