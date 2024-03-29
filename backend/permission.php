<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
<style type="text/css">
    .table{
    margin-bottom:0px!important;
}
</style>

         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Assign Permission(<?php echo $role->role; ?>)</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Assign Permission</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">         
    <div class="row">
<!--         <div class="col-lg-5">
      
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Role</h4>
                    </div>
                    
                    <?php echo validation_errors(); ?>
                    <?php echo $this->upload->display_errors(); ?>
            
               <div class="card-body">
                            <form method="post" id="roleform" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Role Name</label>
                                                <input type="text" name="role" id="role" class="form-control" placeholder="" minlength="3" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                   
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info" 
                                    id="addrole"> <i class="fa fa-check"></i> Save</button>
                                     <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                </div>
                            </form>
                    </div>
                </div>
           
        </div> -->

        <div class="col-12">
            <div class="card card-outline-info">
                <div class="card-header">
                      <h4 class="m-b-0 text-white">&nbsp;&nbsp; Assign Permission</h4>
                </div>

                <div class="card-body"><!-- <?php //echo site_url('admin/roles/permission/' . $role['id']) ?> -->
                	<form id="form1" action="<?php echo base_url('Permission/Assign_Permissions/' . $role->id) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                		 <input type="hidden" name="role_id" value="<?php echo $role->id ?>"/>
                		<div class="float-right">
                		<button style="margin-bottom: 10px;text-align: right;" class="btn btn-primary delete_all" type="submit">Save</button>

                        <a href="<?php echo base_url();?>organization/Role" class="btn btn-primary" style="margin-bottom: 10px;text-align: right;" >Back</a>

                         </div>
                    <div class="table-responsive ">
                        <table id="example123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Module </th>
                                    <th>Category</th>
                                    <th class="text-center">
                                        <div class="">
                                            <div>
                                                Veiw
                                            </div>
                                            <div class='form-check'>
                                                <input type='checkbox' class='filled-in chk-col-light-blue' id='master'>
                                                <label class='form-check-label' for='master'></label>
                                            </div>
                                            
                                        </div>
                                   </th>
                                    <th class="text-center">
                                        <div class="">
                                            <div>
                                                Add
                                            </div>
                                            <div class='form-check'>
                                                <input type='checkbox' class='filled-in chk-col-light-blue' id='addmaster'>
                                                <label class='form-check-label' for='addmaster'></label>
                                            </div>
                                            
                                        </div>
                                     </th>
                                    <th class="text-center"> 
                                          <div class="">
                                            <div>
                                                Edit
                                            </div>
                                            <div class='form-check'>
                                                <input type='checkbox' class='filled-in chk-col-light-blue' id='editmaster'>
                                                <label class='form-check-label' for='editmaster'></label>
                                            </div>
                                            
                                        </div>
                                    </th>
                                    <th class="text-center">
                                               <div class="">
                                            <div>
                                                Delete
                                            </div>
                                            <div class='form-check'>
                                                <input type='checkbox' class='filled-in chk-col-light-blue' id='deletemaster'>
                                                <label class='form-check-label' for='deletemaster'></label>
                                            </div>
                                            
                                        </div>
                                     </th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                            	 
                                <?php foreach ($rolecategory as  $key => $value) {?>
                                    <?php //echo '<pre>'; print_r($rolecategory); echo '</pre>'; die();?>
                                <tr>
                                    <th><?php echo $value->cat_name;?></th>
                                    <?php
                                      if (!empty($value->permission_category)) {
                                                    ?>
                                                
                                
						          <td>

                                                        <input type="hidden" name="per_cat[]" value="<?php echo $value->permission_category[0]->id; ?>" />
                                                        <input type="hidden" name="<?php echo "roles_permissions_id_" . $value->permission_category[0]->id; ?>" value="<?php echo $value->permission_category[0]->roles_permissions_id; ?>" />
                                                        <?php echo $value->permission_category[0]->sub_name ?>
                                      </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($value->permission_category[0]->enable_view == 1) {
                                                            ?>
                                                       
                                                            <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue sub_chk ' id='exampleCheck<?php echo $value->permission_category[0]->id;?>' name="<?php echo "can_view-perm_" . $value->permission_category[0]->id; ?>" value="<?php echo $value->permission_category[0]->id; ?>" <?php echo set_checkbox("can_view-perm_" . $value->permission_category[0]->id, $value->permission_category[0]->id, ($value->permission_category[0]->can_view == 1) ? TRUE : FALSE); if($value->permission_category[0]->can_view == 1) { echo 'checked'; } else { echo ''; }  ?> >
												                <label class='form-check-label' for='exampleCheck<?php echo $value->permission_category[0]->id;?>'></label>

												              </div>

                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($value->permission_category[0]->enable_add == 1) {
                                                            ?>
                                                        
                                                              <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue addsub_chk  '  name="<?php echo "can_add-perm_" . $value->permission_category[0]->id; ?>" id='can_add-perm_<?php echo $value->permission_category[0]->id;?>' value="<?php echo $value->permission_category[0]->id; ?>" <?php echo set_checkbox("can_view-perm_" . $value->permission_category[0]->id, $value->permission_category[0]->id, ($value->permission_category[0]->can_add == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_add-perm_<?php echo $value->permission_category[0]->id;?>'></label>
												              </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($value->permission_category[0]->enable_edit == 1) {
                                                            ?>
                                                       
                                                                <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue editsub_chk  '  name="<?php echo "can_edit-perm_" . $value->permission_category[0]->id; ?>" id='can_edit-perm_<?php echo $value->permission_category[0]->id;?>' value="<?php echo $value->permission_category[0]->id; ?>" <?php echo set_checkbox("can_view-perm_" . $value->permission_category[0]->id, $value->permission_category[0]->id, ($value->permission_category[0]->can_edit == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_edit-perm_<?php echo $value->permission_category[0]->id;?>'></label>
												              </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($value->permission_category[0]->enable_delete == 1) {
                                                            ?>
                                                
                                                            <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue deletesub_chk '  name="<?php echo "can_delete-perm_" . $value->permission_category[0]->id; ?>" id='can_delete-perm_<?php echo $value->permission_category[0]->id;?>' value="<?php echo $value->permission_category[0]->id; ?>" <?php echo set_checkbox("can_view-perm_" . $value->permission_category[0]->id, $value->permission_category[0]->id, ($value->permission_category[0]->can_delete == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_delete-perm_<?php echo $value->permission_category[0]->id;?>'></label>
												              </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                    <?php
                                         } else {  ?>
                                            
                                            <td colspan="5"></td>
                                         <?php  }
                                                    ?>
                                </tr>
                                 
                                   <?php
           
                                           if (!empty($value->permission_category) && count($value->permission_category) > 1) {
                                                unset($value->permission_category[0]);
                                                foreach ($value->permission_category as $new_feature_key => $new_feature_value) {
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td >
                                                            <input type="hidden" name="per_cat[]" value="<?php echo $new_feature_value->id; ?>" />
                                                            <input type="hidden" name="<?php echo "roles_permissions_id_" . $new_feature_value->id; ?>" value="<?php echo $new_feature_value->roles_permissions_id; ?>" />


                                                            <?php echo $new_feature_value->sub_name ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            if ($new_feature_value->enable_view == 1) {
                                                                ?>
                                                         
                                                                   <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue sub_chk '  name="<?php echo "can_view-perm_" . $new_feature_value->id; ?>" id='can_view-perm_<?php echo $new_feature_value->id;?>' value="<?php echo $new_feature_value->id; ?>" <?php echo set_checkbox("can_view-perm_" . $new_feature_value->id, $new_feature_value->id, ( $new_feature_value->can_view == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_view-perm_<?php echo $new_feature_value->id;?>'></label>
												              </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            if ($new_feature_value->enable_add == 1) {
                                                                ?>
                                                            
                                                                      <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue addsub_chk  '  name="<?php echo "can_add-perm_" . $new_feature_value->id; ?>" id='can_add-perm_<?php echo $new_feature_value->id;?>' value="<?php echo $new_feature_value->id; ?>"  <?php echo set_checkbox("can_view-perm_" . $new_feature_value->id, $new_feature_value->id, ( $new_feature_value->can_add == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_add-perm_<?php echo $new_feature_value->id;?>'></label>
												              </div> 
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            if ($new_feature_value->enable_edit == 1) {
                                                                ?>
                                                       
                                                                      <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue editsub_chk '  name="<?php echo "can_edit-perm_" . $new_feature_value->id; ?>" id='can_edit-perm_<?php echo $new_feature_value->id;?>' value="<?php echo $new_feature_value->id; ?>" <?php echo set_checkbox("can_view-perm_" . $new_feature_value->id, $new_feature_value->id, ( $new_feature_value->can_edit == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_edit-perm_<?php echo $new_feature_value->id;?>'></label>
												              </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            if ($new_feature_value->enable_delete == 1) {
                                                                ?>
                                                        
                                                                      <div class='form-check'>
												                <input type='checkbox' class='filled-in chk-col-light-blue deletesub_chk  '  name="<?php echo "can_delete-perm_" . $new_feature_value->id; ?>" id='can_delete-perm_<?php echo $new_feature_value->id;?>' value="<?php echo $new_feature_value->id; ?>" <?php echo set_checkbox("can_view-perm_" . $new_feature_value->id, $new_feature_value->id, ( $new_feature_value->can_delete == 1) ? TRUE : FALSE); ?>>
												                <label class='form-check-label' for='can_delete-perm_<?php echo $new_feature_value->id;?>'></label>
												              </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                               
                            </tbody>

                        </table>
                    </div>
                        <div class="float-right mt-4">
                        <button style="margin-bottom: 10px;text-align: right;" class="btn btn-primary delete_all" type="submit">Save</button>

                        <a href="<?php echo base_url();?>organization/Role" class="btn btn-primary" style="margin-bottom: 10px;text-align: right;" >Back</a>

                         </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('backend/footer'); ?>
    <script>
     $(document).ready(function() {
        $('#example2').dataTable({
            "bPaginate": false,
            "scrollY": "80vh",
            "pageLength": 50,
            "responsive":true,
            "bFilter": true,
            "bInfo": false,
            "searching": false,
            "bAutoWidth": false,
             "ordering": false,
             "scrollX": true,
         "scroller": true,
      });
       
        });
       //check box
       $(document).ready(function () {  
       //view
        $('#master').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".sub_chk").prop('checked', true);    
         } else {    
            $(".sub_chk").prop('checked',false);    
         }    
        });
        //over all check box
         if($('.sub_chk:checked').length == $('.sub_chk').length)    
         {  
            $("#master").prop('checked', true);    
         } else {    
            $("#master").prop('checked',false);    
         }

        //add  
         $('#addmaster').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".addsub_chk").prop('checked', true);    
         } else {    
            $(".addsub_chk").prop('checked',false);    
         }    
        });
         //over all check box
         if($('.addsub_chk:checked').length == $('.addsub_chk').length)    
         {  
            $("#addmaster").prop('checked', true);    
         } else {    
            $("#addmaster").prop('checked',false);    
         }  
        //edit  
         $('#editmaster').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".editsub_chk").prop('checked', true);    
         } else {    
            $(".editsub_chk").prop('checked',false);    
         }    
        });
         //over all check box
         if($('.editsub_chk:checked').length == $('.editsub_chk').length)    
         {  
            $("#editmaster").prop('checked', true);    
         } else {    
            $("#editmaster").prop('checked',false);    
         }   
         //delete  
         $('#deletemaster').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".deletesub_chk").prop('checked', true);    
         } else {    
            $(".deletesub_chk").prop('checked',false);    
         }    
        }); 
          //over all check box
         if($('.deletesub_chk:checked').length == $('.deletesub_chk').length)    
         {  
            $("#deletemaster").prop('checked', true);    
         } else {    
            $("#deletemaster").prop('checked',false);    
         }  
        });
    </script>