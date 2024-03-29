<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-user-secret" aria-hidden="true"></i> Business Unit</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Business Unit</li> -->
                        <?php if($this->role->User_Permission('business_unit','can_add') ){?>
                        <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>settings/Add_BusinessUnit" class="text-white"><i class="" aria-hidden="true"></i> Add Business</a></button>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;<i class="fa fa-user-o" aria-hidden="true"></i>  Business Unit List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th> S.NO</th>
                                                <th> Name</th>
                                                <th>Code</th>
                                                <th>Started On </th>
                                                <th>Country </th>
                                                <th>Leave Structure </th>
                                                <th>Holiday Structure </th>

                                                <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                                <th>Status</th>
                                                    <?php }; ?>
                                                 <th>HR  </th>
                                                 <th>Policy  </th>
                                         
                                               <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                                <th>Action</th>
                                                 <?php }; ?>
                                            </tr>
                                        </thead>
                              
                                       <tbody id="businessunit_tbl">
                                           <?php          $i = 1;
                                      foreach($businessunit as $value): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->name  ?></td>
                                        <td><?php echo $value->code; ?></td>
                                        <td><?php  if($value->startedon){echo date('d M Y',strtotime($value->startedon));}?></td>
                                      <td><?php if($value->country) { 
                                       $id = $value->country;
                                        $data = $this->settings_model->matchcountry($id); echo $data->country_name; }?></td>
                                        <td><?php if($value->leavestructureid != '') { 
                                            $sql = "SELECT * FROM `leavestructure` WHERE `isActive` = 1 AND `Active_status` = 1 AND `id` = $value->leavestructureid";
                                             $query = $this->db->query($sql);
                                             $result = $query->row();
                                            if($result) { echo $result->leavestructure; } } ?></td>
                                        <td><?php if($value->holidaystructureid != '') { 

                                            $sql1 = "SELECT * FROM `holidaystructure` WHERE `isActive` = 1 AND `Active_status` = 1 AND `id` = $value->holidaystructureid";
                                                $query1 = $this->db->query($sql1);
                                                $result1= $query1->row();
                                           if($result1) { echo $result1->holidaystructure;} } ?></td>
                                          <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                             <td>
                                                  <?php if($value->Active_status == "1"){ ?>
                                                <input type="checkbox" class="js-switch on" id="" data-color="#28a745" data-secondary-color="#f62d51" checked data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff'  />
                                                  <?php }elseif ($value->Active_status == "0"){ ?>
                                                      <input type="checkbox" class="js-switch off" id="" data-color="#28a745" data-secondary-color="#f62d51"  data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff' />
                                                <?php }; ?>

                                            <!--   <?php 
                                               if($value->Active_status == "0"){ ?>
                                               <button type="button" class="btn btn-primary" id="inactive" value="1" name="inactive" >INACTIVE</button><?php
                                               }elseif ($value->Active_status == "1"){ ?>
                                               <button type="button" class="btn btn-info" id="active" value="0" name="active">ACTIVE</button><?php
                                               }?> -->
                                               
                                        </td>
                                         <?php }; ?>
                                        <td><?php 
                                         $hrid = $value->hr;
                                        if($hrid){
                                            
                                          $get_hr =  $this->leave_model->Get_hr_address($hrid);

                                            echo $get_hr->first_name.' '.$get_hr->last_name;
                                        } 
                                          
                                         ?></td>
                                         <td>
                                              <a  title="Add Policies" class="btn btn-sm btn-info waves-effect waves-light text-white add_policy" data-busunit="<?php echo $value->id; ?> " data-toggle='modal' data-target='#AdditionModal'><i class="fa fa-plus"></i></a> 
                                         </td>
                                       <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                        <td class="jsgrid-align-center ">
                                               <?php if($value->Active_status == "1"){?>
                                             <input type="hidden" name="id"  id="id" value="<?php echo $value->id; ?>"/>
                                            <a href="<?php echo base_url(); ?>settings/edit_businessunit?I=<?php echo base64_encode($value->id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a> 
                                            <?php if(!$value->hr){ ?>
                                            <a href="<?php echo base_url(); ?>settings/Bussiness_HR?I=<?php echo base64_encode($value->id); ?>" title="Add HR" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-plus"></i></a>  <?php }else{ ?>
                                                <a href="<?php echo base_url(); ?>settings/Bussiness_HR?I=<?php echo base64_encode($value->id); ?>" title="View HR" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                      
                                        <?php }; ?>
                                              <?php if($this->role->User_Permission('business_unit','can_delete') ){?>
                                                    <button   title="Delete" data-id="<?php echo $value->id; ?> "class="btn btn-sm btn-info waves-effect waves-light delete"><i class="fa fa-trash-o"></i></button>
                                                    <?php } ?>
                                             <?php } ?>
                                          </td>
                                        <?php }; ?>
                 
                                    </tr>
                                  <?php  $i++;
                                     endforeach; ?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Policies modal -->

      <!-- Modal -->
      <div class="modal fade" id="AdditionModal" tabindex="" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>Add Company Policy</h5>
              <div class="text-right">
                <i data-dismiss="modal" aria-label="Close" class="fa fa-close"></i>
              </div>
              
            </div>

                <form name="policy_form" id="policy_form" method="post"> 
            <div class="modal-body">
         
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            
                            <label for="message-text" class="control-label ">Title</label><span class="error"> *</span>
                            <input type="text" name="policy_title" class="form-control " id="policy_title"  placeholder="Enter Title" required="">
                            
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Description</label><span class="error"> *</span>
                            <textarea class="form-control" name="policy_description" id="policy_description" placeholder="Enter Description"  required minlength="" maxlength="150"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label">Document</label><span class="error"> *</span>
                            
                            <input type="file" name="file" class="form-control" id="file" required>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group ">
                            
                        </div>
                    </div>
                </div>
              
             <div class="table-responsive">
                
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Sno</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Attachment</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="allowancetbl">
       
              </tbody>
            </table>
 
              </div>
             
            </div>
            <div class="modal-footer">
           
              <input type="hidden" name="busunit_id">
              <input type="hidden" name="id">
           
              <button type="button" class="btn btn-primary" id="add_policybtn">Save</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
             </form> 
          </div>
        </div>
      </div>

                <!-- Policies modal -->
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
     var status = $('#inactive').val()
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/businessinactivestatus");?>',
    data: {
        id:id,status:status},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){   
    $.wnoty({
    type: 'success',
    message: 'Status  Changed Successfully',
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
    var status = $('#active').val()
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/businessactivestatus");?>',
    data: {
        
        id:id,status:status},
    success:function(resp){
    var data=$.parseJSON(resp);
  
    if(data.status == 'success'){   
    $.wnoty({
    type: 'success',
    message: 'Status  Changed Successfully',
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
    //delete
    $(document).on('click','.delete', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this businessunit?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Settings/BusinessUnitDelete') ?>',
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
                     var status = 1;
                    $.ajax({
                    type:'post',
                    url: '<?php echo base_url("Settings/businessactivestatus");?>',
                    data: {
                        
                        id:id,status:status},
                    success:function(resp){
                    var data=$.parseJSON(resp);
                  
                    if(data.status == 'success'){   
                    $.wnoty({
                    type: 'success',
                    message: 'Status  Changed Successfully',
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
                        url: '<?php echo base_url("Settings/businessinactivestatus");?>',
                        data: {
                            id:id,status:status},
                        success:function(resp){
                        var data=$.parseJSON(resp);
                        if(data.status == 'success'){   
                        $.wnoty({
                        type: 'success',
                        message: 'Status  Changed Successfully',
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

    //----------Policy-----------
      $(document).ready(function () {

        $(document).on('click', ".add_policy", function (e) {
          e.preventDefault(e);
          var busunit = $(this).attr('data-busunit');
       
         $('#policy_form').find('[name="busunit_id"]').val(busunit).end();
     

           });
         });

    //Policy
    $('.close , .btn-default').on('click',function(){
    $('#policy_form')[0].reset();
     //$('#sid').val('');
    });
    $(document).on('click','#add_policybtn',function(){
    event.preventDefault();
    $("#policy_form").valid();
    var title=$('#policy_title').val();
    var file_url=$('#file').val();
    var nodate=$('#policy_description').val();
   
     if( title !='' && file_url !='' && nodate !='' ){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Add_policy");?>',
    data: new FormData($("#policy_form")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);;
    if(data.status == 'success'){
    $('#AdditionModal').modal('hide');
    $(".modal-backdrop").remove();
    
    $('#policy_form')[0].reset();
    //$('#sid').val('');
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
     
   setTimeout(function(){
     location.reload(true);
    },2000);
    //  
    } else if (data.status == 'error') {
    $('#AdditionModal').modal('hide');
    $(".modal-backdrop").remove();

    $.wnoty({
        type: 'error',
        message: data.message,
        autohideDelay: 1000,
        position: 'top-right'

    });
      setTimeout(function() {
        location.reload(true);
    }, 2000);
    }
    },
    });
    }
    return false;
    })

    // Get policies

       function loadpolicies(){
        $(document).ready(function () {
        $(document).on("click", '.add_policy',function (event) {
        event.preventDefault();
        var busunit = $(this).attr("data-busunit");  
       
        if(busunit != ''){
        $.ajax({
          url: "Get_policies?busunit="+busunit,
          type:"GET",
          dataType:'',
          data:'data',          
          success: function(response) {
            // console.log(response);
            $('.allowancetbl').html(response);

               
          },
          error: function(response) {
            
          }
        });
      }
      });
      });

      }
      loadpolicies();
      //delete policies
      $(document).ready(function () {
        $(document).on("click", '.delete_policy',function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");  
         var row = $(this).closest("tr");
        if(id != ''  ){
        $.ajax({
          url: '<?php echo base_url("Settings/deletepolicy")?>',
          type:"POST",
          data: {id:id},          
          success: function(response) {
          
       
      
             $.wnoty({
              type: 'success',
              message: "Deleted Successfully",
              autohideDelay: 1000,
              position: 'top-right'

              });

               setTimeout(function() {
                    row.remove();
                 }, 2000);

                
          },
          error: function(response) {
            
          }
        });
      }
      });
      });



  $(document).ready(function() {
       
             $(document).on("click", '.edit_policy_btn',function (event) {
                 event.preventDefault();

            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
              console.log(iid);
          //  $('#policy_form').trigger("reset");
           // $('#loanmodel').modal('show');
            $.ajax({
                url: 'PolicyByID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                //$('#policy_form').find('[name="emid"]').val(response.policy_data.emp_id).end();
                $('#policy_form').find('[name="id"]').val(response.policy_data.id).end();
                $('#policy_form').find('[name="policy_title"]').val(response.policy_data.policy_title)
                    .end();
                $('#policy_form').find('[name="policy_description"]').val(response.policy_data.policy_description)
                    .end();
              
            });
        });
    });
</script>