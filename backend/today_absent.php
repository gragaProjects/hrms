<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-clone" style="color:#1976d2"> </i> Today Absent</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Today Absent</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <?php // if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> 
                <div class="col-12">
               
                    <a href="<?php echo base_url(); ?>leave/Application" class="text-white btn btn-info"><i class="fa fa-bars "></i>  Leave Application</a>
                </div>                       
            <?php // } ?> 
        </div> 
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Today Absent                       
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="table1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
                                         <th>Team head Status</th>
                                        <th>HR Status</th>
                                       
                                    </tr>
                                </thead>
                                  <tbody>
                                   <?php if($this->role->User_Permission('leave_application','can_view') &&$this->role->User_Permission('leave_application','can_add') &&  $this->role->User_Permission('leave_application','can_edit') &&  $this->role->User_Permission('leave_application','can_delete')){
                                 $date =  date('Y-m-d');
                                    $sql = "SELECT  * FROM `emp_leave` LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`   LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`  LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`  WHERE `thead_approve` = 'Approved' AND `hr_approve` = 'Approved'  AND `start_date` = '".$date."' AND `emp_leave`.`isActive` = 1 order by start_date desc";
                                          $leavelist = $this->db->query($sql)->result(); 
                               

                                    ?>
                              
                                    <?php 
                                    $i = 1;
                                    foreach($leavelist as $value): ?>
                                    <tr style="vertical-align:top">
                                        <td><?php echo $i ?></td>
                                        <td><span><?php echo $value->first_name.' '.$value->last_name ?></span></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><?php echo $value->leavestructure; ?></td>
                                        <td><?php echo $value->name; ?></td>
                                   
                                        <td><?php if($value->apply_date) echo date('jS  F Y',strtotime($value->apply_date)); ?></td>
                                        <td><?php if($value->start_date) echo   date('jS  F Y',strtotime($value->start_date)); ?></td>
                                        <td><?php if($value->end_date) echo  date('jS  F Y',strtotime($value->end_date));  ?></td>
                            
                                        <td><?php /* echo $value->leave_days;*/if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}} ?></td>
                                        <td><?php echo $value->leave_status; ?></td>
                                         <td><?php echo $value->thead_approve; ?></td>
                                         <td><?php echo $value->hr_approve; ?></td>
                          
                                    </tr>
                                    <?php $i++; endforeach;  ?>
                                


                                        <?php } ?>
                                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
    
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