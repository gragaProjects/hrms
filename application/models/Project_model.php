<?php

	class Project_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
    public function Add_ProjectData($data){
        return $this->db->insert('project', $data);
    }
    public function Add_Tasks($data){
      return $this->db->insert('pro_task', $data);
    }
    public function TaskDelete($id){
      $data =  array( 'isActive' => 0);
      $query['assign_task'] = $this->db->update('assign_task', $data, array('task_id' => $id));
      $query['pro_task'] = $this->db->update('pro_task', $data,array('id' => $id));
       return $query;

    } 
    public function Delete_Pro_Notes($id){
      $sql    = "UPDATE `pro_notes` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;

    } 
    public function Delete_Expenses($id){
      $sql    = "UPDATE `pro_expenses` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;

    }
    public function Add_Project_File($data){
      return $this->db->insert('project_file', $data);
    }
    public function Add_FieldData($data){
      return $this->db->insert('field_visit', $data);
    }
    public function Update_FieldData($id, $data){
        $this->db->where('id', $id);
        return  $this->db->update('field_visit', $data);
    }
    public function GetProjectsValue(){
        $sql = "SELECT * FROM `project` where `isActive` = 1";
        $query=$this->db->query($sql);
        $result = $query->result();
		return $result;          
    }   
     public function PendingProjectsValue(){
        $sql = "SELECT * FROM `project` where `pro_status` = 'Upcoming' AND `isActive` = 1";
        $query=$this->db->query($sql);
        $result = $query->result();
    return $result;          
    } 
    public function GetFilebyFid($id){
        $sql = "SELECT * FROM `project_file` WHERE `project_file`.`id`='$id'";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;          
    } 
    public function GetNotesValueId($id){
        $sql = "SELECT * FROM `pro_notes` WHERE `pro_notes`.`id`='$id'";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;          
    }    
    public function GetAssetsCategory(){
        $sql = "SELECT * FROM `assets_category`";
        $query=$this->db->query($sql);
        $result = $query->result();
		return $result;          
    } 
    public function GetprojectDetails($id){
        $sql = "SELECT * FROM `project` WHERE `id`='$id'";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;            
    } 
    public function GetLogisTicValue($id){
        $sql = "SELECT * FROM `logistic_assign` WHERE `ass_id`='$id'";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;            
    }
    public function update_ProjectData($id,$data){
        $this->db->where('id',$id);
        return  $this->db->update('project',$data);
    }
    public function Updated_Project_expenses($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('pro_expenses',$data);
    }
    public function Update_Tasks($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('pro_task',$data);
    }
    public function Update_Project_Notes($id,$data){
        $this->db->where('id',$id);
        return  $this->db->update('pro_notes',$data);
    }
    public function Update_members_Data($id,$data){
        $this->db->where('task_id',$id);
        return $this->db->update('assign_task',$data);
    }
    public function Update_Assets($id,$data){
        $this->db->where('ass_id',$id);
        return $this->db->update('assets',$data);
    }
    public function GetAllLogistice($id){
    $sql = "SELECT `logistic_assign`.*,
      `employee`.`em_id`,`first_name`,`last_name`,
      `assets`.`ass_name`
      FROM `logistic_assign`
      LEFT JOIN `employee` ON `logistic_assign`.`assign_id`=`employee`.`em_id`
      LEFT JOIN `assets` ON `logistic_assign`.`asset_id`=`assets`.`ass_id`
      WHERE `logistic_assign`.`project_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetTasksAllList($id){
    $sql = "SELECT `pro_task`.*,
      `project`.`pro_name`,
      `logistic_assign`.`log_qty`,`asset_id`
      FROM `pro_task`
      LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
      LEFT JOIN `logistic_assign` ON `pro_task`.`id`=`logistic_assign`.`task_id`
      WHERE `pro_task`.`pro_id`='$id' AND  `pro_task`.`isActive` = 1 ";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetTasksOfficeList($id){
    $sql = "SELECT `pro_task`.*,
    `assign_task`.`assign_user`,
      `employee`.`em_id`,`first_name`,`em_image`,
      `project`.`pro_name`
      FROM `pro_task`
      LEFT JOIN `assign_task` ON `pro_task`.`id`=`assign_task`.`task_id`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
      WHERE `pro_task`.`pro_id`='$id' AND `pro_task`.`task_type`='Office'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetTasksFiledList($id){
    $sql = "SELECT `pro_task`.*,
    `assign_task`.`assign_user`,
      `employee`.`em_id`,`first_name`,`em_image`,
      `project`.`pro_name`
      FROM `pro_task`
      LEFT JOIN `assign_task` ON `pro_task`.`id`=`assign_task`.`task_id`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
      WHERE `pro_task`.`pro_id`='$id' AND `pro_task`.`task_type`='Field'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetTasksBothList($id){
    $sql = "SELECT `pro_task`.*,
    `assign_task`.`assign_user`,
      `employee`.`em_id`,`first_name`,`em_image`,
      `project`.`pro_name`
      FROM `pro_task`
      LEFT JOIN `assign_task` ON `pro_task`.`id`=`assign_task`.`task_id`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
      WHERE `pro_task`.`pro_id`='$id' AND `pro_task`.`task_type`='Both'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetTasksValue($id){
     
    $sql = "SELECT `pro_task`.*,
    `assign_task`.`assign_user`,
      `employee`.`em_id`,`first_name`,`em_image`,`last_name`,
      `project`.`pro_name`
      FROM `pro_task`
      LEFT JOIN `assign_task` ON `pro_task`.`id`=`assign_task`.`task_id`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
      WHERE `pro_task`.`id`='$id'";
     
      

        $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
    }
    public function GetTeamheadValue($id){
      $sql = "SELECT `pro_task`.*,
      `assign_task`.`assign_user`,
        `employee`.`em_id`,`first_name`,`em_image`,
        `project`.`pro_name`,`assign_task`.`user_type`
        FROM `pro_task`
        LEFT JOIN `assign_task` ON `pro_task`.`id`=`assign_task`.`task_id`
        LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
        LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
        WHERE `pro_task`.`id`='$id' AND user_type = 'Team Head'";
          $query=$this->db->query($sql);
      $result = $query->result();
      return $result;          
      }
    public function GetTeammemberValue($id){
      $sql = "SELECT `pro_task`.*,
      `assign_task`.`assign_user`,
        `employee`.`em_id`,`first_name`,`last_name`,`em_image`,
        `project`.`pro_name`,`assign_task`.`user_type`
        FROM `pro_task`
        LEFT JOIN `assign_task` ON `pro_task`.`id`=`assign_task`.`task_id`
        LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
        LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`
        WHERE `pro_task`.`id`='$id' AND user_type = 'Collaborators'";
          $query=$this->db->query($sql);
      $result = $query->result();
      return $result;          
      }
    public function GetFilesList($id){
    $sql = "SELECT `project_file`.*,
      `employee`.`first_name`,`em_image`
      FROM `project_file`
      LEFT JOIN `employee` ON `project_file`.`assigned_to`=`employee`.`em_id`
      WHERE `project_file`.`pro_id`='$id'";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetF_i_e_l_dApplication(){
    $sql = "SELECT `field_visit`.*,
      `employee`.`first_name`,`last_name`,`em_code`, `em_id`,
      `project`.`pro_name`
      FROM `field_visit`
      LEFT JOIN `employee` ON `field_visit`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `project` ON `field_visit`.`project_id`=`project`.`id`";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }  
    public function GetFieldvisit($id){
    $sql = "SELECT `field_visit`.*,
      `employee`.`first_name`,`last_name`,`em_code`, `em_id`,
      `project`.`pro_name`
      FROM `field_visit`
      LEFT JOIN `employee` ON `field_visit`.`emp_id`=`employee`.`em_id`
      LEFT JOIN `project` ON `field_visit`.`project_id`=`project`.`id` WHERE `field_visit`.`emp_id` = '$id' ";
        $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
    }


    //Approve field application - update
    public function updateFieldVistApplication($fieldApplicationID, $data){
        
        $this->db->where('id', $fieldApplicationID);
        $this->db->update('field_visit', $data); 
        return true;        
    }

    // Get field visit data by id to populate form

    public function getFieldAuthDataByID($id){
        $sql = "SELECT `field_visit`.*,
      `employee`.`em_id`
      FROM `field_visit`
      LEFT JOIN `employee` ON `field_visit`.`emp_id`=`employee`.`em_id` 
      WHERE `field_visit`.`id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    }

    public function GetNotesList($id){
    $sql = "SELECT `pro_notes`.*,
      `employee`.`first_name`,`last_name`,`em_id`,`em_image`
      FROM `pro_notes`
      LEFT JOIN `employee` ON `pro_notes`.`assign_to`=`employee`.`em_id`
      WHERE `pro_notes`.`pro_id`='$id' AND `pro_notes`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetExpensesList($id){
    $sql = "SELECT `pro_expenses`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_image`
      FROM `pro_expenses`
      LEFT JOIN `employee` ON `pro_expenses`.`assign_to`=`employee`.`em_id`
      WHERE `pro_expenses`.`pro_id`='$id'  AND `pro_expenses`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetEmProjectsValue($id){
    $sql = "SELECT `assign_task`.`project_id`,`assign_user`,
      `project`.*
      FROM `assign_task`
      LEFT JOIN `project` ON `assign_task`.`project_id`=`project`.`id`
      WHERE `assign_task`.`assign_user`='$id' AND `assign_task`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetExpensesValue($id){
    $sql = "SELECT `pro_expenses`.*,
      `employee`.`em_id`,`first_name`,`last_name`,`em_image`
      FROM `pro_expenses`
      LEFT JOIN `employee` ON `pro_expenses`.`assign_to`=`employee`.`em_id`
      WHERE `pro_expenses`.`id`='$id'  AND `pro_expenses`.`isActive` = 1";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;          
    }
    public function GetAllTasksList(){
    $sql = "SELECT `pro_task`.*,
      `project`.`pro_name`
      FROM `pro_task`
      LEFT JOIN `project` ON `pro_task`.`pro_id`=`project`.`id`  WHERE `pro_task`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function getProjectAssignUser($id){
    $sql = "SELECT DISTINCT `assign_task`.*,
      `employee`.`em_id`,`first_name`,`last_name`
      FROM `assign_task`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      WHERE `assign_task`.`project_id`='$id'  AND `assign_task`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function getTaskAssignUser($id){
    $sql = "SELECT `assign_task`.*,
      `employee`.`first_name`,`em_image`
      FROM `assign_task`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      WHERE `assign_task`.`task_id`='$id'  AND `assign_task`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
    public function GetEmployesValue($id){
    $sql = "SELECT `assign_task`.*,
      `employee`.`first_name`,`em_image`
      FROM `assign_task`
      LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
      WHERE `assign_task`.`task_id`='$id' AND `assign_task`.`isActive` = 1";
        $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
    }
  
    public function Add_Project_Notes($data){
      return $this->db->insert('pro_notes',$data);
    }
    public function Add_Project_expenses($data){
      return $this->db->insert('pro_expenses',$data);
    }
    public function Add_Assets($data){
      return $this->db->insert('assets',$data);
    }
    public function insert_members_Data($data){
      return  $this->db->insert('assign_task',$data);
    }
    public function GetAllAssetsList(){
        $sql = "SELECT `assets`.*,
        `assets_category`.*
        FROM `assets`
        LEFT JOIN `assets_category` ON `assets`.`catid`=`assets_category`.`cat_id`";
        $query=$this->db->query($sql);
        $result = $query->result();
		return $result;         
    }
    public function GetAssetsQty($id){
        $sql = "SELECT * FROM `assets` WHERE `ass_id`='$id'";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;         
    }
    public function GetAllLogisticList(){
        $sql = "SELECT `assets`.*,
        `assets_category`.*
        FROM `assets`
        LEFT JOIN `assets_category` ON `assets`.`catid`=`assets_category`.`cat_id` AND `assets`.`isActive` = 1";
        $query=$this->db->query($sql);
        $result = $query->result();
		return $result;         
    }
    public function GetprojectVal($id){
        $sql = "SELECT * FROM `project` WHERE `id`='$id'";
        $query=$this->db->query($sql);
        $result = $query->row();
		return $result;         
    }
    public function DeletPro($id){
      return $this->db->delete('pro_task',array('id'=> $id));
    }
    public function DeletAssignuser($id){
      return $this->db->delete('assign_task',array('task_id'=> $id));
    }
    public function Delet_members_Data($id){
      return $this->db->delete('assign_task',array('task_id'=> $id));
    }
    public function DeletProFile($id){
      return $this->db->delete('project_file',array('id'=> $id));
    }
    public function DeletExpensesByid($id){
      return $this->db->delete('pro_expenses',array('id'=> $id));
    }
    public function DeletNotesByID($id){
      return $this->db->delete('pro_notes',array('id'=> $id));
    }
    public function DeletAssetssByid($id){
       return $this->db->delete('assets',array('id'=> $id));
    }

    //delete project
    public function projectDelete($id){
      $data =  array( 'isActive' => 0);
      $query['pro_notes'] = $this->db->update('pro_notes', $data, array('pro_id' => $id));
      $query['pro_task'] = $this->db->update('pro_task', $data,array('pro_id' => $id));
      $query['project'] = $this->db->update('project', $data, array('id' => $id));
      $query['pro_expenses'] = $this->db->update('pro_expenses', $data, array('pro_id' => $id));
      $query['project_file'] = $this->db->update('project_file', $data,array('pro_id' => $id));
      $query['assign_task'] = $this->db->update('assign_task', $data, array('project_id' => $id));
      return $query;
    }
    /*public function DletProjectData($id){
      $th
         $this->db->delete('pro_notes', array('pro_id' => $id)); 
        $this->db->delete('pro_task', array('pro_id' => $id));
        $this->db->delete('project', array('id' => $id));
        $this->db->delete('pro_expenses', array('pro_id' => $id));
        $this->db->delete('project_file', array('pro_id' => $id));
        $this->db->delete('assign_task', array('project_id' => $id)); 
    }*/
    //Approve field application - update
    public function fieldVisitDoneAndUpdateAttendance($fieldApplicationID, $data){
        
        $this->db->where('id', $fieldApplicationID);
        $this->db->update('field_visit', $data); 
        return true;        
    }

    // Select data from field visit by ID
    public function  selectDataFromFieldVisitByID($fieldApplicationID) {
      $sql = "SELECT `field_visit`.* FROM `field_visit`
      WHERE `field_visit`.`id`='$fieldApplicationID'";
      $query=$this->db->query($sql);
      $result = $query->result();
      return $result; 
    }

    // Select attendance of the employee to update the attendance
    public function updateAttendanceByFieldVisitReturn($data){
      return $this->db->insert_batch('attendance', $data);      
    }

    // Select attendance of the employee to update the attendance
    public function insertAttendanceByFieldVisitReturn($data){
      return  $this->db->insert('attendance', $data);      
    }

    }
?>