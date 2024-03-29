<?php

	class Settings_model extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
	  //check field already exists
   public function Check_field_exists($val,$data,$table){
       $this->db->where($data);
       //$this->db->where();
       return $this->db->get($table)->num_rows();
  
    }
    public function GetSettingsValue(){
		$settings = $this->db->dbprefix('settings');
        $sql = "SELECT * FROM $settings";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;	        
    }
    public function SettingsUpdate($id,$data){
		$this->db->where('id', $id);
		$this->db->update('settings',$data);		
	} 
	//country 
    public function countryselect(){
      $this->db->where('isActive', 1);//
       $this->db->order_by("country_name", "asc");
      $query = $this->db->get('country');
      $result = $query->result();
      return $result;
    } 
  
    //state 
   /* public function stateselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('state');
      $result = $query->result();
      return $result;
    } */

     public function country_edit($dep){

      $sql    = "SELECT * FROM `country` WHERE `id`='$dep'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

 
     public function Add_Country($data){
     $query =  $this->db->insert('country',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }  

    public function country_delete($id){
      $chk_sql = "SELECT country.id, state.country_id ,country.isActive FROM country INNER JOIN state ON state.country_id = country.id WHERE  country.isActive = 1 AND state.isActive = 1 AND country.id = $id";
      if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `country` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
      }else{
        return false;
      }
    }
    public function Update_country($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('country',$data);
    }
    //state
      public function stateselect(){
      $this->db->where('isActive', 1);//
      $this->db->order_by("country_id", "asc");
      $query = $this->db->get('state');
      $result = $query->result();
      return $result;
    }  
    public function matchcountry($id){
    $sql = "SELECT country.id,country.country_name,state.country_id FROM `state` INNER JOIN `country` ON state.country_id = country.id WHERE country.id = $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    } 
    public function matchstate($id){
    $sql = "SELECT state.id,state.state_name,city.state_id FROM `city` INNER JOIN `state` ON state.id = city.state_id WHERE state.id = $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    } 
     public function matchdistrict($id){
    $sql = "SELECT district.id,district.district_name,city.district_id FROM `city` INNER JOIN `district` ON district.id = city.district_id WHERE district.isActive = 1 AND district.id =  $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }  
    public function matchcity($id){
    $sql = "SELECT * FROM `city` WHERE id = $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }

     public function state_edit($state){

      $sql    = "SELECT * FROM `state` WHERE `id`='$state'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }   
   
     public function Add_State($data){
     $query =  $this->db->insert('state',$data);
     $last_id = $this->db->insert_id();
     if($query == TRUE){
        return  $last_id; 
     }else{
      false;
     }
    }
    public function Update_state($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('state',$data);
    }

    public function state_delete($id){
    
      $chk_sql    = "SELECT district.id, district.state_id ,state.isActive FROM state INNER JOIN district ON district.state_id = state.id WHERE  state.isActive = 1 AND district.isActive = 1 AND state.id =$id";
/*
      $chk_sql    = "SELECT city.id, city.state_id ,state.isActive FROM state INNER JOIN city ON city.state_id = state.id WHERE  state.isActive = 1 AND city.isActive = 1 AND state.id =$id";
*/      if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `state` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
      }else{
        return false;
      }
      
    }
    //get match data
    public	function get_match_state($id){
     //SELECT state_name FROM state WHERE country_id = 1

      $sql    = "SELECT id, state_name FROM state WHERE isActive = 1 AND country_id = $id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }  
     //get match district
    public  function get_match_district($id){
     //SELECT state_name FROM state WHERE country_id = 1

      $sql    = "SELECT id, district_name FROM district WHERE isActive = 1 AND state_id =$id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }  
    //get match city
    public  function get_match_city($id){
     //SELECT state_name FROM state WHERE country_id = 1

      $sql    = "SELECT id, city_name FROM city WHERE isActive = 1 AND district_id = $id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }/*   //get match city
    public  function get_match_city($id){
     //SELECT state_name FROM state WHERE country_id = 1

      $sql    = "SELECT id, city_name FROM city WHERE isActive = 1 AND state_id = $id";
      $query  = $this->db->query($sql);
      $result = $query->result();
      return $result;
      
    }*/
     public function GetOrganisationValue(){
		//$organisation = $this->db->dbprefix('organisation');
    $sql = "SELECT * FROM `organisation` where `isActive` = 1";
		$query=$this->db->query($sql);
		$result = $query->row();
		return $result;	        
    }  
    public function GetBusinessunitValue($busid){
    $sql = "SELECT * FROM `businessunit` where `id` = $busid AND `isActive` = 1";
    $query=$this->db->query($sql);
    $result = $query->row();
    return $result;         
    }

    public function Add_organisation($data){
      return $this->db->insert('organisation',$data);
    }
	 public function Update_organisation($id,$data){
	 	/* $sql = "SELECT * FROM `organisation` where isActive = 1";
		 $query=$this->db->query($sql);
		 $result = $query->row();*/
		 /*if(empty($result)){
          return $this->db->insert('organisation',$data);
         }else{*/
         	$this->db->where('id', $id);
         return $this->db->update('organisation',$data);  
         //}
		       
	    }

      //city
      public function city_edit($city){

      $sql    = "SELECT * FROM `city` WHERE `id`='$city'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
      public function cityselect(){
      $this->db->where('isActive', 1);//
       $this->db->order_by("country_id", "asc");
      $query = $this->db->get('city');
      $result = $query->result();
      return $result;
    }  
      public function Add_City($data){
       $query =  $this->db->insert('city',$data);
       $last_id = $this->db->insert_id();
       if($query == TRUE){
          return  $last_id; 
       }else{
        false;
       }
    } 
      public  function  Update_city($id, $data){
        $this->db->where('id',$id);
        return $this->db->update('city',$data);
      }  


    public function city_delete($id){
    
      $sql    = "UPDATE `city` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
      
    }
    //district
    public function districtselect(){
      $this->db->where('isActive', 1);//
        $this->db->order_by("country_id", "asc");
      $query = $this->db->get('district');
      $result = $query->result();
      return $result;
    } 
    public function district_edit($district){

      $sql    = "SELECT * FROM `district` WHERE `id`='$district'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    public function Add_District($data){
       $query =  $this->db->insert('district',$data);
       $last_id = $this->db->insert_id();
       if($query == TRUE){
          return  $last_id; 
       }else{
        false;
       }
    } 
     public  function  Update_district($id, $data){
      $this->db->where('id',$id);
      return $this->db->update('district',$data);
    }
     public function district_delete($id){
  
      $chk_sql    = "SELECT district.id, city.district_id ,district.isActive FROM district INNER JOIN city ON city.district_id = district.id WHERE  district.isActive = 1 AND city.isActive = 1 AND district.id = $id";
      if(empty($this->db->query($chk_sql)->result())){
      $sql    = "UPDATE `district` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      //$result = $query->row();
      return $query;
      }else{
        return false;
      }
    
    }
    //timezone
    public function timezoneselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('timezone');
      $result = $query->result();
      return $result;
    } 
      public function timezone_edit($id){

      $sql    = "SELECT * FROM `timezone` WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    public function Add_timezone($data){
      $query =  $this->db->insert('timezone',$data);
       $last_id = $this->db->insert_id();
       if($query == TRUE){
          return  $last_id; 
       }else{
        false;
       }
    }
    public  function  Update_timezone($id, $data){
        $this->db->where('id',$id);
        return $this->db->update('timezone',$data);
      }

    public function timezone_delete($id){
    
      $sql    = "UPDATE `timezone` SET isActive=0 WHERE `id`='$id'";
      $query  = $this->db->query($sql);
      return $query;
      
    }
    //business unit
    public function save_businessunit($data){
       return $this->db->insert('businessunit',$data);
    }
    public function businessunitselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('businessunit');
      $result = $query->result();
      return $result;
    }
    public function Getbusinessunit($id){
    $sql = "SELECT * FROM `businessunit`
    WHERE `id`='$id' AND `isActive`= 1";
      $query=$this->db->query($sql);
    $result = $query->row();
    return $result;          
   }  
   public function businessunitvalue(){
    $sql = "SELECT * FROM `businessunit`
    WHERE `isActive`= 1 AND `Active_status` = 1";
      $query=$this->db->query($sql);
    $result = $query->result();
    return $result;          
   }
   public function Update_businessunit($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('businessunit',$data);  
                  
     }
    public function Inactive_businessunit($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('businessunit',$data);  
                  
     } 
     public function active_businessunit($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('businessunit',$data);  
                  
     } 
    public function emselect(){
    $sql = "SELECT * FROM `employee` WHERE `status`='ACTIVE' AND  `isActive` = 1";
    $query=$this->db->query($sql);
    $result = $query->result();
    return $result;
   }
    public function Save_orgdepartment($data){
       return $this->db->insert('org_department',$data);
    }
    public function Update_orgdepartment($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('org_department',$data);  
                  
     }
    public function Inactive_orgdepartment($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('org_department',$data);  
                  
     } 
     public function active_orgdepartment($id,$data){
        $this->db->where('id', $id);
         return $this->db->update('org_department',$data);  
                  
     }
     public function orgdepartmentselect(){
      $this->db->where('isActive', 1);//
     // $this->db->order_by("id", "asc");
        $this->db->order_by("depname", "asc");
      $query = $this->db->get('org_department');
      $result = $query->result();
      return $result;
    }
     public function matchemp($id){
    $sql = "SELECT * FROM `employee` WHERE id = $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
    public function matchdepemp($id){
    $sql = "SELECT * FROM `employee` WHERE `em_id` = '$id'";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
     public function matchbusinessunit($id){
    $sql = "SELECT * FROM `businessunit` WHERE id = $id";
      $this->db->where('isActive', 1);//
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
    }
       public function Getorgdep($id){
    $sql = "SELECT * FROM `org_department`
    WHERE `id`='$id' AND `isActive`= 1";
      $query=$this->db->query($sql);
    $result = $query->row();
    return $result;          
   } 
     //Email settings
    public function save_email($data){
       return $this->db->insert('email_settings',$data);
    }

    public function update_email($id,$data){
     $this->db->where('id', $id);
     return $this->db->update('email_settings',$data);        
    }  

    public function GetEmail(){
    
    $sql = "SELECT * FROM `email_settings` WHERE `isActive` = 1 And `smtp` = 'No'";
    $query=$this->db->query($sql);
    $result = $query->row();
    return $result;         
    }  
     public function GetSmtp(){
    
    $sql = "SELECT * FROM `email_settings` WHERE `isActive` = 1 And `smtp` = 'Yes'";
    $query=$this->db->query($sql);
    $result = $query->row();
    return $result;         
    }
    

    //Email Sequence
    public function save_sequence($data){
       return $this->db->insert('email_sequence_alert',$data);
    }

    public function update_sequence($id,$data){
     $this->db->where('id', $id);
     return $this->db->update('email_sequence_alert',$data);        
    }  

    public function GetEmailSequence(){
    
    $sql = "SELECT * FROM `email_sequence_alert` WHERE `isActive` = 1";
    $query=$this->db->query($sql);
    $result = $query->result();
    return $result;         
    } 

    public function GetSequenceBYID($id){
        $sql = "SELECT * FROM `email_sequence_alert` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    } 
    public function Getgovid_name($gid){
        $sql = "SELECT * FROM `govidtype` WHERE `id`='$gid'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result; 
    } 
     public function DeleteSquence($id){
        return $this->db->delete('email_sequence_alert',array('id'=> $id));        
    }
     public function BusinessUnitDelete($id){
        // $this->db->delete('leave_types',array('leavestrucid'=> $id));
        // return $this->db->delete('leavestructure',array('id'=> $id));
        $chk_sql = "SELECT businessunit.id, employee.busunit FROM 
                     businessunit LEFT JOIN employee ON employee.busunit = businessunit.id 
                    WHERE  businessunit.isActive = 1 AND employee.isActive = 1 AND businessunit.id =  $id";
            if(empty($this->db->query($chk_sql)->result())){
            $sql    = "UPDATE `businessunit` SET isActive=0 WHERE `id`='$id'";
            $query  = $this->db->query($sql);
            //$result = $query->row();
            return $query;
            }else{
              return false;
            }
      }

       public function ShiftDelete($id){
          $this->db->delete('shift_details',array('shift_id'=> $id));
          return $this->db->delete('shift_master',array('id'=> $id));
        }
        public function OrgDepartmentDelete($id){
        // $this->db->delete('leave_types',array('leavestrucid'=> $id));
        // return $this->db->delete('leavestructure',array('id'=> $id));
        $chk_sql = "SELECT org_department.id, employee.dep_id FROM 
                     org_department LEFT JOIN employee ON employee.dep_id = org_department.id 
                    WHERE  org_department.isActive = 1 AND employee.isActive = 1 AND org_department.id = $id";
            if(empty($this->db->query($chk_sql)->result())){
            $sql    = "UPDATE `org_department` SET isActive=0 WHERE `id`='$id'";
            $query  = $this->db->query($sql);
            //$result = $query->row();
            return $query;
            }else{
              return false;
            }
      }
      
    }