 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biometric extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
        $this->load->model('employee_model'); 
        $this->load->model('notice_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('shift_modal');
        $this->load->model('bio_device_modal');
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

	public function ViewBiometric(){
           
        if($this->session->userdata('user_login_access') != False) { 


        $data['device_list'] = $this->bio_device_modal->deviceselect();
		$this->load->view('backend/bio_device',$data);
	    } 
	} 
     public function Devicelogs(){
           
        if($this->session->userdata('user_login_access') != False) { 


        $data['devicelogs'] = $this->bio_device_modal->devicelogs();
        $this->load->view('backend/bio_device_logs',$data);
        } 
    }

	    public function Add_Device(){
        if($this->session->userdata('user_login_access') != False) { 

    
        $this->load->view('backend/add_bio_device');
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
    public function EditBioDevice(){
        if($this->session->userdata('user_login_access') != False) {
            $id = base64_decode($this->input->get('I'));
              $data['biovalue'] = $this->bio_device_modal->bioselectval($id);
              
            $this->load->view('backend/edit_bio_device',$data);

     } 
     } 

       public function Save_Device(){
          if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');

        $id = $this->input->post('id');
        $device_name = $this->input->post('device_name');
        $serial_no = $this->input->post('serial_no');
        $ip_address = $this->input->post('ip_address');
        $port = $this->input->post('port');
      
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
   
               
                 $data = array();
                $data = array(
                   
                    'device_name' => $device_name,
                    'serial_no' => $serial_no,
                    'ip_address' => $ip_address,
                    'port' => $port
                   
                );
                
      
                $success = $this->db->insert('biometric_device',$data);
               
               if($success){
                


					 echo json_encode(array('status'=>'success','message'=>'Device Added Successfully'));
			

               }
        }
    else{
        redirect(base_url() , 'refresh');
    } 
    } 
    
    public function Update_Device(){
        
           if($this->session->userdata('user_login_access') != False) {
          $user=$this->session->userdata('user_login_id');
                    
        $id = $this->input->post('id');
        $device_name = $this->input->post('device_name');
        $serial_no = $this->input->post('serial_no');
        $ip_address = $this->input->post('ip_address');
        $port = $this->input->post('port');
      
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
   
               
                  $data = array();
                $data = array(
                   
                    'device_name' => $device_name,
                    'serial_no' => $serial_no,
                    'ip_address' => $ip_address,
                    'port' => $port
                   
                );
                
                $this->db->where('id', $id);
                 $success = $this->db->update('biometric_device',$data);  
                   // $success = $this->shift_modal->Update_Shift($id,$data);
                    if($success){


                   echo json_encode(array('status'=>'success','success'=>$success)); 
                   
             
                  } 
        
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

     } 
    public function Delete_device(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->bio_device_modal->device_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
              
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    
}