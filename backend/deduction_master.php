<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i>  Deduction Master </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> Deduction </li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">

                        <?php
                         //$id = $this->uri->segment(3);
                         if (isset($Deduction_data)) { ?><!-- $editdepartment -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Deduction </h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors(); ?>
                          

                            <div class="card-body">
                                <!-- action="<?php echo base_url();?>organization/Update_dep" -->
                                    <form method="post" id="edittypeform"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                 
                                                        <label class="control-label">Deduction</label>
                                                       <input type="text" name="deduction" id="deduction" value="<?php  echo $Deduction_data->deduction_name ?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $Deduction_data->id?>">
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_salarytype"> <i class="fa fa-check"></i> Save</button>
                                            <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>organization/Deduction_master" class="btn btn-rounded btn-info">Add New</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Deduction </h4>
                            </div>
                    
                             <div class="card-body">
                                    <form method="post" action="" id="typeform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                       
                                                        <div class="form-group">
                                                            <label class="control-label">Deduction</label>
                                                            <input type="text" name="deduction" class="form-control" id="deduction"  maxlength="25" required>
                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="add_salarytype" > <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Deduction</h4>
                            </div>         
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.NO</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                <tbody>
                                           <?php 
                                            $i = 1;
                                           foreach($Deduction as $value): ?>
                                            <tr>
                                               <td><?php echo $i; ?></td>
                                                <td><?php echo $value->deduction_name ?></td>
                                               
                                                <td class="jsgrid-align-center ">
                                                  
                                                      <a href="<?php echo base_url();?>organization/Deduction_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                               
                                                     <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light delcountry" data-id="<?php echo $value->id;?>" >
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    
                                                </td>
                                            </tr>
                                            <?php $i++; endforeach;  ?>
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
   $(document).on('click','#add_salarytype',function(){
    event.preventDefault();
    if($('#deduction').val() != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Deduction");?>',
    data: $("#typeform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#deduction').val();
    $('#typeform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Deduction Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#deduction").after(data.error);
        $('#deduction').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#deduction").next().remove();
          $('#typeform')[0].reset();
        
         },2000); 
    } 
    },
    });
    }
    return false;
    })
    //update
    $(document).on('click','#edit_salarytype',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Update_Deduction");?>',
    data: $("#edittypeform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var dep = $('#deduction').val();
    $('#edittypeform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#deduction").after(data.error);
        $('#deduction').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#deduction").next().remove();
          $('#edittypeform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
   //delete
    $(document).on('click','.delcountry', function (e) {

    var id = $(this).attr('data-id')
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete deduction?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('organization/Delete_Deduction') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message:  data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },3000);

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