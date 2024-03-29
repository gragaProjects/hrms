<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require 'vendor/autoload.php';
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;
//require FCPATH .'assets/mpdf/src/Mpdf.php';
class Payroll extends CI_Controller {
/**
* Index Page for this controller.
*$individual_info
* Maps to the following URL
*      http://example.com/index.php/welcome
*  - or -
*      http://example.com/index.php/welcome/index
*  - or -
* Since this controller is set as the default controller in
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see https://codeigniter.com/user_guide/general/urls.html
*/
function __construct() {
parent::__construct();
$this->load->database();
$this->load->model('login_model');
$this->load->model('dashboard_model');
$this->load->model('employee_model');
$this->load->model('leave_model');
$this->load->model('payroll_model');
$this->load->model('settings_model');
$this->load->model('organization_model');
$this->load->model('loan_model');
}
public function index()
{
#Redirect to Admin dashboard after authentication
if ($this->session->userdata('user_login_access') == 1)
redirect('dashboard/Dashboard');
$data=array();
#$data['settingsvalue'] = $this->dashboard_model->GetSettingsValue();
$this->load->view('login');
}
public function Salary_Type(){
if($this->session->userdata('user_login_access') != False) {
$data['typevalue'] = $this->payroll_model->GetsalaryType();
$this->load->view('backend/salary_type',$data);
}
else{
redirect(base_url() , 'refresh');
}
}
public function salarytype_edit(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->uri->segment(3);//
$data['typevalue'] = $this->payroll_model->GetsalaryType();
$data['typevalue_edit'] = $this->payroll_model->SalaryType_edit($id);
$this->load->view('backend/salary_type',$data);
}
else{
redirect(base_url() , 'refresh');
}
}

public function Add_Sallary_Type(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$type = $this->input->post('typename');
$this->load->library('form_validation');
$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
$this->form_validation->set_rules('typename',' salary type','trim|required|xss_clean', array('required'      => 'This %s field is required.',));
if ($this->form_validation->run() == FALSE) {
$error = validation_errors();
echo json_encode(array('error'=>$error));
}else{
$val = $type;
$table = 'salary_type';
$data = array('salary_type'=> $val,'isActive'=> 1);
if($this->settings_model->Check_field_exists($val,$data,$table)){
echo json_encode(array('error'=>'<p>This salary type is already exists</p>'));
} else{
$data = array();
$data = array(
'salary_type' => $type
);
$success = $this->payroll_model->Add_typeInfo($data);
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
public function Update_Sallary_Type(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$type = $this->input->post('typename');
$this->form_validation->set_rules('typename', 'name', 'trim|required');
if ($this->form_validation->run() == FALSE)
{
$error = validation_errors();
echo json_encode(array('error'=>$error));
}else{
$data = array(
'salary_type' => $type
);
$success = $this->payroll_model->Update_typeInfo($id,$data);
if($success){
echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
}

}

}
else{
redirect(base_url() , 'refresh');
}
}
public function Delete_SalaryType(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$result_del = $this->payroll_model->Delete_SalaryType($id);//
if($result_del){
echo json_encode(array('status'=>'success','message'=> 'Successfully Deleted'));

}

}
else{
redirect(base_url() , 'refresh');
}
}
public function GetSallaryTypeById(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->get('id');
$data['typevalueid'] = $this->payroll_model->Get_typeValue($id);
echo json_encode($data);
}
else{
redirect(base_url() , 'refresh');
}
}
public function GetSallaryById(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->get('id');
$data=array();
// $data['salaryvaluebyid'] = $this->payroll_model->Get_Salary_Value($id);
// $data['salarypayvaluebyid'] = $this->payroll_model->Get_Salarypay_Value($id);
$data['salaryvalue'] = $this->payroll_model->GetsalaryValueByID($id);
$data['loanvaluebyid'] = $this->payroll_model->GetLoanValueByID($id);
echo json_encode($data);
}
else{
redirect(base_url() , 'refresh');
}
}
public function Generate_salary(){
if($this->session->userdata('user_login_access') != False) {
$data['typevalue'] = $this->payroll_model->GetsalaryType();
$data['employee'] = $this->employee_model->emselect();
$data['salaryvalue'] = $this->payroll_model->GetAllSalary();
$data['department'] = $this->organization_model->depselect();
$data['businessunitvalue'] = $this->employee_model->businessunitvalue();
$data['allowance_values'] = $this->employee_model->getallowancevalue();
$data['deduction_values'] = $this->employee_model->getdeductionvalue();
$this->load->view('backend/salary_view',$data);
}
else{
redirect(base_url() , 'refresh');
}
}
//allowance
public function Add_allowance()
{
if($this->session->userdata('user_login_access') != False) {
$emp_id = $this->input->post('emp_id');
$salaryid = $this->input->post('salaryid');
$allowance = $this->input->post('allowance');
$allowamount = $this->input->post('allowamount');
$total_allowance = $this->input->post('total_allowance');
$month = $this->input->post('month');

// Store processed allowances
 $processedAllowances = [];
 $duplicateAllowances = [];


//multiple inputs
foreach($allowance as $index => $value)
{
$s_allowance = $value;
$s_allowamount = $allowamount[$index];

// Check if the allowance has already been processed
    if (in_array($s_allowance, $processedAllowances)) {
        continue; // Skip duplicate entry
    }
  // Check if the allowance already exists in the database
    $existingAllowance = $this->payroll_model->get_allowance_by_name($s_allowance,$emp_id,$month);

    if (!$existingAllowance) {

$data = array(
'emp_id' => $emp_id,
'salaryid' => $salaryid,
'allowance' => $s_allowance,
'allowance_amount' => $s_allowamount,
'total_allowance' => $s_allowamount,
'month' => $month,

);

//print_r($data);
$success = $this->payroll_model->Add_Allowance($data);
  if ($success) {
    // Add the processed allowance to the array
    $processedAllowances[] = $s_allowance;
 }
}else{
     // Allowance already exists, add it to the duplicate allowances array
  $duplicateAllowances[] = $s_allowance;
}
}
//if($success){
//echo json_encode(array('status'=>'success','message'=>'Allowance Added Successfully '));
//}
  if (!empty($duplicateAllowances)) {
            // $response['status'] = 'error';
            // $response['message'] = 'Duplicate deductions found: ' . implode(', ', $duplicateDeductions);
            echo json_encode(array('status'=>'error','message'=>'Duplicate allowances  found: ' . implode(', ', $duplicateAllowances)));
        }else{
            echo json_encode(array('status'=>'success','message'=>'Allowance Added Successfully '));
        }

}
}
//get allowance
public function Get_emp_allowance(){
if($this->session->userdata('user_login_access') != False) {
$emid = $this->input->get('emid');
$salaryid = $this->input->get('salaryid');
$month = $this->input->get('date');
$getallowance = $this->payroll_model->Get_emp_allowance($emid,$salaryid,$month);
if($getallowance){
$i = 1;
foreach($getallowance as $value){
echo' <tr>
    <td scope="row">'.$i.'</td>
    <td>'.$value->allowance.'</td>
    <td>'.$value->allowance_amount.'</td>
    <td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delallowance" data-id="'.$value->id.'"><i class="fa fa-trash-o"></i></button></td>
</tr>';
 // Add the allowance amount to the total
        $totalAmount += floatval($value->allowance_amount);
$i++; }
// Echo the total allowance amount
      echo '<script>$(".totalallow").text(' . $totalAmount . ');</script>';
}
}
}
//delete allowance
public function deleteallowance(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$result = $this->payroll_model->deleteallowance($id);
if($result){
echo json_encode(array('status'=>'success','message'=>'Successfully Deleted'));
}
}
}
//add deduction

public function Add_deduction()
{
if($this->session->userdata('user_login_access') != False) {
$emp_id = $this->input->post('emp_id');
$salaryid = $this->input->post('salaryid');
$deduction = $this->input->post('deduction');
$deductionamount = $this->input->post('deductionamount');
$total_deduction = $this->input->post('total_deduction');
$month = $this->input->post('month');

// Store processed deductions
$processedDeductions = [];
   $duplicateDeductions = [];
//multiple inputs
foreach($deduction as $index => $value)
{
$s_deduction = $value;
$s_deductionamount = $deductionamount[$index];

// Check if the deduction has already been processed
if (in_array($s_deduction, $processedDeductions)) {
    continue; // Skip duplicate entry
}
// Check if the deduction already exists in the database
 $existingDeduction = $this->payroll_model->get_deduction_by_name($s_deduction,$emp_id,$month);

if (!$existingDeduction) {
$data = array(
'emp_id' => $emp_id,
'salaryid' => $salaryid,
'deduction' => $s_deduction,
'deduction_amount' => $s_deductionamount,
'total_deduction' => $s_deductionamount,
'month' => $month,

);// print_r($data);
$success = $this->payroll_model->Add_deductiom($data);
 if ($success) {
    // Add the processed deduction to the array
    $processedDeductions[] = $s_deduction;
   }
 } else {
                // Deduction already exists, add it to the duplicate deductions array
                $duplicateDeductions[] = $s_deduction;
            }
}
// //if($success){
// echo json_encode(array('status'=>'success','message'=>'Deduction Added Successfully '));
// //}


 // Prepare the response
        $response = array('status' => 'success', 'message' => 'Deduction Added Successfully');

        if (!empty($duplicateDeductions)) {
            // $response['status'] = 'error';
            // $response['message'] = 'Duplicate deductions found: ' . implode(', ', $duplicateDeductions);
            echo json_encode(array('status'=>'error','message'=>'Duplicate deductions found: ' . implode(', ', $duplicateDeductions)));
        }else{
            echo json_encode(array('status'=>'success','message'=>'Deduction Added Successfully '));
        }

        

}
}
//get Deduction
public function Get_emp_deduction(){
if($this->session->userdata('user_login_access') != False) {
$emid = $this->input->get('emid');
$salaryid = $this->input->get('salaryid');
$month = $this->input->get('date');
$getdeduction = $this->payroll_model->Get_emp_deduction($emid,$salaryid,$month);
if($getdeduction){
$i = 1;
foreach($getdeduction as $value){
echo' <tr>
    <td scope="row">'.$i.'</td>
    <td>'.$value->deduction.'</td>
    <td>'.$value->deduction_amount.'</td>
    <td><button title="Delete" class="btn btn-sm btn-info waves-effect waves-light deldeduction" data-id="'.$value->id.'"><i class="fa fa-trash-o"></i></button></td>
</tr>';
// Add the allowance amount to the total
        $totalAmount += floatval($value->deduction_amount);
$i++; }
// Echo the total allowance amount
      echo '<script>$(".totaldeduct").text(' . $totalAmount . ');</script>';
}
}
}
//delete Deduction
public function deletededuction(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$result = $this->payroll_model->deletededuction($id);
if($result){
echo json_encode(array('status'=>'success','message'=>'Successfully Deleted'));
}
}
}

