<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-braille" style="color:#1976d2"></i>&nbsp Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li> -->
                    </ol>
                </div>
            </div>
            <style>
      #clock {
          font-size: 1rem;
          text-align: center;
        }

        #time {
          font-weight: bold;
        }

        #date {
          font-size: 1rem;
          color: black ;
        }

            </style>
            <?php $organisationvalue = $this->settings_model->GetOrganisationValue(); ?>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <?php if($this->role->User_Permission('dashboard','can_view') && $this->role->User_Permission('dashboard','can_add')&& $this->role->User_Permission('dashboard','can_edit')&& $this->role->User_Permission('dashboard','can_delete')){?>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                     
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                    <?php 
                                        $data = array('status'=>'ACTIVE','isActive'=>1,'user_status'=>1);
                                        $this->db->where($data);
                                        $this->db->from("employee");
                                        echo $this->db->count_all_results();
                                    ?>  Employees</h3>
                                        <a href="<?php echo base_url(); ?>employee/Employees" class="text-muted m-b-0">View Employee</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                

                
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php 
                                                    $this->db->where('leave_status','Approved');
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> Leave Request
                                        </h3>
                                        <a href="<?php echo base_url(); ?>leave/Leavelist" class="text-muted m-b-0">View Leave</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                                $this->db->where(array('pro_status'=>'running','isActive'=>'1'));
                                                $this->db->from("project");
                                                echo $this->db->count_all_results();
                                            ?> Projects
                                        </h3>
                                        <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">View Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                         <?php 
                                                $this->db->where('status','Granted');
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?> Loan 
                                        </h3>
                                        <a href="<?php echo base_url(); ?>Loan/View" class="text-muted m-b-0">View Loan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <!-- Row -->
                <!-- Row -->
                
                <div class="row ">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url(); ?>leave/Today_absent" >
                        <div class="card card-inverse card-info">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <?php 
                                     $date =  date('Y-m-d');
                                    $sql = "SELECT  * FROM `emp_leave` WHERE `thead_approve` = 'Approved' AND `hr_approve` = 'Approved'  AND `start_date` = '".$date."' AND `isActive` = 1";
                                          $query=$this->db->query($sql); 
                                       // echo $this->db->count_all_results();
                                        echo  $query->num_rows();
                                    ?>
                                </h1>
                               
                                <h6 class="text-white">Absent today</h6>
                                <!-- <h6 class="text-white">Inactive Employees</h6> -->
                            </div>
                        </div>
                     </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url(); ?>leave/Application" >
                        <div class="card card-success card-inverse">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                             <?php 
                                                    $this->db->where(array('leave_status'=>'Pending','hr_approve'=>'Pending',));//`thead_approve` = 'Pending' AND `hr_approve` = 'Pending'
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                </h1>
                                <h6 class="text-white">Pending Leave Application </h6>
                                <!-- <h6 class="text-white">Leave Application</h6> -->
                            </div>
                        </div>
                    </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url(); ?>Projects/Pending_Projects" >
                        <div class="card card-inverse card-danger">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                     <?php 
                                            $this->db->where(array('pro_status'=>'upcoming','isActive'=> 1));
                                            $this->db->from("project");
                                            echo $this->db->count_all_results();
                                        ?> 
                                </h1>
                                <h6 class="text-white">Upcoming Project</h6>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <a href="<?php echo base_url(); ?>Loan/Pending_Loan" >
                        <div class="card card-inverse card-dark">
                            <div class="box text-center">
                                <h1 class="font-light text-white">
                                         <?php 
                                                $this->db->where(array('status'=>'Pending','hr_status'=>'Granted')); //`hr_status` = 'Pending'
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?> 
                                </h1>
                                <h6 class="text-white">Loan Application</h6>
                            </div>
                        </div>
                      </a>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
            </div> 
            
            <div class="container-fluid">
                <?php 
                $notice = $this->notice_model->GetNoticelimit(); 
                $running = $this->dashboard_model->GetRunningProject(); 
                $userid = $this->session->userdata('user_login_id');
                $todolist = $this->dashboard_model->GettodoInfo($userid); 
              /*  if(isset($organisationvalue->holidaystructureid)){  
                 $sid = $organisationvalue->holidaystructureid;              
                $holiday = $this->dashboard_model->GetHolidayInfo($sid);
                 }*/
                 $holiday = $this->dashboard_model->GetHolidays();
   
                // $leave = $this->dashboard_model->GetLeavedata();          
                 $leave = $this->leave_model->AllLeaveAPPlication();         
                ?>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body ">
                                <h4 class="card-title">Notice Board
                                <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>notice/All_notice"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive slimScrollDiv" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box ">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>From</th>
                                                <th>To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($notice AS $value): ?>
                                            <tr class="scrollbar" style="vertical-align:top">
                                                <td><?php echo $value->title ?></td>
                                                <td><a href="<?php echo base_url(); ?>assets/images/notice/<?php echo $value->file_url ?>" target="_blank" title="<?php echo $value->file_url ?>"><i class="fa fa-file"></i></a>
                                                </td>
                                                <td style=""><?php if($value->date) echo date('d-M-Y', strtotime($value->date)) ?></td>
                                                <td style=""><?php if($value->todate) echo date('d-M-Y', strtotime($value->todate)) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>

                               </div>
                               <!--   <div class="input-group">
                                   <span class="input-group-btn">
                                       <button type="submit" class="btn btn-success todo-submit"><i class="fa fa-plus"></i></button>
                                        </span> 
                                    </div> -->

                        </div>

                    </div>
                    <!-- Column -->
            
                       <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Holidays <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>leave/HolidayStructure"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                       <thead>
                                            <tr>
                                                <th>Structure</th>
                                                <th>Name</th>
                                                <th>Day</th>
                                                <th>Date</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                         <?php  

                                           foreach($holiday as $value){ ?>
                                           <tr style="background-color:#e3f0f7">
                                               <td><?php echo $value->holidaystructure ?></td>
                                               <td><?php echo $value->holiday_name ?></td>
                                               <td><?php echo date('l', strtotime($value->from_date));?></td>
                                               <td><?php echo date('d-M-Y', strtotime($value->from_date)); ?></td>
                                           </tr>
                                           <?php }  ?> 

                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Running Project<a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>Projects/All_Projects"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($running AS $value): ?>
                                            <tr style="vertical-align:top;background-color:#e3f0f7">
                                                <td><a href="<?php echo base_url(); ?>Projects/view?P=<?php echo base64_encode($value->id); ?>"><?php echo substr("$value->pro_name",0,25).'...'; ?></a></td>
                                                <td><?php echo date('d-M-Y', strtotime($value->pro_start_date)); ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($value->pro_end_date)); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                               Leave Application <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>leave/Leavelist"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll;">
                                    <table class="table table-hover earning-box">
                                       <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                          <?php  
                                          foreach($leave as $value): 
                                             $str = $value->first_name.' '.$value->last_name;
                                            ?>
                                           <tr style="background-color:#e3f0f7">
                                               <td><?php echo  str_pad($str,20,"<br>"); ?></td>
                                               <td><?php echo $value->name; ?></td>
                                               <td><?php echo date('d-M-Y', strtotime($value->start_date)); ?></td>
                                               <td><?php echo $value->leave_status; ?></td>
                                           </tr>
                                           <?php endforeach; ?>
                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                 <?php }else{ 
                    /*Employee dashboard*/
                    $id = $this->session->userdata('user_login_id');
                    $basicinfo = $this->employee_model->GetBasic($id);
                    ?>
                    
                  <div class="container-fluid">
                     <div class="row">
                     <div class="col-xl-3 col-lg-12 col-md-12">
                        <div class="card" style="height: 330px;">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                  <?php if(!empty($basicinfo->em_image)){ ?>
                                    <img src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $basicinfo->em_image; ?>" class="img-circle" width="150" />
                                    <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle" width="150" alt="<?php echo $basicinfo->first_name ?>" title="<?php echo $basicinfo->first_name ?>"/>
                                    <?php } ?>
                                    <!-- <img src="../assets/images/users/5.jpg" class="img-circle" width="150" /> -->
                                    <h4 class="card-title m-t-10"><?php echo $basicinfo->first_name .' '.$basicinfo->last_name; ?></h4>
                                    <h6 class="card-subtitle"><?php if ($basicinfo->des_name) { echo $basicinfo->des_name; } ?></h6>
                                     <div class="row text-center justify-content-md-center">
                                        
                                    </div> 
                                </center>
                            </div>
                            <div>
                            </div>
                      
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-12 col-md-12">
                    <div class="row mb-3 mt-xl-0 mt-lg-4 mt-md-4 mt-4">
                 
                    <div class="col-md-4 ">
                        <div class="card">
                            <a href="<?php echo base_url(); ?>leave/Leavelist" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php 
                                                    $this->db->where(array ('leave_status'=>'Approved','thead_approve'=>'Approved','hr_approve'=>'Approved','em_id'=>$id));
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                        </h3>
                                        <h5 class="text-muted m-b-0">Total Leave Request</h5>
                                        <!-- <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">View Leave</a> -->
                                        </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div> 
                    <div class="col-md-4 ">
                        <div class="card">
                            <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                             <?php //
                                                $sql = "SELECT * FROM emp_leave WHERE MONTH(start_date) = MONTH(CURRENT_DATE()) AND YEAR(start_date) = YEAR(CURRENT_DATE()) AND leave_status = 'Approved' AND thead_approve ='Approved' AND hr_approve ='Approved' AND em_id = '$id'";
                                                     $query=$this->db->query($sql);
                                       
                                                   echo  $query->num_rows();

                                                ?> 
                                        </h3>
                                        <h5 class="text-muted m-b-0">This Month Leave Request</h5>
                                        <!-- <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">View Leave</a> -->
                                        </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                      <div class="col-md-4 ">
                         <div class="card">
                            <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                                $this->db->where(array('pro_status'=>'running','isActive'=>1));
                                                $this->db->from("project");
                                                echo $this->db->count_all_results();
                                            ?> 
                                        </h3>
                                          <h5 class="text-muted m-b-0">Projects</h5>
                                       <!--  <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">View Project</a> -->
                                    </div>
                                </div>
                            </div>
                             </a>
                        </div>
                    </div>    
                     <div class="col-md-4 ">
                         <div class="card">
                            <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                                $this->db->where(array('assign_user'=>$id,'isActive'=>1));
                                                $this->db->from("assign_task");
                                                echo $this->db->count_all_results();
                                            ?> 
                                        </h3>
                                          <h5 class="text-muted m-b-0">Task</h5>
                                       <!--  <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">View Project</a> -->
                                    </div>
                                </div>
                            </div>
                             </a>
                        </div>
                    </div>
                          <div class="col-md-4 ">
                         <div class="card">
                            <a href="<?php echo base_url(); ?>Projects/Pending_Projects" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                            $this->db->where(array('pro_status'=>'upcoming','isActive'=> 1));
                                            $this->db->from("project");
                                            echo $this->db->count_all_results();
                                        ?> 
                                        </h3>
                                          <h5 class="text-muted m-b-0">Upcoming Project</h5>
                                       <!--  <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">View Project</a> -->
                                    </div>
                                </div>
                            </div>
                             </a>
                        </div>
                    </div>
            
                    <!-- HR -->
                    <?php    $eid = $this->session->userdata('user_login_id');

                    $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
                    if ($get_hr_approve) {

                    $busid  = $get_hr_approve->id;?>

                           <div class="col-md-4 ">
                                           <div class="card">
                                            <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row">
                                                        <div class="round align-self-center round-info"><i class="ti-settings"></i></div>
                                                        <div class="m-l-10 align-self-center">
                                                            <h3 class="m-b-0">
                                                             <?php 
                                                                  
                                                                    echo $this->dashboard_model->GetPendingleave_hr($eid);
                                                                  
                                                                ?>  
                                                            </h3>
                                                             <h5 class="text-muted m-b-0">Pending Leave Approval</h5>
                                                            <!-- <a href="<?php echo base_url(); ?>Loan/View" class="text-muted m-b-0">View Loan</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- new -->

                                         <div class="col-md-4 ">
                                           <div class="card">
                                            <a href="<?php echo base_url(); ?>leave/Today_absent" class="text-muted m-b-0">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row">
                                                        <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                                                        <div class="m-l-10 align-self-center">
                                                            <h3 class="m-b-0">
                                                              <?php 
                                                         $date =  date('Y-m-d');
                                                        $sql = "SELECT  * FROM `emp_leave` WHERE `thead_approve` = 'Approved' AND `hr_approve` = 'Approved'  AND `start_date` = '".$date."' AND `isActive` = 1";
                                                              $query=$this->db->query($sql); 
                                                           // echo $this->db->count_all_results();
                                                            echo  $query->num_rows();
                                                           ?> 
                                                            </h3>
                                                             <h5 class="text-muted m-b-0">Absent today</h5>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>     
                                    <!--      <div class="col-md-4 ">
                                           <div class="card">
                                            <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row">
                                                        <div class="round align-self-center round-info"><i class="ti-support"></i></div>
                                                        <div class="m-l-10 align-self-center">
                                                            <h3 class="m-b-0">
                                                        <?php 
                                                    $this->db->where(array('leave_status'=>'Pending','hr_approve'=>'Pending',));//`thead_approve` = 'Pending' AND `hr_approve` = 'Pending'
                                                    $this->db->from("emp_leave");
                                                    echo $this->db->count_all_results();
                                                ?> 
                                                            </h3>
                                                             <h5 class="text-muted m-b-0">Pending Leave Application</h5>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div> -->
               
                     <div class="col-md-4 ">
                       <div class="card">
                        <a href="<?php echo base_url(); ?>Loan/View" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0">
                                         <?php 
                                              
                                                $this->db->where(array('status'=>'Granted','emp_id'=>$id));
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?>  
                                        </h3>
                                         <h5 class="text-muted m-b-0">Loan</h5>
                                        <!-- <a href="<?php echo base_url(); ?>Loan/View" class="text-muted m-b-0">View Loan</a> -->
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                         <div class="card">
                            <a href="<?php echo base_url(); ?>Loan/Pending_Loan" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-info"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                                $this->db->where('hr_status','Pending'); 
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?> 
                                        </h3>
                                          <h5 class="text-muted m-b-0">Pending Loan Approval</h5>
                                       
                                    </div>
                                </div>
                            </div>
                             </a>
                        </div>
                    </div>  
                  <!--   <div class="col-md-4 ">
                         <div class="card">
                            <a href="<?php echo base_url(); ?>Projects/All_Projects" class="text-muted m-b-0">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0"> 
                                         <?php 
                                                $this->db->where('hr_status','Pending'); 
                                                $this->db->from("loan");
                                                echo $this->db->count_all_results();
                                            ?> 
                                        </h3>
                                          <h5 class="text-muted m-b-0">Loan Application</h5>
                                 
                                    </div>
                                </div>
                            </div>
                             </a>
                        </div>
                    </div>  -->

      


                        <?php } ?>        
                    <?php $get_hr_approve1 = $this->dashboard_model->Emplist_teamhead($eid);
                    if ($get_hr_approve1) {
                        
                    /*$busid  = $get_hr_approve->id;*/ ?>

                           <div class="col-md-4 ">
                                           <div class="card">
                                            <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0">
                                                <div class="card-body">
                                                    <div class="d-flex flex-row">
                                                        <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                                                        <div class="m-l-10 align-self-center">
                                                            <h3 class="m-b-0">
                                                             <?php 
                                                                  
                                                                    echo $this->dashboard_model->GetPendingleave_teamhead($eid);
                                                                  
                                                                ?>  
                                                            </h3>
                                                             <h5 class="text-muted m-b-0">Pending Team Head Approval</h5>
                                                            <!-- <a href="<?php echo base_url(); ?>Loan/View" class="text-muted m-b-0">View Loan</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                        <?php } ?>

                    </div>

                    </div>
                </div>
             </div>
            <div class="container-fluid">
                <?php 
                $notice = $this->notice_model->GetNoticelimit(); 
                $running = $this->dashboard_model->GetRunningProject(); 
                $userid = $this->session->userdata('user_login_id');
                $todolist = $this->dashboard_model->GettodoInfo($userid); 
              
                $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
                if ($get_hr_approve) {

                $holiday = $this->dashboard_model->GetHolidays();
                }else{
                       $eid = $this->session->userdata('user_login_id'); 
                    $emp = $this->dashboard_model->getemp($eid); //changes
                    $busunit = $this->dashboard_model->get_businesscode($emp->busunit); //changes
                    $holiday = $this->dashboard_model->GetHolidaysbyid($busunit->holidaystructureid); //changes
                    // print_r($emp);
                    // print_r($busunit);
                    // print_r($holiday);
                }
                 //$leave = $this->dashboard_model->GetLeavedata();
                 $eid = $this->session->userdata('user_login_id');                
                 $leave =  $this->leave_model->Leaveapply_hr($eid);             
                ?>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body ">
                                <h4 class="card-title">Notice Board
                                <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>notice/All_notice"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive slimScrollDiv" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box ">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>From</th>
                                                <th>To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($notice AS $value): ?>
                                            <tr class="scrollbar" style="vertical-align:top">
                                                <td><?php echo $value->title ?></td>
                                                <td><a href="<?php echo base_url(); ?>assets/images/notice/<?php echo $value->file_url ?>" target="_blank" title="<?php echo $value->file_url ?>"><i class="fa fa-file"></i></a>
                                                </td>
                                                <td style=""><?php if($value->date) echo date('d-M-Y', strtotime($value->date)) ?></td>
                                                <td style=""><?php if($value->todate) echo date('d-M-Y', strtotime($value->todate)) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>

                               </div>
                          

                        </div>

                    </div>
                    <!-- Column -->
                    <!-- Employee and hr -->
                       <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Holidays  <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>leave/HolidayStructure"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                       <thead>
                                            <tr>
                                                <th>Structure</th>
                                                <th>Name</th>
                                                <th>Day</th>
                                                <th>Date</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                         <?php 
                                           foreach($holiday as $value){ ?>
                                           <tr style="background-color:#e3f0f7">
                                              <td><?php echo $value->holidaystructure ?></td>
                                               <td><?php echo $value->holiday_name ?></td>
                                               <td><?php echo date('l', strtotime($value->from_date));?></td>
                                               <td><?php echo date('d-M-Y', strtotime($value->from_date)); ?></td>
                                           </tr>
                                           <?php }  ?>
                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Running Project<a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>Projects/All_Projects"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php  foreach($running AS $value1): ?>
                                            <tr style="vertical-align:top;background-color:#e3f0f7">
                                                <td><a href="<?php echo base_url(); ?>Projects/view?P=<?php echo base64_encode($value1->id); ?>"><?php echo substr("$value1->pro_name",0,25).'...'; ?></a></td>
                                                <td><?php echo date('d-M-Y', strtotime($value1->pro_start_date)); ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($value1->pro_end_date)); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <?php  if ($this->dashboard_model->Emplist_hr($eid)) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                               Leave Application <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>leave/Leavelist"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                       <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                          <?php  
                                          
                                          foreach($leave as $value): 
                                             $str = $value->first_name.' '.$value->last_name;
                                            ?>
                                           <tr style="background-color:#e3f0f7">
                                               <td><?php echo  str_pad($str,20,"<br>"); ?></td>
                                               <td><?php echo $value->name; ?></td>
                                               <td><?php echo date('d-M-Y', strtotime($value->start_date)); ?></td>
                                               <td><?php echo $value->leave_status; ?></td>
                                           </tr>
                                           <?php endforeach; ?>
                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                <?php }else{ 
                       
                         $id = $this->session->userdata('user_login_id');
                         $leaveinfo = $this->leave_model->EmpLeaveAPPlication($id);

                    ?>
                           <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                               Leave Application <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>leave/Leavelist"><i class="fa fa-plus"></i></a></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                       <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>                                           
                                       </thead>
                                       <tbody>
                                          <?php  
                                          
                                          foreach($leaveinfo as $value): 
                                             $str = $value->first_name.' '.$value->last_name;
                                            ?>
                                           <tr style="background-color:#e3f0f7">
                                               <td><?php echo  str_pad($str,20,"<br>"); ?></td>
                                               <td><?php echo $value->name; ?></td>
                                               <td><?php echo date('d-M-Y', strtotime($value->start_date)); ?></td>
                                               <td><?php echo $value->leave_status; ?></td>
                                           </tr>
                                           <?php endforeach; ?>
                                       </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                 </div>
                 <!-- Annual Leave Information In HR Dashboard -->
                  <?php //if ($this->role->User_Permission('dashboard','can_add') && $this->role->User_Permission('dashboard','can_view')) {

                $eid = $this->session->userdata('user_login_id');

                $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
                if ($get_hr_approve) {
                $busid  = $get_hr_approve->id;
                $annual_leave_info = $this->dashboard_model->GetEmpAnnual_info($busid); 
                   ?>

                 <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Annual Leave<!-- <a type="submit" class="btn btn-info  todo-submit float-right text-white" href="<?php echo base_url()?>Projects/All_Projects"><i class="fa fa-plus"></i></a> --></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="height:600px;overflow-y:scroll">
                                    <table class="table table-hover earning-box">
                                        <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Joining Date</th>
                                                <th>Annual Leave Month</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php  foreach($annual_leave_info AS $data): 
                                            
                                             $date = DateTime::createFromFormat('m-Y', $data->date_after_11_months);
                                            $formatted_date = date('F Y', $date->getTimestamp());
                                           
                                            ?>
                                            <tr style="vertical-align:top;background-color:#e3f0f7">
                                                <td><?php  echo $data->first_name.' '.$data->last_name ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($data->em_joining_date)); ?></td>
                                                <td><?php  echo $formatted_date; ?></td>
                                                <td><button type="submit" class="btn btn-info" id="send_message" data-eid ="<?php  echo $data->eid; ?>" data-id="<?php  echo $data->em_id; ?>" <?php if($data->notification_status == 1) { echo 'disabled';}?>>Send</button></td>
                                                
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    </div>
              
                 <?php } } ?> 
                </div> 

                 <?php //} ?>
