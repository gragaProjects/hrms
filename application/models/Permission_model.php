<?php

	class Permission_model extends CI_Model{

	   public function category($role_id) { //$role_id = null
        $this->db->select()->from('permission_category');
        $this->db->order_by('permission_category.id');

        $query = $this->db->get();
        $result = $query->result();
       // return  $result;
             foreach ($result as $key => $value) {
              $group_id = $value->id;
            $value->permission_category = $this->getPermissions($group_id, $role_id);
        }
        return $result;
    }

    public function getPermissions($group_id, $role_id) {
        //echo $group_id;
        //$role_id = 2;
        $sql = "SELECT permission_subcategory.*,IFNULL(roles_permissions.id,0) as `roles_permissions_id`,roles_permissions.can_view,roles_permissions.can_add ,roles_permissions.can_edit ,roles_permissions.can_delete FROM `permission_subcategory` LEFT JOIN `roles_permissions` on permission_subcategory.id = roles_permissions.sub_id and roles_permissions.role_id= '$role_id' WHERE permission_subcategory.cat_id = '$group_id'  ORDER BY `permission_subcategory`.`id`";/* ORDER BY `permission_subcategory`.`id`*/
        $query = $this->db->query($sql);

        return $query->result();
    }



    public function roleselect($roleid){
    	$data = array('isActive'=> 1,'id'=>$roleid);
        $this->db->where($data);
      $query = $this->db->get('role');
      $result = $query->row();
      return $result;
    }

     public function getInsertBatch($role_id, $to_be_insert = array(), $to_be_update = array(), $to_be_delete = array()) {

        /*$this->db->trans_start();
        $this->db->trans_strict(FALSE);*/
        if (!empty($to_be_insert)) {
            $this->db->insert_batch('roles_permissions', $to_be_insert);
        }
        if (!empty($to_be_update)) {

            $this->db->update_batch('roles_permissions', $to_be_update, 'id');
        }
         if (!empty($to_be_delete)) {
         //print_r($to_be_delete);die();

            foreach ($to_be_delete as $row)
            {
                $userIds[] = $row;
                
               $this->db->where('id', $row);
            
              $res = $this->db->delete('roles_permissions');
            }

              //$this->db->where('id', $userIds);
            
               $res;
        }
    }

    public function Check_User($role_id,$category,$permission){

         if ($this->session->userdata('user_login_access') == 1){

             $sql = "SELECT roles_permissions.role_id,role.role,permission_subcategory.id,permission_subcategory.sub_name,permission_subcategory.sub_shortcode,IFNULL(roles_permissions.id,0) AS `roles_permissions_id`,roles_permissions.can_view,roles_permissions.can_add ,roles_permissions.can_edit ,roles_permissions.can_delete FROM `permission_subcategory` 
                    LEFT JOIN roles_permissions ON permission_subcategory.id = roles_permissions.sub_id 
                    LEFT JOIN role ON role.id = roles_permissions.role_id  

                    WHERE roles_permissions.role_id= '$role_id' AND role.id = '$role_id' AND sub_shortcode = '$category' AND `$permission` = 1
                     AND roles_permissions.isActive= '1' AND role.isActive= '1' AND permission_subcategory.isActive= '1'  ORDER BY `permission_subcategory`.`id`";
                $query = $this->db->query($sql);

                $result = $query->row();
                 return  $result;
         }
    }

     /* public function Check_User($role_id){

         if ($this->session->userdata('user_login_access') == 1){

             $sql = "SELECT roles_permissions.role_id,role.role,employee.em_role,employee.first_name,permission_subcategory.id,permission_subcategory.sub_name,permission_subcategory.sub_shortcode,IFNULL(roles_permissions.id,0) AS `roles_permissions_id`,roles_permissions.can_view,roles_permissions.can_add ,roles_permissions.can_edit ,roles_permissions.can_delete FROM `permission_subcategory`  
                 LEFT JOIN roles_permissions ON permission_subcategory.id = roles_permissions.sub_id 
                LEFT JOIN role ON role.id = roles_permissions.role_id  
                LEFT JOIN employee ON employee.em_role = roles_permissions.role_id
                WHERE roles_permissions.role_id= '$role_id' AND role.id = '$role_id' AND employee.em_role = '$role_id'
                 AND roles_permissions.isActive= '1' AND role.isActive= '1'  AND employee.isActive= '1' AND permission_subcategory.isActive= '1' ORDER BY `permission_subcategory`.`id`";
                $query = $this->db->query($sql);

                return $query->result();
         }
    }*/
 
	}

