<?php

	class Shift_modal extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
	  //check field already exists
   public function Check_field_exists($val,$data,$table){
       $this->db->where($data);
       //$this->db->where();
       return $this->db->get($table)->num_rows();
  
    }
   
   
    
    public function businessunitselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('businessunit');
      $result = $query->result();
      return $result;
    }

   
    public function Save_Shift($data){
        $this->db->insert('shift_master',$data);
        return $this->db->insert_id();
    }
    public function Update_Shift($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('shift_master',$data);  
                  
     }   

     public function Save_Shift_details($data){
       return $this->db->insert('shift_details',$data);
    }
    public function Update_Shift_details($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('shift_details',$data);  
                  
     }

     public function shiftselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('shift_master');
      $result = $query->result();
      return $result;
    }   
    public function shiftdetailsselect($id){
      $this->db->where('isActive', 1);//
      $this->db->where('shift_id', $id);//
      $query = $this->db->get('shift_details');
      $result = $query->result();
      return $result;
    }  
    public function ShiftValselect($id){
      $this->db->where('isActive', 1);//
      $this->db->where('id', $id);//
      $query = $this->db->get('shift_details');
      $result = $query->row();
      return $result;
    } 
     public function shiftselectval($id){
      $this->db->where('isActive', 1);//
      $this->db->where('id', $id);//
      $query = $this->db->get('shift_master');
      $result = $query->row();
      return $result;
    }

       public function Getorgdep($id){
    $sql = "SELECT * FROM `org_department`
    WHERE `id`='$id' AND `isActive`= 1";
      $query=$this->db->query($sql);
    $result = $query->row();
    return $result;          
   } 
   
 }