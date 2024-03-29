<?php

	class Leave_model extends CI_Model {


	function __consturct(){
	parent::__construct();
	
	}
    public function Add_HolidayInfo($data1){
        return $this->db->insert('holiday',$data1);
    } 
    public function Add_Holidaystruc($data){
        return $this->db->insert('holidaystructure',$data);
    }
   public function Add_Leavestruc($data){
        return $this->db->insert('leavestructure',$data);
    }

    // Add the application of leave with ID no ID
    public function Application_Apply($data){
        return $this->db->insert('emp_leave',$data);
    }

    // Add Earn leave with ID no ID
    public function Add_Earn_Leave($data){
        return $this->db->insert('earned_leave',$data);
    }

    // Update application with employee ID
    public function Application_Apply_Update($id, $data){
        $this->db->where('id', $id);
         return $this->db->update('emp_leave', $data);         
    }

    public function Add_leave_Info($data){
        return $this->db->insert('leave_types',$data);
    }
    public function Application_Apply_Approve($data){
        return $this->db->insert('assign_leave', $data);
    }
    public function GetAllHolistructure(){
        $sql = "SELECT * FROM `holidaystructure` WHERE `isActive` = 1 ";//AND `Active_status` = 1
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    } 
    public function Getleavestructure(){
        $sql = "SELECT * FROM `leavestructure` WHERE`isActive` = 1 AND `Active_status` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    } 
     public function Getleavestruc(){
        $sql = "SELECT * FROM `leavestructure` WHERE`isActive` = 1 ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
      public function GetAllHoliInfo($id){
        $sql = "SELECT * FROM `holiday` WHERE `isActive` = 1 AND `structureid` = $id ORDER BY from_date desc";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }  
     public function GetLeaveInfo($id){
        $sql = "SELECT * FROM `leave_types` WHERE `isActive` = 1 AND `leavestrucid` = $id";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetAllHoliInfoForCalendar(){
        $sql = "SELECT holiday_name AS `title`, from_date AS `start` FROM `holiday`";
        $query = $this->db->query($sql);
        $result = $query->result();
        return json_encode($result);
    }
     public function GetholidaystucValue($id){
        $sql = "SELECT * FROM `holidaystructure` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }  
    public function GetleavestucValue($id){
        $sql = "SELECT * FROM `leavestructure` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetLeaveValue($id){
        $sql = "SELECT * FROM `holiday` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarneBalanceByEmCode($id){
        $sql = "SELECT `earned_leave`.*,
        `employee`.`em_id`,CONCAT(`first_name`, ' ', `last_name`) AS emname
        FROM `earned_leave`
        LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id`
        WHERE `earned_leave`.`em_id`='$id'";        
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetLeaveType($id){
        $sql = "SELECT * FROM `leave_types` WHERE `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetleavetypeInfo(){
        $sql = "SELECT * FROM `leave_types` WHERE `status`='1' ORDER BY `type_id` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }   
   public function GetleavestrucInfo(){
        $sql = "SELECT * FROM `leavestructure` WHERE `isActive`='1' And `Active_status` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
     public  function get_match_leavetypes($id){
       $sql    = "SELECT type_id, name FROM leave_types WHERE isActive = 1 AND leavestrucid = $id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }  
     public  function get_leave_document_status($id){
       $sql    = "SELECT * FROM leave_types WHERE isActive = 1 AND type_id = '$id' AND document_status = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
      
    }  
    public function GetleavetypeInfoid($id){
        $sql = "SELECT * FROM `leave_types` WHERE `status`='1' AND `isActive`='1' AND `type_id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemassignLeaveType($emid,$id,$year){
        $sql = "SELECT `hour` FROM `assign_leave` WHERE `assign_leave`.`emp_id`='$emid' AND `type_id`='$id' AND `dateyear`='$year'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    //Get leave taken details
    public function EmpLeaveReport($emid,$id,$year){
        $sql = "SELECT `emp_leave`.*,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to` FROM  `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id`
             LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
            LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
            WHERE `emp_leave`.`em_id` = '$emid' AND YEAR(`emp_leave`.`start_date`) = '$year' AND `emp_leave`.`typeid` = '$id'  AND `employee`.`isActive` = '1'
        AND `thead_approve` = 'Approved'  AND `hr_approve` = 'Approved' ORDER BY  `emp_leave`.`id`  DESC ";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
    public function GetTotalDay($type){
        $sql = "SELECT * FROM `assign_leave` WHERE `assign_leave`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetemLeaveType($id,$year){
        $sql = "SELECT `assign_leave`.*,
        `leave_types`.`name`
        FROM `assign_leave`
        LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
        WHERE `assign_leave`.`emp_id`='$id' AND `dateyear`='$year'
        ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function GetEmLEaveReport($emid, $day, $year){

        if($emid == "all") {
        $sql = "SELECT `emp_leave`.*,
                (SELECT SUM(`leave_duration`) 
                    FROM emp_leave
                    WHERE  MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
                    `employee`.`first_name`,`last_name`,`em_code`,
                    `leave_types`.`name`,`leave_types`.`leavestrucid`
                   ,`leave_types`.`paidstatus`
                FROM `emp_leave`
                    LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
                    LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
                WHERE MONTH(start_date) = '$day' AND YEAR(start_date) = '$year' ORDER BY `start_date` ASC
         ";
    } else {

        $sql = "SELECT `emp_leave`.*, (SELECT SUM(`leave_duration`) 
       FROM emp_leave
       WHERE  `emp_leave`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
        `employee`.`first_name`,`last_name`,`em_code`, 
        `leave_types`.`name`,`leave_types`.`leavestrucid`
                   ,`leave_types`.`paidstatus`
        FROM `emp_leave`
        LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
        LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
        WHERE `emp_leave`.`em_id` = '$emid' AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year' AND  `emp_leave`.`leave_status` = 'Approved' ORDER BY `start_date` ASC
       ";

        
    }
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result; 
}

    public function GetBusunitLeave($busid, $day, $year){

         $sql = "SELECT `emp_leave`.*, (SELECT SUM(`leave_duration`) 
       FROM emp_leave
       WHERE MONTH(start_date) = '$day' AND YEAR(start_date) = '$year') AS `total_duration`,
        `employee`.`first_name`,`last_name`,`em_code`, 
        `leave_types`.`name`,`leave_types`.`leavestrucid`
                   ,`leave_types`.`paidstatus`
        FROM `emp_leave`
        LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
        LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
        WHERE `employee`.busunit = $busid AND MONTH(start_date) = '$day' AND YEAR(start_date) = '$year' And `emp_leave`.`leave_status` = 'Approved' ORDER BY `start_date` ASC";
          $query = $this->db->query($sql);
            $result = $query->result();
            return $result; 
    }
    public function GetLeaveToday($date){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
        WHERE `apply_date`='$date'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function GetLeaveApply($id){
        $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
       `leave_types`.`type_id`,`name`,`paidstatus`,`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id` 
       LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
     LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
      WHERE `emp_leave`.`id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetEarnedleaveBalance(){
        $sql = "SELECT `earned_leave`.*, `employee`.`first_name`,`last_name`,`em_code` FROM `earned_leave` LEFT JOIN `employee` ON `earned_leave`.`em_id`=`employee`.`em_id` WHERE `earned_leave`.`hour` > 0 AND `employee`.`status`='ACTIVE'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    public function emEarnselectByLeave($emid){
        $sql = "SELECT * FROM `earned_leave` WHERE `em_id`='$emid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }
    public function GetallApplication($emid){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`,`paidstatus`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      WHERE `emp_leave`.`em_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function AllLeaveAPPlication(){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id` 
      WHERE `thead_approve` = 'Pending' AND `hr_approve` = 'Pending'  order by  `emp_leave`.`id`  desc ";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }  
/*    public function AllLeaveAPPlication(){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
      WHERE `emp_leave`.`leave_status`='Pending'";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 
    } */   
    public function EmpLeaveAPPlication($id){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
      WHERE `emp_leave`.`leave_status`='Pending' AND  (`thead_approve` = 'Pending' OR `hr_approve` = 'Pending')  AND `emp_leave`.`em_id`='$id' order by  `emp_leave`.`id`  desc";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 
    }  
    public function Leavelist(){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id` order by start_date desc
     ";

        $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 
    }   
     public function EmpLeavelist($id){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id` where   `emp_leave`.`em_id`='$id' order by start_date desc
     ";

        $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
    
    /*  $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
      WHERE `emp_leave`.`leave_status`='Approved'";*/

    public function EmLeavesheet($emid){
    $sql = "SELECT `assign_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`
      FROM `assign_leave`
      LEFT JOIN `employee` ON `assign_leave`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
      WHERE `assign_leave`.`emp_id`='$emid'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result; 
    }
    public function Update_Holidaystruc($id,$data){
		$this->db->where('id', $id);
		return $this->db->update('holidaystructure',$data);         
    } 
     public function Update_Leavestruc($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('leavestructure',$data);         
    } 
    public function Update_HolidayInfo($id,$data1){
        $this->db->where('id', $id);
        return $this->db->update('holiday',$data1);         
    }

    public function Update_leave_Info($id,$data){
		$this->db->where('type_id', $id);
		return $this->db->update('leave_types',$data);         
    }
    public function Assign_Duration_Update($type,$data){
        $this->db->where('type_id', $type);
        return $this->db->update('assign_leave', $data);         
    }
    public function DeletHoliday($id){
       return $this->db->delete('holiday',array('id'=> $id));        
    }
    public function DeletType($id){
        return $this->db->delete('leave_types',array('type_id'=> $id));        
    }
    public function DeletApply($id){
        return $this->db->delete('emp_leave',array('id'=> $id));        
    }




    public function updateAplicationAsResolved($id, $data){
        $this->db->where('id', $id);
       return $this->db->update('emp_leave', $data);         
    }  

    public function getLeaveTypeTotal($emid, $type){
        $sql = "SELECT SUM(`hour`) AS 'totalTaken' FROM `assign_leave` WHERE `assign_leave`.`emp_id`='$emid' AND `assign_leave`.`type_id`='$type'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function updateLeaveAssignedInfo($employeeID, $type, $data){
        
        $this->db->where('type_id', $type);
        $this->db->where('emp_id', $employeeID);
        return $this->db->update('assign_leave', $data);         
    }

    public function UpdteEarnValue($emid,$data){
        $this->db->where('em_id', $emid);
       return $this->db->update('earned_leave', $data);         
    }


    public function insertLeaveAssignedInfo($data){
       return $this->db->insert('assign_leave', $data);
    }

    public function determineIfNewLeaveAssign($employeeId, $type){
         $sql = "SELECT * FROM `assign_leave` WHERE `assign_leave`.`emp_id` = '$employeeId' AND `assign_leave`.`type_id` = '$type'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function get_holiday_between_dates($day) {
        $sql = "SELECT * FROM `holiday` WHERE ('$day' = `holiday`.`from_date`) OR ('$day' BETWEEN `holiday`.`from_date` AND `holiday`.`to_date`)";
        $query = $this->db->query($sql);
        return $query->row();
    }
      public function Inactive_holystructure($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('holidaystructure',$data);  
                  
     } 
     public function active_holystructure($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('holidaystructure',$data);  
                  
     }    
     public function Inactive_leavestructure($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('leavestructure',$data);  
                  
     } 
     public function active_leavestructure($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('leavestructure',$data);  
                  
     }
     public function HolidayDelete($id){
      $data =  array( 'isActive' => 0);
     $this->db->where('id', $id);
    return $this->db->update('holiday',$data); 
    }
     //structure delete
    public function HolidayStrucDelete($id){
      $this->db->delete('holiday',array('structureid'=> $id));
      return $this->db->delete('holidaystructure',array('id'=> $id));
    }
    public function LeaveDelete($id){
      $data =  array( 'isActive' => 0);
     $this->db->where('type_id', $id);
    return $this->db->update('leave_types',$data); 
    }  
    //structure delete
    public function LeaveStrucDelete($id){
      $this->db->delete('leave_types',array('leavestrucid'=> $id));
      return $this->db->delete('leavestructure',array('id'=> $id));
    }
    public function holidayreport($date,$structureid){
     $sql = "SELECT holiday .*,structureid ,SUM(`holiday`.`number_of_days`) AS total_count,DATE_FORMAT(from_date,'%m-%Y') AS MONTH FROM holiday WHERE  DATE_FORMAT(from_date,'%m-%Y')  = '$date' AND `isActive` = 1 AND structureid = '$structureid'";
    $query = $this->db->query($sql);
    //return $query->num_rows();
     $result = $query->row();
        return $result;
     }   
     public function getholidayreport($date,$structureid){
     $sql = "SELECT holiday .*,structureid ,DATE_FORMAT(from_date,'%m-%Y') AS MONTH FROM holiday WHERE  DATE_FORMAT(from_date,'%m-%Y')  = '$date' AND `isActive` = 1 AND structureid = '$structureid'";
    $query = $this->db->query($sql);
    //return $query->num_rows();
     $result = $query->result();
        return $result;
     }  
   /*  public function holidayreport($date,$structureid){
     $sql = "SELECT holiday .*,structureid,CONCAT( MONTH(`from_date`),'-',YEAR(`from_date`)) AS MONTH FROM holiday WHERE  CONCAT( MONTH(`from_date`),'-',YEAR(`from_date`))  = '$date' AND `isActive` = 1 AND structureid = '$structureid'";
    $query = $this->db->query($sql);
    //return $query->num_rows();
     $result = $query->result();
        return $result;
     }*/
     public function holidayreportdata($date){
     $sql = "SELECT structureid,CONCAT( MONTH(`from_date`),'-',YEAR(`from_date`)) AS MONTH FROM holiday WHERE  CONCAT( MONTH(`from_date`),'-',YEAR(`from_date`))  = '$date' AND `isActive` = 1";
        $query = $this->db->query($sql);
        return $query->num_rows();
     }
     public function GetBusunit($busid){
          $sql = "SELECT * FROM `businessunit` WHERE `id` = '$busid'";
        $query = $this->db->query($sql);
        return $query->row();
     }
      public function GetLeavestru($leave_struid){
          $sql = "SELECT * FROM `leavestructure` WHERE `id` = '$leave_struid'";
        $query = $this->db->query($sql);
        return $query->row();
     }
     //team head
     public function Leaveapply_thead($eid){

        $sql = "SELECT `emp_leave`.*,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`,`org_department`.`id`,`org_department`.`depname`,`org_department`.`busunit_id`,`org_department`.`depcode`,`org_department`.`dephead_id`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure` FROM `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id`  LEFT JOIN `org_department` ON `employee`.`dep_id` =  `org_department`.`id`  LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id` LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`  WHERE `org_department`.`dephead_id` = '$eid'  AND `employee`.`isActive` = '1' AND `org_department`.`isActive` = '1'
               AND `thead_approve` = 'Pending' AND `hr_approve` = 'Pending' AND `org_department`.`Active_status` = '1' order by  `emp_leave`.`id`  desc ";
        $query = $this->db->query($sql);
        return $query->result();
     }    
    ///Reporting manager
      public function Leaveapply_Reporting($eid){

        $sql = "SELECT `emp_leave`.*,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`,`org_department`.`id`,`org_department`.`depname`,`org_department`.`busunit_id`,`org_department`.`depcode`,`org_department`.`dephead_id`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to`,`emp_leave`.`id` AS leaveid  FROM 
            `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id` 
             LEFT JOIN `org_department` ON `employee`.`dep_id` =  `org_department`.`id` 
              LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id` 
              LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id` 
              WHERE `employee`.`report_to` = '$eid'  AND `employee`.`isActive` = '1' AND `org_department`.`isActive` = '1'
              AND `thead_approve` = 'Pending' AND `hr_approve` = 'Pending' AND `org_department`.`Active_status` = '1' order by  `emp_leave`.`id`  desc";
        $query = $this->db->query($sql);
        return $query->result();
     } 
      ///Reporting manager employee list
      public function Leaveapply_Reporting_list($eid){

        $sql = "SELECT `emp_leave`.*,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`,`org_department`.`id`,`org_department`.`depname`,`org_department`.`busunit_id`,`org_department`.`depcode`,`org_department`.`dephead_id`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to`,`emp_leave`.`id` AS leaveid  FROM 
            `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id` 
             LEFT JOIN `org_department` ON `employee`.`dep_id` =  `org_department`.`id` 
              LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id` 
              LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id` 
              WHERE `employee`.`report_to` = '$eid'  AND `employee`.`isActive` = '1' AND `org_department`.`isActive` = '1'
              AND `org_department`.`Active_status` = '1' order by  `emp_leave`.`id`  desc";
        $query = $this->db->query($sql);/* AND `thead_approve` = 'Pending' AND `hr_approve` = 'Pending'*/
        return $query->result();
     }   

    public function updateLeave($id, $data){
        $this->db->where('id', $id);
       return $this->db->update('emp_leave', $data);         
    }  
    //Hr leave Approval
    public function Leaveapply_hr($eid){
        $sql = "SELECT `emp_leave`.*,`businessunit`.`hr`,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to`,`emp_leave`.`id` AS `leaveid` FROM
        `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id`
        LEFT JOIN `businessunit` ON `employee`.`busunit` =  `businessunit`.`id`
        LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
        LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
        WHERE `businessunit`.`hr` = '$eid'  AND `employee`.`isActive` = '1'
        AND `thead_approve` = 'Approved' AND `hr_approve` = 'Pending' order by  `emp_leave`.`id`  desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //Hr page employee leave list
    public function Leavelist_hr($eid){
        $sql = "SELECT `emp_leave`.*,`businessunit`.`hr`,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to`,`emp_leave`.`id` AS `leaveid` FROM
        `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id`
        LEFT JOIN `businessunit` ON `employee`.`busunit` =  `businessunit`.`id`
        LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
        LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
        WHERE `businessunit`.`hr` = '$eid'  AND `employee`.`isActive` = '1'
        AND `thead_approve` = 'Approved' order by start_date desc ";/*AND `hr_approve` = 'Pending'*/
        $query = $this->db->query($sql);
        return $query->result();
    }
     public function GetReportEmp($id){
    $sql = "SELECT * FROM `employee`  WHERE `em_id` = '$id'
      AND `isActive` = 1 AND `user_status` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    }  
     public function Get_to_address($userid){
    $sql = "SELECT * FROM `employee`  WHERE `em_id` = '$userid'
      AND `isActive` = 1 AND `user_status` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    } 
    public function Get_emp_address($theadid){
    $sql = "SELECT * FROM `employee`  WHERE `em_id` = '$theadid'
      AND `isActive` = 1 AND `user_status` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    }  
    public function Get_businessunit($userid){
    $sql = "SELECT * FROM `businessunit`  WHERE `id` = '$userid'
      AND `isActive` = 1 ";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    } 
     public function Get_hr_address($hrid){
    $sql = "SELECT * FROM `employee`  WHERE `em_id` = '$hrid'
      AND `isActive` = 1 AND `user_status` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    }     
     public function Check_Teamhead($eid){
    $sql = "SELECT * FROM `employee` WHERE `report_to` = '$eid' AND `isActive` = 1 AND `user_status` = 1 ";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    } 
    }
?>    