<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<style type="text/css">
		  table td, table th {

                        padding: 3px !important;
                    }
	</style>
	    <table style=" width: 100%; margin-top: 0px;">
        <tr>
        <td  style="width:23% !important; border-right: 0px double white;border-bottom: 0px dotted white;"  class="text-left"> <img src="<?php echo base_url();?>/assets/images/logo/logo1.png" style="width: 120px;" /> </td>
         <td  style="width:53% !important ;border-right: 0px double white;border-bottom: 0px dotted white;font-weight:normal;margin:0;padding:0 !important;vertical-align: text-top;" rowspan="2" class="text-center"><p style="font-size:18px;font-weight:normal" ><?php if(isset($organisationvalue->organisation)){  echo $organisationvalue->organisation;}?><br><p style="font-size:10px;font-weight:normal;margin-bottom: 0px;padding-bottom: 0 !important;"><?php if(isset($organisationvalue->address)){  echo $organisationvalue->address;}?></p></p>
        </td> 
        <td  style="width:23%!important; border-right: 0px double white;border-bottom: 0px dotted white;vertical-align: text-top;"  class="text-right"> <img src="<?php echo base_url();?>/assets/filename.png" style="width: 100px; height: 70px;" /></td>
        </tr>
        
      
     </table>
	<div style=" margin-top: 0px;">
		<h5 class="text-center" style="font-weight:bold;">Payslip</h5>
     <p class="text-center">(<?php  echo $payslip_data->month.'-'.$payslip_data->year ?>)</p>
	</div>
     
 
     <div>
     	<table style="width:100%; margin-top: 40px;"><!-- border:1px solid black; -->
     		<tr>
     			<td width="16%">Employee ID</td>
     			<td  width="16%">: <?php echo $employee_info->em_code;?></td>
     			<td>Department</td>
     			<td>: <?php echo $employee_info->dep_name;?></td>
     			<td>Total No of Days</td>
     			<td>: <?php echo $payslip_data->total_working_days;?></td>
     		</tr>
     		<tr>
     			<td>Employee Name</td>
     			<td>: <?php echo $employee_info->first_name; ?> <?php  echo $employee_info->last_name; ?></td>
     			<td>Designation</td>
     			<td>: <?php echo $employee_info->des_name; ?></td>
     			<td>Total Working Days </td>
     			<td>: <?php echo $payslip_data->emp_worked_days; ?></td>
     		</tr>
     		<tr>
     			<td>Nationality</td>
     			<td>: <?php echo $otherInfo[0]->nationality;?></td>
     			<td>Work Location</td>
     			<td>: <?php echo$otherInfo[0]->city; ?></td>
     			<td>Total Absent Days</td>
     			<td>: <?php echo $leavecount  ?></td>
     		</tr>
     		
     	</table>
     	<style type="text/css">
     		 table  th{
     			border-bottom:1px solid black;
     		}	


     	</style>
     	<div class="allowance">
     	<table style="width:100%;margin-top: 50px;">
     		
	     		<tr  style="">
	     			<th class="text-left">Earnings</th>
	     			<th class="text-right">Amount</th>
	     		</tr>
	           <tr>
	     			<td class="text-left">Basic salary</td>
	     			<td class="text-right"><?php echo $payslip_data->basic; ?></td>
	     	  </tr>  
	     	  <tr>
	     			<td class="text-left">HRA</td>
	     			<td class="text-right"><?php echo $payslip_data->hra; ?></td>
	     	  </tr>  
	     	      <?php
                foreach ($getallowance as  $value) {
                    echo' <tr>
                  <td class="text-left">'.$value->allowance.'</td>
                  <td class="text-right">'.$value->allowance_amount.'</td>
                   </tr>';
                } ?>
	
	     	  <tr  style="margin-top:20px">
	     	  	<td class="" style=""></td>
	     			<td class="text-right" style="font-weight:bold">Total Earnings &nbsp;&nbsp;&nbsp;<?php echo  $payslip_data->total + $payslip_data->addition; ?></td>
	     	  </tr>
       </table>
       <table style="width:100;">
       	
       </table>
     	</div>
       <div class="deduction">
       	  <table style="width:100%;margin-top: 50px;">
     		<tr  style="">
     			<th class="text-left">Deductions</th>
     			<th class="text-right">Amount</th>
     		</tr>

     		    <?php
                foreach ($getdeduction as  $dvalue) { 
                 echo '<tr>
                  <td class="text-left">'.$dvalue->deduction.'</td>
                  <td class="text-right" >'.$dvalue->deduction_amount.'</td>
                  
                </tr>'; }
                 ?>

	
	     	   <tr>

	     			<td class="" style=""></td>
	     			<td class="text-right" style="font-weight:bold">Total Deduction &nbsp;&nbsp;&nbsp;<?php echo $payslip_data->diduction; ?></td>
	     	  </tr>
	     	   <tr>

	     			<td class="" style=""></td>
	     			<td class="text-right" style="font-weight:bold">Net Pay &nbsp;&nbsp;&nbsp;<?php echo $payslip_data->total_pay; ?> </td>
	     	  </tr>
	     	 <!--  <tr>

	     			<td class="" style="">(Rupees : Eight Thousand Two Hundred and Seventy Two Point Seven Zero)</td>
	     			
	     	  </tr>  -->
       </table >
       <table style="width:100%;margin-top: 40px;">
 
	     	 <tr>
              <td class="" style="margin-top: 30px;">(Rupees : <?php echo $totalinwords;?>)</td>
	     			
	     	  </tr> 
       </table>
        <table style="width:100%;margin-top: 50px;">
 
	     	 <tr>
              <td style="" class="text-center">This is system generated payslip</td>
	     			
	     	  </tr> 
       </table>

       </div>
     


     </div>

</body>
</html>

