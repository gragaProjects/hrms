<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Account Type</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Account Type</li>
            </ol>
        </div>
    </div>
    <div class="message"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <?php if (isset($editaccounttype)) { ?>
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Account Type</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
                    
                    
                    <div class="card-body">
                        <form method="post" id="edit_acc" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Account Type Name</label>
                                            <input type="text" name="accounttypename" id="accounttypename" value="<?php  echo $editaccounttype->account_type_name;?>" class="form-control" placeholder="">
                                            <input type="hidden" name="id" value="<?php  echo $editaccounttype->id;?>">
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-info" id="editacc"> <i class="fa fa-check"></i> Save</button>
                                <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                <a style="float:right;" href="<?php echo base_url();?>organization/AccountType" class="btn btn-rounded btn-info">Add New AccountType</a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } else { ?>
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add New Account Type</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
                    
                    
                    <div class="card-body">
                        <form method="post" id="saveform" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Account Type Name</label>
                                            <input type="text" name="accounttypename" id="accounttypename" value="" class="form-control" placeholder="" minlength="3" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-info" id="add_acc"> <i class="fa fa-check"></i> Save</button>
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
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Account Type List</h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Account Type Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($account_type as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->account_type_name;?></td>
                                        <td class="jsgrid-align-center ">
                                            <a href="<?php echo base_url();?>organization/AccountType_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                            <button  title="Delete" class="btn btn-sm btn-info waves-effect waves-light deleteacc"><i class="fa fa-trash-o"></i></button>
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
        $(document).on('click','#add_acc',function(){
        event.preventDefault();
        $.ajax({
        type:'post',
        url: '<?php echo base_url("organization/Save_AccountType");?>',
        data: $("#saveform").serialize(),
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        var pre = $('#accounttypename').val();
        $('#saveform')[0].reset();
        $.wnoty({
        type: 'success',
        message: 'Account Type Added successfully',
        autohideDelay: 3000,
        position: 'top-right'
        });
        setTimeout(function(){
        location.reload(true);
        },3000);
        }else if(data.error){
        $("#accounttypename").after(data.error);
        $('#accounttypename').next().css({'color':'red'});
        setTimeout(function(){
        $("#accounttypename").next().remove();
        $('#saveform')[0].reset();
        
        },2000);
        }
        },
        });
        return false;
        })
        //update
        $(document).on('click','#editacc ',function(){
        event.preventDefault();
        $.ajax({
        type:'post',
        url: '<?php echo base_url("organization/Update_AccountType");?>',
        data: $("#edit_acc").serialize(),
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'  ){
        var des = $('#accounttypename').val();
        $('#edit_acc')[0].reset();
        $.wnoty({
        type: 'success',
        message: 'Account Type  Updated successfully',
        autohideDelay: 3000,
        position: 'top-right'
        });
        setTimeout(function(){
        location.reload(true);
        },3000);
        }else if(data.error){
        $("#accounttypename").after(data.error);
        $('#accounttypename').next().css({'color':'red'});
        setTimeout(function(){
        $("#accounttypename").next().remove();
        $('#edit_acc')[0].reset();
        
        },2000);
        
        }
        },
        });
        return false;
        })
        //delete
        $(document).on('click','.deleteacc', function (e) {
        /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
        var id = $(this).parents('tr').find('#id').val();
        //console.log(id);
        $.confirm({
        title: 'Delete Warning!',
        content: 'Are you sure delete Account Type ?',
        boxWidth: '25%',
        useBootstrap: false,
        buttons: {
        delete: {
        text: 'Delete',
        btnClass: 'btn-primary',
        action: function(){
        $.ajax({
        type: 'post',
        url: '<?php echo base_url('organization/Delete_AccountType') ?>',
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
        message: "This Account Type already used",
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