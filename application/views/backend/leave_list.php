<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-clone" style="color:#1976d2"> </i> Leave List</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave List</li> -->
                <a type="button" href="<?php echo base_url(); ?>leave/Application" class="text-white btn btn-info"><i class="fa fa-bars "></i>  Leave Application</a>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <?php // if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> 
                <div class="col-12">
               
                    <!-- <a href="<?php echo base_url(); ?>leave/Application" class="text-white btn btn-info"><i class="fa fa-bars "></i>  Leave Application</a> -->
                </div>                       
            <?php // } ?> 
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leave  List                        
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="table1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Emp Code</th>
                                        <th>Employee Name</th>
                                        
                                        <th>Leave Structure</th>
                                        <th>Leave Type</th>
                                        <th>Applied Date</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>No. of Days</th>
                                        
                                         <th>Team Head Approval</th>
                                        <th>HR Approval</th>
                                        <th>Leave Status</th>
                                       
                                    </tr>
                                </thead>
                                  <tbody>
                                   <?php if($this->role->User_Permission('leave_application','can_view') &&$this->role->User_Permission('leave_application','can_add') &&  $this->role->User_Permission('leave_application','can_edit') &&  $this->role->User_Permission('leave_application','can_delete')){
                                  $eid = $this->session->userdata('user_login_id');
                                if(!$this->leave_model->Check_Teamhead($eid)){

                                    ?>
                              
                                    <?php 
                                    $i = 1;
                                    foreach($leavelist as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                       
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('d M Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php if($value->start_date) echo   date('d M Y',strtotime($value->start_date)); ?></td>
                                        <td><?php if($value->end_date) echo  date('d M Y',strtotime($value->end_date));  ?></td>
                            
                                        <td><?php /* echo $value->leave_days;*/if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}} ?></td>
                                      
                                         <td><?php echo $value->thead_approve; ?></td>
                                         <td><?php echo $value->hr_approve; ?></td>
                                         <td><?php echo $value->leave_status; ?></td>
                          
                                    </tr>
                                    <?php $i++; endforeach;  ?>
                                


                                        <?php } }elseif ($this->role->User_Permission('leave_application','can_view')) {
                                            $id = $this->session->userdata('user_login_id');
                                         $leavelistinfo = $this->leave_model->EmpLeavelist($id);
                                         
                                         if(!empty( $leavelistinfo)){
                                         
                                        ?>
                                       
                                            <?php $i = 1;
                                           foreach($leavelistinfo as $value): ?>
                                         <tr style="vertical-align:top">
                                        <td><?php echo $i ?></td>
                                         <td><?php echo $value->em_code; ?></td>
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                       
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('d M Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php if($value->start_date) echo   date('d M Y',strtotime($value->start_date)); ?></td>
                                        <td><?php if($value->end_date) echo  date('d M Y',strtotime($value->end_date));  ?></td>
                           
                                        <td><?php /* echo $value->leave_days;*/if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}} ?></td>
                                        <td><?php echo $value->leave_status; ?></td>
                                        <td><?php echo $value->thead_approve; ?></td>
                                         <td><?php echo $value->hr_approve; ?></td>
                                    </tr>
                                            <?php  $i++; endforeach; ?>
                                        

                                        <?php }}?>
                                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- HR Page Emp Leave list -->
                  <?php if ($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view')) {

                    $eid = $this->session->userdata('user_login_id');

                    $get_hr_approve = $this->leave_model->Leavelist_hr($eid);
                    if ($get_hr_approve) {?>
                  <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Employee Leave  List                        
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example3" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Employee </th>
                                        <th>Code</th>
                                        <th>Leave Structure</th>
                                        <th>Leave Type</th>
                                        <th>Applied Date</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>No. of Days</th>
                                        <th>Leave Status</th>
                                        <th> Status</th>
                                       
                                    </tr>
                                </thead>
                                   <?php if($this->role->User_Permission('leave_application','can_view') &&$this->role->User_Permission('leave_application','can_add')){?><!--  &&  $this->role->User_Permission('leave_application','can_edit') &&  $this->role->User_Permission('leave_application','can_delete') -->
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($get_hr_approve as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><?php echo $i ?></td>
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('d M Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php if($value->start_date) echo   date('d M Y',strtotime($value->start_date)); ?></td>
                                        <td><?php if($value->end_date) echo  date('d M Y',strtotime($value->end_date));  ?></td>
                            
                                        <td><?php /* echo $value->leave_days;*/if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}} ?></td>
                                        <td><?php echo $value->leave_status; ?></td>
                                        <td><?php echo $value->hr_approve; ?></td>
                          
                                    </tr>
                                    <?php $i++; endforeach;  ?>
                                 </tbody>
    
                                   <?php  } ?>
                            </table>
                        </div>
                    </div>
                </div> 
                 <?php } } ?> 
                 <!-- Team head Emp Leave list -->
                  <?php if ($this->role->User_Permission('leave_application','can_add') && $this->role->User_Permission('leave_application','can_view')) {

                    $eid = $this->session->userdata('user_login_id');

                    $get_head_approve = $this->leave_model->Leaveapply_Reporting_list($eid);
                    if ($get_head_approve) {?>
                  <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Employee Leave  List                        
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example3" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Employee </th>
                                        <th>Code</th>
                                        <th>Leave Structure</th>
                                        <th>Leave Type</th>
                                        <th>Applied Date</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>No. of Days</th>
                                        <th>Leave Status</th>
                                        <th> Status</th>
                                      
                                       
                                    </tr>
                                </thead>
                                   <?php if($this->role->User_Permission('leave_application','can_view') &&$this->role->User_Permission('leave_application','can_add')){?><!--  &&  $this->role->User_Permission('leave_application','can_edit') &&  $this->role->User_Permission('leave_application','can_delete') -->
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($get_head_approve as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><?php echo $i ?></td>
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('d M Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php if($value->start_date) echo   date('d M Y',strtotime($value->start_date)); ?></td>
                                        <td><?php if($value->end_date) echo  date('d M Y',strtotime($value->end_date));  ?></td>
                            
                                        <td><?php /* echo $value->leave_days;*/if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}} ?></td>
                                        <td><?php echo $value->leave_status; ?></td>
                                        <td><?php echo $value->thead_approve; ?></td>
                          
                                    </tr>
                                    <?php $i++; endforeach;  ?>
                                 </tbody>
    
                                   <?php  } ?>
                            </table>
                        </div>
                    </div>
                </div> 
                 <?php } } ?>
            </div>
        </div>
        </div>
      

       
<?php $this->load->view('backend/footer'); ?>
   <script>
  $(document).ready(function () {
    $('#example3').DataTable({
     
          "initComplete": function (settings, json) {  
            $("#example3").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    }); 
    $('#table1').DataTable({
     
          "initComplete": function (settings, json) {  
            $("#table1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    });
});
        </script>   