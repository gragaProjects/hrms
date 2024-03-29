<?php

	class Employee_model extends CI_Model{
  	function __consturct(){
  	parent::__construct();
	}

  //check field already exists
   public function Check_field_exists($val,$data,$table){
       $this->db->where($data);
       //$this->db->where();
       return $this->db->get($table)->num_rows();
  
    }

   public function matcheducation($id){
    $sql = " SELECT educationmaster.id,educationmaster.education,ms_coursetype.eLevelid FROM educationmaster INNER JOIN `ms_coursetype` ON ms_coursetype.eLevelid = educationmaster.id   WHERE educationmaster.`isActive` = 1 AND  educationmaster.id = $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    } 

	public function getrole(){
     $data = array('isActive'=> 1,'isView'=>1);
       $this->db->where($data);
    $this->db->order_by("role", "asc");
  	$query = $this->db->get('role');
  	$result = $query->result();
  	return $result;
	}  
  public function getemprole(){
     $data = array('isActive'=> 1);
       $this->db->where($data);
    $this->db->order_by("role", "asc");
    $query = $this->db->get('role');
    $result = $query->result();
    return $result;
  }
  public function getdesignation(){
      $this->db->where('isActive', 1);
        $this->db->order_by("des_name", "asc");
    $query = $this->db->get('designation');
   
    $result = $query->result();
    return $result;
  }
  
  public function getdepartment(){
     $this->db->where('isActive', 1);
	 $query = $this->db->get('department');
   
	 $result = $query->result();
	 return $result;
	}
  
  public function geteducationmaster(){
     $this->db->where('isActive', 1);
       $this->db->order_by("education", "asc");
   $query = $this->db->get('educationmaster');
   
   $result = $query->result();
   return $result;
  }

  public function getprefix(){
    $this->db->where('isActive', 1);
      //$this->db->order_by("prefixname", "asc");
   $query = $this->db->get('prefix');
   $result = $query->result();
   return $result;
  }

  public function getgovtID(){
     $this->db->where('isActive', 1);
       $this->db->order_by("govID_name", "asc");
   $query = $this->db->get('govidtype');
   $result = $query->result();
   return $result;
  }

  public function getcourse(){
    $this->db->where('isActive', 1);
      $this->db->order_by("courseName", "asc");
   $query = $this->db->get('ms_coursetype');
  
   $result = $query->result();
   return $result;
  }

  public function emselect(){
    $sql = "SELECT * FROM `employee` WHERE  `isActive` = 1 AND `user_status` = 1 order by `em_code` asc";
    $query=$this->db->query($sql);
  	$result = $query->result();
  	return $result;
	}
  public function nationalityselect(){
    $sql = "SELECT * FROM `nationality` WHERE `isActive`= 1 ORDER BY nationality_name asc";
    $query=$this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function emselectByID($emid){
    $sql = "SELECT * FROM `employee`
    WHERE `em_id`='$emid'";
    $query=$this->db->query($sql);
  	$result = $query->row();
  	return $result;
	}

  public function emselectByCode($emid){
    $sql = "SELECT * FROM `employee`
      WHERE `em_id`='$emid'";
    $query=$this->db->query($sql);
  	$result = $query->row();
  	return $result;
	}

  public function getInvalidUser(){
    $sql = "SELECT * FROM `employee`
    WHERE `isActive` = 0";
      $query=$this->db->query($sql);
		$result = $query->result();
		return $result;
	}

  public function Does_email_exists($email) {
		$user = $this->db->dbprefix('employee');
        $sql = "SELECT `em_email` FROM $user
		WHERE `em_email`='$email' AND `status` = 'ACTIVE'";
		$result=$this->db->query($sql);
    if ($result->row()) {
        return $result->row();
    } else {
        return false;
    }
  }
    public function businessunitvalue(){
    $sql = "SELECT * FROM `businessunit`
    WHERE `isActive`= 1 AND `Active_status` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
   }  
   public function getallowancevalue(){
    $sql = "SELECT * FROM `allowance_master`
    WHERE `isActive`= 1 ";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
   }  
   public function getdeductionvalue(){
    $sql = "SELECT * FROM `deduction_master`
    WHERE `isActive`= 1 ";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
   }  
    public function get_businesscode($id){
    $sql = "SELECT * FROM `businessunit`
    WHERE `id` = $id AND `isActive`= 1";
    $query=$this->db->query($sql);
    $result = $query->row();
    return $result;          
   }
   public function get_last_emp($id){
      $sql = "SELECT * FROM employee WHERE `busunit` = '$id' AND `isActive` = 1 AND `user_status` = 1  ORDER BY id DESC LIMIT 1;";
      $query=$this->db->query($sql);
      $result = $query->row();
      return $result;          
     }

  public function Add($data){
      $query =  $this->db->insert('employee',$data);
      $last_id = $this->db->insert_id();
         if($query == TRUE){
            return  $last_id; 
         }else{
          false;
         }
  }  
/*  public function Add($data){
      return $this->db->insert('employee',$data);
  }*/

  public function GetBasic($id){
    $sql = "SELECT `employee`.`em_id` as `empid`,`employee`.`isActive` as `empstatus`, `employee`.`id` as `eid`, `employee`.*, `designation`.*, `org_department`.*, `prefix`.*
    FROM `employee`
    LEFT JOIN `designation` ON `employee`.`des_id`=`designation`.`id`
     LEFT JOIN `org_department` ON `employee`.`dep_id`=`org_department`.`id`
    LEFT JOIN `prefix` ON `employee`.`pre_id`=`prefix`.`id`
    WHERE `em_id`='$id'";
      $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
  }

  public function ProjectEmployee($id){
    $sql = "SELECT `assign_task`.`assign_user`,
    `employee`.`em_id`,`first_name`,`last_name`
    FROM `assign_task`
    LEFT JOIN `employee` ON `assign_task`.`assign_user`=`employee`.`em_id`
    WHERE `assign_task`.`project_id`='$id' AND `user_type`='Team Head'";
    $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
  }

  public function Getpersonalvalue($id){
    $sql = "SELECT * FROM `emp_personal`
    WHERE `em_id`='$id' AND `isActive`= 1";
      $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
  } 
  public function GetperAddress($id){
    $sql = "SELECT * FROM `address`
    WHERE `emp_id`='$id' AND `type`='Permanent'";
      $query=$this->db->query($sql);
    $result = $query->row();
    return $result;          
  }

  public function GetpreAddress($id){
    $sql = "SELECT * FROM `address`
    WHERE `emp_id`='$id' AND `type`='Present'";
      $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
  }

  public function GetEducation($id){
    $sql = "SELECT * FROM `education`
    WHERE `emp_id`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
  }
   public function GetcurrenyValue(){
        $sql = "SELECT * FROM `currency_master`
    WHERE `isActive`= 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
    }

  public function GetIdentityCards($id){
   
    $sql = "SELECT `emp_govtid`.*, `govidtype`.* FROM `emp_govtid`
        left join `govidtype` ON `govidtype`.`id`= `emp_govtid`.`gov_id`
    WHERE `emp_id`='$id' AND `emp_govtid`.`isActive` = 1";

      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
  }

  public function GetExperience($id){
    $sql = "SELECT * FROM `emp_experience`
    WHERE `emp_id`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
  }

  public function GetBankInfo($id){
    $sql = "SELECT * FROM `bank_info`
    WHERE `em_id`='$id'";
      $query=$this->db->query($sql);
		$result = $query->row();
		return $result;          
  }

  public function GetAllEmployee(){
    $sql = "SELECT * FROM `employee` where `user_status` = 1";
      $query=$this->db->query($sql);
		$result = $query->result();
		return $result;          
  }

  public function desciplinaryfetch(){
    $sql = "SELECT `desciplinary`.*,
    `employee`.`em_id`,`first_name`,`last_name`,`em_code`
    FROM `desciplinary`
    LEFT JOIN `employee` ON `desciplinary`.`em_id`=`employee`.`em_id` where `desciplinary`.`isActive` = 1 AND `user_status` = 1";
      $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
  }

  public function GetUserDisciplinary($id){
    $sql = "SELECT `desciplinary`.*,
    `employee`.`em_id`,`first_name`,`last_name`,`em_code`
    FROM `desciplinary`
    LEFT JOIN `employee` ON `desciplinary`.`em_id`=`employee`.`em_id` where `desciplinary`.`em_id` = '$id' AND `desciplinary`.`isActive` = 1 AND `user_status` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;        
  }

  public function GetLeaveiNfo($id,$year){
    $sql = "SELECT `assign_leave`.*,
    `leave_types`.`name`
    FROM `assign_leave`
    LEFT JOIN `leave_types` ON `assign_leave`.`type_id`=`leave_types`.`type_id`
    WHERE `assign_leave`.`emp_id`='$id' AND `dateyear`='$year'";
      $query=$this->db->query($sql);
		$result = $query->result();
		return $result;        
  }

  public function GetsalaryValue($id){
    $sql = "SELECT `emp_salary`.*,(`emp_salary`.`basic`) AS basicsalary,(`emp_salary`.`hra`) AS basichra,(`emp_salary`.`id`) AS sid,
    `addition`.*,
    `deduction`.*,
    `salary_type`.*
    FROM `emp_salary`
    LEFT JOIN `addition` ON `emp_salary`.`id`=`addition`.`salary_id`
    LEFT JOIN `deduction` ON `emp_salary`.`id`=`deduction`.`salary_id`
    LEFT JOIN `salary_type` ON `emp_salary`.`type_id`=`salary_type`.`id`
    WHERE `emp_salary`.`emp_id`='$id' ORDER BY salary_type asc";
      $query=$this->db->query($sql);
		$result = $query->row();
		return $result;        
  }

  public function Update($data,$id){
		$this->db->where('em_id', $id);
		return $this->db->update('employee',$data);        
  }

  public function Update_Education($id,$data){
	 $this->db->where('id', $id);
	 return $this->db->update('education',$data);        
  }

  public function Update_BankInfo($id,$data){
	 $this->db->where('id', $id);
	 return $this->db->update('bank_info',$data);        
  }

  public function UpdateParmanent_Address($id,$data){
	 $this->db->where('id', $id);
	return $this->db->update('address',$data);        
  }

  public function Reset_Password($id,$data){
	 $this->db->where('em_id', $id);
	  return $this->db->update('employee',$data);        
  }

  public function Update_Experience($id,$data){
	 $this->db->where('id', $id);
	 return $this->db->update('emp_experience',$data);        
  }

  public function Update_IdentityCard($id,$data){
   $this->db->where('gid', $id);
   return $this->db->update('emp_govtid',$data);        
  }

  public function Update_Salary($sid,$data){
	 $this->db->where('id', $sid);
	 return $this->db->update('emp_salary',$data);        
  }

  public function Update_Deduction($did,$data){
	 $this->db->where('de_id', $did);
	  return $this->db->update('deduction',$data);        
  }

  public function Update_Addition($aid,$data){
	 $this->db->where('addi_id', $aid);
	 return $this->db->update('addition',$data);        
  }

  public function Update_Desciplinary($id,$data){
	 $this->db->where('id', $id);
	 return $this->db->update('desciplinary',$data);        
  }

  public function Update_Media($id,$data){
	 $this->db->where('id', $id);
	 return $this->db->update('social_media',$data);        
  }

  public function AddParmanent_Address($data){
   return $this->db->insert('address',$data);
  } 

  public function Add_education($data){
     return $this->db->insert('education',$data);
  }

  public function Add_Experience($data){
    return $this->db->insert('emp_experience',$data);
  }

  public function Add_IdentityCard($data){
    return $this->db->insert('emp_govtid',$data);
  }
   
  public function Update_GovIdentity($data,$id){
    //return $this->db->insert('emp_govtid',$data);
      $this->db->where('gid', $id);
      return $this->db->update('emp_govtid',$data);  
  }  
  public function Delete_GovIdentityCard($id){

      $sql    = "UPDATE `emp_govtid` SET isActive=0 WHERE `gid`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
  }
    public function getcertification(){
        $this->db->where('isActive', 1);
       $query = $this->db->get('emp_certificate');
      
       $result = $query->result();
       return $result;
  }    
  public function Get_certification($id){
        $sql = "SELECT * FROM `emp_certificate`
    WHERE `emp_id`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result; 
  }
    public function Add_Certification($data){
    return $this->db->insert('emp_certificate',$data);
  }
   
  public function Update_Certification($data,$id){
    //return $this->db->insert('emp_govtid',$data);
      $this->db->where('id', $id);
      return $this->db->update('emp_certificate',$data);  
  }  
  public function Delete_Certification($id){

      $sql    = "UPDATE `emp_certificate` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
  }
  
  public function Add_Desciplinary($data){
    return $this->db->insert('desciplinary',$data);
  }
  
  public function Add_BankInfo($data){
    return $this->db->insert('bank_info',$data);
  }
  
  public function GetEmployeeId($id){
    $sql = "SELECT `em_password` FROM `employee` WHERE `em_id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  }
  
  public function GetFileInfo($id){
    $sql = "SELECT * FROM `employee_file` WHERE `em_id`='$id' AND `isActive` = 1";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result; 
  }
  
  public function GetSocialValue($id){
    $sql = "SELECT * FROM `social_media` WHERE `emp_id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  }
  
  public function GetEduValue($id){
    $sql = "SELECT * FROM `education` LEFT JOIN ms_coursetype ON education.course = ms_coursetype.cId  WHERE education.`isActive` = 1 AND `id`='$id'";
    //$sql = "SELECT * FROM `education` WHERE `isActive` = 1 AND`id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  }
  
  public function GetCertificateValue($id){
    $sql = "SELECT * FROM `emp_certificate` WHERE `id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  } 
   public function GetDocValue($id){
    $sql = "SELECT * FROM `employee_file` WHERE `id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  } 
  public function GetExpValue($id){
    $sql = "SELECT * FROM `emp_experience` WHERE `id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  }

  public function GetIDCardValue($id){
   /* $sql = "SELECT * FROM `emp_govtid` left join `govidtype` ON `govidtype`.`id`=`emp_govtid`.`gov_id` 
      WHERE `emp_govtid`.`gid`='$id'";*/
       $sql = "SELECT * FROM `emp_govtid` WHERE `isActive` = 1 AND `gid`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  }
  
  public function GetDesValue($id){
    $sql = "SELECT * FROM `desciplinary` WHERE `id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  } 
	
  public function depselect(){
    $query = $this->db->get('department');
  	$result = $query->result();
  	return $result;
	}
  
  public function Add_Department($data){
    return $this->db->insert('department',$data);
  }

  public function Add_Designation($data){
   return $this->db->insert('designation',$data);
  }
  
  public function File_Upload($data){
   return $this->db->insert('employee_file',$data);
  }
  
  public function Add_Salary($data){
   return $this->db->insert('emp_salary',$data);
  }
  
  public function Add_Addition($data1){
   return $this->db->insert('addition',$data1);
  }
  
  public function Add_Deduction($data2){
    return $this->db->insert('deduction',$data2);
  }
  
  public function Add_Assign_Leave($data){
    $this->db->insert('assign_leave',$data);
  }
  
  public function Insert_Media($data){
    $this->db->insert('social_media',$data);
  }
  
  public function desselect(){
  	$query = $this->db->get('designation');
  	$result = $query->result();
  	return $result;
	}
  
  public function DeleteEducation($id){
    //$this->db->delete('education',array('id'=> $id));
      $sql    = "UPDATE `education` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  } 
  public function DeletEdu($id){
    //$this->db->delete('education',array('id'=> $id));
      $sql    = "UPDATE `education` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }
  
  public function DeletEXP($id){
    //$this->db->delete('emp_experience',array('id'=> $id));
    $sql    = "UPDATE `emp_experience` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }  

  public function DeleteIDCard($id){
    return $this->db->delete('emp_govtid',array('gid'=> $id));
  }
  
  public function DeletDisiplinary($id){
    return $this->db->delete('desciplinary',array('id'=> $id));
  }
  //persnal details
  public function Add_personalinfo($data){
     return $this->db->insert('emp_personal',$data);
  }

  public function Update_personalinfo($id,$data){
   $this->db->where('id', $id);
   return $this->db->update('emp_personal',$data);        
  }  
  //skills
    public function Add_Skills($data){
    return $this->db->insert('emp_skills',$data);
  }
   
  public function Update_Skills($data,$id){
    //return $this->db->insert('emp_govtid',$data);
      $this->db->where('id', $id);
      return $this->db->update('emp_skills',$data);  
  }
   public function Getskillvalue($id){
    $sql = "SELECT * FROM `emp_skills`
    WHERE `em_id`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;   
  } 
  public function SkillValue($id){
    $sql = "SELECT * FROM `emp_skills` WHERE `isActive` = 1 AND`id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  }
    public function DeleteSKills($id){
    //$this->db->delete('education',array('id'=> $id));
      $sql    = "UPDATE `emp_skills` SET `isActive` = 0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  } 
  //education get course
    public  function get_match_course($id){
     //SELECT state_name FROM state WHERE country_id = 1

      $sql    = "SELECT cId, courseName FROM ms_coursetype WHERE isActive = 1 AND elevelid = $id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    } 
     public  function Add_Edudocument($data){
      return $this->db->insert('emp_educationdoc', $data);
      
    } 
     public  function Get_EducationDoc($em_id,$edu_id){
        $sql    = "SELECT * FROM `emp_educationdoc` WHERE `isActive` = 1  AND `em_id` = '$em_id' AND `edu_id` = $edu_id ";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }
      public function DeleteEducationDoc($id){;
      $sql    = "UPDATE `emp_educationdoc` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }
  //add experience document
    public  function Add_Expdocument($data){
      return $this->db->insert('emp_experiencedoc', $data);
      
    }
   public  function Get_ExperienceDoc($em_id,$exp_id){
    $sql    = "SELECT * FROM `emp_experiencedoc` WHERE `isActive` = 1  AND `em_id` = '$em_id' AND `exp_id` = $exp_id ";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
  
  } 
     public function DeleteExperienceDoc($id){;
      $sql    = "UPDATE `emp_experiencedoc` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }
  //dependency
   
    public function Add_Dependency($data){
    return $this->db->insert('emp_dependency',$data);
  }
    public function GetDependencyValue($id){
    $sql = "SELECT * FROM `emp_dependency`
    WHERE `em_id`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;   
  }
   public function GetDependencyData($id){
    $sql = "SELECT * FROM `emp_dependency` WHERE `id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  } 
   public function Update_Dependency($data,$id){
    //return $this->db->insert('emp_govtid',$data);
      $this->db->where('id', $id);
      return $this->db->update('emp_dependency',$data);  
  }//Deletedependency
  
   public function Deletedependency($id){;
      $sql    = "UPDATE `emp_dependency` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  } 
   //disability
   
    public function Add_disability($data){
    return $this->db->insert('emp_disability',$data);
  }
    public function GetdisabilityValue($id){
    $sql = "SELECT * FROM `emp_disability`
    WHERE `emp_id`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;   
  }
   public function GetDisablityData($id){
    $sql = "SELECT * FROM `emp_disability` WHERE `id`='$id'";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result; 
  } 
   public function Update_disability($data,$id){
    //return $this->db->insert('emp_govtid',$data);
      $this->db->where('id', $id);
      return $this->db->update('emp_disability',$data);  
  }
  
   public function Deletedisability($id){;
      $sql    = "UPDATE `emp_disability` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }  
  public function Deletepersonal($id){;
      $sql    = "UPDATE `employee_file` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
  }
    public function File_Update($data,$id){
    //return $this->db->insert('emp_govtid',$data);
      $this->db->where('id', $id);
      return $this->db->update('employee_file',$data);  
  }
  //role
     public function matchrole($id){
        //$this->db->where('isActive', 1);
    $sql = "SELECT * FROM `role` WHERE `id` = $id AND `isActive` = 1";
    //
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
 

    public function disciplinarydelete($id){
      $data =  array( 'isActive' => 0);
     $this->db->where('id', $id);
    return $this->db->update('desciplinary',$data); 
    }
     
       //get match data
    public  function get_match_department($id){
     //SELECT state_name FROM state WHERE country_id = 1

      $sql    = "SELECT * FROM `org_department` WHERE isActive = 1 AND busunit_id = $id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }  
      public function matchdep($id){
    $sql = "SELECT  `org_department`.`depname`,`org_department`.`depcode`,`org_department`.`busunit_id`,`employee`.`em_id`,`employee`.`dep_id` FROM `employee` INNER JOIN `org_department` ON `employee`.`dep_id` = `org_department`.`id` WHERE org_department.id = $id
      AND `org_department`.`isActive` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    } 
     public function matchcourse($id){
    $sql = "SELECT  `org_department`.depname,`org_department`.depcode,`org_department`.busunit_id,`employee`.em_id,`employee`.dep_id FROM `employee` INNER JOIN `org_department` ON employee.dep_id = org_department.id WHERE org_department.id = $id
      AND `org_department`.`isActive` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

       public function GetReportEmp($id){
        $sql = "SELECT * FROM `employee`  WHERE `busunit` = '$id' AND `isActive` = 1 AND `user_status` = 1";
          $query  = $this->db->query($sql);
          $result = $query->result();
      
          return $result;
    }  

     public function matchemp($id){
    $sql = "SELECT  * FROM `employee`  WHERE `em_id` = '$id'
      AND `isActive` = 1 AND `user_status` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    } 
    /* $sql = "SELECT   govidtype.govID_name,emp_govtid.emp_id ,employee.em_email,employee.first_name,employee.last_name,emp_govtid.*,  DATEDIFF(gid_expiry, CURDATE()) AS days FROM emp_govtid INNER JOIN `employee` ON  employee.em_id = emp_govtid.emp_id INNER JOIN `govidtype` ON `emp_govtid`.`gov_id`=`govidtype`.`id` WHERE emp_govtid.isActive = 1  AND employee.isActive = 1  AND DATEDIFF(gid_expiry, CURDATE()) BETWEEN 0 AND 30   ";*/

   //Expire Document
       public function document_cronjob($govt_id,$sequence){

      $sql = "SELECT   govidtype.govID_name,emp_govtid.emp_id ,employee.em_email,employee.first_name,employee.last_name,employee.busunit,employee.report_to,emp_govtid.*,businessunit.name,businessunit.hr,  DATEDIFF(gid_expiry, CURDATE()) AS days FROM emp_govtid LEFT JOIN `employee` ON  employee.em_id = emp_govtid.emp_id LEFT JOIN `businessunit` ON `businessunit`.`id`=`employee`.`busunit` LEFT JOIN `govidtype` ON `emp_govtid`.`gov_id`=`govidtype`.`id` WHERE emp_govtid.isActive = 1  AND employee.isActive = 1 
         AND  gid_expiry = DATE_ADD(CURDATE(), INTERVAL '$sequence' DAY) AND gov_id = $govt_id ;";
          $query=$this->db->query($sql);
        $result = $query->result();
        return $result; 

    }

    public function getemp($id){
    $sql = "SELECT  * FROM `employee`  WHERE `em_id` = '$id'
      AND `isActive` = 1 AND `user_status` = 1";
      $query  = $this->db->query($sql);
      $result = $query->row();
  
      return $result;
    }  

    public function Get_employee_event(){
    $sql = "SELECT  `assign_holidays`.*,first_name,last_name FROM `assign_holidays`  LEFT JOIN `employee` ON `assign_holidays`.`emp_id`=`employee`.`em_id`  WHERE `assign_holidays`.`isActive` = '1'";
      $query  = $this->db->query($sql);
      $result = $query->result();
  
      return $result;
    } 

   public function Get_employee_event_by_emp($emid){
      $sql = "SELECT  `assign_holidays`.*,first_name,last_name FROM `assign_holidays`  LEFT JOIN `employee` ON `assign_holidays`.`emp_id`=`employee`.`em_id`  WHERE `assign_holidays`.`isActive` = '1' AND `assign_holidays`.`emp_id` = '$emid'";
        $query  = $this->db->query($sql);
        $result = $query->result();
    
        return $result;
      } 

   public function Get_holidays($holidaystruc_id){
      $sql = "SELECT  * FROM `holiday`  WHERE `isActive` = '1' AND `structureid` = '$holidaystruc_id'";
        $query  = $this->db->query($sql);
        $result = $query->result();
    
        return $result;
      } 
public function Get_holidaysbymonth($holidaystruc_id,$month){
      $sql = "SELECT  * FROM `holiday`  WHERE `isActive` = '1' AND `structureid` = '$holidaystruc_id' AND DATE_FORMAT(`from_date` ,'%m-%Y') = '$month' ";
        $query  = $this->db->query($sql);
        $result = $query->result();
    
        return $result;
      } 


  public function GetPolicy($id){
    $sql = "SELECT * FROM `company_policies`
    WHERE `busunit`='$id' AND `isActive` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
  }


   public function deleteDuplicateSalaries($emp_id) {
      // Count the number of records for the specified emp_id
      $this->db->where('emp_id', $emp_id);
      $count = $this->db->count_all_results('emp_salary');

      // If more than one record exists, delete the earliest records
      if ($count > 1) {
          $this->db->where('emp_id', $emp_id);
          $this->db->order_by('id', 'asc'); // Assuming 'created_at' is the timestamp column
          $this->db->limit($count - 1); // Keep one record, delete the rest
          $this->db->delete('emp_salary');
          return true;
      }

      return false; // No duplicates or only one record, nothing to delete
  }

   public function saveAppointment($data) {
        // Your code to insert data into the 'appointments' table
        $this->db->insert('appointments', $data);
    }

}
?>