<script>
  $(".to-do").on("click", function(){
      //console.log($(this).attr('data-value'));
      $.ajax({
          url: "Update_Todo",
          type:"POST",
          data:
          {
          'toid': $(this).attr('data-id'),         
          'tovalue': $(this).attr('data-value'),
          },
          success: function(response) {
              location.reload();
          },
          error: function(response) {
            console.error();
          }
      });
  });			
</script>                                               
<?php $this->load->view('backend/footer'); ?>
<script>
    $(document).ready(function() {
    setInterval(function() {
    var now = new Date();
    var time = now.toLocaleTimeString();
    var options = { weekday: "long",
    year: "numeric",
    month: "short",
    day: "numeric" };
    var date = now
            .toLocaleDateString("en-US", options)
    //var day = now.toLocaleDateString('en-US', { weekday: 'long' });
    

    $('#time').html(time);
    $('#date').html(date );//+ ', ' + day
  }, 1000);
 
});

   $(document).on('click','#send_message',function(){
     var emid = $(this).attr('data-id');
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Dashboard/hr_reminder_mail");?>',
     data: {emid:emid},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },1000);
     //$('#send_message').prop('disabled', true);

     }else if(data.error){
    setTimeout(function(){
     location.reload(true);
    },1000);
    } 
    },
    });
    return false;
    })

   

