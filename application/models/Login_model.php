<?php

	class Login_model extends CI_Model{


	function __consturct(){
		parent::__construct();
	}
    //   public function getPasswordChangedStatus($user_id) {
    //     $this->db->select('password_changed, user_status');
    //     $this->db->where(array('em_id'=> '$user_id','user_status' => '1'));
    //     $query = $this->db->get('employee'); // Assuming your table is named 'employee'

    //     if ($query->num_rows() > 0) {
    //         $row = $query->row();
    //         return ($row->password_changed == 1 && $row->user_status == 1); // Check if password_changed is 1 and user_status is 1
    //     }else{
    //     	return false; // Default to false if the user is not found
    //     }

        
    // }

    public function getPasswordChangedStatus($user_id) {
    $this->db->select('password_changed, user_status');
    $this->db->where(array('em_id' => $user_id));
    $query = $this->db->get('employee'); // Assuming your table is named 'employee'

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return ($row->password_changed == 1 && $row->user_status == 1) || $row->user_status == 0;
        // Check if password_changed is 1 and user_status is 1, or if user_status is 0
    } else {
        return false; // Default to false if the user is not found
    }
  }

	public function getUserForLogin($credential){		

    	return $this->db->get_where('employee', $credential);
	}
	
	public function getdata(){
			
		$query =$this->db->get('users');
		$result=$query->result();
		return $result;
	}

	//**exists employee email check**//
     public function Does_email_exists($email) {
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_email` FROM $user
		WHERE `em_email`='$email' AND `status` = 'ACTIVE'";
		$result=$this->db->query($sql);
		    if ($result->row()) {
		        return $result->row();
		    } else {
		        return false;
		    }
      }

    public function insertUser($data){
		$this->db->insert('users',$data);
	}

	public function UpdateKey($data,$email){
		$this->db->where('em_email',$email);
		return $this->db->update('employee',$data);
	}
	public function Expirecode($data,$email){
		$this->db->where('em_email',$email);
		return $this->db->update('employee',$data);
	}


	public function UpdatePassword($key,$data){
		$this->db->where('forgotten_code',$key);
		return $this->db->update('employee',$data);	    
	}	
	
	public function UpdateStatus($verifycode,$data){
		$this->db->where('confirm_code',$verifycode);
		$this->db->update('users',$data);	    
	}
	
	//**exists employee email check**//
    public function Does_Key_exists($reset_key) {
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `forgotten_code` FROM $user
		WHERE `forgotten_code`='$reset_key'";
		$result=$this->db->query($sql);
        if ($result->row()) {
            return $result->row();
        } else {
            return false;
        }
    }
	
	public function GetUserInfo($key){
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_password` FROM $user
		WHERE `forgotten_code`='$key'";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;			
	}
	public function GetEMP($email){
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_email`,`first_name`,`last_name` FROM $user
		WHERE `em_email`='$email'";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;			
	}		
	
	public function GetuserInfoBycode($verifycode){
		$user = $this->db->dbprefix('users');
        $sql = "SELECT * FROM $user
		WHERE `confirm_code`='$verifycode'";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;			
	}	
}
?>