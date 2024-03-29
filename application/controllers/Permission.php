<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {
     private $perm_category = array();
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
         $this->load->model('organization_model');    
         $this->load->model('permission_model');  

         $this->config->load('config');
          $this->perm_category = $this->config->item('perm_category');  
    }

    public function Role_Permissions($id)
	{
		
    if ($this->session->userdata('user_login_access') == 1){
    	$roleid = $this->uri->segment(3);
    	$data['role'] = $this->permission_model->roleselect($roleid);
    	//print_r($data['role']->role); die();
         $role_id =  $data['role']->id;
       
    	$data['rolecategory'] = $this->permission_model->category($role_id);
    	
         $data['id'] = $id;

    	$this->load->view('backend/permission-new',$data);
    }
   }
	public function Assign_Permissions($id)
	{
		
    if ($this->session->userdata('user_login_access') == 1){
      
       //$this->load->view('backend/permission');
    	$roleid = $this->uri->segment(3);
    	$data['role'] = $this->permission_model->roleselect($roleid);
        $role_id =  $data['role']->id;
    	$data['rolecategory'] = $this->permission_model->category($role_id);
    	//$data['rolecategory'] = $role_permission;
    	/*echo '<pre>';
          print_r($data['rolecategory']); echo '</pre>';die();*/

         $data['id'] = $id;

        //$data['role_permission'] = $role_permission;

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $per_cat_post = $this->input->post('per_cat');
            $role_id = $this->input->post('role_id');
            $to_be_insert = array();
            $to_be_update = array();
            $to_be_delete = array();
           //print_r($role_id);die();
           //print_r($per_cat_post);die();
            foreach ($per_cat_post as $per_cat_post_key => $per_cat_post_value) {
                $insert_data = array();
                $ar = array();
                foreach ($this->perm_category as $per_key => $per_value) {
                   // print_r($per_value);die();
                    $chk_val = $this->input->post($per_value . "-perm_" . $per_cat_post_value);
                   
                    if (isset($chk_val)) {
                        $insert_data[$per_value] = 1;
                    } else {
                        $ar[$per_value] = 0;
                    }
                }

                $prev_id = $this->input->post('roles_permissions_id_' . $per_cat_post_value);


                if ($prev_id != 0) {

                    if (!empty($insert_data)) {
                        $insert_data['id'] = $prev_id;
                        $to_be_update[] = array_merge($ar, $insert_data);
                    } else {
                        $to_be_delete[] = $prev_id;
                    }
                } elseif (!empty($insert_data)) {
                    $insert_data['role_id'] = $role_id;
                    $insert_data['sub_id'] = $per_cat_post_value;
                    $to_be_insert[] = array_merge($ar, $insert_data);
                }
            }
           /* echo '--';
             print_r($to_be_delete);
               echo '--';
             print_r($insert_data);
               echo '--';
             print_r($to_be_update);
            

             die();*/

           $result =  $this->permission_model->getInsertBatch($role_id, $to_be_insert, $to_be_update, $to_be_delete);
      
           if ($result) {
         // echo 'Successfully';
           redirect('Permission/Role_Permissions/' . $id);
           }else{
             redirect('Permission/Role_Permissions/' . $id);
           }
           // redirect('Permission/Role_Permissions/' . $id);

            //$this->load->view('backend/permission',$data);

       }
       }
    }

  
    
}