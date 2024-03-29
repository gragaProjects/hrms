<?php

	class Dashboard_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
    public function insert_tododata($data){
        $this->db->insert('to-do_list',$data);
    }
    public function GettodoInfo($userid){
        $sql = "SELECT * FROM `to-do_list` WHERE `user_id`='$userid' ORDER BY `date` DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetRunningProject(){//array('pro_status'=>'running','isActive'=>'1')
        $sql = "SELECT * FROM `project` WHERE `pro_status`='running' And `isActive` = 1 ORDER BY `id` DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetHolidayInfo($sid){
        $sql = "SELECT * FROM `holiday` WHERE `isActive` = 1 AND `structureid` = $sid AND from_date>=DATE_FORMAT(NOW() ,'%Y-%m-%d')  AND MONTH(from_date) = MONTH(CURDATE())";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }  
     public function GethrHolidayInfo($sid){
        $sql = "SELECT * FROM `holiday` WHERE `isActive` = 1 AND `structureid` = $sid AND from_date>=DATE_FORMAT(NOW() ,'%Y-%m-%d')  AND MONTH(from_date) = MONTH(CURDATE())";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }  //holidaystructure
       public function GetHolidays(){
        // $sql = "SELECT * FROM `holiday`  LEFT JOIN `holidaystructure` ON `holiday`.`structureid`=`holidaystructure`.`id` WHERE   `holidaystructure`.`isActive` = 1 AND  `holiday`.`isActive` = 1 AND  from_date>=DATE_FORMAT(NOW() ,'%Y-%m-%d')  AND MONTH(from_date) = MONTH(CURDATE())";

        $sql = "SELECT * FROM `holiday`
                LEFT JOIN `holidaystructure` ON `holiday`.`structureid` = `holidaystructure`.`id`
                WHERE `holidaystructure`.`isActive` = 1 
                  AND `holiday`.`isActive` = 1 
                  AND YEAR(from_date) = YEAR(CURDATE()) 
                  AND MONTH(from_date) = MONTH(CURDATE())
                  AND from_date >= CURDATE()";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }    
    // public function GetHolidaysbyid($id){
    //     $sql = "SELECT * FROM `holiday`  LEFT JOIN `holidaystructure` ON `holiday`.`structureid`=`holidaystructure`.`id` WHERE  `structureid` = $id AND  `holidaystructure`.`isActive` = 1 AND  `holiday`.`isActive` = 1 AND  from_date>=DATE_FORMAT(NOW() ,'%Y-%m-%d')  AND MONTH(from_date) = MONTH(CURDATE())";
    //     $query=$this->db->query($sql);
    //     $result = $query->result();
    //     return $result;
    // }  
    public function GetHolidaysbyid($id) {
    // $sql = "SELECT * FROM `holiday`
    //         LEFT JOIN `holidaystructure` ON `holiday`.`structureid` = `holidaystructure`.`id`
    //         WHERE `structureid` = ? AND `holidaystructure`.`isActive` = 1
    //         AND `holiday`.`isActive` = 1 AND from_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')
    //         AND MONTH(from_date) = MONTH(CURDATE())";

    $sql = "SELECT * FROM `holiday`
        LEFT JOIN `holidaystructure` ON `holiday`.`structureid` = `holidaystructure`.`id`
        WHERE `structureid` = ? AND `holidaystructure`.`isActive` = 1
        AND `holiday`.`isActive` = 1 
        AND YEAR(from_date) = YEAR(CURDATE()) 
        AND MONTH(from_date) = MONTH(CURDATE())";

    $query = $this->db->query($sql, array($id));
    $result = $query->result();
    return $result;
}

	public function UpdateTododata($id,$data){
		$this->db->where('id', $id);
		$this->db->update('to-do_list',$data);		
	} 
  public function GetLeaveInfo($lid){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
      WHERE `emp_leave`.`leave_status`='Approved' AND `emp_leave`.`thead_approve`='Approved' AND `emp_leave`.`hr_approve`='Approved'  AND `emp_leave`.`leavestrucid` = '$lid'  AND  WEEK(start_date)=WEEK(NOW())
       ";/*`emp_leave`.`apply_date`> NOW() - INTERVAL 1 WEEK*/
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 
    }  
    /*Admin*/
    public function GetLeavedata(){
    $sql = "SELECT `emp_leave`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
      `leave_types`.`type_id`,`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
      FROM `emp_leave`
      LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
      LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
      LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
      WHERE `emp_leave`.`leave_status`='Approved' AND `emp_leave`.`thead_approve`='Approved' AND `emp_leave`.`hr_approve`='Approved'  AND MONTH(start_date) = MONTH(CURDATE())";
      /*-- AND   WEEK(start_date)=WEEK(NOW())";"*/
       
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 
    }
       public function GetEmpLeaveInfo($lid,$id){
        $sql = "SELECT `emp_leave`.*,
          `employee`.`em_id`,`first_name`,`last_name`,`em_code`,
          `leave_types`.`type_id`,`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`
          FROM `emp_leave`
          LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`
          LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
          LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
          WHERE `emp_leave`.`leave_status`='Approved'  AND `emp_leave`.`thead_approve`='Approved' AND `emp_leave`.`hr_approve`='Approved'  AND `emp_leave`.`leavestrucid` = '$lid' AND `emp_leave`.`em_id`= '$id'  AND  WEEK(start_date)=WEEK(NOW())
           ";/*`emp_leave`.`apply_date`> NOW() - INTERVAL 1 WEEK*/
            $query=$this->db->query($sql);
            $result = $query->result();
            return $result; 
      }
    //check hr
    public function Emplist_hr($eid){
        $sql = "SELECT * FROM `businessunit`  WHERE `businessunit`.`hr` = '$eid' AND `isActive` = 1 AND `Active_status` = 1"; 
        $query = $this->db->query($sql);
        return $query->row();
     } 
     //check team head
     public function Emplist_teamhead($eid){
        $sql = "SELECT * FROM `employee`  WHERE `report_to` = '$eid' AND `isActive` = 1 AND `user_status` = 1"; 
        $query = $this->db->query($sql);
        return $query->result();
     }
        //Get Annual leave reminder based on joining date
        public function GetEmpAnnual_info($busid){
            $sql = "SELECT *, `employee`.`id` AS eid,DATE_FORMAT(DATE_ADD(em_joining_date, INTERVAL 11 MONTH), '%m-%Y') AS date_after_11_months, `designation`.*, `org_department`.*, `prefix`.* FROM `employee` LEFT JOIN `designation` ON `employee`.`des_id`=`designation`.`id` LEFT JOIN `org_department` ON `employee`.`dep_id`=`org_department`.`id` LEFT JOIN `prefix` ON `employee`.`pre_id`=`prefix`.`id` WHERE DATE_FORMAT(DATE_ADD(em_joining_date, INTERVAL 10 MONTH), '%d-%m-%Y') = DATE_FORMAT(CURDATE(), '%d-%m-%Y')  AND `employee`.`isActive` = '1'  AND `employee`.`user_status` = '1' AND `busunit` = '$busid'";

                $query=$this->db->query($sql);
                $result = $query->result();
                return $result;
        }  
     //count pending hr leave
        public function GetPendingleave_hr($eid){
            $sql = "SELECT `emp_leave`.*,`businessunit`.`hr`,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to`,`emp_leave`.`id` AS `leaveid` FROM
        `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id`
        LEFT JOIN `businessunit` ON `employee`.`busunit` =  `businessunit`.`id`
        LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id`
        LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id`
        WHERE `businessunit`.`hr` = '$eid'  AND `thead_approve` = 'Approved'  AND `hr_approve` = 'Pending' AND `employee`.`isActive` = '1'";
         $query=$this->db->query($sql);
         $result = $query->num_rows();
          return $result;
        }  
    // 
        public function GetPendingleave_teamhead($eid){
            $sql = "SELECT `emp_leave`.*,`employee`.`em_id`,`employee`.`busunit`,`employee`.`dep_id`,`employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`,`org_department`.`id`,`org_department`.`depname`,`org_department`.`busunit_id`,`org_department`.`depcode`,`org_department`.`dephead_id`, `leave_types`.`paidstatus`, `leave_types`.`type_id`, `leave_types`.`name`,`emp_leave`.`leavestrucid`,`leavestructure`.`leavestructure`,`employee`.`report_to`,`emp_leave`.`id` AS leaveid  FROM 
            `emp_leave` LEFT JOIN `employee` ON `employee`.`em_id` =  `emp_leave`.`em_id` 
             LEFT JOIN `org_department` ON `employee`.`dep_id` =  `org_department`.`id` 
              LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id` 
              LEFT JOIN `leavestructure` ON `emp_leave`.`leavestrucid`=`leavestructure`.`id` 
              WHERE `employee`.`report_to` = '$eid'  AND `employee`.`isActive` = '1' AND `org_department`.`isActive` = '1'
              AND `thead_approve` = 'Pending' AND `hr_approve` = 'Pending' AND `org_department`.`Active_status` = '1' ORDER BY  `emp_leave`.`id`  DESC";
         $query=$this->db->query($sql);
         $result = $query->num_rows();
          return $result;
        }

        public function Pending_leave(){
            $sql = "SELECT `emp_leave`.*,
              `employee`.`em_id`,`first_name`,`last_name`,`em_code`
              FROM `emp_leave`
              LEFT JOIN `employee` ON `emp_leave`.`em_id`=`employee`.`em_id`

              WHERE `thead_approve` = 'Pending' AND `hr_approve` = 'Pending'  ORDER BY  `emp_leave`.`id`  DESC ";
             $query=$this->db->query($sql);

              return $query->num_rows();

        }
         public function getemp($id){
            $sql = "SELECT  * FROM `employee`  WHERE `em_id` = '$id'
              AND `isActive` = 1 AND `user_status` = 1";
              $query  = $this->db->query($sql);
              $result = $query->row();
          
              return $result;
              $sql = "SELECT * FROM `businessunit`  WHERE `businessunit`.`hr` = '$eid' AND `isActive` = 1 AND `Active_status` = 1"; 
        $query = $this->db->query($sql);
        return $query->row();
            }  
             public function get_businesscode($id){
            $sql = "SELECT * FROM `businessunit`
            WHERE `id` = $id AND `isActive`= 1";
            $query=$this->db->query($sql);
            $result = $query->row();
            return $result;          
           }


    // ------------------------------------------------ New Policy modal------------------------------- -->
    // public function checkPoliciesAccepted() {
    //     // Assuming you have a session variable storing user information
    //     $employeeId = $this->session->userdata('user_login_id');

    //     // Assuming you have a method to check if policies are accepted for the given user
    //     $accepted = $this->db->get_where('policies_accept', ['employee_id' => $employeeId, 'accepted_status' => 1])->num_rows() > 0;

    //     return $accepted ? 'accepted' : 'not_accepted';
    // }

public function checkPoliciesAccepted() {
    // Assuming you have a session variable storing user information
    $employeeId = $this->session->userdata('user_login_id');
    $busunit = $this->session->userdata('busunit');

    // Query to check if there are policies not accepted for the given user
    $query = $this->db->query("
        SELECT cp.*, cp.id AS policy_id
        FROM company_policies cp
        LEFT JOIN policies_accept ea ON cp.id = ea.policy_id AND ea.employee_id = ?
        WHERE ea.id IS NULL AND cp.busunit = ?
        LIMIT 1
    ", [$employeeId,$busunit]);

    // If there is a pending policy, return 'not_accepted' and information about the pending policy
    if ($query->num_rows() > 0) {
        return ['status' => 'not_accepted', 'pending_policy' => $query->row_array()];
    }

    // No pending policies, return 'accepted'
    return ['status' => 'accepted'];
}


public function updatePolicyAcceptance($policyId, $accepted) {
    // Assuming you have a session variable storing user information
    $employeeId = $this->session->userdata('user_login_id');
   
    // Check if there is already an entry for this policy and employee
    $existingEntry = $this->db->get_where('policies_accept', ['policy_id' => $policyId, 'employee_id' => $employeeId])->row_array();

    if ($existingEntry) {
        // Update the existing entry
        $this->db->where('id', $existingEntry['id']);
        $this->db->update('policies_accept', ['accepted_status' => $accepted]);
    } else {
        // Insert a new entry
        $this->db->insert('policies_accept', ['policy_id' => $policyId, 'employee_id' => $employeeId, 'accepted_status' => $accepted]);
    }
}
// Dashboard_model.php (Model)

public function getPolicies() {
    // Assuming you have a table named 'company_policies' with fields 'id', 'policy_title', 'policy_description', etc.
    $this->db->select('id,busunit, policy_title, policy_description,file');
    $this->db->where('busunit', $this->session->userdata('busunit'));
    $query = $this->db->get('company_policies');

    return $query->result_array();
}
public function getPolicyDetails($policyId) {
    // Assuming you have a table named 'company_policies' with fields 'id', 'policy_title', 'policy_description', 'file', etc.
    $this->db->select('policy_title, policy_description, file');

    $query = $this->db->get_where('company_policies', array('id' => $policyId));

    return $query->row_array();
}
    }
?>