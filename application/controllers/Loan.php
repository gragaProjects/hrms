<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require FCPATH .'assets/phpmailer/phpmailer/src/Exception.php';
require FCPATH .'assets/phpmailer/phpmailer/src/PHPMailer.php';
require FCPATH .'assets/phpmailer/phpmailer/src/SMTP.php';
class Loan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('login_model');
		$this->load->model('dashboard_model');
		$this->load->model('employee_model');
		$this->load->model('loan_model');
		$this->load->model('settings_model');
		$this->load->model('leave_model');
       $this->load->model('expense_model');
	}

	public function View()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$data['employee'] = $this->employee_model->emselect();
			$data['loanview'] = $this->loan_model->loan_modeldata();
			$this->load->view('backend/loan', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
    public function Pending_Loan()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['employee'] = $this->employee_model->emselect();
            $data['loanview'] = $this->loan_model->loan_pendingdata();
            $this->load->view('backend/pending_loan', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
	//'Granted','Deny','Pause','Done'
	public function Add_Loan()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$id = $this->input->post('id');
			$em_id = $this->input->post('emid');
			$details = $this->input->post('details');
			$appdate = $this->input->post('appdate');
			$amount = $this->input->post('amount');
			/*$interest = $this->input->post('interest');
        $interestper = $this->input->post('interest')/100;*/
			$install = $this->input->post('install');
			$status = $this->input->post('status');
			$loanno = $this->input->post('loanno');
			/* $total = $this->input->post('amount') * $interestper;*/
			/*$totalamount = $amount + $total;*/
			$installment = round($this->input->post('installment'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters();
			$this->form_validation->set_rules('emid', 'Emp ID', 'trim|required|max_length[220]|xss_clean');
            
            if(!$status){
            	$status = 'Pending';
            }
			if ($this->form_validation->run() == false) {
				echo validation_errors();
				#redirect("loan/View");
			} else {
				
            if($this->loan_model->GetEmployeeForloancheck($em_id)){
            echo json_encode(array('error'=>'<p>You have already pending loan application</p>'));
            }elseif ($this->loan_model->GetEmployeeForloanGranted($em_id)) {
                  echo json_encode(array('error'=>'<p>You have already taken loan</p>'));
            } else{ 
				$data = array();
                $eid = $this->session->userdata('user_login_id');
               $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
                 if ($get_hr_approve) {
                  
                    $data = array(
                    'emp_id' => $em_id,
                    'loan_details' => $details,
                    'approve_date' => $appdate,
                    'amount' => $amount,
                    /*'interest_percentage' => $interest,*/
                    'install_period' => $install,
                    'installment' => $installment,
                    /*'total_amount' => $totalamount,*/
                    'total_pay' => '0',
                    'total_due' => '0',
                    'status' => $status,
                    'loan_number' => $loanno,
                     'hr_status' => 'Granted');

                  }else{
                    $data = array(
                    'emp_id' => $em_id,
                    'loan_details' => $details,
                    'approve_date' => $appdate,
                    'amount' => $amount,
                    /*'interest_percentage' => $interest,*/
                    'install_period' => $install,
                    'installment' => $installment,
                    /*'total_amount' => $totalamount,*/
                    'total_pay' => '0',
                    'total_due' => '0',
                    'status' => $status,
                    'loan_number' => $loanno
                );
                 } 
				
				if (empty($id)) {
					$emvalue = $this->loan_model->GetEmployeeForloancheck($em_id);
					#echo $emvalue->status;
					if (!empty($emvalue->status)) {
						//echo "Already you have a loan. Please pay installation first";
						echo json_encode(array('status'=>'error','message'=>'Already you have a loan. Please pay installation first'));
					} else {
						$success = $this->loan_model->Add_LoanData($data);
						if($success){
							echo json_encode(array('status'=>'success','message'=>'Successfully Added'));

                            // New
                                 /*Notification*/
                                // Retrieve data from the employee table
                                 $emp_id = $em_id;
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

                            
                                    $filetitle = 'New Loan Request: <span class="txt-name" style="font-weight:bold">'.$emp_Data->first_name .' '.$emp_Data->last_name.'</span>.';       
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
						//echo "Successfully Added";
					}
				} else {
					//echo $status;die();
					if($status == 'Granted'){
                     $emid = $em_id;
                      $subject  = 'Approved Loan Request';
                     $message = '<p>We are pleased to inform you that your loan application has been approved. You will receive the loan amount in your account within the next 3 business days.</p>
					     <p>Please ensure that you adhere to the repayment schedule as discussed during the application process. In case of any queries, please feel free to reach out to us.</p>
					     <p>Congratulations on your approved loan!</p>';
                    $this->loan_approve_mail($emid,$message,$subject);

					}elseif($status == 'Deny'){
                       $emid = $em_id;
                      $subject  = 'Rejected Loan Request';
                     $message = "<p>Thank you for your recent loan application. After careful consideration, we regret to inform you that your application has been rejected.</p>
					     <p>We understand that this may be disappointing news, but please note that there are a variety of factors that contribute to our decision-making process. We encourage you to review your financial situation and explore alternative options that may better suit your needs.</p>
					     <p>Thank you for your interest in our loan program, and please don't hesitate to contact us if you have any further questions.</p>";
                    $this->loan_approve_mail($emid,$message,$subject);
					}
					$success = $this->loan_model->update_LoanDataVal($id, $data);
					if($success){
						echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
					  }
					//echo "Successfully Updated";
				}
            }
			}
		} else {
			redirect(base_url(), 'refresh');
		}
	}
	   /*HR approval*/
        public function hrapproveStatus() {
            if ($this->session->userdata('user_login_access') != False) {

                $employeeId = $this->input->post('employeeId');
                $id       = $this->input->post('lid');
                $value    = $this->input->post('lvalue');
               
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters();
                 $emid = $employeeId;

                $data    = array();
                $data    = array(
                    'hr_status' => $value
                );
                $postion = 'HR Manager';
                $success = $this->loan_model->update_LoanDataVal($id, $data);
                if($success){
						echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
					  }
               //echo $status;die();
					if($value == 'Granted'){
                     //$emid = $em_id;
                      $subject  = 'Approved Loan Request';
                     $message = '<p>We are pleased to inform you that your loan application has been approved. You will receive the loan amount in your account within the next 3 business days.</p>
					     <p>Please ensure that you adhere to the repayment schedule as discussed during the application process. In case of any queries, please feel free to reach out to us.</p>
					     <p>Congratulations on your approved loan!</p>';
                    $this->hr_loan_approve_mail($emid,$message,$subject,$postion);

					}elseif($value == 'Deny'){
             
                      $subject  = 'Rejected Loan Request';
                     $message = "<p>Thank you for your recent loan application. After careful consideration, we regret to inform you that your application has been rejected.</p>
					     <p>We understand that this may be disappointing news, but please note that there are a variety of factors that contribute to our decision-making process. We encourage you to review your financial situation and explore alternative options that may better suit your needs.</p>
					     <p>Thank you for your interest in our loan program, and please don't hesitate to contact us if you have any further questions.</p>";
                    $this->hr_loan_approve_mail($emid,$message,$subject,$postion);
             }
            }
        }
        /*Admin approval status*/
        public function adminapproveStatus() {
            if ($this->session->userdata('user_login_access') != False) {
                $employeeId = $this->input->post('employeeId');
                $id       = $this->input->post('lid');
                $value    = $this->input->post('lvalue');
               
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters();
                 $emid = $employeeId;
               
                $data    = array();
                $data    = array(
                    'status' => $value
                );
                $postion = 'Administrator';
                $success = $this->loan_model->update_LoanDataVal($id, $data);
                if($success){
						echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
					  }
               //echo $status;die();
					if($value == 'Granted'){
                     //$emid = $em_id;
                      $subject  = 'Approved Loan Request';
                     $message = '<p>We are pleased to inform you that your loan application has been approved. You will receive the loan amount in your account within the next 3 business days.</p>
					     <p>Please ensure that you adhere to the repayment schedule as discussed during the application process. In case of any queries, please feel free to reach out to us.</p>
					     <p>Congratulations on your approved loan!</p>';
                    $this->loan_approve_mail($emid,$message,$subject,$postion);

					}elseif($value == 'Deny'){
                       
                      $subject  = 'Rejected Loan Request';
                     $message = "<p>Thank you for your recent loan application. After careful consideration, we regret to inform you that your application has been rejected.</p>
					     <p>We understand that this may be disappointing news, but please note that there are a variety of factors that contribute to our decision-making process. We encourage you to review your financial situation and explore alternative options that may better suit your needs.</p>
					     <p>Thank you for your interest in our loan program, and please don't hesitate to contact us if you have any further questions.</p>";
                    $this->loan_approve_mail($emid,$message,$subject,$postion);
             }
            }
        }
	//Admin approval
    public function loan_approve_mail($emid,$message,$subject,$postion) {
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
     
     <?=$message?>
    
    <div class="container" style="width: 300px;">

    <table style="width: 100%;">
        <tr>

          
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
              
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?> </p>
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
    //$mail->addCC($head_mail,$head_name);
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= $subject." - ".$from_name;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

   // echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
    //echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
    }
    } catch (Exception $e) {
   // echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;
    }
    }
    }	
    //HR approval
    public function hr_loan_approve_mail($emid,$message,$subject,$postion) {
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
     
     <?=$message?>
    
    <div class="container" style="width: 300px;">

    <table style="width: 100%;">
        <tr>

          
            <td style="border: 0;outline: none;width: 214px;">
                <p style="font-family: sans-serif;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;">Best regards,</p>
              
                <p style="font-family: sans-serif;;font-size: 12px;margin: 0;padding: 0;color: #666666; line-height: 18px;"> <?=$postion?> </p>
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
    $mail->setFrom($hr,  $hr_name);
    $mail->addAddress($email,$from_name); //setFrom//Add a recipient
    //$mail->addReplyTo($hr, $hr_name);
   // $mail->addCC($hr,  $hr_name);
    //$mail->addCC($head_mail,$head_name);
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject= $subject." - ".$from_name;
    $mail->Body = $message;
    //$mail->AltBody = $customer_message;
    if ($mail->send()) {

   // echo json_encode(array('status'=>'success','message'=>'Leave Approved Successfully'));

    }else{
   // echo json_encode(array('status'=>'error','message'=>'Error in sending Email.'));
    }
    } catch (Exception $e) {
    //echo json_encode(array('status'=>'error',"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));;
    }
    }
    }
	public function installment()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$data['employee'] = $this->employee_model->emselect();
			$data['installment'] = $this->loan_model->installmentSelect();
			$this->load->view('backend/loan_installment', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
	//'Granted','Deny',,'Done'
	public function Add_Loan_Installment()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$id = $this->input->post('id');
			$em_id = $this->input->post('emid');
			$loanid = $this->input->post('loanid');
			$loanno = $this->input->post('loanno');
			$amount = $this->input->post('amount');
			$appdate = $this->input->post('appdate');
			$receiver = $this->input->post('receiver');
			$installno = $this->input->post('installno');
			$notes = $this->input->post('notes');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters();
			$this->form_validation->set_rules('emid', 'Emp ID', 'trim|required|max_length[220]|xss_clean');
           if ($this->form_validation->run() == false) {
				echo validation_errors();
				#redirect("loan/View");
			} else {
				if (empty($id)) {
					$loanvalue = $this->loan_model->GetLoanValuebyLId($loanid);
					$period = $loanvalue->install_period - 1;
					$data = array();
					$data = array(
						'emp_id' => $em_id,
						'loan_id' => $loanid,
						'loan_number' => $loanno,
						'install_amount' => $amount,
						/*'pay_amount' => $payment,*/
						'app_date' => $appdate,
						'receiver' => $receiver,
						'install_no' => $period,
						'notes' => $notes
					);
					$success = $this->loan_model->Add_installData($data);
					$totalpay = $loanvalue->total_pay + $amount;
					$totaldue = $loanvalue->amount - $totalpay;
					/*$period = $loanvalue->install_period - 1;*/
					if ($installno == '1') {
						$status = 'Done';
					} else {
						$status = 'Granted';
					}
					$data = array();
					$data = array(
						'total_pay'=>$totalpay,
						'total_due'=>$totaldue,
						'install_period'=>$period,
						'status'=>$status
					);
					$success = $this->loan_model->update_LoanData($loanid, $data);
					//echo "Successfully Added";
					if($success){
						echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
					  }
				} else {
					$data = array();
					$data = array(
						'emp_id' => $em_id,
						'loan_id' => $loanid,
						'loan_number' => $loanno,
						'install_amount' => $amount,
						/*'pay_amount' => $payment,*/
						'app_date' => $appdate,
						'receiver' => $receiver,
						/*'install_no' => $period,*/
						'notes' => $notes
					);
					$success = $this->loan_model->update_LoanInstallData($id, $data);
					//echo "Successfully Updated";
					if($success){
						echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
					  }
				}
			}
		} else {
			redirect(base_url(), 'refresh');
		}
	}
	public function LoanByID()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$id = $this->input->get('id');
			$data['loanvalue'] = $this->loan_model->LoanValselect($id);
			$data['loanvalueem'] = $this->loan_model->LoanValEmselect($id);
			$data['loanvalueinstallment'] = $this->loan_model->LoanInstallValEmselect($id);
			echo json_encode($data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

     public function Loandelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->loan_model->Loandelete($id);//
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
     //  public function Loaninstalldelete(){
     //    if($this->session->userdata('user_login_access') != False) { 
     //        $id = $this->input->post('id');
     //        $result_del = $this->loan_model->Loaninstalldelete($id);//
     //      if($result_del){
     //            echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
               
     //        }else{
     //             echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
             
     //        }
           
     //        }
     //    else{
     //        redirect(base_url() , 'refresh');
     //    }       
     // }

     //New
     public function Loaninstalldelete() {
    if ($this->session->userdata('user_login_access') != false) {
        $id = $this->input->post('id');
        $installment_data = $this->loan_model->getInstallmentDataById($id); // Assuming a function to get installment data by id

        if ($installment_data) {
            $loan_id = $installment_data->loan_id;
            $loan_data = $this->loan_model->GetLoanValuebyLoanId($loan_id);

            $totalpay = $loan_data->total_pay - $installment_data->install_amount;
            $totaldue = $loan_data->amount - $totalpay;
            $install_period = $loan_data->install_period + 1;

            //$status = ($install_period >= $loan_data->install_period) ? 'Done' : 'Granted';
            if($install_period > 1){
                $status = 'Granted';
            }else{
                
                 $status = 'Done';
            }

            $data = array(
                'total_pay' => $totalpay,
                'total_due' => $totaldue,
                'install_period' => $install_period,
                'status' => $status
            );

            $success = $this->loan_model->update_LoanData($loan_id, $data);

            if ($success) {
                $result_del = $this->loan_model->Loaninstalldelete($id);

                if ($result_del) {
                    echo json_encode(array('status' => 'success', 'message' => 'Deleted Successfully'));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Not deleted'));
                }
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Failed to update loan data'));
            }
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Installment data not found'));
        }
    } else {
        redirect(base_url(), 'refresh');
    }

}
}
?>