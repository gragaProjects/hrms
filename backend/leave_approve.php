<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Leave Application</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
         <!--        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave Application</li> -->
                    <?php if($this->role->User_Permission('leave_application','can_add')){?>
                    <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Apply Leave  </a></button>
               
                    <?php } ?>    
                     <?php if($this->role->User_Permission('leave_application','can_view')){?>
                       <button type="button" class="btn btn-info" style="width: 100px;"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Leavelist" class="text-white"><i class="" aria-hidden="true"></i> Leave List</a></button>
               
                    <?php } ?>
            </ol>
        </div>
    </div>
 <style type="text/css">
    .table{
        margin-bottom:0px!important;
    }

</style>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
      
                <div class="col-12">
                 <!--     <?php if($this->role->User_Permission('leave_application','can_add')){?>
                    <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Apply Leave  </a></button>
               
                    <?php } ?>    
                     <?php if($this->role->User_Permission('leave_application','can_view')){?>
                       <button type="button" class="btn btn-info" style="width: 100px;"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>leave/Leavelist" class="text-white"><i class="" aria-hidden="true"></i> Leave List</a></button>
               
                    <?php } ?> -->
                   
                </div>                       
          
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Leave Application                         
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Employee </th>
                                        <th>Emp Code</th>
                                        <th>Leave Structure</th>
                                        <th>Leave Type</th>
                                        <th>Paid Status</th>
                                        <th>Applied Date</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>No. of Days</th>
                                        <!-- <th>Leave Status</th> -->
                                        <th>Team Head Status</th>
                                        <th>Hr Status</th>
                                        <?php if($this->role->User_Permission('leave_application','can_add') || $this->role->User_Permission('leave_application','can_edit') || $this->role->User_Permission('leave_application','can_delete')){?>
                                        <th>Action</th>
                                         <?php } ?>
                                    </tr>
                                </thead>

                                <!-- All Details Admin permission -->
                                  
                                <tbody>
                                    <?php if($this->role->User_Permission('leave_application','can_view') &&$this->role->User_Permission('leave_application','can_add') &&  $this->role->User_Permission('leave_application','can_edit') &&  $this->role->User_Permission('leave_application','can_delete')){
                                         $eid = $this->session->userdata('user_login_id');
                                        if(!$this->leave_model->Check_Teamhead($eid)){
                                        ?>
                                    <?php 
                                  
                                    foreach($application as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->paidstatus; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('d M Y',strtotime($value->apply_date)); ?></td>
                                        <td> <?php if($value->start_date) echo date('d M Y',strtotime($value->start_date)); ?></td>
                                        <td> <?php if($value->end_date) echo date('d M Y',strtotime($value->end_date)); ?> </td>
                                 
                                        <td><?php /*echo $value->leave_days; */if($value->leave_type == 'Half Day'){echo "Half Day"; }else {if($value->leave_days == 1){echo $value->leave_days." day";}else  {echo $value->leave_days." days";}}; ?></td>
                                        <!-- <td><?php echo $value->leave_status; ?></td> -->
                                        <td class="text-center"><?php echo $value->thead_approve; ?></td>
                                        <td class="text-center"><?php echo $value->hr_approve; ?></td>
                                         <?php if($this->role->User_Permission('leave_application','can_add') || $this->role->User_Permission('leave_application','can_edit') || $this->role->User_Permission('leave_application','can_delete')){?>

                                        <td class="jsgrid-align-center">
                                            
                                           <!-- <?php //if($value->leave_status =='Approved'){ ?>
                                           
                                             <?php// } elseif($value->leave_status =='Pending'){ ?> -->
                                                <?php if($value->thead_approve =='Approved' && $value->hr_approve == 'Pending'){ ?>
                                           
                                             <?php } elseif($value->thead_approve =='Pending' && $value->hr_approve == 'Pending'){ ?>
                                              <?php if($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_edit') && $this->role->User_Permission('leave_application','can_delete')){?>
                                            <a href="" title="Approve" class="btn btn-sm btn-info waves-effect waves-light Status" data-employeeId="<?php echo $value->em_id; ?>"  data-id="<?php echo $value->id; ?>" data-value="Approved" data-duration="<?php echo $value->leave_duration; ?>" data-type="<?php echo $value->typeid; ?>"  data-start="<?php echo $value->start_date; ?>"data-end="<?php echo $value->end_date; ?>" >Approve</a>       
                                            <a href="" title="Reject" class="btn btn-sm btn-info waves-effect waves-light  Status" data-id = "<?php echo $value->id; ?>" data-value="Rejected"  data-start="<?php echo $value->start_date; ?>"data-end="<?php echo $value->end_date; ?>" >Reject</a><?php } ?>
                                            

                                            <?php } elseif($value->leave_status =='Rejected'){ ?>
                                            <?php } ?>
                                            <?php if($this->role->User_Permission('leave_application','can_edit')){?>
                                            <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light leaveapp" data-id="<?php echo $value->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                            <?php if($value->file_url){?>
                                            <a href="<?php echo base_url(); ?>assets/uploads/LeaveDocument/<?php echo $value->file_url; ?>" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="<?php echo $value->file_url; ?>"><i class="fa fa-file-o"></i></a>
                                            <?php }} ?>
                                        </td>
                                        <?php }  ?>
                                    </tr>
                                    <?php endforeach; ?>

                               <!--  </tbody> -->
                                <!-- Single user data -->
                                 <?php } }elseif ($this->role->User_Permission('leave_application','can_view')) {
                                            $id = $this->session->userdata('user_login_id');
                                         $leaveinfo = $this->leave_model->EmpLeaveAPPlication($id);
                                        
                                         if(!empty( $leaveinfo)){
                                         
                                        ?>
                                        <!-- <tbody> -->
                                    <?php 
                                    foreach($leaveinfo as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->paidstatus; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('d M Y',strtotime($value->apply_date)); ?></td>
                                        <td> <?php if($value->start_date) echo date('d M Y',strtotime($value->start_date)); ?></td>
                                        <td> <?php if($value->end_date) echo date('d M Y',strtotime($value->end_date)); ?> </td>
                                
                                        <td><?php /*echo $value->leave_days; */if($value->leave_type == 'Half Day'){echo "Half Day"; }else {if($value->leave_days == 1){echo $value->leave_days." day";}else  {echo $value->leave_days." days";}}; ?></td>
                                        <!-- <td><?php echo $value->leave_status; ?></td> -->
                                            <td class="text-center"><?php echo $value->thead_approve; ?></td>
                                        <td class="text-center"><?php echo $value->hr_approve; ?></td>
                                         <td>
                                         <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light empleaveapp" data-id="<?php echo $value->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                             <?php if($value->file_url){?>
                                            <a href="<?php echo base_url(); ?>assets/uploads/LeaveDocument/<?php echo $value->file_url; ?>" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="<?php echo $value->file_url; ?>"><i class="fa fa-file-o"></i></a>
                                            <?php } ?>
                                         </td>
                                    </tr>
                                    <?php endforeach; ?>
                                        <!-- </tbody> -->

                                    <?php } } ?>

                                   <!--  /*Team head leave data*/ -->
                                  <?php if ($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view')) {

                                    $eid = $this->session->userdata('user_login_id');
                                     if($this->leave_model->Check_Teamhead($eid)){
                                    $gettheaddata = $this->leave_model->Leaveapply_Reporting($eid);
                                    if ($gettheaddata) {


                                    foreach($gettheaddata as $value1): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value1->first_name.' '.$value1->last_name ?></span></td>
                                        <td><?php echo $value1->em_code; ?></td>
                                        <td><?php echo $value1->leavestructure; ?></td>
                                        <td><?php echo $value1->name; ?></td>
                                        <td><?php echo $value1->paidstatus; ?></td>
                                   
                                        <td><?php if($value1->apply_date) echo date('d M Y',strtotime($value1->apply_date)); ?></td>
                                        <td> <?php if($value1->start_date) echo date('d M Y',strtotime($value1->start_date)); ?></td>
                                        <td> <?php if($value1->end_date) echo date('d M Y',strtotime($value1->end_date)); ?> </td>
                                
                                        <td><?php if($value1->leave_type == 'Half Day'){echo "Half Day"; }else {if($value1->leave_days == 1){echo $value1->leave_days." day";}else  {echo $value1->leave_days." days";}}; ?></td>
                                        <!-- <td><?php echo $value1->leave_status; ?></td> -->
                                        <td class="text-center"><?php echo $value1->thead_approve; ?></td>
                                        <td class="text-center"><?php echo $value1->hr_approve; ?></td>

                                         <?php if($this->role->User_Permission('leave_application','can_add') || $this->role->User_Permission('leave_application','can_edit') || $this->role->User_Permission('leave_application','can_delete')){?>

                                        <td class="jsgrid-align-center">
                                            
                                           <?php if($value1->thead_approve =='Approved' && $value1->hr_approve == 'Pending'){ ?>
                                           
                                             <?php } elseif($value1->thead_approve =='Pending' && $value1->hr_approve == 'Pending'){ ?>
                                              <?php if($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view') ){?>
                                            <a href="" title="Approve" class="btn btn-sm btn-info waves-effect waves-light theadStatus" data-employeeId="<?php echo $value1->em_id; ?>"  data-id="<?php echo $value1->leaveid; ?>" data-value1="Approved" data-duration="<?php echo $value1->leave_duration; ?>" data-type="<?php echo $value1->typeid; ?>" data-start="<?php echo $value1->start_date; ?>"data-end="<?php echo $value1->end_date; ?>">Approve</a>       
                                            <a href="" title="Reject" class="btn btn-sm btn-info waves-effect waves-light  theadStatus" data-id = "<?php echo $value1->leaveid; ?>" data-value1="Rejected" data-employeeId="<?php echo $value1->em_id; ?>"  data-start="<?php echo $value1->start_date; ?>"data-end="<?php echo $value1->end_date; ?>" >Reject</a><?php } ?>
                                            

                                            <?php } elseif($value1->leave_status =='Rejected'){ ?>
                                            <?php } ?>
                                            <?php if($this->role->User_Permission('leave_application','can_edit')){?>
                                            <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light leaveapp" data-id="<?php echo $value1->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if($value1->file_url){?>
                                            <a href="<?php echo base_url(); ?>assets/uploads/LeaveDocument/<?php echo $value1->file_url; ?>" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="<?php echo $value1->file_url; ?>"><i class="fa fa-file-o"></i></a>
                                            <?php } ?>
                                        </td>
                                       
                                        <?php } ?>
                                    </tr>
                                    <?php endforeach; ?>
                                     <?php } } } ?>

                                        <!-- Hr manager -->
                                  <?php if ($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view')) {

                                    $eid = $this->session->userdata('user_login_id');

                                    $get_hr_approve = $this->leave_model->Leaveapply_hr($eid);
                                    if ($get_hr_approve) {


                                    foreach($get_hr_approve as $value2): ?>
                                    <tr style="vertical-align:top">
                                        <td><span><?php echo $value2->first_name.' '.$value2->last_name ?></span></td>
                                        <td><?php echo $value2->em_code; ?></td>
                                        <td><?php echo $value2->leavestructure; ?></td>
                                        <td><?php echo $value2->name; ?></td>
                                        <td><?php echo $value2->paidstatus; ?></td>
                                   
                                        <td><?php if($value2->apply_date) echo date('d M Y',strtotime($value2->apply_date)); ?></td>
                                        <td> <?php if($value2->start_date) echo date('d M Y',strtotime($value2->start_date)); ?></td>
                                        <td> <?php if($value2->end_date) echo date('d M Y',strtotime($value2->end_date)); ?> </td>
                                
                                        <td><?php if($value2->leave_type == 'Half Day'){echo "Half Day"; }else {if($value2->leave_days == 1){echo $value2->leave_days." day";}else  {echo $value2->leave_days." days";}}; ?></td>
                                        <!-- <td><?php echo $value2->leave_status; ?></td> -->
                                        <td class="text-center"><?php echo $value2->thead_approve; ?></td>
                                        <td class="text-center"><?php echo $value2->hr_approve; ?></td>

                                         <?php if($this->role->User_Permission('leave_application','can_add') || $this->role->User_Permission('leave_application','can_edit') || $this->role->User_Permission('leave_application','can_delete')){?>

                                        <td class="jsgrid-align-center">
                                            
                                          <?php if($value2->thead_approve =='Approved' && $value2->hr_approve == 'Pending'){ ?>
                                              <?php if($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view') ){?>
                                            <a href="" title="Approve" class="btn btn-sm btn-info waves-effect waves-light hrStatus" data-employeeId="<?php echo $value2->em_id; ?>"  data-id="<?php echo $value2->leaveid; ?>" data-value1="Approved" data-duration="<?php echo $value2->leave_duration; ?>" data-type="<?php echo $value2->typeid; ?>"  data-start="<?php echo $value2->start_date; ?>"data-end="<?php echo $value2->end_date; ?>">Approve</a>       
                                            <a href="" title="Reject" class="btn btn-sm btn-info waves-effect waves-light  hrStatus" data-id = "<?php echo $value2->leaveid; ?>" data-value1="Rejected" data-employeeId="<?php echo $value2->em_id; ?>"  data-start="<?php echo $value2->start_date; ?>"data-end="<?php echo $value2->end_date; ?>" >Reject</a><?php } ?>
                                            

                                            <?php } elseif($value2->leave_status =='Rejected'){ ?>
                                            <?php } ?>
                                            <?php if($this->role->User_Permission('leave_application','can_edit')){?>
                                            <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light leaveapp" data-id="<?php echo $value2->id; ?>" ><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } if($value2->file_url){?>
                                            <a href="<?php echo base_url(); ?>assets/uploads/LeaveDocument/<?php echo $value2->file_url; ?>" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="<?php echo $value2->file_url; ?>"><i class="fa fa-file-o"></i></a>
                                            <?php } ?>
                                         
                                        </td>
                                       
                                        <?php } ?>
                                    </tr>
                                    <?php endforeach; ?>
                                     <?php } } ?>
                                       
                                    </tbody>


                                  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           <?php if($this->role->User_Permission('leave_application','can_view') &&$this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_edit') && $this->role->User_Permission('leave_application','can_delete')){?>
        <div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Leave Application</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- action="Add_Applications" -->
                            <form method="post"  id="leaveapply" enctype="multipart/form-data">
                            <div class="modal-body">
                                    
                                <div class="form-group">
                                    <label>Employee</label><label class="error"> *</label>
                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emid" id="emid" required>
                                        <option value="">Select Employee</option>
                                        <?php foreach($employee as $value): ?>
                                        <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>Leave Structure</label><label class="error"> *</label>
                                <select class="form-control custom-select assignleave leavestrucid"  tabindex="1" name="leavestrucid" id="leavestrucid" required>
                                  <!--   <option value="">Select Here..</option>
                                    <?php foreach($leavestruc as $value): ?>

                                    <option value="<?php echo $value->id ?>"><?php echo $value->leavestructure ?></option>

                                    <?php endforeach; ?> -->
                                </select>
                            </div>
                                <div class="form-group">
                                    <label>Leave Type</label><label class="error"> *</label>
                                    <select class="form-control custom-select assignleave"  tabindex="1" name="typeid" id="leavetype" required>
                                       <!--  <option value="">Select Here..</option> -->
                                        <!-- <?php foreach($leavetypes as $value): ?>

                                        <option value="<?php echo $value->type_id ?>"><?php echo $value->name ?></option>

                                        <?php endforeach; ?> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span style="color:red" id="total"></span>
                                    <div class="span pull-right">
                                        <button class="btn btn-info fetchLeaveTotal">Fetch Total Leave</button>
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Leave Duration</label><br>
                               
                                    <input name="type" type="radio" id="radio_1" data-value="Half" class="duration" value="Half Day" checked="">
                                    <label for="radio_1">Half Day</label>
                                    <input name="type" type="radio" id="radio_2" data-value="Full" class="type" value="Full Day">
                                    <label for="radio_2">Full Day</label>
                                    <input name="type" type="radio" class="with-gap duration" id="radio_3" data-value="More" value="More than One day">
                                    <label for="radio_3">Above a Day</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" id="hourlyFix">Date</label><label class="error"> *</label>
                                    <input type="text" name="startdate" class="form-control mydatetimepickerdate" id="startdate" required>
                                </div>
                                <div class="form-group" id="enddate" style="display:none">
                                    <label class="control-label">End Date</label>
                                    <input type="text" name="enddate" class="form-control mydatetimepickerdate" id="recipient-name1">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Reason</label><label class="error"> *</label>
                                    <textarea class="form-control" name="reason" id="reason" rows="4" required></textarea>                                                
                                </div>
                                  <div id="leavedocument">
                                    
                                </div>
                                                                               
                            </div>
                         
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="form-control"  required> 
                                <input type="hidden" name="leavetypeid" id="leavetypeid" class="form-control"  > 
                                  <input type="hidden" name="employee_code" class="form-control"  required> 
                                 <button type="submit" class="btn btn-primary" id="leaveapprove">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               
                            </div>
                            </form>
                        </div>
                    </div>
        </div>
       <?php }?>    
       <!-- Employee -->     
       <?php if($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view') ){
          $id = $this->session->userdata('user_login_id');
          $basicinfo = $this->employee_model->GetBasic($id);
        ?>

        <div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Apply Leave</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- action="Add_Applications" -->
                            <form method="post"  id="leaveapply" enctype="multipart/form-data">
                            <div class="modal-body">
                        
                                 <div class="form-group">
                                <label>Employee</label><label class="error"> *</label>
                            
                                 <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emid" id="emid" required>
                                       <option value="<?php echo $basicinfo->em_id ?>" selected><?php echo $basicinfo->first_name.' '.$basicinfo->last_name?></option>
                                       
                                 </select>
                                </div>
                                <!-- leave structure in busunit -->
                                <?php $busid = $basicinfo->busunit; 

                                      $getbusinessunit = $this->leave_model->GetBusunit($busid); 
                                     // print_r($getbusinessunit->leavestructureid);die();
                                      $leave_struid = $getbusinessunit->leavestructureid;

                                      $getleavestructure = $this->leave_model->GetLeavestru($leave_struid);  
                                     // print_r($getleavestructure->leavestructure);die();
                                ?>
                                <div class="form-group">
                                <label>Leave Structure</label><label class="error"> *</label>
                                <select class="form-control custom-select assignleave"  tabindex="1" name="leavestrucid" id="leavestrucid" required>
                               

                                    <option value="<?php echo $getleavestructure->id ?>" selected><?php echo $getleavestructure->leavestructure ?></option>

                                  
                                </select>
                            </div>
                           
                                <div class="form-group">
                                    <label>Leave Type</label><label class="error"> *</label>
                                    <select class="form-control custom-select assignleave"  tabindex="1" name="typeid" id="leavetype" required>
                                   
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <span style="color:red" id="total"></span>
                                    <div class="span pull-right">
                                        <button class="btn btn-info fetchLeaveTotal">Fetch Total Leave</button>
                                    </div>
                                    <br>
                                </div>
                          
                                <div class="form-group">
                                    <label class="control-label">Leave Duration</label><br>
                               
                                    <input name="type" type="radio" id="radio_1" data-value="Half" class="duration" value="Half Day" checked="">
                                    <label for="radio_1">Half Day</label>
                                    <input name="type" type="radio" id="radio_2" data-value="Full" class="type" value="Full Day">
                                    <label for="radio_2">Full Day</label>
                                    <input name="type" type="radio" class="with-gap duration" id="radio_3" data-value="More" value="More than One day">
                                    <label for="radio_3">Above a Day</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" id="hourlyFix">Date</label><label class="error"> *</label>
                                    <input type="text" name="startdate" class="form-control mydatetimepickerdate" id="startdate" required>
                                </div>
                                <div class="form-group" id="enddate" style="display:none">
                                    <label class="control-label">End Date</label>
                                    <input type="text" name="enddate" class="form-control mydatetimepickerdate" id="enddate">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Reason</label><label class="error"> *</label>
                                    <textarea class="form-control" name="reason" id="reason" rows="4" required></textarea>                                                
                                </div>
                                <div id="leavedocument">
                                    
                                </div>
                                                                               
                            </div>
                         
                            <div class="modal-footer">
                                <input type="hidden" name="id" class="form-control"  required> 
                                <input type="hidden" name="employee_code" class="form-control"  required> 
                                <input type="hidden" name="employee_leave" value="employee_leave" class="form-control"  required> 
                              
                                 <button type="submit" class="btn btn-primary" id="leaveapprove">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               
                            </div>
                            </form>
                        </div>
                    </div>
        </div>

        <script>
         //select matched leave
            $(document).ready(function(){
         
               
              var leavestrucid = $('#leavestrucid option:selected').val();
               
               $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("Leave/get_match_leavetypes");?>",
                    data: { leavestrucid : leavestrucid },
                     success:function(data){
                        var info=$.parseJSON(data);
                        $('[name="typeid"]').html(info.content);
                     } 
                })
            });
       
        function get_leavetypes(argument,leavetype) {
             var leavestrucid = argument;
               
               $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("Leave/get_match_leavetypes");?>",
                    data: { leavestrucid : leavestrucid ,leavetype:leavetype},
                     success:function(data){
                        var info=$.parseJSON(data);
                        $('[name="typeid"]').html(info.content);
                     } 
                })
        }
        
        </script>
       <?php }?>

   <script>
