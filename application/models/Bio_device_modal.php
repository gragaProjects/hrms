<?php

	class Bio_device_modal extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
	  //check field already exists
   public function Check_field_exists($val,$data,$table){
       $this->db->where($data);
       //$this->db->where();
       return $this->db->get($table)->num_rows();
  
    }
   
   
    
     public function deviceselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('biometric_device');
      $result = $query->result();
      return $result;
    }   
      public function devicelogs(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('device_logs');
      $result = $query->result();
      return $result;
    }  
   
   public function bioselectval($id){
      $this->db->where('isActive', 1);//
      $this->db->where('id', $id);//
      $query = $this->db->get('biometric_device');
      $result = $query->row();
      return $result;
    }

      public function device_delete($id){
      
      $sql    = "UPDATE `biometric_device` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
     
    }
 }