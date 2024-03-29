<?php

	class Timesheet_modal extends CI_Model{

	    public function MonthlyTimesheetdata(){
        //$sql = "SELECT * FROM `monthlytimesheet` where `isActive` = 1";
        $sql = "SELECT `monthlytimesheet`.*,
	      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
	      FROM `monthlytimesheet`
	      LEFT JOIN `employee` ON `monthlytimesheet`.`emp_id`=`employee`.`em_id` where   `monthlytimesheet`.`isActive` = 1  ORDER BY `monthlytimesheet`.`month` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
       }    
       public function EmpMonthlyTimesheet($id){
       
        $sql = "SELECT `monthlytimesheet`.*,
        `employee`.`em_id`,`first_name`,`last_name`,`em_code`
        FROM `monthlytimesheet`
        LEFT JOIN `employee` ON `monthlytimesheet`.`emp_id`=`employee`.`em_id` WHERE   `monthlytimesheet`.`emp_id` = '$id' AND `monthlytimesheet`.`isActive` = 1  ORDER BY `monthlytimesheet`.`id` DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
       }    

        public function DailyTimesheetdata(){
        $sql = "SELECT * FROM `dailytimesheet` where `isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
       }

        public function Add_Monthtimesheet($data){
        return $this->db->insert('monthlytimesheet',$data);
       }
        public function Update_Monthtimesheet($id,$data){
		$this->db->where('id', $id);
		return $this->db->update('monthlytimesheet',$data);         
        }  
        public function Monthtimesheetvalue($id){
		$sql = "SELECT * FROM `monthlytimesheet` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;         
        } 
        //daily
         public function DailyTimesheetview($id){
        //$sql = "SELECT * FROM `monthlytimesheet` where `isActive` = 1";
        $sql = "SELECT `dailytimesheet`.*,
	      `employee`.`em_id`,`first_name`,`last_name`,`em_code`
	      FROM `dailytimesheet`
	      LEFT JOIN `employee` ON `dailytimesheet`.`emp_id`=`employee`.`em_id` where   `dailytimesheet`.`isActive` = 1 AND `month_id` = '$id' ORDER BY `dailytimesheet`.`id` DESC ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
       }
         public function Add_DailyTimesheet($data1){
        return $this->db->insert('dailytimesheet',$data1);
       }
        public function Update_DailyTimesheet($id,$data1){
		$this->db->where('id', $id);
		return $this->db->update('dailytimesheet',$data1);         
        }
          public function DailyTimesheetvalue($id){
		$sql = "SELECT * FROM `dailytimesheet` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;         
        }  

        //time sheet details
     /*    public function Get_timesheet($emid){
	      $sql = "SELECT * FROM `timesheet_details` LEFT JOIN `timesheet_master` ON `timesheet_master`.`id` = `timesheet_details` .`punchname`  WHERE `emp_id` = '$emid'  AND `timesheet_master`.`isActive` = 1 AND `timesheet_details`.`isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;        
        } //AND `daily_id` = '$daily_id'*/

         public function Get_timesheet($emid,$startdate){ //LEFT JOIN `timesheet_master` ON `timesheet_master`.`id` = `timesheet_details` .`punchname`
        $sql = "SELECT *,`timesheet_details` .`id` as details_id FROM `timesheet_details`   WHERE `emp_id` = '$emid' AND  `startdate` = '$startdate'  AND  `timesheet_details`.`isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;        
        } //AND `daily_id` = '$daily_id'

        //calenter event  
     /*    public function Get_timesheet_event($emid,$month){
        $sql = "SELECT * FROM `timesheet_details` LEFT JOIN `timesheet_master` ON `timesheet_master`.`id` = `timesheet_details` .`punchname`  WHERE `emp_id` = '$emid'  AND `timesheet_master`.`isActive` = 1 AND `timesheet_details`.`isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;        
        }  */
         public function Get_timesheet_event($emid,$month){
        $sql = "SELECT id,emp_id,IF(login, CONCAT('Login ', login), '') AS login, IF(breakin, CONCAT('BreakIn ', breakin), '') AS breakin, IF(breakout, CONCAT('BreakOut ', breakout), '') AS breakout, IF(logout, CONCAT('Logout ', logout), '') AS logout,startdate FROM `timesheet_details`  WHERE `emp_id` = '$emid'  AND `timesheet_details`.`isActive` = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;        
        } 
      // public function Get_timesheet_event($emid,$month){
      //   $sql = "SELECT id,emp_id,CONCAT('Login ', login) AS login,CONCAT('BreakIn ', breakin) AS breakin,CONCAT('BreakOut ', breakout) AS breakout, CONCAT('Logout ', logout) AS logout,startdate FROM `timesheet_details`  WHERE `emp_id` = '$emid'  AND `timesheet_details`.`isActive` = 1";
      //   $query = $this->db->query($sql);
      //   $result = $query->result();
      //   return $result;        
      //   } 
    

	    public function Add_Timedetails($data){
	        return $this->db->insert('timesheet_details', $data);
	    }  

	    public function deletetimesheetdetails($id){
	    
	     /* $sql    = "UPDATE `timesheet_details` SET isActive=0 WHERE `id`='$id'";
	      $query  = $this->db->query($sql);
	      return $query;*/
         return $this->db->delete('timesheet_details',array('id'=> $id));
	      
	    }
      //report
      public function getTimesheetDataByMonth($eid,$month){
      $sql = " SELECT `monthlytimesheet`.`id`, 
      `monthlytimesheet`.`emp_id`,`monthlytimesheet`.`month`,`monthlytimesheet`.`isActive`, `employee`.`first_name`,`employee`.`last_name`,`employee`.`em_code`
      FROM `monthlytimesheet`
      LEFT JOIN `employee` ON `monthlytimesheet`.`emp_id`=`employee`.`em_id`
     
      WHERE `monthlytimesheet`.`emp_id` = '$eid' AND `monthlytimesheet`.`month` = '$month' AND `monthlytimesheet`.`isActive` = 1 ";
        $query=$this->db->query($sql);
       $result = $query->row();
       return $result;        
     }
     //excel
 /*   public function getTimesheetExcel($eid,$month){
      $sql = "SELECT `dailytimesheet`.`id`,`dailytimesheet`.`emp_id`,`dailytimesheet`.`date`,`dailytimesheet`.`isActive`,`timesheet_details`.`id`,`timesheet_details`.`emp_id`,`timesheet_details`.`daily_id`,
      `timesheet_details`.`punchname`,`timesheet_details`.`punchtime`,`timesheet_details`.`punchdescription` FROM `dailytimesheet` LEFT JOIN `timesheet_details` ON `dailytimesheet`.`id`=`timesheet_details`.`daily_id`  WHERE `dailytimesheet`.`emp_id` = '$eid' AND `dailytimesheet`.`timesheetmonth` = '$month' AND `dailytimesheet`.`isActive` = 1
       AND `timesheet_details`.`isActive` = 1";
        $query=$this->db->query($sql);
       $result = $query->result();
       return $result;        
    }  */ 
    public function getTimesheetExcel($eid,$month){
      $sql = "  SELECT * FROM `monthlytimesheet` LEFT JOIN `timesheet_details`ON `monthlytimesheet`.id = `timesheet_details`.`month_id`  WHERE `timesheet_details`.`emp_id` = '$eid' AND `timesheet_details`.`month` = '$month' AND `timesheet_details`.`isActive` = 1 AND `monthlytimesheet`.`isActive` = 1";
        $query=$this->db->query($sql);
       $result = $query->result();
       return $result;        
    }   
    //punch in details
    /* public function getTimesheetPunch($eid,$month,$punch){
      $sql = "SELECT `dailytimesheet`.`id`,`dailytimesheet`.`emp_id`,`dailytimesheet`.`date`,`dailytimesheet`.`isActive`,`timesheet_details`.`id`,`timesheet_details`.`emp_id`,`timesheet_details`.`daily_id`,
      `timesheet_details`.`punchname`,`timesheet_details`.`punchtime`,`timesheet_details`.`punchdescription`,`timesheet_master`.`typename` FROM `dailytimesheet` LEFT JOIN `timesheet_details` ON `dailytimesheet`.`id`=`timesheet_details`.`daily_id` LEFT JOIN `timesheet_master` ON `timesheet_details`.`punchname` = `timesheet_master`.`id` WHERE `dailytimesheet`.`emp_id` = '$eid' AND `dailytimesheet`.`timesheetmonth` = '$month' AND `timesheet_details`.`punchname` = '$punch' AND `dailytimesheet`.`isActive` = 1 AND `timesheet_master`.`isActive` = 1
       AND `timesheet_details`.`isActive` = 1";
        $query=$this->db->query($sql);
       $result = $query->result();
       return $result;        
    } */ 
    public function getTimesheetPunch($eid,$month,$punch){
      $sql = "SELECT * FROM `monthlytimesheet` LEFT JOIN `timesheet_details`ON `monthlytimesheet`.id = `timesheet_details`.`month_id`  WHERE `monthlytimesheet`.`emp_id` = '$eid' AND `timesheet_details`.`month` = '$month'  AND `timesheet_details`.`punchname` = '$punch' AND `timesheet_details`.`isActive` = 1 AND `monthlytimesheet`.`isActive` = 1 ORDER BY startdate ASC";
        $query=$this->db->query($sql); 
       $result = $query->result();
       return $result;        
    }      
    public function getTimesheetData($eid,$month){
      $sql = "SELECT * FROM `monthlytimesheet` LEFT JOIN `timesheet_details`ON `monthlytimesheet`.id = `timesheet_details`.`month_id`  WHERE `timesheet_details`.`emp_id` = '$eid' AND `timesheet_details`.`month` = '$month'   AND `timesheet_details`.`isActive` = 1 AND `monthlytimesheet`.`isActive` = 1 ORDER BY startdate ASC";
        $query=$this->db->query($sql); 
       $result = $query->result();
       return $result;        
    }  
/*      public function getTimesheetPunch($eid,$month,$punch){
      $sql = "SELECT `dailytimesheet`.`id`,`dailytimesheet`.`emp_id`,`dailytimesheet`.`date`,`dailytimesheet`.`isActive`,`timesheet_details`.`id`,`timesheet_details`.`emp_id`,`timesheet_details`.`daily_id`,
      `timesheet_details`.`punchname`,`timesheet_details`.`punchtime`,`timesheet_details`.`punchdescription`,`timesheet_master`.`typename` FROM `dailytimesheet` LEFT JOIN `timesheet_details` ON `dailytimesheet`.`id`=`timesheet_details`.`daily_id` LEFT JOIN `timesheet_master` ON `timesheet_details`.`punchname` = `timesheet_master`.`id` WHERE `dailytimesheet`.`emp_id` = '$eid' AND `dailytimesheet`.`timesheetmonth` = '$month' AND `timesheet_details`.`punchname` = '$punch' AND `dailytimesheet`.`isActive` = 1 AND `timesheet_master`.`isActive` = 1
       AND `timesheet_details`.`isActive` = 1";
        $query=$this->db->query($sql);
       $result = $query->result();
       return $result;        
    }*/

     public function getempvalue($eid){
      $sql = " SELECT em_id,first_name,last_name FROM employee WHERE `em_id` = '$eid' AND `isActive` = 1 ";
        $query=$this->db->query($sql);
       $result = $query->row();
       return $result;        
    } 

 //master
 //country 
    public function timemasterselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('timesheet_master');
      $result = $query->result();
      return $result;
    }  


     public function punchid($punch){
      $this->db->where(array ('typename'=>$punch,'isActive'=> 1));//
      $query = $this->db->get('timesheet_master');
      $result = $query->row();
      return $result;
    } 
  

     public function timemaster_edit($dep){

      $sql    = "SELECT * FROM `timesheet_master` WHERE `id`='$dep'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

 
     public function Add_timemaster($data){
     $query =  $this->db->insert('timesheet_master',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }  

    public function timemaster_delete($id){
      
      $sql    = "UPDATE `timesheet_master` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
     
    }
    public function Update_timemaster($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('timesheet_master',$data);
    }
    public function get_checkin($punch){
       $sql    = "SELECT * FROM `timesheet_master` WHERE `id`='$dep'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

/*    //calenter leave event  
     public function timesheet_leave_event($emid,$month){
    $sql = "SELECT * FROM `timesheet_details`   WHERE `emp_id` = '$emid'   AND `timesheet_details`.`isActive` = 1 AND punchtime = '' AND punchname = '' ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;        
    } */
    //calenter leave event  new
     public function timesheet_leave_event($emid,$month){

   $sql = "SELECT * FROM `emp_leave` LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id` WHERE `em_id` = '$emid'  AND `leave_status` =  'Approved' ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;        
    }  

     public function month_leave_event($emid,$month){

   $sql = "SELECT * FROM `emp_leave` LEFT JOIN `leave_types` ON `emp_leave`.`typeid`=`leave_types`.`type_id` WHERE DATE_FORMAT(start_date, '%m-%Y') = '$month' AND `em_id` = '$emid'  AND `leave_status` =  'Approved' ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;        
    }

    //timesheet leave delete
    public function TimsheetLeaveDelete($id){
      $data =  array( 'isActive' => 0);
      $this->db->where('id', $id);
    return $this->db->update('timesheet_details',$data); 
    }

    //import
/*    public function insert($data) {
    

    $res = $this->db->insert_batch('timesheet_details',$data);
    if($res){
    return TRUE;
    }else{
    return FALSE;
    }
    } */  
     /*public function insert($data) {
    

  $insert_data = array();
  foreach ($data as $row) {
      // Check if data already exists in the database
      $existing_data = $this->db->get_where('timesheet_details', array('emp_id' => $row['emp_id'],'startdate'=> $row['startdate']))->row_array();
      if (empty($existing_data)) {
          // Add row to insert data array
          $insert_data[] = $row;
      }
  }

  // Insert non-duplicate data into the database
  //print_r($insert_data);
  if (!empty($insert_data)) {
    $res = $this->db->insert_batch('timesheet_details',$data);
    if($res){
    return TRUE;
    }else{
    return FALSE;
    }
  } else{
    return FALSE;
  }
      }*/
   
   public function insert($inserdata){

    // foreach ($inserdata as $key => $value) {
    //    $existing_data = $this->db->get_where('timesheet_details', array('emp_id' => $value['emp_id'],'startdate'=> $value['startdate']))->num_rows();
    //    if($existing_data == 0){
    //      //echo $value['startdate'].'<br>';
    //     // echo $value['emp_id'].'<br>';
    //          $data = array(
    //                 'emp_id' => $value['emp_id'],
    //                 'login' => $value['login'],
    //                 'logout' => $value['logout'],
    //                 'breakin' => $value['breakin'],
    //                 'breakout' => $value['breakout'],
    //                 'month_id' => $value['month_id'],
                   
    //                 'startdate' =>$value['startdate']
                    
    //             );
    //        echo '<pre>';
    //          print_r($data);

    //    return  $this->db->insert('timesheet_details',$data); 
    //    }
     
    // }
    // echo '<pre>';
    //      print_r($inserdata); die();
    foreach ($inserdata as $key => $value) {
   $existing_data = $this->db->get_where('timesheet_details', array('emp_id' => $value['emp_id'],'startdate'=> $value['startdate']))->num_rows();
   if($existing_data == 0){
         $data = array(
                'emp_id' => $value['emp_id'],
                'login' => $value['login'],
                'logout' => $value['logout'],
                'breakin' => $value['breakin'],
                'breakout' => $value['breakout'],
                'month_id' => $value['month_id'],                   
                'month' => $value['month'],                   
                'startdate' =>$value['startdate'],                    
                'punchdescription' =>($value['punchdescription'])? $value['punchdescription'] : ''                    
            );
         echo '<pre>';
         //print_r($data);
         $this->db->insert('timesheet_details',$data); 
   }     
   }
    return true;
 
   }
     public function Monthlytimesheetdelete($id,$month, $emp)
    {
      $this->db->delete('timesheet_details',array('month'=> $month,'emp_id'=> $emp)); 
      //$this->db->delete('timesheet_details',array('month_id'=> $id));
      return $this->db->delete('monthlytimesheet',array('id'=> $id));
    }

      public function Get_employee_event_month($eid,$month){
    $sql = "SELECT  `assign_holidays`.*,first_name,last_name,DATE_FORMAT(`date` ,'%m-%Y') FROM `assign_holidays`  LEFT JOIN `employee` ON `assign_holidays`.`emp_id`=`employee`.`em_id`  WHERE DATE_FORMAT(`date` ,'%m-%Y') = '$month'  AND `assign_holidays`.`emp_id` = '$eid'   AND `assign_holidays`.`isActive` = '1'";
      $query  = $this->db->query($sql);
      $result = $query->result();
  
      return $result;
    } 
     // get busniess unit from employee
      public function Get_employee_busunit($emid){
      $this->db->select('busunit');
      $this->db->from('employee');
      $this->db->where(array('isActive' => 1, 'user_status' => 1, 'em_id' => $emid));
      $query = $this->db->get();
      $result = $query->row();
      return $result;
      }   
      //get holiday structure id from busness unit
        public function Get_employee_holidaystruc($busid){
      $this->db->select('holidaystructureid');
      $this->db->from('businessunit');
      $this->db->where(array('isActive' => 1,'id' => $busid));
      $query = $this->db->get();
      $result = $query->row();
      return $result;
      } 


	}