</script>
<!------------------------------------------------ New Policy modal------------------------------- -->
<div class="modal fade" id="policyModal" tabindex="-1" role="dialog" aria-labelledby="policyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="policyModalLabel">Policy Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display Policy Details here -->
                <h6>Policy Description:</h6>
                <p id="policyDescription"></p>
                <embed id="policyPdf" src="" type="application/pdf" width="100%" height="500px" />
                <br>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="acceptCheckbox" value="1">
                    <label class="form-check-label" for="acceptCheckbox">I accept the policy</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="acceptPolicy()">Accept</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to show the policy modal directly
//     function showPolicyModal(policyId) {
//         $.ajax({
//             type: 'post',
//             url: '<?= base_url("dashboard/acceptPolicy"); ?>',
//             data: { policyId: policyId, accepted: 0 }, // Send a default value
//             success: function (response) {
//                 var data = $.parseJSON(response);
//                  console.log(data)
//                 if (data.status === 'success') {
//                     // Update the modal content based on the fetched policy details
//                     // Assume the response contains policy details like title, description, and file path
//                     $('#policyModalLabel').text(data.policy_title);
//                     $('#policyDescription').text(data.policy_description);
//                     $('#policyPdf').attr('src', data.file);
//                     $('#acceptCheckbox').prop('checked', false); // Reset the checkbox
//                     $('#policyModal').modal('show');
//                 } else {
//                     alert('Error fetching policy details.');
//                 }
//             }
//         });
//     }

