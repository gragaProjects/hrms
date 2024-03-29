 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require FCPATH .'assets/phpmailer/phpmailer/src/Exception.php';
require FCPATH .'assets/phpmailer/phpmailer/src/PHPMailer.php';
require FCPATH .'assets/phpmailer/phpmailer/src/SMTP.php';

class Dashboard extends CI_Controller {

	    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
        $this->load->model('employee_model');
        $this->load->model('settings_model');    
        $this->load->model('notice_model');    
        $this->load->model('project_model');    
        $this->load->model('leave_model');   
       //$this->load->library('Role'); 

      

    }
    
	public function index()
	{

		// #Redirect to Admin dashboard after authentication
        // if ($this->session->userdata('user_login_access') == 1)
        //     redirect('dashboard/Dashboard');
        //     $data=array();
        //     #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
		// 	$this->load->view('login');

        if($this->session->userdata('user_login_access') != False) {
      

            // Get password changed status
            $password_changed = $this->login_model->getPasswordChangedStatus($this->session->userdata('user_login_id'));
         // echo $this->db->last_query(); var_dump($password_changed);die();
            if ($password_changed == false) {
                // Password has not been changed or user_status is not 1, show change password modal
                $this->load->view('change_password_modal');
            } else {
                //New
                
                    // Policies are accepted, load the view with policies
                    $data['policies'] = $this->dashboard_model->getPolicies(); // Assuming you have a method to get policies from the model
                    $data['user_status'] =   $employeeId = $this->session->userdata('user_status');
                   // print_r( $data['policies']);
                    $this->load->view('backend/dashboard', $data);
               
                //$this->load->view('backend/dashboard');
                //New
            }

       
        }
        else{
           redirect(base_url() . 'login', 'refresh');
        }
	}

    function Dashboard(){
        if($this->session->userdata('user_login_access') != False) {

         // Get password changed status
        $password_changed = $this->login_model->getPasswordChangedStatus($this->session->userdata('user_login_id'));
       // print_r($password_changed);die();
        if (!$password_changed) {
            // Password has not been changed or user_status is not 1, show change password modal
            $this->load->view('change_password_modal');
        } else {
            // Password has been changed and user_status is 1, load the dashboard
            //$this->load->view('backend/dashboard');

            //New
                // Password has been changed and user_status is 1, load the dashboard
                $policiesAccepted = $this->dashboard_model->checkPoliciesAccepted();

                if ($policiesAccepted === 'accepted') {
                    // Policies are accepted, load the view with policies
                    $data['policies'] = $this->dashboard_model->getPolicies(); // Assuming you have a method to get policies from the model
                    $this->load->view('dashboard', $data);
                }
                //$this->load->view('backend/dashboard');
                //New
        }

        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }

    public function Newpage(){
        $this->load->view('backend/addpage');
    }
    public function add_todo(){
        $userid = $this->input->post('userid');
        $tododata = $this->input->post('todo_data');
        $date = date("Y-m-d h:i:sa");
        $this->load->library('form_validation');
        //validating to do list data
        $this->form_validation->set_rules('todo_data', 'To-do Data', 'trim|required|min_length[5]|max_length[150]|xss_clean');        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
        } else {
        $data=array();
        $data = array(
        'user_id' => $userid,
        'to_dodata' =>$tododata,
        'value' =>'1',
        'date' =>$date    
        );
        $success = $this->dashboard_model->insert_tododata($data);
            #echo "successfully added";
            if($this->db->affected_rows()){
                echo "successfully added";
            } else {
                echo "validation Error";
            }
        }        
    }
	public function Update_Todo(){
        $id = $this->input->post('toid');
		$value = $this->input->post('tovalue');
			$data = array();
			$data = array(
				'value'=> $value
			);
        $update= $this->dashboard_model->UpdateTododata($id,$data);
        $inserted = $this->db->affected_rows();
		if($inserted){
			$message="Successfully Added";
			echo $message;
		} else {
			$message="Something went wrong";
			echo $message;			
		}
	}

    //HR Notification
    public function hr_reminder_mail() {
     $emid = $this->input->post('emid');
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
    //annual leave days
    $sql = "SELECT * FROM `leave_types`  WHERE `isAnnual_leave` = '1' AND `isActive` = 1 "; 
    $query = $this->db->query($sql);
     $annual_leave_days =  $query->row();

    //$em_mail =  $emp_veiw->em_email;
    $mail = new PHPMailer(true);
    ob_start();
    ?>

    <p> Dear <?=$from_name ?> </p><br>

    <div class="container" style="width: 300px;">
    <table style="width: 100%;">
        <p>I hope this email finds you well. I am writing to remind you that you have <?=$annual_leave_days->leave_day?> days of annual leave entitlement remaining for this year.</p>
        <p>As per our company policy, all employees are encouraged to take their annual leave to ensure a healthy work-life balance and to recharge their batteries. Taking time off work helps you to be more productive, creative, and engaged when you return to work.</p>
        <p>Therefore, I strongly encourage you to plan and take your remaining annual leave entitlement at the earliest possible opportunity. Please note that if you do not take your annual leave, it may be forfeited at the end of the year.</p>
        <p>If you have any questions or concerns regarding your annual leave entitlement, please do not hesitate to contact me or the HR department. We are here to help you in any way we can.</p>
        <p>Thank you for your attention to this matter, and I wish you a pleasant day.</p>
        <tr>
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$to_name ?></p>
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> HR Manager </p>
                <!-- <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?></p> -->
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
    $mail->Subject= 'Reminder: Annual Leave Entitlement';
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {
    
    $this->db->where('em_id', $emid);
    if($this->db->update('employee',array('notification_status'=>'1')))  
   {
    echo json_encode(array('status'=>'success','message'=>'Notification Send Successfully'));
   }
    

    }else{
    echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
    }
    } catch (Exception $e) {
    echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;
    }
    }
    }    

    // ------------------------------------------------ New Policy modal------------------------------- -->
