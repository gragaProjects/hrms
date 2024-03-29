<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-user-secret" aria-hidden="true"></i>Template header & footer</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Shift Master</li> -->
                        <?php if($this->role->User_Permission('Shift','can_add') ){?>
                        <button type="button" class="btn btn-info" style="width: ;"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>Certificate/create_template_header" class="text-white"><i class="" aria-hidden="true"></i> Create header & footer </a></button>
                           <?php } ?>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">

              
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;<i class="fa fa-user-o" aria-hidden="true"></i>  Template header & footer</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th> S.NO</th>
                                                <th>Business Unit</th>
                                                <!-- <th>Template Name</th> -->
                                               
                                        
                                               <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                                <th>Action</th>
                                                 <?php }; ?>
                                            </tr>
                                        </thead>
                                  
                                         <tbody >
                                          <?php 
                                           $i = 1;
                                    
                                        foreach($certificate_data as $value): ?>
                                    <tr>
                                       
                                        <td><?php echo $i; ?></td>
                                        
                                        <td><?php if($value->busunit){ $id = $value->busunit;
                                        $data = $this->settings_model->matchbusinessunit($id);if($data){  echo $data->name;}} ?></td>
                                        <!-- <td><?php echo $value->title; ?></td> -->
                         
                                    
                                        <?php  if($this->role->User_Permission('business_unit','can_edit')){?>
                                        <td class="jsgrid-align-center ">
                                            <input type="hidden" name="id"  id="id" value="<?php echo $value->id; ?>"/>
                                            <a href="<?php echo base_url(); ?>Certificate/edit_template_header?I=<?php echo base64_encode($value->id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                          
                                               <!-- <a href="<?php echo base_url(); ?>Shift/ShiftDetails?id=<?php echo base64_encode($value->id)?>" title="View"  class="btn btn-sm btn-info waves-effect waves-light  " data-id="<?php echo $value->id; ?>"><i class="fa fa-eye"></i></a> -->

                                                <?php if($this->role->User_Permission('Shift','can_delete') ){?>
                                                <button   title="Delete" data-id="<?php echo $value->id; ?> "class="btn btn-sm btn-info waves-effect waves-light delete"><i class="fa fa-trash-o"></i></button>
                                                <?php } ?>



                                        </td>
                                         <?php }; ?>
                                    </tr>
                                    <?php $i++;
                                     endforeach; ?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>
<script>
    $('#employees123').DataTable({
        
    });

 
</script>
<script type="text/javascript">
    $(document).on('click','#inactive',function(){
    event.preventDefault();
    //var inactivestatus = $(this).val();
    var id = $(this).parents('tr').find('#id').val();
    //console.log(status);
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/depinactivestatus");?>',
    data: {
        id:id},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){   
    $.wnoty({
    type: 'success',
    message: 'Status  Inactive Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'

    });
    } 
    },
    });
    return false;
    })
  $(document).on('click','#active',function(){
    event.preventDefault();
   // var inactivestatus = $(this).val();
    var id = $(this).parents('tr').find('#id').val();

    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/depactivestatus");?>',
    data: {
        
        id:id},
    success:function(resp){
    var data=$.parseJSON(resp);

    if(data.status == 'success'){   
    $.wnoty({
    type: 'success',
    message: 'Status  Active Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'

    });
    } 
    },
    });
    return false;
    })  
    //structure
    $(document).on('click','.delete', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this data?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Certificate/Delete_tem_header') ?>',
    data: {id:id},
    success: function (response) {
    var data=$.parseJSON(response);
    if(data.status == 'success'){
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'
    });
    setTimeout(function(){
    location.reload(true);
    },3000);

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