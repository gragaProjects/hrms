<?php

	class Loan_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
    public function Add_LoanData($data){
       return $this->db->insert('loan',$data);
    }
    public function Add_installData($data){
      return  $this->db->insert('loan_installment', $data);
    }
    public function loan_modeldata(){
    $sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id` where `hr_status` = 'Granted' ORDER BY `loan`.`id` DESC";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;  
    }   
    public function loan_pendingdata(){
    $sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id` where `hr_status` = 'Pending' ORDER BY `loan`.`id` DESC";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }  
    public function loan_hr_view($eid){
    $sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
       LEFT JOIN `employee` ON `employee`.`em_id` =  `loan`.`emp_id`
      LEFT JOIN `businessunit` ON `employee`.`busunit` =  `businessunit`.`id`

        WHERE `businessunit`.`hr` = '$eid'  AND `employee`.`em_id` <> '$eid'  AND `employee`.`isActive` = '1'";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }   
    public function emploandata($id){
    $sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id` where `loan`.`emp_id` = '$id'  ORDER BY `loan`.`id` DESC";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;  
    }
    public function LoanValselect($id){
    $sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id`
      WHERE `loan`.`id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;  
    }
    public function LoanValEmselect($id){
    $sql = "SELECT `loan`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `loan`
      LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id`
      WHERE `loan`.`emp_id`='$id' AND `loan`.`status`!='Done'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;  
    }
    public function installmentSelect(){
    $sql = "SELECT `loan_installment`.*,
      `employee`.`em_id`,`employee`.`em_code`,`first_name`,`last_name`,`em_id`
      FROM `loan_installment`
      LEFT JOIN `employee` ON `loan_installment`.`emp_id`=`employee`.`em_id` where  `loan_installment`.`isActive` = 1  ORDER BY `loan_installment`.`id` DESC";        
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;  
    }  
     public function installmentSelectemp($id){
    $sql = "SELECT `loan_installment`.*,
      `employee`.`em_id`,`employee`.`em_code`,`first_name`,`last_name`,`em_id`
      FROM `loan_installment`
      LEFT JOIN `employee` ON `loan_installment`.`emp_id`=`employee`.`em_id` where `loan_installment`.`emp_id`= '$id' AND `loan_installment.isActive` =  1 ORDER BY `loan_installment`.`id` DESC";        
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;  
    }
    public function GetLoanValuebyLId($loanid){
      $sql = "SELECT `loan`.*,
        `employee`.`em_id`,`first_name`,`last_name`,`em_code`
        FROM `loan`
        LEFT JOIN `employee` ON `loan`.`emp_id`=`employee`.`em_id`
        WHERE `loan`.`id`='$loanid'";
      $query=$this->db->query($sql);
  		$result = $query->row();
  		return $result;  
    }
    public function update_LoanData($loan_id, $data){
  		$this->db->where('id', $loan_id);
  		return $this->db->update('loan', $data);
    }
    public function update_LoanDataVal($id,$data){
  		$this->db->where('id', $id);
  		return $this->db->update('loan',$data);  
    }
    public function update_LoanInstallData($id,$data){
  		$this->db->where('id', $id);
  		return $this->db->update('loan_installment',$data);  
    }
    public function GetEmployeeForloancheck($em_id){
        $sql = "SELECT * from `loan` WHERE `emp_id`='$em_id' AND   (`status`='Pending'  OR `hr_status`='Pending' ) AND (`status`='Pending'  OR `hr_status`='Granted' ) ";
        $query=$this->db->query($sql);
        $result = $query->row();
        return $result;
    } 
     public function GetEmployeeForloanGranted($em_id){
        $sql = "SELECT * from `loan` WHERE `emp_id`='$em_id' AND  (`status`='Granted'  OR `hr_status`='Granted' ) AND (`status`='Granted'  OR `hr_status`='Pending' )";
        $query=$this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function LoanInstallValEmselect($id){
        $sql = "SELECT * from `loan_installment` WHERE `id`='$id' AND `isActive` =  1";
        $query=$this->db->query($sql);
        $result = $query->row();
        return $result;
    }

   public function Loandelete($id)
    {
     return $this->db->delete('loan',array('id'=> $id));
    }

    
   // public function Loaninstalldelete($id){
   //    $data =  array( 'isActive' => 0);
   //   $this->db->where('id', $id);
   //  return $this->db->update('loan_installment',$data); 
   //  } 

     public function GetLoanValuebyLoanId($loanid) {
        // Assuming you have a table named 'loans' with a primary key 'id'
        $this->db->where('id', $loanid);
        return $this->db->get('loan')->row();
    }

  

    public function Loaninstalldelete($id) {
        // // Assuming you have a table named 'installments'
        // $this->db->where('id', $id);
        // return $this->db->delete('loan_installment');
           $data =  array( 'isActive' => 0);
     $this->db->where('id', $id);
    return $this->db->update('loan_installment',$data); 

    }

    public function getInstallmentDataById($id) {
        // Assuming you have a table named 'installments' with a primary key 'id'
        $this->db->where('id', $id);
        return $this->db->get('loan_installment')->row();
    }

  

}