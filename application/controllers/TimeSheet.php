<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeSheet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
      
        $this->load->model('Timesheet_modal');
        /**/
          $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('leave_model');
        $this->load->model('settings_model');
        $this->load->model('project_model');
        $this->load->model('organization_model');
    }

    public function TimeSheet(){
        $data['employee']    = $this->employee_model->emselect(); 
        $data['monthlytimesheetdata'] = $this->Timesheet_modal->MonthlyTimesheetdata();
         $data['businessunitvalue'] = $this->employee_model->businessunitvalue(); 
    	$this->load->view('backend/timesheet',$data);
    }
	 public function CreateTimesheet(){
	 	$id = $this->input->get('id');
        $em_id = $this->input->get('em_id');
       // print_r($id);die();
        $data['employee']    = $this->employee_model->emselect(); 
        $data['employeeData']    = $this->employee_model->getemp($em_id);
       // print_r($data['employeeData']);die();
           $data['timemasterselect'] = $this->Timesheet_modal->timemasterselect();
        $data['dailytimesheetdata'] = $this->Timesheet_modal->DailyTimesheetview($id);
        // $data['monthlytimedata'] = $this->Timesheet_modal->Monthtimesheetvalue($id);
    	$this->load->view('backend/CreateTimesheet',$data);
	    }


    public function Monthtimesheetib()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id  = $this->input->get('id');
            $data['Monthtimesheetvalue'] = $this->Timesheet_modal->Monthtimesheetvalue($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }    
     public function Dailytimesheetib()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id  = $this->input->get('id');
            $data['Dailytimesheetvalue'] = $this->Timesheet_modal->DailyTimesheetvalue($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }  

	  public function Add_Monthtimesheet(){
	     if ($this->session->userdata('user_login_access') != False) {
	     	$id = $this->input->post('id');
            $emp_id      = $this->input->post('emp_id');
            $month    = $this->input->post('month');
            $busunit    = $this->input->post('busunit');
            //$this->form_validation->set_error_delimiters();
            if($busunit){
                   $this->form_validation->set_rules('busunit', 'Business Unit', 'trim|required|max_length[120]|xss_clean');

            }else{
                  $this->form_validation->set_rules('emp_id', 'Employee', 'trim|required|max_length[120]|xss_clean');

            }
            // echo "working";

            // die();
                      
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("leave/Holidays");
            } else {
                $data = array();
                $data = array(
                    'emp_id' => $emp_id,
                    'month' => $month
                    
                   
                );
            // if($busunit){
            //      $emp_result = $this->employee_model->GetReportEmp($busunit); 
            //          // If $busunit is set, you have a list of employees in $emp_result
            //         foreach ($emp_result as $employee) {
            //             $data = array(
            //                 'emp_id' => $employee->em_id, // Assuming the structure of $emp_result
            //                 'month' => $month,
            //                 // Other data fields you want to insert
            //             );

            //             // Check if data for this employee and month already exists
            //             $val = $month;
            //             $table = 'monthlytimesheet';
            //             $existing_data = array('month' => $month, 'emp_id' => $employee->emp_id, 'isActive' => 1);

            //             if (!$this->organization_model->Check_field_exists($val, $existing_data, $table)) {
            //                 // Data doesn't exist, insert it
            //                 $success = $this->Timesheet_modal->Add_Monthtimesheet($data);

            //                 if ($success) {
            //                     echo json_encode(array('status' => 'success', 'message' => 'Successfully Added '));
            //                 } else {
            //                     echo json_encode(array('status' => 'error', 'message' => 'Failed to Add ' ));
            //                 }
            //             } else {
            //                 echo json_encode(array('status' => 'error', 'message' => 'Data already exists for Employee ID: ' . $employee->emp_id));
            //             }
            //         }

            // }else{
            $has_error = false; // Initialize a flag to track errors
            $existing_data = false;
            if ($busunit) {
                $emp_result = $this->employee_model->GetReportEmp($busunit);

                // If $busunit is set, you have a list of employees in $emp_result
                foreach ($emp_result as $employee) {
                    $data = array(
                        'emp_id' => $employee->em_id, // Assuming the structure of $emp_result
                        'month' => $month,
                        // Other data fields you want to insert
                    );

                    // Check if data for this employee and month already exists
                    $val = $month;
                    $table = 'monthlytimesheet';
                    $existing_data = array('month' => $month, 'emp_id' => $employee->em_id, 'isActive' => 1);

                    if (!$this->organization_model->Check_field_exists($val, $existing_data, $table)) {
                        // Data doesn't exist, insert it
                        $success = $this->Timesheet_modal->Add_Monthtimesheet($data);

                        if (!$success) {
                            $has_error = true; // Set the flag to true if an error occurs
                        }
                    } else {
                        $existing_data = true;
                       // echo json_encode(array('status' => 'error', 'message' => 'Data already exists for Employee ID: ' . $employee->em_id));
                    }
                }

                if (!$has_error) {
                    echo json_encode(array('status' => 'success', 'message' => 'Successfully Added'));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Failed to Add'));
                }
                if($existing_data){
                    //echo json_encode(array('status' => 'error', 'message' => 'Data already exists '));
                }
            } else {
            $val = $month;
            $table = 'monthlytimesheet';
            $data = array('month'=> $month,'emp_id'=>$emp_id,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Month  is already exists</p>'));
            } else {

                 if (empty($id)) {
                $success = $this->Timesheet_modal->Add_Monthtimesheet($data);

                    if($success){

                    echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                    }

                    } else {
                    $success = $this->Timesheet_modal->Update_Monthtimesheet($id, $data);

                    if($success){
                    echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                    }
                  }

                }
                
            }
            }
        
        } else {
            redirect(base_url(), 'refresh');
        }
	    }  
     public function Monthlytimesheetdelete(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $month = $this->input->post('month');
        $emp = $this->input->post('emp');
        $result_del = $this->Timesheet_modal->Monthlytimesheetdelete($id,$month, $emp);//
        if($result_del){
        echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
        
        }else{
        echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
        
        }
        
        }
        else{
        redirect(base_url() , 'refresh');
        }
        }
        
	    public function Add_Dailytimesheet(){
	     if ($this->session->userdata('user_login_access') != False) {
	     	$id = $this->input->post('id');
	     	$month_id = $this->input->post('month_id');
            $emp_id      = $this->input->post('emp_id');
            $monthval    = $this->input->post('timesheetmonth');
            $date    = $this->input->post('date');
            //$this->form_validation->set_error_delimiters();
                     
                $data1 = array(
                    'emp_id' => $emp_id,
                    'month_id' => $month_id,
                    'timesheetmonth' => $monthval,
                    'date' => $date
                    
                   
                );

           $this->form_validation->set_rules('emp_id', 'Employee', 'trim|required|max_length[120]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("leave/Holidays");
            } else {
             
                if (empty($id)) {

                        $val = $date;
                        $table = 'dailytimesheet';
                        $data = array('date'=> $val,'isActive'=> 1,'month_id'=>$month_id);
                        if($this->employee_model->Check_field_exists($val,$data,$table)){
                        echo json_encode(array('error'=>'<p>This date  is already exists</p>'));
                        } else{
                        
                        $success = $this->Timesheet_modal->Add_Dailytimesheet($data1);
                         if($success){
                           
                            echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                            }  
                        }
                  
                    
                } else {
                    $success = $this->Timesheet_modal->Update_Dailytimesheet($id, $data1);
         
                     if($success){
                           echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                            }  
                }
                
            }
        } else {
            redirect(base_url(), 'refresh');
        }
	    }

	    //timesheet details

    public function Add_timesheet_details()
    {
      if($this->session->userdata('user_login_access') != False) { 

         $emp_id = $this->input->post('emp_id');
         $daily_id = $this->input->post('daily_id');
         $punchname = $this->input->post('punchname');
         $punchtime = $this->input->post('punchtime');
         $punchdescription = $this->input->post('punchdescription');
         $month = $this->input->post('month');
         $month_id = $this->input->post('month_id');
         $startdate = $this->input->post('startdate');
         //login,logout
         $login = $this->input->post('login');
         $breakin = $this->input->post('breakin');
         $breakout = $this->input->post('breakout');
         $logout = $this->input->post('logout');
     
            //multiple inputs
     /*       foreach($punchname as $index => $value)
            {
                $s_punchname = $value;
                $s_punchtime = $punchtime[$index];
                $s_punchdescription = $punchdescription[$index];
                $data = array(
                    'emp_id' => $emp_id,
                    'daily_id' => $daily_id,
                    'punchname' => $s_punchname,
                    'punchtime' => $s_punchtime,
                    'punchdescription' => $s_punchdescription,
                    'month' => $month,
                    'month_id' => $month_id,
                    'startdate' => $startdate
                    
                );
                 $success = $this->Timesheet_modal->Add_Timedetails($data);
            }*/
            if($this->input->post('punchdescription')){
               $data = array(
                    'emp_id' => $emp_id,
                   //'daily_id' => $daily_id,
                   'login' => $login,
                   'breakin' => $breakin,
                   'breakout' => $breakout,
                   'logout' => $logout,
                  'punchdescription' => $punchdescription,
                    'month' => $month,
                    'month_id' => $month_id,
                    'startdate' => $startdate
                    
                );
             }else{
                  $data = array(
                    'emp_id' => $emp_id,
                
                   'login' => $login,
                   'breakin' => $breakin,
                   'breakout' => $breakout,
                   'logout' => $logout,
            
                    'month' => $month,
                    'month_id' => $month_id,
                    'startdate' => $startdate
                    
                );
             }
               $success = $this->Timesheet_modal->Add_Timedetails($data);

        if($success){
            echo json_encode(array('status'=>'success','message'=>' Added Successfully '));
            } 
       
       
       }

    }
    //Add leave
    public function Add_timesheetleave(){
         if($this->session->userdata('user_login_access') != False) {

            $emp_id = $this->input->post('emp_id');
             $punchdescription = $this->input->post('punchdescription');
             $month = $this->input->post('month');
             $month_id = $this->input->post('month_id');
             $startdate = $this->input->post('startdate');

            $data = array(
                    'emp_id' => $emp_id,
                    'punchdescription' => $punchdescription,
                    'month' => $month,
                    'month_id' => $month_id,
                    'startdate' => $startdate
                    
                );

                 $success = $this->Timesheet_modal->Add_Timedetails($data);
                 if($success){
            echo json_encode(array('status'=>'success','message'=>' Added Successfully '));
            } 
         }
    }
    //delete timesheet leave
    public function TimsheetLeaveDelete(){
    if($this->session->userdata('user_login_access') != False) { 
    $id = $this->input->post('id');
    $result_del = $this->Timesheet_modal->TimsheetLeaveDelete($id);//
    if($result_del){
        echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
       
    }else{
         //echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
     
    }

    }
    else{
    redirect(base_url() , 'refresh');
    }            
    }
    //get allowance
    public function Get_timesheet(){
         if($this->session->userdata('user_login_access') != False) {

            $emid = $this->input->get('emid');
            $daily_id = $this->input->get('daily_id');

            $startdate = $this->input->get('date');

            $getdata = $this->Timesheet_modal->Get_timesheet($emid,$startdate);//,$daily_id

            function limitTextWithEllipsis($text, $maxLength) {
            if (strlen($text) > $maxLength) {
                $text = substr($text, 0, $maxLength - 3) . '...';
            }
            return $text;
        }

            if($getdata){
                $i = 1;
                 foreach($getdata as $value){
                    $maxLength = 25;

                   echo' <tr>
                  <td scope="row">'.$i.'</td>
                  <td>'.$value->login.'</td>
                  <td>'.$value->breakin.'</td>
                  <td>'.$value->breakout.'</td>
                  <td>'.$value->logout.'</td>
                  <td>'.  limitTextWithEllipsis($value->punchdescription, $maxLength).'</td>
                  

                  <td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delsheetdetails" data-id="'.$value->details_id.'"><i class="fa fa-trash-o"></i></button></td>
                </tr>';
                
                $i++; }

            }

         }
    }
    //old
    /*public function Get_timesheet(){
         if($this->session->userdata('user_login_access') != False) {

            $emid = $this->input->get('emid');
            $daily_id = $this->input->get('daily_id');

            $startdate = $this->input->get('date');

            $getdata = $this->Timesheet_modal->Get_timesheet($emid,$startdate);//,$daily_id
            if($getdata){
                $i = 1;
                 foreach($getdata as $value){
                   echo' <tr>
                  <td scope="row">'.$i.'</td>
                  <td>'.$value->typename.'</td>
                  <td>'.$value->punchtime.'</td>
                  <td>'.$value->punchdescription.'</td>

                  <td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delsheetdetails" data-id="'.$value->details_id.'"><i class="fa fa-trash-o"></i></button></td>
                </tr>';
                
                $i++; }

            }

         }
    }*/
    public  function load()
     {

     $emid       = $this->input->get('emid');
     $month      = $this->input->get('month');

      $event_data =  $this->Timesheet_modal->Get_timesheet_event($emid,$month);
     //s echo '<pre>';print_r($event_data); echo '</pre>';die();
      $i = 1;
      foreach($event_data as $row)

      {
        $arr = array($row->login,$row->breakin,$row->breakout,$row->logout);
       //  echo '<pre>';print_r($arr); echo '</pre>';die();
          foreach($arr as $val){
          //   echo '<pre>';print_r($val); echo '</pre>';
       if($val){
       $data[] = array(
        'id' => $i,
        'dataid' => $row->id,
        'title' =>  $val, //$row->login.'   '.$row->breakin.' '.$row->breakout.'  '.$row->logout,
        'start' => $row->startdate,
        'className'=> 'bg-primary',
        'allDay'=> false      
         );
        }
        }
       $i++;
      }
      /*new*/

      $leave_event = $this->Timesheet_modal->timesheet_leave_event($emid,$month);
      //echo '<pre>';print_r($leave_event); echo '</pre>';die();
      $j = 1;
      foreach($leave_event as $row)
      {
       $data[] = array(
        'id' => $j,
        'dataid' => $row->id,
        'title' => $row->name,
        'start' => $row->start_date,
        'end' => ($row->end_date) ? date("Y-m-d", strtotime($row->end_date . " +1 day")):'', // add 1 day $row->end_date,
         'className'=> 'bg-info '      /*leave_event_del*/
         );
       $j++;
      }
      //All holiday new
      //get emp id // $emid 
       
      //get busunit id
      $get_busunit = $this->Timesheet_modal->Get_employee_busunit($emid);
     
     // print_r($get_busunit->busunit);
       $busid = $get_busunit->busunit;
      //get holiday struct id
       $get_holidaystruc = $this->Timesheet_modal->Get_employee_holidaystruc($busid);// print_r($get_holidaystruc->holidaystructureid);
       $holidaystruc_id = $get_holidaystruc->holidaystructureid;

      $All_holiday_data =  $this->employee_model->Get_holidays($holidaystruc_id);
      //echo '<pre>';print_r($All_holiday_data); echo '</pre>';die();
      $i = 1;
      foreach($All_holiday_data as $row)

      {
      
       $data[] = array(
        'id' => $i,
        'dataid' => $row->id,
        'title' =>  $row->holiday_name,
        'start' => $row->from_date,
         'end' => ($row->to_date) ? date("Y-m-d", strtotime($row->to_date . " +1 day")) : '', // add 1 day
        'className'=> 'bg-info',
        'allDay'=> false      
         );
        
       $i++;
      }
     
      /*---holiday new--*/

      // holiday asign data specific
       $holiday_data =  $this->employee_model->Get_employee_event_by_emp($emid);
      //echo '<pre>';print_r($event_data); echo '</pre>';die();
      $i = 1;
      foreach($holiday_data as $row)

      {
      
       $data[] = array(
        'id' => $i,
        'dataid' => $row->id,
        'title' =>  ucwords($row->first_name).' HOLIDAY',
        'start' => $row->date,
        'className'=> 'leave_event_del bg-'.$row->color,//isset($row->color) ? ''.$row->color.'' : 'primary',//
        'allDay'=> false      
         );
        
       $i++;
      }



      echo json_encode($data);
     }

    //delete allowance
    public function deletetimesheetdetails(){
        if($this->session->userdata('user_login_access') != False) { 
             $id = $this->input->post('id');
              $result = $this->Timesheet_modal->deletetimesheetdetails($id);
              if($result){
                echo json_encode(array('status'=>'success','message'=>'Successfully Deleted'));
              }
        }

    }
    //Time sheet Report
    public function TimesheetReport()
    {
        $data['employee'] = $this->employee_model->emselect();
        $this->load->view('backend/timesheet_report',$data);
    }


     public function load_employee_timesheet(){
    if($this->session->userdata('user_login_access') != False) {

     $eid         = $this->input->get('emid');
    $month      = $this->input->get('date_time');

    $get_timesheet_info = $this->Timesheet_modal->getTimesheetDataByMonth($eid,$month); 
    if( $get_timesheet_info){
         $getdata = explode('-', $get_timesheet_info->month);
            $gmonth = $getdata[0];
            $gyear = $getdata[1];
        echo '<tr>
        
        <td>'.$get_timesheet_info->em_code.'</td>
        <td>'.$get_timesheet_info->first_name .' '.$get_timesheet_info->last_name.'</td>
        <td>'.date("F Y", strtotime($gyear.'-'.$gmonth)).'</td>
        <td><a href="'.base_url('TimeSheet/ExportTimesheet?eid='.$eid.'&&month='.$month).'" title="Report" class="btn btn-sm btn-info waves-effect waves-light" target="_blank"><i class="fa fa-file-excel-o"></i></a></td>
          </tr>';
    }else{
        echo "<tr>
                    <td colspan='4' style='text-align:center'>No Data Found</td>
                 
                   
                </tr>";
    }/*.base_url().'Payroll/Pdf?Id='.$get_timesheet_info->pay_id.'&em='.$get_timesheet_info->em_id.*/

    }
  }


  //Master

      public function TimeSheetMaster(){
        if($this->session->userdata('user_login_access') != False) { 
         $data['timemasterselect'] = $this->Timesheet_modal->timemasterselect();
        $this->load->view('backend/timesheet_master',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
    }

    public function Save_timemaster(){
        if($this->session->userdata('user_login_access') != False) { 
           $typename = $this->input->post('typename');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('typename',' name','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $typename;
            $table = 'timesheet_master';
            $data = array('typename'=> $val,'isActive'=> 1);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Type is already exists</p>'));
            } else{
            $data = array();
            $data = array('typename' => $typename);
            $success = $this->Timesheet_modal->Add_timemaster($data);//
            if($success){
                echo json_encode(array('status'=>'success','message'=>$success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_timemaster(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
             $typename = $this->input->post('typename');
            $this->form_validation->set_rules('typename', 'name', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('typename' => $typename );
            $dep_result = $this->Timesheet_modal->Update_timemaster($id, $data);//
            if( $dep_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_timemaster(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->Timesheet_modal->timemaster_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                // echo json_encode(array('status'=>'failed','message'=> 'This Country Already Used In State'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function timesheet_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $dep = $this->uri->segment(3);//
           $data['timemasterselect'] = $this->Timesheet_modal->timemasterselect();
            $data['timemaster_edit'] =$this->Timesheet_modal->timemaster_edit($dep);//
         
            $this->load->view('backend/timesheet_master', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
  

 public function ExportTimesheet(){
  if($this->session->userdata('user_login_access') != False) {
     $this->load->library('Excel');

      $eid = $this->input->get('eid');
      $month = $this->input->get('month');

       $employee_info      = $this->Timesheet_modal->getempvalue($eid);

       $getmonthdata = explode('-', $month);
        $gmonth = $getmonthdata[0];
        $gyear = $getmonthdata[1];

       $get_info = $this->Timesheet_modal->getTimesheetExcel($eid,$month); //print_r($get_info);die();
        
             // Read an Excel File
        $tmpfname = "example.xls";
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $objPHPExcel = $excelReader->load($tmpfname);
        
       // Create a first sheet
        $objPHPExcel->setActiveSheetIndex(0);
      
      //auto size
          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
          $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        // Add data

       //punch in punch out
        $timemasterselect = $this->Timesheet_modal->timemasterselect();


       //Dates
       /*  
       for($a = 1,$ab= 4; $a <= 31,$ab<=34; $a++,$ab++){
           $objPHPExcel->getActiveSheet()->setCellValue('A'.$ab, $a);
          }
*/
       //punch names

        $pi= 6;
          $b = 'B';
        foreach ($timemasterselect as  $value) {
           $objPHPExcel->getActiveSheet()->setCellValue($b.'3', $value->typename);
           $punch[] = $value->id; 
           $b++;
            $pi++;
         }
         /*new*/

         //date
         $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date');//A3

         //Description
         $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Description');//F3
          
        

         /*new*/


         //now
           //$c = 'B';
            $i= 4;
          $get_checkin =  $this->Timesheet_modal->getTimesheetData($eid,$month);
           //echo '<pre>';print_r($get_checkin);die();

          /**/

           $leave_event = $this->Timesheet_modal->month_leave_event($eid,$month);
           //echo '<pre>';print_r($leave_event);die();

           foreach ($leave_event as $obj) {
              $obj->startdate = $obj->start_date;
            }
          
          //emp holiday data

            $holiday_data =  $this->Timesheet_modal->Get_employee_event_month($eid,$month);

            foreach ($holiday_data as $obj) {
              $obj->startdate = $obj->date;
            }

            /*New all holiday*/
            //get busunit id
              $emid =  $eid;
              $get_busunit = $this->Timesheet_modal->Get_employee_busunit($emid);
             
             // print_r($get_busunit->busunit);
               $busid = $get_busunit->busunit;
              //get holiday struct id
               $get_holidaystruc = $this->Timesheet_modal->Get_employee_holidaystruc($busid);// print_r($get_holidaystruc->holidaystructureid);
               $holidaystruc_id = $get_holidaystruc->holidaystructureid;

              $All_holiday_data =  $this->employee_model->Get_holidaysbymonth($holidaystruc_id,$month);

            foreach ($All_holiday_data as $obj) {
              $obj->startdate = $obj->from_date;
            }
             // echo '<pre>';  print_r($All_holiday_data);  echo '</pre>';die();
            /*-- all holiday*/


            
            $result = array_merge($get_checkin, $leave_event,$holiday_data,$All_holiday_data); //echo '<pre>';print_r($result);die();


            $arr = json_decode(json_encode($result), true);

            ///  echo '<pre>';  print_r($arr);  echo '</pre>';die();


                // Define a custom sorting function that compares the 'date' values
                function compare_dates($a, $b) {
                  return strtotime($a['startdate']) - strtotime($b['startdate']);
                }

                // Sort the array using the custom sorting function
                usort($arr, 'compare_dates');
           //echo '<pre>';  print_r($arr);  echo '</pre>';die();

              /*color code*/
               $objPHPExcel->getActiveSheet()->setCellValue('D37', 'HOLIDAY');
               $objPHPExcel->getActiveSheet()->setCellValue('D38', 'LEAVE');
               $objPHPExcel->getActiveSheet()->setCellValue('D39', 'OVERTIME');
               $objPHPExcel->getActiveSheet()->setCellValue('D40', 'SICK');
               $objPHPExcel->getActiveSheet()->setCellValue('D41', 'PAIDLEAVE');

            $objPHPExcel->getActiveSheet()->getStyle('B37')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('b60f07');
            $objPHPExcel->getActiveSheet()->getStyle('B38')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFF426');
            $objPHPExcel->getActiveSheet()->getStyle('B39')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('087123');
            $objPHPExcel->getActiveSheet()->getStyle('B40')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('bc8217');
            $objPHPExcel->getActiveSheet()->getStyle('B41')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0EBDFF');



           // echo '<pre>';print_r($arr); echo '</pre>';die();
           
          /**/


         $v1 = 'B';
         
          $i= 4;;
          foreach( $arr as $loginval){ //$get_checkin
            $objPHPExcel->getActiveSheet()->setCellValue('B'. $i,$loginval['login']);//$loginval->login
            $objPHPExcel->getActiveSheet()->setCellValue('C'. $i,$loginval['breakin']);//$loginval->breakin
            $objPHPExcel->getActiveSheet()->setCellValue('D'. $i,$loginval['breakout']);//$loginval->breakout
            $objPHPExcel->getActiveSheet()->setCellValue('E'. $i,$loginval['logout']);//$loginval->logout
            $objPHPExcel->getActiveSheet()->setCellValue('F'. $i,$loginval['punchdescription']);//$loginval->punchdescription
           /**/
            if($loginval['name']){
              $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $loginval['name'])->getStyle('B'.$i)->getFont()->getColor()->setRGB ('0000');
             $objPHPExcel->getActiveSheet()->getStyle('B'.$i.':F'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFF426');
            } 
            if(($loginval['name'] == 'Sick' && $loginval['document_status'] == 1) || $loginval['document_status'] == 1){
              //$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $loginval['name']);
             $objPHPExcel->getActiveSheet()->getStyle('B'.$i.':F'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('bc8217');
            }
            /**/
            //holiday
            if($holiday_data && $loginval['first_name']){
                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $loginval['first_name'].' HOLIDAY')->getStyle('B'.$i)->getFont()->getColor()->setRGB ('0000');
             $objPHPExcel->getActiveSheet()->getStyle('B'.$i.':F'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('b60f07');
              }
            //holiday
             if($All_holiday_data && $loginval['holiday_name']){
                 $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $loginval['holiday_name'])->getStyle('B'.$i)->getFont()->getColor()->setRGB ('0000');
             $objPHPExcel->getActiveSheet()->getStyle('B'.$i.':F'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('b60f07');
              }



           $vl = 1;
           
            $v1++;

           $i++;

          
          /*---*/
         }
          //$f = 'F';
          $f = 'A';
          $j= 4;
            foreach ($arr as  $value) {//$get_checkin
               $objPHPExcel->getActiveSheet()->setCellValue($f. $j,date('d  M Y',strtotime($value['startdate']))); //$value->startdate
             
               $j++;
                
             }

   

          // Set Font Color, Font Style and Font Alignment
        $stil=array(
    /*        'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
              )
            ),*/
            'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($stil);

        // Employee
        $objPHPExcel->getActiveSheet()->mergeCells('K2:N2');
        $objPHPExcel->getActiveSheet()->setCellValue('K2',  $employee_info->first_name.$employee_info->last_name);
        $objPHPExcel->getActiveSheet()->getStyle('K2:N2')->applyFromArray($stil);
        $objPHPExcel->getActiveSheet()->getStyle("K1:N1")->getFont()->setSize(14);

       //Month Title
        $objPHPExcel->getActiveSheet()->mergeCells('K1:N1');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', date("F Y", strtotime($gyear.'-'.$gmonth)));
        $objPHPExcel->getActiveSheet()->getStyle('K1:N1')->applyFromArray($stil);
        $objPHPExcel->getActiveSheet()->getStyle("K1:N1")->getFont()->setSize(16);
        
        // Save Excel xls File
        $filename='Timsheet('.date("F Y", strtotime($gyear.'-'.$gmonth)).').xls';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
    }
    }


    //Sample Timesheet
     public function SampleTimesheet(){
    if($this->session->userdata('user_login_access') != False) {
     $this->load->library('Excel');

     
             // Read an Excel File
        $tmpfname = "example.xls";
        $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        $objPHPExcel = $excelReader->load($tmpfname);
        
       // Create a first sheet
        $objPHPExcel->setActiveSheetIndex(0);
      
      //auto size
          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
          $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        // Add data

       //punch in punch out
        $timemasterselect = $this->Timesheet_modal->timemasterselect();


       //punch names

        $pi= 2;
          $b = 'A';
        foreach ($timemasterselect as  $value) {
           $objPHPExcel->getActiveSheet()->setCellValue($b.$pi, $value->typename);
           $punch[] = $value->id; 
         
            $pi++;
         }

           $objPHPExcel->getActiveSheet()->setCellValue('A1', 'punchname');
           $objPHPExcel->getActiveSheet()->setCellValue('B1', 'punchtime');
           $objPHPExcel->getActiveSheet()->setCellValue('C1', 'punchdescription');
           $objPHPExcel->getActiveSheet()->setCellValue('D1', 'startdate');
        
      

          // Set Font Color, Font Style and Font Alignment
        $stil=array(
   
            'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
   

     
        
        // Save Excel xls File
        $filename='SampleTimsheet.xls';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save('php://output');
    }
    }


    //import
    public function importFile(){

    $emp_id = $this->input->post('emp_id');
    $daily_id = $this->input->post('daily_id');
    //$punchname = $this->input->post('punchname');
    //$punchtime = $this->input->post('punchtime');
    ///$punchdescription = $this->input->post('punchdescription');
    $month = $this->input->post('month');
    $month_id = $this->input->post('month_id');
    //$startdate = $this->input->post('startdate');

   // if ($this->input->post('submit')) {
    $path = 'assets/uploads/';
    //require_once APPPATH . "/third_party/PHPExcel.php";
     $this->load->library('Excel');
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);            
    if (!$this->upload->do_upload('uploadFile')) {
    $error = array('error' => $this->upload->display_errors());
    } else {
    $data = array('upload_data' => $this->upload->data());
    }
    if(empty($error)){
    if (!empty($data['upload_data']['file_name'])) {
    $import_xls_file = $data['upload_data']['file_name'];
    } else {
    $import_xls_file = 0;
    }
    $inputFileName = $path . $import_xls_file;
    try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    $flag = true;
    $i=0;
    // foreach ($allDataInSheet as $value) {
    // if($flag){
    // $flag =false;
    // continue;
    // }

    // // // Skip the row if any of the required columns are empty
    // // if (empty($value['A']) || empty($value['B']) || empty($value['C'])|| empty($value['D']) || empty($value['E'])|| empty($value['F'])) {
    // //     continue;
    // // }

    // $punch = $value['A'];
    // //punch in punch out
    // // $timemasterselect = $this->Timesheet_modal->punchid($punch);

    //  //$punchid = $timemasterselect->id; //echo $punchid;die();

    //  /*Date*/
    //  $input_date = $value['A'];
    //  $date = new DateTime($input_date); // Create a DateTime object from the input date
    //  $formatted_date = $date->format("Y-m-d"); // Format the date as "YYYY-MM-DD"


    //  ///echo $value['D'];die();
    //  $inserdata[$i]['emp_id'] = $emp_id;
    //  $inserdata[$i]['month'] = $month;
    //  $inserdata[$i]['month_id'] = $month_id;
    //  $inserdata[$i]['login'] = trim($value['B']);
    //  $inserdata[$i]['logout'] = trim($value['C']);
    //  $inserdata[$i]['breakin'] = trim($value['E']);
    //  $inserdata[$i]['breakout'] = trim($value['D']);


    // //$inserdata[$i]['punchname'] = $punchid;//$value['A'];
    // //$inserdata[$i]['punchtime'] = $value['B'];
    // if($value['F']){
    // $inserdata[$i]['punchdescription'] = $value['F'];
    // }
    // $inserdata[$i]['startdate'] = $formatted_date;//$value['D'];
    // $i++;

     
    // }
    foreach ($allDataInSheet as $value) {
    if($flag){
        $flag =false;
        continue;
    }

    /* Date */
    $input_date = $value['A'];
    $date = new DateTime($input_date);
    $formatted_date = $date->format("Y-m-d");

    $inserdata[$i]['emp_id'] = $emp_id;
    $inserdata[$i]['month'] = $month;
    $inserdata[$i]['month_id'] = $month_id;

    /* Login */
    if (!empty($value['B'])) {
        $inserdata[$i]['login'] = trim($value['B']);
    }

    /* Logout */
    if (!empty($value['C'])) {
        $inserdata[$i]['logout'] = trim($value['C']);
    }

    /* Break in */
    if (!empty($value['E'])) {
        $inserdata[$i]['breakin'] = trim($value['D']);
    }

    /* Break out */
    if (!empty($value['D'])) {
        $inserdata[$i]['breakout'] = trim($value['E']);
    }

    /* Punch description */
    if (!empty($value['F'])) {
        $inserdata[$i]['punchdescription'] = $value['F'];
    }

    /* Start date */
    $inserdata[$i]['startdate'] = $formatted_date;

    $i++;
   }
    // echo '<pre>';
    //  print_r($inserdata); die();

     $result = $this->Timesheet_modal->insert($inserdata);   

       // Delete the file after importing data
        unlink($inputFileName);
    
    /*modal*/

   // $result = $this->Timesheet_modal->insert($inserdata);   
    

    if($result){
    //echo "Imported successfully";
        redirect(base_url() . 'TimeSheet/TimeSheet');
    }else{
    //echo "ERROR !";
    //echo '<script>alert("Not Added!!!"); window.location.href = "TimeSheet/TimeSheet";</script>';
        print_r($this->db->error());
        exit;

    }
  
          
    } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
    . '": ' .$e->getMessage());
    }
    }else{
    echo $error['error'];
    }
    }
    //$this->load->view('import');
    //}
       

    // Import bulk

  
    public function BulkImportTimesheet(){
 
    // $emp_id = $this->input->post('emp_id');
    // $daily_id = $this->input->post('daily_id');

    // $month = $this->input->post('month');
    // $month_id = $this->input->post('month_id');
    //$startdate = $this->input->post('startdate');

   // if ($this->input->post('submit')) {
    $path = 'assets/uploads/';
    //require_once APPPATH . "/third_party/PHPExcel.php";
     $this->load->library('Excel');
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'xlsx|xls|csv';
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);            
    if (!$this->upload->do_upload('uploadFile')) {
    $error = array('error' => $this->upload->display_errors());
    } else {
    $data = array('upload_data' => $this->upload->data());
    }
    if(empty($error)){
    if (!empty($data['upload_data']['file_name'])) {
    $import_xls_file = $data['upload_data']['file_name'];
    } else {
    $import_xls_file = 0;
    }
    $inputFileName = $path . $import_xls_file;
    try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    $flag = true;
    $i=0;

    foreach ($allDataInSheet as $value) {
    if($flag){
        $flag =false;
        continue;
    }

    //print_r($value['C']);
 
    /* Date */
    if (!empty($value['A'])){
     $input_date = $value['A'];
    $date = new DateTime($input_date);
    $formatted_date = $date->format("Y-m-d"); 
    } 
 
   //new
     if (!empty($value['C']) && !empty($value['D'])) {
    $inserdata[$i]['emp_id'] = trim($value['C']);//$emp_id;
    $inserdata[$i]['month'] =  date('m-Y', strtotime('01-'.$value["D"]));//trim($value['D']); //$month;

   // new
    $emp_id = trim($value['C']); // Assuming $value['B'] contains the emp_id
    $month =  date('m-Y', strtotime('01-'.$value["D"]));//trim($value['C']); // Assuming $value['D'] contains the month
    //$month =  trim($value['C']); // Assuming $value['C'] contains the month

    $data_to_insert = array(
        'emp_id' => $emp_id,
        'month' => date('m-Y', strtotime("01-$month")),//$month,
      
    );
    //print_r($emp_id);
    $val = $month;
    $table = 'monthlytimesheet';
    $existing_data = array('month' => $month, 'emp_id' => $emp_id, 'isActive' => 1);

    if (!$this->organization_model->Check_field_exists($val, $existing_data, $table)) {
    $month_data = $this->db->insert('monthlytimesheet', $data_to_insert); //new

    $last_insert_id = $this->db->insert_id(); 
    }else{
        //new
        // Data already exists, so find the ID
        $this->db->select('id');
        $this->db->from('monthlytimesheet');
        $this->db->where('month', $month);
        $this->db->where('emp_id', $emp_id);
        $this->db->where('isActive', 1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $last_insert_id = $row->id;
        } else {
            // Data not found
            $last_insert_id = null;
        }

    }
    }
  
    $inserdata[$i]['month_id'] = $last_insert_id;

    /* Login */
    if (!empty($value['E'])) {
        $inserdata[$i]['login'] = trim($value['E']);
    }

    /* Logout */
    if (!empty($value['F'])) {
        $inserdata[$i]['logout'] = trim($value['F']);
    }

    /* Break in */
    if (!empty($value['G'])) {
        $inserdata[$i]['breakin'] = trim($value['G']);
    }

    /* Break out */
    if (!empty($value['H'])) {
        $inserdata[$i]['breakout'] = trim($value['H']);
    }

    /* Punch description */
    if (!empty($value['I'])) {
        $inserdata[$i]['punchdescription'] = $value['I'];
    }

    /* Start date */
    $inserdata[$i]['startdate'] = $formatted_date;

    $i++;
   }
    // echo '<pre>';
    //  print_r($inserdata); die();

     $result = $this->Timesheet_modal->insert($inserdata);   

       // Delete the file after importing data
        unlink($inputFileName);
    
    /*modal*/

   // $result = $this->Timesheet_modal->insert($inserdata);   
    

    if($result){
   // echo "Imported successfully";
        redirect(base_url() . 'TimeSheet/TimeSheet');
    }else{
    //echo "ERROR !";
    //echo '<script>alert("Not Added!!!"); window.location.href = "TimeSheet/TimeSheet";</script>';
        print_r($this->db->error());
        exit;

    }
  
          
    } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
    . '": ' .$e->getMessage());
    }
    }else{
    echo $error['error'];
    }
  }
    //Sample Timesheet
    //  public function SampleBulksTimesheet($busunit = null){
    // if($this->session->userdata('user_login_access') != False) {
    //  $this->load->library('Excel');

     
    //          // Read an Excel File
    //     $tmpfname = "example.xls";
    //     $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    //     $objPHPExcel = $excelReader->load($tmpfname);
        
    //    // Create a first sheet
    //     $objPHPExcel->setActiveSheetIndex(0);
      
    //   //auto size
    //       $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    //       $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

    //     // Add data

    //    //punch in punch out
    //     $timemasterselect = $this->Timesheet_modal->timemasterselect();


    //    //punch names

    //     if ($busunit) {
    //      $emp_result = $this->employee_model->GetReportEmp($busunit);
    //        $pi= 2;
    //       $a = 'A';
    //       $b = 'B';
    //       $c = 'C';
    //       $d = 'D';
    //     foreach ($emp_result as  $value) {
    //        $objPHPExcel->getActiveSheet()->setCellValue($b.$pi, $value->first_name.' '.$value->last_name);
    //        $objPHPExcel->getActiveSheet()->setCellValue($c.$pi, $value->em_id);
    //        $objPHPExcel->getActiveSheet()->setCellValue($d.$pi, date('M-y'));
    //        $objPHPExcel->getActiveSheet()->setCellValue($a.$pi, date("d-m-Y"));
           
    //        $pi++;
    //      }
    //     }

    //        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Date');
    //       //$objPHPExcel->getActiveSheet()->setCellValue('A2', '01-09-2023');
    //        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Employee');
    //        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Employee ID');
    //        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Month');
    //        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Login');
    //        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Logout');
    //        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Break In');
    //        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Break Out');
    //        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Description');
    //        //Break In //Break Out   Description


        
      

    //       // Set Font Color, Font Style and Font Alignment
    //     $stil=array(
   
    //         'alignment' => array(
    //           'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    //         )
    //     );
   

     
        
    //     // Save Excel xls File
    //     $filename='SampleBulkTimsheet-'.date('M-y').'.xls';
    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    //     ob_end_clean();
    //     header('Content-type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment; filename='.$filename);
    //     $objWriter->save('php://output');
    // }
    // }
public function SampleBulksTimesheet($busunit = null)
{
    if ($this->session->userdata('user_login_access') != False) {
        $this->load->library('Excel');

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("Your Name")
                                     ->setLastModifiedBy("Your Name")
                                     ->setTitle("Sample Bulk Timesheet")
                                     ->setSubject("Timesheet Data")
                                     ->setDescription("Timesheet data for the current month")
                                     ->setKeywords("timesheet, export, excel")
                                     ->setCategory("Timesheet");

        // Add data
        $objPHPExcel->setActiveSheetIndex(0);

        // Set column auto size
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        // Set column headers
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Date');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Employee');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Employee ID')->getColumnDimension('C')->setVisible(false);
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Month');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Login');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Logout');
       $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Break In');
       $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Break Out');
       $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Description');

        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Get the number of days in the current month
        $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        // Start row index
        $rowIndex = 2;

        // Loop through each day of the month
        for ($day = 1; $day <= $numDays; $day++) {
            $date = date("d-m-Y", mktime(0, 0, 0, $currentMonth, $day, $currentYear));
         
          // Hide Column C
           $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(0);



            // Add data for each employee
            if ($busunit) {
                $emp_result = $this->employee_model->GetReportEmp($busunit);
                foreach ($emp_result as $value) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowIndex, $date);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $rowIndex, $value->first_name . ' ' . $value->last_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $rowIndex, $value->em_id);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $rowIndex, date('M-y'));
                    // Add your logic to populate Login and Logout columns based on your data source
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $rowIndex, ''); // Replace with actual login data
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $rowIndex, ''); // Replace with actual logout data
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $rowIndex, ''); // Replace with actual logout data
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $rowIndex, ''); // Replace with actual logout data
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $rowIndex, ''); // Replace with actual logout data


                    $rowIndex++;
                }
            }

        }

                 

        // Set Font Color, Font Style, and Font Alignment
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );

        $objPHPExcel->getActiveSheet()->getStyle('A1:F' . ($rowIndex - 1))->applyFromArray($style);

        // Save Excel xls File
        $filename = 'SampleBulkTimsheet-' . date('M-y') . '.xls';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=' . $filename);
        $objWriter->save('php://output');
    }
}


}