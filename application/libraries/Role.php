<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Role {

        protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
        public function __construct()
        {
               
        	$this->CI =& get_instance();

			/*$CI->load->helper('url');
			$CI->load->library('session');*/
			 $this->CI->load->library('session');
			 $this->CI->load->model('permission_model');  
        }


       public function User_Permission($category = null,$permission  = null){



	     if ( $this->CI->session->userdata('user_login_access') == 1){
	        $role_id =  $this->CI->session->userdata('user_type');
	       /* $category = 'employee_list';
	        $permission = 'can_delete';*/
	    
	       $getpermission =   $this->CI->permission_model->Check_User($role_id,$category,$permission);
	   
	       if($getpermission || count($getpermission) > 0)
	       {
	        return true;
	       }else{
	        return false;
	       }
	     }
	        
       }
}
?>