// Generates the salary
public function Add_Sallary_Pay(){
if($this->session->userdata('user_login_access') != False) {
$id = $this->input->post('id');
$emid = $this->input->post('emid');
$month = $this->input->post('month');
$basic = $this->input->post('basic');
$totalday = $this->input->post('month_work_hours');
$totalday = $this->input->post('hours_worked');
$loan = $this->input->post('loan');
$loanid = $this->input->post('loan_id');
$total = $this->input->post('total_paid');
$paydate = $this->input->post('paydate');
$status = $this->input->post('status');
$paid_type = $this->input->post('paid_type');
$this->form_validation->set_error_delimiters();
$this->form_validation->set_rules('emid', 'Employee Id', 'trim|required');
$this->form_validation->set_rules('basic', 'Employee Basic', 'trim|required|min_length[2]|max_length[7]|xss_clean');
if ($this->form_validation->run() == FALSE) {
echo validation_errors();
} else {

$data = array();
$data = array(
'emp_id' => $emid,
'month' => $month,
'paid_date' => $paydate,
'total_days' => $totalday,
'basic' => $basic,
'loan' => $loan,
'total_pay' => $total,
'status' => $status,
'paid_type' => $paid_type
);


if(empty($id)){
$success = $this->payroll_model->insert_Salary_Pay($data);
if(empty($loanid)){
#$loaninfo = $this->payroll_model->GetloanInfo($emid);
echo "Successfully Added";
} else {
$loanvalue = $this->loan_model->GetLoanValuebyLId($loanid);
#$loaninfo = $this->payroll_model->GetloanInfo($emid);
if(!empty($loanvalue)){
$period = $loanvalue->install_period - 1;
$number = $loanvalue->loan_number;
$data = array();
$data = array(
'emp_id' => $emid,
'loan_id' => $loanid,
'loan_number' => $number,
'install_amount' => $loan,
/*'pay_amount' => $payment,*/
'app_date' => $paydate,
/*'receiver' => $receiver,*/
'install_no' => $period
/*'notes' => $notes*/
);
$success = $this->loan_model->Add_installData($data);
$totalpay = $loanvalue->total_pay + $loan;
$totaldue = $loanvalue->amount - $totalpay;
/*$period = $loanvalue->install_period - 1;*/
if($period == '1'){
$status = 'Done';
}
$data = array();
$data = array(
'total_pay'=>$totalpay,
'total_due'=>$totaldue,
'install_period'=>$period,
'status'=>'Done'
);
$success = $this->loan_model->update_LoanData($loanid,$data);
} else {
echo "Successfully added But your Loan number is not available";
}
}
echo "Successfully Added";
} else {
$success = $this->payroll_model->Update_SalaryPayInfo($id,$data);
echo "Successfully Updated";
}

}
}
else{
redirect(base_url() , 'refresh');
}
}
// From Salary List - Not Sure
public function Add_Salary(){
if($this->session->userdata('user_login_access') != False) {
$sid = $this->input->post('sid');
$aid = $this->input->post('aid');
$did = $this->input->post('did');
$em_id = $this->input->post('emid');
/*$type = $this->input->post('typeid');*/
$basic = $this->input->post('basic');
$medical = $this->input->post('medical');
$houserent = $this->input->post('houserent');
$bonus = $this->input->post('bonus');
$provident = $this->input->post('provident');
$bima = $this->input->post('bima');
$tax = $this->input->post('tax');
$others = $this->input->post('others');
$this->load->library('form_validation');
$this->form_validation->set_error_delimiters();
$this->form_validation->set_rules('basic', 'basic', 'trim|required|min_length[3]|max_length[10]|xss_clean');
if ($this->form_validation->run() == FALSE) {
echo validation_errors();
#redirect("employee/view?I=" .base64_encode($em_id));
} else {
$data = array();
$data = array(
'emp_id' => $em_id,
/*'type_id' => $type,*/
'basic' => $basic
);
if(!empty($sid)){
$success = $this->employee_model->Update_Salary($sid,$data);
#$this->session->set_flashdata('feedback','Successfully Updated');
#echo "Successfully Updated";
#$success = $this->employee_model->Add_Salary($data);
$insertId = $this->db->insert_id();
#$this->session->set_flashdata('feedback','Successfully Added');
#echo "Successfully Added";
$data1 = array();
$data1 = array(
'salary_id' => $sid,
'medical' => $medical,
'house_rent' => $houserent,
'bonus' => $bonus
);
$success = $this->employee_model->Update_Addition($aid,$data1);

$data2 = array();
$data2 = array(
'salary_id' => $sid,
'provident_fund' => $provident,
'bima' => $bima,
'tax' => $tax,
'others' => $others
);
$success = $this->employee_model->Update_Deduction($did,$data2);
//echo "Successfully Updated";
if($success){
echo json_encode(array('status'=>'success','message'=>'Successfully Updated'));
}
} else {
$success = $this->employee_model->Add_Salary($data);
$insertId = $this->db->insert_id();
#$this->session->set_flashdata('feedback','Successfully Added');
#echo "Successfully Added";
$data1 = array();
$data1 = array(
'salary_id' => $insertId,
'medical' => $medical,
'house_rent' => $houserent,
'bonus' => $bonus
);
$success = $this->employee_model->Add_Addition($data1);
$data2 = array();
$data2 = array(
'salary_id' => $insertId,
'provident_fund' => $provident,
'bima' => $bima,
'tax' => $tax,
'others' => $others
);
$success = $this->employee_model->Add_Deduction($data2);
// echo "Successfully Added";
if($success){
echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
}
}
}
}
else{
redirect(base_url() , 'refresh');
}
}
public function Get_PayrollDetails(){
$depid = $this->input->get('dep_id');
$dateval = $this->input->get('date_time');

$orderdate = explode('-', $dateval);
$month = $orderdate[0];
$year = $orderdate[1];

$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$holiday = $this->payroll_model->GetHolidayByYear($dateval);
$totalday = 0;
foreach($holiday as $value){
#$start = date_create($value->from_date);
#$end = date_create($value->to_date);

$days = $value->number_of_days;
#$inday = $days->format("%a");
#$total = array_sum($inday);

$totalday = $totalday + $days;
}
$totalholiday = $totalday;
$m = date('m');
$y = date('Y');
function getDays($y,$m){
$allday = cal_days_in_month(CAL_GREGORIAN,$m,$y);
$wed = array();
for($i = 1; $i<= $allday; $i++){
$daye  = date('Y-m-'.$i);
$result = date("D", strtotime($daye));
if($result == "Fri"){
$fri[] = date("Y-m-d", strtotime($daye)). " ".$result."<br>";
}
}
return  count($fri);
}
$fri = getDays($y, $m);
$totalweekend = $fri;
$holidays = $totalholiday + $totalweekend;
$monthday = $day - $holidays;

$totalmonthhour = $monthday * 8;
$totalmonthhour;
$employee = $this->payroll_model->GetDepEmployee($depid);
foreach($employee as $value){
$hourrate = $value->total/$totalmonthhour;
echo "<tr>
    <td>$value->em_code</td>
    <td>$value->first_name</td>
    <td>$value->total</td>
    <td>$hourrate</td>
    <td>$totalmonthhour</td>
    <td><a href='' data-id='$value->em_id' class='btn btn-sm btn-info waves-effect waves-light salaryGenerateModal' data-toggle='modal' data-target='#SalaryTypemodel' data-hour='$totalmonthhour'>Generate Salary</a></td>
</tr>";
}

}
// Original one commented out above
public function Salary_List(){
if($this->session->userdata('user_login_access') != False) {

$data['salary_info'] = $this->payroll_model->getAllSalaryData();
$this->load->view('backend/salary_list', $data);
}
else {
redirect(base_url() , 'refresh');
}
}
// Start Invoice
public function Invoice(){
if($this->session->userdata('user_login_access') != False) {
/*$data['typevalue'] = $this->payroll_model->GetsalaryType();*/
$id                         = $this->input->get('Id');
$eid                         = $this->input->get('em');
$data2                      = array();
$data['salary_info'] = $this->payroll_model->getAllSalaryDataById($id);
// $data['salary_info']        = $this->payroll_model->getAllSalaryID($id);
$data['employee_info']      = $this->payroll_model->getEmployeeID($eid);
$data['salaryvaluebyid']    = $this->payroll_model->Get_Salary_Value($eid); // 24
$data['salarypaybyid']      = $this->payroll_model->Get_SalaryID($eid);
$salarycurrency = $data['salarypaybyid']->currencytype;
//print_r($data['salarypaybyid']->currencytype     );
$data['salarycurrencytype']      = $this->payroll_model->Get_SalaryCurrency($salarycurrency);
//print_r($data['salarycurrencytype']->currency_name);
$data['salaryvalue']        = $this->payroll_model->GetsalaryValueByID($eid); // 25000
$data['loanvaluebyid']      = $this->payroll_model->GetLoanValueByID($eid);
$data['settingsvalue']      = $this->settings_model->GetSettingsValue();
$data['addition'] = $this->payroll_model->getAdditionDataBySalaryID($data['salaryvalue']->id);
$data['diduction'] = $this->payroll_model->getDiductionDataBySalaryID($data['salaryvalue']->id);
//$data['diduction'] = $this->payroll_model->getDiductionDataBySalaryID($data['salaryvalue']->id);
//$month = date('m');
//$data['loanInfo']      = $this->payroll_model->getLoanInfoInvoice($id, $month);
$data['otherInfo']      = $this->payroll_model->getOtherInfo($eid);
$data['bankinfo']      = $this->payroll_model->GetBankInfo($eid);
//organisation info
$data['organisationvalue'] = $this->settings_model->GetOrganisationValue();
//Count Add/Did
$month_init = $data['salary_info']->month;
$month = date("n",strtotime($month_init));
$year = $data['salary_info']->year;
$id_em = $data['employee_info']->em_id;
$data['id_em']=$id_em;
$data['month']=$month;
if ($month<10){
$month = '0' . $month;
}
//$data['hourlyAdditionDiduction']      = $month;
$employeePIN = $this->getPinFromID($id_em);
// Count Friday
$fridays = $this->count_friday($month, $year);

$month_holiday_count = $this->payroll_model->getNumberOfHolidays($month, $year);
// Total holidays and friday count
$total_days_off = $fridays + $month_holiday_count->total_days;
// Total days in the month
$total_days_in_the_month = $this->total_days_in_a_month($month, $year);
$total_work_days = $total_days_in_the_month - $total_days_off;
$total_work_hours = $total_work_days * 8;
//Format date for hours count in the hours_worked_by_employee() function
$start_date = $year . '-' . $month . '-' . 1;
$end_date = $year . '-' . $month . '-' . $total_days_in_the_month;
// Employee actually worked
$employee_actually_worked = $this->hours_worked_by_employee($employeePIN->em_code, $start_date, $end_date);  // in hours
//Get his monthly salary
$employee_salary = $this->payroll_model->GetsalaryValueByID($id_em);
if($employee_salary) {
$employee_salary = $employee_salary->total;
}
// Hourly rate for the month
$hourly_rate = $employee_salary / $total_work_hours; //15.62
$work_hour_diff = abs($total_work_hours) - abs($employee_actually_worked[0]->Hours);

//echo $employee_actually_worked[0]->Hours;
$data['work_h_diff'] = $work_hour_diff;
$addition = 0;
$diduction = 0;
if($work_hour_diff < 0) {
$addition = abs($work_hour_diff) * $hourly_rate;
} else if($work_hour_diff > 0) {
$diduction = abs($work_hour_diff) * $hourly_rate;
}
// Loan
$loan_amount = $this->payroll_model->GetLoanValueByID($id_em);
if($loan_amount) {
$loan_amount = $loan_amount->installment;
}
// Sending

$data['a'] = $addition;
$data['d'] = $data['salary_info']->diduction  ;
$data['wd'] = $data['salary_info']->diduction -  $loan_amount ;
$data['total_work'] =  $total_work_hours;
$data['dataval'] = $data;
//print_r($data['dataval']);
$this->load->view('backend/invoice',$data);

}
else {
redirect(base_url() , 'refresh');
}
}
// Start Invoice
//new
public function load_employee_Invoice_by_EmId_for_pay(){
if($this->session->userdata('user_login_access') != False) {
//$eid         = $this->input->get('emid');
$busunit         = $this->input->get('busunit');
$dateval      = $this->input->get('date_time');
$orderdate = explode('-', $dateval);
$month = $orderdate[0];
$year = $orderdate[1];
$month = $this->month_number_to_name($month);
//getAllSalaryDataByMonthYearEm($eid,$month,$year)
$get_salary_info = $this->payroll_model->getAllSalaryDataByMonthYearEm($busunit,$month,$year);
if( $get_salary_info){
foreach($get_salary_info as $data){
echo '<tr>
    
    <td>'.$data->em_code.'</td>
    <td>'.$data->first_name .' '.$data->last_name.'</td>
    <td>'.$data->paid_date.'</td>
    <td>'.$data->status.'</td>
    <td><a href='.base_url().'Payroll/Pdf?Id='.$data->pay_id.'&em='.$data->em_id.' title="Edit" class="btn btn-sm btn-info waves-effect waves-light" target="_blank"><i class="fa fa-print"></i></a></td>
</tr>';
}
}else{
      echo "<tr>
                    <td colspan='5' style='text-align:center'>No Data Found</td>
                 
                   
                </tr>";
}
}
}
            public function printpdf(){
            $eid                         = $this->input->get('emid');
            $dateval                     = $this->input->get('date_time');
            $orderdate = explode('-', $dateval);
            $month = $orderdate[0];
            $year = $orderdate[1];
            $month = $this->month_number_to_name($month);
            //die($year);
            $data2                      = array();
            $salary_info = $this->payroll_model->getAllSalaryDataByMonthYearEm($eid,$month,$year);
            //print_r($salary_info);
            //die();
            if(empty($salary_info)){
            echo "No Data Found";
            die();
            }
            $employee_info      = $this->payroll_model->getEmployeeID($eid);
            $salaryvaluebyid    = $this->payroll_model->Get_Salary_Value($eid); // 24
            $salarypaybyid      = $this->payroll_model->Get_SalaryID($eid);
            $salaryvalue        = $this->payroll_model->GetsalaryValueByID($eid); // 25000
            $loanvaluebyid      = $this->payroll_model->GetLoanValueByID($eid);
            $settingsvalue      = $this->settings_model->GetSettingsValue();
            $addition = $this->payroll_model->getAdditionDataBySalaryID($salaryvalue->id);
            $diduction = $this->payroll_model->getDiductionDataBySalaryID($salaryvalue->id);
            //n
            $salarypaybyid      = $this->payroll_model->Get_SalaryID($eid);
            $salarycurrency = $salarypaybyid->currencytype;
            //print_r($data['salarypaybyid']->currencytype     );
            $salarycurrencytype      = $this->payroll_model->Get_SalaryCurrency($salarycurrency);
            
            //$data['diduction'] = $this->payroll_model->getDiductionDataBySalaryID($salaryvalue->id);
            //print_r($salary_info);
            //$month = date('m');
            //$data['loanInfo']      = $this->payroll_model->getLoanInfoInvoice($id, $month);
            $otherInfo      = $this->payroll_model->getOtherInfo($eid);
            $bankinfo      = $this->payroll_model->GetBankInfo($eid);
            //print_r($salary_info);
            //Count Add/Did
            $month_init = $salary_info->month;
            $month = date("n",strtotime($month_init));
            $year = $salary_info->year;
            $id_em = $employee_info->em_id;
            if ($month<10){
            $month = '0' . $month;
            }
            //$data['hourlyAdditionDiduction']      = $month;
            $employeePIN = $this->getPinFromID($id_em);
            // Count Friday
            $fridays = $this->count_friday($month, $year);
            
            $month_holiday_count = $this->payroll_model->getNumberOfHolidays($month, $year);
            // Total holidays and friday count
            $total_days_off = $fridays + $month_holiday_count->total_days;
            // Total days in the month
            $total_days_in_the_month = $this->total_days_in_a_month($month, $year);
            $total_work_days = $total_days_in_the_month - $total_days_off;
            $total_work_hours = $total_work_days * 8;
            //Format date for hours count in the hours_worked_by_employee() function
            $start_date = $year . '-' . $month . '-' . 1;
            $end_date = $year . '-' . $month . '-' . $total_days_in_the_month;
            // Employee actually worked
            $employee_actually_worked = $this->hours_worked_by_employee($employeePIN->em_code, $start_date, $end_date);  // in hours
            //Get his monthly salary
            $employee_salary = $this->payroll_model->GetsalaryValueByID($id_em);
            if($employee_salary) {
            $employee_salary = $employee_salary->total;
            }
            // Hourly rate for the month
            $hourly_rate = $employee_salary / $total_work_hours; //15.62
            $work_hour_diff = abs($total_work_hours) - abs($employee_actually_worked[0]->Hours);
            
            $work_h_diff = $work_hour_diff;
            //$addition = 0;
            //$diduction = 0;
            if($work_hour_diff < 0) {
            $addition = abs($work_hour_diff) * $hourly_rate;
            } else if($work_hour_diff > 0) {
            $diduction = abs($work_hour_diff) * $hourly_rate;
            }
            // Loan
            $loan_amount = $this->payroll_model->GetLoanValueByID($id_em);
            if($loan_amount) {
            $loan_amount = $loan_amount->installment;
            }
            // Sending
            
            $obj_merged = (object) array_merge((array) $employee_info, (array) $salaryvaluebyid, (array) $salarypaybyid, (array) $salaryvalue, (array) $loanvaluebyid);
            $dd = date('j F Y',strtotime($salary_info->paid_date));
            
            $a = $addition;
            //print_r($a);
            $d = $diduction;
            //echo $d;
            $wd = $salary_info->diduction -  $loan_amount ;
            $organisationvalue = $this->settings_model->GetOrganisationValue();
            //echo  $organisationvalue->organisation;
            $cur_month = date('M', strtotime($salary_info->month));
            $cur_year = $salary_info->year;
            //print_r($addition);
            $base = base_url();
            $totalinwords = $this->NumberintoWords($salary_info->total_pay);
            //$this->load->view('backend/payslip',$data);
            //$html = $this->load->view('backend/payslip','',true);
            // $html = '';
            $html = '
            <link href="'. base_url().'assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <style>
            .table-bordered td, .table-bordered th {
            
            color: black;
            font-size: 10px;
            }
            table td, .table th {
            padding: 2px !important;
            }
            
            tr td:nth-child(2){
            border-right: 3px double black;
            color: white;
            }
            tr td:nth-child(4){
            border-right: 3px double black;
            color: white;
            }
            table tr:nth-child(3){
            border-bottom: 3px double black;
            color: white;
            }
            
            tr td:nth-child(even) {
            color: black;
            font-weight: bold;
            }
            
            .table td {
            
            padding: 1px !important;
            }
            
            
            table td {
            width: 15% !important;
            
            }
            table tr td{
            border-bottom: 2px;
            border-bottom-style:  dotted;
            border-bottom-color: black;
            }
            
            
            table {
            margin-left:  0px;
            margin-right: 0px;
            }
            table tr td:nth-child(odd){
            border-right:2px dotted black;
            }
            
            </style>
            <div  style="border: 3px solid black;width: 80%; margin: auto ; text-align: center;">
                
                
                <div class="row" >
                    <div class="col-md-12">
                        <table style=" width: 100%;" >
                            <tr>
                                <td  style="width:23% !important; border-right: 0px double white;border-bottom: 0px dotted white;margin:0!important;padding:0!important;"  class="text-left">
                                <img src="'.base_url().'/assets/images/logo/logo1.png" style="width: 100px;" /> </td>
                                <td  style="width:53% !important ;border-right: 0px double white;border-bottom: 0px dotted white;font-weight:normal;margin:0;padding:0 !important;vertical-align: text-top;" rowspan="2" class="text-center"><p style="font-size:18px;font-weight:normal" >';
                                    if(isset($organisationvalue->organisation)){
                                    $html .=  ''.$organisationvalue->organisation.'';
                                    }
                                    $html .=  '<br><p style="font-size:10px;font-weight:normal;margin-bottom: 0px;padding-bottom: 0 !important;">'; if(isset($organisationvalue->address)){  $html .=  ''. $organisationvalue->address.'';
                                        };
                                    $html .=  '</p></p>
                                </td>
                                <td  style="width:23%!important; border-right: 0px double white;border-bottom: 0px dotted white;vertical-align: text-top;"  class="text-right"> <img src="'.base_url().'/assets/filename.png" style="max-width: 100px; height: 70px;" /></td>
                            </tr>
                            
                            
                        </table>';
                        
                        $obj_merged = (object) array_merge((array) $employee_info, (array) $salaryvaluebyid, (array) $salarypaybyid, (array) $salaryvalue, (array) $loanvaluebyid);
                        $html .=  ' <div class="col-md-12 text-center " style="">
                            <p style="margin-bottom: 0px;padding-bottom: 0 !important;">
                                PAY SLIP ('
                                .date('M', strtotime($salary_info->month)) .'-'.$salary_info->year.
                            ')</p>
                        </div>
                        <table class="table table-bordered  payslip_info table-responsive" style=" border-top: 4px double black ;border-bottom : 3px double black; width:100% ">
                            <tr >
                                <td style=" width: 15%; "  >Employee No</td>
                                <td  class="text-center" style=" width: 15%;">'.$obj_merged->em_code.'</td>
                                <td style=" width: 15%" >Employee Name</td>
                                <td  class="text-center" style=" width: 15%;">'.$obj_merged->first_name.' '.$obj_merged->last_name.'</td>
                                <td style=" width: 15%;" >Department</td>
                                <td  class="text-center" style=" width: 15%;border-right: 0px double white;"> '.$otherInfo[0]->dep_name.'</td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td class="text-center"> '.$otherInfo[0]->nationality.'</td>
                                <td>Designation</td>
                                <td class="text-center"> '.$otherInfo[0]->designation.'</td>
                                <td>Location</td>
                                <td class="text-center" style="border-right: 0px double white;"> '.$otherInfo[0]->city.'</td>
                                
                            </tr>
                            
                            <tr class="double-bottom" >
                                <td>Total No of Days</td>
                                <td class="text-center">';
                                    $html.=''.date('t',strtotime($salary_info->month)).'';
                                $html .=  '</td>
                                <td>Total Working Days</td>
                                <td class="text-center"> ';
                                    
                                    $days = ceil($salary_info->total_days / 8);
                                    $html.=''. $days.'';
                                    $html .= ' </td>
                                    <td>Total Absent Days</td>
                                    <td class="text-center" style="border-right: 0px double white;">'
                                    . (date('t', strtotime($salary_info->month)) - $days) . '</td>
                                </tr>';
                            
                            
                                $html .= ' <tr >
                                
                                <td colspan="2"  class="text-center "  style=" border-top: 3px double black; font-weight:bold;border-right: 3px double black;border-bottom:1px solid black;">Earnings</td>
                                <td colspan="2"  class="text-center "  style=" border-top: 3px double black; font-weight:bold;border-right: 3px double black;border-bottom:1px solid black;">Allowances</td>
                                <td  colspan="2" class="text-center "  style="border-top: 3px double black;border-right: 0px double white; font-weight:bold; border-bottom:1px solid black;">Deductions</td>
                            </tr>
                            
                            <tr>
                                <td style="border-right:2px dotted black " >Basic Salary</td>
                                <td class="text-right" >'.$addition[0]->basic.'   </td>
                                <td class="">Internet Allowance </td>
                                <td class="text-right">  </td>
                                <td class="" >Loan</td>
                                <td class="text-right" style="border-right: 0px double white;">';
                                    if(!empty($salary_info->loan))
                                    {
                                    $html .= ''.$salary_info->loan.'';
                                }; $html .= '  </td>
                            </tr>
                            
                            <tr>
                                <td>HRA</td>
                                <td class="text-right">'.$addition[0]->house_rent.'  </td>
                                
                                <td class="" style="border-right:2px dotted black ">Medical Allowance</td>
                                <td class="text-right" >'.$addition[0]->medical.'  </td>
                                <td class="text-left">Salary Advance</td>
                                <td class="text-right" style="border-right: 0px double white;">  </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td class="text-right"> </td>
                                <td class="">Arrears </td>
                                <td class="text-right">  </td>
                                
                                <td class="">Unpaid Leave  </td>
                                <td class="text-right" style="border-right: 0px double white;">  </td>
                                
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-right"> </td>
                                <td class="">Transportation</td>
                                <td class="text-right">  </td>
                                <td >Other Deduction </td>
                                <td class="text-right" style="border-right: 0px double white;">  </td>
                                
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-right"> </td>
                                <td class="">Others</td>
                                <td class="text-right">  </td>
                                <td > Tax</td>
                                <td class="text-right" style="border-right: 0px double white;">  </td>
                                
                            </tr>
                            <tr>
                                <td>Total Salary</td>
                                <td class="text-right">  '. $salarycurrencytype->currency_symbol.'
                                    '.$total_add = $salary_info->basic + $salary_info->medical + $salary_info->house_rent + $salary_info->bonus.'
                                    
                                    '; /*'.round($total_add,2).' //+$a; */
                                $html .=  '</td>
                                <td class="text-right"></td>
                                <td class="text-right"></td>
                                <td class=""> Total Deduction </td>
                                <td class="text-right" style="border-right: 0px double white;"><p class="text-right">'.$salarycurrencytype->currency_symbol.' '.round($d - $salary_info->total_pay).' </p> </td>
                            </tr>
                            <tr style="border-bottom  : 0px solid white; ">
                                <td style="border: 0px solid white;border-bottom  : 0px solid white;">NET PAY</td>
                                <td style="border: 0px solid white;border-bottom  : 0px solid white; ">'.$salarycurrencytype->currency_symbol.' '.$salary_info->total_pay .' </td>
                            </tr>
                            
                            
                        </table>
                        
                        <div class="">
                            <div class="col-md-12 text-left" ><!-- margin-top: 15px; -->
                            <span style="font-size: 12px; margin-right: 15px; " > (Rupees : '. $totalinwords.')</span>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p style="font-size: 10px; margin-bottom: 0px; margin-top: 30px;"> This is system generated payslip and does not require signature.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        
        
        
        $mpdf = new \Mpdf\Mpdf([
        'format'=>'A4',
        'margin_bottom'=>0,
        'orientation'=>'L'
        
        ]);
        //QR
        $qrCode = new QrCode($organisationvalue->website);
        // Save black on white PNG image 100 px wide to filename.png. Colors are RGB arrays.
        $output = new Output\Png();
        $data = $output->output($qrCode, 50, [255, 255, 255], [0, 0, 0]);
        file_put_contents('assets/filename.png', $data);
        // Echo an HTML table
        $output = new Output\Html();
        // echo $output->output($qrCode);
        /*qr*/
        $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="33%" style="border-bottom:0px solid white;border-right:0px solid white">{DATE j-M-Y}</td>
                <td width="33%"  style="text-align: right; font-weight: normal; border-bottom:0px solid white;border-right:0px solid white">{PAGENO}/{nbpg}</td>
                
            </tr>
        </table>');
        $filename = "PAY SLIP(".$cur_month. "-".$cur_year.")";
        
        $mpdf->simpleTables = false;
        $mpdf->WriteHTML($html);
        
        $mpdf->Output($filename.'.pdf', 'I');
        }
        
        
        // End Invoice
        private function count_friday($month, $year) {
        $fridays=0;
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($i=1;$i<=$total_days;$i++) {
        if(date('N',strtotime($year.'-'.$month.'-'.$i))==5) {
        $fridays++;
        }
        }
        return $fridays;
        }
        private function total_days_in_a_month($month, $year) {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }
        // Totals hours worked by an emplyee in a month
        private function hours_worked_by_employee($employeeID, $start_date, $end_date) {
        return $this->payroll_model->totalHoursWorkedByEmployeeInAMonth($employeeID, $start_date, $end_date);
        }
        
        
        private function getPinFromID($employeeID) {
        return $this->payroll_model->getPinFromID($employeeID);
        }
        /*GET WORKHOURS OF ANY MONTH - */
        /*||||| Method has not been used anywhere |||||*/
        public function GetSalaryByWorkdays(){
        if($this->session->userdata('user_login_access') != False) {
        // Get the month and year
        $monthName = $this->input->get('monthName');
        $employeeID = $this->input->get('employeeID');
        $year = date("Y");
        // Count Friday
        $fridays = $this->count_friday($monthName, $year);
        $month_holiday_count = $this->payroll_model->getNumberOfHolidays($monthName, $year);
        // Total holidays and friday count
        $total_days_off = $fridays + $month_holiday_count->total_days;
        // Total days in the month
        $total_days_in_the_month = $this->total_days_in_a_month($monthName, $year);
        $total_work_days = $total_days_in_the_month - $total_days_off;
        $total_work_hours = $total_work_days * 8;
        //Format date for hours count in the hours_worked_by_employee() function
        $start_date = $year . '-' . $monthName . '-' . 1;
        $end_date = $total_days_in_the_month . '-' . $monthName . '-' . $total_days_in_the_month;
        // Employee actually worked
        $employee_actually_worked = $this->hours_worked_by_employee($employeeID, $start_date, $end_date);  // in hours
        //Get his monthly salary
        $employee_salary = $this->payroll_model->GetsalaryValueByID($employeeID);
        if($employee_salary) {
        $employee_salary = $employee_salary->total;
        }
        // Hourly rate for the month
        $hourly_rate = $employee_salary / $total_work_hours;
        $work_hour_diff = abs($total_work_hours) - abs($employee_actually_worked[0]->Hours); // 96 - 16 = 80
        $addition = 0;
        $diduction = 0;
        if($work_hour_diff < 0) {
        $addition = abs($work_hour_diff) * $hourly_rate;
        } else if($work_hour_diff > 0) {
        // 80 is > 0 which means he worked less, so diduction = 80 hrs
        // so 80 * hourly rate 208 taka = 17500
        $diduction = abs($work_hour_diff) * $hourly_rate;
        }
        // Loan
        $loan_amount = $this->payroll_model->GetLoanValueByID($employeeID);
        if($loan_amount) {
        $loan_amount = $loan_amount->installment;
        }
        // Sending
        $data = array();
        $data['basic_salary'] = $employee_salary;
        $data['total_work_hours'] = $total_work_hours;
        $data['employee_actually_worked'] = $employee_actually_worked[0]->Hours;
        $data['addition'] = $addition;
        $data['diduction'] = $diduction;
        $data['loan'] = $loan_amount;
        echo json_encode($data);
        }
        else{
        redirect(base_url() , 'refresh');
        }
        }
        public function month_number_to_name($month) {
        $dateObj   = DateTime::createFromFormat('!m', $month);
        return $dateObj->format('F'); // March
        }
        public function get_full_name($first_name, $last_name) {
        return $first_name . ' ' . $last_name;
        }
        // Add or update the salary record
        public function pay_salary_add_record() {
        if($this->session->userdata('user_login_access') != False) {
        $emid = $this->input->post('emid');
        $month = $this->month_number_to_name($this->input->post('month'));
        $basic = $this->input->post('basic');
        $year = $this->input->post('year');
        //$hours_worked = $this->input->post('hours_worked');
        $addition = $this->input->post('addition');
        $diduction = $this->input->post('diduction');
        $loan_id = $this->input->post('loan_id');
        $loan = $this->input->post('loan');
        $total_paid = $this->input->post('total_paid');
        $paydate = $this->input->post('paydate');
        $status = $this->input->post('status');
        $paid_type = $this->input->post('paid_type');
        $total_working_days = $this->input->post('total_working_days');
        $emp_worked_days = $this->input->post('emp_worked_days');
        $type_id = $this->input->post('type_id');
        
        $leave_deduction = $this->input->post('leave_deduction');
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters();
        $this->form_validation->set_rules('paydate', 'paydate', 'trim|required|min_length[3]|max_length[10]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        // redirect("Payroll/Generate_salary");
        } else {
        $data = array();
        $data = array(
        'emp_id' => $emid,
        'month' => $month,
        'year' => $year,
        'paid_date' => $paydate,
        //'total_days' => $hours_worked,
        'basic' => $basic,
        'loan' => $loan,
        'total_pay' => $total_paid,
        'addition' => $addition,
        'diduction' => $diduction,
        'status' => $status,
        'paid_type' => $paid_type,
        'total_working_days' => $total_working_days,
        'emp_worked_days' => $emp_worked_days,
        'leave_deduction' => $leave_deduction,
        'type_id' => $type_id
        );
        
        // See if record exists
        $get_salary_record = $this->payroll_model->getSalaryRecord($emid, $month,$year);
        if($get_salary_record) {
        $payID = $get_salary_record[0]->pay_id;
        $payment_status = $get_salary_record[0]->status;
        }
        // If exists, add/edit
        if( isset($payID) && $payID > 0 ) {
        if($payment_status == "Paid") {
        //echo "Has already been paid";
        echo json_encode(array('status'=>'error','message'=>'Has already been paid'));
        } else {
        $success = $this->payroll_model->updatePaidSalaryData($payID, $data);
        // Do the loan update
        if($success && $status == "Paid") {
        $loan_info = $this->loan_model->GetLoanValuebyLId($loan_id);
        // loan_id and loan fields already grabbed
        if (!empty($loan_info)) {
        $period = $loan_info->install_period - 1;
        $number = $loan_info->loan_number;
        $data = array();
        $data = array(
        'emp_id' => $emid,
        'loan_id' => $loan_id,
        'loan_number' => $number,
        'install_amount' => $loan,
        /*'pay_amount' => $payment,*/
        'app_date' => $paydate,
        /*'receiver' => $receiver,*/
        'install_no' => $period
        /*'notes' => $notes*/
        );
        $success_installment = $this->loan_model->Add_installData($data);
        $totalpay = $loan_info->total_pay + $loan;
        $totaldue = $loan_info->amount - $totalpay;
        $period = $loan_info->install_period - 1;
        $loan_status = $loan_info->status;
        if ($period == '1') {
        $loan_status = 'Done';
        }
        $data = array();
        $data = array(
        'total_pay'         => $totalpay,
        'total_due'         => $totaldue,
        'install_period'    => $period,
        'status'            => $loan_status
        );
        $success_loan = $this->loan_model->update_LoanData($loan_id, $data);
        }
        }
        // echo "Successfully added";
        echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
        }
        } else {
        $success = $this->payroll_model->insertPaidSalaryData($data);
        // Do the loan update
        if($success && $status == "Paid") {
        // Input Status
        $loan_info = $this->loan_model->GetLoanValuebyLId($loan_id);
        
        // loan_id and loan fields already grabbed
        if (!empty($loan_info)) {
        $period = $loan_info->install_period - 1;
        $number = $loan_info->loan_number;
        $data = array();
        $data = array(
        'emp_id' => $emid,
        'loan_id' => $loan_id,
        'loan_number' => $number,
        'install_amount' => $loan,
        /*'pay_amount' => $payment,*/
        'app_date' => $paydate,
        /*'receiver' => $receiver,*/
        'install_no' => $period
        /*'notes' => $notes*/
        );
        $success_installment = $this->loan_model->Add_installData($data);
        $totalpay = $loan_info->total_pay + $loan;
        $totaldue = $loan_info->amount - $totalpay;
        $period = $loan_info->install_period - 1;
        $loan_status = $loan_info->status;
        if ($period == '0') {
        $loan_status = 'Done';
        }
        $data = array();
        $data = array(
        'total_pay'         => $totalpay,
        'total_due'         => $totaldue,
        'install_period'    => $period,
        'status'            => $loan_status
        );
        $success_loan = $this->loan_model->update_LoanData($loan_id, $data);
        }
        //echo "Successfully added";
        echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
        }
        }
        }
        }
        else {
        redirect(base_url() , 'refresh');
        }
        }
        // Generate the list of employees by dept. to generate their payments
        public function load_employee_by_deptID_for_pay(){
        if($this->session->userdata('user_login_access') != False) {
        // Get the month and year
        $date_time = $this->input->get('date_time');
        $busid = $this->input->get('busid');
        //$dep_id = $this->input->get('dep_id');
        $year = explode('-', $date_time);
        $month = $year[0];
        $year = $year[1];
       // echo $date_time;
        
        //$employees = $this->payroll_model->GetDepEmployee($dep_id);
        $employees = $this->payroll_model->GetBusEmployee($busid,$month,$year);
        echo "<tr class='odd loadercell' style='display:none'><td class='dataTables_empty' colspan='8' style='position: absolute;margin-left: auto;margin-right: auto;left: 0;right: 0;text-align: center;'><img class='loader' src='".base_url('assets/loader.gif')."'></td></tr>";
        if($employees){
        $i =1;
       // print_r($employees);die();
        foreach($employees as $employee){
        $full_name = $this->get_full_name($employee->first_name, $employee->last_name);
        // Loan
        $has_loan = $this->payroll_model->hasLoanOrNot($employee->em_id);
        $emid = $employee->em_id;
        $year = explode('-', $date_time);
        $month = $year[0];
        $year = $year[1];
        
        $month =  date("F", mktime(0, 0, 0, $month, 10));
        
        $get_salary_record = $this->payroll_model->getSalaryRecord($emid, $month,$year);
       // print_r( $get_salary_record);
        $payID =  ($get_salary_record  && $get_salary_record[0]->pay_id) ?  $get_salary_record[0]->pay_id : '';
        $payment_status = ($get_salary_record  && $get_salary_record[0]->status) ?  $get_salary_record[0]->status : ''; //$get_salary_record[0]->status;
        $paid_date = ($get_salary_record  && $get_salary_record[0]->paid_date) ?  $get_salary_record[0]->paid_date : ''; // $get_salary_record[0]->paid_date;
        $createdon = ($get_salary_record  && $get_salary_record[0]->createdon) ? $get_salary_record[0]->createdon : '';
      
      
        $final = ($get_salary_record  && $get_salary_record[0]->total_pay) ? $get_salary_record[0]->total_pay : '';// $get_salary_record[0]->total_pay;
        
        echo "
        <tr>
            <td><div class='form-check'>
                <input type='checkbox' class='filled-in chk-col-light-blue sub_chk ' id='exampleCheck$i' data-id='$employee->em_id' data-month='$month' data-year='$year' data-datetime ='$date_time' data-has_loan='$has_loan' data-busunit = '$busid' data-loanstatus = 'checked'>
                <label class='form-check-label' for='exampleCheck$i'></label>
            </div></td>
            <td>$i</td>
            <td>$employee->em_code</td>
            <td>$full_name</td>
            <td>$final</td>";
            if($this->role->User_Permission('generate_payslip','can_add') && $this->role->User_Permission('generate_payslip','can_edit')){
            echo "<td><a href='' class='btn btn-sm btn-info waves-effect waves-light AdditionModal allowancebtn' data-toggle='modal' data-target='#AdditionModal'  data-id='$employee->em_id' data-salaryid='$employee->salaryid' data-month='$date_time' >Allowance</a></td>";
            echo "<td><a href=''class='btn btn-sm btn-info waves-effect waves-light deductionmodal deductionbtn' data-toggle='modal'
            data-target='#DeductionModal' data-id='$employee->em_id' data-salaryid='$employee->salaryid' data-month='$date_time' >Deduction</a></td>";
            }
            if($has_loan === 1){
                 echo "<td>
             <div class='form-check'>
                <input type='checkbox' class='filled-in chk-col-light-blue  loan_sts' id='loan_$employee->id' data-id='$employee->em_id'  data-has_loan='$has_loan'  checked>
                <label class='form-check-label' for='loan_$employee->id'></label>
            </div>
             </td>";
         }else{
            echo "<td></td>";
         }
            
            echo "<td>";
            if($get_salary_record){ 
                if($payment_status == 'Generated'){

                  $payment_status = 'Payslip Generated';
                }
                echo $payment_status;
                }else{
                    echo 'Pending';
                } 
                 echo "</td>";
                echo "<td>"; if(($createdon)) echo date('d  M Y',strtotime($createdon));echo "</td>
                 <td>"; ($paid_date) ? date('d  M Y',strtotime($paid_date)) : '' ;echo "</td>
                    
              </tr>
        ";
        // if($paid_date) { echo date('d  M Y',strtotime($paid_date)) }
        $i++;
        }
        }
        
        }
        else{
        redirect(base_url() , 'refresh');
        }
        }
        //Bulk Generate
        public function generate_payroll_bulk(){
        if($this->session->userdata('user_login_access') != False) {
        $busid = $this->input->post('busunit');
        $datetime = $this->input->post('datetime');
        //$loan_status = $this->input->post('loan_status');
       

       // new
        // Split the string into an array
        $dataArray = explode(",", $this->input->post('joinedData'));

        // Create an associative array with the desired structure
        $result = array();

        for ($i = 0; $i < count($dataArray); $i += 2) {
            $emid = $dataArray[$i];
            $loanStatus = $dataArray[$i + 1];
            $result[] = array(
                "emid" => $emid,
                "loan_status" => $loanStatus,
            );
        }

        // Now $result contains the desired array structure
       // print_r($result);die();
       // new



      //  print_r($loan_status);die();
        if($this->input->post('emids'))
        {
        $data = $this->input->post('emids');
        
        $array = explode(',', $data);
        
       // print_r( $array); die();
       // foreach($array as $val){

        foreach($result as $value){ //new
        $val = $value['emid'];
        $loan_status = $value['loan_status'];
             // print_r("Working");
       
        $year = explode('-', $datetime);
        $month = $year[0];
        $year = $year[1];
        $employeeID = $val;
        //basic salary
        $employee_salary = $this->payroll_model->GetsalaryValueByID($employeeID);
        //basic + HRA
        if($employee_salary){
        $data = array();
        $data['basic_salary'] = $employee_salary->total;
        $data['base_salary'] = $employee_salary->basic;
        $data['base_hra'] = $employee_salary->hra;
        $basic_salary = $employee_salary->total;
        
        //salary id
        $data['type_id'] = $employee_salary->id;
        }
        //total working days
        $month_num = $month;
        //$month_num = $this->input->get('month');
        //month name
        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
        //no of days in month
        $cur_month = date('t',strtotime($month_name));
        //get business unit
        //$busid = $this->input->get('busunit');
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
        //holiday count
        $date = $datetime;
        $holidayreport = $this->leave_model->holidayreport($date,$structureid);//holiday count
        //print_r($holidayreport->total_count);die();
        $t_wokingdays = $cur_month - $holidayreport->total_count;
        $data['total_working_days'] = $cur_month -  $holidayreport->total_count;
        
        //get emp leave count
        $leavecountresult = $this->payroll_model->Get_emp_leave_count($employeeID,$date,$leavestructureid);
        if($leavecountresult)
        {
        $leavecount = $leavecountresult->leavecount;
        }
       
        
        $paidleavecountresult = $this->payroll_model->Get_paid_leave_count($employeeID,$date,$leavestructureid);
         
        //yearly paid leave count
        /**/
        if($paidleavecountresult){
        $currentYear =  $year; //date('Y'); // Get the current year
        $currentMonth = $month;//date('m'); // Get the current month
        $count = 0;
        for ($i = 1; $i <= $currentMonth; $i++) {
        $monthYear = date('F Y', strtotime("$currentYear-$i-01")); // Format the month and year
        //echo $monthYear . '<br>'; // Output the month and year
        $monthlist =  date('m-Y', strtotime("$currentYear-$i-01"));
         $allpaidleave = $this->payroll_model->All_paid_leave_count($employeeID,$monthlist,$leavestructureid);
          $count += $allpaidleave->leavecount;
         
        }
   
       // $allpaidleave = $this->payroll_model->All_paid_leave_count($employeeID,$monthlist,$leavestructureid);
       
        if($allpaidleave->leavecount > $paidleavecountresult->Total_days){
       // if($count > $paidleavecountresult->Total_days){
        
        $paid_result = $count - $paidleavecountresult->Total_days;

        //$paid_result = $allpaidleave->leavecount - $paidleavecountresult->Total_days;
       // $paid_result = $paidleavecountresult->leavecount - $paidleavecountresult->Total_days;
        //$leavecount =  $paid_result;
        
          $leavecount += $paid_result;
         }
         }
         
      
     
        //emp working days
        $data['emp_working_days'] = $t_wokingdays - $leavecount;
        $emp_working_days = $t_wokingdays - $leavecount;

        //allowance
        $allowanceresult = $this->payroll_model->Get_total_allowance($employeeID, $datetime);
        $get_overtime_allowance = $this->payroll_model->Get_overtime_allowance($employeeID, $datetime);
        $sum_allowance = $allowanceresult->total_allowance;
        $data['sum_allowance'] = $allowanceresult->total_allowance;
       
        //Subract overtime allowance
        // Check if $get_overtime_allowance is not null to avoid potential errors
        $Overtimeallowance = '';
        if ($get_overtime_allowance) {
            // Subtract the overtime allowance from the sum allowance
            $data['sum_allowance'] -= $get_overtime_allowance->allowance_amount;
            $sum_allowance  -= $get_overtime_allowance->allowance_amount;

        //Subract overtime allowance
        $data['OvertimeallowanceName'] = $get_overtime_allowance->allowance;
        $data['Overtimeallowance'] = $get_overtime_allowance->allowance_amount;
        $Overtimeallowance .= $get_overtime_allowance->allowance_amount;

        }

      // echo  $Overtimeallowance;

        //deduction
        $deductionresult = $this->payroll_model->Get_total_deduction($employeeID, $datetime);
        $sum_deduction = $deductionresult->total_deduction;
        $data['sum_deduction'] = $deductionresult->total_deduction;
        //per day salary
        $per_day_salary = (($basic_salary + $sum_allowance) * 12) / 365; // with allowance
        //$per_day_salary = ($basic_salary  * 12) / 365; // without allowance
        $data['per_day_salary'] = round($per_day_salary);
        $day_salary =   round($per_day_salary);
        //Leave Deduction
         $leave_deduction = ((($basic_salary + $sum_allowance)  * 12) / 365) * $leavecount; // with allowance
          //$leave_deduction = (($basic_salary  * 12) / 365) * $leavecount; //  ---- old
        //$leave_deduction = $leavecount * $day_salary; // without allowance
        $data['leave_deduction'] = round($leave_deduction);
        
        //half day deduction
        
        $halfleavecountresult = $this->payroll_model->Halfday_emp_leave_count($employeeID,$date,$leavestructureid);
        $data['halfleavecountresul'] = $halfleavecountresult->halfdays;
        if($halfleavecountresult->halfdays){
        $half_day_count = $halfleavecountresult->halfdays;
        $data['half_day_count'] = $halfleavecountresult->halfdays;
        $half_day_unpaid = ($half_day_count * $per_day_salary) / 2;
        $data['half_day'] = $half_day_unpaid;
        $data['leave_deduction'] = round($half_day_unpaid) + $leave_deduction;
        $leave_deduction += round($half_day_unpaid);

         $data['emp_working_days'] = $emp_working_days - ($half_day_count * 0.5);
       
        }
      //print_r($loan_status); die();
        // Loan
        $loan_amount = 0;
        $loan_id = 0;
        if($loan_status == 'unchecked'){ //new
         
        $loan_info = $this->payroll_model->GetLoanValueByID($employeeID);
        
 
        }else{ // else block of checked loan
       // un checked
           $month =   date('Y-m', strtotime('01-' . $datetime));//date('Y-m', strtotime($datetime));
          // print_r($month);
          if($this->payroll_model->GetLoanValueByMonth($employeeID,$month)){ // new 12-9-23
             ///print_r($month);die();
                $loan_info = $this->payroll_model->GetLoanValueByID($employeeID);
               //  print_r($loan_info);echo "Test 2";   die();

                if($loan_info) {
                //new
                  $query = $this->db->delete('loan_exemption', array('emp_id' => $val, 'month' => $datetime, 'status' => 1));
                  if( $query){
                  $loan_amount = $loan_info->installment;  
                 
                   //new
                  $loan_id = $loan_info->id; 
                  }

                
                }
                $data['loan_id'] = $loan_id;
                $data['loan_amount'] = $loan_amount; 
               }
               else{
                $data['loan_amount'] = '';
                $data['loan_id'] = '';
               }
         
         // un checked
        }
        //final salary
        $data['final_salary'] = round(($basic_salary + $sum_allowance + $Overtimeallowance) - ($leave_deduction + $loan_amount + $sum_deduction));
      
    
       //print_r($data);// die();
       
        $message = '';
        $errmessage  = '';
        /*Save*/
        $emid = $val;
        $month = $month_name;
        $year = $year;
        $paydate = date('Y-m-d');
        $basic =  $data['basic_salary'];
        $loan =  $data['loan_amount'];
        $loan_id = $data['loan_id'];
        $total_paid = $data['final_salary'];
        $addition = $data['sum_allowance'];
        $diduction = $data['sum_deduction'];
        $status ='Generated';
        //$status ='Paid';
        $paid_type ='Hand Cash';
        $total_working_days = $data['total_working_days'];
        $emp_worked_days = $data['emp_working_days'];
        $leave_deduction = $data['leave_deduction'];
        $type_id = $data['type_id'];
        $base_salary = $data['base_salary'];
        $base_hra = $data['base_hra'];
        /*  if($addition == ''&& $diduction == ''){
        // echo json_encode(array('status'=>'error','message'=>'Please Enter Allowance And Deduction'));
        
        $errmessage .= 'Please Enter Allowance And Deduction';
        
        }*/
        if($emid != '' && $basic !='' && $total_paid != ''&& $total_working_days != ''&& $emp_worked_days != ''){
        if ($addition != '' && $diduction != '') {
        $data = array();
        $data = array(
        'emp_id' => $emid,
        'month' => $month,
        'year' => $year,
        'createdon' => $paydate,
        //'paid_date' => $paydate,
        //'total_days' => $hours_worked,
        'basic' => $basic,
        'loan' => $loan,
        'total_pay' => $total_paid,
        'addition' => $addition,
        'diduction' => $diduction,
        'status' => $status,
        'paid_type' => $paid_type,
        'total_working_days' => $total_working_days,
        'emp_worked_days' => $emp_worked_days,
        'leave_deduction' => $leave_deduction,
        'type_id' => $type_id,
        'base_salary' => $base_salary,
        'base_hra' => $base_hra,
        );
        }
        if($addition == ''){
        $data = array(
        'emp_id' => $emid,
        'month' => $month,
        'year' => $year,
        'createdon' => $paydate,
        //'total_days' => $hours_worked,
        'basic' => $basic,
        'loan' => $loan,
        'total_pay' => $total_paid,
        'addition' => '',
        'diduction' => $diduction,
        'status' => $status,
        'paid_type' => $paid_type,
        'total_working_days' => $total_working_days,
        'emp_worked_days' => $emp_worked_days,
        'leave_deduction' => $leave_deduction,
        'type_id' => $type_id,
        'base_salary' => $base_salary,
        'base_hra' => $base_hra,
        );
        }
        if ($diduction == '') {
        $data = array(
        'emp_id' => $emid,
        'month' => $month,
        'year' => $year,
        'createdon' => $paydate,
        //'total_days' => $hours_worked,
        'basic' => $basic,
        'loan' => $loan,
        'total_pay' => $total_paid,
        'addition' => $addition,
        'diduction' => '',
        'status' => $status,
        'paid_type' => $paid_type,
        'total_working_days' => $total_working_days,
        'emp_worked_days' => $emp_worked_days,
        'leave_deduction' => $leave_deduction,
        'type_id' => $type_id,
        'base_salary' => $base_salary,
        'base_hra' => $base_hra,
        );
        }
        if ($addition == '' && $diduction == '') {
        $data = array(
        'emp_id' => $emid,
        'month' => $month,
        'year' => $year,
        'createdon' => $paydate,
        //'total_days' => $hours_worked,
        'addition' => '',
        'diduction' => '',
        'basic' => $basic,
        'loan' => $loan,
        'total_pay' => $total_paid,
        'status' => $status,
        'paid_type' => $paid_type,
        'total_working_days' => $total_working_days,
        'emp_worked_days' => $emp_worked_days,
        'leave_deduction' => $leave_deduction,
        'type_id' => $type_id,
        'base_salary' => $base_salary,
        'base_hra' => $base_hra,
        );
        }
        //$monthYear = date('m-Y', strtotime($paydate)); print_r( $monthYear);die();
        // See if record exists
        $get_salary_record = $this->payroll_model->getSalaryRecord($emid, $month,$year);
        if($get_salary_record) {
        $payID = $get_salary_record[0]->pay_id;
        $payment_status = $get_salary_record[0]->status;
        }
        // If exists, add/edit
        if(isset($payID) && $payID > 0 ) {
        /* if($payment_status == "Paid") {
        
        //echo json_encode(array('status'=>'error','message'=>'Has already been paid'));
        $errmessage .= 'Has already been paid';
        } else {*/
        $success = $this->payroll_model->updatePaidSalaryData($payID, $data);
        //echo $loan_status;die();
        if($loan_status != 'unchecked' ){ //new
            //  echo $loan_status;
        if($this->payroll_model->GetLoanValueByMonth($employeeID,$month)){ // new 12-9-23

           //  echo   $loan_status;die();
        // Do the loan update
        if($success && $status == "Paid" || $success && $status == "Generated") {
       // if( $status == "Paid" ||  $status == "Generated") {
        $monthYear = date('m-Y', strtotime($paydate));  //$datetime;
        // echo   $monthYear;die();
       // $data = array('emp_id'=> $emid,'app_date'=> $monthYear,'isActive'=> 1);
        if($this->payroll_model->getinstallmentinfo($emid,$monthYear)){
         //echo "already exits"; die();
        } else {
         //echo "working"; die();
        $loan_info = $this->loan_model->GetLoanValuebyLId($loan_id);
        // loan_id and loan fields already grabbed
         //loan-----------------
        if (!empty($loan_info)) {
        $period = $loan_info->install_period - 1;
        $number = $loan_info->loan_number;
        $installData = array();
        $installData = array(
        'emp_id' => $emid,
        'loan_id' => $loan_id,
        'loan_number' => $number,
        'install_amount' => $loan,
        /*'pay_amount' => $payment,*/
        'app_date' => $paydate,
        /*'receiver' => $receiver,*/
        'install_no' => $period
        /*'notes' => $notes*/
        );
        $success_installment = $this->loan_model->Add_installData($installData);
        $totalpay = $loan_info->total_pay + $loan;
        $totaldue = $loan_info->amount - $totalpay;
        $period = $loan_info->install_period - 1;
        $loan_status = $loan_info->status;
        if ($period == '0') { //1
        $loan_status = 'Done';
        }
        $data = array();
        $data = array(
        'total_pay'         => $totalpay,
        'total_due'         => $totaldue,
        'install_period'    => $period,
        'status'            => $loan_status,
        'loan_payroll_status'         => '1',
        );
        
        $success_loan = $this->loan_model->update_LoanData($loan_id, $data);

          // print_r($success_loan); 
          // print_r("TEst Data"); die();
        }

        }//new 06-12-23
        //------------------loan
        }
        }
        }else{ //new
       // else 
        $data = array(
        'loan_payroll_status'         => '0',
     
        );
        $success_loan = $this->loan_model->update_LoanData($loan_id, $data); 
        //new
        $newFormat = date("m-Y", strtotime($paydate));
          $exdata = array(
        'emp_id' => $emid,
        'loan_id' => $loan_id,
        'loan_number' => $number,
        'month' => $newFormat,
         );
        $val = $emid;
        $table = 'loan_exemption';
        $data = array('month'=> $newFormat,'emp_id'=> $emid,'status'=> 1);
        if($this->settings_model->Check_field_exists($val,$data,$table)){
        //echo "Already exists";die();
        } else{ 
        $this->db->insert('loan_exemption', $exdata); //new 
       }
        //print_r("TEst"); die();
       
        }
        
        //echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
        $message .= 'Successfully Generated';
        // }
        } else {
     
        $success = $this->payroll_model->insertPaidSalaryData($data);
        // Do the loan update
          if($loan_status != 'unchecked'){
              if($this->payroll_model->GetLoanValueByMonth($employeeID,$month)){ // new 12-9-23
          //echo   $loan_status;die();
        if($success && $status == "Paid") {
        // Input Status
        $loan_info = $this->loan_model->GetLoanValuebyLId($loan_id);
        
        // loan_id and loan fields already grabbed
        if (!empty($loan_info)) {
        $period = $loan_info->install_period - 1;
        $number = $loan_info->loan_number;
        $installData = array();
        $installData = array(
        'emp_id' => $emid,
        'loan_id' => $loan_id,
        'loan_number' => $number,
        'install_amount' => $loan,
        /*'pay_amount' => $payment,*/
        'app_date' => $paydate,
        /*'receiver' => $receiver,*/
        'install_no' => $period
        /*'notes' => $notes*/
        );
        $success_installment = $this->loan_model->Add_installData($installData);
        $totalpay = $loan_info->total_pay + $loan;
        $totaldue = $loan_info->amount - $totalpay;
        $period = $loan_info->install_period - 1;
        $loan_status = $loan_info->status;
        if ($period == 0) {
        $loan_status = 'Done';
        
        }
        $data = array();
        $data = array(
        'total_pay'         => $totalpay,
        'total_due'         => $totaldue,
        'install_period'    => $period,
        'status'            => $loan_status,
           'loan_payroll_status'         => '1',
        );
        $success_loan = $this->loan_model->update_LoanData($loan_id, $data);
        // print_r($success_installment); 
        // print_r($success_loan); die();
        }
        }
        }
        
        /*if($success){
        echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
        }*/
        }else{
       // else 
        $data = array(
        'loan_payroll_status'         => '0',
     
        );
        $success_loan = $this->loan_model->update_LoanData($loan_id, $data); 
        //print_r($success_loan); die();
        }
        $message .= 'Successfully Generated';
        }
        //}
        }
        /*End*/
        
        }
        /*if($success){
        echo json_encode(array('status'=>'success','message'=>'Successfully Added'));
        }*/
        if($message){
        echo json_encode(array('status'=>'success','message'=>$data));
        }else if($errmessage){
        echo json_encode(array('status'=>'error','message'=>$errmessage));
        }
        }  //die();
        
        
        }
        }
        //new genereate pay slip new days wise
        public function generate_payroll_for_each_employee(){
        if($this->session->userdata('user_login_access') != False) {
        // Get the month and year
        $month = $this->input->get('month');
        $datetime = $this->input->get('datetime');
        
        $year = $this->input->get('year');
        $employeeID = $this->input->get('employeeID');
        //basic salary
        $employee_salary = $this->payroll_model->GetsalaryValueByID($employeeID);
        //basic + HRA
        $data = array();
        $data['basic_salary'] = $employee_salary->total;
        $basic_salary = $employee_salary->total;
        
        //salary id
        $data['type_id'] = $employee_salary->id;
        //total working days
        $month_num = $this->input->get('month');
        //month name
        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
        //no of days in month
        $cur_month = date('t',strtotime($month_name));
        // //get organisation
        // $organisationvalue = $this->settings_model->GetOrganisationValue();
        // if(isset($organisationvalue->holidaystructureid)){
        // $structureid = $organisationvalue->holidaystructureid;
        // $data['structureid'] = $structureid;
        // }else{
        //     $structureid = '';
        // }
        //get business unit
        $busid = $this->input->get('busunit');
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
        //holiday count
        $date = $datetime;
        $holidayreport = $this->leave_model->holidayreport($date,$structureid);//holiday count
        
        $t_wokingdays = $cur_month - $holidayreport->total_count;
        $data['total_working_days'] = $cur_month -  $holidayreport->total_count;
        
        //get emp leave count
        $leavecountresult = $this->payroll_model->Get_emp_leave_count($employeeID,$date,$leavestructureid);
        $leavecount = $leavecountresult->leavecount;
        //print_r( $leavecountresult);
        //paid condition
        $paidleavecountresult = $this->payroll_model->Get_paid_leave_count($employeeID,$date,$leavestructureid);
        //print_r($paidleavecountresult);
        //if($paidleavecountresult->paidstatus == 'paid'){
        
        if($paidleavecountresult->leavecount > $paidleavecountresult->Total_days){
        
        $paid_result = $paidleavecountresult->leavecount - $paidleavecountresult->Total_days;
        //$leavecount =  $paid_result;
        
        $leavecount +=$paid_result;
        }
        // }
        //echo $leavecount.'second<br>';
        //emp working days
        $data['emp_working_days'] = $t_wokingdays - $leavecount;
        // print_r( $data['emp_working_days'] );
        //allowance
        $allowanceresult = $this->payroll_model->Get_total_allowance($employeeID);
        $sum_allowance = $allowanceresult->total_allowance;
        $data['sum_allowance'] = $allowanceresult->total_allowance;
        //deduction
        $deductionresult = $this->payroll_model->Get_total_deduction($employeeID);
        $sum_deduction = $deductionresult->total_deduction;
        $data['sum_deduction'] = $deductionresult->total_deduction;
        //per day salary
        $per_day_salary = (($basic_salary + $sum_allowance) * 12) / 365;
        $data['per_day_salary'] = $per_day_salary;
        $day_salary =   round($per_day_salary);
        //Leave Deduction
        $leave_deduction = $leavecount * $day_salary;
        $data['leave_deduction'] = round($leave_deduction);
        
        //half day deduction
        
        
        $halfleavecountresult = $this->payroll_model->Halfday_emp_leave_count($employeeID,$date,$leavestructureid);
        $data['halfleavecountresul'] = $halfleavecountresult->halfdays;
        if($halfleavecountresult->halfdays > 0){
        $half_day_count = count($halfleavecountresult->halfdays);
        $data['half_day_count'] = count($halfleavecountresult->halfdays);
        $half_day_unpaid = ($half_day_count * $per_day_salary) / 2;
        $data['half_day'] = $half_day_unpaid;
        $data['leave_deduction'] = round($half_day_unpaid) + $leave_deduction;
        $leave_deduction += round($half_day_unpaid);
        }
        // Loan
        $loan_amount = 0;
        $loan_id = 0;
        $loan_info = $this->payroll_model->GetLoanValueByID($employeeID);
        if($loan_info) {
        $loan_amount = $loan_info->installment;
        $loan_id = $loan_info->id;
        }
        $data['loan_id'] = $loan_id;
        $data['loan_amount'] = $loan_amount;
        
        //final salary
        $data['final_salary'] = ($basic_salary + $sum_allowance) - ($leave_deduction + $loan_amount + $sum_deduction);
        
        echo json_encode($data);
        }
        }
      
        public function Payslip_Report(){
        if($this->session->userdata('user_login_access') != False) {
        $data=array();
        $data['employee'] = $this->employee_model->emselect();
        $data['businessunitvalue'] = $this->employee_model->businessunitvalue();
        $this->load->view('backend/salary_report',$data);
        }
        else{
        redirect(base_url() , 'refresh');
        }
        }
       
        public function qr()
        {
        
        $qrCode = new QrCode('google.com');
        // Save black on white PNG image 100 px wide to filename.png. Colors are RGB arrays.
        $output = new Output\Png();
        $data = $output->output($qrCode, 100, [255, 255, 255], [1, 1, 1]);
        file_put_contents('assets/filename.png', $data);
        // Echo an HTML table
        $output = new Output\Html();
        // echo $output->output($qrCode);
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




        ///Sigle payslip
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
        $paidleavecountresult = $this->payroll_model->Get_paid_leave_count($employeeID,$date,$leavestructureid);
        //if($paidleavecountresult->paidstatus == 'paid'){
        
        if($paidleavecountresult->leavecount > $paidleavecountresult->Total_days){
        
        $paid_result = $paidleavecountresult->leavecount - $paidleavecountresult->Total_days;
        
        
        $leavecount +=$paid_result;
        }
        //organisation info
        $organisationvalue = $this->settings_model->GetOrganisationValue();
        $datetime = $date;
        //get allowance
        $getallowance = $this->payroll_model->Get_allowance($eid,$datetime);
        //get deduction
        $getdeduction = $this->payroll_model->Get_deduction($eid,$datetime);

       // print_r($datetime);
       // print_r($getallowance);
       // print_r($getdeduction);die();
          
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
        $this->load->library('Pdf');
        // create new PDF document
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Payslip');
        $pdf->SetSubject('Payslip');
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
        $pdf->setPrintHeader(false);
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
        if(isset($organisationvalue->logo)){ 
            $logo = base_url().'assets/uploads/logo/'.$organisationvalue->logo;
            } else {
             $logo = base_url()."assets/logo.png";
           
              } 
        $html = '
        <style type="text/css">
        table td, table th {
        padding: 3px !important;
        }
        </style>
        <table style=" width: 100%;">
            <tr>
                <td  style="width:23% !important; "  class="text-left"> <img src="'.  $logo.'" style="width: 120px;" /> </td>
                <td  style="width:53% !important ;vertical-align: text-top; text-align:center" rowspan="2" class="text-center"><p style="font-size:18px;font-weight:normal" >';
                    if(isset($organisationvalue->organisation)){
                    $html.= ''.$organisationvalue->organisation.'';
                    }
                    $html.= ' <p style="font-size:10px;font-weight:normal;">';
                        if(isset($organisationvalue->address)){  $html.= ' '.$organisationvalue->address.'';}
                    $html.= '</p></p>
                </td>
                
            </tr>
            
        </table>
        </style>
        ';
        
        // set style for barcode
        $style = array(
        
        'vpadding' => 'auto',
        'hpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255)
        'position' => 'R', //array(255,255,255)
        'module_width' => 1, // width of a single module in points
        'module_height' => 1 // height of a single module in points
        );
        if(isset($organisationvalue->website)){
            $web = $organisationvalue->website;
            }
        $pdf->write2DBarcode($web, 'QRCODE,M', 20, 10, 30, 30, $style, '', true);
        
        $html .= '
        <style>
        table td, table th {
        padding: 3px !important;
        }
        td {
        padding: 3px !important;
        }
        </style>
        <div style=" margin-top: 0px;">
            <h5 class="text-center" style="font-weight:bold;text-align:center;font-size:16px">Payslip</h5>
            <p class="text-center" style="text-align:center">('. $payslip_data->month.'-'.$payslip_data->year .')</p>
        </div>';
        $html .= ' <div>
            <table style="width:100%; margin-top: 40px;"  cellpadding="2" cellspacing="5">
                <tr>
                    <td  width="120"  >Employee ID</td>
                    <td  width="120">: '.$employee_info->em_code.'</td>
                    <td width="120" >Department</td>
                    <td width="120">: '.$employee_info->depname.'</td>
                    <td width="130">Total No of Days</td>
                    <td width="120">: '.$payslip_data->total_working_days.'</td>
                </tr>
                <tr>'; $em_name = $employee_info->first_name.' '.$employee_info->last_name;
                    $html .='<td width="120">Employee Name</td>
                    <td width="120">: '.$em_name.'</td>
                    <td width="120">Designation</td>
                    <td width="120">: '.$employee_info->des_name.'</td>
                    <td width="130">Total Working Days</td>
                    <td width="120">:'; $work_days = $payslip_data->emp_worked_days;/*- $half_d_count;*/  $html .=' '.$work_days.'</td>';
                   /* <td width="120">:'; $work_days = $payslip_data->emp_worked_days - $half_d_count; $html .=' '.$work_days.'</td>*/
                $html .='
               
                </tr>
                <tr>
                    <td  width="120">Nationality</td>
                    <td  width="120">: '.$otherInfo[0]->nationality.'</td>
                    <td  width="120">Work Location</td>
                    <td  width="120">: '.$otherInfo[0]->city.'</td>
                    <td  width="130">Total Absent Days</td>
                    <td  width="120">:'; /*'.$leavecount.'*/
                        $lcount = $payslip_data->total_working_days - $work_days; //$val->emp_worked_days;
                    $html .=' '.$lcount.' </td>
                </tr>
                
            </table>
            <style type="text/css">
            table th{
            border-bottom:1px solid black;
            }
            table th td {
            padding: 3px ;
            }
            .allowance{
            padding: 3px;
            margin-top: 50px;
            }
            </style>
            <div class="allowance">
                <table  style="width:100%;margin-top: 50px;"  cellpadding="3" cellspacing="">
                    
                    <tr  style="">
                        <th class="text-left" style="text-align:left;font-weight:bold;">Earnings</th>
                        <th class="text-right"  style="text-align:right;font-weight:bold;">Amount</th>
                    </tr>
                    <tr>
                        <td class="text-left" style="text-align:left">Basic Salary</td>
                        <td class="text-right"  style="text-align:right">'.$payslip_data->base_salary.'</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="text-align:left">HRA</td>
                        <td class="text-right"  style="text-align:right">'.$payslip_data->base_hra.'</td>
                    </tr>';
                    
                    foreach ($getallowance as  $value) {
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">'.$value->allowance.'</td>
                        <td class="text-right" style="text-align:right">'.$value->allowance_amount.'</td>
                    </tr>';
                    }
                    $html .= '
                    <tr  style="margin-top:20px">
                        <td class="" style=""></td>
                        <td class="text-right"  style="font-weight:bold;text-align:right">Total Earnings &nbsp;&nbsp;&nbsp; ';
                            $tearnings = $payslip_data->base_salary + $payslip_data->base_hra + $payslip_data->addition;
                            $html .= ' '.$tearnings.'
                        </td>
                    </tr>
                </table>
                
            </div>
            <div class="deduction">
                <table style="width:100%;margin-top: 50px;"  cellpadding="3" cellspacing="">
                    <tr  style="">
                        <th class="text-left"  style="text-align:left;font-weight:bold;">Deductions</th>
                        <th class="text-right"  style="text-align:right;font-weight:bold;">Amount</th>
                    </tr>';
                    if($payslip_data->leave_deduction){
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">Leave Deduction</td>
                        <td class="text-right"  style="text-align:right">'.$payslip_data->leave_deduction.'</td>
                    </tr> ';
                    }else {
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">Leave Deduction</td>
                        <td class="text-right"  style="text-align:right">0</td>
                    </tr> ';
                    }

                  $query = $this->db->query("SELECT month, emp_id FROM loan_exemption WHERE emp_id = ? AND month = ? AND status = 1", array($eid, $date));
                 
                  if (!$query->num_rows() > 0) {
                    if($payslip_data->loan){
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">Loan</td>
                        <td class="text-right"  style="text-align:right">'.$payslip_data->loan.'</td>
                    </tr> ';
                    }
                   }
                    
                    foreach ($getdeduction as  $dvalue) {
                    $html .= '<tr>
                        <td class="text-left"  style="text-align:left">'.$dvalue->deduction.'</td>
                        <td class="text-right"  style="text-align:right">'.$dvalue->deduction_amount.'</td>
                        
                    </tr>'; }
                    if (!$query->num_rows() > 0) {
                    $loan = $payslip_data->loan;
                     }else{
                         $loan = 0;
                     }

                    $tot_deduction = $payslip_data->diduction + $payslip_data->leave_deduction + $loan;
                    $html .= '
                    <tr>
                        <td class="" style=""></td>
                        <td class="text-right" style="font-weight:bold;text-align:right">Total Deduction &nbsp;&nbsp;&nbsp;'.$tot_deduction .'</td>
                    </tr>
                    <tr>
                        <td class="" style=""></td>
                        <td class="text-right" style="font-weight:bold;text-align:right">Net Pay &nbsp;&nbsp;&nbsp;'.$payslip_data->total_pay.' </td>
                    </tr>
                    
                </table >
                <table style="width:100%;margin-top: 40px;"  cellpadding="3" cellspacing="5">
                    
                    <tr>
                        <td class="" style="margin-top: 30px;">(Rupees : '.$totalinwords.')</td>
                        
                    </tr>
                </table>
                <table style="width:100%;top: 50px;"  cellpadding="5" cellspacing="5">
                    
                    <tr>
                        <td style="text-align:center" class="text-center" ></td>
                        
                    </tr>
                </table>
            </div>
            
            <td align="center" style="height: 50px;">
                <div style="vertical-align: bottom;">
                    <p>This is system generated payslip</p>
                </div>
            </td>
            <tr>
                <td align="center" style="height: 50px;">
                    <div style="vertical-align: middle;">
                        <p>This is system generated payslip</p>
                    </div>
                </td>
            </tr>
            
        </div>';
        //$pdf->Cell(0, 50,'This is system generated payslip', 0, $ln=0, 'C', 0, '', 0, false,  'T', 'M');
        
        $filename = "PAY SLIP (".$cur_month. "-".$cur_year.")";
        
        $pdf->writeHTML($html, true, false, true, false, '');
        // reset pointer to the last page
        $pdf->lastPage();
        
        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($filename.'.pdf', 'I');
        }
        //Bulk report
        public function Busunitpdf(){
        $datetime = $this->input->get('datetime');
        $busunit = $this->input->get('busunit');
        
        $dates = explode('-', $datetime);
        $month_num = $dates[0];
        $year = $dates[1];
        $month = date("F", mktime(0, 0, 0, $month_num, 10));
        $data = array();
        //$payslip_data = $this->payroll_model->Generate_payslip($id,$eid );
        $payslip_data = $this->payroll_model->Generate_payslip_businessunit($month,$year,$busunit);
 
        $this->load->library('Pdf');
        // create new PDF document
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Payslip');
        $pdf->SetSubject('Payslip');
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
        $pdf->setPrintHeader(false);
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
        foreach($payslip_data as $val)
        {
        $eid = $val->employeeid;
        
        $employee_info      = $this->payroll_model->getEmployeeID($eid);
        $otherInfo      = $this->payroll_model->getOtherInfo($eid);
        $employeeID = $eid;
        $month_num = date("m", strtotime($val->month));
        $date = $month_num.'-'.$val->year;

        /**/
        $busid = $this->input->get('busunit');
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
       
        //exit();
        //paid condition
        $paidleavecountresult = $this->payroll_model->Get_paid_leave_count($employeeID,$date,$leavestructureid);
        //if($paidleavecountresult->paidstatus == 'paid'){
        
        if($paidleavecountresult->leavecount > $paidleavecountresult->Total_days){
        
        $paid_result = $paidleavecountresult->leavecount - $paidleavecountresult->Total_days;
        
        
        $leavecount +=$paid_result;
        }
        //half count
        $halfleavecountresult = $this->payroll_model->Halfday_pdf_leave_count($employeeID,$date);
        $data['halfleavecountresult'] = $halfleavecountresult->halfdays;
        $half_d_count =  0;
        if($halfleavecountresult->halfdays){
        $half_d_count =  0.5 * $halfleavecountresult->halfdays;
        
        }

        //organisation info
        $organisationvalue = $this->settings_model->GetOrganisationValue();
        //get allowance
        $getallowance = $this->payroll_model->Get_allowance($eid,$datetime);
        //get deduction
        $getdeduction = $this->payroll_model->Get_deduction($eid,$datetime);

        $totalinwords = $this->NumberintoWords($val->total_pay);//
        $cur_month = date("M", strtotime($val->month));
        $cur_year = $val->year;
        if(isset($organisationvalue->logo)){ 
           $logo = base_url().'assets/uploads/logo/'.$organisationvalue->logo;
           } else {
            $logo = base_url()."assets/logo.png";
          
             } 
        $html = '
        <style type="text/css">
        table td, table th {
        padding: 3px !important;
        }
        </style>
        <table style=" width: 100%;">
            <tr>
                <td  style="width:23% !important; "  class="text-left"> <img src="'. $logo.'" style="width: 120px;" /> </td>
                <td  style="width:53% !important ;vertical-align: text-top; text-align:center" rowspan="2" class="text-center"><p style="font-size:18px;font-weight:normal" >';
                    if(isset($organisationvalue->organisation)){
                    $html.= ''.$organisationvalue->organisation.'';
                    }
                    $html.= ' <p style="font-size:10px;font-weight:normal;">';
                        if(isset($organisationvalue->address)){  $html.= ' '.$organisationvalue->address.'';}
                    $html.= '</p></p>
                </td>
                
            </tr>
            
        </table>
        </style>
        ';
        
        // set style for barcode
        $style = array(
        
        'vpadding' => 'auto',
        'hpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255)
        'position' => 'R', //array(255,255,255)
        'module_width' => 1, // width of a single module in points
        'module_height' => 1 // height of a single module in points
        );
        if(isset($organisationvalue->website)){
            $web = $organisationvalue->website;
            }
        $pdf->write2DBarcode($web, 'QRCODE,M', 20, 10, 30, 30, $style, '', true);
       
        $html .= '
        <style>
        table td, table th {
        padding: 3px !important;
        }
        td {
        padding: 3px !important;
        }
        </style>
        <div style=" margin-top: 0px;">
            <h5 class="text-center" style="font-weight:bold;text-align:center;font-size:16px">Payslip</h5>
            <p class="text-center" style="text-align:center">('. $val->month.'-'.$val->year .')</p>
        </div>';
        $html .= ' <div>
            <table style="width:100%; margin-top: 40px;"  cellpadding="2" cellspacing="5">
                <tr>
                    <td  width="120"  >Employee ID</td>
                    <td  width="120">: '.$employee_info->em_code.'</td>
                    <td width="120" >Department</td>
                    <td width="120">: '.$employee_info->depname.'</td>
                    <td width="130">Total No of Days</td>
                    <td width="120">: '.$val->total_working_days.'</td>
                </tr>
                <tr>'; $em_name = $employee_info->first_name.' '.$employee_info->last_name;
                    $html .='<td width="120">Employee Name</td>
                    <td width="120">: '.$em_name.'</td>
                    <td width="120">Designation</td>
                    <td width="120">: '.$employee_info->des_name.'</td>
                    <td width="130">Total Working Days</td>
                      <td width="120">:';
                     $work_days = $val->emp_worked_days ; 
                        $html .=' '.$work_days.'</td>';
                    // <td width="120">: ';$work_days = $val->emp_worked_days; $html .=' '.$work_days.'</td>';
              /* $html .='
               <td width="120">:'; $work_days = $val->emp_worked_days - $half_d_count; $html .=' '.$work_days.'</td>*/
                $html .=' </tr>
                <tr>
                    <td  width="120">Nationality</td>
                    <td  width="120">: '.$otherInfo[0]->nationality.'</td>
                    <td  width="120">Work Location</td>
                    <td  width="120">: '.$otherInfo[0]->city.'</td>
                    <td  width="130">Total Absent Days</td>
                    <td  width="120">:'; /*'.$leavecount.'*/
                        $lcount = $val->total_working_days -  $work_days;
                    $html .=' '.$lcount.' </td>
                </tr>
                
            </table>
            <style type="text/css">
            table th{
            border-bottom:1px solid black;
            }
            table th td {
            padding: 3px ;
            }
            .allowance{
            padding: 3px;
            margin-top: 50px;
            }
            </style>
            <div class="allowance">
                <table  style="width:100%;margin-top: 50px;"  cellpadding="3" cellspacing="">
                    
                    <tr  style="">
                        <th class="text-left" style="text-align:left;font-weight:bold;">Earnings</th>
                        <th class="text-right"  style="text-align:right;font-weight:bold;">Amount</th>
                    </tr>
                    <tr>
                        <td class="text-left" style="text-align:left">Basic Salary</td>
                        <td class="text-right"  style="text-align:right">'.$val->base_salary.'</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="text-align:left">HRA</td>
                        <td class="text-right"  style="text-align:right">'.$val->base_hra.'</td>
                    </tr>';
                    
                    foreach ($getallowance as  $value) {
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">'.$value->allowance.'</td>
                        <td class="text-right" style="text-align:right">'.$value->allowance_amount.'</td>
                    </tr>';
                    }
                    $html .= '
                    <tr  style="margin-top:20px">
                        <td class="" style=""></td>
                        <td class="text-right"  style="font-weight:bold;text-align:right">Total Earnings &nbsp;&nbsp;&nbsp; ';
                            $tearnings = $val->base_salary + $val->base_hra + $val->addition;
                            $html .= ' '.$tearnings.'
                        </td>
                    </tr>
                </table>
                
            </div>
            <div class="deduction">
                <table style="width:100%;margin-top: 50px;"  cellpadding="3" cellspacing="">
                    <tr  style="">
                        <th class="text-left"  style="text-align:left;font-weight:bold;">Deductions</th>
                        <th class="text-right"  style="text-align:right;font-weight:bold;">Amount</th>
                    </tr>';
                    if($val->leave_deduction){
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">Leave Deduction</td>
                        <td class="text-right"  style="text-align:right">'.$val->leave_deduction.'</td>
                    </tr> ';
                    }else {
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">Leave Deduction</td>
                        <td class="text-right"  style="text-align:right">0</td>
                    </tr> ';
                    }
                    
                  $query = $this->db->query("SELECT month, emp_id FROM loan_exemption WHERE emp_id = ? AND month = ? AND status = 1", array($eid, $datetime));
                  
                  if (!$query->num_rows() > 0) {
                     
                    if($val->loan){
                    $html .= '<tr>
                        <td class="text-left" style="text-align:left">Loan</td>
                        <td class="text-right"  style="text-align:right">'.$val->loan.'</td>
                    </tr> ';
                    }
                    }
                    foreach ($getdeduction as  $dvalue) {
                    $html .= '<tr>
                        <td class="text-left"  style="text-align:left">'.$dvalue->deduction.'</td>
                        <td class="text-right"  style="text-align:right">'.$dvalue->deduction_amount.'</td>
                        
                    </tr>'; }

                        if (!$query->num_rows() > 0) {
                    $loan = $val->loan;
                     }else{
                         $loan = 0;
                     }
                    
                    $tot_deduction = $val->diduction + $val->leave_deduction + $loan;
                    $html .= '
                    <tr>
                        <td class="" style=""></td>
                        <td class="text-right" style="font-weight:bold;text-align:right">Total Deduction &nbsp;&nbsp;&nbsp;'.$tot_deduction .'</td>
                    </tr>
                    <tr>
                        <td class="" style=""></td>
                        <td class="text-right" style="font-weight:bold;text-align:right">Net Pay &nbsp;&nbsp;&nbsp;'.$val->total_pay.' </td>
                    </tr>
                    
                </table >
                <table style="width:100%;margin-top: 40px;"  cellpadding="3" cellspacing="5">
                    
                    <tr>
                        <td class="" style="margin-top: 30px;">(Rupees : '.$totalinwords.')</td>
                        
                    </tr>
                </table>
                
            </div>
            
            <td align="center" style="height: 50px;">
                <div style="vertical-align: bottom;">
                    <p>This is system generated payslip</p>
                </div>
            </td>
            <tr>
                <td align="center" style="height: 50px;">
                    <div style="vertical-align: middle;">
                        <p>This is system generated payslip</p>
                    </div>
                </td>
            </tr>
            
        </div>';
        //$pdf->Cell(0, 50,'This is system generated payslip', 0, $ln=0, 'C', 0, '', 0, false,  'T', 'M');
        
        
        
        // $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->AddPage();
        $pdf->lastPage();
        
        
        
        
        
        }
        $filename = "PAY SLIP (".$cur_month. "-".$cur_year.")";
        $lastPage = $pdf->getPage();
        $pdf->deletePage($lastPage);
        ob_end_clean();
        //$pdf->lastPage();
        //Close and output PDF document
        $pdf->Output($filename.'.pdf', 'I');
        }
        public function Payslipdelete(){
        if($this->session->userdata('user_login_access') != False) {
        $id = $this->input->post('id');
        $result_del = $this->payroll_model->Payslipdelete($id);//
        if($result_del){
        echo json_encode(array('status'=>'success','message'=> 'Deleted Successfully'));
        
        }else{
        echo json_encode(array('status'=>'failed','message'=> 'Not deleted'));
        
        }
        
        }
        else{
        redirect(base_url() , 'refresh');
        }
        }

        
      //Bulk Generate
        public function update_payroll_paid_status(){
        if($this->session->userdata('user_login_access') != False) {
        $busid = $this->input->post('busunit');
        $datetime = $this->input->post('datetime');

        if($this->input->post('emids'))
        {
        $data = $this->input->post('emids');
        
        $array = explode(',', $data);
        //print_r( $array);
        foreach($array as $val){
         $message = '';
        $errmessage  = '';
        $date = explode('-', $datetime);
        $month = $date[0];
         $month_name = date("F", mktime(0, 0, 0, $month, 10));
        $year = $date[1];
        

            $emp_id = $val;
            $data1  = array('status '=> 'Paid','paid_date'=> date('Y-m-d') );
    
             
             $this->db->where(array('emp_id'=> $emp_id,'month'=> $month_name,'year'=> $year,'isActive '=>1));
              $result = $this->db->update('pay_salary', $data1);

            //updatePaidSalaryData
              if($result){
                 $message .= 'Successfully ';
              }
       // }
        
        }
       
        if($message){
        echo json_encode(array('status'=>'success','message'=>$message));
        }else if($errmessage){
        echo json_encode(array('status'=>'error','message'=>$errmessage));
        }
        }  //die();
        
        
        }
        }
        }