//     public function checkPoliciesAccepted() {
//     // Assuming you have a method in your model to check if policies are accepted
//     $data['status'] = $this->dashboard_model->checkPoliciesAccepted();

//     echo json_encode($data);
// }

public function checkPoliciesAccepted() {
    // Assuming you have a session variable storing user information
    $employeeId = $this->session->userdata('user_login_id');
    $busunit = $this->session->userdata('busunit');

    // Call the model method to check policies accepted
    $result = $this->dashboard_model->checkPoliciesAccepted($employeeId, $busunit);

    // Send the result as JSON response
    echo json_encode($result);
}


public function acceptPoliciesPage() {
    // This is the page where the user is redirected if policies are not accepted
    $this->load->view('accept_policies_page');
}


// public function acceptPolicy() {
//     $policyId = $this->input->post('policyId');
//     $accepted = $this->input->post('accepted');

//     // Assuming you have a method in your model to update policy acceptance status
//     $this->dashboard_model->updatePolicyAcceptance($policyId, $accepted);

//     // Assuming you have a method in your model to get policy details
//     $policyDetails = $this->dashboard_model->getPolicyDetails($policyId);

//     if ($policyDetails) {
//         $response = array(
//             'status' => 'success',
//             'policy_title' => $policyDetails['policy_title'],
//             'policy_description' => $policyDetails['policy_description'],
//             'policy_file' => base_url().'assets/uploads/policy_document/'.$policyDetails['file'],
//             'message' => 'Policy details fetched successfully'
//         );
//     } else {
//         $response = array('status' => 'error', 'message' => 'Error fetching policy details.');
//     }

//     echo json_encode($response);
// }


public function acceptPolicy() {
    $policyId = $this->input->post('policyId');
    $accepted = $this->input->post('accepted');
    if( $accepted == 1){
     $this->dashboard_model->updatePolicyAcceptance($policyId, $accepted);   
    }
    

    $policyDetails = $this->dashboard_model->getPolicyDetails($policyId);

    if ($policyDetails) {
        $response = array(
            'status' => 'success',
            'policy_title' => $policyDetails['policy_title'],
            'policy_description' => $policyDetails['policy_description'],
            'file' => base_url().'assets/uploads/policy_document/'.$policyDetails['file'],
            'message' => 'Policy details fetched successfully'
        );
    } else {
        $response = array('status' => 'error', 'message' => 'Error fetching policy details.');
    }

    echo json_encode($response);
}

}