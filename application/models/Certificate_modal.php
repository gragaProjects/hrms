<?php

	class Certificate_modal extends CI_Model{


	function __consturct(){
	parent::__construct();
	
	}
	  //check field already exists
   public function Check_field_exists($val,$data,$table){
       $this->db->where($data);
       //$this->db->where();
       return $this->db->get($table)->num_rows();
  
    }
   
   
    
    public function businessunitselect(){
      $this->db->where('isActive', 1);//
      $query = $this->db->get('businessunit');
      $result = $query->result();
      return $result;
    }

   
     public function save_certificate_template($data) {
        $this->db->insert('certificate_template', $data);
        return $this->db->insert_id();
    }

    public function save_certificate_content($data) {
        $this->db->insert('certificate_content', $data);
        return $this->db->insert_id();
    }

    public function get_certificate_data() {
        // $this->db->select(
        //     'ct.id AS template_id,
        //      ct.busunit AS template_busunit,
        //      ct.title AS template_title,
        //      cc.id AS content_id,
        //      cc.busunit AS content_busunit,
        //      cc.template_id,
        //      cc.content,
        //      cc.created_on AS content_created_on'
        // ); 
          $this->db->select('*,ct.id AS template_id');
        $this->db->from('certificate_template ct');
        //$this->db->join('certificate_content cc', 'ct.id = cc.template_id', 'inner');
        $this->db->where('ct.isActive', 1);
      //  $this->db->where('cc.isActive', 1);

        $query = $this->db->get();
        return $query->result();
    }

    //   public function get_certificates_by_template_id($template_id) {
    //     $this->db->select('*');
    //     $this->db->from('certificate_template ct');
    //     $this->db->join('certificate_content cc', 'ct.id = cc.template_id', 'inner');
    //     $this->db->where('ct.id', $template_id);
    //     $this->db->where('ct.isActive', 1);
    //     $this->db->where('cc.isActive', 1);

    //     $query = $this->db->get();
    //     return $query->result();
    // }

     public function get_template_by_id($template_id) {
        $this->db->select('*');
        $this->db->from('certificate_template');
        $this->db->where('id', $template_id);
        $this->db->where('isActive', 1);

        $query = $this->db->get();
        return $query->row(); // Assuming you expect only one row
    }

    public function get_content_by_template_id($template_id) {
        $this->db->select('*');
        $this->db->from('certificate_content');
        $this->db->where('template_id', $template_id);
        $this->db->where('isActive', 1);

        $query = $this->db->get();
        return $query->result();
    }

    //update  modal
    public function update_template($templateId, $data) {
        $this->db->where('id', $templateId);
       return  $this->db->update('certificate_template', $data);
    }

    // public function update_content($templateId, $contentArray) {
    //     // Delete existing content for the template
    //     $this->db->where('template_id', $templateId);
    //     $this->db->delete('certificate_content');

    //     // Insert new content for the template
    //     foreach ($contentArray as $content) {
    //         $this->db->insert('certificate_content', array(
    //             'template_id' => $templateId,
    //             'content' => $content,
    //         ));
    //     }
    // }
    public function update_content($templateId, $contentArray,$busunit,$editedTitles) {
    try {
        // Delete existing content for the template
        $this->db->where('template_id', $templateId);
        $this->db->delete('certificate_content');

        // Insert new content for the template
        foreach ($contentArray as  $index => $content) {
            $this->db->insert('certificate_content', array(
                'template_id' => $templateId,
                'content' => $content,
                'busunit' => $busunit,
                  'title' => isset($editedTitles[$index]) ? $editedTitles[$index] : ''
            ));
        }

        // If everything executed without exceptions, consider it a success
        return true;
    } catch (Exception $e) {
        // Log the exception or handle it accordingly
        log_message('error', 'Error updating content: ' . $e->getMessage());

        // Return false to indicate failure
        return false;
    }
}


// delete certificate
public function delete_template($id) {
    $this->db->where('id', $id);
    $this->db->delete('certificate_template');

    // You may want to check if any rows were affected to determine success
    return $this->db->affected_rows() > 0;
}

    public function delete_content($id) {
        $this->db->where('template_id', $id);
        $this->db->delete('certificate_content');

        // You may want to check if any rows were affected to determine success
        return $this->db->affected_rows() > 0;
    }    
    public function delete_contentbyid($id) {
        $this->db->where('id', $id);
        $this->db->delete('certificate_content');

        // You may want to check if any rows were affected to determine success
        return $this->db->affected_rows() > 0;
    }


    //Pdf
      public function getTemplateData($templateId)
    {
        // Fetch template data from the database based on $templateId
        // Modify this query according to your database schema
        $query = $this->db->get_where('certificate_template', array('id' => $templateId));

        return $query->row_array();
    }

    public function getContentData($employeeId)
    {
        // Fetch content data from the database based on $employeeId
        // Modify this query according to your database schema
        $query = $this->db->get_where('certificate_content', array('template_id' => $employeeId));

        return $query->result(); //row_array
    }
    //Tage master
     public function getTags() {
        $query = $this->db->get('tags'); // Assuming your table name is 'tags'
        return $query->result();
    }

      public function Update_tags($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('tags', $data);        
    }
     public function Delete_tag($id)
    {
     return $this->db->delete('tags',array('id'=> $id));
    }
    public function Tags_edit($id){

      $sql    = "SELECT * FROM `tags` WHERE `id`='$id' ";
      $query  = $this->db->query($sql);
      $result = $query->row();
      return $result;
 }

      public function Add_tags($data){
        $query = $this->db->insert('tags',$data);
          return $query;
    }

    public function get_template_tags($template_id) {
    $this->db->select('tag_name');
    $this->db->where('template_id', $template_id);
    $query = $this->db->get('tamplate_tags');

    $existingTags = array();
    foreach ($query->result() as $row) {
        $existingTags[] = $row->tag_name;
    }

    return $existingTags;
    }
    public function save_template_tag($data) {
        $this->db->insert('tamplate_tags', $data);
    }
   // 9-12-23
    public function get_template_by_busunit($busunit) {
        $this->db->select('*');
        $this->db->from('certificate_template');
        $this->db->where('busunit', $busunit);
        $this->db->where('isActive', 1);

        $query = $this->db->get();
        return $query->result();
    }
   // 9-12-23
    public function getTemplateTags($templateId) {
    $this->db->select('tag_name');
    $this->db->where('template_id', $templateId);
    $query = $this->db->get('tamplate_tags');

    return $query->result();
   }

   public function getDynamicData($empId, $templateId)
    {
        $this->db->select('tag_name, tag_value');
        $this->db->from('emp_template');
        $this->db->where('emp_id', $empId);
        $this->db->where('template_id', $templateId);
        $query = $this->db->get();

        return $query->result();
   }
   public function getExistingData($empId, $templateId)
{
    $query = $this->db->get_where('emp_template', array(
        'emp_id' => $empId,
        'template_id' => $templateId,
    ));

    return $query->result();
}
  public function get_header_footer() {
        $this->db->select('*');
        $this->db->from('template_default');
     
        $this->db->where('isActive', 1);

        $query = $this->db->get();
        return $query->result();
    }  
    public function get_header_footerby_id($id){
        $this->db->select('*');
        $this->db->from('template_default');
        $this->db->where('id', $id);
        $this->db->where('isActive', 1);

        $query = $this->db->get();
        return $query->row();
    } 
    public function get_header_footerby_busunit($id){
        $this->db->select('*');
        $this->db->from('template_default');
        $this->db->where('busunit', $id);
        $this->db->where('isActive', 1);

        $query = $this->db->get();
        return $query->row();
    }
    //Delete_tem_header
      public function Delete_tem_header($id)
      {
       return $this->db->delete('template_default',array('id'=> $id));
       }

}