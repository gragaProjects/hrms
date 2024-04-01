<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require FCPATH .'assets/phpmailer/phpmailer/src/Exception.php';
require FCPATH .'assets/phpmailer/phpmailer/src/PHPMailer.php';
require FCPATH .'assets/phpmailer/phpmailer/src/SMTP.php';

//require 'vendor/autoload.php';

class Login extends CI_Controller {

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
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
         $this->load->model('settings_model');
         $this->load->helper('cookie');
  
    }

    public function change_password_modal() {
    // Load the view for the change password modal
    $this->load->view('change_password_modal');
   }
    
	public function index()
	{
		#Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == 1)
            redirect(base_url() . 'dashboard');
            $data=array();
            #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
			$this->load->view('login');
	}

	public function Login_Auth(){	

		$response = array();
	    //Recieving post input of email, password from request
	    $email = $this->input->post('email');
	    $password = sha1($this->input->post('password'));
		$remember = $this->input->post('remember');

		#Login input validation\
		$this->load->library('form_validation');
	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('feedback','UserEmail or Password is Invalid');
			redirect(base_url() . 'login', 'refresh');		
		}
		else{
	        //Validating login
	        $login_status = $this->validate_login($email, $password);
	        $response['login_status'] = $login_status;
	        if ($login_status == 'success') {
	        	if($remember){

	        		$cookie1= array(

				       'name'   => 'email',
				       'value'  => $email,                            
				       'expire' => 604800,//86400,
				       'domain' => $_SERVER['HTTP_HOST'],
				       'secure' => false

				   );	
	        		$cookie2= array(

				       'name'   => 'password',
				       'value'  => base64_encode($this->input->post('password')),                            
				       'expire' =>  604800,//86400,
		               'domain' => $_SERVER['HTTP_HOST'],
		               'secure' => false

				   );
					$this->input->set_cookie($cookie1);
					$this->input->set_cookie($cookie2);
	        		//setcookie('email',$email,time() + (86400 * 30));
	        		//setcookie('password',$this->input->post('password'),time() + (86400 * 30));
	        		redirect(base_url() . 'login', 'refresh');
	        		
	        		
	        	} else {
	        		if(!empty($this->input->cookie('email')))
	        		{
	        			$this->input->set_cookie('email',' ');
	        		}
	        		if(!empty($this->input->cookie('password')))
	        		{
	        			$this->input->set_cookie('password',' ');
	        		}        		
	        		redirect(base_url() . 'login', 'refresh');
	        		
	        	}
	        }
			else{
				$this->session->set_flashdata('feedback','UserEmail or Password is Invalid');
				redirect(base_url() . 'login', 'refresh');
			}
		}
	}
    

    //Validating login from request
    function validate_login($email = '', $password = '') {
    	
        $credential = array('em_email' => $email, 'em_password' => $password,'status' => 'ACTIVE','isActive'=> 1);

// echo $credential;

// exit(1);
        $query = $this->login_model->getUserForLogin($credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login_access', '1');
            $this->session->set_userdata('user_login_id', $row->em_id);
            $this->session->set_userdata('name', $row->first_name);
            $this->session->set_userdata('email', $row->em_email);
            $this->session->set_userdata('user_image', $row->em_image);
            $this->session->set_userdata('user_type', $row->em_role);
            $this->session->set_userdata('busunit', $row->busunit);
            $this->session->set_userdata('user_status', $row->user_status);
            /*new*/
            $this->session->set_userdata('notifications',true);
            return 'success';
        }
	}
    /*Logout method*/
    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url(), 'refresh');
    }


	public function verification_confirm(){
		$verifycode = $this->input->get('C');
		$userinfo = $this->login_model->GetuserInfoBycode($verifycode);
		if($userinfo){
    		$data = array();
    		$data = array(
    			'status'=>'ACTIVE',
				'confirm_code' => 0
    		);
    		$this->login_model->UpdateStatus($verifycode,$data);
    		if($this->db->affected_rows()){
			$this->session->set_flashdata('feedback','Your Account has been confirmed!! now login');
			$this->load->view('backend/login');
    		}			
		} else {
			$this->session->set_flashdata('feedback','Sorry your account has not been varified');
			$this->load->view('backend/login');  			
		}
	}
	//forget page

	public function forgotten_page(){
       
		$this->load->view('forgot_password');
	}

	public function forgot_password(){
		$email = $this->input->post('email');
		$checkemail = $this->login_model->Does_email_exists($email);
		if($checkemail){
			$randcode = rand(999999, 111111);
			$data=array();
			$data=array(
				'forgotten_code'=>$randcode
			);
			$updatedata = $this->login_model->UpdateKey($data,$email);
			$updateaffect = $this->db->affected_rows();
			if($updateaffect){
			$email=$this->input->post('email');	
			$this->send_mail($email,$randcode);
			//$this->session->set_flashdata('feedback','Kindly check your email' .' '.$email. 'To reset your password');
			//redirect('Retriev');				
			} else {
				
			}
		} 
		else {
			/*$this->session->set_flashdata('feedback','Please enter a valid email address!');
			redirect('Retriev');*/
			echo json_encode(array('status'=>'error','message'=>"This email does not exist" ));
		}
	}

    public function send_mail($email,$randcode) {
    	$email = $this->input->post('email');
    	  $email_veiw = $this->settings_model->GetSmtp();
    	  $emp_veiw = $this->login_model->GetEMP($email);
          $fname =  $emp_veiw->first_name;
          $lname =  $emp_veiw->last_name;
          $em_mail =  $emp_veiw->em_email;
       $mail = new PHPMailer(true);
          ob_start();
        ?>
        
        <p> HI <?=$fname.' '.$lname ?> </p><br>
        <p>Forgot your password?</p>
        <p>We received a request to reset the password for the AGM - HRMS account associated with <strong><?=$em_mail?></strong>.
        </p><br>
        <span>Your verification code is: <strong> <?= $randcode?></strong></span><br>
        <p>If you did not request this code, it is possible that someone else is trying to access the account.<br><strong> Do not forward or give this code to anyone.</strong></p>
        <div class="container" style="width: 300px;">
          <table style="width: 100%;">
        <td style="border: 0;outline: none;width: 214px;">
                <!-- <h2 style="font-family: sans-serif;font-size: 12px;font-weight: bold;margin: 0;padding: 0;color: #32322c; line-height: 24px;">Thank you</h2> -->
                 <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Your friends at AGM - HRMS</p>
           <!--      <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Team<br><a href="http://agmtechnical.com/" style="text-decoration: none;color: #666666;">Graga Technologies</a></p> -->
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
            $mail->setFrom($email_veiw->from_mail, $email_veiw->from_name);
            $mail->addAddress($email); //$fname    //Add a recipient
            $mail->addReplyTo($email_veiw->from_mail, $email_veiw->from_name);
       
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject='Reset your password!!'; 

            //$message = "Your or someone request to reset your password" ."<br />";
            //$message .= "Your code is  <strong>" . $randcode."</strong><br />";
            $mail->Body = $message;
            //$mail->AltBody = $customer_message;

            if ($mail->send()) {
               
         	 echo json_encode(array('status'=>'success','message'=>'Kindly check your email To reset your password'));
         	 $this->session->set_flashdata('emp_email',$email);
         	 //redirect('');	
            }else{
            	 echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
            }
        } catch (Exception $e) {
           echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;
        }
		  }

    //verify Code
    public function Verify_code(){
		$this->load->view('verify_code');
	}
	public function Verificationcode(){
	    $reset_key = $this->input->post('code');
	    $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('code',' Code','trim|required|xss_clean|min_length[6]');
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               //echo validation_errors();
               echo json_encode(array('status'=>'error','message'=>validation_errors()));
               //echo json_encode(array('error'=>$error));
           }else{
		if($this->login_model->Does_Key_exists($reset_key)){
		 echo json_encode(array('status'=>'success','message'=>'Verification Successfully'));
		}else{
			
			 echo json_encode(array('status'=>'error','message'=>"You've entered incorrect code!"));
		 } 
		 } 
	
		/*if ($atmp==3) {
		    echo json_encode(array('status'=>'error','message'=>"To many failed  attempts. Please try again"));
		  }*/
		
		
	}
	public function Expirecode(){
		$email = $this->input->post('emp_email');
	$data = array(
				'forgotten_code'=> 0);	
	$exp = $this->login_model->Expirecode($data,$email);
	if($exp){
			unset( $_SESSION['emp_email']);
		 echo json_encode(array('status'=>'error','message'=>"Your Verification code is expired!"));
	
	}
	}
	//reset
	  public function Reset_Password(){
		$this->load->view('Reset_password');
	}
	public function Reset_password_validation(){
		$password = $this->input->post('password');
		$confirm = $this->input->post('cpassword');
		$key = $this->input->post('code');
		$userinfo = $this->login_model->GetUserInfo($key);
		
		if($password == $confirm){
			if($userinfo->em_password != sha1($password)){
			$data=array();
			$data = array(
				'forgotten_code'=> 0,
			    'em_password'=>sha1($password)
			    );
		$update = $this->login_model->UpdatePassword($key,$data);
		if($update){
			///$data['message'] = 'Successfully Updated your password!!';
		    //$this->load->view('backend/login',$data);
		     echo json_encode(array('status'=>'success','message'=>'Successfully Updated your password!!'));
		}
		} else {
         	//$this->session->set_flashdata('feedback','You enter your old password.Please enter new password');
         	 echo json_encode(array('status'=>'error','message'=>"You enter your old password.Please enter new password"));

         	//redirect('Reset_password?p='.$key);			
		}
		} else {
			 echo json_encode(array('status'=>'error','message'=>"Password does not match"));
         	//$this->session->set_flashdata('feedback','Password does not match');
         	//redirect('Reset_password?p='.$key);
		}
	}		

	public function Reset_View(){
		$this->load->helper('form');
		$reset_key = $this->input->get('p');
		if($this->login_model->Does_Key_exists($reset_key)){
		$data['key']= $reset_key;
		$this->load->view('backend/reset_page',$data);
		} 
		else {
			$this->session->set_flashdata('feedback','Please enter a valid email address!');
			redirect('Retriev');
		}
	}


}