//     // Check if policies are accepted on page load
//     $(document).ready(function () {
//         $.ajax({
//             type: 'post',
//             url: '<?= base_url("dashboard/checkPoliciesAccepted"); ?>',
//             success: function (response) {
//                 var data = $.parseJSON(response);
//                 if (data.status === 'not_accepted') {
//                     // Show the first policy directly
//                     showPolicyModal(<?= $policies[0]['id']; ?>);
//                 }
//             }
//         });
//     });

//     // Assuming policiesData is defined in your view file
//     var policiesData = <?php echo json_encode($policies); ?>;
//     var currentIndex = 0; // Initialize currentIndex to 0

//   function acceptPolicy() {
//  var policyId = null;

// // Check if policiesData is not empty and currentIndex is within bounds
// if (policiesData.length > 0 && currentIndex >= 0 && currentIndex < policiesData.length) {
//     policyId = policiesData[currentIndex].id;
// } else {
//     console.log('Invalid currentIndex or empty policiesData.');
// }

// // Proceed with the AJAX request only if policyId is not null
// if (policyId !== null) {
//     var accepted = $('#acceptCheckbox').prop('checked') ? 1 : 0;

//     // Perform AJAX request to update the server with acceptance status
//     $.ajax({
//         type: 'post',
//         url: '<?php echo base_url("dashboard/acceptPolicy"); ?>',
//         data: { policyId: policyId, accepted: accepted },
//         success: function (response) {
//             var data = $.parseJSON(response);
//             console.log(data.policy_file);