$(document).ready(function () {
    $('#leaveapply input').on('change', function(e) {
        e.preventDefault(e);

        // Get the record's ID via attribute  
        var duration = $('input[name=type]:checked', '#leaveapply').attr('data-value');
       
        if(duration =='Half'){
            $('#enddate').hide();
            $('#hourlyFix').text('Date');
            $('#hourAmount').show();
        }
        else if(duration =='Full'){
            $('#enddate').hide();  
            $('#hourAmount').hide();  
            $('#hourlyFix').text('Date');  
        }
        else if(duration =='More'){
            $('#enddate').show();
            $('#hourAmount').hide();
        }
    });
  /*  $('#appmodel').on('hidden.bs.modal', function () {
        location.reload();
    });*/
});                                                          
 </script>
<script>
    $(document).ready(function () {

        $('.fetchLeaveTotal').on('click', function (e) {
            e.preventDefault();
            var selectedEmployeeID = $('.selectedEmployeeID').val();
            var leaveTypeID = $('#leavetype').val();
            //console.log(selectedEmployeeID, leaveTypeID);
            $.ajax({
                url: 'GetLeaveAssign?leaveID=' + leaveTypeID + '&employeeID=' +selectedEmployeeID,
                method: 'GET',
                data: '',
            }).done(function (response) {
                //console.log(response);
                $("#total").html(response);
            });
        });
    });
