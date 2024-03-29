<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    
	    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
        $this->load->model('employee_model'); 
        $this->load->model('project_model'); 
        $this->load->model('settings_model'); 
        $this->load->model('leave_model'); 
          $this->load->model('organization_model');
          $this->load->model('notice_model');
    }
    public function index(){
		#Redirect to Admin dashboard after authentication
        if ($this->session->userdata('user_login_access') == 1)
            redirect('dashboard/Dashboard');
            $data=array();
            #$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
			$this->load->view('login');        
    }
    public function Settings(){
        if($this->session->userdata('user_login_access') != False) { 
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $this->load->view('backend/settings',$data);
        }
    else{
		redirect(base_url() , 'refresh');
	}            
    }
    public function Add_Settings(){ 
        if($this->session->userdata('user_login_access') != False) { 
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $copyright = $this->input->post('copyright');
        $contact = $this->input->post('contact');
        $currency = $this->input->post('currency');
        $symbol = $this->input->post('symbol');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $address2 = $this->input->post('address2');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        // Validating Title Field
        $this->form_validation->set_rules('title', 'title','trim|required|min_length[5]|max_length[60]|xss_clean');
        // Validating description Field
        $this->form_validation->set_rules('description', 'description', 'trim|required|min_length[20]|max_length[512]|xss_clean');
        // Validating address Field
        $this->form_validation->set_rules('address', 'address', 'trim|min_length[5]|max_length[600]|xss_clean');
        $this->form_validation->set_rules('address2', 'address2', 'trim|min_length[5]|max_length[600]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			} else {

            if($_FILES['img_url']['name']){
			$settings = $this->settings_model->GetSettingsValue();
            $file_name = $_FILES['img_url']['name'];
			$fileSize = $_FILES["img_url"]["size"]/1024;
			$fileType = $_FILES["img_url"]["type"];
/*			$new_file_name='';
            $new_file_name .= $title;*/
			$checkimage = "./assets/images/$settings->sitelogo";

            $config = array(
                'file_name' => $file_name,
                'upload_path' => "./assets/images/",
                'allowed_types' => "gif|jpg|png|jpeg|svg",
                'overwrite' => False,
                'max_size' => "13038", // Can be set to particular file size , here it is 220KB(220 Kb)
                'max_height' => "850",
                'max_width' => "850"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('img_url')) {
            echo $this->upload->display_errors();
			}
			else {
				if(file_exists($checkimage)){
            	unlink($checkimage);
				}
                $path = $this->upload->data();
                $img_url =$path['file_name'];
                $data = array();
                $data = array(
                    'sitelogo' => $img_url,
                    'sitetitle' => $title,
                    'description' => $description,
                    'copyright' => $copyright,
                    'contact' => $contact,
					'currency' => $currency,
					'symbol' => $symbol,
					'system_email'=>$email,
                    'address'=>$address,
					'address2'=>$address2
                );
            $success = $this->settings_model->SettingsUpdate($id,$data);
			echo 'Successfully Updated';
                #redirect("settings/Settings");
            #$this->session->set_flashdata('feedback','Successfully Updated');    
			}
        } else {
                $data = array();
                $data = array(
                    'sitetitle' => $title,
                    'description' => $description,
                    'copyright' => $copyright,
                    'contact' => $contact,
					'currency' => $currency,
                    'symbol' => $symbol,
					'system_email'=>$email,
                    'address'=>$address,
					'address2'=>$address2,
                );
            $success = $this->settings_model->SettingsUpdate($id,$data);
			echo 'Successfully Updated';
                #redirect("settings/Settings");
            #$this->session->set_flashdata('feedback','Successfully Updated');     
            }
		}
        
        }
    else{
		redirect(base_url() , 'refresh');
	}
 }
    //organisation info
    public function Organisation_Settings(){
        if($this->session->userdata('user_login_access') != False) { 
         $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['leavestruc'] = $this->leave_model->Getleavestructure();
        $data['holidaystruc'] = $this->leave_model->GetAllHolistructure();
        $this->load->view('backend/Organisation_Settings',$data);
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }   
    public function Country(){
        if($this->session->userdata('user_login_access') != False) { 
         $data['country_veiw'] = $this->settings_model->countryselect();
        $this->load->view('backend/country',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
    }

    public function Save_Country(){
        if($this->session->userdata('user_login_access') != False) { 
           $country_name = $this->input->post('country_name');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('country_name','country name','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $country_name;
            $table = 'country';
            $data = array('country_name'=> $val,'isActive'=> 1);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This Country is already exists</p>'));
            } else{
            $data = array();
            $data = array('country_name' => $country_name);
            $country_success = $this->settings_model->Add_Country($data);//
            if($country_success){
                echo json_encode(array('status'=>'success','country_success'=>$country_success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_Country(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $country_name = $this->input->post('country_name');
            $this->form_validation->set_rules('country_name', 'country name', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('country_name' => $country_name );
            $dep_result = $this->settings_model->Update_country($id, $data);//
            if( $dep_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_Country(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->country_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This Country Already Used In State'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function Country_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $dep = $this->uri->segment(3);//
            $data['country_veiw'] = $this->settings_model->countryselect();
            $data['country_data'] =$this->settings_model->country_edit($dep);//
         
            $this->load->view('backend/country', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
      
      public function State(){
        if($this->session->userdata('user_login_access') != False) {
        $data['countryvalue'] = $this->settings_model->countryselect(); 
         $data['state_veiw'] = $this->settings_model->stateselect();
        $this->load->view('backend/state',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
    }
     public function Save_state(){
        if($this->session->userdata('user_login_access') != False) { 
           $country = $this->input->post('country');
           $state_name = $this->input->post('state_name');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('state_name','state name','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $state_name;
            $table = 'state';
            $data = array('state_name'=> $val,'isActive'=> 1);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This State is already exists</p>'));
            } else{
            $data = array();
            $data = array('country_id'=>$country,'state_name' => $state_name);
            $state_success = $this->settings_model->Add_State($data);//
            if($state_success){
                echo json_encode(array('status'=>'success','state_success'=>$state_success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function State_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $state = $this->uri->segment(3);//
            $data['countryvalue'] = $this->settings_model->countryselect(); 
           $data['state_veiw'] = $this->settings_model->stateselect();
            $data['state_data'] =$this->settings_model->state_edit($state);//
         
            $this->load->view('backend/state', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     public function Update_state(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $state_name = $this->input->post('state_name');
            $country = $this->input->post('country');
            $this->form_validation->set_rules('state_name', 'state_name', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('country_id' => $country,'state_name' => $state_name );
            $state_result = $this->settings_model->Update_state($id, $data);//
            if( $state_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_state(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->state_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This State Already Used In District'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //get state
    public  function get_match_state(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('country');
            //$id = 1;
             $result = $this->settings_model->get_match_state($id);

               $str='';
               if($result > 0){
                    $str.="<option value='' selected>Select State</option>";
                foreach ($result as $value){
                
                   $str.="<option value=".$value->id.">".$value->state_name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    }    
    //get district
    public  function get_match_district(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('state');
            //$id = 1;
             $result = $this->settings_model->get_match_district($id);

               $str='';
               if($result > 0){
                    $str.="<option value='' selected>Select District</option>";
                foreach ($result as $value){
                
                   $str.="<option value=".$value->id.">".$value->district_name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    }  
      //get city
    public  function get_match_city(){
       if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('district');
            //$id = 1;
             $result = $this->settings_model->get_match_city($id);

               $str='';
               if($result > 0){
                 $str.="<option value='' selected>Select City</option>";
                foreach ($result as $value){
                   
                  
                   $str.="<option value=".$value->id.">".$value->city_name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
             

    }
    }
    //organisation info
      public function Update_organisation(){

           if($this->session->userdata('user_login_access') != False) {
                    $user=$this->session->userdata('user_login_id');
                    $id = $this->input->post('id');
                    $organisation = $this->input->post('organisation');
                    $domain = $this->input->post('domain');
                    $website = $this->input->post('website');
                    $startedon = $this->input->post('startedon');
                    $address = $this->input->post('address');
                    $country = $this->input->post('country');
                    $state = $this->input->post('state');

                     $district = $this->input->post('district');
                     
                    $primarynum = $this->input->post('primarynum');
                    $secondarynum = $this->input->post('secondarynum');

                    $email = $this->input->post('email');
                    $city = $this->input->post('city');
                    $fax = $this->input->post('fax');
                    $pobox = $this->input->post('pobox');
                    $zipcode = $this->input->post('zipcode');

                    $currency = $this->input->post('currency');
                    $symbol = $this->input->post('symbol');

                    $holidaystructureid = $this->input->post('holidaystructureid');
                    $leavestructureid = $this->input->post('leavestructureid');

                    $smtp = $this->input->post('smtp');



                    if($_FILES['logo']['name']){
                    //$settings = $this->settings_model->GetSettingsValue();
                    $file_name = $_FILES['logo']['name'];
                    $fileSize = $_FILES["logo"]["size"]/1024;
                    $fileType = $_FILES["logo"]["type"];
        /*          $new_file_name='';
                    $new_file_name .= $title;*/
                    //$checkimage = "./assets/images/$settings->sitelogo";

            $config = array(
                'file_name' => $file_name,
                'upload_path' => "./assets/uploads/logo",
                'allowed_types' => "gif|jpg|png|jpeg|svg",
                'overwrite' => False,
                'max_size' => "13038", // Can be set to particular file size , here it is 220KB(220 Kb)
                'max_height' => "850",
                'max_width' => "850"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('logo')) {
            echo $this->upload->display_errors();
            }
            else {
                if(empty($id)){
               $path = $this->upload->data();
                $img_url =$path['file_name'];
                $data = array();
                $data = array(
                     
                    'organisation' => $organisation,
                    'domain' => $domain,
                    'website' => $website,
                    'startedon' => $startedon,
                    'address' => $address,
                    'country' => $country,
                    'state' => $state,
                    'district' => $district,
                    'primarynum' => $primarynum,
                    'secondarynum' => $secondarynum,
                    'logo'=>$img_url,
                    'email'=>$email,
                    'city'=>$city,
                    'fax'=>$fax,
                    'pobox'=>$pobox,
                    'zipcode'=>$zipcode,
                    'currency'=>$currency,
                    'symbol'=>$symbol,
                   
                    'smtp'=>$smtp


                );
                $success = $this->settings_model->Add_organisation($data);
               if($success){
                       echo json_encode(array('status'=>'success','message'=>'Successfully Added')); 
                       }  
               }
                else{
               /* if(file_exists($checkimage)){
                unlink($checkimage);
                }*/
                $path = $this->upload->data();
                $img_url =$path['file_name'];
                $data = array();
                $data = array(
                     
                    'organisation' => $organisation,
                    'domain' => $domain,
                    'website' => $website,
                    'startedon' => $startedon,
                    'address' => $address,
                    'country' => $country,
                    'state' => $state,
                    'district' => $district,
                    'primarynum' => $primarynum,
                    'secondarynum' => $secondarynum,
                    'logo'=>$img_url,
                    'email'=>$email,
                    'city'=>$city,
                    'fax'=>$fax,
                    'pobox'=>$pobox,
                    'zipcode'=>$zipcode,
                    'currency'=>$currency,
                    'symbol'=>$symbol,
                    'smtp'=>$smtp


                );
            $success = $this->settings_model->Update_organisation($id,$data);
           if($success){
                   echo json_encode(array('status'=>'success','message'=>'Successfully Updated')); 
                   }  
               }
            }
           } else{
                  $data = array();
                $data = array(
                    
                    'organisation' => $organisation,
                    'domain' => $domain,
                    'website' => $website,
                    'startedon' => $startedon,
                    'address' => $address,
                    'country' => $country,
                    'state' => $state,
                    'district' => $district,
                    'primarynum' => $primarynum,
                    'secondarynum' => $secondarynum,
                    'email'=>$email,
                    'city'=>$city,
                    'fax'=>$fax,
                    'pobox'=>$pobox,
                    'zipcode'=>$zipcode,
                    'currency'=>$currency,
                    'symbol'=>$symbol,
                       'smtp'=>$smtp

                    
                );
               
                    $success = $this->settings_model->Update_organisation($id,$data);
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>'Successfully Updated')); 
                   
             
                  } 
        
            }


        
          
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

    }

    //district

     public function District(){
        if($this->session->userdata('user_login_access') != False) {
        $data['countryvalue'] = $this->settings_model->countryselect(); 
         $data['state_veiw'] = $this->settings_model->stateselect();
          $data['district_veiw'] = $this->settings_model->districtselect();
         // $data['city_veiw'] = $this->settings_model->cityselect();
        $this->load->view('backend/district',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
      } 
    public function District_edit(){
        if($this->session->userdata('user_login_access') != False) { 
            $district = $this->uri->segment(3);//
            $data['countryvalue'] = $this->settings_model->countryselect(); 
            $data['state_veiw'] = $this->settings_model->stateselect();
            //$data['city_veiw'] = $this->settings_model->cityselect();
            $data['district_veiw'] = $this->settings_model->districtselect();
            $data['district_data'] =$this->settings_model->district_edit($district);//
         
            $this->load->view('backend/district', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }           
      }//Save_district

       public function  Save_district(){
       if($this->session->userdata('user_login_access') != False) { 
           $country = $this->input->post('country');
           $state = $this->input->post('state');
           $district_name = $this->input->post('district_name');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('district_name','District name','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $district_name;
            $table = 'district';
            $data = array('district_name'=> $val,'isActive'=> 1);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This District is already exists</p>'));
            } else{
            $data = array();
            $data = array('country_id'=>$country,'state_id'=>$state,'district_name' => $district_name);
            $state_success = $this->settings_model->Add_District($data);//
            if($state_success){
                echo json_encode(array('status'=>'success','state_success'=>$state_success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }
      }

      public function Update_district(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            $city_name = $this->input->post('city_name');
            $district_name = $this->input->post('district_name');
            $this->form_validation->set_rules('district_name', 'District name', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('country_id' => $country,'state_id' => $state,'district_name' => $district_name );
            $state_result = $this->settings_model->Update_district($id, $data);//
            if( $state_result){
            echo json_encode(array('status'=>'success','message'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
       public function Delete_district(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->district_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This District Already Used In City'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
   
    //city
      public function City(){
        if($this->session->userdata('user_login_access') != False) {
        $data['countryvalue'] = $this->settings_model->countryselect(); 
         $data['state_veiw'] = $this->settings_model->stateselect();
          $data['city_veiw'] = $this->settings_model->cityselect();
        $this->load->view('backend/city',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
      } 
      public function city_edit(){
        if($this->session->userdata('user_login_access') != False) { 
            $city = $this->uri->segment(3);//
            $data['countryvalue'] = $this->settings_model->countryselect(); 
            $data['state_veiw'] = $this->settings_model->stateselect();
            $data['city_veiw'] = $this->settings_model->cityselect();
            $data['city_data'] =$this->settings_model->city_edit($city);//
         
            $this->load->view('backend/city', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }           
      }
      public function  save_city(){
       if($this->session->userdata('user_login_access') != False) { 
           $country = $this->input->post('country');
           $state = $this->input->post('state');
           $city_name = $this->input->post('city_name');
           $district = $this->input->post('district');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('city_name','city name','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $city_name;
            $table = 'city';
            $data = array('city_name'=> $val,'isActive'=> 1);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This City is already exists</p>'));
            } else{
            $data = array();
            $data = array('country_id'=>$country,'state_id'=>$state,'district_id'=>$district,'city_name' => $city_name);
            $state_success = $this->settings_model->Add_City($data);//
            if($state_success){
                echo json_encode(array('status'=>'success','state_success'=>$state_success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }
      }
      public function Update_city(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            $district = $this->input->post('district');
            $city_name = $this->input->post('city_name');
            $this->form_validation->set_rules('city_name', 'city name', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('country_id' => $country,'state_id' => $state,'district_id'=>$district,'city_name' => $city_name );
            $state_result = $this->settings_model->Update_city($id, $data);//
            if( $state_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_city(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->city_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This city Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
    //timezone
      public function timezone(){
        if($this->session->userdata('user_login_access') != False) { 
         $data['timezone_veiw'] = $this->settings_model->timezoneselect();
        $this->load->view('backend/timezone',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
    }
    public function Save_timezone(){
        if($this->session->userdata('user_login_access') != False) { 
           $timezone = $this->input->post('timezone');
           //$depval = $this->input->post('depval');
           $this->load->library('form_validation');
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
           $this->form_validation->set_rules('timezone','timezone','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
           if ($this->form_validation->run() == FALSE) {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
           }else{
            $val = $timezone;
            $table = 'timezone';
            $data = array('timezone'=> $val,'isActive'=> 1);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This timezone is already exists</p>'));
            } else{
            $data = array();
            $data = array('timezone' => $timezone);
            $timezone_success = $this->settings_model->Add_timezone($data);//
            if($timezone_success){
                echo json_encode(array('status'=>'success','message'=>$timezone_success));
              }
          
            }
         
           }
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }

    public function Update_timezone(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
               $timezone = $this->input->post('timezone');
            $this->form_validation->set_rules('timezone', 'timezone', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
               $error = validation_errors();
               echo json_encode(array('error'=>$error));
            }else{
            $data =  array('timezone' => $timezone );
            $dep_result = $this->settings_model->Update_timezone($id, $data);//
            if( $dep_result){
            echo json_encode(array('status'=>'success','update'=> 'Successfully Updated'));
             }

            }
          
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }



    public function Delete_timezone(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->timezone_delete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','dep_delsuccess'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Country Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

    public function timezone_edit($dep){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->uri->segment(3);//
           $data['timezone_veiw'] = $this->settings_model->timezoneselect();
            $data['timezone_data'] =$this->settings_model->timezone_edit($id);//
         
            $this->load->view('backend/timezone', $data);
            }
        else{
            redirect(base_url() , 'refresh');
        }        
    }
     //businessunit
       public function BusinessUnit(){
        if($this->session->userdata('user_login_access') != False) { 
       $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['businessunit'] = $this->settings_model->businessunitselect();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();

        $this->load->view('backend/business_unit',$data);//
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    } 
    public  function Fetch_Businessunit(){
           if($this->session->userdata('user_login_access') != False) {
              $businessunit = $this->settings_model->businessunitselect();
     
         
            } 
    }    
    public function Add_BusinessUnit(){
        if($this->session->userdata('user_login_access') != False) { 
         $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['timezonevalue'] = $this->settings_model->timezoneselect();
         $data['leavestruc'] = $this->leave_model->Getleavestructure();
        $data['holidaystruc'] = $this->leave_model->GetAllHolistructure();
        $this->load->view('backend/add_businessunit',$data);
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
    public function Save_Businessunit(){
          if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
     
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $description = $this->input->post('description');
        $startedon = $this->input->post('startedon');
        $timezoneid = $this->input->post('timezoneid');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $district = $this->input->post('district');
        $address1 = $this->input->post('address1');
        $address2 = $this->input->post('address2');
        $address3 = $this->input->post('address3');
        $status = $this->input->post('status');


        $holidaystructureid = $this->input->post('holidaystructureid');
        $leavestructureid = $this->input->post('leavestructureid');
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        
        $val = $title;
            $table = 'businessunit';
            $data = array('name'=> $name,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('status'=>'error','message'=>'<p>This BusinessUnit  is already exists</p>'));
            } else {
               
                 $data = array();
                $data = array(
                    'name' => $name,
                    'code' => $code,
                    'description' => $description,
                    'startedon' => $startedon,
                    'timezoneid' => $timezoneid,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'district' => $district,
                    'address1' => $address1,
                    'address2' => $address2,
                    'address3' => $address3,
                     'holidaystructureid'=>$holidaystructureid,
                    'leavestructureid'=>$leavestructureid,
                    'Active_status' => $status  
                );
      
                $success = $this->settings_model->save_businessunit($data);
               
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success));
                   }
                }
        }
    else{
        redirect(base_url() , 'refresh');
    } 
    }
     public function edit_businessunit(){
        if($this->session->userdata('user_login_access') != False) {
        $id = base64_decode($this->input->get('I'));
        $data['busid'] = $id;
        //print_r($data['id']);die();
        $data['Getbusinessunit'] = $this->settings_model->Getbusinessunit($id);
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['timezonevalue'] = $this->settings_model->timezoneselect();
         $data['leavestruc'] = $this->leave_model->Getleavestructure();
        $data['holidaystruc'] = $this->leave_model->GetAllHolistructure();
       $this->load->view('backend/edit_businessunit',$data);

     } 
     }   
     public function Bussiness_HR(){
        if($this->session->userdata('user_login_access') != False) {
        $id = base64_decode($this->input->get('I'));
        $data['busid'] = $id;
        //print_r($data['id']);die();
        $data['Getbusinessunit'] = $this->settings_model->Getbusinessunit($id);
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['timezonevalue'] = $this->settings_model->timezoneselect();
         $data['leavestruc'] = $this->leave_model->Getleavestructure();
        $data['holidaystruc'] = $this->leave_model->GetAllHolistructure();
       $this->load->view('backend/businessunit_hr',$data);

     } 
     }  
     public function Update_businessunit(){
        
           if($this->session->userdata('user_login_access') != False) {
                    $user=$this->session->userdata('user_login_id');
                    $id = $this->input->post('id');
                    $name = $this->input->post('name');
                    $code = $this->input->post('code');
                    $description = $this->input->post('description');
                    $startedon = $this->input->post('startedon');
                    $timezoneid = $this->input->post('timezoneid');
                    $country = $this->input->post('country');
                    $state = $this->input->post('state');
                    $city = $this->input->post('city');
                    $district = $this->input->post('district');
                    $address1 = $this->input->post('address1');
                    $address2 = $this->input->post('address2');
                    $address3 = $this->input->post('address3');
                    $status = $this->input->post('status');
                    $hr = $this->input->post('hr');

                    $holidaystructureid = $this->input->post('holidaystructureid');
                    $leavestructureid = $this->input->post('leavestructureid');
        
                $data = array();
                $data = array(
                    
                    'name' => $name,
                    'code' => $code,
                    'description' => $description,
                    'startedon' => $startedon,
                    'timezoneid' => $timezoneid,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'district' => $district,
                    'address1' => $address1,
                    'address2' => $address2,
                    'address3' => $address3,
                     'holidaystructureid'=>$holidaystructureid,
                    'leavestructureid'=>$leavestructureid,
                   /* 'hr'=>$hr,*/
                    'Active_status' => $status                    
                    
                );
               
                    $success = $this->settings_model->Update_businessunit($id,$data);
                    if($success){
                   echo json_encode(array('status'=>'success','success'=>$success)); 
                   
             
                  } 
        
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

     } 
     public function Add_hr_businessunit(){
        
           if($this->session->userdata('user_login_access') != False) {
                    $user=$this->session->userdata('user_login_id');
                    $id = $this->input->post('id');
                   
                    $hr = $this->input->post('hr');

                  
                $data = array();
                $data = array(
                    
                    
                    'hr'=>$hr                   
                    
                );
               
                    $success = $this->settings_model->Update_businessunit($id,$data);
                    if($success){
                   echo json_encode(array('status'=>'success','success'=>$success)); 
                   
             
                  } 
        
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

     } 
      public function businessinactivestatus(){
      $id = $this->input->post('id');
     $status = $this->input->post('status');
       $data = array( 'Active_status' => $status ); 
        $success = $this->settings_model->Inactive_businessunit($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //}   
    
     }
     /* */
    public function businessactivestatus(){
      $id = $this->input->post('id');
      $status = $this->input->post('status');
      //if($activestatus === "0"){
       $data = array( 'Active_status' => $status ); 
        $success = $this->settings_model->active_businessunit($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //} 
    
     }

    public function OrganisationDepartment(){
        if($this->session->userdata('user_login_access') != False) { 
         $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
          $data['orgdepartmentselect'] = $this->settings_model->orgdepartmentselect();
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['timezonevalue'] = $this->settings_model->timezoneselect();
        $this->load->view('backend/Organisation_department',$data);//
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }     //orgdepartmentselect
    public function Fetch_OrgDepartment(){
         if($this->session->userdata('user_login_access') != False) {
            $orgdepartmentselect = $this->settings_model->orgdepartmentselect();
           
          }
    }
    public function AddOrganisationDepartment(){
        if($this->session->userdata('user_login_access') != False) { 

        $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
        $data['empvalue'] = $this->settings_model->emselect();
        $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['timezonevalue'] = $this->settings_model->timezoneselect();
        $this->load->view('backend/add_organisation_department',$data);
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
    public function edit_orgdepartment(){
        if($this->session->userdata('user_login_access') != False) {
            $id = base64_decode($this->input->get('I'));
          
        $data['getorgdep'] = $this->settings_model->Getorgdep($id);
        $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
        $data['empvalue'] = $this->settings_model->emselect();
        $data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
        $data['settingsvalue'] = $this->settings_model->GetSettingsValue();
        $data['countryvalue'] = $this->settings_model->countryselect();
        $data['statevalue'] = $this->settings_model->stateselect();
        $data['timezonevalue'] = $this->settings_model->timezoneselect();
            $this->load->view('backend/edit_orgdepartment',$data);

     } 
     } 
     public function Save_Orgdepartment(){
          if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');

        $id = $this->input->post('id');
        $depname = $this->input->post('depname');
        $busunit_id = $this->input->post('busunit_id');
        $depcode = $this->input->post('depcode');
        $dephead_id = $this->input->post('dephead_id');
        $startedon = $this->input->post('startedon');
        $timezoneid = $this->input->post('timezoneid');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $address1 = $this->input->post('address1');
        $address2 = $this->input->post('address2');
        $address3 = $this->input->post('address3');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
          $district = $this->input->post('district');
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
         
            $val = '';
            $table = 'org_department';
            $data = array('depname'=> trim($depname),'isActive'=> 1,'busunit_id'=>$busunit_id);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('status'=>'error','message'=>'<p>This department  is already exists</p>'));
            } else {
               
                $data = array();
                $data = array(
                'depname' => $depname,
                'busunit_id' => $busunit_id,
                'depcode' => $depcode,
                'dephead_id' => $dephead_id,
                'startedon' => $startedon,

                'description' => $description,
                'Active_status' => $status
                );

      
                $success = $this->settings_model->Save_orgdepartment($data);
               
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>$success));
                   }
               }
        }
    else{
        redirect(base_url() , 'refresh');
    } 
    } 
    public function Update_Orgdepartment(){
        
           if($this->session->userdata('user_login_access') != False) {
                    $user=$this->session->userdata('user_login_id');
                    $id = $this->input->post('id');
                     $depname = $this->input->post('depname');
                     $busunit_id = $this->input->post('busunit_id');
                    $depcode = $this->input->post('depcode');
                    $dephead_id = $this->input->post('dephead_id');
                    $startedon = $this->input->post('startedon');
                    $timezoneid = $this->input->post('timezoneid');
                    $country = $this->input->post('country');
                    $state = $this->input->post('state');
                    $city = $this->input->post('city');
                    $address1 = $this->input->post('address1');
                    $address2 = $this->input->post('address2');
                    $address3 = $this->input->post('address3');
                    $description = $this->input->post('description');
                       $status = $this->input->post('status');
                       $district = $this->input->post('district');
        
                $data = array();
                $data = array(
                    
                    'depname' => $depname,
                    'busunit_id' => $busunit_id,
                    'depcode' => $depcode,
                    'dephead_id' => $dephead_id,
                    'startedon' => $startedon,
                  
                    'description' => $description,
                     'Active_status' => $status                   
                    
                );
               
                    $success = $this->settings_model->Update_orgdepartment($id,$data);
                    if($success){
                   echo json_encode(array('status'=>'success','success'=>$success)); 
                   
             
                  } 
        
        }
        
        else{
            redirect(base_url() , 'refresh');
        }  

     } 
     public function depinactivestatus(){
      $id = $this->input->post('id');
      //if($inactivestatus === "1"){
       $data = array( 'Active_status' => 0 ); 
        $success = $this->settings_model->Inactive_orgdepartment($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //}   
    
     }
     /* */
    public function depactivestatus(){
      $id = $this->input->post('id');
      //if($activestatus === "0"){
       $data = array( 'Active_status' => 1 ); 
        $success = $this->settings_model->active_orgdepartment($id,$data);
         if($success){
         echo json_encode(array('status'=>'success','message'=>$success)); 
           } 
      //} 
    
     }

     //Email settings
        public function EmailSettings(){
        if($this->session->userdata('user_login_access') != False) {
         $data['email_veiw'] = $this->settings_model->GetEmail();
         $data['smtp_veiw'] = $this->settings_model->GetSmtp();
         $data['email_sequence'] = $this->settings_model->GetEmailSequence();
        $this->load->view('backend/email_settings',$data); 
        }
        else{
            redirect(base_url() , 'refresh');
        }         
    }

      public function Save_EmailSettings(){
        if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
        $id = $this->input->post('id');
        $host = $this->input->post('host');
        $port = $this->input->post('port');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $encryption = $this->input->post('encryption');   
        $from_mail = $this->input->post('from_mail');
        $from_name = $this->input->post('from_name');

        $mail = $this->input->post('mail');
        
            if($mail == 'smtp') {
                $data = array();
                $data = array(
                    'host' => $host,
                    'port' => $port,
                    'username' => $username,
                    'encryption' => $encryption,
                    'password' => $password,
                    'from_mail' => $from_mail,
                    'from_name' => $from_name,
                    'smtp' => 'Yes',
                    
                );
            }else{
                $data = array();
                $data = array(
                    
                    'from_mail' => $from_mail,
                    'from_name' => $from_name,
                      'smtp' => 'No',
                    
                );
            }
        
            if(empty($id)){
                $success = $this->settings_model->save_email($data);
               
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>'Mail Settings  Added Successfully'));
                   } 
            } else {
                $success = $this->settings_model->update_email($id,$data);
              
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>'Mail Settings Updated Successfully')); }
            }
                       
        //}
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
     //email alert
      public function Save_EmailSequence(){
        if($this->session->userdata('user_login_access') != False) {
        $user=$this->session->userdata('user_login_id');
        $id = $this->input->post('id');
        $govt_id = $this->input->post('govt_id');
        $sequence = $this->input->post('sequence');
    
                $data = array();
                $data = array(
                    'govt_id' => $govt_id,
                    'sequence' => $sequence                    
                );
          
        
            if(empty($id)){
                $success = $this->settings_model->save_sequence($data);
               
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>'Added Successfully'));
                   } 
            } else {
                $success = $this->settings_model->update_sequence($id,$data);
              
                    if($success){
                   echo json_encode(array('status'=>'success','message'=>'Updated Successfully')); }
            }
                       
        //}
        }
    else{
        redirect(base_url() , 'refresh');
    }            
    }
     //get Report to
    public  function Gethr(){
       if($this->session->userdata('user_login_access') != False) { 
         
             $id = $this->input->post('busunit');

            $hr = $this->input->post('hr');

             $result = $this->employee_model->GetReportEmp($id); 

               $str='';
               if($result > 0){
                    $str.="<option value='' >Select Human Resource</option>";
                foreach ($result as $value){
                
                   $str.="<option value='".$value->em_id."' ";
                   if(( $value->em_id == $hr)){ $str.="selected";} 
                   $str.=" >".$value->first_name .' '.$value->last_name."</option>";
                }
            }
            echo json_encode(array('content'=>$str));
        }
             

    }
    
    public function GetSequenceBYID()
    {
        if ($this->session->userdata('user_login_access') != False) {
            $id                     = $this->input->get('id');
            $data['sequencevalue'] = $this->settings_model->GetSequenceBYID($id);
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

     public function DeleteSquence(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->DeleteSquence($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
               
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }

         public function BusinessUnitDelete(){
              if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->BusinessUnitDelete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This BusinessUnit Already Used In Employees'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        } 
    }

         public function ShiftDelete(){
        if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->ShiftDelete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
               
            }else{
                 //echo json_encode(array('status'=>'failed','dep_delfail'=> 'This Department Already used'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        }            
    }
  
         public function OrgDepartmentDelete(){
              if($this->session->userdata('user_login_access') != False) { 
            $id = $this->input->post('id');
            $result_del = $this->settings_model->OrgDepartmentDelete($id);//
          if($result_del){
                echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));
               
            }else{
                 echo json_encode(array('status'=>'failed','message'=> 'This Department Already Used In Employees'));
             
            }
           
            }
        else{
            redirect(base_url() , 'refresh');
        } 
    }

  // Policies---------------
        public function Add_policy(){
    if($this->session->userdata('user_login_access') != False) {    
        $policy_title = $this->input->post('policy_title');           
        $policy_description = $this->input->post('policy_description');          
        $busunit_id = $this->input->post('busunit_id'); 
          $policy_id = $this->input->post('id'); 

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('policy_title', 'title', 'trim|required|max_length[150]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            #redirect("notice/All_notice");
            } else {

             if ($policy_id) {
                if($_FILES['file']['name']){
            $file_name = $_FILES['file']['name'];
            $fileSize = $_FILES["file"]["size"]/1024;
            $fileType = $_FILES["file"]["type"];
            $new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/policy_document",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
                'overwrite' => False,
                'max_size' => "50720000"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
                #redirect("notice/All_notice");
            }
   
            else {
                  $path = $this->upload->data();
                $img_url = $path['file_name'];
                // Update existing policy
                 $data = array(
                    'busunit' => $busunit_id,
                    'file' => $img_url,
                    'policy_title' => $policy_title,
                    'policy_description' => $policy_description,
                  
                );
                $this->notice_model->update_policyData($policy_id, $data);
                echo json_encode(array('status'=>'success','message'=>"Successfully Updated"));
            }
            } 
            } else {
           $val = $policy_title;
            $table = 'company_policies';
            $data = array('policy_title'=> $policy_title,'busunit'=> $busunit_id,'isActive'=> 1);
            if($this->organization_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('status'=>'error','message'=>'<p>This Policy  is already exists</p>'));
            } else {
            if($_FILES['file']['name']){
            $file_name = $_FILES['file']['name'];
            $fileSize = $_FILES["file"]["size"]/1024;
            $fileType = $_FILES["file"]["type"];
            $new_file_name='';
            $new_file_name .= $file_name;

            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./assets/uploads/policy_document",
                'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
                'overwrite' => False,
                'max_size' => "50720000"
            );
            //create directory
              if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
    
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);                
            if (!$this->upload->do_upload('file')) {
                echo $this->upload->display_errors();
                #redirect("notice/All_notice");
            }
   
            else {

                $path = $this->upload->data();
                $img_url = $path['file_name'];
                $data = array();
                $data = array(
                    'busunit' => $busunit_id,
                    'file' => $img_url,
                    'policy_title' => $policy_title,
                    'policy_description' => $policy_description,
                  
                );

            $success = $this->notice_model->Add_policy($data); 

            if($success){

      
                echo json_encode(array('status'=>'success','message'=>"Successfully Added"));
            }
            }
        }
          }
        }
        }
        }
    else{
        redirect(base_url() , 'refresh');
    }        
    }
//get allowance
public function Get_policies(){
if($this->session->userdata('user_login_access') != False) {
$busunit = $this->input->get('busunit');

$getallowance = $this->notice_model->Get_policies($busunit);
if($getallowance){
$i = 1;
foreach($getallowance as $value){
echo' <tr>
    <td scope="row">'.$i.'</td>
    <td width="20%">'.$value->policy_title.'</td>
    <td width="60%">'.$value->policy_description.'</td>
    <td width="" class="text-center"><a href="'.base_url().'assets/uploads/policy_document/'.$value->file.'" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="'.$value->file.'"><i class="fa fa-file-o"></i></a></td>';
    if($this->role->User_Permission('business_unit','can_delete') ){
    echo ' <td width="20%" class="text-center">
  <button title="Edit" class="btn btn-sm btn-info waves-effect waves-light edit_policy_btn" data-id="'.$value->id.'"><i class="fa fa-pencil-square-o"></i></button> 
    <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delete_policy" data-id="'.$value->id.'"><i class="fa fa-trash-o"></i></button></td>';
    }else { 
    echo "<td></td>";
 }
echo '</tr>';

$i++; }

}
}
}

//delete allowance
public function deletepolicy(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$result = $this->notice_model->deletepolicy($id);
if($result){
echo json_encode(array('status'=>'success','message'=>'Successfully Deleted'));
}
}
}
    public function PolicyByID()
    {
        if ($this->session->userdata('user_login_access') != false) {
            $id = $this->input->get('id');
            $data['policy_data'] = $this->notice_model->GetpolicyValuebyId($id);
  
            echo json_encode($data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


 }
?>