<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Currency</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Currency</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">

                        <?php
                         $id = $this->uri->segment(3);
                         if (isset($currency_data)) { ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Currency</h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors(); ?>
                           

                            <div class="card-body">
                               
                                    <form method="post" id="editcurrency"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                
                                                        <label class="control-label">Currency Name</label><span class="error"> *</span>
                                                    <input type="text" name="currency_name" id="currency_name" value="<?php  echo $currency_data->currency_name?>" class="form-control" placeholder="" minlength="3" required><br>

                                                    <label class="control-label mt-3">Currency symbol </label><span class="error"> *</span>
                                                    <input type="text" name="currency_symbol" id="currency_symbol" value="<?php  echo $currency_data->currency_symbol?>"class="form-control"  required>
                                                        <input type="hidden" name="id" value="<?php  echo $currency_data->id?>" >
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_currency"> <i class="fa fa-check"></i> Save</button>
                                             <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>organization/Currency" class="btn btn-rounded btn-info">Add New Currency</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Currency</h4>
                            </div>
                       

                            <div class="card-body">
                                    <form method="post" action="" id="currencyform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Currency Name</label><span class="error"> *</span>
                                                        <input type="text" name="currency_name" id="currency_name" value="" class="form-control" placeholder="" minlength="3" required><br>
                                                        <label class="control-label mt-3">Currency symbol </label><span class="error"> *</span>
                                                        <input type="text" name="currency_symbol" id="currency_symbol" value="" class="form-control" placeholder="" minlength="" required>
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="save_currency" > <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Currency List</h4>
                            </div>
                       
                            
                            
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Currency Name</th>
                                                <th>Currency Symbol</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach ($Currency as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->currency_name;?></td>
                                                <td><?php echo $value->currency_symbol;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>organization/Currency_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                   
                                                    <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletecurrency" >
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
   $(document).on('click','#save_currency',function(){
    event.preventDefault();
     $("#currencyform").valid();
    var currency_name=$("#currency_name").val();
    var currency_symbol=$("#currency_symbol").val();
   if( currency_name!= '' && currency_symbol != ''){
       $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Currency");?>',
    data: $("#currencyform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#currency_name').val();
    $('#currencyform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Currency Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
     
    $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 1000,
    position: 'top-right'

    });
    } 
    },
    });
   }
 
    return false;
    })
    //update
    $(document).on('click','#edit_currency',function(){
    event.preventDefault();
        $("#editcurrency").valid();
    var currency_name=$("#currency_name").val();
    var currency_symbol=$("#currency_symbol").val();
   if( currency_name!= '' && currency_symbol != ''){
      
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_Currency");?>',
    data: $("#editcurrency").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#currency_name').val();
    $('#editcurrency')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Currency Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        /*$("#currency_name").after(data.error);
        $('#currency_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#currency_name").next().remove();
          $('#editcurrency')[0].reset();
        
         },2000);*/ 
    $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'

    });
    } 
    },
    });
  }
    return false;
    })  
   //delete
    $(document).on('click','.deletecurrency', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this  currency?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_Currency') ?>',
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
    message: "This Department Already Used",
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