</script>
        <script>
        /*DATETIME PICKER*/
          $("#bbbSubmit").on("click", function(event){
              event.preventDefault();
              var typeid = $('.typeid').val();
              var datetime = $('.mydatetimepicker').val();
              var emid = $('.emid').val();
              //console.log(datetime);
              $.ajax({
                  url: "GetemployeeGmLeave?year="+datetime+"&typeid="+typeid+"&emid="+emid,
                  type:"GET",
                  dataType:'',
                  data:'data',          
                  success: function(response) {
                      // console.log(response);
                      $('.leaveval').html(response);             
                  },
                  error: function(response) {
                    // console.log(response);
                  }
              });
          });			
        </script>  


        <script type="text/javascript">
        /*PARSE DURATION DATA*/
        $('.duration').on('input',function() {
            var day = parseInt($('.duration').val());
            var hour = 8;
            $('.totalhour').val((day * hour ? day * hour : 0).toFixed(2));
        });
        </script>
<script>
  $(".Status").on("click", function(event){
      event.preventDefault();
     
      $.ajax({
          url: "approveLeaveStatus",
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value'),
              'duration': $(this).attr('data-duration'),
              'type': $(this).attr('data-type'),
              'start': $(this).attr('data-start'),
              'end': $(this).attr('data-end')
          },
          success: function(response) {
              var data=$.parseJSON(response);
            if(data.status == 'success'){
            $.wnoty({
            type: 'success',
            message: data.message,
            autohideDelay: 1000,
            position: 'top-right'
            });
            // console.log(response);
            //$(".message").fadeIn('fast').delay(30000).fadeOut('fast').html(response);
            window.setTimeout(function(){location.reload()}, 2000);
          }
          },
          error: function(response) {
            //console.error();
          }
      });
  });   

  /*Team head*/
   $(".theadStatus").on("click", function(event){
      event.preventDefault();
     
      $.ajax({
          url: "approveStatus",
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value1'),
              'duration': $(this).attr('data-duration'),
              'type': $(this).attr('data-type'),
              'start': $(this).attr('data-start'),
              'end': $(this).attr('data-end')
          },
          success: function(response) {
             var data=$.parseJSON(response);
            if(data.status == 'success'){

            $.wnoty({
            type: 'success',
            message: data.message,
            autohideDelay: 1000,
            position: 'top-right'
            });
            
            window.setTimeout(function(){location.reload()}, 1000);
          }
          },
          error: function(response) {
            //console.error();
          }
      });
  });  
   /*hr approval*/
   $(".hrStatus").on("click", function(event){
      event.preventDefault();
     
      $.ajax({
          url: "hrapproveStatus",
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value1'),
              'duration': $(this).attr('data-duration'),
              'type': $(this).attr('data-type'),
              'start': $(this).attr('data-start'),
              'end': $(this).attr('data-end')
          },
          success: function(response) {
               var data=$.parseJSON(response);
            if(data.status == 'success'){

            $.wnoty({
            type: 'success',
            message: data.message,
            autohideDelay: 1000,
            position: 'top-right'
            });
            
            window.setTimeout(function(){location.reload()}, 1000);
          }
          },
          error: function(response) {
            //console.error();
          }
      });
  });           
