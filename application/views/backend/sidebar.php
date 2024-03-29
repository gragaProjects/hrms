<style type="text/css">

@media (max-width: 767px) {
    .sidebartoggler{
        display: block;
    }
}

</style>

        <aside id="leftsidebar" class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" style="margin: 0; padding:0">
                <!-- User profile -->
                      <?php 
                        $id = $this->session->userdata('user_login_id');
                        $basicinfo = $this->employee_model->GetBasic($id); 
                        $role_id = $this->session->userdata('user_type');
                   
                        ?>   
    
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav mobile-menu">
               
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li><!--  class="<?php if (base_url()) { echo "active"; }?>" -->
                       <?php  if($this->role->User_Permission('dashboard','can_view'))
                         {?>
                        <li> <a href="<?php echo base_url(); ?>"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                    <?php }?>

                        <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                   <!--      <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays" class="submenu"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Projects </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                              
                            </ul>
                        </li>  -->                                                                      
                        <?php } else { ?>

                         <?php 
                           $eid = $this->session->userdata('user_login_id');
                          if($this->role->User_Permission('employee_list','can_view') || $this->role->User_Permission('disciplinary','can_view')|| $this->role->User_Permission('inactive_user','can_view') ){?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">   <?php  if($this->role->User_Permission('employee_list','can_view') && $this->role->User_Permission('disciplinary','can_view')&& $this->role->User_Permission('inactive_user','can_view') && !$this->dashboard_model->Emplist_teamhead($eid)){?> Employees <?php }else{ ?> My Profile <?php } ?></span></a>
                            <ul aria-expanded="false" class="collapse">
                                 <?php  if($this->role->User_Permission('employee_list','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>employee/Employees"> <?php  if($this->role->User_Permission('employee_list','can_view') && $this->role->User_Permission('disciplinary','can_view')&& $this->role->User_Permission('inactive_user','can_view') && !$this->dashboard_model->Emplist_teamhead($eid)){?> Employees  <?php }else{ ?> My Profile <?php } ?></a></li>
                                <?php }?>
                                 <?php  if($this->role->User_Permission('disciplinary','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>
                                <?php }?>
                                 <?php  if($this->role->User_Permission('inactive_user','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>employee/Inactive_Employee">Inactive User </a></li>
                                  <?php }?>
                            </ul>
                        </li>
                         <?php }?>
                    <!--     <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Attendance </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>attendance/Attendance">Attendance List </a></li>
                                <li><a href="<?php echo base_url(); ?>attendance/Save_Attendance">Add Attendance </a></li>
                                <li><a href="<?php echo base_url(); ?>attendance/Attendance_Report">Attendance Report </a></li>
                            </ul>
                        </li> -->
                         <?php  if($this->role->User_Permission('holiday','can_view') || $this->role->User_Permission('holiday_report','can_view')|| $this->role->User_Permission('leave_structure','can_view')|| $this->role->User_Permission('leave_application','can_view')|| $this->role->User_Permission('leave_report','can_view') ){?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <?php  if($this->role->User_Permission('holiday','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>employee/Employee_holidays"> Weekend Break </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/HolidayStructure"> Holiday Structure </a></li>
                                <?php } if($this->role->User_Permission('holiday_report','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>leave/HolidayReport"> Holiday Report</a></li>
                                <?php }  if($this->role->User_Permission('leave_structure','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>leave/LeaveStructure"> Leave Structure</a></li>
                                <?php } if($this->role->User_Permission('leave_application','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>leave/Application"> Leave Application  <span class="badge badge-light Application" style="background-color:#f42b28 ;color:#fff"></span></a></li>
                                <?php }  if($this->role->User_Permission('leave_report','can_view')){?>
                               <!--  <li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li> -->
                                <li><a href="<?php echo base_url(); ?>leave/Leave_report">Leave Report </a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php }?>
                        <?php   if($this->role->User_Permission('all_projects','can_view') || $this->role->User_Permission('task_list','can_view')|| $this->role->User_Permission('field_visit','can_view') ){?>
                        <li>
                         <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Project </span></a>
                            <ul aria-expanded="false" class="collapse">
                                  <?php  if($this->role->User_Permission('all_projects','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Projects">Projects </a></li>
                                 <?php } if($this->role->User_Permission('task_list','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Projects/All_Tasks"> Task List </a></li>
                                 <?php } if($this->role->User_Permission('field_visit','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Projects/Field_visit"> Field Visit</a></li>
                                 <?php }?>
                            </ul>
                        </li>
                         <?php }?>
                        <?php   if($this->role->User_Permission('all_projects','can_view') || $this->role->User_Permission('task_list','can_view') ){?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Loan </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <?php  if($this->role->User_Permission('apply_loan','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Loan/View"> Apply Loan </a></li>
                                <?php  } if($this->role->User_Permission('loan_installment','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Loan/installment"> Loan Installment</a></li>
                                 <?php }?>
                            </ul>
                        </li>
                         <?php }?>
                              <?php   if($this->role->User_Permission('generate_timesheet','can_view') || $this->role->User_Permission('timesheet_report','can_view') ){?>
                         <li> <a class="has-arrow waves-effect waves-dark " href="#" aria-expanded="false"><i class="mdi mdi-file-chart"></i><span class="hide-menu">Time Sheet </span></a>
                            <ul aria-expanded="false" class="collapse">
                             <?php  if($this->role->User_Permission('generate_timesheet','can_view')){?>
                               <li><a href="<?php echo base_url(); ?>TimeSheet/TimeSheet">Generate TimeSheet</a></li>
                                   <?php  } if($this->role->User_Permission('timesheet_report','can_view')){?>
                               <li><a href="<?php echo base_url(); ?>TimeSheet/TimesheetReport"> TimeSheet Report</a></li>
                               <?php }?>
                             
                            </ul>
                        </li>
                         <?php }?>
                           <?php   if($this->role->User_Permission('generate_payslip','can_view') || $this->role->User_Permission('payroll_list','can_view')|| $this->role->User_Permission('payroll_report','can_view') ){?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">Payroll </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <!--<li><a href="<?php #echo base_url(); ?>Payroll/Salary_Type"> Payroll Type </a></li>-->
                                   <?php  if($this->role->User_Permission('generate_payslip','can_view')){?>
                                  <li><a href="<?php echo base_url(); ?>Payroll/Generate_salary"> Generate Payslip</a></li>
                                    <?php  } if($this->role->User_Permission('payroll_list','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Payroll/Salary_List"> Payroll List </a></li>
                                <?php  } if($this->role->User_Permission('payroll_report','can_view')){?>
                                <li><a href="<?php echo base_url(); ?>Payroll/Payslip_Report"> Payslip Report</a></li>
                               
                               <?php }?>
                            </ul>
                        </li>
                         <?php } 
                         if($this->role->User_Permission('assets','can_view')){?>
 
                               <li> <a class="has-arrow waves-effect waves-dark " href="#" aria-expanded="false"><i class="mdi mdi-clipboard"></i><span class="hide-menu">Assets </span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo base_url(); ?>Logistice/Assets_Category"> Assets Category </a></li>
                                        <li><a href="<?php echo base_url(); ?>Logistice/All_Assets"> Asset List </a></li>
                                    
                                        <li><a href="<?php echo base_url(); ?>Logistice/logistic_support"> Logistic Support </a></li>
                                    </ul>
                                </li>   
                                <?php } ?>
                          <?php  if($this->role->User_Permission('notice','can_view')){?>
                        <li> <a href="<?php echo base_url()?>notice/All_notice" ><i class="mdi mdi-treasure-chest"></i><span class="hide-menu">Notice <span class="hide-menu"></a></li>

                            <?php }?> 
                             <?php  if($this->role->User_Permission('expenses','can_view')){?>
                        <li> <a href="<?php echo base_url()?>Expenses/ViewExpences" ><i class="mdi mdi-basket"></i><span class="hide-menu">Claims <span class="hide-menu"></a></li>
                            
                            <?php } ?>
                         <?php   if($this->role->User_Permission('organisation_info','can_view') || $this->role->User_Permission('business_unit','can_view')|| $this->role->User_Permission('department','can_view') || $this->role->User_Permission('org_master','can_view') || $this->role->User_Permission('emp_master','can_view')|| $this->role->User_Permission('assets','can_view')|| $this->role->User_Permission('timesheet_master','can_view')|| $this->role->User_Permission('salary_type','can_view') ){?>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-folder-account"></i><span class="hide-menu">Organisation </span></a>
                         <ul aria-expanded="false" class="collapse">
                             <?php if($this->role->User_Permission('organisation_info','can_view')){?>
                            <li><a href="<?php echo base_url()?>settings/Organisation_Settings"> Organisation Info</a></li>
                             <?php } if($this->role->User_Permission('business_unit','can_view')){?>
                            <li><a href="<?php echo base_url()?>settings/BusinessUnit">Business Units</a></li>

                             <?php } if($this->role->User_Permission('Shift','can_view')){?>
                             <li><a href="<?php echo base_url()?>Shift/ShiftManagement">Shift</a></li>
                            <?php } ?>
                             
                             <li><a href="<?php echo base_url()?>Biometric/ViewBiometric">Biometric Device</a></li>

                            <?php  if($this->role->User_Permission('department','can_view')){?>
                            <li><a href="<?php echo base_url()?>settings/OrganisationDepartment"> Department</a></li>
                             <?php } if($this->role->User_Permission('org_master','can_view')){?>
                            <!-- <li><a href="#"> Organisation Structure</a></li> -->
                             <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Organisation Masters </span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo base_url();?>settings/Country" class="submenu">Country </a></li>
                                        <li><a href="<?php echo base_url();?>settings/State" class="submenu">State</a></li>
                                        <li><a href="<?php echo base_url();?>settings/District" class="submenu">District</a></li>
                                        <li><a href="<?php echo base_url();?>settings/City" class="submenu">City</a></li>
                                        <li><a href="<?php echo base_url();?>settings/timezone" class="submenu">Timezone</a></li>
                                        <li><a href="<?php echo base_url();?>settings/EmailSettings" class="submenu">Email Configuration</a></li>
                                  
                                    </ul>
                                </li>
                                <?php } if($this->role->User_Permission('emp_master','can_view')){?>
                                  <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Employee Masters </span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <!-- <li><a href="<?php echo base_url();?>organization/Department" class="submenu">Department </a></li> -->
                                        <li><a href="<?php echo base_url();?>organization/Designation" class="submenu">Designation</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Role" class="submenu"> Roles & Permission </a></li>
                                         <!--  -->
                                       <!--  <li><a href="<?php echo base_url();?>organization/Employment" class="submenu">Employement Mode </a></li> -->
                                        <!-- <li><a href="<?php echo base_url();?>organization/JobTitle" class="submenu">Job Title</a></li> -->
                                        <li><a href="<?php echo base_url();?>organization/Prefix">Prefix</a></li>
                                        <!-- <li><a href="<?php echo base_url();?>organization/Position">Position</a></li> -->
                                        <!--  -->
                                        <!-- <li><a href="<?php echo base_url();?>organization/AccountType">Account Type</a></li> -->
                                        <li><a href="<?php echo base_url();?>organization/Nationality">Nationality</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Language">Language</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Education">Education Level</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Course">Course</a></li>
                                        <li><a href="<?php echo base_url();?>organization/GovermentID">Goverment ID</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Currency">Currency</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Allowance_master">Allowance</a></li>
                                        <li><a href="<?php echo base_url();?>organization/Deduction_master">Deduction</a></li>
                                    </ul>
                                </li>
                            <?php } if($this->role->User_Permission('assets','can_view')){?>
 
                                <!--   <li> <a class="has-arrow waves-effect waves-dark " href="#" aria-expanded="false"><span class="hide-menu">Assets </span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="<?php echo base_url(); ?>Logistice/Assets_Category"> Assets Category </a></li>
                                        <li><a href="<?php echo base_url(); ?>Logistice/All_Assets"> Asset List </a></li>
                                    
                                        <li><a href="<?php echo base_url(); ?>Logistice/logistic_support"> Logistic Support </a></li>
                                    </ul>
                                </li>  -->
                                <?php } if($this->role->User_Permission('timesheet_master','can_view')){?>
                              <!--   <li><a href="<?php echo base_url(); ?>TimeSheet/TimeSheetMaster"> TimeSheet Master</a></li> -->
                                   <?php } if($this->role->User_Permission('salary_type','can_view')){?>
                                    <li><a href="<?php echo base_url(); ?>Payroll/Salary_Type"> Salary Type</a></li>
                                      <?php }?><!-- Expenses_category -->


                                      <li><a href="<?php echo base_url(); ?>Expenses/Expenses_category"> Expenses Category</a></li>
                                   
                                     <?php if($this->role->User_Permission('organisation_info','can_view')){?>

                                      <!-- <li><a href="<?php echo base_url(); ?>Certificate"> Template</a></li> -->
                                           <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Template Master </span></a>
                                            <ul aria-expanded="false" class="collapse">
                                              <li><a href="<?php echo base_url(); ?>Certificate"> Template</a></li>
                                              <li><a href="<?php echo base_url(); ?>Certificate/CreateTags"> Template Tags</a></li>
                                              <li><a href="<?php echo base_url(); ?>Certificate/template_header"> Template Header & Footer</a></li>
                                            </ul>
                                </li>
                                       <?php }?>
                            </ul> 


                        </li>
                          <?php }?>
                        <?php } ?>
                    </ul>
                </nav>

              
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
     

