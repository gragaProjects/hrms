<?php

class Notice_model extends CI_Model{


    	function __consturct(){
    	   parent::__construct();
    	
    	}
    public function GetNotice(){
        $sql = "SELECT * FROM `notice` where `isActive` = 1  ORDER BY `notice`.`id` DESC ;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
        }
    public function Published_Notice($data){
        return $this->db->insert('notice',$data);
    }
    /*public function GetNoticelimit(){
        $this->db->order_by('date', 'DESC');
		$query = $this->db->get('notice');
		$result =$query->result();
        return $result;        
    }*/
    public function GetNoticelimit(){
        $sql = "SELECT * FROM `notice` WHERE      (`todate`>= CURDATE() AND `date` <= CURDATE() AND `isActive` = 1) OR
    (`date` >= CURDATE() AND `todate` <= CURDATE() AND `isActive` = 1)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;      
    }
        
      public function Inactive_notice($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('notice',$data);  
                  
     } 
     public function active_notice($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('notice',$data);  
                  
     }

   public function Noticedelete($id){
      $data =  array( 'isActive' => 0);
     $this->db->where('id', $id);
    return $this->db->update('notice',$data); 
    }  

      public function Add_policy($data){
        return $this->db->insert('company_policies',$data);
    } 
      public function Get_policies($busunit){
        $sql = "SELECT * FROM `company_policies` WHERE `busunit` = '$busunit'  AND `isActive` = 1 ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }

        public function deletepolicy($id){
    
      $sql    = "UPDATE `company_policies` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
      // return $this->db->delete('emp_allowance',array('id'=> $id));
      
    }

   public function GetpolicyValuebyId($id) {
        // Assuming you have a table named 'loans' with a primary key 'id'
        $this->db->where(array('id'=> $id,'isActive'=>"1"));
        return $this->db->get('company_policies')->row();
    }

      public function update_policyData($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('company_policies', $data);
    }

}
?>