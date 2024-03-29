<?php
  class Organization_model extends CI_Model{
    function __consturct(){
      parent::__construct();
    }
   //check field already exists
   public function Check_field_exists($val,$data,$table){
       $this->db->where($data);
       //$this->db->where();
       return $this->db->get($table)->num_rows();
  
    }
    public function Check_leave_exists($val, $data, $table) {
    // Add a condition to check that 'leave_status' is not equal to 'Rejected'
    $this->db->where($data);
    $this->db->where('leave_status !=', 'Rejected');
    
    return $this->db->get($table)->num_rows();
   }
  
   /* public function depselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('department');
      $result = $query->result();
      return $result;
    }*/
    public function depselect(){
      $this->db->where('isActive', 1);//
        $this->db->order_by("depname", "asc");
      $query = $this->db->get('org_department');
      $result = $query->result();
      return $result;
    }
  
    public function eduselect(){
      $this->db->where('isActive', 1);//
      $this->db->order_by("education", "asc");
      $query = $this->db->get('educationmaster');
      $result = $query->result();
      return $result;
    }


    public function jobtitleselect(){
      $this->db->where('isActive', 1);
    $query = $this->db->get('jobtitle');
     
    $result = $query->result();
    return $result;
    }

    public function Add_jobtitle($data){
     return $this->db->insert('jobtitle',$data);
    }

    public function jobtitle_edit($jobid){
      $sql    = "SELECT * FROM `jobtitle` WHERE `id`='$jobid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

    public function Update_jobtitle($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('jobtitle',$data);
    }

     public function jobtitle_delete($id){
      //return $this->db->delete('jobtitle',array('id' => $id ));
     /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `jobtitle` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}
    }

    public function empselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('employment');
      $result = $query->result();
      return $result;
    }
    
    public function Prefixselect(){
      $this->db->where('isActive', 1);//
       $this->db->order_by("prefixname", "asc");
      $query = $this->db->get('prefix');
      $result = $query->result();
      return $result;
    }

      public function Add_prefixtitle($data){
      $query = $this->db->insert('prefix',$data);
        $last_id = $this->db->insert_id();
         if($query == TRUE){
            return  $last_id; 
         }else{
          false;
         }
    }

     public function prefixtitle_edit($prefixid){
      $sql    = "SELECT * FROM `prefix` WHERE `id`='$prefixid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

    public function Update_prefixtitle($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('prefix',$data);
    }

      public function prefixtitle_delete($id){
      //return $this->db->delete('prefix',array('id' => $id ));
     $chk_sql = "SELECT prefix.id,prefix.prefixName,employee.pre_id FROM `employee` INNER JOIN `prefix` ON employee.pre_id = prefix.id WHERE prefix.id = $id";
        if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `prefix` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        }else{
        return false;
      }
    }

     public function Positionselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('position');
      $result = $query->result();
      return $result;
    }

     public function Add_positiontitle($data){
      return $this->db->insert('position',$data);
    }

    public function positiontitle_edit($positionid){
      $sql    = "SELECT * FROM `position` WHERE `id`='$positionid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

    public function Update_positiontitle($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('position',$data);
    }

    public function positiontitle_delete($id){
      //return $this->db->delete('position',array('id' => $id ));

     /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `position` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}
    }

    public function accounttypeselect(){
       $this->db->where('isActive', 1);//
      $query = $this->db->get('account_type');
      $result = $query->result();
      return $result;
    }

      public function Add_AccountType($data){
      return $this->db->insert('account_type',$data);
    }

  
      public function AccountType_edit($accounttypeid){
      $sql    = "SELECT * FROM `account_type` WHERE `id`='$accounttypeid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

      public function Update_AccountType($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('account_type',$data);
    }

      public function AccountType_delete($id){
     // return $this->db->delete('account_type',array('id' => $id ));
     /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*///change emp table/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `account_type` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}
    }

     public function Nationalityselect(){
       $this->db->where('isActive', 1);//
       $this->db->order_by("nationality_name", "asc");
      $query = $this->db->get('nationality');
      $result = $query->result();
      return $result;
    }

    public function Add_Nationality($data){
      $query = $this->db->insert('nationality',$data);
        $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }

    public function nationality_edit($nationalityid){
      $sql    = "SELECT * FROM `nationality` WHERE `id`='$nationalityid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

    public function Update_Nationality($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('nationality',$data);
    }

      public function Nationality_delete($id){
     //return  $this->db->delete('nationality',array('id' => $id ));
             /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*///change emp table/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `nationality` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}

    }

    public function Courseselect(){
       $this->db->where('isActive', 1);//
       $this->db->order_by("eLevelid", "asc");
      $query = $this->db->get('ms_coursetype');
      $result = $query->result();
      return $result;
    }

    public function Add_Course($data){

       $query =  $this->db->insert('ms_coursetype',$data);
       $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }

      public function course_edit($courseid){
      $sql    = "SELECT * FROM `ms_coursetype` WHERE `cid`='$courseid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

      public function Update_course($id, $data){
      $this->db->where('cid',$id);
       return $this->db->update('ms_coursetype',$data);
    }

      public function course_delete($id){
      //return $this->db->delete('ms_coursetype',array('cid' => $id ));
                 /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*///change emp table/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `ms_coursetype` SET isActive=0 WHERE `cid`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}
    }

    public function Languageselect(){
       $this->db->where('isActive', 1);//
       $this->db->order_by("language_name", "asc");
      $query = $this->db->get('language');
      $result = $query->result();
      return $result;
    }

    public function Add_Language($data){
      return $this->db->insert('language',$data);
    }

  
      public function language_edit($Languageid){
      $sql    = "SELECT * FROM `language` WHERE `id`='$Languageid'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

      public function Update_Language($id, $data){
      $this->db->where('id',$id);
       return $this->db->update('language',$data);
    }

      public function Language_delete($id){
      //return $this->db->delete('language',array('id' => $id ));
         /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*///change emp table/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `language` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}
    }

 

    public function Add_Employment($data){
      return $this->db->insert('employment',$data);
    }

    public function Update_Employment($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('employment',$data);
    }

    public function employment_edit($dep){
      $sql    = "SELECT * FROM `employment` WHERE `id`='$dep'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
     public function employment_delete($emp_id){
            //return $this->db->delete('jobtitle',array('id' => $id ));
     /*  $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";*///change emp table/
        //if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `employment` SET isActive=0 WHERE `id`='$emp_id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        /*}else{
        return false;
      }*/
    //}
    }
  
 
     public function Add_Educ($data){
     $query =  $this->db->insert('educationmaster',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    } 
     public function Add_Department($data){
     $query =  $this->db->insert('department',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }
    public function department_delete($dep_id){
      $chk_sql = "SELECT department.id, employee.dep_id FROM employee INNER JOIN department ON employee.dep_id = department.id WHERE department.id = $dep_id";
      if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `department` SET isActive=0 WHERE `id`='$dep_id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
      }else{
        return false;
      }

      //$this->db->delete('department',array('id' => $dep_id ));
    }   
     public function edu_delete($dep_id){
      
   
      $sql    = "UPDATE `educationmaster` SET isActive=0 WHERE `id`='$dep_id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
    

      //$this->db->delete('department',array('id' => $dep_id ));
    }

    public function department_edit($dep){

      $sql    = "SELECT * FROM `department` WHERE `id`='$dep'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    public function education_edit($edu){

      $sql    = "SELECT * FROM `educationmaster` WHERE `id`='$edu'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    public function Update_Department($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('department',$data);
    } 
    public function Update_edu($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('educationmaster',$data);
    }

    public function Add_Designation($data){
      $query = $this->db->insert('designation',$data);
      $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }
  
    public function designation_delete($des_id){
       $chk_sql = "SELECT designation.id, employee.des_id FROM employee INNER JOIN designation ON employee.des_id = designation.id WHERE designation.id = $des_id";
        if(empty($this->db->query($chk_sql)->result())){
      //return $this->db->delete('designation',array('id'=> $des_id));
      $sql    = "UPDATE `designation` SET isActive=0 WHERE `id`='$des_id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
    }else{
        return false;
      }
    }

    public function designation_edit($des){
      $sql    = "SELECT * FROM `designation` WHERE `id`='$des'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
  
    public function Update_Designation($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('designation',$data);
    }
  
    public function desselect(){
       $this->db->where('isActive', 1);
       $this->db->order_by("des_name", "asc");
      $query = $this->db->get('designation');
      $result = $query->result();
      return $result;
    } 
    public function selectdes($id){
       $this->db->where('id', $id );
      $query = $this->db->get('designation');
      $result = $query->row();
      return $result;
    } 
    public function roleselect(){
      $data = array('isActive'=> 1,'isView'=>1);
       $this->db->where($data);
        $this->db->order_by("role", "asc");
      $query = $this->db->get('role');
      $result = $query->result();
      return $result;
    }
    public function Add_Role($data){
       $query = $this->db->insert('role',$data);
      $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      return false;
     }
   }
      public function role_edit($des){
      $sql    = "SELECT * FROM `role` WHERE `id`='$des'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
      public function Update_Role($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('role',$data);
    }
      public function role_delete($id){
       $chk_sql = "SELECT role.id,role.role,employee.em_role FROM `employee` INNER JOIN `role` ON employee.em_role = role.role WHERE role.id = $id";
        if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `role` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
        }else{
        return false;
      }
    }
    //govt id master
      public function Save_govid($data){
     $query =  $this->db->insert('govidtype',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }
    public function Delete_govid($id){
      $chk_sql = "SELECT govidtype.id, emp_govtid.gov_id FROM govidtype INNER JOIN emp_govtid ON govidtype.id = emp_govtid.gov_id WHERE govidtype.id = '$id' AND govidtype.isActive = 1 AND emp_govtid.isActive = 1";
      if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `govidtype` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
      }else{
        return false;
      }
    }

    public function Govid_edit($dep){

      $sql    = "SELECT * FROM `govidtype` WHERE `id`='$dep'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
  
    public function Update_govid($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('govidtype',$data);
    }
    public function govidselect(){
      $this->db->where('isActive', 1);//
      $this->db->order_by("govID_name", "asc");
      $query = $this->db->get('govidtype');
      $result = $query->result();
      return $result;
    }
    //currency 
    public function currencyselect(){
      $this->db->where('isActive', 1);//
       $this->db->order_by("currency_name", "asc");
      $query = $this->db->get('currency_master');
      $result = $query->result();
      return $result;
    }   
     //Allowance 
    public function allowanceselect(){
      $this->db->where('isActive', 1);//
       $this->db->order_by("allowance_name", "asc");
      $query = $this->db->get('allowance_master');
      $result = $query->result();
      return $result;
    }  //deduction 
    public function deductionselect(){
      $this->db->where('isActive', 1);//
       $this->db->order_by("deduction_name", "asc");
      $query = $this->db->get('deduction_master');
      $result = $query->result();
      return $result;
    }
    public function Add_Currency($data){
     $query =  $this->db->insert('currency_master',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    } 
    public function Add_Allowance($data){
     $query =  $this->db->insert('allowance_master',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }   
     public function Add_Deduction($data){
     $query =  $this->db->insert('deduction_master',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }
     public function currency_edit($id){

      $sql    = "SELECT * FROM `currency_master` WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }  
     public function allowance_edit($id){

      $sql    = "SELECT * FROM `allowance_master` WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    } 
     public function Deduction_edit($id){

      $sql    = "SELECT * FROM `deduction_master` WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    public function Update_Currency($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('currency_master',$data);
    } 
    public function Update_Allowance($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('allowance_master',$data);
    } 
    public function Update_deduction($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('deduction_master',$data);
    }
    public function Delete_Currency($id){
      $sql    = "UPDATE `currency_master` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
    }   
    public function Delete_Allowance($id){
     /* $sql    = "UPDATE `allowance_master` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;*/
     return $this->db->delete('allowance_master',array('id' => $id ));
    }
     public function Delete_Deduction($id){
     /* $sql    = "UPDATE `deduction_master` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;*/
     return $this->db->delete('deduction_master',array('id' => $id ));
    }
    
     public function Add_category($data){
     $query =  $this->db->insert('expenses_category',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    } 
        
  }
?>