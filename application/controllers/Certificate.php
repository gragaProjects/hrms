<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
        $this->load->model('dashboard_model'); 
        $this->load->model('employee_model'); 
        $this->load->model('notice_model');
        $this->load->model('settings_model');
        $this->load->model('leave_model');
        $this->load->model('shift_modal');
        $this->load->model('Certificate_modal');
        $this->load->model('organization_model');
    }
    
	public function index()
	{
	   if($this->session->userdata('user_login_access') != False) { 
	   	 $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
	   	 $data['certificate_data'] = $this->Certificate_modal->get_certificate_data();
	   	// print_r($data['certificate_data']);die();
         $this->load->view('backend/view_certificate',$data);
	    }
	}

	public function create_certificate(){
           
        if($this->session->userdata('user_login_access') != False) { 
         $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
		$this->load->view('backend/create_certificate',$data);
	    } 
	}	
	public function edit_certificate(){
           
        if($this->session->userdata('user_login_access') != False) { 
        	 $template_id = base64_decode($this->input->get('I'));
         $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
         $data['certificate_data'] = $this->Certificate_modal->get_template_by_id($template_id);
         $data['content_data'] = $this->Certificate_modal->get_content_by_template_id($template_id);
         // echo $template_id;
         // print_r($data);die();
		$this->load->view('backend/edit_certificate',$data);
	    } 
	}

	 public function save_certificate() {

      //  print_r($_POST);die();
        $busunit = $this->input->post('busunit');
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        $editedTitles = $this->input->post('editedTitles');
        //print_r($content);die();
        // Save certificate template
        $template_data = array(
            'busunit' => $busunit,
            'title' => $title
        );
        $template_id = $this->Certificate_modal->save_certificate_template($template_data);

        // Save certificate content
        foreach ($content as $index => $content_item) {
            $content_data = array(
                'busunit' => $busunit,
                'template_id' => $template_id,
                'content' => $content_item,
                  'title' => isset($editedTitles[$index]) ? $editedTitles[$index] : ''
            );
            $this->Certificate_modal->save_certificate_content($content_data);
        }
        
        // Save selected tags to tamplate_tags table, checking for duplicates
        $selectedTags = $this->input->post('selectedTags');
        $existingTags = $this->Certificate_modal->get_template_tags($template_id);

         if($selectedTags){
           foreach ($selectedTags as $tag) {
            // Check if the tag already exists
            if (!in_array($tag, $existingTags)) {
                $tag_data = array(
                    'template_id' => $template_id,
                    'tag_name' => $tag
                );
                $this->Certificate_modal->save_template_tag($tag_data);
                $existingTags[] = $tag; // Add to the existing tags array to avoid duplicates
            }
        }
        }


        $response = array('status' => 'success');
        echo json_encode($response);
    }
   
    //update
    public function update_certificate() {
    if ($this->session->userdata('user_login_access') != false) {
        $busunit = $this->input->post('busunit');
        $title = $this->input->post('title');
        $contentArray = $this->input->post('content');
        $templateId = $this->input->post('id');
          $editedTitles = $this->input->post('editedTitles');

        // Validate the form data as needed

        $updateTemplateData = array(
            'busunit' => $busunit,
            'title' => $title,
            // Add other fields if needed
        );
        
        // Call the model to update the certificate template
        $this->Certificate_modal->update_template($templateId, $updateTemplateData);



        // Call the model to update the certificate content
        $this->Certificate_modal->update_content($templateId, $contentArray,$busunit,$editedTitles);


        // Save selected tags to tamplate_tags table, checking for duplicates
        $selectedTags = $this->input->post('selectedTags');
        if($selectedTags){
            $existingTags = $this->Certificate_modal->get_template_tags($templateId);
           foreach ($selectedTags as $tag) {
            // Check if the tag already exists
            if (!in_array($tag, $existingTags)) {
                $tag_data = array(
                    'template_id' => $templateId,
                    'tag_name' => $tag
                );
                $this->Certificate_modal->save_template_tag($tag_data);
                $existingTags[] = $tag; // Add to the existing tags array to avoid duplicates
            }
        }  
        }
      


        // Optionally, you can prepare a response data array
        $responseData = array('status' => 'success', 'message' => 'Certificate updated successfully');

        // Convert the data array to JSON
        echo  json_encode($responseData);

        
    }
}

    public function CertificateDelete() {
        $id = $this->input->post('id');

        // Call the model function to delete from the first table
        $result1 = $this->Certificate_modal->delete_template($id);

        // Call the model function to delete from the second table
        $result2 = $this->Certificate_modal->delete_content($id);

        if ($result1 && $result2) {
            $response = array('status' => 'success', 'message' => 'Certificate deleted successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to delete certificate');
        }

        echo json_encode($response);
    }

    public function CertificateContentdelete() {
        $id = $this->input->post('id');


        // Call the model function to delete from the second table
        $result2 = $this->Certificate_modal->delete_contentbyid($id);

        if ( $result2) {
            $response = array('status' => 'success', 'message' => 'Deleted Successfully');
        } else {
            $response = array('status' => 'error', 'message' => 'Failed to delete certificate');
        }

        echo json_encode($response);
    }

      public function getTags() {
         
            $tags = $this->Certificate_modal->getTags();
            $this->output->set_content_type('application/json')->set_output(json_encode($tags));
        }   

      


      public function CertificatePdf()
    {
        $id = $this->input->get('Id');
        $eid = $this->input->get('em');
        $busunit = $this->input->get('busunit');
        $data = array();

        // Fetch data from the database based on $id and $eid
        $templateData = $this->Certificate_modal->getTemplateData($id);
        $contentData = $this->Certificate_modal->getContentData($id);


        $header_footer_data = $this->Certificate_modal->get_header_footerby_busunit($busunit);

        $path = base_url()."assets/uploads/pdf_header_footer/";

        // print_r($path.$header_footer_data->header);
        // print_r($path.$header_footer_data->footer);
        // print_r($path.$header_footer_data->watermark);
        // print_r($header_footer_data);
        //;
          

   
        $this->load->library('AppointmentPdf');
        $pdf = new AppointmentPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Appointment Letter');
        $pdf->SetSubject('Appointment Letter');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
       // $pdf->setPrintHeader(false);
        // $pdf->SetTopMargin(20);
        $pdf->SetMargins(10, 10, 10, true);
        $pdf->setCellPaddings(0,0,0,0);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
        }
        // set font
        $pdf->SetFont('dejavusans', '', 10);
          
          //Header and footer variables
        $pdf->header_img = ($header_footer_data->header) ? $path.$header_footer_data->header : '';
        $pdf->footer_img = ($header_footer_data->footer) ? $path.$header_footer_data->footer : '';//$path.$header_footer_data->footer;
        $pdf->watermark_img = ($header_footer_data->watermark) ? $path.$header_footer_data->watermark : ''; //$path.$header_footer_data->watermark;


        // Loop through each content data and add a page for each
        foreach ($contentData as $contentItem) {
            // Add a new page for each set of content data
            $pdf->AddPage();

            // Replace placeholders in the HTML content with actual data
            $html = $contentItem->content;
            $placeholders = array(
                '{employee_name}' => 'Sivakumar',
                // Add more placeholders as needed
            );
            $html = strtr($html, $placeholders);

            // Add content to the current page
            $pdf->writeHTML($html);
        }


        // // add a page
        // $pdf->AddPage();

        // $html = $contentData['content'];

        // // Replace placeholders in the HTML content with actual data
        // $placeholders = array(
        //     '{employee_name}' => $contentData['sivakumar'],
  
        // );

        // $html = strtr($html, $placeholders);

        // // Add content to the first page
        // $pdf->writeHTML($html);

    

        $filename = "AppointmentLetter";
        $pdf->writeHTML($html1, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($filename . '.pdf', 'I');
    }


  ///Appoinment pdf
        public function pdf(){
        $id    = $this->input->get('Id');
        $eid  = $this->input->get('em');
        $data = array();
        $payslip_data = $this->payroll_model->Generate_payslip($id,$eid );
        
        $employee_info      = $this->payroll_model->getEmployeeID($eid);
        $otherInfo      = $this->payroll_model->getOtherInfo($eid);
        $employeeID = $eid;
        $month_num = date("m", strtotime($payslip_data->month));
        $date = $month_num.'-'.$payslip_data->year;

             /**/
        $busid = $employee_info->busunit;
        $businessunitvalue = $this->settings_model->GetBusinessunitValue($busid);

        // print_r($businessunitvalue);
        if(isset($businessunitvalue->holidaystructureid)){
        $structureid = $businessunitvalue->holidaystructureid;
        $leavestructureid = $businessunitvalue->leavestructureid;
        $data['structureid'] = $structureid;
        $data['leavestructureid'] = $structureid;
        }else{
        $structureid = '';
        $leavestructureid = '';
        }
        /**/

        $leavecountresult = $this->payroll_model->Get_emp_leave_count($employeeID,$date,$leavestructureid);
        $leavecount = $leavecountresult->leavecount;
        
        //paid condition
        $paidleavecountresult = $this->payroll_model->Get_paid_leave_count($employeeID,$date);
        //if($paidleavecountresult->paidstatus == 'paid'){
        
        if($paidleavecountresult->leavecount > $paidleavecountresult->Total_days){
        
        $paid_result = $paidleavecountresult->leavecount - $paidleavecountresult->Total_days;
        
        
        $leavecount +=$paid_result;
        }
        //organisation info
        $organisationvalue = $this->settings_model->GetOrganisationValue();
       // print_r($organisationvalue->organisation);die();
        $datetime = $date;
        //get allowance
        $getallowance = $this->payroll_model->Get_allowance($eid,$datetime);
        //get deduction
        $getdeduction = $this->payroll_model->Get_deduction($eid,$datetime);


          
        $totalinwords = $this->NumberintoWords($payslip_data->total_pay);//
        $cur_month = date("M", strtotime($payslip_data->month));
        $cur_year = $payslip_data->year;
        //half count
        $halfleavecountresult = $this->payroll_model->Halfday_pdf_leave_count($employeeID,$date);
        $data['halfleavecountresult'] = $halfleavecountresult->halfdays;
        $half_d_count = 0;
        if($halfleavecountresult->halfdays){
        $half_d_count =  0.5 * $halfleavecountresult->halfdays;
         
        }
        $this->load->library('AppointmentPdf');
        // create new PDF document
        $pdf = new AppointmentPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Appointment Letter');
        $pdf->SetSubject('Appointment Letter');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
       // $pdf->setPrintHeader(false);
        // $pdf->SetTopMargin(20);
        $pdf->SetMargins(10, 10, 10, true);
        $pdf->setCellPaddings(0,0,0,0);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
        }
        // set font
        $pdf->SetFont('dejavusans', '', 10);
        // add a page
        $pdf->AddPage();


     //------------------content-------------------------


        $html .= '
           
            <h5 class="text-center" style="font-weight:bold;text-align:center;font-size:16px">Letter of Appointment</h5>
              <table style="width:100%;"  cellpadding="2" cellspacing="5">
                <tr>
                    <td  width="40">Date:</td>
                    <td  width="">'. date('d-M-Y').'</td>
                   
                </tr>
                <tr>'; 
            $html .='<td width="">[Employee Name]</td> </tr>';
            $html .='<tr><td width="">No. 21, Road No. 357</td> </tr>';
            $html .='<tr><td width="">Block No. 304,</td></tr>';
            $html .='<tr><td width="">Manama, Kingdom of Bahrain</td> </tr>';
                  
                $html .='
               
            </table>

          <table style="width:100%; margin-top: 50px;" >
          <br>
          <br>
             <tr>
                 <td  width="50" >  Dear</td>
                  <td  width="" style="font-weight:bold">[Employee Name]</td></tr>  
                  <br>
            <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;" colspan="2"> Welcome to <strong> Graga Technologies</strong>  Concerning the discussion, we had with you, we are pleased to appoint you as a <strong> Web Developer </strong> under the following terms and conditions:</td>       
            </tr></table>
            ' ; 
      
                $html .='<table style="width:100%; margin-top: 50px;" >
          <br>
          <br>
             <tr>
                 <td style="font-weight:bold"> 1. Commencement Date</td>
                  </tr>  
                  <br>
            <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;">      
               Your date of appointment will be effective from [Appointment Date]</td>       
            </tr></table>  ';     

            $html .='<table style="width:100%; margin-top: 50px;" >
                <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 2. Standard Conditions of Employment</td>
                </tr>
                <br>
                <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%; "><p style="text-align: justify">
                (a) The Standard Conditions of Employment will relate to various matters relating to your working with the Company, including hours of work, holidays, leave, code of conduct, and confidentiality policy as   &nbsp;&nbsp;&nbsp;Company Policy Documents.</p></td>
            </tr> 
            <br>
                <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;">
                (b) The Standard Conditions of Employment may be changed by the Company from time to time at the
                sole discretion of the Company and such changed Standard Conditions of Employment shall become applicable to you forthwith, upon receipt of notice of the same.</td>
            </tr>
            </table>  ';   

          $html .='<table style="width:100%; margin-top: 50px;" >
                <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 3. Representations</td>
                </tr>
                <br>
                <tr>&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">
                (a) You hereby represent that all the contents of your resume, testimonials, references, previous
                      employment details and other information furnished by you are true and accurate.</td>
            </tr> 
            <br>
                <tr>&nbsp;&nbsp;&nbsp;&nbsp;<td align="" style="width: 100%;">
                (b) If any of the above particulars are found to be incorrect or misleading in any way, the Company shall have the right to terminate your employment forthwith, without the requirement of providing you with any notice or compensation in lieu thereof. </td>
            </tr>
             <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 4. Place of work</td>
                </tr>
                <br>
                <tr><td align="" style="width: 100%; text-align:justify">
                &nbsp;&nbsp;&nbsp;Work from home.</td>
            </tr> 
            <br>
                <br>
                <tr>
                    <td style="font-weight:bold"> 5. Working Hours
                </td>
                </tr>
                <br>
                <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">
                You have work from Saturday to Thursday from 10.30 AM to 7.30 PM & (Friday holiday). 
                You have to serve your duties with proper discharge for the company during these working hours.</td>
            </tr> 
           
            </table>  ';
       // ----------Second page--------------


          $html .='<table style="width:100%; margin-top: 50px;" >
                <br>
                <br>
                 <br>
                <br>
                <br>
                <br>
                <tr><td style="font-weight:bold"> 6.Probationary Period
                </td>
                </tr>
                <br>
                <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">
                The 3 months as probationary period needs to be served by the candidate, after joining the job.</td>
            </tr> 

            <br>
            <br>
            <tr>
                <td style="font-weight:bold"> 7. Compensation
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) Your compensation is based on your qualifications; skill sets and overall experience. Therefore, the compensation payable to you by the Company is unique and personal and any comparison of the same with those of others will be of no relevance.</td>
            </tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) Your salary will be reviewed yearly as per the policy of the company. Your increments in the salary are discretionary and will be subject to and based on effective performance and financial goals of the company during the period.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) Except to the extent prescribed by law, the breakup of compensation shall be entirely at the discretion of the Company but will be based on such factors as level of employment, tax efficiency, fairness, and management convenience.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(d) Your terms of employment and compensation are strictly confidential, and you shall not divulge the same to any other employee of the Company except where required by Company policy.</td>
            </tr>           

             <br>
            <br>
            <tr>
                <td style="font-weight:bold"> 8. Corrupt Practices
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) Never give, offer, or authorize the offer of, either directly or indirectly, anything of value (such as money, goods, or services) to a customer or government official to obtain any improper advantage. A business courtesy, such as a gift, Contribution or entertainment should never be offered under circumstances that might create the appearance of impropriety.</td>
            </tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) No political contributions shall be made using Company funds or assets provided to any political party, political campaign, political candidate, or public official in India or any foreign country unless the contribution is lawful and expressly authorized in writing by the Director.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) During the period that you are employed by the Company, you shall not, either while acting on behalf of the Company or the pretext thereof, accept from any person or entity, that any consideration for any assessment or decision may be favorable to that person or entity. Such consideration shall include any item or conduct that may be of value such as a gift, bribe, payment, performance, favor, etc.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(d) You shall not use company funds for any unlawful & unethical purpose. Also, you shall not offer, give or cause others to give, any payments to influence the';$html .=" recipient's business judgment.</td>
            </tr>";

             $html .='<br>
            <br>
            <tr>
                <td style="font-weight:bold"> 9. Protecting the assets of the Company & Our Customers
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) You shall be responsible for protecting Graga Technologies & its customers assets which are found in many different forms including physical assets, proprietary information, intellectual property, and confidential information.</td>
            </tr><br><br>';
                 // ----------Third page--------------

           $html .='
           <br>
           <br>
           <br>
           <br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) You must be alert to any situations or incidents that could lead to the loss, misuse or theft of Company or customer assets. All such situations must be reported to the IT Department as soon as the situation arises.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) All inventions, improvements and discoveries made solely by you or jointly while on duty need to be disclosed to the company and the company has the sole right, title and interest over such inventions, improvements, and discoveries and has the intellectual property rights over them.</td></tr><br>
            

             <br>
            <br>

            <tr>
                <td style="font-weight:bold"> 10. Non-Solicitation / Non-Compete
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(a) You shall not directly or indirectly, or through any other party, solicit or offer employment to any persons who are employees of the Company or its affiliates for a period of 18 Months after the date of termination of your employment with the Company.</td>
            </tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(b) You shall not, directly, indirectly, or through any third party, solicit business from, any customer of the Company for a period of one year after the date of termination of your employment with the Company.</td></tr><br>
            <tr> &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">(c) You shall not, directly, or indirectly, perform services or take up employment with any competitor of the Company for a period of one year after the date of termination of your employment with the Company.</td></tr><br>
            

             <br>
            <br> 
            <tr>
                <td style="font-weight:bold"> 11. Change of Circumstances 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">Any change in your residential address, telephone numbers, marital status, and academic qualifications should be notified in writing forthwith to the company. All communications will be addressed to you at the last address notified by you and it will be presumed that you have received such communications addressed to you.</td>
            </tr>
            

             <br>
            <br>
            <tr>
                <td style="font-weight:bold"> 12. Notice Period Clause 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">Notice given under this Contract shall be in writing and if to be given to the Employer shall be delivered by hand or sent by registered or recorded delivery post to a Director of the Employer or its registered office and if to be given to the Employee shall be handed to the Employee or sent by registered or recorded delivery post to the';$html .=" Employee's"; $html .='last known residential address. Notice sent by post is deemed to be given on the sixty (60) working days after posting.</td>
            </tr>
            

             <br>
            <br>

              <tr>
                <td style="font-weight:bold"> 13. Return of Assets 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">On termination of your employment, you shall immediately handover to the company all assets, equipment, records, documents, accounts, letters, memoranda, and papers of every description belonging to the company and within your possession, in good order, fair wear and tear excepted; failing which the company can take legal action as it may deem fit.</td>
            </tr>
            

             <br>
            <br>
            <br>
            <br>
            </table>  ';
             // ----------Fourth page--------------
        $html .= ' <table style="width:100%; margin-top: 50px;" >
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">We congratulate you on your appointment and wish you a long career with us. We assure you that have a great journey and get our full support for your professional growth and development. </td>
            </tr> 
            <br>
            <br>
             <tr>
            &nbsp;<td align="" style="width: 100%;" colspan="2">We reaffirm our complete confidence in your abilities to find professional and personal satisfaction here.</td>
            </tr> 
               <br>
            <br>
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">Please sign and return a copy of this Appointment letter in acceptance of the terms and conditions. </td>
            </tr>
             <br>
            <br>
            <br>
            <br>
            </table> 
            ' ;
               $html .= ' <div>
            <table style="width:100%; margin-top: 10px;" >
            <br>
            <br>
            <br>
                <tr>&nbsp;&nbsp;<td  width="" style="font-weight:bold"> Regards, </td></tr>
                <tr>'; 
            $html .='&nbsp;<td width="">HR sign</td> </tr>';
            $html .='<tr><td width="" style="font-weight:bold">HR Name</td> </tr> ';
            $html .='<tr><td width="">Manager, Human Resources and Talent Recruiting.</td></tr>  
            ';

            // Add content to the first page
            $pdf->writeHTML($html);

            // Add a manual page break
            $pdf->AddPage();
       
             $html1 = '  <div style=" margin-top: 0px;">
            <h6 class="text-center" style="font-weight:bold;text-align:center;font-size:16px;text-decoration: underline;">ANNEXURE</h6>
        
               </div>
                <br>
                <br>
                <br>


                 <br>
            <br>
            <table style="width:100%; margin-top: 50px;" >
              <tr>
                <td style="font-weight:bold"> Salary Breakup 
                </td>
            </tr>
            <br>
            <tr>
                &nbsp;&nbsp;<td align="" style="width: 100%; text-align:justify">Your compensation is strictly between yourself and the company. It has been determined on various factors such as your job, skills, and professional merit. This information and any changes therein should be treated as personal and confidential.</td>
            </tr>
             <br>

               <br>
            <br>
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">Your total annual CTC will be Rs. <strong>xxxxx /- </strong> - and its composition will be as follows:</td>
            </tr>
             <br>
            <br>
            <br>
              </table> 
               '; 

           $html1 .= '
           <br>
             <br>
            <br>
            <br>
           <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-left: 50px; margin-right: 50px;">
                <tr style="width: 100%; margin-left: 50px; margin-right: 50px;">
                    <th style="text-align: center;font-weight:bold">Components of Salary</th>
                    <th style="text-align: center;font-weight:bold">Amount (Rs) </th>
                </tr> 
                <tr>
                    <td style="text-align: center;">Fixed Salary Components (Monthly)</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Basic</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: center;">HRA</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Conveyance</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: center;">Other Benefits</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: center;">Total Gross Salary (Monthly)</td>
                    <td style="text-align: center;">xxxxx</td>
                </tr> 
                <tr>
                    <td style="text-align: ;font-weight:bold">Total Gross Salary (Annually) </td>
                    <td style="text-align: center;">xxxxx</td>
                </tr>
            </table>';

              $html1 .= '  
            <table style="width:100%; margin-top: 50px;" >
              
             <br>

               <br>
            <br>
             <tr>
             &nbsp;<td align="" style="width: 100%;" colspan="2">Amount in words: <strong>xxxxx /- </strong></td>
            </tr>
             <br>
            <br>
            <br>
            <tr>
                <td style="font-weight:bold"> Acknowledgement 
                </td>
            </tr>
            <br>
            <tr>
             <td align="" style="width: 100%; text-align:justify"> I, <strong>[Employee Name] </strong> accepts the appointment, agrees to the terms and conditions stated above, and I hereby confirm that I will adhere to the policies of the company and discharge my duties to the satisfaction of the higher authorities</td>
            </tr>
             <br>
            <br>
            <br></table> 
               '; 

                  $html1 .= '
             <br>
             <br>
            <br>
            <br>
           <table  cellpadding="2" cellspacing="0" style="width: 100%; margin-left: 50px; margin-right: 50px;">
                <tr style="">
                    <td style="width: 30%;text-align: center;">'. date('d-M-Y').'</td>
                     <td style="text-align: center;width: 40%;"></td> 
                    <td style="text-align: center;font-weight:bold;width: 30%;"></td>
                </tr> 
                <tr style="">
                    <td style="text-align: center;font-weight:bold;border-bottom: 1px solid black;border-top: 0px solid white;width: 30%;"></td>
                     <td style="text-align: center;width: 40%;"></td> 
                    <td style="text-align: center;font-weight:bold;border-bottom: 1px solid black;border-top: 0px solid white;width: 30%;"></td>
                </tr> 
                 <tr style="">
                    <td style="width: 30%;">Date</td>
                     <td style="text-align: center;width: 40%;"></td> 
                    <td style="width: 30%;">Signature</td>
                </tr> 
              
               
             </table>';


   
   
                  
           

      
        
        $filename = "AppointmentLetter";
        
        $pdf->writeHTML($html1, true, false, true, false, '');

      

        // reset pointer to the last page
        $pdf->lastPage();
        
        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($filename.'.pdf', 'I');

        }


    

        function NumberintoWords(float $amount)
        {
           $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
           // Check if there is any number after decimal
           $amt_hundred = null;
           $count_length = strlen($num);
           $x = 0;
           $string = array();
           $change_words = array(
              0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
              7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
              13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
              18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty',
              50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
           );
           $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
           while ($x < $count_length) {
              $get_divider = ($x == 2) ? 10 : 100;
              $amount = floor($num % $get_divider);
              $num = floor($num / $get_divider);
              $x += $get_divider == 10 ? 1 : 2;
              if ($amount) {
                 $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                 $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                 $string[] = ($amount < 21) ?
                    $change_words[$amount] . ' ' . $here_digits[$counter] . ' ' . $amt_hundred :
                    $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' ' . $here_digits[$counter] . ' ' . $amt_hundred;
              } else {
                 $string[] = null;
              }
           }
           $implode_to_Rupees = implode('', array_reverse($string));
           $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
           
           $output = ($implode_to_Rupees ? $implode_to_Rupees . 'Rupee' . ($implode_to_Rupees === 'One' ? '' : 's') . ' ' : '') . $get_paise;
           
           return $output;
        }


        // Tags master
         //expenses_category

            public function CreateTags()
            {
                if ($this->session->userdata('user_login_access') != false) {
                    $data['employee'] = $this->employee_model->emselect();
                    $data['expenseselect'] = $this->Certificate_modal->getTags();
                    $this->load->view('backend/certificate_tags', $data);
                } else {
                    redirect(base_url(), 'refresh');
                }
            }
            public function EditTags(){
            if($this->session->userdata('user_login_access') != False) {
            $id = $this->uri->segment(3);//
            $data['expenseselect'] = $this->Certificate_modal->getTags();
            $data['typevalue_edit'] = $this->Certificate_modal->Tags_edit($id);
            $this->load->view('backend/certificate_tags',$data);
            }
            else{
            redirect(base_url() , 'refresh');
            }
            }

            public function Add_Tags(){
            if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $type = $this->input->post('category');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('category',' tag','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
            if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
            echo json_encode(array('error'=>$error));
            }else{
            $val = $type;
            $table = 'tags';
            $data = array('name'=> $val);
            if($this->settings_model->Check_field_exists($val,$data,$table)){
            echo json_encode(array('error'=>'<p>This tag  is already exists</p>'));
            } else{
            $data = array();
            $data = array(
            'name' => $type
            );
            $success = $this->Certificate_modal->Add_tags($data);
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
            public function Update_Tags(){
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
            'name' => $type
            );
            $success = $this->Certificate_modal->Update_tags($id,$data);
            if($success){
            echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
            }

            }

            }
            else{
            redirect(base_url() , 'refresh');
            }
            }
            public function Delete_tag(){
            if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $result_del = $this->Certificate_modal->Delete_tag($id);//
            if($result_del){
            echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));

            }

            }
            else{
            redirect(base_url() , 'refresh');
            }
            }
        // Tags master

        public function template_header(){
           
        if($this->session->userdata('user_login_access') != False) { 
         $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
             $data['certificate_data'] = $this->Certificate_modal->get_header_footer();
         $this->load->view('backend/view_template_header',$data);
        } 
       } 
        
        public function create_template_header(){
           
        if($this->session->userdata('user_login_access') != False) { 
         $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
         $this->load->view('backend/create_template_header',$data);
        } 
       } 
        public function edit_template_header(){
           
        if($this->session->userdata('user_login_access') != False) { 

                 $id = base64_decode($this->input->get('I'));
       
         $data['businessunitvalue'] = $this->settings_model->businessunitvalue();
           $data['certificate_data'] = $this->Certificate_modal->get_header_footerby_id($id);

         $this->load->view('backend/edit_template_header',$data);
        } 
       }

       public function Save_Header() {
      //  print_r($_POST);die();
            $busunit = $this->input->post('busunit');
    
   // Check if all files are provided
    if ($_FILES['header']['name'] && $_FILES['footer']['name'] && $_FILES['watermark']['name']) {
        // Header file upload
        $header_name = $_FILES['header']['name'];
        $header_new_file_name = $header_name;

        $header_config = array(
            'file_name' => $header_new_file_name,
            'upload_path' => "./assets/uploads/pdf_header_footer",
            'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
            'overwrite' => False,
            'max_size' => "50720000"
        );

        if (!is_dir($header_config['upload_path'])) {
            mkdir($header_config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $header_config);
        $this->upload->initialize($header_config);

        if (!$this->upload->do_upload('header')) {
            echo $this->upload->display_errors();
            return; // Stop execution if header file upload fails
        }

        $header_data = $this->upload->data();

        // Footer file upload
        $footer_name = $_FILES['footer']['name'];
        $footer_new_file_name = $footer_name;

        $footer_config = array(
            'file_name' => $footer_new_file_name,
            'upload_path' => "./assets/uploads/pdf_header_footer",
            'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
            'overwrite' => False,
            'max_size' => "50720000"
        );

        $this->load->library('upload', $footer_config);
        $this->upload->initialize($footer_config);

        if (!$this->upload->do_upload('footer')) {
            echo $this->upload->display_errors();
            return; // Stop execution if footer file upload fails
        }

        $footer_data = $this->upload->data();

        // Watermark file upload
        $watermark_name = $_FILES['watermark']['name'];
        $watermark_new_file_name = $watermark_name;

        $watermark_config = array(
            'file_name' => $watermark_new_file_name,
            'upload_path' => "./assets/uploads/pdf_header_footer",
            'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|docx",
            'overwrite' => False,
            'max_size' => "50720000"
        );

        $this->load->library('upload', $watermark_config);
        $this->upload->initialize($watermark_config);

        if (!$this->upload->do_upload('watermark')) {
            echo $this->upload->display_errors();
            return; // Stop execution if watermark file upload fails
        }

        $watermark_data = $this->upload->data();



            if ($header_data && $footer_data && $watermark_data) {
                $dataFiles = array(
            'busunit' => $busunit,
            'header' => $header_data['file_name'],
            'footer' => $footer_data['file_name'],
            'watermark' => $watermark_data['file_name']
        );

                $id = $this->input->post('id');
                if ($id) {
                    // Update operation
                    $this->db->where('id', $id);
                    $this->db->update('template_default', $dataFiles);
                      echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
                
                } else {

                    $val = $busunit;
                    $table = 'template_default';
                    $data = array('busunit'=> $val,'isActive'=> 1);
                    if($this->organization_model->Check_field_exists($val,$data,$table)){
                    echo json_encode(array('status'=>'error','message'=>'<p>This Business Unit is already exists</p>'));
                    } else {
                    // Add operation
                    $this->db->insert('template_default', $dataFiles);

                      echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
                   }
                   }
                
            }
            
                // Continue with your logic (success response, etc.)
            } else {
                // Handle case when any of the file inputs are empty or upload fails
                echo json_encode(array('status' => 'error', 'message' => 'File upload failed.'));
            }
        }

           public function Delete_tem_header(){
            if($this->session->userdata('user_login_access') != False) {
            $id = $this->input->post('id');
            $result_del = $this->Certificate_modal->Delete_tem_header($id);//
            if($result_del){
            echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));

            }

            }
            else{
            redirect(base_url() , 'refresh');
            }
            }
   
}