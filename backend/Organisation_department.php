<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-user-secret" aria-hidden="true"></i>Department</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Department</li> -->
                        <?php if($this->role->User_Permission('department','can_add') ){?>
                        <button type="button" class="btn btn-info" style="width: ;"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>settings/AddOrganisationDepartment" class="text-white"><i class="" aria-hidden="true"></i> Add Department</a></button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;<i class="fa fa-user-o" aria-hidden="true"></i>  Department List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th> S.NO</th>
                                                <th>Business Unit</th>
                                                <th>Department</th>
                                                <th>Deparment Code</th>
                                                <th>Department Head</th>
                                                <th>Started On</th>
                                                   <?php if($this->role->User_Permission('department','can_edit')){?>
                                                <th>Status</th>
                                                    <?php }; ?>
                                               <?php if($this->role->User_Permission('department','can_edit')){?>
                                                <th>Action</th>
                                                 <?php }; ?>
                                            </tr>
                                        </thead>
                                  

                                       <tbody id="orgdep_tbl">
                                          <?php 
                                           $i = 1;
                                        foreach($orgdepartmentselect as $value): ?>
                                    <tr>
                                       
                                        <td><?php echo $i; ?></td>
                                        
                                        <td><?php if($value->busunit_id){ $id = $value->busunit_id;
                                        $data = $this->settings_model->matchbusinessunit($id);if($data){  echo $data->name;}} ?></td>
                                        <td><?php echo $value->depname; ?></td>
                                        <td><?php echo $value->depcode; ?></td>
                                    
                                         <td><?php if($value->dephead_id){ $id = $value->dephead_id;
                                        $data = $this->settings_model->matchdepemp($id); if($data){echo $data->first_name.' '.$data->last_name;} }?></td>
                                         <td><?php //echo $value->startedon; 
                                         if($value->startedon){echo date('d M Y',strtotime($value->startedon));}?></td>
                                      <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                        <td>

                                                        <?php if($value->Active_status == "1"){ ?>
                                                <input type="checkbox" class="js-switch on" id="" data-color="#28a745" data-secondary-color="#f62d51" checked data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff'  />
                                                  <?php }elseif ($value->Active_status == "0"){ ?>
                                                      <input type="checkbox" class="js-switch off" id="" data-color="#28a745" data-secondary-color="#f62d51"  data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff' />
                                                <?php }; ?>
                                           <!--    <?php //echo $value->Active_status; 
                                               if($value->Active_status == "1"){ ?>
                                               <button type="button" class="btn btn-primary" id="inactive" value="<?php echo $value->Active_status; ?>" name="inactive" >INACTIVE</button><?php
                                               }elseif ($value->Active_status == "0"){ ?>
                                               <button type="button" class="btn btn-info" id="active" value="<?php echo $value->Active_status; ?>" name="active">ACTIVE</button><?php
                                               }?> -->
                                               
                                        </td>
                                          <?php }; if($this->role->User_Permission('business_unit','can_edit') || $this->role->User_Permission('business_unit','can_delete')){?>
                                        <td class="jsgrid-align-center ">
                                                     <?php if($value->Active_status == "1"){?>
                                                        <?php if($this->role->User_Permission('business_unit','can_edit') ){?>
                                            <input type="hidden" name="id"  id="id" value="<?php echo $value->id; ?>"/>
                                            <a href="<?php echo base_url(); ?>settings/edit_orgdepartment?I=<?php echo base64_encode($value->id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                              <?php } ?>
                                               <?php if($this->role->User_Permission('business_unit','can_delete') ){?>
                                                    <button   title="Delete" data-id="<?php echo $value->id; ?> "class="btn btn-sm btn-info waves-effect waves-light delete"><i class="fa fa-trash-o"></i></button>
                                                    <?php } ?>
                                             <?php }; ?>
                                           
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


      //------------new ----------------
        // Handle switch state change on checkbox click
        $(document).ready(function () {
            $('.js-switch').on('change', function () {
                var $row = $(this).closest('tr'); // Get the closest parent row element
                var checkedCheckbox = $row.find('.js-switch:checked'); // Get the checked checkbox within the row
                var id = $(this).data('id'); // Get the data-id attribute from the clicked checkbox

                if (checkedCheckbox.length > 0) {
                     $(this).removeClass("off").addClass("on");
                    // Switch is in the "on" position
                
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
    
                                    
                    // Display the "on" values
                    // console.log('Switch is ON');
                    // console.log('ID: ' + id);
                } else {
                          $(this).removeClass("on").addClass("off");
                    // Switch is in the "off" position
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
                    // console.log('Switch is OFF');
                    // console.log('ID: ' + id);
                }
            });
        });

            //delete
                $(document).on('click','.delete', function (e) {
                //var id = $(this).parents('tr').find('#id').val();
                var id = $(this).attr('data-id');
                $.confirm({
                title: 'Delete Warning!',
                content: 'Are you sure, you want to delete this department?',
                boxWidth: '25%',
                useBootstrap: false,
                buttons: {
                delete: {
                text: 'Delete',
                btnClass: 'btn-primary',
                action: function(){
                $.ajax({
                type: 'post',
                url: '<?php echo base_url('Settings/OrgDepartmentDelete') ?>',
                data: {id:id},
                success: function (response) {
                var data=$.parseJSON(response);
                if(data.status == 'success'){
                $.wnoty({
                type: 'success',
                message: data.message,
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