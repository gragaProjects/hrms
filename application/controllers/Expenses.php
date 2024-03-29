
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expenses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('login_model');
		$this->load->model('dashboard_model');
		$this->load->model('employee_model');
		$this->load->model('loan_model');
		$this->load->model('settings_model');
		$this->load->model('leave_model');
		$this->load->model('expense_model');
	}

	public function ViewExpences()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$data['employee'] = $this->employee_model->emselect();
			$data['expenseview'] = $this->expense_model->expense_modeldata();
			//$data['expensesbyid'] = $this->expense_model->expense_modeldatabyid($id);
			$this->load->view('backend/expenses_list', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
    public function ApplyExpences()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $data['employee'] = $this->employee_model->emselect();
            $data['loanview'] = $this->loan_model->loan_pendingdata();
            $data['expenseselect'] = $this->expense_model->expense_category();
             $data['currency'] = $this->employee_model->GetcurrenyValue();
            $this->load->view('backend/add_expenses_claim', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function view(){

    	 if ($this->session->userdata('user_login_access') != false) {
            
            $id = $this->input->get('I');
           
            $data['expenses'] = $this->expense_model->getexpensebyid($id);
            $data['expense_data'] = $this->expense_model->getexpensedatabyid($id);
            $data['expensefiles'] = $this->expense_model->getexpensefilesbyid($id);
            $data['expenseselect'] = $this->expense_model->expense_category();
             $data['currency'] = $this->employee_model->GetcurrenyValue();
            $this->load->view('backend/view_expenses_claim', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }   
     public function Edit(){

    	 if ($this->session->userdata('user_login_access') != false) {
            
            $id = $this->input->get('I');

            $data['expenses'] = $this->expense_model->getexpensebyid($id);
            $data['expense_data'] = $this->expense_model->getexpensedatabyid($id);
            $data['expensefiles'] = $this->expense_model->getexpensefilesbyid($id);
            $data['expenseselect'] = $this->expense_model->expense_category();
              $data['currency'] = $this->employee_model->GetcurrenyValue();
            $this->load->view('backend/edit_expenses_claim', $data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

      public function download_zip()
	  {
	    // Load the Zip library
	    $this->load->library('zip');
	    $id = $this->input->get('I');
	    // Add files to the zip archive
	     $data['expensefiles'] = $this->expense_model->getexpensefilesbyid($id);
	     foreach ($data['expensefiles'] as $file) {
	        $file_path = '.'.$file->file_path;
	        $file_contents = file_get_contents($file_path);
	        $this->zip->add_data($file->file_name, $file_contents);
	    }
	     // print_r($file->first_name);die();
	    // Create the zip file
	    $zip_file = strtolower($file->first_name).'_expenses_document.zip';
	    $this->zip->archive($zip_file);
	    
	    // Download the zip file
	    $this->load->helper('download');
	    force_download($zip_file, NULL);
	  }

	  // Save

	public function Save_Expenses(){
     if ($this->session->userdata('user_login_access') != false) {
            extract($_POST);
            // if (!empty($_FILES['files']['name'])) {
            // print_r($_FILES['files']['name']);die();
            // }
         $emp_id = $this->input->post('emid');
 
        
        $data1 = array(
	  
	    'expense_category' => $expense_category,
	    'details' => $details,
	    'amount' => $amount,
	    'total_amount' => $total_amount
	    
        );

     

	    // Prepare data for insertion
	     $data = array(
	        
	        'emp_id' => $emp_id,
	        'comments' => $comments,
	        'total_amount' => $total_amount,
	        'status' => 'Pending',
	        'submited_date' => date('Y-m-d')
	    );
	    // Insert data into database
	    $result1 = $this->db->insert('expenses', $data);
	    
      if( $result1)
      {
      	// Get the inserted ID
	    $expense_id = $this->db->insert_id();

	    //cateroy details
	    
	        $expense_category = $this->input->post('expense_category');
	        $details = $this->input->post('details');
	        $amount = $this->input->post('amount');
	        $total_amount = $this->input->post('total_amount');

     
	         $currency = $this->input->post('currency');
			  $receipt = $this->input->post('receipt');
			 $expense_date = $this->input->post('expense_date');

	    //multiple inputs
		foreach($expense_category as $index => $value)
		{
		$s_expense_category = $value;
					$s_amount = $amount[$index];
					$s_details = $details[$index];
					$s_currency = $currency[$index];
					$s_receipt = $receipt[$index];
					$s_expense_date = $expense_date[$index];
					$s_name = $_FILES['files']['name'][$index];

	
		//$result2 = $this->db->insert('expenses_data', $data2);
       //}

     //files
    // Define the file upload path
 
    if (!empty($_FILES['files']['name'])) {
	 if (isset($_FILES['files'])) {

	 	           $upload_path = './assets/uploads/temp/';
	 	           $file_path = '/assets/uploads/temp/';

	 	           // Create directory if it does not exist
				    if (!is_dir($upload_path)) {
				      mkdir($upload_path, 0777, true);
				    }
				    //print_r($_FILES['files']['name']);
			      // handle file uploads
			      foreach ($_FILES['files']['name'] as $key => $name) {
			         if ($_FILES['files']['error'][$key] == UPLOAD_ERR_OK) {
			            $tmp_name = $_FILES['files']['tmp_name'][$key];
			            $destination = './assets/uploads/temp/' . $name;
			            move_uploaded_file($tmp_name, $destination);
			         }
			       }

			          $insert_data = array(
				        'emp_id' => $emp_id,
				        'expense_id' => $expense_id,
				        'file_name' => $name,
				        'file_path' => $file_path.'/'.$name
				      );

				      $data2 = array(
					'emp_id' => $emp_id,
					'expense_id' => $expense_id,
					'expense_category' => $s_expense_category,
					'details' => $s_details,
					'amount' => $s_amount,
					'total_amount' => $total_amount,
					'currency' => $s_currency,
					'receipt' => $s_receipt,
					'expense_date' => $s_expense_date,
					'file_name' => $s_name,
				     'file_path' => $file_path.'/'.$s_name
					

					);

				     // print_r($insert_data);die();
				   // $result3 =  $this->db->insert('expense_files', $insert_data);
				    $result2 = $this->db->insert('expenses_data', $data2);
			      }
			     
		  }else{

		  }
		}
    

      

      }
	    if($result1 || $result2 || $result3){
	    	echo json_encode(array('status'=>'success','message'=>"Expenses Added Successfully"));

	    	 /*Notification*/
            // Retrieve data from the employee table
            $emp_Data = $this->expense_model->getempbyid($emp_id);
            //admin
            $getAdmin = $this->expense_model->getadmin();
            $admin_id =  $getAdmin->em_id;
            //get bus unit id
            $getbusunit = $this->expense_model->getbusunitid($emp_id);
            $busunit_id = $getbusunit->busunit;
            //get hr
            $getHR =  $this->expense_model->Emplist_hr($busunit_id);
            $hr_id =  $getHR->hr;

            $employees = array(
			    array(
			        'id' => 'hr_id',
			        'em_id' => $hr_id
			    ),
			    array(
			        'id' => 'admin_id',
			        'em_id' => $admin_id
			    )
			);

		
			    $filetitle = 'New Claim Request: <span class="txt-name" style="font-weight:bold">'.$emp_Data->first_name .' '.$emp_Data->last_name.'</span>.';       
            foreach ($employees as $employee) {
            $data = array(
            'user_id' => $employee['em_id'],
            'message' => $filetitle,
            'status' => 'unread'
            );
            $this->db->insert('notifications', $data);
            }
           // die();
	    }

            
        } else {
            redirect(base_url(), 'refresh');
        }
	}	



	public function Update_Expenses(){
      if ($this->session->userdata('user_login_access') != false) {
            extract($_POST);
            // if (!empty($_FILES['files']['name'])) {
            // print_r($_FILES['files']['name']);die();
            // }
         $emp_id = $this->input->post('emid');
 
          $expense_id = $this->input->post('id');

        $data1 = array(
	  
	    'expense_category' => $expense_category,
	    'details' => $details,
	    'amount' => $amount,
	    'total_amount' => $total_amount
	    
        );

     

	    // Prepare data for insertion
	     $data = array(
	        
	        'emp_id' => $emp_id,
	        'comments' => $comments,
	        'total_amount' => $total_amount,
	        'status' => 'Pending',
	        'submited_date' => date('Y-m-d')
	    );
	    // Insert data into database
	     $this->db->where('id', $expense_id);
        $result1 =  $this->db->update('expenses', $data);    
	     //$this->db->insert('expenses', $data);
	    
      if( $result1)
      {
        $id = $this->input->post('id');
      	/*Delete old data*/
      	 // $datas = $this->db->get_where('expenses_data',array('expense_id'=> $id))->result();

	     //  // Loop through the data using a foreach loop
	     //  foreach ($datas as $row) {
	     //      // Get the filename from the database row
	     //      $filename = $row->file_name;

	     //      // Check if the file exists
	     //      if (file_exists('./assets/uploads/temp/' . $filename)) {
	     //          // Delete the file
	     //          unlink('./assets/uploads/temp/' . $filename);
	     //      }
	     //  }
	     // $this->db->delete('expense_files',array('expense_id'=> $id)); 
	      $this->db->delete('expenses_data',array('expense_id'=> $id));

      /**/

	    //cateroy details
	    
	        $expense_category = $this->input->post('expense_category');
	        $details = $this->input->post('details');
	        $amount = $this->input->post('amount');
	        $total_amount = $this->input->post('total_amount');

     
	         $currency = $this->input->post('currency');
			  $receipt = $this->input->post('receipt');
			 $expense_date = $this->input->post('expense_date');

	    //multiple inputs
		foreach($expense_category as $index => $value)
		{
		$s_expense_category = $value;
					$s_amount = $amount[$index];
					$s_details = $details[$index];
					$s_currency = $currency[$index];
					$s_receipt = $receipt[$index];
					$s_expense_date = $expense_date[$index];
					$s_name = $_FILES['files']['name'][$index];
 
		    if (!empty($_FILES['files']['name'])) {
			 if (isset($_FILES['files'])) {

	 	           $upload_path = './assets/uploads/temp/';
	 	           $file_path = '/assets/uploads/temp/';

	 	           // Create directory if it does not exist
				    if (!is_dir($upload_path)) {
				      mkdir($upload_path, 0777, true);
				    }
				    //print_r($_FILES['files']['name']);
			      // handle file uploads
			      foreach ($_FILES['files']['name'] as $key => $name) {
			         if ($_FILES['files']['error'][$key] == UPLOAD_ERR_OK) {
			            $tmp_name = $_FILES['files']['tmp_name'][$key];
			            $destination = './assets/uploads/temp/' . $name;
			            move_uploaded_file($tmp_name, $destination);
			         }
			       }

			          $insert_data = array(
				        'emp_id' => $emp_id,
				        'expense_id' => $expense_id,
				        'file_name' => $name,
				        'file_path' => $file_path.'/'.$name
				      );

				      $data2 = array(
					'emp_id' => $emp_id,
					'expense_id' => $expense_id,
					'expense_category' => $s_expense_category,
					'details' => $s_details,
					'amount' => $s_amount,
					'total_amount' => $total_amount,
					'currency' => $s_currency,
					'receipt' => $s_receipt,
					'expense_date' => $s_expense_date,
					'file_name' => $s_name,
				     'file_path' => $file_path.'/'.$s_name
					

					);

				     // print_r($insert_data);die();
				   // $result3 =  $this->db->insert('expense_files', $insert_data);
				    $result2 = $this->db->insert('expenses_data', $data2);
			      }
			     
		  }else{

		  }
		}
    

      

      }
	    if($result1 || $result2 || $result3){
	    	echo json_encode(array('status'=>'success','message'=>"Expenses Updated Successfully"));
	    }

            
        } else {
            redirect(base_url(), 'refresh');
        }
	}

	 public function expenses_status(){
      $id = $this->input->post('id');
      $status = $this->input->post('status');
      $approved_date = date('Y-m-d');//$this->input->post('approved_date');

      if($status == 'Accepted'){
        $data = array( 'status' => $status,'approved_date'=>$approved_date ); 
      }else{
         
           $data = array( 'status' => $status); 
      }
     
        $success = $this->expense_model->expenses_status($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //} 
    
     }

       public function Expenses_delete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->expense_model->Expenses_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
               
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //expenses_category

    public function Expenses_category()
	{
		if ($this->session->userdata('user_login_access') != false) {
			$data['employee'] = $this->employee_model->emselect();
			$data['expenseselect'] = $this->expense_model->expense_category();
			$this->load->view('backend/expenses_category', $data);
		} else {
			redirect(base_url(), 'refresh');
		}
	}
	public function Expenses_category_edit(){
	if($this->session->userdata('user_login_access') != False) {
	$id = $this->uri->segment(3);//
	$data['expenseselect'] = $this->expense_model->expense_category();
	$data['typevalue_edit'] = $this->expense_model->expense_category_edit($id);
	$this->load->view('backend/expenses_category',$data);
	}
	else{
	redirect(base_url() , 'refresh');
	}
	}

	public function Add_Expenses_category(){
	if($this->session->userdata('user_login_access') != False) {
	$id = $this->input->post('id');
	$type = $this->input->post('category');
	$this->load->library('form_validation');
	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	$this->form_validation->set_rules('category',' category','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
	if ($this->form_validation->run() == FALSE) {
	$error = validation_errors();
	echo json_encode(array('error'=>$error));
	}else{
	$val = $type;
	$table = 'expenses_category';
	$data = array('category'=> $val,'isActive'=> 1);
	if($this->settings_model->Check_field_exists($val,$data,$table)){
	echo json_encode(array('error'=>'<p>This category  is already exists</p>'));
	} else{
	$data = array();
	$data = array(
	'category' => $type
	);
	$success = $this->expense_model->Add_expense_category($data);
	if($success){
	echo json_encode(array('status'=>'success','message'=>'Successfully Added','data'=>'$success'));
	}

	}

	}
	}
	else{
	redirect(base_url() , 'refresh');
	}
	}
	public function Update_Expenses_category(){
	if($this->session->userdata('user_login_access') != False) {
	$id = $this->input->post('id');
	$type = $this->input->post('category');
	$this->form_validation->set_rules('category', 'category', 'trim|required');
	if ($this->form_validation->run() == FALSE)
	{
	$error = validation_errors();
	echo json_encode(array('error'=>$error));
	}else{
	$data = array(
	'category' => $type
	);
	$success = $this->expense_model->Update_expense_category($id,$data);
	if($success){
	echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
	}

	}

	}
	else{
	redirect(base_url() , 'refresh');
	}
	}
	public function Delete_Expenses_category(){
	if($this->session->userdata('user_login_access') != False) {
	$id = $this->input->post('id');
	$result_del = $this->expense_model->expense_categorydelete($id);//
	if($result_del){
	echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));

	}

	}
	else{
	redirect(base_url() , 'refresh');
	}
	}

}
?>