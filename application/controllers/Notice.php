 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
        $this->load->model('employee_model'); 
        $this->load->model('notice_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('organization_model');
    }
    
	public function index()
	{
		#Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == 1)
            redirect('dashboard/Dashboard');
            $data=array();
            #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
			$this->load->view('login');
	}
    public function All_notice(){
        if($this->session->userdata('user_login_access') != False) {
        $data['notice'] = $this->notice_model->GetNotice();
        $this->load->view('backend/notice',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function Published_Notice(){
    if($this->session->userdata('user_login_access') != False) {    
    $filetitle = $this->input->post('title');    		
    $ndate = $this->input->post('nodate');    		
    $todate = $this->input->post('todate');          
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('title', 'title', 'trim|required|max_length[150]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
			#redirect("notice/All_notice");
			} else {
           $val = $filetitle;
            $table = 'notice';
            $data = array('title'=> $filetitle,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('status'=>'error','message'=>'<p>This Notice  is already exists</p>'));
            } else {
            if($_FILES['file_url']['name']){
            $file_name = $_FILES['file_url']['name'];
			$fileSize = $_FILES["file_url"]["size"]/1024;
			$fileType = $_FILES["file_url"]["type"];
			$new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/notice",
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
   
			else {

                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'title' => $filetitle,
                    'file_url' => $img_url,
                    'date' => $ndate,
                    'todate' => $todate,
                    'Active_status' => '1'
                );

            $success = $this->notice_model->Published_Notice($data); 

            if($success){

                
            /*Notification*/
            // Retrieve data from the employee table
            $employees = $this->employee_model->emselect();
            // Insert data into the notification table for each employee
            foreach ($employees as $employee) {
            $data = array(
            'user_id' => $employee->em_id,
            'message' => $filetitle,
            'status' => 'unread'
            );
            $this->db->insert('notifications', $data);
            }
                echo json_encode(array('status'=>'success','message'=>"Successfully Added"));
            }
			}
        }
          }
        }
        }
    else{
		redirect(base_url() , 'refresh');
	}        
    }
    public function noticeinactive(){
      $id = $this->input->post('id');
      //if($inactivestatus === "1"){
       $data = array( 'Active_status' => 0 ); 
        $success = $this->notice_model->Inactive_notice($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //}   
    
     }
     /* */
    public function noticeactive(){
      $id = $this->input->post('id');
      //if($activestatus === "0"){
       $data = array( 'Active_status' => 1 ); 
        $success = $this->notice_model->active_notice($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //} 
    
     }

     public function Noticedelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->notice_model->Noticedelete($id);//
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

    
}