</script>

<script type="text/javascript">
       /*admin*/
            $(document).ready(function() {
                $(".leaveapp").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute
                    var iid = $(this).attr('data-id');
                    $('#leaveapply').trigger("reset");
                    $('#appmodel').modal('show');
                    $.ajax({
                        url: 'LeaveAppbyid?id=' + iid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                      
                        var leavetype = response.leaveapplyvalue.typeid;
                        var argument = response.leaveapplyvalue.leavestrucid;
                        getdocument(leavetype);
                        get_leavetypes(argument,leavetype)
                        // Populate the form fields with the data returned from server
                        $('#leaveapply').find('[name="id"]').val(response.leaveapplyvalue.id).end();
                        $('#leaveapply').find('[name="emid"]').val(response.leaveapplyvalue.em_id).end();
                       
                        $('#leaveapply').find('[name="applydate"]').val(response.leaveapplyvalue.apply_date).end();
                      
                       // $('#leaveapply').find('[name="leavestrucid"]').val(response.leaveapplyvalue.leavestrucid).end();

                        $('#leaveapply').find('[name="leavestrucid"]').html('<option value='+response.leaveapplyvalue.leavestrucid+' selected>'+response.leaveapplyvalue.leavestructure+'</option>').end();

                        $('#leaveapply').find('[id="leavetypeid"]').val(response.leaveapplyvalue.leavestrucid).end();
                        //$('#leaveapply').find('[name="typeid"]').html('<option value='+response.leaveapplyvalue.typeid+'>'+response.leaveapplyvalue.name+'</option>').end();
                        $('#leaveapply').find('[name="typeid"]').val(response.leaveapplyvalue.typeid).end();
                        
                        $('#leaveapply').find('[name="startdate"]').val(response.leaveapplyvalue.start_date).end();
                        $('#leaveapply').find('[name="enddate"]').val(response.leaveapplyvalue.end_date).end();
                        $('#leaveapply').find('[name="reason"]').val(response.leaveapplyvalue.reason).end();
                        $('#leaveapply').find('[name="status"]').val(response.leaveapplyvalue.leave_status).end();

                        if(response.leaveapplyvalue.leave_type == 'Half day') {
                            $('#appmodel').find(':radio[name=type][value="Half Day"]').prop('checked', true).end();
                            $('#hourAmount').show().end();
                            $('#enddate').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'Full Day') {
                            $('#appmodel').find(':radio[name=type][value="Full Day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'More than One day'){
                            $('#appmodel').find(':radio[name=type][value="More than One day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                            $('#enddate').show().end();
                        }

                        //new

                         $('#leaveapply').find('[name="employee_code"]').val(response.leaveapplyvalue.em_code).end();
                        // console.log(response.leaveapplyvalue.em_code)

                        $('#hourAmountVal').val(response.leaveapplyvalue.leave_duration).show().end();

                     
                    });
                });
            });

            /*employee*/
            $(document).ready(function() {
                $(".empleaveapp").click(function(e) {
                    e.preventDefault(e);
                    // Get the record's ID via attribute
                    var iid = $(this).attr('data-id');
                    $('#leaveapply').trigger("reset");
                    $('#appmodel').modal('show');
                    $.ajax({
                        url: 'LeaveAppbyid?id=' + iid,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function(response) {
                        var leavetype = response.leaveapplyvalue.typeid;
                        var argument = response.leaveapplyvalue.leavestrucid;
                        getdocument(leavetype);
                      //  get_leavetypes(argument)
                        // Populate the form fields with the data returned from server
                        $('#leaveapply').find('[name="id"]').val(response.leaveapplyvalue.id).end();
                        $('#leaveapply').find('[name="emid"]').val(response.leaveapplyvalue.em_id).end();
                        $('#leaveapply').find('[name="applydate"]').val(response.leaveapplyvalue.apply_date).end();
                      
                        $('#leaveapply').find('[name="leavestrucid"]').val(response.leaveapplyvalue.leavestrucid).end();

                        $('#leaveapply').find('[id="leavetypeid"]').val(response.leaveapplyvalue.leavestrucid).end();
                        //$('#leaveapply').find('[name="typeid"]').html('<option value='+response.leaveapplyvalue.typeid+'>'+response.leaveapplyvalue.name+'</option>').end();
                        $('#leaveapply').find('[name="typeid"]').val(response.leaveapplyvalue.typeid).end();
                        
                        $('#leaveapply').find('[name="startdate"]').val(response.leaveapplyvalue.start_date).end();
                        $('#leaveapply').find('[name="enddate"]').val(response.leaveapplyvalue.end_date).end();
                        $('#leaveapply').find('[name="reason"]').val(response.leaveapplyvalue.reason).end();
                        $('#leaveapply').find('[name="status"]').val(response.leaveapplyvalue.leave_status).end();

                        if(response.leaveapplyvalue.leave_type == 'Half day') {
                            $('#appmodel').find(':radio[name=type][value="Half Day"]').prop('checked', true).end();
                            $('#hourAmount').show().end();
                            $('#enddate').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'Full Day') {
                            $('#appmodel').find(':radio[name=type][value="Full Day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                        } else if(response.leaveapplyvalue.leave_type == 'More than One day'){
                            $('#appmodel').find(':radio[name=type][value="More than One day"]').prop('checked', true).end();
                            $('#hourAmount').hide().end();
                            $('#enddate').show().end();
                        }

                        
                        //new
               
                         $('#leaveapply').find('[name="employee_code"]').val(response.leaveapplyvalue.em_code).end();

                        $('#hourAmountVal').val(response.leaveapplyvalue.leave_duration).show().end();
                       
                     
                    });
                });
            });

        </script>          
        <script type="text/javascript">
             //save
    
        $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })
      $(document).on('click','#leaveapprove',function(){
        event.preventDefault();
           $("#leaveapply").valid();
        
        var emid=$("#emid").val();
        var leavetype=$("#leavetype").val();
        var startdate=$('#startdate').val();
        //console.log($("#leavetype").val()+'  '+$("#leavestrucid").val());
        if(emid != '' && leavetype != '' &&  $('#reason').val() != ''){
        
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Leave/Add_Applications");?>',
        data: new FormData($("#leaveapply")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){

        $('#appmodel').modal('hide');
        $(".modal-backdrop").remove();
      
        $('#leaveapply')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 1000,
        position: 'top-right'
        });
        
       setTimeout(function(){
         location.reload(true);
        },2000);
       }else if(data.error){
        $('#appmodel').modal('hide');
        $(".modal-backdrop").remove();
      
        $('#leaveapply')[0].reset();
              $.wnoty({
                    type: 'error',
                    message: data.error,
                    autohideDelay: 2000,
                    position: 'top-right'

                    });
        setTimeout(function(){
         location.reload(true);
        },2000);
        }
        },
        });
        }
     
        return false;
        }) 
      // New on change emp id

    // //select matched leave
    $(document).ready(function(){
    $("#emid").change(function(){
       
      var emid = $("#emid").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Leave/get_match_leavestructure");?>",
            data: { emid : emid },
             success:function(data){
                var info=$.parseJSON(data);
                $("#leavestrucid").html(info.content);
             } 
        })
    });
 
    });    
    //select matched leave
    $(document).ready(function(){
    $("#leavestrucid").change(function(){
       
      var leavestrucid = $("#leavestrucid").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Leave/get_match_leavetypes");?>",
            data: { leavestrucid : leavestrucid },
             success:function(data){
                var info=$.parseJSON(data);
                $("#leavetype").html(info.content);
             } 
        })
    });
 
    });    
    //leave type change get document status
   
    $("[name='typeid']").change(function(){
      
      var leavetype = $("[name='typeid']").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Leave/get_document_status");?>",
            data: { leavetype : leavetype },
             success:function(data){
                var info=$.parseJSON(data);
                $("#leavedocument").html(info.content);
             } 
        })
    });

    function getdocument(leavetype){
     var leavetype = leavetype;
      
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Leave/get_document_status");?>",
            data: { leavetype : leavetype },
             success:function(data){
                var info=$.parseJSON(data);
                $("#leavedocument").html(info.content);
             } 
        }) 
    }
   
 </script>          
<?php $this->load->view('backend/footer'); ?>
<script>
  $(document).ready(function () {
    $('#example3').DataTable({
     /*
        "scrollCollapse": true,
       
         "ordering": false,
          "scrollX": true,
         "scroller": true,*/
        "ordering": false,
          "initComplete": function (settings, json) {  
            $("#example3").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    });
});
</script>