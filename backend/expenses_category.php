<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i>   Expenses Category </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> Expenses Category </li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                    <div class="col-lg-5">

                        <?php
                         //$id = $this->uri->segment(3);
                         if (isset($typevalue_edit)) { ?><!-- $editdepartment -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Expenses Category </h4> 
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
                                                 
                                                 
                                                        <label class="control-label">  Category Name</label>
                                                       <input type="text" name="category" id="category" value="<?php  echo $typevalue_edit->category?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $typevalue_edit->id?>">
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_salarytype"> <i class="fa fa-check"></i> Save</button>
                                            <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>Expenses/Expenses_category" class="btn btn-rounded btn-info">Add New</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Expenses Category </h4>
                            </div>
                    
                            

                            <div class="card-body">
                                    <form method="post" action="" id="typeform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                       
                                                        <div class="form-group">
                                                            <label class="control-label"> Category Name</label>
                                                            <input type="text" name="category" class="form-control" id="category"  maxlength="25" required>
                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="add_category" > <i class="fa fa-check"></i> Save</button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Expenses Category List</h4>
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
                                           foreach($expenseselect as $value): ?>
                                            <tr>
                                               <td><?php echo $i; ?></td>
                                                <td><?php echo $value->category ?></td>
                                               
                                                <td class="jsgrid-align-center ">
                                                   <!--  <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light TypeModal" data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a> -->
                                                      <a href="<?php echo base_url();?>Expenses/Expenses_category_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                               
                                                     <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light delcat" data-id="<?php echo $value->id;?>" >
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
   $(document).on('click','#add_category',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Expenses/Add_Expenses_category");?>',
    data: $("#typeform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#category').val();
    $('#typeform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Category Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#category").after(data.error);
        $('#category').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#category").next().remove();
          $('#typeform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //update
    $(document).on('click','#edit_salarytype',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Expenses/Update_Expenses_category");?>',
    data: $("#edittypeform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var dep = $('#category').val();
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
        $("#category").after(data.error);
        $('#category').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#category").next().remove();
          $('#edittypeform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
   //delete
    $(document).on('click','.delcat', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).attr('data-id');
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete category ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Expenses/Delete_Expenses_category') ?>',
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