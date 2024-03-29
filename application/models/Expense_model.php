<?php

	class Expense_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}

      public function Add_expense_category($data){
        $query = $this->db->insert('expenses_category',$data);
          return $query;
    }
   
    public function expense_category(){
    $sql = "SELECT * 
      FROM `expenses_category`  WHERE `isActive` = 1 ";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;  
    } 
      public function Update_expense_category($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('expenses_category', $data);        
    }
     public function expense_categorydelete($id)
    {
     return $this->db->delete('expenses_category',array('id'=> $id));
    }
    public function expense_category_edit($id){

      $sql    = "SELECT * FROM `expenses_category` WHERE `id`='$id' ";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
     public function expense_modeldata(){
    $sql = "SELECT `expenses`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `expenses` LEFT JOIN `employee` ON `expenses`.`emp_id`=`employee`.`em_id` WHERE `expenses`.`isActive` = 1  order by `id` desc";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }  
     public function expense_modeldatabyid($id){
    $sql = "SELECT `expenses`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `expenses` LEFT JOIN `employee` ON `expenses`.`emp_id`=`employee`.`em_id` WHERE `expenses`.`isActive` = 1 AND `expenses`.`emp_id` = '$id' ";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }    
    public function getexpensebyid($id){
    $sql = "SELECT `expenses`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `expenses` LEFT JOIN `employee` ON `expenses`.`emp_id`=`employee`.`em_id` WHERE  `expenses`.`id` = '$id' AND `expenses`.`isActive` = 1 ";
        $query=$this->db->query($sql);
    $result = $query->row();
    return $result;  
    }  
    // public function getexpensedatabyid($id){
    // $sql = "SELECT `expenses_data`.*,
    //   `employee`.`em_id`,`first_name`,`last_name`,`em_code`
    //   FROM `expenses_data` LEFT JOIN `expense_files` ON `expense_files`.`expense_id` = `expenses_data`.`expense_id` LEFT JOIN `employee` ON `expenses_data`.`emp_id`=`employee`.`em_id`  WHERE  `expenses_data`.`expense_id` = '$id' AND `expenses_data`.`isActive` = 1 ";
    //     $query=$this->db->query($sql);
    // $result = $query->result();
    // return $result;  
    // }  
    public function getexpensedatabyid($id){
    $sql = "SELECT `expenses_data`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `expenses_data` LEFT JOIN `employee` ON `expenses_data`.`emp_id`=`employee`.`em_id`  WHERE  `expenses_data`.`expense_id` = '$id' AND `expenses_data`.`isActive` = 1 ";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }  

    // public function getexpensedatabyid($id){
    // $sql = "SELECT `expense_files`.*,`expenses_data`.*,
    //   `employee`.`em_id`,`first_name`,`last_name`,`em_code`
    //   FROM `expense_files` LEFT JOIN `expenses_data` ON `expense_files`.`expense_id` = `expenses_data`.`expense_id` LEFT JOIN `employee` ON `expense_files`.`emp_id`=`employee`.`em_id` WHERE  `expense_files`.`expense_id` = '$id' AND `expense_files`.`isActive` = 1
    //   GROUP BY `expenses_data`.`id`";
    //     $query=$this->db->query($sql);
    // $result = $query->result();
    // return $result;  
    // } 
    public function getexpensefilesbyid($id){
    $sql = "SELECT `expense_files`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `expense_files` LEFT JOIN `employee` ON `expense_files`.`emp_id`=`employee`.`em_id` WHERE  `expense_files`.`expense_id` = '$id' AND `expense_files`.`isActive` = 1 ";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }  
    /*SELECT `expense_files`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `expense_files` LEFT JOIN `expenses_data` ON `expense_files`.`expense_id` = `expenses_data`.`expense_id` LEFT JOIN `employee` ON `expense_files`.`emp_id`=`employee`.`em_id` WHERE  `expense_files`.`expense_id` = '2' AND `expense_files`.`isActive` = 1
      GROUP BY `expense_files`.`id`
   */  

    /*SELECT `expenses`.*, `employee`.`em_id`,`first_name`,`last_name`,`em_code` FROM `expenses` LEFT JOIN `expenses_data` ON `expenses`.`id`=`expenses_data`.`expense_id` LEFT JOIN `expense_files` ON `expenses`.`id`=`expense_files`.`expense_id`  LEFT JOIN `employee` ON `expenses`.`emp_id`=`employee`.`em_id` WHERE `expenses`.`isActive` = 1*/

     public function expenses_status($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('expenses',$data);  
                  
     }


     public function Expenses_delete($id)
    {

      // Retrieve the data from the database
      $data = $this->db->get_where('expenses_data',array('expense_id'=> $id))->result();

      // Loop through the data using a foreach loop
      foreach ($data as $row) {
          // Get the filename from the database row
          $filename = $row->file_name;

          // Check if the file exists
          if (file_exists('./assets/uploads/temp/' . $filename)) {
              // Delete the file
              unlink('./assets/uploads/temp/' . $filename);
          }
      }
     // $this->db->delete('expense_files',array('expense_id'=> $id)); 
      $this->db->delete('expenses_data',array('expense_id'=> $id));
      return $this->db->delete('expenses',array('id'=> $id));
    }


      //Notification
        public function getadmin(){
          $sql = "SELECT  * FROM `employee`  WHERE 
           `isActive` = 1 AND `user_status` = 0";
          $query  = $this->db->query($sql);
          $result = $query->row();
      
          return $result;
        }
         public function getbusunitid($id){
          $sql = "SELECT  `busunit`,em_id FROM `employee`  WHERE `em_id` = '$id'
            AND `isActive` = 1 AND `user_status` = 1";
            $query  = $this->db->query($sql);
            $result = $query->row();
        
            return $result;
         }  
        public function Emplist_hr($id){
        $sql = "SELECT `businessunit`.*,`employee`.`em_id` FROM `businessunit`  LEFT JOIN `employee` ON `businessunit`.`hr`=`employee`.`em_id` WHERE   `businessunit`.`isActive` = 1 AND  `employee`.`isActive` = 1 AND `businessunit`.`id` = $id"; 
        $query = $this->db->query($sql);
        return $query->row();
     } 
         public function getempbyid($id){
        $sql = "SELECT  * FROM `employee`  WHERE `em_id` = '$id'
          AND `isActive` = 1 AND `user_status` = 1";
          $query  = $this->db->query($sql);
          $result = $query->row();
      
          return $result;
        }  
  
}