//             if (data.status === 'success') {
//                 // Update the modal content based on the fetched policy details
//                 // Assume the response contains policy details like title, description, and file path
//                 $('#policyModalLabel').text(data.policy_title);
//                 $('#policyDescription').text(data.policy_description);
//                 $('#policyPdf').attr('src', data.policy_file);
//                 $('#acceptCheckbox').prop('checked', false); // Reset the checkbox
//                 $('#policyModal').modal('show');
//             } else {
//                 alert('Error accepting policy.');
//             }
//         }
//     });
// }
// }


    //-----------------------------new
   var policiesData = <?php echo json_encode($policies); ?>;
   var currentIndex = 0; // Initialize currentIndex to 0
   <?php   if ($user_status == 1) { ?>
    // $(document).ready(function () {
    //     $.ajax({
    //         type: 'post',
    //         url: '<?= base_url("dashboard/checkPoliciesAccepted"); ?>',
    //         success: function (response) {
    //             var data = $.parseJSON(response);
    //             if (data.status === 'not_accepted') {
    //                 // Show the first policy directly
    //                 showPolicyModal(<?= $policies[0]['id']; ?>);
    //             }
    //         }
    //     });
    // });
    $(document).ready(function () {
    $.ajax({
        type: 'post',
        url: '<?= base_url("dashboard/checkPoliciesAccepted"); ?>',
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.status === 'not_accepted') {
                // Extract information about the pending policy
                var pendingPolicy = data.pending_policy;

                // Show the modal with information about the pending policy
                showPolicyModal(pendingPolicy.policy_id);
            }
        }
    });
});
     <?php   } ?>
    function showPolicyModal(policyId) {
    $.ajax({
        type: 'post',
        url: '<?= base_url("dashboard/acceptPolicy"); ?>',
        data: { policyId: policyId, accepted: 0 }, // Send a default value
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.status === 'success') {
                // Update the modal content based on the fetched policy details
                $('#policyModalLabel').text(data.policy_title);
                $('#policyDescription').text(data.policy_description);
                $('#policyPdf').attr('src', data.file);
                $('#acceptCheckbox').prop('checked', false); // Reset the checkbox
                $('#policyModal').modal('show');
            } else {
                alert('Error fetching policy details.');
            }
        }
    });
}

function acceptPolicy() {
    var policyId = policiesData[currentIndex].id;
    var accepted = $('#acceptCheckbox').prop('checked') ? 1 : 0;
   if(accepted  == 1){
    $.ajax({
        type: 'post',
        url: '<?php echo base_url("dashboard/acceptPolicy"); ?>',
        data: { policyId: policyId, accepted: accepted },
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.status === 'success') {
                // Update the modal content based on the fetched policy details
                $('#policyModalLabel').text(data.policy_title);
                $('#policyDescription').text(data.policy_description);
                $('#policyPdf').attr('src', data.file);
                $('#acceptCheckbox').prop('checked', false); // Reset the checkbox
                $('#policyModal').modal('show');

                // Move to the next policy
                currentIndex++;
                if (currentIndex < policiesData.length) {
                    // Show the next policy
                    showPolicyModal(policiesData[currentIndex].id);
                } else {
                    // All policies are accepted, redirect or perform other actions
                    window.location.href = '<?php echo base_url('dashboard'); ?>';
                }
            } else {
                alert('Error accepting policy.');
            }
        }
    });
 }
}

</script>
