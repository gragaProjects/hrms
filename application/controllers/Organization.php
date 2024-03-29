 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
        $this->load->model('employee_model'); 
        $this->load->model('organization_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
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
     public function Education(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['eduselect'] = $this->organization_model->eduselect();
        $this->load->view('backend/educationmaster',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
      public function Education_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $edu = $this->uri->segment(3);//
            $data['eduselect'] = $this->organization_model->eduselect();
            $data['edu_data'] =$this->organization_model->education_edit($edu);//
         
            $this->load->view('backend/educationmaster', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function Delete_edu(){
        if($this->session->userdata('user_login_access') != False) { 
            $dep_id = $this->input->post('dep_id');
            $result_del = $this->organization_model->edu_delete($dep_id);//
          if($result_del){
                echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    public function Save_Education(){
        if($this->session->userdata('user_login_access') != False) { 
           $education = $this->input->post('education');
           $depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('education','education','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           /*|is_unique[department.dep_name] 'is_unique'     => 'This %s already exists.'*/
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $education;
            $table = 'educationmaster';
            $data = array('education'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Education  is already exists</p>'));
            } else{
            $data = array();
            $data = array('education' => $education);
            $dep_success = $this->organization_model->Add_Educ($data);//
            if($dep_success){
                echo json_encode(array('status'=>'success','dep_success'=>$dep_success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
    public function Update_edu(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $department = $this->input->post('education');
            $edulevel = $this->input->post('edulevel');
            $this->form_validation->set_rules('education', 'education', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('education' => $department );
            $dep_result = $this->organization_model->Update_edu($id, $data);//
            if( $dep_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Department(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['department'] = $this->organization_model->depselect();
        $this->load->view('backend/department',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_dep(){
        if($this->session->userdata('user_login_access') != False) { 
           $dep = $this->input->post('department');
           $depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('department','department','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           /*|is_unique[department.dep_name] 'is_unique'     => 'This %s already exists.'*/
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $dep;
            $table = 'department';
            $data = array('dep_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This department  is already exists</p>'));
            } else{
            $data = array();
            $data = array('dep_name' => $dep);
            $dep_success = $this->organization_model->Add_Department($data);//
            if($dep_success){
                echo json_encode(array('status'=>'success','dep_success'=>$dep_success));
              }
          
            }
         
           }
            }
        else{
    		redirect(base_url() , 'refresh');
    	}        
    }

    public function Update_dep(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $department = $this->input->post('department');
            $this->form_validation->set_rules('department', 'department', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('dep_name' => $department );
            $dep_result = $this->organization_model->Update_Department($id, $data);//
            if( $dep_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_dep(){
        if($this->session->userdata('user_login_access') != False) { 
            $dep_id = $this->input->post('dep_id');
            $result_del = $this->organization_model->department_delete($dep_id);//
          if($result_del){
                echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
             
            }
           
            }
        else{
    		redirect(base_url() , 'refresh');
    	}            
    }

    public function Dep_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $dep = $this->uri->segment(3);//
            $data['department'] = $this->organization_model->depselect();
            $data['dep_data'] =$this->organization_model->department_edit($dep);//
         
            $this->load->view('backend/department', $data);
            }
        else{
    		redirect(base_url() , 'refresh');
    	}        
    }


    
    public function Designation(){
        if($this->session->userdata('user_login_access') != False) { 
            $data['designation'] = $this->organization_model->desselect();
            $this->load->view('backend/designation',$data);
            }
        else{
    		redirect(base_url() , 'refresh');
    	}        
    }

    public function Save_des(){
        if($this->session->userdata('user_login_access') != False) { 
            $des = $this->input->post('designation');
             $desval = $this->input->post('desval');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('designation','designation','trim|required|xss_clean', array(
                'required'      => 'This %s field is required.'
            ));

             if ($this->form_validation->run() == FALSE) {
                 
              $this->session->set_flashdata('error',validation_errors());
                  
                     $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                  
                }else{
                $val = $des;
                $table = 'designation';
                $data = array('des_name'=> $des,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
                //echo json_encode($dep);
                echo json_encode(array('error'=>'<p>This designation  is already exists</p>'));
            } else{
                $data = array();
                $data = array('des_name' => $des);
                $des_success = $this->organization_model->Add_Designation($data);
                if($des_success){
                 echo json_encode(array('status'=>'success','des_success'=>$des_success));
                 }
               
                }
            }
            }
        else{
    		redirect(base_url() , 'refresh');
    	}            
    }

    public function des_delete(){
        if($this->session->userdata('user_login_access') != False) {
             $des_id = $this->input->post('des_id');

           $des_del = $this->organization_model->designation_delete($des_id);
            if($des_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
                   //$this->session->set_flashdata('des_delsuccess', 'Successfully Deleted');
                   //redirect('organization/Designation');
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This Department Already used'));
                /*$this->session->set_flashdata('des_delfail', 'Not Deleted');
                   redirect('organization/Designation');*/
            }
         
            }
        else{
    		redirect(base_url() , 'refresh');
    	}        
    }

    public function Edit_des($des){
        if($this->session->userdata('user_login_access') != False) {
            $data['designation'] = $this->organization_model->desselect();
            $data['editdesignation']=$this->organization_model->designation_edit($des);
            $this->load->view('backend/designation', $data);
            }
        else{
    		redirect(base_url() , 'refresh');
    	}            
    }

    public function Update_des(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $designation = $this->input->post('designation');
            $this->form_validation->set_rules('designation', 'designation', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('des_name' => $designation );
            $des_result = $this->organization_model->Update_Designation($id, $data);
            if($des_result){
              echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }
            }
       
            }
        else{
    		redirect(base_url() , 'refresh');
    	}        
    }

    public function Role(){
        if($this->session->userdata('user_login_access') != False) { 
            $data['role'] = $this->organization_model->roleselect();
            $this->load->view('backend/role',$data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function Save_role(){
        if($this->session->userdata('user_login_access') != False) { 
            $role = $this->input->post('role');
             $roleval = $this->input->post('roleval');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters();
            $this->form_validation->set_rules('role','role','trim|required|xss_clean',
             array(
                'required'      => 'This %s field is required.'
               
            ));

            if ($this->form_validation->run() == FALSE) {
                  
                     $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                
              
            }else{
            $val = $role;
            $table = 'role';
            $data = array('role'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
                //echo json_encode($dep);
                echo json_encode(array('error'=>'<p>This role  is already exists</p>'));
            } else{
                $data = array();
                $data = array('role' => $role);
                $role_success = $this->organization_model->Add_Role($data);
                if($role_success){
            echo json_encode(array('status'=>'success','role_success'=>$role_success)); 
            }
            }
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

   

    public function Edit_role($des){
        if($this->session->userdata('user_login_access') != False) {
            $data['role'] = $this->organization_model->roleselect();
            $data['editrole']=$this->organization_model->role_edit($des);
            $this->load->view('backend/role', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Update_role(){
        if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $role = $this->input->post('role');
             $this->form_validation->set_rules('role', 'role', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('role' => $role );
            $role_result = $this->organization_model->Update_Role($id, $data);
             if($role_result){
                 echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function Role_delete(){
        if($this->session->userdata('user_login_access') != False) {
              $id = $this->input->post('role_id');
           $role_del = $this->organization_model->role_delete($id);
            if($role_del){
                 echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
                 /*  $this->session->set_flashdata('role_success', 'Successfully Deleted');
                   redirect('organization/Role');*/
            }else{
                echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
            }
         
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

   



    public function JobTitle(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['jobtitle'] = $this->organization_model->jobtitleselect();
        $this->load->view('backend/jobtitle',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_JobTitle(){
        if($this->session->userdata('user_login_access') != False) { 
           $jobtitle = $this->input->post('jobtitle');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('jobtitle','jobtitle','trim|required|xss_clean', array('required'      => 'This %s field is required.'));
        
           if ($this->form_validation->run() == FALSE) {

                     $error = validation_errors();
                     echo json_encode(array('error'=>$error));
           }else{
            $val = $jobtitle;
            $table = 'jobtitle';
            $data = array('jobtitle_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This jobtitle  is already exists</p>'));
            } else{
            $data = array();
            $data = array('jobtitle_name' => $jobtitle);
            $job_success = $this->organization_model->Add_jobtitle($data);
            if($job_success){
            echo json_encode(array('status'=>'success','job_success'=>$job_success)); 
           }
           }    
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function JobTitle_edit($jobid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['jobtitle'] = $this->organization_model->jobtitleselect();
            $data['editjobtitle']=$this->organization_model->jobtitle_edit($jobid);
            $this->load->view('backend/jobtitle', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function Update_jobtitle(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $jobtitle = $this->input->post('jobtitle');
            $this->form_validation->set_rules('jobtitle', 'jobtitle', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{

            $data =  array('jobtitle_name' => $jobtitle );
            $upd_job = $this->organization_model->Update_jobtitle($id, $data);
            if($upd_job){
             echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }//
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Delete_jobtitle(){
        if($this->session->userdata('user_login_access') != False) { 
              $id = $this->input->post('job_id');
            $del_job = $this->organization_model->jobtitle_delete($id);
            if( $del_job){
               echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
                } /*else{
                     echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
            }*/
                //}
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Prefix(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['prefix'] = $this->organization_model->Prefixselect();
        $this->load->view('backend/prefix',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

     public function Save_PrefixTitle(){
        if($this->session->userdata('user_login_access') != False) { 
           $prefixtitle = $this->input->post('prefixtitle');
           $preval = $this->input->post('preval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters();/*'<div class="error">', '</div>'*/
           $this->form_validation->set_rules('prefixtitle','prefixtitle','trim|required|xss_clean', array('required'      => 'This %s field is required.'));

            if ($this->form_validation->run() == FALSE) {
              
                     $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                       
            
            }else{
            $val = $prefixtitle;
            $table = 'prefix';
            $data = array('prefixname'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This prefix name  is already exists</p>'));
            } else{
            $data = array();
            $data = array('prefixname' => $prefixtitle);
            $prefix_success = $this->organization_model->Add_prefixtitle($data);
            if($prefix_success){
          
                  echo json_encode(array('status'=>'success','prefix_success'=>$prefix_success));
              }
             }
           }
        }else{
            redirect(base_url() , 'refresh');
        }        
    
   }

     public function PrefixTitle_edit($prefixid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['prefix'] = $this->organization_model->Prefixselect();
            $data['editprefixtitle']=$this->organization_model->prefixtitle_edit($prefixid);
            $this->load->view('backend/prefix', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_prefixtitle(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $prefixtitle = $this->input->post('prefixtitle');
            $this->form_validation->set_rules('prefixtitle', 'prefix', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('prefixname' => $prefixtitle );
            $upd_prefix = $this->organization_model->Update_prefixtitle($id, $data);
            if($upd_prefix){
            
                echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }//
            }
       
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

      public function Delete_prefixtitle(){
        if($this->session->userdata('user_login_access') != False) { 
             $id = $this->input->post('pre_id');
           $del_prefix = $this->organization_model->prefixtitle_delete($id);
             if($del_prefix){
             echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
                }else{
                echo json_encode(array('status'=>'failed','message'=> 'This prefixtitle Already used'));
            }
            }
            
        else{
            redirect(base_url() , 'refresh');
        }            
    }

     public function Position(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['position'] = $this->organization_model->Positionselect();
        $this->load->view('backend/position',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

     public function Save_PositionTitle(){
        if($this->session->userdata('user_login_access') != False) { 
           $positiontitle = $this->input->post('positiontitle');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('positiontitle','positiontitle','trim|required|xss_clean', array(
                'required'      => 'This %s field is required.'));
    
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                
           }else{
            $val = $positiontitle;
            $table = 'position';
            $data = array('position_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This position  is already exists</p>'));
            } else{
            $data = array();
            $data = array('position_name' => $positiontitle);
            $position_success = $this->organization_model->Add_positiontitle($data);
            if($position_success){
            //$this->session->set_flashdata('position_status','Successfully Added');
           echo json_encode(array('status'=>'success','position_success'=>$position_success));
             }
            }
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function PositionTitle_edit($positionid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['position'] = $this->organization_model->Positionselect();
            $data['editpositiontitle']=$this->organization_model->positiontitle_edit($positionid);
            $this->load->view('backend/position', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function Update_positiontitle(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $positiontitle = $this->input->post('positiontitle');
            $this->form_validation->set_rules('positiontitle', 'position', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('position_name' => $positiontitle );
           $upd_position = $this->organization_model->Update_positiontitle($id, $data);
           if($upd_position){
            
             echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }//
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }


     public function Delete_positiontitle(){
        if($this->session->userdata('user_login_access') != False) { 
              $id = $this->input->post('id');
           $del_position = $this->organization_model->positiontitle_delete($id);
          if($del_position){
           echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
            }else{
               echo json_encode(array('status'=>'failed','message'=> 'This Position Already used'));
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

      public function AccountType(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['account_type'] = $this->organization_model->accounttypeselect();
        $this->load->view('backend/accounttype',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

      public function Save_AccountType(){
        if($this->session->userdata('user_login_access') != False) { 
           $accounttypetitle = $this->input->post('accounttypename');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('accounttypename','account type ','trim|required|xss_clean', array('required'      => 'This %s field is required.'));


           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                
           }else{
            $val = $accounttypetitle;
            $table = 'account_type';
            $data = array('account_type_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This account type  is already exists</p>'));
            } else{
            $data = array();
            $data = array('account_type_name' => $accounttypetitle);
            $acctype_success = $this->organization_model->Add_AccountType($data);
            if($acctype_success){
            echo json_encode(array('status'=>'success','acctype_success'=>$acctype_success));
            }
           }
         }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function AccountType_edit($accounttypeid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['account_type'] = $this->organization_model->accounttypeselect();
            $data['editaccounttype']=$this->organization_model->AccountType_edit($accounttypeid);
            $this->load->view('backend/accounttype', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function Update_AccountType(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $editaccounttypetitle = $this->input->post('accounttypename');
             $this->form_validation->set_rules('accounttypename', 'account type', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('account_type_name' => $editaccounttypetitle );
           $upd_acctype = $this->organization_model->Update_AccountType($id, $data);
           if($upd_acctype){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }//
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

     public function Delete_AccountType(){
        if($this->session->userdata('user_login_access') != False) { 
           $id = $this->input->post('id');
           $del_acctype = $this->organization_model->AccountType_delete($id);
             if($del_acctype){
               echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
            }else{
               echo json_encode(array('status'=>'failed','message'=> 'This Department Already used'));
            }
            
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

      public function Nationality(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['nationality'] = $this->organization_model->Nationalityselect();
        $this->load->view('backend/nationality',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_Nationality(){
        if($this->session->userdata('user_login_access') != False) { 
           $nationality = $this->input->post('nationality');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('nationality','nationality','trim|required|xss_clean', array('required'      => 'This %s field is required.' ));


           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                
           }else{
             $val = $nationality;
            $table = 'nationality';
            $data = array('nationality_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This nationality  is already exists</p>'));
            } else{
            $data = array();
            $data = array('nationality_name' => $nationality);
            $national_success = $this->organization_model->Add_Nationality($data);
             if($national_success){
          echo json_encode(array('status'=>'success','national_success'=>$national_success));
            }
           }
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Nationality_edit($nationalityid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['nationality'] = $this->organization_model->Nationalityselect();
            $data['editnationality']=$this->organization_model->nationality_edit($nationalityid);
            $this->load->view('backend/nationality', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_Nationality(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $nationality = $this->input->post('nationality');
            $this->form_validation->set_rules('nationality', 'nationality', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('nationality_name' => $nationality );
            $acctype_upd = $this->organization_model->Update_Nationality($id, $data);
            if($acctype_upd){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }//
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Delete_Nationality(){
        if($this->session->userdata('user_login_access') != False) { 
             $id = $this->input->post('id');
          $del_national =  $this->organization_model->Nationality_delete($id);
              if($del_national){
          echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
            }else{
               echo json_encode(array('status'=>'failed','message'=> 'This Department Already used'));
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Course(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['coursetype'] = $this->organization_model->Courseselect();

        $this->load->view('backend/coursemaster',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function SaveCourse(){
        if($this->session->userdata('user_login_access') != False) { 
            $user=$this->session->userdata('user_login_id');

            $edulevel = $this->input->post('edulevel');
            $coursename = $this->input->post('coursename');
           
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('coursename','coursename','trim|required|xss_clean', array('required'      => 'This %s field is required.'));


           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                
           }else{
                $val = $coursename;
                $table = 'ms_coursetype';
                $data = array('courseName'=> $val,'isActive'=> 1);
                if($this->organization_model->Check_field_exists($val,$data,$table)){
                echo json_encode(array('error'=>'<p>This course name  is already exists</p>'));
                } else{
                $data = array();
                $data = array('eLevelid' => $edulevel,'courseName' => $coursename,'createdBy' => $user);
                $course_success = $this->organization_model->Add_Course($data);
                 if($course_success){
           echo json_encode(array('status'=>'success','course_success'=>$course_success));
              }
             }
            }
        }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
    public function course_edit($courseid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['coursetype'] = $this->organization_model->courseselect();
            $data['editcourse']=$this->organization_model->course_edit($courseid);
            $this->load->view('backend/coursemaster', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_course(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $course = $this->input->post('coursename');
            $edulevel = $this->input->post('edulevel');
             $this->form_validation->set_rules('coursename', 'course name', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('courseName' => $course ,'eLevelid'=>$edulevel);
            $course_upd = $this->organization_model->Update_course($id, $data);
            if($course_upd){
         echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
              }//
             }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Delete_course(){
        if($this->session->userdata('user_login_access') != False) { 
             $id = $this->input->post('id');
          $del_course =  $this->organization_model->course_delete($id);
              if($del_course){
         echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
            }else{
               echo json_encode(array('status'=>'failed','message'=> 'This Course Already used'));
            }
            
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Language(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['language'] = $this->organization_model->Languageselect();
        $this->load->view('backend/language',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

      public function Save_Language(){
        if($this->session->userdata('user_login_access') != False) { 
           $language = $this->input->post('language');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('language','language','trim|required|xss_clean', array('required'      => 'This %s field is required.'));

           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
                     echo json_encode(array('error'=>$error));
                
           }else{
            $val = $language;
            $table = 'language';
            $data = array('language_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This language  is already exists</p>'));
            } else{
            $data = array();
            $data = array('language_name' => $language);
            $lang_success = $this->organization_model->Add_Language($data);
             if($lang_success){
           echo json_encode(array('status'=>'success','lang_success'=>$lang_success));
             }
            }
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function Language_edit($Languageid){
        if($this->session->userdata('user_login_access') != False) { 
            $data['language'] = $this->organization_model->Languageselect();
            $data['editlanguage']=$this->organization_model->language_edit($Languageid);
            $this->load->view('backend/language', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

     public function Update_Language(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $language = $this->input->post('language');
            $this->form_validation->set_rules('language', 'language', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('language_name' => $language );
            $lang_upd = $this->organization_model->Update_Language($id, $data);
           if($lang_upd){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }//
            }
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

     public function Delete_Language(){
        if($this->session->userdata('user_login_access') != False) { 
             $id = $this->input->post('id');
           $del_lang = $this->organization_model->Language_delete($id);
             if($del_lang){
         echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
            }else{
               echo json_encode(array('status'=>'failed','message'=> 'This Language Already used'));
            }
            
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Employment(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['employment'] = $this->organization_model->empselect();
        $this->load->view('backend/employment',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_employment(){
        if($this->session->userdata('user_login_access') != False) { 
           $emp = $this->input->post('employment');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('employment','employment','trim|required|xss_clean', array(
                'required'      => 'This %s field is required.'
            ));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
                     echo json_encode(array('error'=>$error));
           }else{
            $val = $emp;
            $table = 'employment';
            $data = array('employment_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
                echo json_encode(array('error'=>'<p>This employment  is already exists</p>'));
            } else{
            $data = array();
            $data = array(' employment_name' => $emp);
            $emp_success = $this->organization_model->Add_Employment($data);
            if($emp_success){
              echo json_encode(array('status'=>'success','emp_success'=>$emp_success));
             }
            }
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_emp(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $employment = $this->input->post('employment');
             $this->form_validation->set_rules('employment', 'employment', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('employment_name' => $employment );
            $updatedata = $this->organization_model->Update_Employment($id, $data);//
            if($updatedata){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
            }
            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Emp_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $data['employment'] = $this->organization_model->empselect();
            $data['editemployment']=$this->organization_model->employment_edit($dep);
            $this->load->view('backend/employment', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Delete_emp(){
        if($this->session->userdata('user_login_access') != False) { 
              $emp_id = $this->input->post('emp_id');

            $result_del = $this->organization_model->employment_delete($emp_id);//
            if($result_del){
                 echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
            }else{
               echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //gov id master
     public function GovermentID(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['govid'] = $this->organization_model->govidselect();
        $this->load->view('backend/govtidtype',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_govid(){
        if($this->session->userdata('user_login_access') != False) { 
           $govID_name = $this->input->post('govID_name');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('govID_name','GovID name','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $govID_name;
            $table = 'govidtype';
            $data = array('govID_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Goverment Id Type  is already exists</p>'));
            } else{
            $data = array();
            $data = array('govID_name' => $govID_name);
            $success = $this->organization_model->Save_govid($data);//
            if($success){
                echo json_encode(array('status'=>'success','success'=>$success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Govid_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $dep = $this->uri->segment(3);//
              $data['govid'] = $this->organization_model->govidselect();
            $data['govid_data'] =$this->organization_model->Govid_edit($dep);//
         
            $this->load->view('backend/govtidtype', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_govid(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $govID_name = $this->input->post('govID_name');
            $this->form_validation->set_rules('govID_name', 'Goverment ID', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('govID_name' => $govID_name );
            $dep_result = $this->organization_model->Update_govid($id, $data);//
            if( $dep_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_govid(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->organization_model->Delete_govid($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    //currency master
    public function Currency(){
        if($this->session->userdata('user_login_access') != False) { 
       $data['Currency'] = $this->organization_model->currencyselect();
        $this->load->view('backend/currency_master',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_Currency(){
        if($this->session->userdata('user_login_access') != False) { 

           $currency_name = $this->input->post('currency_name');
           $currency_symbol = $this->input->post('currency_symbol');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        
            $val = $currency_name;
            $table = 'currency_master';
            $data = array('currency_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Currency  is already exists</p>'));
            } else{
            $data = array();
            $data = array('currency_name' => $currency_name,'currency_symbol' => $currency_symbol);
            $success = $this->organization_model->Add_Currency($data);//
            if($success){
                echo json_encode(array('status'=>'success','success'=>$success));
              }
          
            }
         
           
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Currency_edit($id){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->uri->segment(3);//
            $data['Currency'] = $this->organization_model->currencyselect();
            $data['currency_data'] =$this->organization_model->currency_edit($id);//
         
            $this->load->view('backend/currency_master', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
    
    public function Update_Currency(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
           $currency_name = $this->input->post('currency_name');
           $currency_symbol = $this->input->post('currency_symbol');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      
           $data = array('currency_name' => $currency_name,'currency_symbol' => $currency_symbol);
            $result = $this->organization_model->Update_Currency($id, $data);//
            if( $result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

           // }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_Currency(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->organization_model->Delete_Currency($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This Department Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    //Allowance master
    public function Allowance_master(){
        if($this->session->userdata('user_login_access') != False) { 
       $data['Allowance'] = $this->organization_model->allowanceselect();
        $this->load->view('backend/allowance_master',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Save_Allowance(){
        if($this->session->userdata('user_login_access') != False) { 

           $allowance_name = $this->input->post('allowance');
           $overtime_status = $this->input->post('overtime_status');
         
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        
            $val = $allowance_name;
            $table = 'allowance_master';
            $data = array('allowance_name'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Allowance  is already exists</p>'));
            } else{
            $data = array();
            $data = array('allowance_name' => $allowance_name,'overtime_status'=>$overtime_status);
            $success = $this->organization_model->Add_Allowance($data);//
            if($success){
                echo json_encode(array('status'=>'success','success'=>$success));
              }
          
            }
         
           
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Allowance_edit($id){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->uri->segment(3);//
            $data['Allowance'] = $this->organization_model->allowanceselect();
            $data['allowance_data'] =$this->organization_model->allowance_edit($id);//
         
            $this->load->view('backend/allowance_master', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
    
    public function Update_Allowance(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $allowance_name = $this->input->post('allowance');
             $overtime_status = $this->input->post('overtime_status');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      
           $data = array('allowance_name' => $allowance_name,'overtime_status'=>$overtime_status);
            $result = $this->organization_model->Update_Allowance($id, $data);//
            if( $result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

           // }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_Allowance(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->organization_model->Delete_Allowance($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This Allowance Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //Allowance master
        public function Deduction_master(){
            if($this->session->userdata('user_login_access') != False) { 
           $data['Deduction'] = $this->organization_model->deductionselect();
            $this->load->view('backend/deduction_master',$data); 
            }
            else{
                redirect(base_url() , 'refresh');
            }            
        }

        public function Save_Deduction(){
            if($this->session->userdata('user_login_access') != False) { 

               $deduction = $this->input->post('deduction');
             
               $this->load->library('form_validation');
               $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            
                $val = $deduction;
                $table = 'deduction_master';
                $data = array('deduction_name'=> $val,'isActive'=> 1);
                if($this->organization_model->Check_field_exists($val,$data,$table)){
                echo json_encode(array('error'=>'<p>This Deduction  is already exists</p>'));
                } else{
                $data = array();
                $data = array('deduction_name' => $deduction);
                $success = $this->organization_model->Add_Deduction($data);//
                if($success){
                    echo json_encode(array('status'=>'success','success'=>$success));
                  }
              
                }
             
               
                }
            else{
                redirect(base_url() , 'refresh');
            }        
        }

       public function Deduction_edit($id){
            if($this->session->userdata('user_login_access') != False) { 
                $id = $this->uri->segment(3);//
                $data['Deduction'] = $this->organization_model->deductionselect();
                $data['Deduction_data'] =$this->organization_model->Deduction_edit($id);//
             
                $this->load->view('backend/deduction_master', $data);
                }
            else{
                redirect(base_url() , 'refresh');
            }        
        }
        
        public function Update_Deduction(){
            if($this->session->userdata('user_login_access') != False) { 
                $id = $this->input->post('id');
                $deduction = $this->input->post('deduction');
             
               $this->load->library('form_validation');
               $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
          
               $data = array('deduction_name' => $deduction);
                $result = $this->organization_model->Update_deduction($id, $data);//
                if( $result){
                echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
                 }

               // }
              
                }
            else{
                redirect(base_url() , 'refresh');
            }            
        }



        public function Delete_Deduction(){
            if($this->session->userdata('user_login_access') != False) { 
                $id = $this->input->post('id');
                $result_del = $this->organization_model->Delete_Deduction($id);//
              if($result_del){
                    echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
                   
                }else{
                     echo json_encode(array('status'=>'failed','message'=> 'This Deduction Already used'));
                 
                }
               
                }
            else{
                redirect(base_url() , 'refresh');
            }            
        }

         //expenses category
            public function Save_Category(){
        if($this->session->userdata('user_login_access') != False) { 

           $name = $this->input->post('name');
         
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        
            $val = $name;
            $table = 'expenses_category';
            $data = array('category'=> $val,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This category  is already exists</p>'));
            } else{
            $data = array();
            $data = array('category' => $name);
            $success = $this->organization_model->Add_category($data);//
            if($success){
                echo json_encode(array('status'=>'success','success'=>$success));
              }
          
            }
         
           
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    

}