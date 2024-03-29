<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require FCPATH .'assets/phpmailer/phpmailer/src/Exception.php';
require FCPATH .'assets/phpmailer/phpmailer/src/PHPMailer.php';
require FCPATH .'assets/phpmailer/phpmailer/src/SMTP.php';
class Leave extends CI_Controller
{
    
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('leave_model');
        $this->load->model('settings_model');
        $this->load->model('project_model');
        $this->load->model('organization_model');
          $this->load->model('expense_model');
    }

    public function index()
    {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == 1)
            redirect('dashboard/Dashboard');
        $data = array();
        #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
        $this->load->view('login');
    }
     public function HolidayStructure()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['holidaystruc'] = $this->leave_model->GetAllHolistructure();
            $this->load->view('backend/holidaystructure',$data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function fetch_holidaystructure(){
    $holidaystruc = $this->leave_model->GetAllHolistructure();
     $i = 1;
    
   foreach($holidaystruc as $value): ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $value->holidaystructure ?></td>
       
          <td>
              <?php //echo $value->Active_status; 
               if($value->Active_status == "1"){ ?>
               <button type="button" class="btn btn-primary" id="inactive" value="<?php echo $value->Active_status; ?>" data-id="<?php echo $value->id; ?>" name="inactive" >INACTIVE</button><?php
               }elseif ($value->Active_status == "0"){ ?>
               <button type="button" class="btn btn-info" id="active" value="<?php echo $value->Active_status; ?>" data-id="<?php echo $value->id; ?>" name="active">ACTIVE</button><?php
               }?> 
               
        </td>
        <td class="jsgrid-align-center ">
            <?php if($value->Active_status == "1"){?>
            <a href="" title="Edit" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light holiday " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a> 
            <a href="<?php echo base_url(); ?>leave/Holidays?id=<?php echo base64_encode($value->id)?>" title="Edit" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light  " data-id="<?php echo $value->id; ?>"><i class="fa fa-eye"></i></a>
           <?php }; ?>
        </td>
    </tr>
    <?php $i++; endforeach;
    }


    public function Holidays()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id  = base64_decode($this->input->get('id'));
            $data['holidays'] = $this->leave_model->GetAllHoliInfo($id);
            $this->load->view('backend/holiday',$data);// 
        } else {
            redirect(base_url(), 'refresh');
        }
    } 
     public function HolidayReport()
    {
        if ($this->session->userdata('user_login_access') != False) {
                //$id  = base64_decode($this->input->get('id'));
            //$data['holidays'] = $this->leave_model->GetAllHoliInfo($id);
            $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
            $data['holidaystruc'] = $this->leave_model->GetAllHolistructure();
            $this->load->view('backend/holidayreport',$data);// $data
        } else {
            redirect(base_url(), 'refresh');
        }
    }   
    public function getholidayreport()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $date = $this->input->get('date_time');
            $structureid = $this->input->get('structureid');
            $holidayreport = $this->leave_model->getholidayreport($date,$structureid);
            //$month = date("m",strtotime($date));
            $dateArray = explode('-', $date);
        

            $dateObj = DateTime::createFromFormat('!m', $dateArray[0]);
              
            // Store the month name to variable
            $month = $dateObj->format('F');

          $i = 1;
          if($holidayreport){
              foreach($holidayreport as $value){
        //echo json_encode(array('monthcount'=>count($holidayreport),'month'=>$month,'holdayname'=>$value->holiday_name,));
         echo "<tr>
                    <td>$i</td>
                    <td>$value->holiday_name</td>
                    <td>$month</td>
                    <td>$value->from_date </td>
                    <td>$value->to_date </td>
                    <td>$value->number_of_days</td>
                   
                </tr>";
                $i++;
         }
          }else{
          echo "<tr>
                    <td colspan='6' style='text-align:center'>No Data Found</td>
                 
                   
                </tr>";
          }
  
        } else {
            redirect(base_url(), 'refresh');
        }
    }
      public function fetch_holidays(){
       $id   = $this->input->get('id');
     
        $data = $this->leave_model->GetAllHoliInfo($id);

      }
    public function HolidayDelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->leave_model->HolidayDelete($id);//
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
     public function HolidayStrucDelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->leave_model->HolidayStrucDelete($id);//
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

    public function Holidays_for_calendar()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $result = $this->leave_model->GetAllHoliInfoForCalendar();
            print_r($result);
            die();
            echo jason_encode($result);
           
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    //holiday structure
     public function Add_Holystructure()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->post('id');
            $name    = $this->input->post('holidaystructure');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('holidaystructure', 'Structure', 'trim|required|max_length[120]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("leave/Holidays");

            } else {
            $val = '';
            $table = 'holidaystructure';
            $data = array('holidaystructure'=> trim($name),'Active_status'=> 1,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This holiday structure  is already exists</p>'));
            } else{ 
               
                  $data = array();
                $data = array(
                    'holidaystructure' => $name,
                    'Active_status' => '1',
                   
                );
                if (empty($id)) {
                    $success = $this->leave_model->Add_Holidaystruc($data);
                  
                     if($success){
                           
                            echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                            }  
                } else {
                    $success = $this->leave_model->Update_Holidaystruc($id, $data);
         
                     if($success){
                           echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                            }  
                }
            }
             
                
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
      public function holystructureinactive(){
      $id = $this->input->post('id');
      //if($inactivestatus === "1"){
       $data = array( 'Active_status' => 0 ); 
        $success = $this->leave_model->Inactive_holystructure($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //}   
    
     }
     /* */
    public function holystructureactive(){
      $id = $this->input->post('id');
      //if($activestatus === "0"){
       $data = array( 'Active_status' => 1 ); 
        $success = $this->leave_model->active_holystructure($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //} 
    
     }

    //Holiday
    public function Add_Holidays()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->post('id');
            $name    = $this->input->post('holiname');
            $sdate   = $this->input->post('startdate');
            $edate   = $this->input->post('enddate');
            $edate   = $this->input->post('enddate');
            $structureid = $this->input->post('structureid');
            $restricted = $this->input->post('restricted');
            if(empty($edate)){
               $nofdate = '1'; 
                //die($nofdate);
            } else{
            $date1 = new DateTime($sdate);
            $date2 = new DateTime($edate);
            $diff = date_diff($date1,$date2);
            //$nofdate = $diff->format("%a");
            $interval = $date1->diff($date2);
            $nofdate = $interval->days + 1; 
               
            //die($nofdate);     
            }
            $year    = date('Y-m',strtotime($sdate));
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('holiname', 'Holidays name', 'trim|required|max_length[120]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("leave/Holidays");
            } else {


                $data1 = array();
                $data1 = array(
                    'holiday_name' => $name,
                    'from_date' => $sdate,
                    'to_date' => $edate,
                    'number_of_days' => $nofdate,
                    'year' => $year,
                    'structureid' => $structureid,
                    'restricted' => $restricted
                );
                //print_r($data1);
            if (empty($id)) {
            $val = '';
            $table = 'holiday';
            $data = array('holiday_name'=> trim($name),'structureid'=> $structureid,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This holiday is already exists</p>'));
            } else{ 
          
                if (empty($id)) {
                    $success = $this->leave_model->Add_HolidayInfo($data1);
                  
                     if($success){
                           
                            echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                            }  
                } else {
                    $success = $this->leave_model->Update_HolidayInfo($id, $data1);
         
                     if($success){
                           echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                            }  
                }
                }
                 } else {
                    $success = $this->leave_model->Update_HolidayInfo($id, $data1);
         
                     if($success){
                           echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                            }  
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    //leave
    public function LeaveStructure()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['leavestruc'] = $this->leave_model->Getleavestruc();
            $this->load->view('backend/leavestructure',$data);//, $data
        } else {
            redirect(base_url(), 'refresh');
        }
    }
     public function fetch_leavestructure(){
    $leavestruc = $this->leave_model->Getleavestructure();
     $i = 1;
       foreach($leavestruc as $value): ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $value->leavestructure ?></td>
           
              <td>
                  <?php //echo $value->Active_status; 
                   if($value->Active_status == "1"){ ?>
                   <button type="button" class="btn btn-primary" id="inactive" value="<?php echo $value->Active_status; ?>" data-id="<?php echo $value->id; ?>" name="inactive" >INACTIVE</button><?php
                   }elseif ($value->Active_status == "0"){ ?>
                   <button type="button" class="btn btn-info" id="active" value="<?php echo $value->Active_status; ?>" data-id="<?php echo $value->id; ?>" name="active">ACTIVE</button><?php
                   }?> 
                   
            </td>
            <td class="jsgrid-align-center ">
                <?php if($value->Active_status == "1"){?>
                <a href="" title="Edit" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light holiday " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a> 
                <a href="<?php echo base_url(); ?>leave/leavetypes?id=<?php echo base64_encode($value->id)?>" title="Edit" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light  " data-id="<?php echo $value->id; ?>"><i class="fa fa-eye"></i></a>
               <?php }; ?>
            </td>
        </tr>
        <?php $i++; endforeach; 
                }

       //holiday structure
     public function Add_leavestructure()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->post('id');
            $name    = $this->input->post('leavestructure');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('leavestructure', 'Structure', 'trim|required|max_length[120]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("leave/Holidays");
            } else {
                 $val = '';
            $table = 'leavestructure';
            $data = array('leavestructure'=> trim($name),'Active_status'=> 1,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This leave structure  is already exists</p>'));
            } else{ 
                $data = array();
                $data = array(
                    'leavestructure' => $name,
                    'Active_status' => '1',
                   
                );
                if (empty($id)) {
                    $success = $this->leave_model->Add_Leavestruc($data);
                  
                     if($success){
                           
                            echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                            }  
                } else {
                    $success = $this->leave_model->Update_Leavestruc($id, $data);
         
                     if($success){
                           echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                            }  
                }
            }
                
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
      public function leavestructureinactive(){
      $id = $this->input->post('id');
       $status = $this->input->post('status');
       $data = array( 'Active_status' => $status ); 
        $success = $this->leave_model->Inactive_leavestructure($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //}   
    
     }
     /* */
    public function leavestructureactive(){
      $id = $this->input->post('id');
      $status = $this->input->post('status');
       $data = array( 'Active_status' => $status ); 
        $success = $this->leave_model->active_leavestructure($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //} 
    
     }

    public function leavestrucbyib()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                   = $this->input->get('id');
            $data['leavestrucvalue'] = $this->leave_model->GetleavestucValue($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    } 

    public function leavetypes()
    {
        if ($this->session->userdata('user_login_access') != False) {
             $id  = base64_decode($this->input->get('id'));
            $data['leavetypes'] = $this->leave_model->GetLeaveInfo( $id);
            $this->load->view('backend/leavetypes', $data);//, $data
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    //fetch leave types
     public function fetch_leavetypes(){
       $id   = $this->input->get('id');
     
        $leavetypes = $this->leave_model->GetLeaveInfo($id);

      }


    public function Add_leaves_Type()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id     = $this->input->post('id');
            $name   = $this->input->post('leavename');
            $nodays = $this->input->post('leaveday');
            $paidstatus = $this->input->post('paidstatus');
            $leavestrucid = $this->input->post('leavestrucid');
            $annual_leave = $this->input->post('annual_leave');
            $document_status = $this->input->post('document_status');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('leavename', 'leave name', 'trim|required|min_length[1]|max_length[220]|xss_clean');
            
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("leave/Holidays");
            } else {
                  $val = '';
            $table = 'leave_types';
            $data = array('name'=> trim($name),'leavestrucid'=> $leavestrucid,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This leave types  is already exists</p>'));
            } else{ 
                $data = array();
                $data = array(
                    'name' => $name,
                    'leave_day' => $nodays,
                    'paidstatus' => $paidstatus,
                    'leavestrucid'=>$leavestrucid,
                    'isAnnual_leave'=>$annual_leave,
                    'document_status'=>$document_status
                );
                if (empty($id)) {
                    $success = $this->leave_model->Add_leave_Info($data);
                    
                     if($success){
                     echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                     }
                } else {
                    $success = $this->leave_model->Update_leave_Info($id, $data);
                   if($success){
                     echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                     }
                }
            }
                
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

        public function LeaveDelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->leave_model->LeaveDelete($id);//
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
    public function LeaveStructureDelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->leave_model->LeaveStrucDelete($id);//
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

    public function Application()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['employee']    = $this->employee_model->emselect(); // gets active employee details
            $data['leavetypes']  = $this->leave_model->GetleavetypeInfo();
            $data['leavestruc']  = $this->leave_model->GetleavestrucInfo();
            $data['application'] = $this->leave_model->AllLeaveAPPlication();

            $this->load->view('backend/leave_approve', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
      public function Leavelist()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['employee']    = $this->employee_model->emselect(); // gets active employee details
            $data['leavetypes']  = $this->leave_model->GetleavetypeInfo();
            $data['leavestruc']  = $this->leave_model->GetleavestrucInfo();
            $data['leavelist'] = $this->leave_model->Leavelist();
            $this->load->view('backend/leave_list', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }  
     public function Today_absent()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['employee']    = $this->employee_model->emselect(); // gets active employee details
            $data['leavetypes']  = $this->leave_model->GetleavetypeInfo();
            $data['leavestruc']  = $this->leave_model->GetleavestrucInfo();
            $data['leavelist'] = $this->leave_model->Leavelist();
            $this->load->view('backend/today_absent', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
     public  function get_match_leavetypes(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('leavestrucid');
            $leavetype = $this->input->post('leavetype');
            //$id = 1;
             $result = $this->leave_model->get_match_leavetypes($id);

               $str='';
               if($result > 0){
                    $str.=" <option value=''>Select Here..</option>";
                foreach ($result as $value){
                
                   $str.="<option value='".$value->type_id."'";   /*>".$value->name."</option>";*/
                   if($value->type_id == $leavetype){
                    $str.="selected";
                   }
                  
                  $str.=" >".$value->name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    }  
    //new get leave structure based on emp   
    public  function get_match_leavestructure(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('emid');
            
            //$id = 1;
            $emp = $this->dashboard_model->getemp($id); //changes
            $busunit = $this->dashboard_model->get_businesscode($emp->busunit);

             $result = $this->leave_model->GetleavestucValue($busunit->leavestructureid);
     
              $str = '';
            if ($result !== null) { // Check if $result is not null
                $str .= " <option value=''>Select Here..</option>";
                $str .= "<option value='" . $result->id . "'>" . $result->leavestructure . "</option>";
            } else {
                $str = "No leavestructure found"; // Handle the case when $result is null
            }
            echo json_encode(array('content'=>$str));
             

    }
    } 
   public  function get_document_status(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('leavetype');
            //$id = 1;
             $result = $this->leave_model->get_leave_document_status($id);//get_match_leavetypes
           
               $str='';
             if ($result) {
                 if($result->document_status == 1){
                $str .=' <div class="form-group">
                                                <label class="control-label">Document</label><span class="error"> *</span>
                                              
                                                <input type="file" name="file_url" class="form-control" id="file_url" required>
                                            </div>';
              }
             }
                 
            
            echo json_encode(array('content'=>$str));
             

    }
    } 

    public function EmApplication()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $emid                = $this->session->userdata('user_login_id');
            $data['employee']    = $this->employee_model->emselectByID($emid);
            $data['leavetypes']  = $this->leave_model->GetleavetypeInfo();
            $data['application'] = $this->leave_model->GetallApplication($emid);
            $this->load->view('backend/leave_apply', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Update_Applications()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id           = $this->input->post('id');
            $emid         = $this->input->post('emid');
            $typeid       = $this->input->post('typeid');
            $appstartdate = $this->input->post('startdate');
            $appenddate   = $this->input->post('enddate');
            $reason       = $this->input->post('reason');
            /*      $type = $this->input->post('type');*/
            $duration     = $this->input->post('duration');
            $hour         = $this->input->post('hour');
            $datetime     = $this->input->post('datetime');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('reason', 'reason', 'trim|required|min_length[5]|max_length[512]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                #redirect("employee/view?I=" .base64_encode($eid));
            } else {
                $data    = array();
                $data    = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    /*'leave_type'=>$type,*/
                    'leave_duration' => $duration,
                    'leave_status' => 'Approved'
                );
                $success = $this->leave_model->Application_Apply_Update($id, $data);
                #$this->session->set_flashdata('feedback','Successfully Updated');
                #redirect("leave/Application");
                
                if ($this->db->affected_rows()) {
                    $data    = array();
                    $data    = array(
                        'emp_id' => $emid,
                        'app_id' => $id,
                        'type_id' => $typeid,
                        'day' => $duration,
                        'hour' => $hour,
                        'dateyear' => $datetime
                    );
                    $success = $this->leave_model->Application_Apply_Approve($data);
                    echo "Successfully Approved";
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Add_Applications()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id           = $this->input->post('id');
            $emid         = $this->input->post('emid');
            $typeid       = $this->input->post('typeid');
            $applydate    = date('Y-m-d');
            $appstartdate = $this->input->post('startdate');
            $appenddate   = $this->input->post('enddate');
            $hourAmount   = $this->input->post('hourAmount');
            $reason       = $this->input->post('reason');
            $type         = $this->input->post('type');
            $leavestrucid         = $this->input->post('leavestrucid');
            // $duration     = $this->input->post('duration');
          
            //new
        
            // $emp_data =  $this->employee_model->matchemp($emid);
            // if($emp_data){
            //    $employee_code = $emp_data->em_code;
            //  //print_r($emp_data);die();
            // }

            if($type == 'Half Day') {
                //$duration = $hourAmount;
                /**/
                $duration = 4;
                $leavedays = 0.5 ;
                //$leavedays = $duration / 2 ;
            } else if($type == 'Full Day') { 
                $duration = 8;
                $leavedays = $duration / 8 ;
            } else if($type == 'More than One day'){ 
                $formattedStart = new DateTime($appstartdate);
                $formattedEnd = new DateTime($appenddate);

               // $duration = $formattedStart->diff($formattedEnd)->format("%d");
                //new
                $interval = $formattedStart->diff($formattedEnd);
                $days = $interval->days + 1; 
                $leavedays = $days ;
                /**/
                 $duration = $leavedays * 8;
                 //$leavedays = $duration / 8 ;

                
            }
           if (empty($id)) {
            $val = '';
            $table = 'emp_leave';
            $data = array('em_id'=> $emid,'start_date'=> $appstartdate,'isActive'=> 1);
            if($this->organization_model->Check_leave_exists($val,$data,$table) > 0){
            echo json_encode(array('error'=>'<p>You have already applied for this leave</p>'));
            } else{
             
           if(isset($_FILES['file_url']) ){
           if($_FILES['file_url']['name']){
            $file_name = $_FILES['file_url']['name'];
            $fileSize = $_FILES["file_url"]["size"]/1024;
            $fileType = $_FILES["file_url"]["type"];
            $new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/LeaveDocument",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
                'overwrite' => False,
                'max_size' => "50720000"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file_url')) {
                echo $this->upload->display_errors();
                #redirect("notice/All_notice");
            }
            $path = $this->upload->data();
                $img_url = $path['file_name'];

                 $data = array();
                $data = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'apply_date' => $applydate,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    'leave_type' => $type,
                    'leave_duration' => $duration,
                    'leave_days' => $leavedays,
                    'leave_status' => 'Pending',
                    'leavestrucid' => $leavestrucid,
                    'file_url' => $img_url
                );
            }
           }else{
             $data = array();
                $data = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'apply_date' => $applydate,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    'leave_type' => $type,
                    'leave_duration' => $duration,
                    'leave_days' => $leavedays,
                    'leave_status' => 'Pending',
                    'leavestrucid' => $leavestrucid
                );
           }
               
                
               /* print_r( $data);
                 die();*/
               // if (empty($id)) {
                    $applysuccess = $this->leave_model->Application_Apply($data);
                     if($applysuccess){
                      
                      if($this->input->post('employee_leave')){
                        
                        $this->apply_leave_mail($emid,$reason);
                   

                        }
                      else{
                         echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                      }
                      }


                        // New
                             /*Notification*/
                            // Retrieve data from the employee table
                             $emp_id = $emid;
                            $emp_Data = $this->expense_model->getempbyid($emp_id);
                            //admin
                            $getAdmin = $this->expense_model->getadmin();
                            $admin_id =  $getAdmin->em_id;
                            //get bus unit id
                            $getbusunit = $this->expense_model->getbusunitid($emp_id);
                            $busunit_id = $getbusunit->busunit;
                            //get hr
                            $getHR =  $this->expense_model->Emplist_hr($busunit_id);
                            $hr_id =  $getHR->hr;

                            $employees = array(
                                array(
                                    'id' => 'hr_id',
                                    'em_id' => $hr_id
                                ),
                                array(
                                    'id' => 'admin_id',
                                    'em_id' => $admin_id
                                )
                            );

                        
                                $filetitle = 'New Leave Request: <span class="txt-name" style="font-weight:bold">'.$emp_Data->first_name .' '.$emp_Data->last_name.'</span>.';       
                            foreach ($employees as $employee) {
                            $data = array(
                            'user_id' => $employee['em_id'],
                            'message' => $filetitle,
                            'status' => 'unread'
                            );
                            $this->db->insert('notifications', $data);
                            }
                        // New

                }
            }else{


          if(isset($_FILES['file_url']) ){
           if($_FILES['file_url']['name']){
            $file_name = $_FILES['file_url']['name'];
            $fileSize = $_FILES["file_url"]["size"]/1024;
            $fileType = $_FILES["file_url"]["type"];
            $new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/LeaveDocument",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
                'overwrite' => False,
                'max_size' => "50720000"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file_url')) {
                echo $this->upload->display_errors();
                #redirect("notice/All_notice");
            }
            $path = $this->upload->data();
                $img_url = $path['file_name'];

               // echo  $img_url;die();
         
                 $data = array();
                $data = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'apply_date' => $applydate,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    'leave_type' => $type,
                    'leave_duration' => $duration,
                    'leave_days' => $leavedays,
                    'leave_status' => 'Pending',
                    'leavestrucid' => $leavestrucid,
                    'file_url' => $img_url
                );
            }
           }else{

             $data = array();
                $data = array(
                    'em_id' => $emid,
                    'typeid' => $typeid,
                    'apply_date' => $applydate,
                    'start_date' => $appstartdate,
                    'end_date' => $appenddate,
                    'reason' => $reason,
                    'leave_type' => $type,
                    'leave_duration' => $duration,
                    'leave_days' => $leavedays,
                    'leave_status' => 'Pending',
                    'leavestrucid' => $leavestrucid
                );
           }
               
                    $updatesuccess = $this->leave_model->Application_Apply_Update($id, $data);
                     if($updatesuccess){
                       echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                    }
                
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function Add_L_Status()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id       = $this->input->post('lid');
            $value    = $this->input->post('lvalue');
            $duration = $this->input->post('duration');
            $type     = $this->input->post('type');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $data    = array();
            $data    = array(
                'leave_status' => $value
            );
            $success = $this->leave_model->Application_Apply_Update($id, $data);
            if ($value == 'Approve') {
                $totalday = $this->leave_model->GetTotalDay($type);
                $total    = $totalday->total_day + $duration;
                $data     = array();
                $data     = array(
                    'total_day' => $total
                );
                $success  = $this->leave_model->Assign_Duration_Update($type, $data);
                echo "Successfully Updated";
            } else {
                echo "Successfully Updated";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    

    public function Holystrucbyib()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                   = $this->input->get('id');
            $data['holidaystrucvalue'] = $this->leave_model->GetholidaystucValue($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }  
     public function Holidaybyib()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                   = $this->input->get('id');
            $data['holidayvalue'] = $this->leave_model->GetLeaveValue($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeaveAppbyid()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                      = $this->input->get('id');
            $emid                    = $this->input->get('emid');
            $data['leaveapplyvalue'] = $this->leave_model->GetLeaveApply($id);
            /*$leaveapplyvalue = $this->leave_model->GetEmLeaveApply($emid);*/
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeaveTypebYID()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                     = $this->input->get('id');
            $data['leavetypevalue'] = $this->leave_model->GetLeaveType($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function GetEarneBalanceByEmCode()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                     = $this->input->get('id');
            $data['earnval'] = $this->leave_model->GetEarneBalanceByEmCode($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function HOLIvalueDelet()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->get('id');
            $success = $this->leave_model->DeletHoliday($id);
            echo "Successfully Deletd";
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function APPvalueDelet()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->get('id');
            $success = $this->leave_model->DeletApply($id);
            redirect('leave/Application');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function LeavetypeDelet()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id      = $this->input->get('D');
            $success = $this->leave_model->DeletType($id);
            redirect('leave/leavetypes');
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    public function LeaveType()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id          = $this->input->get('id');
            $year        = date('Y');
            $leavetype   = $this->leave_model->GetemLeaveType($id, $year);
            $assignleave = $this->leave_model->GetemassignLeaveType($id, $year);
            foreach ($leavetype as $value) {
                echo "<option value='$value->type_id'>$value->name</option>";
            }
            $totalday = $assignleave->total_day . '/' . $assignleave->day;
            echo $totalday;
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    

    public function EmLeavesheet()
    {
        $emid              = $this->session->userdata('user_login_id');
        $data              = array();
        $data['embalance'] = $this->leave_model->EmLeavesheet($emid);
        $this->load->view('backend/leavebalance', $data);
    }

    public function GetemployeeGmLeave()
    {
        $year        = $this->input->get('year');
        $id          = $this->input->get('typeid');
        $emid        = $this->input->get('emid');
        $assignleave = $this->leave_model->GetemassignLeaveType($emid, $id, $year);
        $totaldays   = 0;
        foreach ($assignleave as $value) {
            $totaldays = $totaldays + $value->day;
        }
        $day        = $totaldays;
        $leavetypes = $this->leave_model->GetleavetypeInfoid($id);
        $totalday   = $day . '/' . $leavetypes->leave_day;
        echo $totalday;
    }

    public function Leave_report()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $data['employee'] = $this->employee_model->emselect();
            $data['businessunitvalue'] = $this->employee_model->businessunitvalue(); 
            $this->load->view('backend/leave_report', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    
    // Get leave details hourly
    public function Get_LeaveDetails()
    {
        $busid   = $this->input->get('busid');
        $emid   = $this->input->get('emid');
        $date   = $this->input->get('date_time');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('date_time', 'Date Time', 'trim|required|xss_clean');
            $this->form_validation->set_rules('emp_id', 'Employee', 'trim|required|xss_clean');
        $date = explode('-', $date);

        $day = $date[0];
        $year = $date[1];
        
       // $report = $this->leave_model->GetEmLEaveReport($emid, $day, $year);
        if($emid){
         $getreport = $this->leave_model->GetEmLEaveReport($emid, $day, $year);//emp
          if ($getreport)
        {
            foreach ($getreport as $value) {


                echo "<tr>
                        <td>$value->em_code</td>
                        <td>$value->first_name $value->last_name</td>
                        <td>$value->name</td>
                        <td>";
                         if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}}
                         echo "</td>
                       
                        <td>"; if($value->start_date) { echo date('d M Y',strtotime($value->start_date)); } echo "</td>
                        <td>";if($value->end_date) {echo date('d M Y',strtotime($value->end_date)); } echo "</td>
                        <td>$value->paidstatus</td>
                        <td>$value->leave_status</td>
                    </tr>";/* <td>$value->leave_days </td>*/
            }
        } else {
             echo "<tr>
                    <td colspan='8' style='text-align:center'>No Data Found</td>
                 
                   
                </tr>";
        }

        }else{
        $report = $this->leave_model->GetBusunitLeave($busid, $day, $year);

        if ($report)
        {
            foreach ($report as $value) {


                echo "<tr>
                        <td>$value->em_code</td>
                        <td>$value->first_name $value->last_name</td>
                        <td>$value->name</td>
                        <td>";
                         if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}}
                         echo "</td>
                       
                        <td>"; if($value->start_date) { echo date('d M Y',strtotime($value->start_date)); } echo "</td>
                        <td>";if($value->end_date) {echo date('d M Y',strtotime($value->end_date)); } echo "</td>
                        <td>$value->paidstatus</td>
                        <td>$value->leave_status</td>
                    </tr>";/* <td>$value->leave_days </td>*/
            }
        } else {
             echo "<tr>
                    <td colspan='8' style='text-align:center'>No Data Found</td>
                 
                   
                </tr>";
        }
     }
    }


    /*Approve and update leave status*/
    /*Admin Approve status*/
    public function approveLeaveStatus() {
        if ($this->session->userdata('user_login_access') != False) {
            $employeeId = $this->input->post('employeeId');
            $id       = $this->input->post('lid');
            $value    = $this->input->post('lvalue');
            $duration = $this->input->post('duration');
            $type     = $this->input->post('type');
             $start     = $this->input->post('start');
            $end     = $this->input->post('end');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            
            $data    = array();
            $data    = array(
                'leave_status' => $value,
                'thead_approve' => $value,
                'hr_approve' => $value
            );
            $success = $this->leave_model->updateAplicationAsResolved($id, $data);

           $emid =  $employeeId;
            if($success){
                  //echo "Updated successfully";
                 $this->admin_approve_mail($emid,$start,$end);
             }
           /* if ($value == 'Approved') {
                $determineIfNew = $this->leave_model->determineIfNewLeaveAssign($employeeId, $type);
                //How much taken
                $totalHour = $this->leave_model->getLeaveTypeTotal($employeeId, $type);
                //If already taken some
                if($determineIfNew  > 0) {
                    $total    = $totalHour[0]->totalTaken + $duration;
                    $data     = array();
                    $data     = array(
                        'hour' => $total
                    );
            $success  = $this->leave_model->updateLeaveAssignedInfo($employeeId, $type, $data);
            $earnval = $this->leave_model->emEarnselectByLeave($employeeId); 
              $data = array();
              $data = array(
                        'present_date' => $earnval->present_date - ($duration/8),
                        'hour' => $earnval->hour - $duration
                    );
            $success = $this->leave_model->UpdteEarnValue($employeeId,$data);                     
            echo "Updated successfully";
                } else {
                //If not taken yet
                    $data     = array();
                    $data = array(
                        'emp_id' => $employeeId,
                        'type_id' => $type,
                        'hour' => $duration,
                        'dateyear' => date('Y')
                    );
                    $success  = $this->leave_model->insertLeaveAssignedInfo($data);
               echo "Updated successfully";
                }
            } else {
                echo "Updated successfully";
            }*/
        }
    }    
    /*team approval*/
    public function approveStatus() {
        if ($this->session->userdata('user_login_access') != False) {
            $employeeId = $this->input->post('employeeId');
            $id       = $this->input->post('lid');
            $value    = $this->input->post('lvalue');
            $duration = $this->input->post('duration');
            $type     = $this->input->post('type');
            $start     = $this->input->post('start');
            $end     = $this->input->post('end');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $emid = $employeeId;
            $data    = array();
            $data    = array(
                'thead_approve' => $value
            );
           $postion = 'Team Head';
            $success = $this->leave_model->updateLeave($id, $data);
             if($success){
                  if($value == 'Approved'){
                  $sub = 'Leave Request Approved';
                  $content = '
                    <p>I am pleased to inform you that your request for leave from ';  if($start){ $content .= '  '. date('jS  F Y',strtotime($start)); }  if($end){ $content .=  'to'.' '.date('jS  F Y',strtotime($end)); } $content .= " has been approved. We appreciate your advance notice and the detailed information you provided in your request.</p>
                    <p>Please make sure to handover any important responsibilities to your colleagues and complete any pending work before you leave. I hope you have a restful and rejuvenating time off and come back refreshed.</p>
                    <p>If you have any questions or concerns, please don't hesitate to reach out to me.</p><br>";
                  $this->approve_leave_mail($emid,$sub,$content,$postion);
                 // if($this->approve_leave_mail($emid,$sub,$content,$postion)){
                  
                    $userid = $emid;
                     $basicinfo = $this->leave_model->Get_to_address($userid);
                      $emailsubject = 'Leave Application  -'.$basicinfo->first_name.' '.$basicinfo->last_name;
                       $mailcontent = '
                    <p>I am writing to request a leave of absence for '; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= ' from';  if($start){ $mailcontent .= '  '. date('jS  F Y',strtotime($start)); }  if($end){ $mailcontent .=  'to'.' '.date('jS  F Y',strtotime($end)); } $mailcontent .= ". As per my discussion with "; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= " , I have given my approval for this leave.</p>
                    <p>He has informed me that they have already communicated with their colleagues and made arrangements to ensure that their work will not be impacted during their absence.</p>
                    <p>Please let me know if any additional information is required or if there are any concerns.</p>
                    <p>Thank you for your attention to this matter.</p><br>";
                      $this->thead_approve_hr_mail($emid,$emailsubject,$mailcontent,$postion);
                 // }


                 }elseif ($value == 'Rejected') {
                    $sub = 'Leave Request Rejected';
                  $content = "
                    <p>I regret to inform you that we are unable to grant your request for leave from "; if($start){ $content .= date('jS  F Y',strtotime($start)); }  if($end){ $content .= 'to'.' '.date('jS  F Y',strtotime($end)); }$content .=". We understand the importance of taking time off, but unfortunately, we are currently understaffed and cannot accommodate your request at this time.</p><br>
                    <p>We appreciate your understanding and your commitment to your work. Please let us know if there are any alternative dates you would like to request, or if there is anything else we can do to support you.</p><br><br>
                    <p>Thank you for your cooperation.</p><br>";
                  $this->approve_leave_mail($emid,$sub,$content,$postion);
                 }
             }
        }
    }
    /*HR approval*/
        public function hrapproveStatus() {
            if ($this->session->userdata('user_login_access') != False) {
                $employeeId = $this->input->post('employeeId');
                $id       = $this->input->post('lid');
                $value    = $this->input->post('lvalue');
                $duration = $this->input->post('duration');
                $type     = $this->input->post('type');
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters();
                 $emid = $employeeId;
                 $start     = $this->input->post('start');
                  $end     = $this->input->post('end');
                $data    = array();
                $data    = array(
                    'hr_approve' => $value,
                    'leave_status' => $value
                );
              $postion = 'HR Manager';
                $success = $this->leave_model->updateLeave($id, $data);
                /* if($success){
                      echo "Updated successfully";
                 }*/
                 if($success){
                  if($value == 'Approved'){
                 //employee
                  $sub = 'Leave Request Approved';
                  $content = '
                    <p>I am pleased to inform you that your request for leave from ';  if($start){ $content .= ' '. date('jS  F Y',strtotime($start)); }  if($end){ $content .= 'to'.' '.date('jS  F Y',strtotime($end)); } $content .= " has been approved. We appreciate your advance notice and the detailed information you provided in your request.</p>
                    <p>Please make sure to handover any important responsibilities to your colleagues and complete any pending work before you leave. I hope you have a restful and rejuvenating time off and come back refreshed.</p>
                    <p>If you have any questions or concerns, please don't hesitate to reach out to me.</p><br>";
                  $this->hr_approve_mail($emid,$sub,$content,$postion);
                  //hr to thead
                   $userid = $emid;
                     $basicinfo = $this->leave_model->Get_to_address($userid);
                      $emailsubject = 'Approval of Requested Leave for  - '.$basicinfo->first_name.' '.$basicinfo->last_name;
                       $mailcontent = '
                    <p>I am writing to confirm that I have approved the requested leave for '; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= ' starting  from';  if($start){ $mailcontent .= '  '. date('jS  F Y',strtotime($start)); }  if($end){ $mailcontent .=  'to'.' '.date('jS  F Y',strtotime($end)); } $mailcontent .= "<p> During this time "; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= "  responsibilities will be delegated to </p><p>"; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; 
                    $mailcontent .=", and he will be provided with all necessary information and resources to ensure that there is no disruption to the team's ongoing projects and tasks.</p>
                    <p>I appreciate your understanding in this matter, and I am confident that the team will continue to perform efficiently and effectively during this period.</p>
                    <p>If you have any questions or concerns regarding this matter, please do not hesitate to contact me.</p><br>";
                      $this->hr_approve_thead_mail($emid,$emailsubject,$mailcontent,$postion);

                 }elseif ($value == 'Rejected') {
                    $sub = 'Leave Request Rejected';
                  $content = "
                    <p>I regret to inform you that we are unable to grant your request for leave from "; if($start){ $content .= date('jS  F Y',strtotime($start)); }  if($end){ $content .= 'to'.' '.date('jS  F Y',strtotime($end)); }$content .=". We understand the importance of taking time off, but unfortunately, we are currently understaffed and cannot accommodate your request at this time.</p><br>
                    <p>We appreciate your understanding and your commitment to your work. Please let us know if there are any alternative dates you would like to request, or if there is anything else we can do to support you.</p><br><br>
                    <p>Thank you for your cooperation.</p><br>";
                  $this->hr_approve_mail($emid,$sub,$content,$postion);

                    //hr to thead //Reject mail
                   $userid = $emid;
                     $basicinfo = $this->leave_model->Get_to_address($userid);
                      $emailsubject = 'Rejection of Requested Leave for  - '.$basicinfo->first_name.' '.$basicinfo->last_name;
                       $mailcontent = '
                    <p>I regret to inform you that I have to reject the requested leave for '; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= ' for  starting  from';  if($start){ $mailcontent .= '  '. date('jS  F Y',strtotime($start)); }  if($end){ $mailcontent .=  'to'.' '.date('jS  F Y',strtotime($end)); } $mailcontent .= "<p> After careful consideration of the current workload and team's priorities, we cannot afford to grant  "; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= "  leave at this time. We understand that this may cause inconvenience to </p><p>"; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; 
                    $mailcontent .=", but it is essential to ensure that we can maintain the team's productivity and meet our deadlines.</p>
                       <p>We encourage "; $mailcontent .= $basicinfo->first_name.' '.$basicinfo->last_name; $mailcontent .= " to explore alternative dates or other arrangements for the leave. We appreciate your understanding in this matter, and we apologize for any inconvenience that this may cause.</p>
                       <p>If you have any questions or concerns regarding this matter, please do not hesitate to contact me.</p><br>";
                      $this->hr_approve_thead_mail($emid,$emailsubject,$mailcontent,$postion);
                 }
             }
            }
        }
     public function GetLeaveAssign()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $employeeID = $this->input->get('employeeID');
            $leaveID = $this->input->get('leaveID');
            if (!empty($leaveID)) {
                $year        = date('Y');
                $daysTaken = $this->leave_model->EmpLeaveReport($employeeID, $leaveID, $year);
              if($daysTaken){
               // $daysTakenval = $daysTaken->num_rows();
                $daysTakenval = $daysTaken->leave_days;
                $leavetypes = $this->leave_model->GetleavetypeInfoid($leaveID);
               if($leavetypes->leave_day == 0){
                $totalday   = 'Leave Balance : '.($leavetypes->leave_day).' Days Of '.$leavetypes->leave_day;    
                echo $totalday;
              }else{
                $totalday   = 'Leave Balance : '.($leavetypes->leave_day - $daysTakenval).' Days Of '.$leavetypes->leave_day;    
                echo $totalday;
              }
              }else{
                  $leavetypes = $this->leave_model->GetleavetypeInfoid($leaveID);
                 $totalday   = 'Leave Balance : '.($leavetypes->leave_day ).' Days Of '.$leavetypes->leave_day;    
                echo $totalday;
              }
                

            } else {
                echo "Please Select Leave Type.";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function LeaveAssign()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $employeeID = $this->input->get('employeeID');
            $leaveID = $this->input->get('leaveID');
            if (!empty($leaveID)) {
                $year        = date('Y');
                $daysTaken = $this->leave_model->GetemassignLeaveType($employeeID, $leaveID, $year);
                //die($daysTaken->hour);
                $leavetypes = $this->leave_model->GetleavetypeInfoid($leaveID);
                if(empty($daysTaken->hour)) {
                    $daysTakenval = '0';
                } else{
                    $daysTakenval = $daysTaken->hour / 8;
                }
                if($leaveID =='5'){
                $earnTaken = $this->leave_model->emEarnselectByLeave($employeeID);
                $totalday   = 'Earned Balance: '.($earnTaken->hour / 8).' Days';
                echo $totalday;       
                }else {
                //$totalday   = $leavetypes->leave_day . '/' . ($daysTaken/8);
                $totalday   = 'Leave Balance: '.($leavetypes->leave_day - $daysTakenval).' Days Of '.$leavetypes->leave_day;    
                echo $totalday;
                }

               /* $daysTaken = $this->leave_model->GetemassignLeaveType('Sah1804', 2, 2018);
                $leavetypes = $this->leave_model->GetleavetypeInfoid($leaveID);
                // $totalday   = $leavetypes->leave_day . '/' . $daysTaken['0']->day;
                echo $daysTaken['0']->day;
                echo $leavetypes->leave_day;*/
            } else {
                echo "Something wrong.";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function Earnedleave(){
       if ($this->session->userdata('user_login_access') != False) { 
           $data['employee']    = $this->employee_model->emselect();
            $data['earnleave'] = $this->leave_model->GetEarnedleaveBalance();
            $this->load->view('backend/earnleave', $data);           
       } else {
            redirect(base_url(), 'refresh');
        }           
    }
    public function Update_Earn_Leave(){
        $employee = $this->input->post('emid');
        $start    = $this->input->post('startdate');
        $end     = $this->input->post('enddate');
            if(empty($end)){
               $days = '1'; 
                //die($nofdate);
            } else{
            $date1 = new DateTime($start);
            $date2 = new DateTime($end);
            $diff = date_diff($date1,$date2);
            $days = $diff->format("%a");
            //die($nofdate);     
            }        
        $hour = $days * 8;
        $emcode = $this->employee_model->emselectByCode($employee);
        $emid = $emcode->em_id;
        $earnval = $this->leave_model->emEarnselectByLeave($emid);
        if(!empty($earnval)){
              $data = array();
              $data = array(
                        'present_date' => $earnval->present_date + $days,
                        'hour' => $earnval->hour + $hour,
                        'status' => '1'
                    );
        $success = $this->leave_model->UpdteEarnValue($emid,$data);          
        } else {
              $data = array();
              $data = array(
                        'em_id' => $emid,
                        'present_date' => $days,
                        'hour' => $hour,
                        'status' => '1'
                    );
        $success = $this->leave_model->Add_Earn_Leave($data);  
        }

        if($this->db->affected_rows()){
            $startdate = strtotime($start);
            $enddate = strtotime($end);
            for($i = $startdate; $i <= $enddate; $i = strtotime('+1 day', $i)){
                $date = date('Y-m-d',$i);
              $data = array();
              $data = array(
                        'emp_id' => $employee,
                        'atten_date' => $date,
                        'working_hour' => '480',
                        'signin_time' => '09:00:00',
                        'signout_time' => '17:00:00',
                        'status' => 'E'
                    );
        $this->project_model->insertAttendanceByFieldVisitReturn($data); 
                
            }
            echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
            //echo "Successfully Added";
    }
    }
    public function Update_Earn_Leave_Only(){
        $emid = $this->input->post('employee');
        $days         = $this->input->post('day');
        $hour         = $this->input->post('hour');
              $data = array();
              $data = array(
                        'present_date' => $days,
                        'hour' => $hour
                    );
        $success = $this->leave_model->UpdteEarnValue($emid,$data);
       echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
    }
    public function printleave(){


      $busid   = $this->input->get('busunit');
        $emid   = $this->input->get('emid');
        $datetime   = $this->input->get('datetime');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
        $date = explode('-', $datetime);

        $day = $date[0];
        $year = $date[1];

        $month = date('F', mktime(0, 0, 0, $day, 10));
        //$month = date("F Y", strtotime($datetime));
        
        $empreport = $this->leave_model->GetEmLEaveReport($emid, $day, $year);
        $report = $this->leave_model->GetBusunitLeave($busid, $day, $year);
         


        $this->load->library('Pdf');
          // create new PDF document
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Leave Report');
        $pdf->SetSubject('Leave Report');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
       //pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setPrintHeader(false);
       // $pdf->SetTopMargin(20);
        $pdf->SetMargins(10, 10, 10, true);
        $pdf->setCellPaddings(0,0,0,0);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
       // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();
       if( $emid ){
       $html .= '<h3 style="margin-right:10px">Leave Report ('.$month.'-'.$year.')</h3>';
 $html .= '<div class="table-responsive ">
    <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;margin-right:10px">
        <thead>
            <tr style="background-color:#f3f1f1;color:;">
                <th style="text-align:center">Emp Code</th>
                <th style="text-align:center">Employee</th>
                <th style="text-align:center">Type</th>
                <th style="text-align:center">Duration</th>
                
                <th style="text-align:center">Start</th>
                <th style="text-align:center">End</th>
                <th style="text-align:center">Paid Status</th>
                <th style="text-align:center">Leave Status</th>
                
            </tr>
        </thead>
        
        <tbody class="leave">
            ';
            if ($empreport)
            {
            foreach ($empreport as $value) {
            
            $html .= "<tr>
                <td>$value->em_code</td>
                <td>$value->first_name $value->last_name</td>
                <td>$value->name</td>
                <td>";
                    if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}}
                    
                    $html .= "
                </td>
                
                <td>$value->start_date</td>
                <td>$value->end_date</td>
                <td>$value->paidstatus</td>
                <td>$value->leave_status</td>
                </tr>";/* <td>$value->leave_days </td>*/
                }
                } else {
                echo "<p>No Data Found</p>";
                }
            $html .= "        </tbody>
        </table>
    </div>";

       }else{
 $html .= '<h3 style="margin-right:10px">Leave Report ('.$month.'-'.$year.')</h3>';
 $html .= '<div class="table-responsive ">
    <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;margin-right:10px">
        <thead>
            <tr style="background-color:#f3f1f1;color:;">
                <th style="text-align:center">Emp Code</th>
                <th style="text-align:center">Employee</th>
                <th style="text-align:center">Type</th>
                <th style="text-align:center">Duration</th>
                
                <th style="text-align:center">Start</th>
                <th style="text-align:center">End</th>
                <th style="text-align:center">Paid Status</th>
                <th style="text-align:center">Leave Status</th>
                
            </tr>
        </thead>
        
        <tbody class="leave">
            ';
            if ($report)
            {
            foreach ($report as $value) {
            
            $html .= "<tr>
                <td>$value->em_code</td>
                <td>$value->first_name $value->last_name</td>
                <td>$value->name</td>
                <td>";
                    if($value->leave_type == 'Half Day'){ echo"Half Day"; }else { if($value->leave_days == 1){echo $value->leave_days." day ";}else  {echo $value->leave_days." days";}}
                    
                    $html .= "
                </td>
                
                <td>$value->start_date</td>
                <td>$value->end_date</td>
                <td>$value->paidstatus</td>
                <td>$value->leave_status</td>
                </tr>";/* <td>$value->leave_days </td>*/
                }
                } else {
                echo "<p>No Data Found</p>";
                }
            $html .= "        </tbody>
        </table>
    </div>";

       }



        $filename = "Leave Report (".$month. "_".$year.")";;
       
       $pdf->writeHTML($html, true, false, true, false, '');
            // reset pointer to the last page
            $pdf->lastPage();
           
              ob_end_clean();
            //Close and output PDF document
            $pdf->Output($filename.'.pdf', 'I');


    }

    /*Email Section*/
    /*Apply Leave*/
    public function apply_leave_mail($emid,$reason) {
    // $email = $this->input->post('email');
    $id = $emid;
    $get_report = $this->leave_model->GetReportEmp($id);
    if($get_report){
    $email = $get_report->em_email;
    //user email
    $fname =  $get_report->first_name;
    $lname =  $get_report->last_name;
    $userid = $get_report->report_to;
    $get_to_address = $this->leave_model->Get_to_address($userid);
    //reciver name
    $first_name =  $get_to_address->first_name;
    $last_name =  $get_to_address->last_name;
    $To =  $get_to_address->em_email;
    $to_name = $first_name.' '.$last_name;
    //user name
    $from_name = $fname.' '.$lname;
    $email_veiw = $this->settings_model->GetSmtp();
    $emp_veiw = $this->login_model->GetEMP($emid);

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$to_name ?> </p><br>
    <br>
    <p><?php echo $reason; ?></p>
    <p>
    </p><br>
    <div class="container" style="width: 300px;">
        <table style="width: 100%;">
            
            <td style="border: 0;outline: none;width: 214px;">
                <!-- <h2 style="font-family: sans-serif;font-size: 12px;font-weight: bold;margin: 0;padding: 0;color: #32322c; line-height: 24px;">Thank you</h2> -->
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Thank you</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$fname.' '.$lname ?></p>
            </td>
        </tr>
    </table>
    </div>
    <?php
    $message = ob_get_contents();
    ob_end_clean();

    try {
    //Server settings
    //$mail->SMTPDebug = 4;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_veiw->username;                     //SMTP username
    $mail->Password   = $email_veiw->password;                                //SMTP password
    $mail->SMTPSecure = 'tls';      //  PHPMailer::ENCRYPTION_SMTPS     //Enable implicit TLS encryption
    $mail->Port = $email_veiw->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($email,  $from_name);
    $mail->addAddress($To,$to_name); //$fname    //Add a recipient
    $mail->addReplyTo($email, $from_name);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject='Leave Application!!';
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

    echo json_encode(array('status'=>'success','message'=>'Leave Applied Successfully'));

    }else{
    //echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
           echo json_encode(array('status'=>'success','message'=>'Leave Applied Successfully'));
    }
    } catch (Exception $e) {
    //  echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
         echo json_encode(array('status'=>'success','message'=>'Leave Applied Successfully'));
    }
    }
    }
    //Team head Leave Approval
    public function approve_leave_mail($emid,$sub,$content,$postion) {
    // $email = $this->input->post('email');
    $id = $emid;
    $get_report = $this->leave_model->GetReportEmp($id);
    if($get_report){
    $email = $get_report->em_email;
    //user email
    $fname =  $get_report->first_name;
    $lname =  $get_report->last_name;
    $userid = $get_report->report_to;
    $get_to_address = $this->leave_model->Get_to_address($userid);
    //reciver name
    $first_name =  $get_to_address->first_name;
    $last_name =  $get_to_address->last_name;
    $from =  $get_to_address->em_email;
    //$To =  $get_to_address->em_email;
    $to_name = $first_name.' '.$last_name;
    //user name
    $from_name = $fname.' '.$lname;
    $email_veiw = $this->settings_model->GetSmtp();
    $emp_veiw = $this->login_model->GetEMP($emid);

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$from_name ?> </p><br>
    <?=$content?>
    <div class="container" style="width: 300px;">
    <table style="width: 100%;">
        <tr>
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$to_name ?></p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?></p>
            </td>
        </tr>
    </table>
    </div>
    <?php
    $message = ob_get_contents();
    ob_end_clean();

    try {
    //Server settings
    //$mail->SMTPDebug = 4;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_veiw->username;                     //SMTP username
    $mail->Password   = $email_veiw->password;                                //SMTP password
    $mail->SMTPSecure = 'tls';      //  PHPMailer::ENCRYPTION_SMTPS     //Enable implicit TLS encryption
    $mail->Port = $email_veiw->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($from,  $to_name);
    $mail->addAddress($email,$from_name); //$fname    //Add a recipient
    $mail->addReplyTo($from, $to_name);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= $sub;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

    echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
   // echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
         echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));
    }
    } catch (Exception $e) {
    echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;
    }
    }
    }

    //Team head Approved to hr
    public function thead_approve_hr_mail($emid,$emailsubject,$mailcontent,$postion) {
    // $email = $this->input->post('email');
    $id = $emid;
    $get_report = $this->leave_model->GetReportEmp($id);
    if($get_report){
    $email = $get_report->em_email;
    //user email
    $fname =  $get_report->first_name;
    $lname =  $get_report->last_name;
    $userid = $get_report->busunit;
    $theadid = $get_report->report_to;
    $get_head_address = $this->leave_model->Get_emp_address($theadid);
    $head_mail = $get_head_address->em_email;
    $head_name = $get_head_address->first_name.' '.$get_head_address->last_name;
    $get_to_address = $this->leave_model->Get_businessunit($userid);
    $hrid = $get_to_address->hr;
    $get_hr_address = $this->leave_model->Get_hr_address($hrid);
    //reciver name
    $first_name =  $get_hr_address->first_name;
    $last_name =  $get_hr_address->last_name;
    $hr =  $get_hr_address->em_email;
    //$To =  $get_to_address->em_email;
    $hr_name = $first_name.' '.$last_name;
    //user name
    $from_name = $fname.' '.$lname;
    $email_veiw = $this->settings_model->GetSmtp();
    $emp_veiw = $this->login_model->GetEMP($emid);

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$hr_name ?> </p><br>
    <?=$mailcontent?>
    <div class="container" style="width: 300px;">
    <table style="width: 100%;">
        <tr>
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$head_name ?></p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?></p>
            </td>
        </tr>
    </table>
    </div>
    <?php
    $message = ob_get_contents();
    ob_end_clean();

    try {
    //Server settings
    //$mail->SMTPDebug = 4;                      //Enable verbose debug output
    //$mail->isSMTP();                                            //Send using SMTP
    $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_veiw->username;                     //SMTP username
    $mail->Password   = $email_veiw->password;                                //SMTP password
    $mail->SMTPSecure = 'tls';      //  PHPMailer::ENCRYPTION_SMTPS     //Enable implicit TLS encryption
    $mail->Port = $email_veiw->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($head_mail,  $head_name);
    $mail->addAddress($hr,$hr_name); //$fname    //Add a recipient
    $mail->addReplyTo($head_mail, $head_name);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= $emailsubject;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

    // echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
    echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
    }
    } catch (Exception $e) {
    //echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;
    }
    }
    }
    //HR Leave Approval
    public function hr_approve_mail($emid,$sub,$content,$postion) {
    // $email = $this->input->post('email');
    $id = $emid;
    $get_report = $this->leave_model->GetReportEmp($id);
    if($get_report){
    $email = $get_report->em_email;
    //user email
    $fname =  $get_report->first_name;
    $lname =  $get_report->last_name;
    $userid = $get_report->busunit;
    $get_to_address = $this->leave_model->Get_businessunit($userid);
    $hrid = $get_to_address->hr;
    $get_hr_address = $this->leave_model->Get_hr_address($hrid);
    //reciver name
    $first_name =  $get_hr_address->first_name;
    $last_name =  $get_hr_address->last_name;
    $from =  $get_hr_address->em_email;
    //$To =  $get_to_address->em_email;
    $to_name = $first_name.' '.$last_name;
    //user name
    $from_name = $fname.' '.$lname;
    $email_veiw = $this->settings_model->GetSmtp();
    $emp_veiw = $this->login_model->GetEMP($emid);

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$from_name ?> </p><br>
    <?=$content?>
    <div class="container" style="width: 300px;">
    <table style="width: 100%;">
        <tr>
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$to_name ?></p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?></p>
            </td>
        </tr>
    </table>
    </div>
    <?php
    $message = ob_get_contents();
    ob_end_clean();

    try {
    //Server settings
    //$mail->SMTPDebug = 4;                      //Enable verbose debug output
    //$mail->isSMTP();                                            //Send using SMTP
    $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_veiw->username;                     //SMTP username
    $mail->Password   = $email_veiw->password;                                //SMTP password
    $mail->SMTPSecure = 'tls';      //  PHPMailer::ENCRYPTION_SMTPS     //Enable implicit TLS encryption
    $mail->Port = $email_veiw->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($from,  $to_name);
    $mail->addAddress($email,$from_name); //$fname    //Add a recipient
    $mail->addReplyTo($from, $to_name);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= $sub;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

    echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
    //echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
          echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));
    }
    } catch (Exception $e) {
    //echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;

     echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));
    }
    }
    }
    //Team HR Approved to Team head request
    public function hr_approve_thead_mail($emid,$emailsubject,$mailcontent,$postion) {
    // $email = $this->input->post('email');
    $id = $emid;

    $get_report = $this->leave_model->GetReportEmp($id);
    if($get_report){
    $email = $get_report->em_email;
    //user email
    $fname =  $get_report->first_name;
    $lname =  $get_report->last_name;
    $userid = $get_report->busunit;
    $theadid = $get_report->report_to;
    $get_head_address = $this->leave_model->Get_emp_address($theadid);
    $head_mail = $get_head_address->em_email;
    $head_name = $get_head_address->first_name.' '.$get_head_address->last_name;
    $get_to_address = $this->leave_model->Get_businessunit($userid);
    $hrid = $get_to_address->hr;
    $get_hr_address = $this->leave_model->Get_hr_address($hrid);
    //reciver name
    $first_name =  $get_hr_address->first_name;
    $last_name =  $get_hr_address->last_name;
    $hr =  $get_hr_address->em_email;
    //$To =  $get_to_address->em_email;
    $hr_name = $first_name.' '.$last_name;
    //user name
    $from_name = $fname.' '.$lname;
    $email_veiw = $this->settings_model->GetSmtp();
    $emp_veiw = $this->login_model->GetEMP($emid);

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$head_name ?> </p><br>
    <?=$mailcontent?>
    <div class="container" style="width: 300px;">
    <table style="width: 100%;">
        <tr>
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$hr_name ?></p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?></p>
            </td>
        </tr>
    </table>
    </div>
    <?php
    $message = ob_get_contents();
    ob_end_clean();

    try {
    //Server settings
    //$mail->SMTPDebug = 4;                      //Enable verbose debug output
    //$mail->isSMTP();                                            //Send using SMTP
    $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_veiw->username;                     //SMTP username
    $mail->Password   = $email_veiw->password;                                //SMTP password
    $mail->SMTPSecure = 'tls';      //  PHPMailer::ENCRYPTION_SMTPS     //Enable implicit TLS encryption
    $mail->Port = $email_veiw->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($hr,  $hr_name);
    $mail->addAddress($head_mail,$hr_name); //setFrom//Add a recipient
    $mail->addReplyTo($hr, $hr_name);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= $emailsubject;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

    // echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
    echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
    }
    } catch (Exception $e) {
    //echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;

    }
    }
    } 

    //Admin approval
    public function admin_approve_mail($emid,$start,$end) {
    // $email = $this->input->post('email');
    $id = $emid;

    $get_report = $this->leave_model->GetReportEmp($id);
    if($get_report){
    $email = $get_report->em_email;
    //user email
    $fname =  $get_report->first_name;
    $lname =  $get_report->last_name;
    $userid = $get_report->busunit;
    $theadid = $get_report->report_to;
    $get_head_address = $this->leave_model->Get_emp_address($theadid);
    $head_mail = $get_head_address->em_email;
    $head_name = $get_head_address->first_name.' '.$get_head_address->last_name;
    $get_to_address = $this->leave_model->Get_businessunit($userid);
    $hrid = $get_to_address->hr;
    $get_hr_address = $this->leave_model->Get_hr_address($hrid);
    //reciver name
    $first_name =  $get_hr_address->first_name;
    $last_name =  $get_hr_address->last_name;
    $hr =  $get_hr_address->em_email;
    //$To =  $get_to_address->em_email;
    $hr_name = $first_name.' '.$last_name;
    //user name
    $from_name = $fname.' '.$lname;
    $email_veiw = $this->settings_model->GetSmtp();
    $emp_veiw = $this->login_model->GetEMP($emid);

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$from_name ?> </p><br>
       
    <p>I am writing to confirm that your leave request has been approved. You are entitled to take the following days off:</p>
    <p><?php  if($start){ echo 'from  '. date('jS  F Y',strtotime($start)); }  if($end){ echo  'to'.' '.date('jS  F Y',strtotime($end)); } ?></p>
    <p>Please note that during your absence, your tasks will be temporarily reassigned to your colleagues. We trust that you have informed them of your absence and provided clear instructions for the handover of your work.</p>
    <p>Please ensure that you complete any outstanding tasks before your leave starts, and that you provide any necessary documentation or reports to your supervisor or team leader.</p>

    <p>If you have any questions or concerns regarding your leave, please do not hesitate to contact me. We wish you a pleasant and restful time off and look forward to welcoming you back to work upon your return.</p>
    <div class="container" style="width: 300px;">

    <table style="width: 100%;">
        <tr>

          
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
                <!-- <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$hr_name ?></p> -->
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> Administrator </p>
            </td>
        </tr>
    </table>
    </div>
    <?php
    $message = ob_get_contents();
    ob_end_clean();

    try {
    //Server settings
    //$mail->SMTPDebug = 4;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_veiw->username;                     //SMTP username
    $mail->Password   = $email_veiw->password;                                //SMTP password
    $mail->SMTPSecure = 'tls';      //  PHPMailer::ENCRYPTION_SMTPS     //Enable implicit TLS encryption
    $mail->Port = $email_veiw->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($email_veiw->username,  'Administration');
    $mail->addAddress($email,$from_name); //setFrom//Add a recipient
    //$mail->addReplyTo($hr, $hr_name);
    $mail->addCC($hr,  $hr_name);
    $mail->addCC($head_mail,$head_name);
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= "Approved Leave Request - ".$from_name;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

    echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
    //echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
        echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));
    }
    } catch (Exception $e) {
    //echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
     echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));
    }
    }
    }


}
