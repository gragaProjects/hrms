<?php

	class Payroll_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
    public function Add_typeInfo($data){
        $query = $this->db->insert('salary_type',$data);
           $last_id = $this->db->insert_id();
           if($query == TRUE){
              return  $last_id; 
           }else{
            false;
           }
    }
    public function SalaryType_edit($id){

      $sql    = "SELECT * FROM `salary_type` WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

      public function Delete_SalaryType($id){;
      $sql    = "UPDATE `salary_type` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }
    public function insert_Salary_Pay($data){
       return $this->db->insert('pay_salary',$data);
    }
    public function GetsalaryType(){
        $sql = "SELECT * FROM `salary_type` where `isActive` = 1 ORDER BY `salary_type` ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;         
    }
    public function GetBankInfo($eid){
        $sql = "SELECT * FROM `bank_info` WHERE `em_id`='$eid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;         
    }
    public function GetDepEmployee($depid){
    $sql = "SELECT `employee`.*,
      `emp_salary`.`total`,`emp_salary`.`id` AS salaryid
      FROM `employee`
      LEFT JOIN `emp_salary` ON `employee`.`em_id`=`emp_salary`.`emp_id`
      WHERE `employee`.`dep_id`='$depid' AND `employee`.`isActive` = 1 AND `employee`.`user_status` = 1 ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;         
    }
     public function GetBusEmployee($busid,$month,$year){
      $sql = "SELECT DISTINCT
    `employee`.*,`designation`.*,
    `emp_salary`.`total`,
    `emp_salary`.`id` AS salaryid
FROM
    `employee`
LEFT JOIN (
    SELECT
        `emp_salary`.*
    FROM
        `emp_salary`
    JOIN (
        SELECT
            MAX(`id`) AS max_id,
            `emp_id`
        FROM
            `emp_salary`
        WHERE
            `isActive` = 1
        GROUP BY
            `emp_id`
    ) AS max_ids ON `emp_salary`.`id` = max_ids.max_id
) AS `emp_salary` ON `employee`.`em_id` = `emp_salary`.`emp_id`
LEFT JOIN `designation` ON `employee`.`des_id` = `designation`.`id`
WHERE
    `employee`.`busunit` = '$busid'
    AND `employee`.`isActive` = 1
    AND `employee`.`user_status` = 1
    AND (
        `employee`.`em_joining_date` IS NULL 
        OR (
            YEAR(`employee`.`em_joining_date`) < $year
            OR (
                YEAR(`employee`.`em_joining_date`) = $year
                AND MONTH(`employee`.`em_joining_date`) < $month
            )
        )
    )
    AND (`designation`.`des_name` IS NULL OR `designation`.`des_name` != 'CEO')
    AND `designation`.`isActive` = 1;

      ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;         
    } 
    //      public function GetBusEmployee($busid){
    //   $sql = "SELECT   `employee`.*,
    //   `emp_salary`.`total`,`emp_salary`.`id` AS salaryid
    //   FROM `employee`
    //   LEFT JOIN `emp_salary` ON `employee`.`em_id`=`emp_salary`.`emp_id`
    //   WHERE `employee`.`busunit`='$busid' AND `employee`.`isActive` = 1 AND `employee`.`user_status` = 1 AND `emp_salary`.`isActive` = 1";
    //     $query = $this->db->query($sql);
    //     $result = $query->result();
    //     return $result;         
    // } 
    public function Get_typeValue($id){
        $sql = "SELECT * FROM `salary_type` WHERE `salary_type`.`id`= '$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;         
    } 
    public function GetLoanValueByID($id){
        $sql = "SELECT * FROM `loan` WHERE `loan`.`emp_id`= '$id' AND `status`='Granted' AND `status` != 'Done'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;         
    }  
    public function GetLoanValueByMonth($id,$month){
  
        $sql = "SELECT *
                FROM `loan`
                WHERE `emp_id` = '$id'
                  AND `status` = 'Granted'
                  AND `status` != 'Done'
                  AND DATE_FORMAT(STR_TO_DATE(`approve_date`, '%d-%m-%Y'), '%Y-%m') <= '$month'";//DATE_FORMAT(CURDATE(), '%Y-%m')";
        $query = $this->db->query($sql);
        $result = $query->row(); //'2023-10'
     
        return $result;         
    } 
    public function hasLoanOrNot($id){
        $sql = "SELECT * FROM `loan` WHERE `loan`.`emp_id`= '$id' AND `status`='Granted' AND `status` != 'Done'";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result ? 1 : 0;    
    } 
    public function GetHolidayByYear($dateval){
        $sql = "SELECT * FROM `holiday` WHERE `holiday`.`year`= '$dateval'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;         
    } 
    public function GetloanInfo($emid){
        $sql = "SELECT * FROM `loan` WHERE `loan`.`emp_id`= '$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;         
    }
    public function Update_typeInfo($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('salary_type', $data);        
    }
    public function Update_SalaryPayInfo($id,$data){
        $this->db->where('pay_id', $id);
       return $this->db->update('pay_salary', $data);        
    }
    public function Get_Salary_Value($id){
      $sql = "SELECT `emp_salary`.*,
      `addition`.*,
      `deduction`.*
      FROM `emp_salary`
      LEFT JOIN `addition` ON `emp_salary`.`id`=`addition`.`salary_id`
      LEFT JOIN `deduction` ON `emp_salary`.`id`=`deduction`.`salary_id`
      WHERE `emp_salary`.`emp_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;        
    }
    public function Get_Salarypay_Value($id){
      $sql = "SELECT `pay_salary`.*,
      `employee`.`em_id`,`first_name`,`last_name`,
      `salary_type`.*
      FROM `pay_salary`
      LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `salary_type` ON `pay_salary`.`type_id`=`salary_type`.`id`
      WHERE `pay_salary`.`pay_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;        
    }
    public function getAllSalaryDataByMonthYearEm($busunit,$month,$year){
      $sql = "SELECT `pay_salary`.*,
      `employee`.`em_id`,`employee`.`em_code`,`first_name`,`last_name`,
      `salary_type`.*
      FROM `pay_salary`
      LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `salary_type` ON `pay_salary`.`type_id`=`salary_type`.`id`
      WHERE    `employee`.`busunit`='$busunit' AND `employee`.`isActive` = 1 AND `pay_salary`.`month`='$month' AND `pay_salary`.`year`='$year' AND `pay_salary`.`isActive` = 1 ORDER BY `pay_salary`.`month` DESC   ";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
    }   
/*     public function getAllSalaryDataByMonthYearEm($eid,$month,$year){
      $sql = "SELECT `pay_salary`.*,
      `employee`.`em_id`,`employee`.`em_code`,`first_name`,`last_name`,
      `salary_type`.*
      FROM `pay_salary`
      LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `salary_type` ON `pay_salary`.`type_id`=`salary_type`.`id`
      WHERE `pay_salary`.`emp_id`='$eid' AND `pay_salary`.`month`='$month' AND `pay_salary`.`year`='$year' AND `pay_salary`.`isActive` = 1 ORDER BY `pay_salary`.`month` DESC   ";
        $query=$this->db->query($sql);
    $result = $query->row();
    return $result;        
    }*/
    public function GetsalaryValueEm() {
      $sql = "SELECT `emp_salary`.*,
      `addition`.*,
      `deduction`.*,
      `salary_type`.`salary_type`,
      `employee`.`first_name`,`last_name`,`em_id`
      FROM `emp_salary`
      LEFT JOIN `salary_type` ON `emp_salary`.`type_id`=`salary_type`.`id`
      LEFT JOIN `addition` ON `emp_salary`.`id`=`addition`.`salary_id`
      LEFT JOIN `deduction` ON `emp_salary`.`id`=`deduction`.`salary_id`
      LEFT JOIN `employee` ON `emp_salary`.`emp_id`=`employee`.`em_id`
      ORDER BY `emp_salary`.`id` DESC";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
    }
    public function GetAllSalary(){
      $sql = "SELECT `pay_salary`.*,
      `employee`.`first_name`,`last_name`,`em_code`,
      `salary_type`.`salary_type`
      FROM `pay_salary`
      LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `salary_type` ON `pay_salary`.`type_id`=`salary_type`.`id`
      ORDER BY `pay_salary`.`pay_id` DESC";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
    }



/*Invoice Start*/
    public function getAllSalaryID($id){
      $sql = "SELECT *
              FROM `pay_salary` WHERE `emp_id` = '$id'";
      $query=$this->db->query($sql);
      $result = $query->row();
      return $result;        
    }


    public function getEmployeeID($id){
      $sql = "SELECT `employee`.*,
      `designation`.*,
      `org_department`.*,
      `emp_salary`.*,
      `emp_personal`.`presentaddress`,`emp_personal`.`presentcountry`,`emp_personal`.`presentstate`,`emp_personal`.`presentcity`,`emp_personal`.`presentdistrict`,`emp_personal`.`presentpincode`
      FROM `employee`
      LEFT JOIN `designation` ON `employee`.`des_id`=`designation`.`id`
      LEFT JOIN `org_department` ON `employee`.`dep_id`=`org_department`.`id`
      LEFT JOIN `emp_salary` ON `emp_salary`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `emp_personal` ON `emp_personal`.`em_id`=`employee`.`em_id`
      WHERE `employee`.`em_id`='$id'";
        $query=$this->db->query($sql);
    $result = $query->row();
    return $result;         
    }
    public function Get_SalaryID($id){
      $sql = "SELECT `emp_salary`.*,
      `addition`.*,
      `deduction`.*
      FROM `emp_salary`
      LEFT JOIN `addition` ON `emp_salary`.`id`=`addition`.`salary_id`
      LEFT JOIN `deduction` ON `emp_salary`.`id`=`deduction`.`salary_id`
      WHERE `emp_salary`.`emp_id`='$id'";
        $query=$this->db->query($sql);
    $result = $query->row();
    return $result;        
    }  
    public function Get_SalaryCurrency($salarycurrency){
      $sql = "SELECT *
      FROM `currency_master`
      WHERE `id`='$salarycurrency'";
        $query=$this->db->query($sql);
    $result = $query->row();
    return $result;        
    }

/*Invoice End*/   


    public function getAllSalaryData(){
      $sql = "SELECT `pay_salary`.*,
              `employee`.`first_name`,`last_name`,`em_code`
              FROM `pay_salary`
              LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id` where `pay_salary`.`isActive` = 1
              ORDER BY `pay_salary`.`pay_id` DESC";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
    
    //get indivual data
    public function getempSalaryData($id){
      $sql = "SELECT `pay_salary`.*,
              `employee`.`first_name`,`last_name`,`em_code`
              FROM `pay_salary`
              LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id` where  `pay_salary`.`emp_id` = '$id' AND `pay_salary`.`isActive` = 1
              ORDER BY `pay_salary`.`pay_id` DESC";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
    
    

    public function getAllSalaryDataById($id){
      $sql = "SELECT `pay_salary`.*,
              `employee`.`first_name`,`last_name`,`em_code`
              FROM `pay_salary`
              LEFT JOIN `employee` ON `pay_salary`.`emp_id`=`employee`.`em_id`
              WHERE `pay_salary`.pay_id = '$id'  where `pay_salary`.`isActive` = 1";
      $query = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    
    public function getAdditionDataBySalaryID($salaryID) {
      $sql = "SELECT `addition`.*
              FROM `addition`
              WHERE `addition`.salary_id = '$salaryID'";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function getDiductionDataBySalaryID($salaryID) {
      $sql = "SELECT `deduction`.*
              FROM `deduction`
              WHERE `deduction`.salary_id = '$salaryID'";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function GetsalaryValueByID($id){
      $sql = "SELECT `emp_salary`.*
      FROM `emp_salary`
      WHERE `emp_salary`.`emp_id`='$id'";
      $query=$this->db->query($sql);
      $result = $query->row();
      return $result;        
    }     
    public function getNumberOfHolidays($month, $year){
      $sql = "SELECT SUM(`number_of_days`) AS total_days
      FROM `holiday`
      WHERE MONTH(`from_date`)='$month' AND YEAR(`from_date`)='$year'";
      $query=$this->db->query($sql);
	    $result = $query->row();
	    return $result;        
    }
public function getPinFromID($employeeID){
      $sql = "SELECT `em_code`
      FROM `employee`
      WHERE `em_id` = '$employeeID'";
      $query=$this->db->query($sql);
	    $result = $query->row();
	    return $result;        
    }

      public function totalHoursWorkedByEmployeeInAMonth($employeePIN, $start_date, $end_date)
    {
      $sql = "SELECT TRUNCATE((SUM(ABS(( TIME_TO_SEC( TIMEDIFF( `signin_time`, `signout_time` ) ) )))/3600), 1) AS Hours FROM `attendance` WHERE (`attendance`.`emp_id`='$employeePIN') AND (`atten_date` BETWEEN '$start_date' AND '$end_date')";
        $query  = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    public function insertPaidSalaryData($data){
        $result = $this->db->insert('pay_salary',$data);
        return $result;
    }

    public function updatePaidSalaryData($id, $data){
        $this->db->where('pay_id', $id);
        $result = $this->db->update('pay_salary', $data);
        return $result;
    }
    public function getSalaryRecord($emid, $month,$year){
      $sql = "SELECT `pay_salary`.*
              FROM `pay_salary`
              WHERE `emp_id`='$emid' AND `month`='$month' AND `year`='$year' AND `isActive` =  1";
      $query=$this->db->query($sql);
      $result = $query->result();
      return $result;        
    } 

      public function getinstallmentinfo($emid,$app_date ){ //loan_installment
      $sql = "SELECT *FROM loan_installment WHERE `emp_id`='$emid' AND DATE_FORMAT(app_date, '%m-%Y') = '$app_date ' AND `isActive` =  1";
      $query=$this->db->query($sql);
      $result = $query->result();
      return $result;        
    } 

    public function getOtherInfo($emid) {
      $sql = "
SELECT `employee`.*,
              (SELECT `des_name` FROM `designation` WHERE `employee`.`des_id` = `designation`.`id`) AS designation, 
              (SELECT `city_name` FROM `city` WHERE `emp_personal`.`presentcity` =`city`.`id`) AS city,
              (SELECT `nationality_name` FROM `nationality` WHERE `emp_personal`.`nationality` =`nationality`.`id`) AS nationality,
              (SELECT `depname` FROM `org_department` WHERE `employee`.`dep_id` = `org_department`.`id`) AS dep_name, `emp_salary`.`total`, `bank_info`.*, `addition`.*, `deduction`.*, 
              (SELECT TRUNCATE((SUM(ABS(( TIME_TO_SEC( TIMEDIFF( `signin_time`, `signout_time` ) ) )))/3600), 1) AS Hours FROM `attendance` WHERE (`attendance`.`emp_id`='$emid') AND (DATE_FORMAT(`attendance`.`atten_date`, '%m'))=MONTH(CURRENT_DATE())) AS hours_worked,COUNT(*) AS days FROM `employee`
           
             LEFT JOIN `org_department` ON `employee`.`dep_id`=`org_department`.`id` 
              LEFT JOIN `addition` ON `employee`.`em_id`=`addition`.`salary_id` 
              LEFT JOIN `deduction` ON `employee`.`em_id`=`deduction`.`salary_id` 
              LEFT JOIN `bank_info` ON `employee`.`em_id`=`bank_info`.`em_id` 
              LEFT JOIN `emp_personal` ON `employee`.`em_id`=`emp_personal`.`em_id` 
              LEFT JOIN `city` ON `emp_personal`.`presentcity` =`city`.`id` 
              LEFT JOIN `emp_salary` ON `employee`.`em_id`=`emp_salary`.`emp_id` WHERE `employee`.`em_id`='$emid'";
      $query=$this->db->query($sql);
      $result = $query->result();
      return $result;
    } 
    //get organistion
    public function GetOrganisationValue(){
    $organisation = $this->db->dbprefix('organisation');
        $sql = "SELECT * FROM $organisation";
    $query=$this->db->query($sql);
    $result = $query->row();
    return $result;         
    }  
    //allowance
      public function Add_Allowance($data){
        return $this->db->insert('emp_allowance', $data);
    }  
     public function Get_emp_allowance($emid,$salaryid,$month){
        $sql = "SELECT * FROM `emp_allowance` WHERE `emp_id` = '$emid'  AND  `month` = '$month' AND `isActive` = 1 ";//AND `salaryid` = '$salaryid'
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }

    public function deleteallowance($id){
    
     /* $sql    = "UPDATE `emp_allowance` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;*/
       return $this->db->delete('emp_allowance',array('id'=> $id));
      
    }
       //deduction
      public function Add_deductiom($data){
        return $this->db->insert('emp_deduction', $data);
    } //AND `salaryid` = '$salaryid'
     public function Get_emp_deduction($emid,$salaryid,$month){
        $sql = "SELECT * FROM `emp_deduction` WHERE `emp_id` = '$emid' AND `month` = '$month' AND  `isActive` = 1";//AND `salaryid` = '$salaryid'
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
      
       public function deletededuction($id){
    
     /* $sql    = "UPDATE `emp_deduction` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;*/
           return $this->db->delete('emp_deduction',array('id'=> $id));
      
    }
    //employee leave count 
    public function Get_emp_leave_count($employeeID,$date,$leavestructureid){
      
      $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,SUM(`leave_days`) AS leavecount  FROM `emp_leave`
              LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
              WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Unpaid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%m-%Y') = '$date' AND leave_type != 'Half Day'  AND `leave_types`.`leavestrucid` = '$leavestructureid' AND `emp_leave`.`leavestrucid` = '$leavestructureid'";
            //DATE_FORMAT(`start_date`,'%m-%Y') = '$date'
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
   }
    //employee paid leave count 
    public function Get_paid_leave_count($employeeID,$date,$leavestructureid){
    
      $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,SUM(`leave_days`) AS leavecount , (`leave_types`.`leave_day`) AS Total_days ,MONTH(`start_date`) AS `month` FROM `emp_leave`
      LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
      WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Paid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%m-%Y') = '$date' AND leave_type != 'Half Day' AND `leave_types`.`leavestrucid` = '$leavestructureid' AND `emp_leave`.`leavestrucid` = '$leavestructureid' ";/*MONTH(`start_date`)*/
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
        //DATE_FORMAT(`start_date`,'%m-%Y') = '$date'
    }  
    //employee paid leave count 
 /*   public function All_paid_leave_count($employeeID,$year,$leavestructureid){
    
      $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,SUM(`leave_days`) AS leavecount , (`leave_types`.`leave_day`) AS Total_days FROM `emp_leave`
      LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
      WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Paid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%Y') = '$year' AND leave_type != 'Half Day' AND `leave_types`.`leavestrucid` = '$leavestructureid' AND `emp_leave`.`leavestrucid` = '$leavestructureid' ";//MONTH(`start_date`)
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
        //DATE_FORMAT(`start_date`,'%m-%Y') = '$date'
    }   */
     public function All_paid_leave_count($employeeID,$monthlist,$leavestructureid){
    
      $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,SUM(`leave_days`) AS leavecount , (`leave_types`.`leave_day`) AS Total_days,MONTH(`start_date`) AS `month` FROM `emp_leave`
      LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
      WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Paid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%m-%Y') = '$monthlist' AND leave_type != 'Half Day' AND `leave_types`.`leavestrucid` = '$leavestructureid' AND `emp_leave`.`leavestrucid` = '$leavestructureid' ";/*MONTH(`start_date`)*/
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
        //DATE_FORMAT(`start_date`,'%m-%Y') = '$date'
    }
    //get half day emp
    public function Halfday_emp_leave_count($employeeID,$date,$leavestructureid){
      
      $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,count(id) AS halfdays FROM `emp_leave`
              LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
              WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Unpaid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%m-%Y') = '$date' AND leave_type = 'Half Day'AND `leave_types`.`leavestrucid` = '$leavestructureid' AND `emp_leave`.`leavestrucid` = '$leavestructureid' ";

        $query = $this->db->query($sql);
       $result = $query->row();
       return $result;

   }   
     public function Halfday_pdf_leave_count($employeeID,$date){
        
        $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,count(id) AS halfdays FROM `emp_leave`
                LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
                WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Unpaid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%m-%Y') = '$date' AND leave_type = 'Half Day' ";

          $query = $this->db->query($sql);
         $result = $query->row();
         return $result;

     }
       //get half day emp paid leave count 
    public function Halfday_paid_leave_count($employeeID,$date){
    
      $sql = "SELECT `emp_leave`.*,`leave_types`.`paidstatus`,count(id) AS halfdays FROM `emp_leave`
      LEFT JOIN `leave_types` ON `leave_types`.`type_id`=`emp_leave`.`typeid`
      WHERE `emp_leave`.`em_id` = '$employeeID' AND `paidstatus` = 'Paid' AND `leave_status` = 'Approved' AND `leave_types`.`isActive` = 1 AND  DATE_FORMAT(`start_date`,'%m-%Y') = '$date' AND leave_type = 'Half Day'";/*MONTH(`start_date`)*/
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
  //employee allowance total
    public function Get_total_allowance($employeeID, $datetime){
        $sql = "SELECT emp_id,month,allowance,allowance_amount,SUM(`allowance_amount`) AS total_allowance FROM `emp_allowance` WHERE  `isActive` = 1 AND `emp_id` = '$employeeID' AND `month` = '$datetime'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }    
     public function Get_overtime_allowance($employeeID, $datetime){
        $sql = "SELECT am.*, ea.emp_id, ea.month, ea.allowance, ea.allowance_amount,SUM(ea.allowance_amount) AS total_allowance  FROM emp_allowance ea JOIN allowance_master am ON ea.allowance = am.allowance_name WHERE am.overtime_status = '1' AND ea.isActive = 1 AND ea.emp_id = '$employeeID' AND ea.month = '$datetime' GROUP BY ea.emp_id, ea.month, ea.allowance, ea.allowance_amount "; 

        // $sql = "SELECT emp_id,month,allowance,allowance_amount,SUM(`allowance_amount`) AS total_allowance FROM `emp_allowance` WHERE `allowance` = 'Over Time' AND `isActive` = 1 AND `emp_id` = '$employeeID' AND `month` = '$datetime'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }  
    //employee allowance total
    public function Get_total_deduction($employeeID, $datetime){
        $sql = "SELECT emp_id,month,deduction,deduction_amount,SUM(`deduction_amount`) AS total_deduction FROM `emp_deduction` WHERE  `isActive` = 1 AND `emp_id` =  '$employeeID'AND `month` = '$datetime'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    //payslip
     public function Generate_payslip($id,$eid )
    {
       $sql = "SELECT * FROM `pay_salary`LEFT JOIN `emp_salary` ON `emp_salary`.`id` = `pay_salary`.`type_id`
       WHERE `pay_id` = '$id' AND  `pay_salary` .`emp_id` = '$eid' AND `pay_salary`.`isActive` = 1 AND `emp_salary`.`isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }  
    public function Generate_payslip_businessunit($month,$year,$busunit)
    {
       $sql = "SELECT `pay_salary`.*,`emp_salary`.*,`employee`.`busunit`,`employee`.`em_id`,`pay_salary`.`emp_id` AS employeeid  FROM `pay_salary`LEFT JOIN `emp_salary` ON `emp_salary`.`id` = `pay_salary`.`type_id` LEFT JOIN `employee` ON `employee`.em_id = `pay_salary`.`emp_id`
       WHERE  `pay_salary`.`isActive` = 1 AND `emp_salary`.`isActive` = 1 AND `employee`.`busunit` = '$busunit' AND `pay_salary`.`month` = '$month' 
        AND `pay_salary`.`year` = '$year' ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }    
    //
    //Get allowance
    public function Get_allowance($eid,$datetime)
    {
       $sql = "SELECT * FROM `emp_allowance` WHERE `emp_id` = '$eid' AND `month` = '$datetime' AND `isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
 //Get deduction
    public function Get_deduction($eid,$datetime)
    {
       $sql = "SELECT * FROM `emp_deduction` WHERE `emp_id` = '$eid' AND `month` = '$datetime' AND `isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function Payslipdelete($id)
    {
     return $this->db->delete('pay_salary',array('pay_id'=> $id));
    }

    public function get_deduction_by_name($deduction_name,$emp_id,$month)
{
    // Assuming you have a database table named 'deductions'
    $query = $this->db->get_where('emp_deduction', array('deduction' => $deduction_name,'emp_id'=>$emp_id,'month'=>$month));

    // Check if the query returned any result
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

public function get_allowance_by_name($allowance_name,$emp_id,$month)
{
    // Assuming you have a database table named 'allowances'
    $query = $this->db->get_where('emp_allowance', array('allowance' => $allowance_name,'emp_id'=>$emp_id,'month'=>$month));

    // Check if the query returned any result
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}


}