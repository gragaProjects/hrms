<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cubes" style="color:#1976d2"></i> Country</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Country</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div> 
            <div class="container-fluid">         
                <div class="row">
                         <?php /*if($this->role->User_Permission('org_master','can_view') && $this->role->User_Permission('org_master','can_add') && $this->role->User_Permission('org_master','can_edit') && $this->role->User_Permission('org_master','can_delete')){*/?>
                    <div class="col-lg-5">

                        <?php
                         //$id = $this->uri->segment(3);
                         if (isset($country_data)) { ?><!-- $editdepartment -->
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Country</h4> 
                            </div>
                            
                            <?php echo validation_errors(-1); ?>
                            <?php echo $this->upload->display_errors(); ?>
                          

                            <div class="card-body">
                                <!-- action="<?php echo base_url();?>organization/Update_dep" -->
                                    <form method="post" id="editcountry"  enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                 
                                                 
                                                        <label class="control-label">Country Name</label>
                                                       <input type="text" name="country_name" id="country_name" value="<?php  echo $country_data->country_name?>" class="form-control" placeholder="">
                                                        <input type="hidden" name="id" value="<?php  echo $country_data->id?>">
                                                        

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-info" id="edit_country"> <i class="fa fa-check"></i> Save</button>
                                            <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                            <a style="float:right;" href="<?php echo base_url();?>settings/Country" class="btn btn-rounded btn-info">Add New Country</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                        <?php } else { ?>                        

                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Country</h4>
                            </div>
                    
                            

                            <div class="card-body">
                                    <form method="post" action="" id="countryform" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Country Name</label>
                                                        <input type="text" name="country_name" id="country_name" value="" class="form-control" placeholder="" minlength="3" >
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Country List</h4>
                            </div>         
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="deptable" class="display  table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Country Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                       <tbody>
                                            <?php foreach ($country_veiw as $value) { ?>
                                            <tr>
                                                <td><?php echo $value->country_name;?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url();?>Settings/Country_edit/<?php echo $value->id;?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light">
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
                <?php  ?>
                </div>
    <?php $this->load->view('backend/footer'); ?>
    <script>
   $(document).on('click','#save_country',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_Country");?>',
    data: $("#countryform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    var dep = $('#country_name').val();
    $('#countryform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Country Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },2000);
   }else if(data.error){
        $("#country_name").after(data.error);
        $('#country_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#country_name").next().remove();
          $('#countryform')[0].reset();
        
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
    url: '<?php echo base_url("Settings/Update_Country");?>',
    data: $("#editcountry").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    var dep = $('#country_name').val();
    $('#editcountry')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Country Updated successfully',
    autohideDelay: 2000,
    position: 'top-right'

    });
     setTimeout(function(){
     location.reload(true);
    },1000);
   }else if(data.error){
        $("#country_name").after(data.error);
        $('#country_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#country_name").next().remove();
          $('#editcountry')[0].reset();
        
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
    content: 'Are you sure, you want to delete this country?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Settings/Delete_Country') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message:  data.message,
    autohideDelay: 2000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },1000);

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
    
  //table
    $(document).ready(function() {
       $('#deptable').DataTable({
    "pagingType": "full_numbers"
  });
});
    </script>