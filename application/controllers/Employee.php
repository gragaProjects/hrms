<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require FCPATH .'assets/phpmailer/phpmailer/src/Exception.php';
require FCPATH .'assets/phpmailer/phpmailer/src/PHPMailer.php';
require FCPATH .'assets/phpmailer/phpmailer/src/SMTP.php';

class Employee extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('dashboard_model');
        $this->load->model('employee_model');
        $this->load->model('login_model');
        $this->load->model('payroll_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('organization_model');
         $this->load->model('Timesheet_modal');
          $this->load->model('Certificate_modal');
  
    }
    
	public function index()
	{
		if ($this->session->userdata('user_login_access') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('user_login_access') == 1)
          $data= array();
        redirect('employee/Employees');
    
	}
    
    public function Employees(){
        if($this->session->userdata('user_login_access') != False) { 
            $this->session->unset_userdata('eid');
            $this->session->unset_userdata('Empid');
            $data['employee'] = $this->employee_model->emselect();
            $this->load->view('backend/employees',$data);
        }
        else{
    		redirect(base_url() , 'refresh');
    	}        
    }

    public function Add_employee(){
        if($this->session->userdata('user_login_access') != False) { 
            $data['businessunitvalue'] = $this->employee_model->businessunitvalue();
            $data['countryvalue'] = $this->settings_model->countryselect();
            $data['nationalityvalue'] = $this->employee_model->nationalityselect();
            $data['typevalue'] = $this->payroll_model->GetsalaryType();
            $data['leavetypes'] = $this->leave_model->GetleavetypeInfo(); 

            $email_veiw = $this->settings_model->GetEmail();
        
            $this->load->view('backend/add_new_employee',$data);
            //$this->load->view('backend/add_emp',$data);
        }
        else{
    		redirect(base_url() , 'refresh');
    	}            
    }  
 
    public function get_businesscode(){
        if($this->session->userdata('user_login_access') != False) { 
           
            $id = $this->input->post('id');
            $result = $this->employee_model->get_businesscode($id);

             $em_code = $this->employee_model->get_last_emp($id);
             if( $em_code ){
              $split_emp = explode("/", $em_code->em_code);
              $em_id = $split_emp[1];
              if($em_id){
                $em_id += 1;
              }else{
                $em_id = 101;
              }
               }else{
                $em_id = 101;
              }
             if($result)
             {
              echo json_encode(array('content'=>$result->code,'code'=>$em_id));
             }
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    
	public function Save(){ 
        if($this->session->userdata('user_login_access') != False) {     
        $eid = $this->input->post('eid');    
        $id = $this->input->post('emid');    
        //$empid = $this->input->post('empid'); 
        $empid = rand(1000,9999);   
    	$busunit = $this->input->post('busunit');
        $em_code = $this->input->post('em_code');
        $em_status = $this->input->post('em_status');
        $fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
    	$lname = $this->input->post('lname');
        $emrand = substr($fname,0,3).rand(1000,2000);    
    	$dept = $this->input->post('dept');
    	$deg = $this->input->post('deg');
        $prefix = $this->input->post('prefix');    
    	$role = $this->input->post('role');
    	$gender = $this->input->post('gender');
    	$contact = $this->input->post('contact');
    	$dob = $this->input->post('dob');	
    	$joindate = $this->input->post('joindate');	
    	$leavedate = $this->input->post('leavedate');	
    	$username = $this->input->post('username');	
    	$email = trim($this->input->post('email'));	
    	$password = sha1($contact);	
    	$confirm = $this->input->post('confirm');	
    	$nid = $this->input->post('nid');		
    	$blood = $this->input->post('blood');

        $reportto = $this->input->post('reportto');

        $em_image = $this->input->post('em_image');       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();

            if($this->employee_model->Does_email_exists($email)){
            
               echo json_encode(array('error'=>'Email is already Exist or Check your password'));
           
            } else {

                 if($_FILES['em_image']['name']){
                    //$settings = $this->settings_model->GetSettingsValue();
                    $file_name = $_FILES['em_image']['name'];
                    $fileSize = $_FILES["em_image"]["size"]/1024;
                    $fileType = $_FILES["em_image"]["type"];
      

                    $config = array(
                        'file_name' => $file_name,
                        'upload_path' => "./assets/uploads/userprofile",
                        'allowed_types' => "jpg|png|jpeg",
                        'overwrite' => False,
                        'max_size' => "1024", // Can be set to particular file size , here it is 220KB(220 Kb)
                        'max_height' => "600",
                        'max_width' => "600"
                    );
                     //create directory

                    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
                    $this->load->library('Upload', $config);
                    $this->upload->initialize($config);                
                    if (!$this->upload->do_upload('em_image')) {
                   // echo $this->upload->display_errors();
                    echo json_encode(array('status'=>'error','message'=>$this->upload->display_errors()));
                    }
            else {
                  $path = $this->upload->data();
                  $img_url =$path['file_name'];
                    $data = array();
                    $data = array(
                        'em_id' => $emrand,
                        'busunit' => $busunit,
                        'em_status' => $em_status,
                        'em_code' => $em_code,
                        'emp_id' => $empid,
                        'pre_id' => $prefix,
                        'des_id' => $deg,
                        'dep_id' => $dept,
                        'first_name' => $fname,
                        'middle_name' => $mname,
                        'last_name' => $lname,
        				'em_email' => $email,
        				'em_password'=>$password,
        				'em_role'=>$role,
        				'status'=>'ACTIVE',
                        'em_phone'=>$contact,
                        'em_joining_date'=>$joindate,
                        'em_contact_end'=>$leavedate,
                        'report_to'=>$reportto,
                        'em_image'=>$img_url
                     
                    );
                  
                        $add_success = $this->employee_model->Add($data);
                       if($add_success){
                         $this->send_pass($add_success); 
                         }       
                                            
                    
                }
                }else{
                   $data = array();
                    $data = array(
                        'em_id' => $emrand,
                        'busunit' => $busunit,
                        'em_status' => $em_status,
                        'em_code' => $em_code,
                        'emp_id' => $empid,
                        'pre_id' => $prefix,
                        'des_id' => $deg,
                        'dep_id' => $dept,
                        'first_name' => $fname,
                        'middle_name' => $mname,
                        'last_name' => $lname,
                        'em_email' => $email,
                        'em_password'=>$password,
                        'em_role'=>$role,
                        'status'=>'ACTIVE',
                        'em_phone'=>$contact,
                        'em_joining_date'=>$joindate,
                        'report_to'=>$reportto,
                        'em_contact_end'=>$leavedate
                     
                    );
                  
                        $add_success = $this->employee_model->Add($data);
                         if($add_success){
                        $this->send_pass($add_success); 
                         }       
                                
                }
            }
            //}
        }
   
    else{
	redirect(base_url() , 'refresh');
       }        
	}
    public function send_pass($add_success){
      if($this->session->userdata('user_login_access') != False) {
        
     $organisationvalue = $this->settings_model->GetOrganisationValue();
     if($organisationvalue->smtp == 'Yes'){
         $email = $this->input->post('email');
        $fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
        $lname = $this->input->post('lname');
       
        $contact = $this->input->post('contact');
         $password = sha1($contact); 
        $email_veiw = $this->settings_model->GetSmtp();
    
       $mail = new PHPMailer(true);
        ob_start();
        ?>
        
        <p> HI <?=$fname.$lname ?> Your Passowrd is :</p><br>
        <span><strong><?=$contact?></strong></span>
        <div class="container" style="width: 300px;">
          <table style="width: 100%;">
        <td style="border: 0;outline: none;width: 214px;">
                 <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Thank you</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Team<br><a href="http://agmtechnical.com/" style="text-decoration: none;color: #666666;">Graga Technologies</a></p>
              </td>
            </tr>
          </table>
       </div>
        <?php
        $body = ob_get_contents();
        ob_end_clean();
        try {

            if($email_veiw){
             //Server settings
            //$mail->SMTPDebug = 4;                      //Enable verbose debug output
            //$mail->isSMTP();                                            //Send using SMTP
            $mail->Host = $email_veiw->host;//'smtp.gmail.com';//Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username   = $email_veiw->username;                     //SMTP username
            $mail->Password   = $email_veiw->password;                                //SMTP password
            $mail->SMTPSecure = 'tls';// PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = $email_veiw->port;                                    
            //Recipients
            $mail->setFrom($email_veiw->from_mail, $email_veiw->from_name);
            $mail->addAddress($email, $fname);     //Add a recipient
            $mail->addReplyTo($email_veiw->from_mail, $email_veiw->from_name);
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Your Password';
            $mail->Body = $body;
            //$mail->AltBody = $customer_message;

            if ($mail->send()) {
                $this->session->set_userdata('eid',$add_success);
                 $query = $this->db->query("SELECT em_id FROM `employee` WHERE `isActive` = 1 AND `id` = $add_success ");
                 $result = $query->row();
                  $this->session->set_userdata('Empid',$result->em_id);

                echo json_encode(array('status'=>'success','message'=>'success','eid'=>$add_success));
            }
         }else{

                $this->session->set_userdata('eid',$add_success);
                //SELECT em_id FROM `employee` WHERE `isActive` = 1 AND id = 72
                $query = $this->db->query("SELECT em_id FROM `employee` WHERE `isActive` = 1 AND `id` = $add_success ");
                $result = $query->row();
                $this->session->set_userdata('Empid',$result->em_id);

                echo json_encode(array('status'=>'success','message'=>'Please Set Email Configration','eid'=>$add_success));
         }
        } catch (Exception $e) {

                $this->session->set_userdata('eid',$add_success);
                 $query = $this->db->query("SELECT em_id FROM `employee` WHERE `isActive` = 1 AND `id` = $add_success ");
                 $result = $query->row();
                  $this->session->set_userdata('Empid',$result->em_id);

            echo json_encode(array('status'=>'error','message'=>'Message could not be sent. Mailer Error: {$mail->ErrorInfo}','eid'=>$add_success));
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }else if($organisationvalue->smtp == 'No'){
        
        $email = $this->input->post('email');
        $fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
        $lname = $this->input->post('lname');
       
        $contact = $this->input->post('contact');
         $password = sha1($contact); 
        $Getemailfun = $this->settings_model->GetEmail();
    
        $to = $email; 
        $from = $Getemailfun->from_mail; 
        $fromName = $Getemailfun->from_name; 

         
        $subject = 'Your Password'; 
         
        ob_start();
        ?> 

        <p> HI <?=$fname.$lname ?> Your Passowrd is :</p><br>
        <span><strong><?=$contact?></strong></span>
        <div class="container" style="width: 300px;">
          <table style="width: 100%;">
        <td style="border: 0;outline: none;width: 214px;">
                 <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Thank you</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Team<br><a href="http://agmtechnical.com/" style="text-decoration: none;color: #666666;">Graga Technologies</a></p>
              </td>
            </tr>
          </table>
       </div>
            <?php $htmlContent = ob_get_contents();
        ob_end_clean();
        
        // Set content-type header for sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

        // Additional headers 
        // Create email headers
       $headers .= 'From: '.$fromName.' <'.$from.'>'."\r\n" .
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion(); 
         
        // Send email 
        if(mail($to, $subject, $htmlContent, $headers)){ 
           // echo 'Email has sent successfully.'; 
             $this->session->set_userdata('eid',$add_success);
                 $query = $this->db->query("SELECT em_id FROM `employee` WHERE `isActive` = 1 AND `id` = $add_success ");
                 $result = $query->row();
                  $this->session->set_userdata('Empid',$result->em_id);

                echo json_encode(array('status'=>'success','message'=>'success','eid'=>$add_success));
            
        }else{ 
           //echo 'Email sending failed.'; 
            //echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
             $this->session->set_userdata('eid',$add_success);
                 $query = $this->db->query("SELECT em_id FROM `employee` WHERE `isActive` = 1 AND `id` = $add_success ");
                 $result = $query->row();
                  $this->session->set_userdata('Empid',$result->em_id);

                echo json_encode(array('status'=>'success','message'=>'Error in sending Email.','eid'=>$add_success));
        }
       }
    
      
      
       }   
    }
	public function Update(){
     if($this->session->userdata('user_login_access') != False) {   
        $eid = $this->input->post('eid');    
        $id = $this->input->post('emid'); 
        $busunit = $this->input->post('busunit');
        $em_code = $this->input->post('em_code'); 
         $em_status = $this->input->post('em_status');
        $empid = $this->input->post('empid');
    	$fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
    	$lname = $this->input->post('lname');
    	$prefix = $this->input->post('prefix');  
        $dept = $this->input->post('dept');
    	$deg = $this->input->post('deg');
    	$role = $this->input->post('role');
    	$gender = $this->input->post('gender');
    	$contact = $this->input->post('contact');
    	$dob = $this->input->post('dob');	
    	$joindate = $this->input->post('joindate');	
    	$leavedate = $this->input->post('leavedate');	
    	$username = $this->input->post('username');	
    	$email = $this->input->post('email');	
    	$password = $this->input->post('password');	
    	$confirm = $this->input->post('confirm');	
    	$address = $this->input->post('address');		
    	$nid = $this->input->post('nid');		
    	$status = $this->input->post('status');		
    	$blood = $this->input->post('blood');	
         $reportto = $this->input->post('reportto');	
       
                     if($_FILES['em_image']['name']){
                    //$settings = $this->settings_model->GetSettingsValue();
                    $file_name = $_FILES['em_image']['name'];
                    $fileSize = $_FILES["em_image"]["size"]/1024;
                    $fileType = $_FILES["em_image"]["type"];
      

                    $config = array(
                        'file_name' => $file_name,
                        'upload_path' => "./assets/uploads/userprofile",
                        'allowed_types' => "gif|jpg|png|jpeg|svg",
                        'overwrite' => False,
                        'max_size' => "2048", // Can be set to particular file size , here it is 220KB(220 Kb)
                        'max_height' => "850",
                        'max_width' => "850"
                    );

                    //create directory

                    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
                    $this->load->library('Upload', $config);
                    $this->upload->initialize($config);                
                    if (!$this->upload->do_upload('em_image')) {
                   // echo $this->upload->display_errors();
                    echo json_encode(array('status'=>'error','message'=>$this->upload->display_errors()));
                    }
            else {
                  $path = $this->upload->data();
                  $img_url =$path['file_name'];
                              
                $data = array();
                $data = array(
                    
                     'busunit' => $busunit,
                        'em_status' => $em_status,
                        'em_code' => $em_code,
                        'emp_id' => $empid,
                        'pre_id' => $prefix,
                        'des_id' => $deg,
                        'dep_id' => $dept,
                        'first_name' => $fname,
                        'middle_name' => $mname,
                        'last_name' => $lname,
                        'em_email' => $email,
                        'em_role'=>$role,
                        'isActive'=>$status,
                        'em_phone'=>$contact,
                        'em_joining_date'=>$joindate,
                        'em_contact_end'=>$leavedate,
                        'report_to'=>$reportto,
                        'em_image'=>$img_url
                );
                if($id){
                $updsuccess = $this->employee_model->Update($data,$id);
                 if($updsuccess){
                      echo json_encode(array('status'=>'success','updsuccess'=>$updsuccess));
                }
                }            
                    
                }
                }else{
                  $data = array();
                $data = array(
                    
                     'busunit' => $busunit,
                        'em_status' => $em_status,
                        'em_code' => $em_code,
                        'emp_id' => $empid,
                        'pre_id' => $prefix,
                        'des_id' => $deg,
                        'dep_id' => $dept,
                        'first_name' => $fname,
                        'middle_name' => $mname,
                        'last_name' => $lname,
                        'em_email' => $email,
                        'em_role'=>$role,
                        'isActive'=>$status,
                        'em_phone'=>$contact,
                        'em_joining_date'=>$joindate,
                        'report_to'=>$reportto,
                        'em_contact_end'=>$leavedate
                );
                if($id){
                $updsuccess = $this->employee_model->Update($data,$id);
                 if($updsuccess){
                      echo json_encode(array('status'=>'success','updsuccess'=>$updsuccess));
                }
                }
                }
           
   
        }
        
      else{
		redirect(base_url() , 'refresh');
	       }        
  }
    public function view(){
        if($this->session->userdata('user_login_access') != False) {
            $id = base64_decode($this->input->get('I'));
            $data['basic'] = $this->employee_model->GetBasic($id);
            $data['businessunitvalue'] = $this->employee_model->businessunitvalue();
            $data['countryvalue'] = $this->settings_model->countryselect();
            $data['nationalityvalue'] = $this->employee_model->nationalityselect();
            $data['personalvalue'] = $this->employee_model->Getpersonalvalue($id);
            $data['skillvalue'] = $this->employee_model->Getskillvalue($id);
            //$data['permanent'] = $this->employee_model->GetperAddress($id);
            //$data['present'] = $this->employee_model->GetpreAddress($id);
            $data['education'] = $this->employee_model->GetEducation($id);
            $data['experience'] = $this->employee_model->GetExperience($id);
            $data['identitycards'] = $this->employee_model->GetIdentityCards($id);
            $data['bankinfo'] = $this->employee_model->GetBankInfo($id);
            $data['fileinfo'] = $this->employee_model->GetFileInfo($id);
            $data['typevalue'] = $this->payroll_model->GetsalaryType();
            $data['leavetypes'] = $this->leave_model->GetleavetypeInfo();    
            $data['salaryvalue'] = $this->employee_model->GetsalaryValue($id);
            $data['salarycurrency'] = $this->employee_model->GetcurrenyValue($id);
            $data['socialmedia'] = $this->employee_model->GetSocialValue($id);
            $data['dependency'] = $this->employee_model->GetDependencyValue($id);
            $data['disabiltydata'] = $this->employee_model->GetdisabilityValue($id);
            $data['getcertification'] = $this->employee_model->Get_certification($id);
                $year = date('Y');
            $data['Leaveinfo'] = $this->employee_model->GetLeaveiNfo($id,$year);
            if($data['basic']->busunit){
                 $data['policy_data'] = $this->employee_model->GetPolicy($data['basic']->busunit);
            }
           
            //$this->load->view('backend/employee_view',$data);
           // print_r($data['basic']->busunit);die();
            $this->load->view('backend/employee_details',$data);
            }
        else{
    		redirect(base_url() , 'refresh');
    	}         
    }

    public function Save_Personalinfo(){
        if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $eid = $this->input->post('eid');
        $gender = $this->input->post('gender');
        $bloodgroup = $this->input->post('bloodgroup');
        $nationality = $this->input->post('nationality');
        $maritalstatus = $this->input->post('maritalstatus');
        $dob = $this->input->post('dob');   
        $permanentaddress = $this->input->post('permanentaddress');
        $permanentcountry = $this->input->post('permanentcountry');
        $permanentstate = $this->input->post('permanentstate');

        $permanentdistrict = $this->input->post('permanentdistrict');
        $permanentpincode = $this->input->post('permanentpincode');

        $permanentcity = $this->input->post('permanentcity');
        $presentaddress = $this->input->post('presentaddress');
        $presentaddress = $this->input->post('presentaddress');
        $presentcountry = $this->input->post('presentcountry');
        $presentstate = $this->input->post('presentstate');

        
        $presentdistrict = $this->input->post('presentdistrict');
        $presentpincode = $this->input->post('presentpincode');


        $presentcity = $this->input->post('presentcity');
        $contactname = $this->input->post('contactname');
        $contactno = $this->input->post('contactno');
        $altercontact = $this->input->post('altercontact');
        $contactemail = $this->input->post('contactemail');

       //echo $presentdistrict; die();
   
       /* $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('edulevel', 'edulevel', 'trim|required|xss_clean');
        $this->form_validation->set_rules('course', 'course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('institute', 'institute', 'trim|required|min_length[5]|max_length[250]|xss_clean');
      */

        /*if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
               echo json_encode(array('valid'=>$error));
            } else {*/
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'eid' => $eid,
                    'gender' => $gender,
                    'bloodgroup' => $bloodgroup,
                    'nationality' => $nationality,
                    'dob' => $dob,
                    'maritalstatus' => $maritalstatus,
                    'permanentaddress' => $permanentaddress,
                    'permanentcountry' => $permanentcountry,
                    'permanentstate' => $permanentstate,
                    'permanentdistrict' => $permanentdistrict,
                    'permanentpincode' => $permanentpincode,
                    'permanentcity' => $permanentcity,
                    'presentaddress' => $presentaddress,
                    'presentcountry' => $presentcountry,
                    'presentstate' => $presentstate,
                    'presentdistrict' => $presentdistrict,
                    'presentpincode' => $presentpincode,
                    'presentcity' => $presentcity,
                    'contactname' => $contactname,
                    'contactno' => $contactno,
                    'altercontact' => $altercontact,
                    'contactemail' => $contactemail
                );
            if(empty($id)){
                $success = $this->employee_model->Add_personalinfo($data);
               
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>' Added Successfully'));//Employee Personal Details
                   } 
            } else {
                $success = $this->employee_model->Update_personalinfo($id,$data);
              
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>' Update Successfully')); }
            }
                       
        //}
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }

   
    //get Course
    public  function get_match_course(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('edulevel');
            //$id = 1;
             $result = $this->employee_model->get_match_course($id);

               $str='';
               if($result > 0){
                    $str.="<option value='' selected>Select Course</option>";
                foreach ($result as $value){
                
                   $str.="<option value=".$value->cId.">".$value->courseName."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    }
    /*Education*/
    public function Add_Education(){
        if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $edu_type = $this->input->post('edulevel');
        $course = $this->input->post('course');
        $institute = $this->input->post('institute');
        $percentage = $this->input->post('percentage');
        $from_year = $this->input->post('from_year');
        $to_year = $this->input->post('to_year');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('edulevel', 'edulevel', 'trim|required|xss_clean');
        $this->form_validation->set_rules('course', 'course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('institute', 'institute', 'trim|required|min_length[5]|max_length[250]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
               echo json_encode(array('valid'=>$error));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'edulevel' => $edu_type,
                    'course' => $course,
                    'institute' => $institute,
                    'percentage' => $percentage,
                    'from_year' => $from_year,
                    'to_year' => $to_year,
                    'createdBy' => $user
                );
            if(empty($id)){
                $success = $this->employee_model->Add_education($data);
               
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success));
                   } 
            } else {
                $success = $this->employee_model->Update_Education($id,$data);
              
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); }
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Add_Edudocument(){
         if($this->session->userdata('user_login_access') != False) {

            $this->load->library('upload');
             $edu_id = $this->input->post('edu_id');
            $em_id = $this->input->post('em_id');
            $edudoc_name = $this->input->post('edudoc_name');
    
            $number_of_files_uploaded = count($_FILES['edufiles']['name']);

    
        for ($i = 0; $i <  $number_of_files_uploaded; $i++) {
            $_FILES['userfile']['name']     = $_FILES['edufiles']['name'][$i];
            $_FILES['userfile']['type']     = $_FILES['edufiles']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['edufiles']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['edufiles']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['edufiles']['size'][$i];
            //configuration for upload your images
            $config = array(
                'file_name'     => $_FILES['edufiles']['name'][$i],
                'allowed_types' => 'jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf',
                'max_size'      => 3000,
                'overwrite'     => FALSE,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                 'upload_path' => "./assets/uploads/Edu_documents"
            );
             //create directory

            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

            $this->upload->initialize($config);
            $errCount = 0;//counting errrs
            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $theImages[] = array(
                    'errors'=> $error
                );//saving arrors in the array
            }else{
                $filename = $this->upload->data();
                $theImages[] = array(
                    'edufiles'=>$filename['file_name']
                );
                $data = array('edufiles' => $filename['file_name'],'edudoc_name'=>$edudoc_name,'em_id'=>$em_id,'edu_id'=>$edu_id);
                $result = $this->employee_model->Add_Edudocument($data);
                if($result){
                   echo json_encode(array('status'=>'success','message'=>$result)); 
                   
             
                  } 
            }//if file uploaded
            
        }//for loop end
       

         }
        else{
        redirect(base_url() , 'refresh');
       }
    } 
    public function Get_EducationDoc(){
     if($this->session->userdata('user_login_access') != False) {
      
         $em_id = $this->input->post('em_id');
         $edu_id = $this->input->post('edu_id');
         //$data = array('em_id'=>$em_id,'edu_id'=>$edu_id);
          $result = $this->employee_model->Get_EducationDoc($em_id,$edu_id);
            $str='';
               if($result > 0){
                   $i = 1;
                foreach ($result as $value){
                
                   $str.="<tr><td>".$i."</td>";
                    $str.="<td>".$value->edudoc_name."</td>";
                   $str.="<td><a href='".base_url()."assets/uploads/Edu_documents/".$value->edufiles." ' title='Attachments' class='btn btn-sm btn-warning waves-effect waves-light' target='_blank'><i class='fa fa-file-o'></i></a></td>";
                  
                   $str.='<td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light deledudocument" data-id='.$value->id.'><i class="fa fa-trash-o"></i></button></td>';
                   $str.="</tr>";
                   $i++;

                }
            }
            echo json_encode(array('status'=>'success','content'=>$str));


     }
    }
    public function Update_Education(){

    if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $edu_type = $this->input->post('edulevel');
        $course = $this->input->post('course');
        $institute = $this->input->post('institute');
        $percentage = $this->input->post('percentage');
        $from_year = $this->input->post('from_year');
        $to_year = $this->input->post('to_year');
        $this->form_validation->set_rules('edulevel', 'edulevel', 'trim|xss_clean');
        $this->form_validation->set_rules('course', 'course', 'trim|xss_clean');
        $this->form_validation->set_rules('institute', 'institute', 'trim|min_length[5]|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('error'=>$error));
                
            } else{
                $data = array();
                $data = array(
                    
                    'edulevel' => $edu_type,
                    'course' => $course,
                    'institute' => $institute,
                    'percentage' => $percentage,
                    'from_year' => $from_year,
                    'to_year' => $to_year
                    
                );
               
                    $doc_success = $this->employee_model->Update_Education($id,$data);
                    if($doc_success){
                   echo json_encode(array('status'=>'success','doc_success'=>$doc_success)); 
                   
             
                  } 
        
            
           
        }
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }
    public function DeleteEducation(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->DeleteEducation($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }  
     public function DeleteEducationDoc(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->DeleteEducationDoc($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
      public function skillsbyib(){
        if($this->session->userdata('user_login_access') != False) {  
        $id= $this->input->get('id');
        $data['skillsvalue'] = $this->employee_model->SkillValue($id);
        echo json_encode($data);
        }
    else{
        redirect(base_url() , 'refresh');
    } 
        
    }
      public function Save_skills(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $em_id = $this->input->post('em_id');
            $name = $this->input->post('name');
            $yearofexp = $this->input->post('yearofexp');
            $skilllevel = $this->input->post('skilllevel');
            $last_used_year = $this->input->post('last_used_year');
          
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
           
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[150]|xss_clean');
            $this->form_validation->set_rules('yearofexp', 'Year of experience', 'trim|required|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('valid'=>$error));
                
            } else {


            $val = $name;
            $table = 'emp_skills';
            $data = array('name'=> $val,'isActive'=> 1);
            if($this->employee_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This skill name  is already exists</p>'));
            } else{
         
                $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'name' => $name,
                    'yearofexp' => $yearofexp,
                    'skilllevel' => $skilllevel,
                    'last_used_year' => $last_used_year
                    
                );
               
                    $success = $this->employee_model->Add_Skills($data);
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
    public function Update_Skills(){

    if($this->session->userdata('user_login_access') != False) {
                 
            $id = $this->input->post('id');
            $em_id = $this->input->post('em_id');
            $name = $this->input->post('name');
            $yearofexp = $this->input->post('yearofexp');
            $skilllevel = $this->input->post('skilllevel');
            $last_used_year = $this->input->post('last_used_year');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
           
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[150]|xss_clean');
            $this->form_validation->set_rules('yearofexp', 'Year of experience', 'trim|required|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('error'=>$error));
                
            } else{
                $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'name' => $name,
                    'yearofexp' => $yearofexp,
                    'skilllevel' => $skilllevel,
                    'last_used_year' => $last_used_year
                    
                );
               
                    $success = $this->employee_model->Update_Skills($data,$id);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); 
                   
             
                  }  
            
           
        }
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }
    public function DeleteSKills(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->DeleteSKills($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    


    public function Add_GovIdentityCard(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $emp_id = $this->input->post('emp_id');
            $gov_id = $this->input->post('gov_id');
            $gid_number = $this->input->post('gid_number');
            $gid_expiry = $this->input->post('gid_expiry');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            /*$this->form_validation->set_rules('gov_id', 'gov_id', 'trim|required||xss_clean');*/
            $this->form_validation->set_rules('gid_number', 'govt Id number', 'trim|required|min_length[8]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('gid_expiry', 'expiry date', 'trim|required|min_length[5]|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('valid'=>$error));
                
            } else {


            $val = $gov_id;
            $table = 'emp_govtid';
            $data = array('gov_id'=> $val,'emp_id'=>$emp_id,'isActive'=> '1');
            if($this->employee_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This documents  is already exists</p>'));
            } else{
            if($_FILES['gov_doc']['name']){
            $file_name = $_FILES['gov_doc']['name'];
            $fileSize = $_FILES["gov_doc"]["size"]/1024;
            $fileType = $_FILES["gov_doc"]["type"];
            $new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/govdoc",
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf",
                'overwrite' => False,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "600",
                'max_width' => "600"
            );
             //create directory
            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('gov_doc')) {
                echo $this->upload->display_errors();
                #redirect("employee/view?I=" .base64_encode($eid));
            }
   
            else {
                $path = $this->upload->data();
                $gov_doc = $path['file_name'];
                $data = array();
                $data = array(
                    'emp_id' => $emp_id,
                    'gov_id' => $gov_id,
                    'gid_number' => $gid_number,
                    'gid_expiry' => $gid_expiry,
                    'gov_doc' => $gov_doc,
                    'isActive' => 1
                );
               
                    $success = $this->employee_model->Add_IdentityCard($data);
                    if($success){
                   echo json_encode(array('status'=>'success','success'=>$success)); 
                   
             
                  }  
            }
      
                                     
            }else {

                 $data = array();
                $data = array(
                    'emp_id' => $emp_id,
                    'gov_id' => $gov_id,
                    'gid_number' => $gid_number,
                    'gid_expiry' => $gid_expiry,
                    'isActive' => 1
                );
               
                    $doc_success = $this->employee_model->Add_IdentityCard($data);
                    if($doc_success){
                   echo json_encode(array('status'=>'success','doc_success'=>$doc_success)); 
                   
             
                  } 

            }
            }
            }
        }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
      public function Update_GovIdentityCard(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $emp_id = $this->input->post('emp_id');
            $gov_id = $this->input->post('GIDType');
            $gid_number = $this->input->post('GIDnumber');
            $gid_expiry = $this->input->post('GIDExpriy');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            /*$this->form_validation->set_rules('gov_id', 'gov_id', 'trim|required||xss_clean');*/
            $this->form_validation->set_rules('gid_number', 'govt Id number', 'trim|min_length[8]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('gid_expiry', 'expiry date', 'trim|min_length[5]|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('valid'=>$error));
                
            } else {


            $val = $gov_id;
            $table = 'emp_govtid';
            $data = array('gov_id'=> $val,'isActive'=> 1,'emp_id'=>$emp_id);
          
            if($_FILES['gov_doc']['name']){
            $file_name = $_FILES['gov_doc']['name'];
            $fileSize = $_FILES["gov_doc"]["size"]/1024;
            $fileType = $_FILES["gov_doc"]["type"];
            $new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/govdoc",
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf",
                'overwrite' => False,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "600",
                'max_width' => "600"
            );
             //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('gov_doc')) {
                echo $this->upload->display_errors();
                #redirect("employee/view?I=" .base64_encode($eid));
            }
   
            else {
                $path = $this->upload->data();
                $gov_doc = $path['file_name'];
                $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    //'gov_id' => $gov_id,
                    'gid_number' => $gid_number,
                    'gid_expiry' => $gid_expiry,
                    'gov_doc' => $gov_doc,
                    'isActive' => 1
                );
               
                    $doc_success = $this->employee_model->Update_GovIdentity($data,$id);
                    if($doc_success){
                   echo json_encode(array('status'=>'success','doc_success'=>$doc_success)); 
                   
             
                  }  
            }
      
                                     
            }else{
                $data = array();
                $data = array(
                    'emp_id' => $emp_id,
                    //'gov_id' => $gov_id,
                    'gid_number' => $gid_number,
                    'gid_expiry' => $gid_expiry,
                    'isActive' => 1
                );
               
                    $doc_success = $this->employee_model->Update_GovIdentity($data,$id);
                    if($doc_success){
                   echo json_encode(array('status'=>'success','doc_success'=>$doc_success)); 
                   
             
                  } 
            }
            
            }
        }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function Delete_GovIdentityCard(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('gid');
            $result_del = $this->employee_model->Delete_GovIdentityCard($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }


    public function Add_Experience(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('em_id');

        $exp_company = $this->input->post('exp_company');
        $exp_com_position = $this->input->post('exp_com_position');
        $exp_com_address = $this->input->post('exp_com_address');
        $workstart = $this->input->post('workstart');
        $workend = $this->input->post('workend');
        $leaving_reason = $this->input->post('leaving_reason');
        $referrer_name = $this->input->post('referrer_name');
        $referrer_contact = $this->input->post('referrer_contact');
        $referrer_email = $this->input->post('referrer_email');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('exp_company', 'company name', 'trim|required|min_length[5]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('exp_com_position', 'position name', 'trim|required|max_length[250]|xss_clean');
        $this->form_validation->set_rules('leaving_reason', 'reliving reason', 'trim|required|min_length[5]|max_length[250]|xss_clean');
           

        if ($this->form_validation->run() == FALSE) {
           $error = validation_errors();
               echo json_encode(array('valid'=>$error));

			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'exp_company' => $exp_company,
                    'exp_com_position' => $exp_com_position,
                    'exp_com_address' => $exp_com_address,
                    'workstart' => $workstart,
                    'workend' => $workend,
                    'leaving_reason' => $leaving_reason,
                    'referrer_name' => $referrer_name,
                    'referrer_contact' => $referrer_contact,
                    'referrer_email' => $referrer_email
                );
            if(empty($id)){
                $success = $this->employee_model->Add_Experience($data);
                 if($success){
                   echo json_encode(array('status'=>'success','message'=>$success));
                   } 
            } else {
                $success = $this->employee_model->Update_Experience($id,$data);
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
    public function Update_Experience(){

    if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
      $id = $this->input->post('id');
        $em_id = $this->input->post('em_id');
        $exp_company = $this->input->post('exp_company');
        $exp_com_position = $this->input->post('exp_com_position');
        $exp_com_address = $this->input->post('exp_com_address');
        $workstart = $this->input->post('workstart');
        $workend = $this->input->post('workend');
        $leaving_reason = $this->input->post('leaving_reason');
        $referrer_name = $this->input->post('referrer_name');
        $referrer_contact = $this->input->post('referrer_contact');
        $referrer_email = $this->input->post('referrer_email');
        $this->form_validation->set_rules('exp_company', 'company name', 'trim|required|min_length[5]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('exp_com_position', 'position name', 'trim|required|max_length[250]|xss_clean');
        $this->form_validation->set_rules('leaving_reason', 'reliving reason', 'trim|required|min_length[5]|max_length[250]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('error'=>$error));
                
            } else{
                $data = array();
                $data = array(
                    
                    'emp_id' => $em_id,
                    'exp_company' => $exp_company,
                    'exp_com_position' => $exp_com_position,
                    'exp_com_address' => $exp_com_address,
                    'workstart' => $workstart,
                    'workend' => $workend,
                    'leaving_reason' => $leaving_reason,
                    'referrer_name' => $referrer_name,
                    'referrer_contact' => $referrer_contact,
                    'referrer_email' => $referrer_email
                    
                );
               
                 $success = $this->employee_model->Update_Experience($id,$data);
                 if($success){
                   echo json_encode(array('status'=>'success','message'=>$success));
                   } 
        
            
           
        }
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }
    public function DeleteExperience(){
    if($this->session->userdata('user_login_access') != False) { 
        $id = $this->input->post('id');
        $result_del = $this->employee_model->DeletEXP($id);//
      if($result_del){
            echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
           
        }else{
             echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
         
        }
       
        }
    else{
        redirect(base_url() , 'refresh');
    }            
   }
   //experience document
     public function Add_Expdocument(){
         if($this->session->userdata('user_login_access') != False) {

            $this->load->library('upload');
             $exp_id = $this->input->post('exp_id');
            $em_id = $this->input->post('em_id');
            $expdoc_name = $this->input->post('expdoc_name');
    
            $number_of_files_uploaded = count($_FILES['expfiles']['name']);

    
        for ($i = 0; $i <  $number_of_files_uploaded; $i++) {
            $_FILES['userfile']['name']     = $_FILES['expfiles']['name'][$i];
            $_FILES['userfile']['type']     = $_FILES['expfiles']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['expfiles']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['expfiles']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['expfiles']['size'][$i];
            //configuration for upload your images
            $config = array(
                'file_name'     => $_FILES['expfiles']['name'][$i],
                'allowed_types' => 'jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf',
                'max_size'      => 3000,
                'overwrite'     => FALSE,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                 'upload_path' => "./assets/uploads/Experience_documents"
            );
                //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

            $this->upload->initialize($config);
            $errCount = 0;//counting errrs
            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());
                $theImages[] = array(
                    'errors'=> $error
                );//saving arrors in the array
            }
            else
            {
                $filename = $this->upload->data();
                $theImages[] = array(
                    'expfiles'=>$filename['file_name']
                );
                $data = array('expfiles' => $filename['file_name'],'expdoc_name'=>$expdoc_name,'em_id'=>$em_id,'exp_id'=>$exp_id);
                $result = $this->employee_model->Add_Expdocument($data);
                if($result){
                   echo json_encode(array('status'=>'success','message'=>$result)); 
                   } 
            }//if file uploaded
            
        }//for loop end
       

         }
        else{
        redirect(base_url() , 'refresh');
       }
    } 
     public function Get_ExperienceDoc(){
     if($this->session->userdata('user_login_access') != False) {
      
         $em_id = $this->input->post('em_id');
         $exp_id = $this->input->post('exp_id');
         //$data = array('em_id'=>$em_id,'edu_id'=>$edu_id);
          $result = $this->employee_model->Get_ExperienceDoc($em_id,$exp_id);
            $str='';
               if($result > 0){
                   $i = 1;
                foreach ($result as $value){
                
                   $str.="<tr><td>".$i."</td>";
                    $str.="<td>".$value->expdoc_name."</td>";
                   $str.="<td><a href='".base_url()."assets/uploads/Experience_documents/".$value->expfiles." ' title='Attachments' class='btn btn-sm btn-warning waves-effect waves-light' target='_blank'><i class='fa fa-file-o'></i></a></td>";
                  
                   $str.='<td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delexpdocument" data-id='.$value->id.'><i class="fa fa-trash-o"></i></button></td>';
                   $str.="</tr>";
                   $i++;
                }
            }
            echo json_encode(array('status'=>'success','content'=>$str));


     }
    }
      public function DeleteExperienceDoc(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->DeleteExperienceDoc($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //certification
      public function Add_Certification(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $em_id = $this->input->post('emid');
            $certificate_name = $this->input->post('certificate_name');
            $certificate_no = $this->input->post('certificate_no');
            $certificate_expdate = $this->input->post('certificate_expdate');
            
            $val = $certificate_name;
            $table = 'emp_certificate';
            $data = array('certificate_name'=> $val,'isActive'=> 1);
            if($this->employee_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This certificate  is already exists</p>'));
            } else{
            if($_FILES['certificate']['name']){
            $file_name = $_FILES['certificate']['name'];
            $fileSize = $_FILES["certificate"]["size"]/1024;
            $fileType = $_FILES["certificate"]["type"];
            $new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/certificate",
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf",
                'overwrite' => False,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "600",
                'max_width' => "600"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

            $this->upload->initialize($config);      
            $this->load->library('Upload', $config);
                
            if (!$this->upload->do_upload('certificate')) {
                //echo 
                $error = $this->upload->display_errors();
                  echo json_encode(array('valid'=>$error));
                #redirect("employee/view?I=" .base64_encode($eid));
            }
   
            else {

                $path = $this->upload->data();
                $certificate = $path['file_name'];
                $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'certificate_name' => $certificate_name,
                    'certificate_no' => $certificate_no,
                    'certificate_expdate' => $certificate_expdate,
                    'certificate' => $certificate,
                    'isActive' => 1
                );
               
                     $certificate_data = $this->employee_model->Add_Certification($data);
                    if($certificate_data){
                 echo json_encode (array('status'=>'success','message'=>$certificate_data));                   }  

            }
      
                                     
            }
            }
            //}
        }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
      public function Update_Certification(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $em_id = $this->input->post('emid');
            $certificate_name = $this->input->post('certificate_name');
            $certificate_no = $this->input->post('certificate_no');
            $certificate_expdate = $this->input->post('certificate_expdate');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
          
            if($_FILES['certificate']['name']){
            $file_name = $_FILES['certificate']['name'];
            $fileSize = $_FILES["certificate"]["size"]/1024;
            $fileType = $_FILES["certificate"]["type"];
            $new_file_name='';
            $new_file_name .= $id;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/certificate",
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf",
                'overwrite' => False,
                'max_size' => "20240000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "600",
                'max_width' => "600"
            );
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('certificate')) {
                echo $this->upload->display_errors();
                #redirect("employee/view?I=" .base64_encode($eid));
            }
   
            else {
                $path = $this->upload->data();
                $certificate = $path['file_name'];
                $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'certificate_name' => $certificate_name,
                    'certificate_no' => $certificate_no,
                    'certificate_expdate' => $certificate_expdate,
                    'certificate' => $certificate,
                    'isActive' => 1
                );
               
                    $success = $this->employee_model->Update_Certification($data,$id);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); 
                   
             
                  }  
            }
      
                                     
            }else{
                $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'emp_id' => $em_id,
                    'certificate_name' => $certificate_name,
                    'certificate_no' => $certificate_no,
                    'certificate_expdate' => $certificate_expdate,
                    'isActive' => 1
                );
               
                    $success = $this->employee_model->Update_Certification($data,$id);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); 
                   } 
            }
            
            
        }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function Delete_Certification(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->Delete_Certification($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

   
    public function Disciplinary(){
        if($this->session->userdata('user_login_access') != False) {
        $data['desciplinary'] = $this->employee_model->desciplinaryfetch();
        $this->load->view('backend/disciplinary',$data); 
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function add_Desciplinary(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $warning = $this->input->post('warning');
        $title = $this->input->post('title');
        $details = $this->input->post('details');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('title', 'title', 'trim|required|max_length[150]|xss_clean');
        $this->form_validation->set_rules('details', 'details', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect('Disciplinary');
			} else {

             $val = $title;
            $table = 'desciplinary';
            $data = array('em_id'=> $em_id,'title'=> $title,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('status'=>'error','message'=>'<p>This Desciplinary  is already exists</p>'));
            } else {
               
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'action' => $warning,
                    'title' => $title,
                    'description' => $details
                );
            if(empty($id)){
                $success = $this->employee_model->Add_Desciplinary($data);
                 if( $success ){
                     echo json_encode(array('status'=>'success','message'=>'Desciplinary Added Successfully')); 
                }
            } else {
                $success = $this->employee_model->Update_Desciplinary($id,$data);
                if( $success ){
                     echo json_encode(array('status'=>'success','message'=>'Desciplinary Updated Successfully')); 
                }
               
            }
                       
        }
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Add_bank_info(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $em_id = $this->input->post('emid');
        $holder = $this->input->post('holder_name');
        $bank = $this->input->post('bank_name');
        $branch = $this->input->post('branch_name');
        $number = $this->input->post('account_number');
        $account = $this->input->post('account_type');
        $ifsc = $this->input->post('ifsc');
        $swift = $this->input->post('swift');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('holder_name', 'holder name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_number', 'account name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('branch_name', 'branch name', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
          
                 $error = validation_errors();
               //echo json_encode(array('error'=>$error));
			} else {
            $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'holder_name' => $holder,
                    'bank_name' => $bank,
                    'branch_name' => $branch,
                    'account_number' => $number,
                    'account_type' => $account,
                    'ifsc' => $ifsc,
                    'swift' => $swift
                );
            if(empty($id)){
                $success = $this->employee_model->Add_BankInfo($data);
                if($success){
                   echo json_encode(array('status'=>'success','message'=>'Bank Details Added Successfully')); 
                   }
                
                //echo "Successfully Added";
            } else {
                $success = $this->employee_model->Update_BankInfo($id,$data);
                  if($success){
                   echo json_encode(array('status'=>'success','message'=>'Bank Details Updated Successfully')); 
                   }
            }
                       
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Password_Reset(){
        if($this->session->userdata('user_login_access') != False) {
          $usertype = $this->input->post('usertype');
        // if($usertype == 'ADMIN' || $usertype == 'SUPER ADMIN' && $usertype !== 'EMPLOYEE'){
        $id = $this->input->post('emid');
        $onep = $this->input->post('new1');
        $twop = $this->input->post('new2');
            if($onep == $twop){
                $data = array();
                $data = array(
                    'em_password'=> sha1($onep)
                );
        $success = $this->employee_model->Reset_Password($id,$data);
        if($success){
            echo json_encode(array('status'=>'success','message'=>"Password Updated Successfully"));
            } 
                //echo "Successfully Updated";
            } else {
               echo json_encode(array('status'=>'error','message'=>"Please enter valid password"));
       
                //echo "Please enter valid password";
            }
            }
            }

        public function Password_Reset_Model(){
        if($this->session->userdata('user_login_access') != False) {
          $usertype = $this->input->post('usertype');
        
        $id = $this->input->post('emid');
        $onep = $this->input->post('new1');
        $twop = $this->input->post('new2');
            if($onep == $twop){
                $data = array();
                $data = array(
                    'em_password'=> sha1($onep),
                    'password_changed'=>'1'
                );
        $success = $this->employee_model->Reset_Password($id,$data);
        if($success){
            echo json_encode(array('status'=>'success','message'=>"Password Updated Successfully"));
            } 
                //echo "Successfully Updated";
            } else {
               echo json_encode(array('status'=>'error','message'=>"Please enter valid password"));
       
                //echo "Please enter valid password";
            }

        
        }
    }
    

    public function Reset_Password_Hr(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('emid');
        $onep = $this->input->post('new1');
        $twop = $this->input->post('new2');
            if($onep == $twop){
                $data = array();
                $data = array(
                    'em_password'=> sha1($onep)
                );
        $success = $this->employee_model->Reset_Password($id,$data);
        #$this->session->set_flashdata('feedback','Successfully Updated');
        #redirect("employee/view?I=" .base64_encode($id));
                echo "Successfully Updated";
            } else {
        $this->session->set_flashdata('feedback','Please enter valid password');
        #redirect("employee/view?I=" .base64_encode($id)); 
                echo "Please enter valid password";
            }

        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Reset_Password(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('emid');
        $oldp = sha1($this->input->post('old'));
        $onep = $this->input->post('new1');
        $twop = $this->input->post('new2');
        $pass = $this->employee_model->GetEmployeeId($id);
        if($pass->em_password == $oldp){
            if($onep == $twop){
                $data = array();
                $data = array(
                    'em_password'=> sha1($onep)
                );
        $success = $this->employee_model->Reset_Password($id,$data);
        $this->session->set_flashdata('feedback','Successfully Updated');
        #redirect("employee/view?I=" .base64_encode($id));
                echo "Successfully Updated";
            } else {
        $this->session->set_flashdata('feedback','Please enter valid password');
        #redirect("employee/view?I=" .base64_encode($id));
                echo "Please enter valid password";
            }
        } else {
            $this->session->set_flashdata('feedback','Please enter valid password');
            #redirect("employee/view?I=" .base64_encode($id));
            echo "Please enter valid password";
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Department(){
        if($this->session->userdata('user_login_access') != False) {
        $data['department'] = $this->employee_model->depselect();
        $this->load->view('backend/department',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Save_dep(){
        if($this->session->userdata('user_login_access') != False) {
       $dep = $this->input->post('department');
       $this->load->library('form_validation');
       $this->form_validation->set_error_delimiters();
       $this->form_validation->set_rules('department','department','trim|required|xss_clean');

       if ($this->form_validation->run() == FALSE) {
           echo validation_errors();
           redirect('employee/Department');
       }else{
        $data = array();
        $data = array('dep_name' => $dep);
        $success = $this->employee_model->Add_Department($data);
        #$this->session->set_flashdata('feedback','Successfully Added');
        #redirect('employee/Department');
       }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Designation(){
        if($this->session->userdata('user_login_access') != False) {
        $data['designation'] = $this->employee_model->desselect();
        $this->load->view('backend/designation',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Des_Save(){
        if($this->session->userdata('user_login_access') != False) {
        $des = $this->input->post('designation');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('designation','designation','trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            redirect('employee/Designation');
        }else{
            $data = array();
            $data = array('des_name' => $des);
            $success = $this->employee_model->Add_Designation($data);
            $this->session->set_flashdata('feedback','Successfully Added');
            redirect('employee/Designation');
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}
    }
    public function Assign_leave(){
        if($this->session->userdata('user_login_access') != False) {
        $emid = $this->input->post('em_id');
        $type = $this->input->post('typeid');
        $day = $this->input->post('noday');
        $year = $this->input->post('year');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('typeid','typeid','trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            #redirect('employee/Designation');
        }else{
            $data = array();
            $data = array(
                'emp_id' => $emid,
                'type_id' => $type,
                'day' => $day,
                //'total_day' => '0',
                'year' => $year
            );
            $success = $this->employee_model->Add_Assign_Leave($data);
            echo "Successfully Added";
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}
    }
   
    //Dependancy
        public function Add_Dependency(){
        if($this->session->userdata('user_login_access') != False) {

            $id = $this->input->post('id');
            $em_id = $this->input->post('em_id');
            $name = $this->input->post('name');
            $relation = $this->input->post('relation');
            $dob = $this->input->post('dob');
            $age = $this->input->post('age');
          
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
           
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[150]|xss_clean');
            $this->form_validation->set_rules('relation', 'relation', 'trim|required|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('valid'=>$error));
                
            } else {


            $val = $relation;
            $table = 'emp_dependency';
            $data = array('em_id'=>$em_id,'relation'=> $val,'isActive'=> 1);
            if($this->employee_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This relation  is already exists</p>'));
            } else{
         
                $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'name' => $name,
                    'relation' => $relation,
                    'dob' => $dob,
                    'age' => $age
                    
                );
               
                    $success = $this->employee_model->Add_Dependency($data);
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

    public function dependencybyib(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$data['dependencyvalue'] = $this->employee_model->GetDependencyData($id);
		echo json_encode($data);
        }
    else{
		redirect(base_url() , 'refresh');
	} 
        
    }
    public function Update_Dependency(){

    if($this->session->userdata('user_login_access') != False) {
                 
            $id = $this->input->post('id');
            $em_id = $this->input->post('em_id');
            $name = $this->input->post('name');
            $relation = $this->input->post('relation');
            $dob = $this->input->post('dob');
            $age = $this->input->post('age');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
           
          
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[150]|xss_clean');
            $this->form_validation->set_rules('relation', 'relation', 'trim|required|max_length[250]|xss_clean');


            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('error'=>$error));
                
            } else{
                 $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'name' => $name,
                    'relation' => $relation,
                    'dob' => $dob,
                    'age' => $age
                );
               
                    $success = $this->employee_model->Update_Dependency($data,$id);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); 
                   
             
                  }  
            
           
        }
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }//Deletedependency
        public function Deletedependency(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->Deletedependency($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    public function certificatebyib(){
        if($this->session->userdata('user_login_access') != False) {  
    		$id= $this->input->get('id');
    		$data['certificatevalue'] = $this->employee_model->GetCertificateValue($id);
    		echo json_encode($data);
            }
        else{
    		redirect(base_url() , 'refresh');
    	}    
    } 
    public function personaldocbyib(){
        if($this->session->userdata('user_login_access') != False) {  
            $id= $this->input->get('id');
            $data['documentvalue'] = $this->employee_model->GetDocValue($id);
            echo json_encode($data);
            }
        else{
            redirect(base_url() , 'refresh');
        }    
    }
   public function educationbyib(){
        if($this->session->userdata('user_login_access') != False) {  
            $id= $this->input->get('id');
            $data['educationvalue'] = $this->employee_model->GetEduValue($id);
            echo json_encode($data);
            }
        else{
            redirect(base_url() , 'refresh');
        }    
    }   public function experiencebyib(){
        if($this->session->userdata('user_login_access') != False) {  
            $id= $this->input->get('id');
            $data['expvalue'] = $this->employee_model->GetExpValue($id);
            echo json_encode($data);
            }
        else{
            redirect(base_url() , 'refresh');
        }    
    }

    public function idCardbyib(){
        if($this->session->userdata('user_login_access') != False) {  
            $id= $this->input->get('id');
            $data['idcardvalue'] = $this->employee_model->GetIDCardValue($id);
            echo json_encode($data);
        }
        else{
            redirect(base_url() , 'refresh');
        }    
    }

    public function DisiplinaryByID(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$data['desipplinary'] = $this->employee_model->GetDesValue($id);
		echo json_encode($data);
        }
    else{
		redirect(base_url() , 'refresh');
	} 
        
    }
    public function EduvalueDelet(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('id');
		$success = $this->employee_model->DeletEdu($id);
		echo "Successfully Deletd";
        }
    else{
		redirect(base_url() , 'refresh');
	} 
    }

    public function EXPvalueDelet(){
        if($this->session->userdata('user_login_access') != False) {  
    		$id= $this->input->get('id');
    		$success = $this->employee_model->DeletEXP($id);
    		echo "Successfully Deletd";
        }
        else{
    		redirect(base_url() , 'refresh');
    	} 
    }

    public function IDvalueDelete(){
        if($this->session->userdata('user_login_access') != False) {  
            $id= $this->input->get('id');
            $success = $this->employee_model->DeleteIDCard($id);
            echo "Successfully Deletd";
        }
        else{
            redirect(base_url() , 'refresh');
        } 
    }

    public function DeletDisiplinary(){
        if($this->session->userdata('user_login_access') != False) {  
		$id= $this->input->get('D');
		$success = $this->employee_model->DeletDisiplinary($id);
		#echo "Successfully Deletd";
            redirect('employee/Disciplinary');
        }
    else{
		redirect(base_url() , 'refresh');
	} 
    }
    public function Add_Salary(){
        if($this->session->userdata('user_login_access') != False) { 
        $sid = $this->input->post('id');
        $aid = $this->input->post('aid');
        $did = $this->input->post('did');
        $em_id = $this->input->post('emid');
        $type = $this->input->post('typeid');
        $currencytype = $this->input->post('currencytype');
        $total = $this->input->post('total');
        $basic = $this->input->post('basic');
        $houserent = $this->input->post('houserent');
       
        $medical = $this->input->post('medical');
        $conveyance = $this->input->post('conveyance');
        $provident = $this->input->post('provident');
        $bima = $this->input->post('bima');
        $tax = $this->input->post('tax');
        $others = $this->input->post('others');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('total', 'total', 'trim|required|min_length[3]|max_length[10]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("employee/view?I=" .base64_encode($em_id));
			} else {
            $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'type_id' => $type,
                    'currencytype' => $currencytype,
                    'total' => $total,
                    'basic' => $basic,
                    'hra' => $houserent
                );
            if(!empty($sid)){

                  // Delete duplicate records for the employee
               $this->employee_model->deleteDuplicateSalaries($em_id);

                $updatesuccess = $this->employee_model->Update_Salary($sid,$data);
                  
                if($updatesuccess){
                           
                echo json_encode(array('status'=>'success','message'=>'Salary Updated Successfully'));
                            }  
               
               //  if(!empty($aid)){
               //  $data1 = array();
               //  $data1 = array(
               //      'salary_id' => $sid,
               //      'basic' => $basic,
               //      'medical' => $medical,
               //      'house_rent' => $houserent,
               //      'conveyance' => $conveyance
               //  );
               // // $success = $this->employee_model->Update_Addition($aid,$data1);                    
               //  }
               //  if(!empty($did)){
               //   $data2 = array();
               //  $data2 = array(
               //      'salary_id' => $sid,
               //      'provident_fund' => $provident,
               //      'bima' => $bima,
               //      'tax' => $tax,
               //      'others' => $others
               //  );
               //  //$success = $this->employee_model->Update_Deduction($did,$data2);                    
               //  }
                

                            
            } else {

                $success = $this->employee_model->Add_Salary($data);
                if($success){
                           
               
                $insertId = $this->db->insert_id();
               //  $data1 = array();
               //  $data1 = array(
               //      'salary_id' => $insertId,
               //      'basic' => $basic,
               //      'medical' => $medical,
               //      'house_rent' => $houserent,
               //      'conveyance' => $conveyance
               //  );
               // // $success = $this->employee_model->Add_Addition($data1);
               //  $data2 = array();
               //  $data2 = array(
               //      'salary_id' => $insertId,
               //      'provident_fund' => $provident,
               //      'bima' => $bima,
               //      'tax' => $tax,
               //      'others' => $others
               //  );
               // $success = $this->employee_model->Add_Deduction($data2); 
                //echo "Successfully Added";

                 echo json_encode(array('status'=>'success','message'=>'Salary Added Successfully'));
                            
            }           
            }           
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
	public function confirm_mail_send($email,$pass_hash){
		$config = Array( 
		'protocol' => 'smtp', 
		'smtp_host' => 'ssl://smtp.googlemail.com', 
		'smtp_port' => 465, 
		'smtp_user' => 'mail.imojenpay.com', 
		'smtp_pass' => ''
		); 		  
         $from_email = "imojenpay@imojenpay.com"; 
         $to_email = $email; 
   
         //Load email library 
         $this->load->library('email',$config); 
   
         $this->email->from($from_email, 'Dotdev'); 
         $this->email->to($to_email);
         $this->email->subject('Hr Syatem'); 
		 $message	 =	"Your Login Email:"."$email";
		 $message	.=	"Your Password :"."$pass_hash"; 
         $this->email->message($message); 
   
         //Send mail 
         if($this->email->send()){ 
         	$this->session->set_flashdata('feedback','Kindly check your email To reset your password');
		 }
         else {
         $this->session->set_flashdata("feedback","Error in sending Email."); 
		 }			
	}
    public function Inactive_Employee(){
        $data['invalidem'] = $this->employee_model->getInvalidUser();
        $this->load->view('backend/invalid_user',$data);
    }

       //Disablity
        public function Add_Disablity(){
        if($this->session->userdata('user_login_access') != False) {

            $id = $this->input->post('id');
            $em_id = $this->input->post('em_id');
            $disability_name = $this->input->post('disability_name');
            $disability_type = $this->input->post('disability_type');
            $description = $this->input->post('description');
           
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
           
            $this->form_validation->set_rules('disability_name', 'disability_name', 'trim|required|max_length[150]|xss_clean');
           // $this->form_validation->set_rules('relation', 'relation', 'trim|required|max_length[250]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('valid'=>$error));
                
            } else {


       /*     $val = $relation;
            $table = 'emp_dependency';
            $data = array('relation'=> $val,'isActive'=> 1);
            if($this->employee_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This relation  is already exists</p>'));
            } else{*/
         
                $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'disability_name' => $disability_name,
                    'disability_type' => $disability_type,
                    'description' => $description
                    
                );
               
                    $success = $this->employee_model->Add_disability($data);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); 
                   
             
                  }  
            
                                     
            //}
            }
            }
        
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Disablitybyib(){
        if($this->session->userdata('user_login_access') != False) {  
        $id= $this->input->get('id');
        $data['disabilityvalue'] = $this->employee_model->GetDisablityData($id);
        echo json_encode($data);
        }
    else{
        redirect(base_url() , 'refresh');
    } 
        
    }
    public function Update_Disablity(){

    if($this->session->userdata('user_login_access') != False) {
                 
            $id = $this->input->post('id');
            $em_id = $this->input->post('em_id');
             $disability_name = $this->input->post('disability_name');
            $disability_type = $this->input->post('disability_type');
            $description = $this->input->post('description');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
           
          
            $this->form_validation->set_rules('disability_name', 'disability_name', 'trim|required|max_length[150]|xss_clean');
            //$this->form_validation->set_rules('relation', 'relation', 'trim|required|max_length[250]|xss_clean');


            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('error'=>$error));
                
            } else{
                 $data = array();
                $data = array(
                    'emp_id' => $em_id,
                    'disability_name' => $disability_name,
                    'disability_type' => $disability_type,
                    'description' => $description
                );
               
                    $success = $this->employee_model->Update_disability($data,$id);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success)); 
                   
             
                  }  
            
           
        }
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }
    //Deletedependency
        public function Deletedisablity(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->Deletedisability($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //disciplinarydelete
      public function disciplinarydelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->disciplinarydelete($id);//
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
     //get department from business unit
    public  function get_match_department(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('busunit');

            $dep = $this->input->post('dep');
            //$id = 1;
             $result = $this->employee_model->get_match_department($id);

               $str='';
               if($result > 0){
                    $str.="<option value='' selected>Select Department</option>";
                foreach ($result as $value){
                
                   $str.="<option value='".$value->id."' ";
                   if(( $value->id == $dep)){ $str.="selected";} 
                   $str.=">".$value->depname." (".$value->depcode.")</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    }

     public function Add_File(){
    if($this->session->userdata('user_login_access') != False) { 
    $em_id = $this->input->post('em_id');           
    $filetitle = $this->input->post('title');           
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('title', 'title', 'trim|required|max_length[120]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            //echo validation_errors();
             $error = validation_errors();
               echo json_encode(array('error'=>$error));
            
            } else {
            if($_FILES['file_url']['name']){
            $file_name = $_FILES['file_url']['name'];
            $fileSize = $_FILES["file_url"]["size"]/1024;
            $fileType = $_FILES["file_url"]["type"];
            $new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf",
                'overwrite' => False,
                'max_size' => "40480000"
            );

            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file_url')) {
                echo $this->upload->display_errors();
                #redirect("employee/view?I=" .base64_encode($em_id));
            }
   
            else {
                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'file_title' => $filetitle,
                    'file_url' => $img_url
                );
            $file_success = $this->employee_model->File_Upload($data); 
            if($file_success){
                echo json_encode(array('status'=>'success','file_success'=>$file_success));
              }
            }
        }
            
        }
        }
    else{
        redirect(base_url() , 'refresh');
    }        
    }

  public function Update_File(){

    if($this->session->userdata('user_login_access') != False) {
                 
            $id = $this->input->post('id');
            $em_id = $this->input->post('emid');
                   
        $filetitle = $this->input->post('title');           
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('title', 'title', 'trim|required|max_length[120]|xss_clean');

        
            //$this->form_validation->set_rules('relation', 'relation', 'trim|required|max_length[250]|xss_clean');


            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                $error = validation_errors();
               echo json_encode(array('error'=>$error));
                
            } else{
            if($_FILES['file_url']['name']){
            $file_name = $_FILES['file_url']['name'];
            $fileSize = $_FILES["file_url"]["size"]/1024;
            $fileType = $_FILES["file_url"]["type"];
            $new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/images/users",
                'allowed_types' => "jpg|jpeg|png|doc|docx|xls|xlsx|txt|pdf",
                'overwrite' => False,
                'max_size' => "40480000"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file_url')) {
                echo $this->upload->display_errors();
                #redirect("employee/view?I=" .base64_encode($em_id));
            }
   
            else {
                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'em_id' => $em_id,
                    'file_title' => $filetitle,
                    'file_url' => $img_url
                );
            $file_success = $this->employee_model->File_Update($data,$id); 
            if($file_success){
                echo json_encode(array('status'=>'success','file_success'=>$file_success));
              }
            }
        }else {
         
           
            $data = array(
                    'em_id' => $em_id,
                    'file_title' => $filetitle
                   
                );
            $file_success = $this->employee_model->File_Update($data,$id); 
            if($file_success){
                echo json_encode(array('status'=>'success','file_success'=>$file_success));
              }
        
        
        }
         
                  
        }
            
           
        }
        
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }
     //DeletePersonal Doc
        public function Deletepersonal(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->employee_model->Deletepersonal($id);//Deletepersonal
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //Get report person

    //get Report to
    public  function GetReportEmp(){
       if($this->session->userdata('user_login_access') != False) { 
         
             $id = $this->input->post('busunit');

            $report = $this->input->post('report');

             $result = $this->employee_model->GetReportEmp($id); 

               $str='';
               if($result > 0){
                    $str.="<option value='' >Select Employee</option>";
                foreach ($result as $value){
                
                   $str.="<option value='".$value->em_id."' ";
                   if(( $value->em_id == $report)){ $str.="selected";} 
                   $str.=" >".$value->first_name .' '.$value->last_name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             }
     }
         //cron job offical document expire
    public function Document_expire(){
      if($this->session->userdata('user_login_access') != False) {


        $email_veiw = $this->settings_model->GetSmtp();


        $Get_Sequence_info = $this->settings_model->GetEmailSequence();
        //print_r($Get_Sequence_info); die();
        foreach($Get_Sequence_info as $svalue){
        $govt_id = $svalue->govt_id;
        $sequence =  $svalue->sequence;

        $get_expire = $this->employee_model->document_cronjob($govt_id,$sequence);
           
             // print_r($get_expire); 
        foreach($get_expire as $value){
   
       if($value->hr){
         // print_r($value->hr); 
        $hr_id = $value->hr;
        $get_hr_info = $this->employee_model->getemp($hr_id);
          //print_r($get_hr_info); 
        $hr_email = $get_hr_info->em_email;

        $mail = new PHPMailer(true);
        ob_start();
        ?>
        
        <p> HI <?=$value->first_name.' '.$value->last_name;?>  <?=$value->govID_name;?> Document is Expire on <?=  date("d-M-Y", strtotime($value->gid_expiry));?>  Kindly Renew As soon as possible.</p><br>
        
        <div class="container" style="width: 300px;">
          <table style="width: 100%;">
        <td style="border: 0;outline: none;width: 214px;">
        
                 <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Thank you</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Team<br><a href="http://agmtechnical.com/" style="text-decoration: none;color: #666666;">Graga Technologies</a></p>
              </td>
            </tr>
          </table>
       </div>
        <?php
        $body = ob_get_contents();
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
            $mail->Port = $email_veiw->port;                               //TCP port to 
            //Recipients
            $mail->setFrom($email_veiw->from_mail, $email_veiw->from_name);
            $mail->addAddress($hr_email, $value->first_name.$value->last_name);     //Add a recipient
       
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Document Expire Reminder';
            $mail->Body = $body;
            //$mail->AltBody = $customer_message;

            if ($mail->send()) {
                echo json_encode(array('status'=>'success','message'=>'success'));
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        }
       }
      }
       }   
    }
  //dropdown country
   public  function get_country(){
       if($this->session->userdata('user_login_access') != False) { 
           
             $result = $this->settings_model->countryselect();

               $str='';
               if($result > 0){
                    $str.="<option value='' selected>Select Country</option>";
                foreach ($result as $value){
                
                   $str.="<option value=".$value->id.">".$value->country_name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    } 

 public function Employee_holidays(){
    if($this->session->userdata('user_login_access') != False) {
   $id = base64_decode($this->input->get('id'));
        $data['employee']    = $this->employee_model->emselect(); 
           $data['timemasterselect'] = $this->Timesheet_modal->timemasterselect();
        $data['dailytimesheetdata'] = $this->Timesheet_modal->DailyTimesheetview($id);
    $this->load->view('backend/employee_holidays',$data); 
    }
    else{
    redirect(base_url() , 'refresh');
    }            
    }

    public function Get_timesheet(){
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
                  <td>'.$value->login.'</td>
                  <td>'.$value->breakin.'</td>
                  <td>'.$value->breakout.'</td>
                  <td>'.$value->logout.'</td>
                  

                  <td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delsheetdetails" data-id="'.$value->details_id.'"><i class="fa fa-trash-o"></i></button></td>
                </tr>';
                
                $i++; }

            }

         }
    }
       public  function load()
     {

     $emid       = $this->input->get('emid');
     $month      = $this->input->get('month');

      $event_data =  $this->employee_model->Get_employee_event();//$emid,$month
      //echo '<pre>';print_r($event_data); echo '</pre>';die();
      $i = 1;
      foreach($event_data as $row)

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

    public function Add_HolidayList(){
         if($this->session->userdata('user_login_access') != False) {

            $emp_id = $this->input->post('emp_id');
         
             $startdate = $this->input->post('date'); //assign_holidays
             $color = $this->input->post('color'); //assign_holidays
           $val = '';
            $table = 'assign_holidays';
            $data = array('emp_id'=> trim($emp_id),'date'=> $startdate,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
                echo json_encode(array('error'=>'<p>This  is already exists</p>'));
            }else{
            $data = array(
                    'emp_id' => $emp_id,
                    'date' => $startdate,
                    'color' => $color

                    
                );

                 $success = $this->db->insert('assign_holidays',$data);
                 if($success){
            echo json_encode(array('status'=>'success','message'=>' Added Successfully '));
            } 
            } 
         }
    }
       //delete timesheet leave
    public function HolidayListDelete(){
    if($this->session->userdata('user_login_access') != False) { 
    $id = $this->input->post('id');
    $result_del = $this->db->delete('assign_holidays',array('id'=> $id));
    if($result_del){
        echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
       
    }

    }
    else{
    redirect(base_url() , 'refresh');
    }            
    }

    //Appoiment pdf
       ///Sigle payslip
        public function pdf(){
        $id    = $this->input->get('Id');
        $eid  = $this->input->get('em');
        $data = array();
        $payslip_data = $this->payroll_model->Generate_payslip($id,$eid );
        
        $employee_info      = $this->payroll_model->getEmployeeID($eid);
        $otherInfo      = $this->payroll_model->getOtherInfo($eid);
        $employeeID = $eid;
        $month_num = date("m", strtotime($payslip_data->month));
        $date = $month_num.'-'.$payslip_data->year;

             /**/
        $busid = $employee_info->busunit;
        $businessunitvalue = $this->settings_model->GetBusinessunitValue($busid);

        // print_r($businessunitvalue);
        if(isset($businessunitvalue->holidaystructureid)){
        $structureid = $businessunitvalue->holidaystructureid;
        $leavestructureid = $businessunitvalue->leavestructureid;
        $data['structureid'] = $structureid;
        $data['leavestructureid'] = $structureid;
        }else{
        $structureid = '';
        $leavestructureid = '';
        }
        /**/

        $leavecountresult = $this->payroll_model->Get_emp_leave_count($employeeID,$date,$leavestructureid);
        $leavecount = $leavecountresult->leavecount;
        
        //paid condition
        $paidleavecountresult = $this->payroll_model->Get_paid_leave_count($employeeID,$date);
        //if($paidleavecountresult->paidstatus == 'paid'){
        
        if($paidleavecountresult->leavecount > $paidleavecountresult->Total_days){
        
        $paid_result = $paidleavecountresult->leavecount - $paidleavecountresult->Total_days;
        
        
        $leavecount +=$paid_result;
        }
        //organisation info
        $organisationvalue = $this->settings_model->GetOrganisationValue();
       // print_r($organisationvalue->organisation);die();
        $datetime = $date;
        //get allowance
        $getallowance = $this->payroll_model->Get_allowance($eid,$datetime);
        //get deduction
        $getdeduction = $this->payroll_model->Get_deduction($eid,$datetime);


          
        $totalinwords = $this->NumberintoWords($payslip_data->total_pay);//
        $cur_month = date("M", strtotime($payslip_data->month));
        $cur_year = $payslip_data->year;
        //half count
        $halfleavecountresult = $this->payroll_model->Halfday_pdf_leave_count($employeeID,$date);
        $data['halfleavecountresult'] = $halfleavecountresult->halfdays;
        $half_d_count = 0;
        if($halfleavecountresult->halfdays){
        $half_d_count =  0.5 * $halfleavecountresult->halfdays;
         
        }
        $this->load->library('AppointmentPdf');
        // create new PDF document
        $pdf = new AppointmentPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Appointment Letter');
        $pdf->SetSubject('Appointment Letter');
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
       // $pdf->setPrintHeader(false);
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

            //water mark

        // // Set the alpha value for transparency
        // $pdf->SetAlpha(0.5);

        // // Set the position and size of the watermark image
        // $pdf->Image(''. base_url().'/assets/images/logo/logo1.png', 50, 50, 100, 0, '', '', '', false, 300);

        // // Reset alpha value
        // $pdf->SetAlpha(1);


        //water mark

    

     //------------------content-------------------------


        // $html = '
        // <style type="text/css">
        // table td, table th {
        // padding: 3px !important;
        // }
        // </style>
        // <table style=" width: 100%;  border-bottom:2px solid black;">
        //     <tr>
            
        //         <td  style="width:80% !important ;vertical-align: middle; text-align:" rowspan="2" class="text-center"><p style="font-size:24px;" >AGM Technical Solutions Co WLL';
                   
                   
        //             $html.= '</p>
        //         </td>
        //             <td  style="width:20% !important; "  class="text-right"> <img src="'. base_url().'/assets/images/logo/logo1.png" style="width: 120px;" /> </td>
                
        //     </tr>
            
        // </table>
        // </style>
        // ';
        
                
        $html .= '
           
            <h5 class="text-center" style="font-weight:bold;text-align:center;font-size:16px">Letter of Appointment</h5>
              <table style="width:100%;"  cellpadding="2" cellspacing="5">
                <tr>
                    <td  width="40">Date:</td>
                    <td  width="">'. date('d-M-Y').'</td>
                   
                </tr>
                <tr>'; 
            $html .='<td width="">[Employee Name]</td> </tr>';
            $html .='<tr><td width="">No. 21, Road No. 357</td> </tr>';
            $html .='<tr><td width="">Block No. 304,</td></tr>';
            $html .='<tr><td width="">Manama, Kingdom of Bahrain</td> </tr>';
                  
                $html .='
               
            </table>

          <table style="width:100%; margin-top: 50px;" >
          <br>
          <br>
             <tr>
                 <td  width="50" >  Dear</td>
                  <td  width="" style="font-weight:bold">[Employee Name]</td></tr>  
                  <br>
            <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;" colspan="2"> Welcome to <strong> Graga Technologies</strong>  Concerning the discussion, we had with you, we are pleased to appoint you as a <strong> Web Developer </strong> under the following terms and conditions:</td>       
            </tr></table>
            ' ; 
      
                $html .='<table style="width:100%; margin-top: 50px;" >
          <br>
          <br>
             <tr>
                 <td style="font-weight:bold"> 1. Commencement Date</td>
                  </tr>  
                  <br>
            <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;">      
               Your date of appointment will be effective from [Appointment Date]</td>       
            </tr></table>  ';     

            $html .='<table style="width:100%; margin-top: 50px;" >
                <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 2. Standard Conditions of Employment</td>
                </tr>
                <br>
                <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%; "><p style="text-align: justify">
                (a) The Standard Conditions of Employment will relate to various matters relating to your working with the Company, including hours of work, holidays, leave, code of conduct, and confidentiality policy as   &nbsp;&nbsp;&nbsp;Company Policy Documents.</p></td>
            </tr> 
            <br>
                <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;">
                (b) The Standard Conditions of Employment may be changed by the Company from time to time at the
                sole discretion of the Company and such changed Standard Conditions of Employment shall become applicable to you forthwith, upon receipt of notice of the same.</td>
            </tr>
            </table>  ';   

          $html .='<table style="width:100%; margin-top: 50px;" >
                <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 3. Representations</td>
                </tr>
                <br>
                <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">
                (a) You hereby represent that all the contents of your resume, testimonials, references, previous
                      employment details and other information furnished by you are true and accurate.</td>
            </tr> 
            <br>
                <tr>&nbsp;&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;">
                (b) If any of the above particulars are found to be incorrect or misleading in any way, the Company shall have the right to terminate your employment forthwith, without the requirement of providing you with any notice or compensation in lieu thereof. </td>
            </tr>
             <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 4. Place of work</td>
                </tr>
                <br>
                <tr><td align="" style="width: 100%; text-align:justify">
                &nbsp;&nbsp;&nbsp;Work from home.</td>
            </tr> 
            <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 5. Working Hours
                </td>
                </tr>
                <br>
                <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">
                You have work from Saturday to Thursday from 10.30 AM to 7.30 PM & (Friday holiday). 
                You have to serve your duties with proper discharge for the company during these working hours.</td>
            </tr> 
           
            </table>  ';
       // ----------Second page--------------


          $html .='<table style="width:100%; margin-top: 50px;" >
                <br>
                <br>
                 <br>
                <br>
                <br>
                <br>
                <tr><td style="font-weight:bold"> 6.Probationary Period
                </td>
                </tr>
                <br>
                <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">
                The 3 months as probationary period needs to be served by the candidate, after joining the job.</td>
            </tr> 

            <br>
            <br>
            <tr>
                <td style="font-weight:bold"> 7. Compensation
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) Your compensation is based on your qualifications; skill sets and overall experience. Therefore, the compensation payable to you by the Company is unique and personal and any comparison of the same with those of others will be of no relevance.</td>
            </tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) Your salary will be reviewed yearly as per the policy of the company. Your increments in the salary are discretionary and will be subject to and based on effective performance and financial goals of the company during the period.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) Except to the extent prescribed by law, the breakup of compensation shall be entirely at the discretion of the Company but will be based on such factors as level of employment, tax efficiency, fairness, and management convenience.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(d) Your terms of employment and compensation are strictly confidential, and you shall not divulge the same to any other employee of the Company except where required by Company policy.</td>
            </tr>           

             <br>
            <br>
            <tr>
                <td style="font-weight:bold"> 8. Corrupt Practices
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) Never give, offer, or authorize the offer of, either directly or indirectly, anything of value (such as money, goods, or services) to a customer or government official to obtain any improper advantage. A business courtesy, such as a gift, Contribution or entertainment should never be offered under circumstances that might create the appearance of impropriety.</td>
            </tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) No political contributions shall be made using Company funds or assets provided to any political party, political campaign, political candidate, or public official in India or any foreign country unless the contribution is lawful and expressly authorized in writing by the Director.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) During the period that you are employed by the Company, you shall not, either while acting on behalf of the Company or the pretext thereof, accept from any person or entity, that any consideration for any assessment or decision may be favorable to that person or entity. Such consideration shall include any item or conduct that may be of value such as a gift, bribe, payment, performance, favor, etc.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(d) You shall not use company funds for any unlawful & unethical purpose. Also, you shall not offer, give or cause others to give, any payments to influence the';$html .=" recipient's business judgment.</td>
            </tr>";

             $html .='<br>
            <br>
            <tr>
                <td style="font-weight:bold"> 9. Protecting the assets of the Company & Our Customers
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) You shall be responsible for protecting Graga Technologies & its customers assets which are found in many different forms including physical assets, proprietary information, intellectual property, and confidential information.</td>
            </tr><br><br>';
                 // ----------Third page--------------

           $html .='
           <br>
           <br>
           <br>
           <br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) You must be alert to any situations or incidents that could lead to the loss, misuse or theft of Company or customer assets. All such situations must be reported to the IT Department as soon as the situation arises.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) All inventions, improvements and discoveries made solely by you or jointly while on duty need to be disclosed to the company and the company has the sole right, title and interest over such inventions, improvements, and discoveries and has the intellectual property rights over them.</td></tr><br>
            

             <br>
            <br>

            <tr>
                <td style="font-weight:bold"> 10. Non-Solicitation / Non-Compete
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) You shall not directly or indirectly, or through any other party, solicit or offer employment to any persons who are employees of the Company or its affiliates for a period of 18 Months after the date of termination of your employment with the Company.</td>
            </tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) You shall not, directly, indirectly, or through any third party, solicit business from, any customer of the Company for a period of one year after the date of termination of your employment with the Company.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) You shall not, directly, or indirectly, perform services or take up employment with any competitor of the Company for a period of one year after the date of termination of your employment with the Company.</td></tr><br>
            

             <br>
            <br> 
            <tr>
                <td style="font-weight:bold"> 11. Change of Circumstances 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">Any change in your residential address, telephone numbers, marital status, and academic qualifications should be notified in writing forthwith to the company. All communications will be addressed to you at the last address notified by you and it will be presumed that you have received such communications addressed to you.</td>
            </tr>
            

             <br>
            <br>
            <tr>
                <td style="font-weight:bold"> 12. Notice Period Clause 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">Notice given under this Contract shall be in writing and if to be given to the Employer shall be delivered by hand or sent by registered or recorded delivery post to a Director of the Employer or its registered office and if to be given to the Employee shall be handed to the Employee or sent by registered or recorded delivery post to the';$html .=" Employee's"; $html .='last known residential address. Notice sent by post is deemed to be given on the sixty (60) working days after posting.</td>
            </tr>
            

             <br>
            <br>

              <tr>
                <td style="font-weight:bold"> 13. Return of Assets 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">On termination of your employment, you shall immediately handover to the company all assets, equipment, records, documents, accounts, letters, memoranda, and papers of every description belonging to the company and within your possession, in good order, fair wear and tear excepted; failing which the company can take legal action as it may deem fit.</td>
            </tr>
            

             <br>
            <br>
            <br>
            <br>
            </table>  ';
             // ----------Fourth page--------------
        $html .= ' <table style="width:100%; margin-top: 50px;" >
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">We congratulate you on your appointment and wish you a long career with us. We assure you that have a great journey and get our full support for your professional growth and development. </td>
            </tr> 
            <br>
            <br>
             <tr>
            &nbsp;<td align="" style="width: 100%;" colspan="2">We reaffirm our complete confidence in your abilities to find professional and personal satisfaction here.</td>
            </tr> 
               <br>
            <br>
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">Please sign and return a copy of this Appointment letter in acceptance of the terms and conditions. </td>
            </tr>
             <br>
            <br>
            <br>
            <br>
            </table> 
            ' ;
               $html .= ' <div>
            <table style="width:100%; margin-top: 10px;" >
            <br>
            <br>
            <br>
                <tr>&nbsp;&nbsp;<td  width="" style="font-weight:bold"> Regards, </td></tr>
                <tr>'; 
            $html .='&nbsp;<td width="">HR sign</td> </tr>';
            $html .='<tr><td width="" style="font-weight:bold">HR Name</td> </tr> ';
            $html .='<tr><td width="">Manager, Human Resources and Talent Recruiting.</td></tr>  
            ';

            // Add content to the first page
            $pdf->writeHTML($html);

            // Add a manual page break
            $pdf->AddPage();
       
             $html1 = '  <div style=" margin-top: 0px;">
            <h6 class="text-center" style="font-weight:bold;text-align:center;font-size:16px;text-decoration: underline;">ANNEXURE</h6>
        
               </div>
                <br>
                <br>
                <br>


                 <br>
            <br>
            <table style="width:100%; margin-top: 50px;" >
              <tr>
                <td style="font-weight:bold"> Salary Breakup 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">Your compensation is strictly between yourself and the company. It has been determined on various factors such as your job, skills, and professional merit. This information and any changes therein should be treated as personal and confidential.</td>
            </tr>
             <br>

               <br>
            <br>
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">Your total annual CTC will be Rs. <strong>xxxxx /- </strong> - and its composition will be as follows:</td>
            </tr>
             <br>
            <br>
            <br>
              </table> 
               '; 

           $html1 .= '
           <br>
             <br>
            <br>
            <br>
           <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-left: 50px; margin-right: 50px;">
                <tr style="width: 100%; margin-left: 50px; margin-right: 50px;">
                    <th style="text-align: center;font-weight:bold">Components of Salary</th>
                    <th style="text-align: center;font-weight:bold">Amount (Rs) </th>
                </tr> 
                <tr>
                    <td style="text-align: center;">Fixed Salary Components (Monthly)</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Basic</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: center;">HRA</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Conveyance</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: center;">Other Benefits</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: center;">Total Gross Salary (Monthly)</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: ;font-weight:bold">Total Gross Salary (Annually) </td>
                    <td style="text-align: center;">xxxxx</td>
                </tr>
            </table>';

              $html1 .= '  
            <table style="width:100%; margin-top: 50px;" >
              
             <br>

               <br>
            <br>
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">Amount in words: <strong>xxxxx /- </strong></td>
            </tr>
             <br>
            <br>
            <br>
            <tr>
                <td style="font-weight:bold"> Acknowledgement 
                </td>
            </tr>
            <br>
            <tr>
             <td align="" style="width: 100%; text-align:justify"> I, <strong>[Employee Name] </strong> accepts the appointment, agrees to the terms and conditions stated above, and I hereby confirm that I will adhere to the policies of the company and discharge my duties to the satisfaction of the higher authorities</td>
            </tr>
             <br>
            <br>
            <br></table> 
               '; 

                  $html1 .= '
             <br>
             <br>
            <br>
            <br>
           <table  cellpadding="2" cellspacing="0" style="width: 100%; margin-left: 50px; margin-right: 50px;">
                <tr style="">
                    <td style="width: 30%;text-align: center;">'. date('d-M-Y').'</td>
                     <td style="text-align: center;width: 40%;"></td> 
                    <td style="text-align: center;font-weight:bold;width: 30%;"></td>
                </tr> 
                <tr style="">
                    <td style="text-align: center;font-weight:bold;border-bottom: 1px solid black;border-top: 0px solid white;width: 30%;"></td>
                     <td style="text-align: center;width: 40%;"></td> 
                    <td style="text-align: center;font-weight:bold;border-bottom: 1px solid black;border-top: 0px solid white;width: 30%;"></td>
                </tr> 
                 <tr style="">
                    <td style="width: 30%;">Date</td>
                     <td style="text-align: center;width: 40%;"></td> 
                    <td style="width: 30%;">Signature</td>
                </tr> 
              
               
             </table>';


   
   
                  
           

      
        
        $filename = "AppointmentLetter";
        
        $pdf->writeHTML($html1, true, false, true, false, '');

      

        // reset pointer to the last page
        $pdf->lastPage();
        
        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($filename.'.pdf', 'I');

        }


         public function qr()
        {
        
        $qrCode = new QrCode('agmtechnicalsolution.com');
        // Save black on white PNG image 100 px wide to filename.png. Colors are RGB arrays.
        $output = new Output\Png();
        $data = $output->output($qrCode, 100, [255, 255, 255], [1, 1, 1]);
        file_put_contents('assets/filename.png', $data);
        // Echo an HTML table
        $output = new Output\Html();
        // echo $output->output($qrCode);
        }



        function NumberintoWords(float $amount)
        {
           $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
           // Check if there is any number after decimal
           $amt_hundred = null;
           $count_length = strlen($num);
           $x = 0;
           $string = array();
           $change_words = array(
              0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
              7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
              13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
              18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
              50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
           );
           $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
           while ($x < $count_length) {
              $get_divider = ($x == 2) ? 10 : 100;
              $amount = floor($num % $get_divider);
              $num = floor($num / $get_divider);
              $x += $get_divider == 10 ? 1 : 2;
              if ($amount) {
                 $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                 $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                 $string[] = ($amount < 21) ?
                    $change_words[$amount] . ' ' . $here_digits[$counter] . ' ' . $amt_hundred :
                    $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' ' . $here_digits[$counter] . ' ' . $amt_hundred;
              } else {
                 $string[] = null;
              }
           }
           $implode_to_Rupees = implode('', array_reverse($string));
           $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
           
           $output = ($implode_to_Rupees ? $implode_to_Rupees . 'Rupee' . ($implode_to_Rupees === 'One' ? '' : 's') . ' ' : '') . $get_paise;
           
           return $output;
        }

           // public function getappointment(){
           //   $id    = $this->input->get('Id');
           //   $eid  = $this->input->get('emp_id');
           //   $data['employee_data']      = $this->payroll_model->getEmployeeID($eid);
           //  // Make sure $data['employee_data'] is an object before accessing its properties
           //  if (is_object($data['employee_data'])) {
           //      // Assuming these methods return strings, not objects
           //      $country = ($data['employee_data']->presentcountry) ? $this->settings_model->country_edit($data['employee_data']->presentcountry) : '';
           //      $state = ($data['employee_data']->presentstate) ? $this->settings_model->state_edit($data['employee_data']->presentstate) : '';
           //      $district = ($data['employee_data']->presentdistrict) ? $this->settings_model->district_edit($data['employee_data']->presentdistrict) : '';
           //      $city = ($data['employee_data']->presentcity) ? $this->settings_model->city_edit($data['employee_data']->presentcity) : '';

           //      // Assuming $data['employee_data']->presentaddress is a string
           //      $address = $data['employee_data']->presentaddress;

           //     //Address ,District ,City ,State ,

           //      $data['address'] = ($address ? $address . ',' : '') . ($district ? $district->district_name . ',' : "") . ($city ? $city->city_name . ',' : "") . ($state ? $state->state_name : "");
           //      // $data['address'] = ($address ? $address . '<br>,' : '') . ($district ? $district->district_name . ',' : "") . ($city ? $city->city_name . '<br>,' : "") . ($state ? $state->state_name : "");

           //  }

           //  //  else {
           //  //     // Handle the case where $data['employee_data'] is not an object
           //  //     $data['address'] = "Invalid employee data";
           //  // }
                                     
           //   echo json_encode($data);
           // }

            //9-12-23
              public function getappointment(){
             $id    = $this->input->get('Id');
             $eid  = $this->input->get('emp_id');
             $busunit  = $this->input->get('busunit');
             $data['employees']      = $this->employee_model->getemp($eid);
             $data['employee_data']      = $this->Certificate_modal->get_template_by_busunit($busunit);
      
            
                                     
             echo json_encode($data);
           }

           public function getTemplateTags() {
            $templateId = $this->input->get('template_id');
            $tags = $this->Certificate_modal->getTemplateTags($templateId);

            // Return the tags as JSON
            echo json_encode($tags);
        }
        //9-12-23 save dynamic fields
    
        // public function Save_TempalteFields() {
        //     // Retrieve other form data
        //     $templateId = $this->input->post('template_id');
        //     $empId = $this->input->post('emp_id');

        //     // Retrieve dynamic fields data
        //     $dynamicFieldsData = json_decode($this->input->post('dynamic_fields'), true);

        //     // Save dynamic fields in emp_template table
        //     $result = [];
        //     foreach ($dynamicFieldsData as $field) {
        //         $data = array(
        //             'template_id' => $templateId,
        //             'emp_id' => $empId,
        //             'tag_name' => $field['tag_name'],
        //             'tag_value' => $field['tag_value'],
        //         );

        //         // Check for duplicate entry based on emp_id, template_id, tag_name
        //         if (!$this->isDuplicateDynamicField($data)) {
        //             $result = $this->db->insert('emp_template', $data);
        //         }
        //           //print_r($data);
        //     }
        //     // $emdata = (
        //     //      'template_id' => $empId,
        //     //      'appointment_status' => $empId,
        //     // );
        //   // $em =  $this->employee_model->Update($emdata,$empId);
        //    //  print_r($data);
           
        //     $response = array('status' => 'success');
        //     echo json_encode($response);
        // }

        // // Function to check for duplicate entry in emp_template
        // private function isDuplicateDynamicField($data) {
        //     $query = $this->db->get_where('emp_template', array(
        //         'emp_id' => $data['emp_id'],
        //         'template_id' => $data['template_id'],
        //         'tag_name' => $data['tag_name'],
        //     ));

        //     return $query->num_rows() > 0;
        // }
   public function Save_TempalteFields() {
    // Retrieve other form data
    $templateId = $this->input->post('template_id');
    $empId = $this->input->post('emp_id');

    // Retrieve dynamic fields data
    $dynamicFieldsData = json_decode($this->input->post('dynamic_fields'), true);

    // Process each dynamic field data
    foreach ($dynamicFieldsData as $field) {
        // Check if the record already exists in emp_template
        $existingData = $this->getDynamicField($empId, $templateId, $field['tag_name']);

        // Prepare data for insertion or update
        $data = array(
            'template_id' => $templateId,
            'emp_id' => $empId,
            'tag_name' => $field['tag_name'],
            'tag_value' => $field['tag_value'],
        );

        // Insert or update based on existence
        if ($existingData) {
            // If the record exists, update it
            $this->updateDynamicField($data);
        } else {
            // If the record doesn't exist, insert it
            $this->insertDynamicField($data);
        }
    }

            // Send success response
            $response = array('status' => 'success');
            echo json_encode($response);
        }

        // Function to check if a dynamic field record already exists
        private function getDynamicField($empId, $templateId, $tagName) {
            $query = $this->db->get_where('emp_template', array(
                'emp_id' => $empId,
                'template_id' => $templateId,
                'tag_name' => $tagName,
            ));

            return $query->row_array();
        }

        // Function to insert a dynamic field record
        private function insertDynamicField($data) {
            $this->db->insert('emp_template', $data);
        }

        // Function to update a dynamic field record
        private function updateDynamicField($data) {
            $this->db->where(array(
                'emp_id' => $data['emp_id'],
                'template_id' => $data['template_id'],
                'tag_name' => $data['tag_name'],
            ));
            $this->db->update('emp_template', $data);
        }

        public function getExistingData()
        {
        $templateId = $this->input->get('template_id');
        $empId = $this->input->get('emp_id');
        $existingData = $this->Certificate_modal->getExistingData($empId, $templateId);

        echo json_encode($existingData);
        }

        //9-12-23 save dynamic fields




           public function Save_Appointment() {
        // Retrieve individual POST variables
            $employee_name = $this->input->post('employee_name');
            $position = $this->input->post('position');
            $place_of_work = $this->input->post('place_of_work');
            $joining_date = $this->input->post('joining_date');
            $basic = $this->input->post('basic');
            $hra = $this->input->post('hra');
            $conveyance = $this->input->post('conveyance');
            $other_benefits = $this->input->post('other_benefits');
            $total_gross_salary_monthly = $this->input->post('total_gross_salary_monthly');
            $total_gross_salary_annually = $this->input->post('total_gross_salary_annually');
            $address = $this->input->post('address');
            $emp_id = $this->input->post('emp_id');
            $busunit_id = $this->input->post('busunit_id');

            // Additional data or validation can be added here

            // Load the model
            //$this->load->model('Employee_model');

            // Prepare data for insertion into the database
            $data = array(
                'employee_name' => $employee_name,
                'position' => $position,
                'place_of_work' => $place_of_work,
                'joining_date' => $joining_date,
                'basic' => $basic,
                'hra' => $hra,
                'conveyance' => $conveyance,
                'other_benefits' => $other_benefits,
                'total_gross_salary_monthly' => $total_gross_salary_monthly,
                'total_gross_salary_annually' => $total_gross_salary_annually,
                'address' => $address,
                'emp_id' => $emp_id,
                'busunit_id' => $busunit_id
            );

            // Insert data into the 'appointments' table using the model
            $this->employee_model->saveAppointment($data);

            // Respond to the AJAX request
            $response = array('status' => 'success');
            echo json_encode($response);
        }

    public function CertificatePdf()
    {
       // $id = $this->input->get('Id');
        $eid = $this->input->get('em');
        
        $temid =  $this->input->get('tem_id');
        $id =  $this->input->get('tem_id');

         $busunit = $this->input->get('busunit');

        $data = array();

        // Fetch data from the database based on $id and $eid
        $templateData = $this->Certificate_modal->getTemplateData($id);
        $contentData = $this->Certificate_modal->getContentData($id);


        $header_footer_data = $this->Certificate_modal->get_header_footerby_busunit($busunit);

        $path = base_url()."assets/uploads/pdf_header_footer/";
       
   
        $this->load->library('AppointmentPdf');
        $pdf = new AppointmentPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Appointment Letter');
        $pdf->SetSubject('Appointment Letter');
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
       // $pdf->setPrintHeader(false);
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
    // Initialize the $html variable outside the loop
    $html = '';
 
 //Header and footer variables
        $pdf->header_img = ($header_footer_data->header) ? $path.$header_footer_data->header : '';
        $pdf->footer_img = ($header_footer_data->footer) ? $path.$header_footer_data->footer : '';//$path.$header_footer_data->footer;
        $pdf->watermark_img = ($header_footer_data->watermark) ? $path.$header_footer_data->watermark : ''; //$path.$header_footer_data->watermark;


    // Loop through each content data and add a page for each
    foreach ($contentData as $contentItem) {
        // Add a new page for each set of content data
        $pdf->AddPage();



        // Replace placeholders in the HTML content with actual data
        $html = $contentItem->content;

        // Fetch dynamic data from emp_template
        $dynamicData = $this->Certificate_modal->getDynamicData($eid, $temid);

         

        // Replace placeholders with dynamic data
        foreach ($dynamicData as $dynamicItem) {
            $placeholders = array(
                $dynamicItem->tag_name  => $dynamicItem->tag_value,
                // Add more placeholders as needed
            );
            $html = strtr($html, $placeholders);
        }

        // Add content to the current page
        $pdf->writeHTML($html);
       }

        $filename = "AppointmentLetter";
        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($filename . '.pdf', 'I');
    }
}