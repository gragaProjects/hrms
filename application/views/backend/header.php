<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Kolkata');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SHA-HRMS">
    <meta name="author" content="Shahul Jaffer">
    <!-- Favicon icon -->
    <?php $settingsvalue = $this->settings_model->GetSettingsValue(); ?>
    <!-- <link rel="icon" type="image/ico" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.ico"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

    <!--<title><?php echo $settingsvalue->sitetitle; ?></title> -->
    <title>HRMS</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/2.0.46/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="all">
    <!--     <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" media='print'> -->
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
  <!--   <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
     <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />   
    <link href="<?php echo base_url(); ?>assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css" />   
    <link href="<?php echo base_url(); ?>assets/select2/select2.min.css" rel="stylesheet" type="text/css" />   
    <link href="<?php echo base_url(); ?>assets/select2/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />  

   <link href="<?php echo base_url(); ?>assets/wnoty/wnoty.css" rel="stylesheet" type="text/css" />  
   <link href="<?php echo base_url(); ?>assets/wnoty/jquery-confirm.min.css" rel="stylesheet" type="text/css" />  
   <link href="<?php echo base_url(); ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet" type="text/css" />  
   <link href="<?php echo base_url(); ?>assets/css/toast.css" id="theme" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/toast/css/toast.min.css" id="theme" rel="stylesheet">
   
        <!-- Dropzone css -->
    <link href="<?php echo base_url(); ?>assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <!-- new -->
      <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">


        <!-- xeditable css -->
    <link href="<?php echo base_url(); ?>/assets/plugins/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
   
   <style type="text/css">
       .error {
    color: red;
    }
  
   </style>
    <style type="text/css">
   .dataTables_filter label {
    /* width: 450px !important; */
    font-size: 17px;
    }
    .dataTables_wrapper .dataTables_filter input{
    border: 0px solid #fff !important;
    }
   .dataTables_wrapper .dataTables_length select{
        
        border: 0px solid #fff !important;
    }

    .sidebar-nav ul li ul{
        padding: 2px !important;
    }
    .page-titles {

    padding: 5px 15px !important;;
    }
     .left-sidebar {
      
        padding: 60px 20px 0px;
    }
    .container-fluid {
        padding: 0 30px 20px 26px;
        margin: 0 auto;
    }
    .card-header {
        padding-left: 4px;
    }
     #inactive{
        width: 80px;
    } 
    #active{
        width: 80px;
    }



/*.js-switch.on + .switchery {
    height: 10px;
}*/
/* Style the switch handle when the input has the .on class */
.js-switch.on + .switchery > small {

/*    padding-left: 30px; */
    font: normal normal normal 20px/1 FontAwesome;
}


.js-switch.on + .switchery > small::before {
    content: "\f00c";
    position: absolute;
    top: 50%;
    left: 2px;
    transform: translateY(-50%);
    color: #28a745;
    font-size: 17px;
  }
  .js-switch.off + .switchery > small {

/*    padding-left: 30px; */
    font: normal normal normal 20px/1 FontAwesome;
}


.js-switch.off + .switchery > small::before {
    content: "\f00d";
    position: absolute;
    top: 50%;
    left: 4px;
    transform: translateY(-50%);
    color: #f62d51;
    font-size: 17px; 
  }




    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
        <?php 
            $id = $this->session->userdata('user_login_id');
            $basicinfo = $this->employee_model->GetBasic($id); 
            $settingsvalue = $this->settings_model->GetSettingsValue();
            $year =  date('y');
            $y = substr( $year, -2);
            $date = date("m/d/$y");
   
            $leavetoday = $this->leave_model->GetLeaveToday($date); 
            $organisationvalue = $this->settings_model->GetOrganisationValue();
        ?>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" style="text-align: unset;">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><b>
                       <!--  <img src="<?php echo base_url();?>assets/images/logo/logo1.png" alt=""  style= "width: 100px;height: 52px;"/> --><!-- logo/logo1.png height="38"-->
                           <?php if(isset($organisationvalue->logo)){ ?>
                            <img src="<?php echo base_url(); ?>assets/uploads/logo/<?php echo $organisationvalue->logo ?>" style= "width: 100px;height: 52px;">
                            <?php } else { ?>
                            <img src="<?php echo base_url();?>assets/logo.png" alt=""  style= "width: 100px;height: 52px;"/>
                            <?php } ?>
                        </b>
                        <!-- Logo text -->
                        <!-- <span>
                         <img src="<?php echo base_url(); ?>assets/images/<?php echo $settingsvalue->sitelogo; ?>" alt="homepage" class="dark-logo" height="60px" width="100px" />
                          
                         </span> --> </a>
                </div>

                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                   <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li> 
       
                        
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                    <!--  -->
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)" style=" display: none;"><i class="ti-menu"></i></a> </li>
                           <li class="nav-item dropdown">
                          <!--   <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark notifications-button" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a> -->
                           
                           <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark notifications-button" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="mdi mdi-bell" ></i><span class="badge badge-light count" style="background-color:#f42b28 ;color:#fff"></span>
                            </a>

                         
                            <div class="dropdown-menu dropdown-menu-right scale-up mailbox animated ">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center" id="notifications-modal">
                                        
                                  
                                        </div>
                                    </li>
                                  <!--   <li>
                                        <a class="nav-link text-center" href="<?php echo base_url()?>notice/All_notice"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>   

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php if($basicinfo->em_image) {echo $basicinfo->em_image;} ?>" alt="User Image" class="profile-pic" style="height:40px;width:40px;border-radius:50px" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <!-- <div class="u-img"><img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image; ?>" alt="user"></div> -->
                                            <div class="u-text">
                                                <h4><?php echo $basicinfo->first_name.' '.$basicinfo->last_name; ?></h4>
                                                <p class="text-muted"><?php echo $basicinfo->em_email ?></p>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>"><i class="ti-user"></i> My Profile</a></li>
                              
                                    
                                    <!-- <li><a href="<?php echo base_url(); ?>settings/Organisation_Settings"><i class="ti-settings"></i> Account Setting</a></li> --><!-- 
                                    <li><a href="<?php echo base_url(); ?>settings/Settings"><i class="ti-settings"></i> Account Setting</a></li> -->
                             
                                    <li><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
