 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {


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

	public function ShiftManagement(){
           
        if($this->session->userdata('user_login_access') != False) { 
        $data['shiftselect'] = $this->shift_modal->shiftselect();
		$this->load->view('backend/shift_master',$data);
	    } 
	}

	    public function AddShiftMaster(){
        if($this->session->userdata('user_login_access') != False) { 

       $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
        $this->load->view('backend/add_shift_master',$data);
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
    public function EditShiftMaster(){
        if($this->session->userdata('user_login_access') != False) {
            $id = base64_decode($this->input->get('I'));
              $data['shiftselectval'] = $this->shift_modal->shiftselectval($id);
              $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
            $this->load->view('backend/edit_shift_master',$data);

     } 
     } 

       public function Save_Shift(){
          if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');

        $id = $this->input->post('id');
        $busunit = $this->input->post('busunit');
        $shift_name = $this->input->post('shift_name');
        $shift_code = $this->input->post('shift_code');
        $night_shift = $this->input->post('night_shift');
      
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
   
               
                 $data = array();
                $data = array(
                   
                    'busunit' => $busunit,
                    'shift_name' => $shift_name,
                    'shift_code' => $shift_code,
                    'night_shift' => $night_shift
                   
                );
                
      
                $success = $this->shift_modal->Save_Shift($data);
               
                  if($success){
                $shift_id = $success;
				$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

				$data1 = array();
				foreach ($days as $day) {
				    $data1[] = array('shift_id'=>$shift_id,'day' => $day);
				}

				$result = $this->db->insert_batch('shift_details', $data1);

				if($result){

					 echo json_encode(array('status'=>'success','message'=>$success));
				}

               }
        }
    else{
        redirect(base_url() , 'refresh');
    } 
    } 
    public function Update_Shift(){
        
           if($this->session->userdata('user_login_access') != False) {
                    $user=$this->session->userdata('user_login_id');
                    $id = $this->input->post('id');
                      $id = $this->input->post('id');
        $busunit = $this->input->post('busunit');
        $shift_name = $this->input->post('shift_name');
        $shift_code = $this->input->post('shift_code');
        $night_shift = $this->input->post('night_shift');
      
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
   
               
                 $data = array();
                $data = array(
                   
                    'busunit' => $busunit,
                    'shift_name' => $shift_name,
                    'shift_code' => $shift_code,
                    'night_shift' => $night_shift
                   
                );
                
               
                    $success = $this->shift_modal->Update_Shift($id,$data);
                    if($success){


                   echo json_encode(array('status'=>'success','success'=>$success)); 
                   
             
                  } 
        
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

     } 
     public function ShiftDetails(){

       if($this->session->userdata('user_login_access') != False) {
        
        $id =  base64_decode($this->input->get('id'));
       	$data['shiftdetailsselect'] = $this->shift_modal->shiftdetailsselect($id);

		$this->load->view('backend/shift_details',$data);
       }	
     } 
      public function Add_Shift_details(){

       if($this->session->userdata('user_login_access') != False) {

       	  $user=$this->session->userdata('user_login_id');
                    
        $id = $this->input->post('id');
        //$busunit = $this->input->post('busunit');
        $day = $this->input->post('day');
        $clockin = $this->input->post('clockin');
        $clockout = $this->input->post('clockout');
        $breakin = $this->input->post('breakin');
        $breakout = $this->input->post('breakout');
        $grace_period = $this->input->post('grace_period');
        $normal_hour = $this->input->post('normal_hour');
        $round_off_min = $this->input->post('round_off_min');
        $overtime = $this->input->post('overtime');
        $shift_id = $this->input->post('shift_id');
       /*'day' => $day,*/
      

     	$data = array();
				$data = array(
					
					'clockin' => $clockin,
					'clockout' => $clockout,
					'breakin' => $breakin,
				
					'breakout' => $breakout,
					'grace_period' => $grace_period,
					
					'normal_hour' => $normal_hour,
					'round_off_min' => $round_off_min,
					'shift_id' => $shift_id,
					'overtime' => $overtime
				);
				if (empty($id)) {


					$success = $this->shift_modal->Save_Shift_details($data);
				   if($success){
					echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
					}
					} else {
						$success = $this->shift_modal->Update_Shift_details($id,$data);
						if($success){
							echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
						 					}
				}
       }	
     }

     public function ShiftByID()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$id = $this->input->get('id');
			$data['shiftvalue'] = $this->shift_modal->ShiftValselect($id);
			
			echo json_encode($data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}

    
}