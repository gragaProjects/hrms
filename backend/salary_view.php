<?php
$this->load->view('backend/header');
?>
<?php
$this->load->view('backend/sidebar');
?>

<div class="page-wrapper">
  <div class="message">
  </div>
  <div class="row page-titles">
    <div class="col-md-5 align-self-center">
      <h3 class="text-themecolor"><i class="fa fa-money"></i> Generate Payroll 
      </h3>
    </div>
    <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item">
          <a href="javascript:void(0)">Home
          </a>
        </li>
        <li class="breadcrumb-item active">Generate Payroll 
        </li> -->
      </ol>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row m-b-10"> 
      <div class="col-12">
    
        
      </div>
    </div> 
    <div class="row">
      <div class="col-12">
        <div class="card card-outline-info">
          <div class="card-header">
              <h4 class="m-b-0 text-white">&nbsp;&nbsp; Generate Payroll 
            </h4>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="card-body">
            <!--                  <form method="post" action="" id="salaryform" class=" row">
                  
                    <div class="form-group  col-md-3">
                      <label class="">Business Unit</label><span class="error"> *</span>
                      <select name="busunit" id="busunit"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" data-placeholder="Select Business Unit" required>
                        <option hidden>Select Business Unit</option>
                        <?Php foreach($businessunitvalue as $value): ?>
                        <option value="<?php echo $value->id ?>"> <?php echo $value->name ?></option>
                        <?php endforeach; ?>
                      </select>
                      <label id="" class="error" for="busunit" style="display: none;">This field is required.</label>
                    </div>
                  <div class="col-md-3">
                   <label> Month</label><span class="error"> *</span>
                    
                  

                        <div class='input-group date' id=''>
                          <input type='text' name="datetime" class="form-control mydatetimepicker" placeholder="Month" required />
                        </div>
                    
                    
                  </div> 
                    <div class=" col-md-6 mt-4" style="display: flex; align-items: end;">
                    <button  type="submit" id="BtnSubmit" class="btn btn-info">Submit</button>   
                     <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>       
                     </div>
                                </form>  -->
              <form method="post" action="" id="salaryform">
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Business Unit</label><span class="error"> *</span>
                          <select name="busunit" id="busunit" class="form-control custom-select search validate" data-placeholder="Select Business Unit" required>
                            <option hidden>Select Business Unit</option>
                            <?php foreach($businessunitvalue as $value): ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                            <?php endforeach; ?>
                          </select>
                          <label id="" class="error" for="busunit" style="display: none;">This field is required.</label>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Month</label><span class="error"> *</span>
                            <div class="input-group date">
                              <input type="text" name="datetime" class="form-control mydatetimepicker " placeholder="Month" value="" required />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 mt-4" style="display: flex; align-items: end;">
                          <div class="form-group">
                            <button type="submit" id="BtnSubmit" class="btn btn-info">Submit</button>
                            <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                          </div>
                        </div>
                      </div>
                    </form>


                            </div>
                        </div>
                    </div>
                </div> <!-- generate_payslip -->
                 <?php if($this->role->User_Permission('generate_payslip','can_add') && $this->role->User_Permission('generate_payslip','can_edit')){?>
                <div class="float-right">
                      <button style="margin-bottom: 10px;text-align: right;" class="btn btn-primary delete_all" data-url="/itemDelete" disabled>Bulk Generate Salary</button> 
                <?php $eid = $this->session->userdata('user_login_id');

                $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
                if (!$get_hr_approve) {?>
                      <button style="margin-bottom: 10px;text-align: right;" class="btn btn-primary paid_status" data-url="/itemDelete" disabled>Paid</button> 
                   <?php } ?> 
                     <a href="<?php echo base_url(); ?>Payroll/Busunitpdf" title="Bulk Report" class="btn btn-primary  bulk_report disabled" style="margin-bottom: 10px;text-align: right;" target="_blank" disabled>Bulk Report</a>
                </div>    
                <?php } ?>       
           
            <div class="table-responsive ">
              <table id="example2" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th><div class='form-check'>
                                  <input type='checkbox' class='filled-in chk-col-light-blue' id='master'>
                                  <label class='form-check-label' for='master'></label>
                                </div>
                    </th>

                  <th> S.NO </th>
                  <th> Code </th>
                  <th>Employee</th>
                  <th>Total salary</th>
                  <?php if($this->role->User_Permission('generate_payslip','can_add') && $this->role->User_Permission('generate_payslip','can_edit')){?> <th>Addition</th>
                  <?php } if($this->role->User_Permission('generate_payslip','can_add') && $this->role->User_Permission('generate_payslip','can_edit')){?>
                  <th>Deduction</th> <?php } ?>
                  <th>Loan</th>
                  <th>Status</th>
                  <th>Payslip Generated On</th>
                  <th>Paid On</th>
                  </tr>
                </thead>
              <!--  <img class="loader" src="<?php echo base_url()?>assets/loader.gif"> -->
                <tbody class="payroll">
                
                </tbody>
              </table>
            </div>                                
          </div>
        </div>
      </div>
    </div>


    <script>
      $(document).ready(function() {
        $('#example2').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "searching": false,
            "bAutoWidth": false,
             "ordering": false,
            "columnDefs": [
    { "orderable": false, "targets": 0 },

  ]
        });
       
        });
        // Populate the payroll table to generate the payroll for each individual
      $("#BtnSubmit").on("click", function(event){
        event.preventDefault();
             
               $('.delete_all').prop("disabled", false);
               $('.bulk_report').prop("disabled", false);
               $('.paid_status').prop("disabled", false);
               $('.bulk_report').removeClass("disabled");


        var busid = $('#busunit').val();
        var datetime = $('.mydatetimepicker').val();
        
        //$('#busunitid').val(busid);
        $('.salaryGenerateModal').attr('data-busunit');
        $('.delete_all').attr('data-month',datetime);
        $('.delete_all').attr('data-busunit',busid);
       $('.paid_status').attr('data-month',datetime);
     
        $('.paid_status').attr('data-busunit',busid);
        $('#busunitid').val(busid);


  
        $('.bulk_report').attr('href',"<?php echo base_url(); ?>Payroll/Busunitpdf?busunit="+busid+"&datetime="+datetime);

        //var depid = $('#depid').val();
     
        if(busid != '' && datetime != '' ){
        $.ajax({
          url: "load_employee_by_deptID_for_pay?date_time="+datetime+"&busid="+busid,
          type:"GET",
          dataType:'',
          data:'data',  
         /*  beforeSend: function() { $('.payroll').html('<img class="loader text-center"  src="<?php echo base_url()?>assets/Spinner.gif">');  },
          complete: function(){
            $('.loader').hide();
                      },  */      
          success: function(response) {
         
            $('.payroll').html(response);
          },
          error: function(response) {
            
          }
        });
      }
      });
 
    </script>
    <!-- Addition -->

      <!-- Modal -->
      <div class="modal fade" id="AdditionModal" tabindex="" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>Allowance :  <span style="font-size: 15px;font-weight: bold;" class="name"></span></h5>
              <div class="text-right">
                <i data-dismiss="modal" aria-label="Close" class="fa fa-close"></i>
              </div>
              
            </div>

                <form name="add_allowanceform" id="add_allowanceform" method="post"> 
            <div class="modal-body">
         
                    <div class="table-responsive">  
                         <table class="table table-bordered" id="dynamic_field">  
                              <tr>  
                                  <!--  <td><input type="text" name="allowance[]" placeholder="Enter Allowance" class="form-control name_list" /></td>  -->
                                  <td width="30%">
                                  <select class="form-control search" name="allowance[]">
                               
                                     <?Php foreach($allowance_values as $value): ?>
                                    <option value="<?php echo $value->allowance_name ?>"> <?php echo $value->allowance_name ?></option>
                                    <?php endforeach; ?>
                                     <?php if(empty($allowance_values)) { echo '<option value="">Select Allowance</option>'; } ?>
                                  </select>
                                </td>
                                   <td><input type="number" name="allowamount[]" placeholder="Enter Amount" class="form-control name_list allowamount" /></td>  
                                   <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                              </tr> 
                                <?php if(empty($allowance_values)) { echo '<tr><td colspan="3"><span class="error">*</span> Please Add Allowance Master</td></tr>';}?> 
                         </table>  
                         <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  --> 
                    </div>  
              
             <div class="table-responsive">
                
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Sno</th>
                  <th scope="col">Allowance</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="allowancetbl">
       
              </tbody>
            </table>
 
              </div>
               Total :<span class="totalallow"> </span>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="total_allowance" class="total_allowance" value="">
              <input type="hidden" name="emp_id">
              <input type="hidden" name="salaryid">
              <input type="hidden" name="month">
             
              <button type="button" class="btn btn-primary" id="add_allowance">Save changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
             </form> 
          </div>
        </div>
      </div>

      <script>
        /*  */
        /*<option value="Internet">Internet</option><option value="Medical">Medical</option><option value="Transportation">Transportation</option>   <option value="Over Time">Over Time</option><option value="Other">Other</option>*/
      //allowance  
       $(document).ready(function(){  
            var i=1;  
            $('#add').click(function(){  
                 i++;  /*<td><input type="text" name="allowance[]" placeholder="Enter Allowance" class="form-control name_list" /></td>*/
                 $('#dynamic_field').append('<tr id="row'+i+'" class="addfields"> <td><select class="form-control search  " name="allowance[]"><?Php foreach($allowance_values as $value): ?><option value="<?php echo $value->allowance_name ?>"> <?php echo $value->allowance_name ?></option> <?php endforeach; ?></select> </td> <td><input type="number" name="allowamount[]" placeholder="Enter Amount" class="form-control name_list allowamount" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'); 

                 initializeSelect2() 
            });  
            $(document).on('click', '.btn_remove', function(){  
                 var button_id = $(this).attr("id");   
                
                 $('#row'+button_id+'').remove();  
                  allowtotal();
            });  
            //save
            $('#add_allowance').click(function(){  
              //console.log($('[name="allowance[]"]').val());
              if($('[name="allowance[]"]').val() != '' && $('[name="allowamount[]"]').val() != '' ){          
                 $.ajax({  
                      url:"<?php echo base_url("Payroll/Add_allowance");?>",  
                      method:"POST",  
                      data:$('#add_allowanceform').serialize(),  
                      success:function(res)  
                      {  
                          var data = $.parseJSON(res); 
                        if (data.status == 'success') {
                            $('#add_allowanceform')[0].reset();
                                      $('.totalallow').text('');
                            $('#AdditionModal').modal('hide');
                            $(".modal-backdrop").remove();
                            
                                $('#add_allowanceform')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });
                      
                                $('.addfields').remove();
                                 loadallowance();
                        } else if (data.status == 'error') {
                                $('#add_allowanceform')[0].reset();
                             $('.totalallow').text('');
                            //    $('#AdditionModal').modal('hide');
                            // $(".modal-backdrop").remove();

                            $.wnoty({
                                type: 'error',
                                message: data.message,
                                autohideDelay: 1000,
                                position: 'top-right'

                            });
                              $('.addfields').remove();
                                 loadallowance();
                        }
                      }  
                 });
                 } 
            });  
       });  
       //get allowance
       function loadallowance(){
        $(document).ready(function () {
        $(document).on("click", '.allowancebtn',function (event) {
        event.preventDefault();
        var emid = $(this).attr("data-id");  
        var salaryid = $(this).attr("data-salaryid");
        var date = $(this).attr("data-month");
        if(emid != '' && salaryid != '' ){
        $.ajax({
          url: "Get_emp_allowance?emid="+emid+"&salaryid="+salaryid+"&date="+date,
          type:"GET",
          dataType:'',
          data:'data',          
          success: function(response) {
            // console.log(response);
            $('.allowancetbl').html(response);

                   // Calculate and display the total allowance amount
                var totalAmount = 0;
                $('.allowancetbl').find('td:nth-child(3)').each(function() {
                  var amount = parseFloat($(this).text());
                  if (!isNaN(amount)) {
                    totalAmount += amount;
                  }
                });


                $('.totalallow').text(totalAmount);
               
          },
          error: function(response) {
            
          }
        });
      }
      });
      });

      }
      loadallowance();
      //delete allowance
      $(document).ready(function () {
        $(document).on("click", '.delallowance',function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");  
         var row = $(this).closest("tr");
        if(id != ''  ){
        $.ajax({
          url: '<?php echo base_url("Payroll/deleteallowance")?>',
          type:"POST",
          data: {id:id},          
          success: function(response) {
          
           row.remove();
           allowtotal();
           /* $('#AdditionModal').modal('hide');
            $(".modal-backdrop").remove();*/
             $.wnoty({
              type: 'success',
              message: "Deleted Successfully",
              autohideDelay: 1000,
              position: 'top-right'

              });
          },
          error: function(response) {
            
          }
        });
      }
      });
      });


      $(document).ready(function () {

          $(document).on("keyup", '.allowamount',function () {
            allowtotal();
            });
      });

      function allowtotal(){
        var sum = 0;
            
           var totalAmount = 0;
            $('.allowancetbl').find('td:nth-child(3)').each(function() {
              var amount = parseFloat($(this).text());
              if (!isNaN(amount)) {
                totalAmount += amount;
              }
            });
          //  $('.totalallow').text('Total: ' + totalAmount);
          
              //old

              $('.allowamount').each(function () {
                  sum += Number($(this).val());
              });

              $('.totalallow').text(sum + totalAmount);
              $('.total_allowance').val(sum);


      }

          $(document).ready(function () {

            $(document).on('click', ".AdditionModal", function (e) {
              e.preventDefault(e);
              var emp_id = $(this).attr('data-id');
              var salaryid = $(this).attr('data-salaryid');
              var month = $(this).attr('data-month');
           
             $('#add_allowanceform').find('[name="emp_id"]').val(emp_id).end();
             $('#add_allowanceform').find('[name="salaryid"]').val(salaryid).end();
             $('#add_allowanceform').find('[name="month"]').val(month).end();
              var fullName = $(this).closest('tr').find('td:nth-child(4)').text();
            // console.log(fullName);
             $('.name').text(fullName);

               });
             });





     </script>

    <!-- Deduction -->

      <!-- Modal -->
      <div class="modal fade" id="DeductionModal" tabindex="" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>Deduction : <span style="font-size: 15px;font-weight: bold;" class="name"></span></h5></h5>
              <div class="text-right">
                <i data-dismiss="modal" aria-label="Close" class="fa fa-close"></i>
              </div>
            </div>
                <form name="add_deductionform" id="add_deductionform" method="post"> 
            <div class="modal-body">
         
              <div class="table-responsive">  
                   <table class="table table-bordered" id="dynamic_deduct">  
                        <tr>  
                             <!-- <td><input type="text" name="deduction[]" placeholder="Enter Deduction" class="form-control name_list" /></td>  -->
                             <td width="30%">
                                  <select class="form-control search  " name="deduction[]">
                                   <!--  <option value="Loan">Loan</option>
                                   <option value="Other">Other</option> -->
                                   <?Php foreach($deduction_values as $value): ?>
                                    <option value="<?php echo $value->deduction_name ?>"> <?php echo $value->deduction_name ?></option>
                                    <?php endforeach; ?>
                                   <?php if(empty($deduction_values)) { echo '<option value="">Select Deduction</option>'; } ?>
                                  </select>
                                </td>
                             <td><input type="number" name="deductionamount[]" placeholder="Enter Amount" class="form-control name_list deductionamount" /></td>  
                             <td><button type="button" name="add_deduct" id="add_deduct" class="btn btn-success">Add More</button></td>  
                        </tr>  
                        <?php if(empty($deduction_values)) { echo '<tr><td colspan="3"><span class="error">*</span> Please Add Deduction Master</td></tr>';}?>
                   </table>  
                   <!-- <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  --> 
              </div>  
              
             <div class="table-responsive">
                
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Sno</th>
                      <th scope="col">Deduction</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody class="deductiontbl">
             
                  
                   
              
                  </tbody>
                </table>
     
              </div>
               Total :<span class="totaldeduct"> </span>
            </div>
            <div class="modal-footer">
                   <input type="hidden" name="total_deduction" class="total_deduction" value="">
              <input type="hidden" name="emp_id">
              <input type="hidden" name="salaryid">
               <input type="hidden" name="month">
              <button type="button" class="btn btn-primary" id="add_deduction">Save changes</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
             </form> 
          </div>
        </div>
      </div>

      <script>
        /* */
        /*<option value="Loan">Loan</option> <option value="Other">Other</option>*/
      //deduction  
       $(document).ready(function(){  
            var i=1;  
            $('#add_deduct').click(function(){  
                 i++;  /*<td><input type="text" name="deduction[]" placeholder="Enter Deduction" class="form-control name_list" /></td>*/
                 $('#dynamic_deduct').append('<tr id="rows'+i+'" class="addfields"> <td> <select class="form-control search" name="deduction[]"><?Php foreach($deduction_values as $value): ?><option value="<?php echo $value->deduction_name ?>"> <?php echo $value->deduction_name ?></option><?php endforeach; ?></select> </td> <td><input type="number" name="deductionamount[]" placeholder="Enter Amount" class="form-control name_list deductionamount" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'); 
                 initializeSelect2() 
            });  
            $(document).on('click', '.btn_remove', function(){  
                 var button_id = $(this).attr("id");   
                
                 $('#rows'+button_id+'').remove();  
                  deduction();
            });  
            //save deduction
            $('#add_deduction').click(function(){ 
              if($('[name="deduction[]"]').val() != '' && $('[name="deductionamount[]"]').val() != '' ){          
                 $.ajax({  
                      url:"<?php echo base_url("Payroll/Add_deduction");?>",  
                      method:"POST",  
                      data:$('#add_deductionform').serialize(),  
                      success:function(data)  
                      {  
                           var data = $.parseJSON(data);
                              $('#DeductionModal').modal('hide');
                             $(".modal-backdrop").remove();

                        if (data.status == 'success') {
                                 $('#add_allowanceform')[0].reset();
                                 $('.totaldeduct').text('');
                            $('#DeductionModal').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#add_deductionform')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 5000,
                                    position: 'top-right'
                                });
                  
                                $('.addfields').remove();
                                loaddeduction();
                        } else if (data.status == 'error') {
                             $('#add_deductionform')[0].reset();
                             $('.totaldeduct').text('');
                   
                             //  $('#DeductionModal').modal('hide');
                             // $(".modal-backdrop").remove();

                            $.wnoty({
                                type: 'error',
                                message: data.message,
                                autohideDelay: 1000,
                                position: 'top-right'

                            });
                              $('.addfields').remove();
                                 loaddeduction();
                        }
                      }  
                 });
                 } 
            });  
       });  
       //get deduction
      function loaddeduction(){
        $(document).ready(function () {
        $(document).on("click", '.deductionmodal',function (event) {
        event.preventDefault();
        var emid = $(this).attr("data-id");  
        var salaryid = $(this).attr("data-salaryid");
        var date = $(this).attr("data-month");
        if(emid != '' && salaryid != '' ){
        $.ajax({
          url: "Get_emp_deduction?emid="+emid+"&salaryid="+salaryid+"&date="+date,
          type:"GET",
          dataType:'',
          data:'data',          
          success: function(response) {
            // console.log(response);
            $('.deductiontbl').html(response);

                // Calculate and display the total allowance amount
                var totalAmount = 0;
                $('.deductiontbl').find('td:nth-child(3)').each(function() {
                  var amount = parseFloat($(this).text());
                  if (!isNaN(amount)) {
                    totalAmount += amount;
                  }
                });


                $('.totaldeduct').text(totalAmount);
          },
          error: function(response) {
            
          }
        });
      }
      });
      });

      }
      loaddeduction();
      //delete deduction
      $(document).ready(function () {
        $(document).on("click", '.deldeduction',function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");  
         var row = $(this).closest("tr");
        if(id != ''  ){
        $.ajax({
          url: '<?php echo base_url("Payroll/deletededuction")?>',
          type:"POST",
          data: {id:id},          
          success: function(response) {
           
            /* $('#DeductionModal').modal('hide');
            $(".modal-backdrop").remove();*/
             $.wnoty({
              type: 'success',
              message: "Deleted Successfully",
              autohideDelay: 1000,
              position: 'top-right'

              });
           row.remove();
           deduction()
          },
          error: function(response) {
            
          }
        });
      }
      });
      });


      $(document).ready(function () {

          $(document).on("keyup", '.deductionamount',function () {
            deduction();
            });
      });

      function deduction(){
         var sum = 0;
            
           var totalAmount = 0;
            $('.deductiontbl').find('td:nth-child(3)').each(function() {
              var amount = parseFloat($(this).text());
              if (!isNaN(amount)) {
                totalAmount += amount;
              }
            });
            $('.deductionamount').each(function () {
                  sum += Number($(this).val());
              });

              $('.totaldeduct').text(sum + totalAmount);
              $('.total_deduction').val(sum);

        // var sum = 0;

        //       $('.deductionamount').each(function () {
        //           sum += Number($(this).val());
        //       });

        //       $('.totaldeduct').text(sum);
        //       $('.total_deduction').val(sum);
      }

       $(document).ready(function () {

            $(document).on('click', ".deductionmodal", function (e) {
              e.preventDefault(e);
              var emp_id = $(this).attr('data-id');
              var salaryid = $(this).attr('data-salaryid');
              var month = $(this).attr('data-month');
             // $('#generatePayrollModal').modal('show');
             $('#add_deductionform').find('[name="emp_id"]').val(emp_id).end();
             $('#add_deductionform').find('[name="salaryid"]').val(salaryid).end();
             $('#add_deductionform').find('[name="month"]').val(month).end();
               var fullName = $(this).closest('tr').find('td:nth-child(4)').text();
            // console.log(fullName);
             $('.name').text(fullName);

               });
             });




     </script>

    <div class="modal fade" id="generatePayrollModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
          <div class="modal-header">
            <h4 class="modal-title" id="">Salary Setup 
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;
              </span>
            </button>
          </div>
          <form method="post" action="pay_salary_add_record" id="generatePayrollForm" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group ">
               
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                       <label class="control-label text-left ">Employee</label>
                      <select class="form-control custom-select" data-placeholder="Choose a Category" id="emid" tabindex="1" name="emid" id="OnEmValue" required>
                  <option value="#">Select Here
                  </option>
                  <?php foreach ($employee as $value): ?>
                  <option value="<?php echo $value->em_id; ?>">
                    <?php echo $value->first_name.' '.$value->last_name; ?>
                  </option>
                  <?php endforeach; ?>
                </select>
                  </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group ">
                        <input type="hidden" name="year">
                <label class="control-label  ">Month
                </label>
                <div class="">
                
                <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="month" id="salaryMonth" required>
                  <option value="#">Select Here
                  </option>
                  <option value="1">January
                  </option>
                  <option value="2">February
                  </option>
                  <option value="3">March
                  </option>
                  <option value="4">April
                  </option>
                  <option value="5">May
                  </option>
                  <option value="6">June
                  </option>
                  <option value="7">July
                  </option>
                  <option value="8">August
                  </option>
                  <option value="9">September
                  </option>
                  <option value="10">October
                  </option>
                  <option value="11">November
                  </option>
                  <option value="12">December
                  </option>
                </select>
                </div>
              </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-6">
                       <div class="form-group ">
                <label class="control-label text-left">Basic Salary
                </label>
                <div class="">
                <input type="text" name="basic" class="form-control" id="basic" value="">
              </div> 
              </div> 
                  </div>
                  <div class="col-md-6">
                 <div class="form-group ">
                <label class="control-label text-left">Total Working Days
                </label>
                <div class="">
                    <input type="text" name="total_working_days" class="form-control " value="" readonly>
                </div>
              </div>
                  </div>
                </div>   
                <div class="row">
                  <div class="col-md-6">
                     
              <div class="form-group ">
                <label class="control-label text-left ">Total Worked Days
                </label>
                <div class="">
                    <input type="text" name="emp_worked_days" class="form-control " value="" readonly>
                </div>
              </div>
                  </div>
                  <div class="col-md-6">
                       <div class="form-group " id="loan">
                <label class="control-label text-left ">Loan
                </label>
                <div class="">
                  <input type="text" name="loan" class="form-control loan" id="" value="">
                </div>
              </div>
                  </div>
                </div>   
                 <div class="row">
                  <div class="col-md-6">
                  <div class="form-group " >
                  <label class="control-label text-left ">Allowance
                  </label>
                  <div class="">
                  <input type="text" name="addition" class="form-control" id="" value="" readonly>
                </div>
              </div>
                  </div>
                  <div class="col-md-6">
                       <div class="form-group " id="diduction">
                <label class="control-label text-left">Deduction
                </label>
                <div class="">
                <input type="text" name="diduction" class="form-control diduction" id="" value="" readonly>
              </div>                                      
              </div>
                  </div>
                </div>   
                <div class="row">
                  <div class="col-md-6">
                        <div class="form-group ">
                <label class="control-label text-left ">Pay Date<span class="error"> *</span>
                </label>
                <div class="">
                  <input type="text" name="paydate" class="form-control mydatetimepickerFull" id="paydate" value="<?php echo date('Y-m-d'); ?>" required >
                </div>
              </div> 
                  </div>
                  <div class="col-md-6">
                      <div class="form-group ">
                <label class="control-label  ">Final Salary
                </label>
                <div class="">
                   <input type="text" name="total_paid" class="form-control total_paid" id="" value="" required>
                </div>
              </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group ">
                  <label class="control-label  ">Status</label><br>
                 
                  <input name="status" type="radio" id="radio_1" data-value="Paid" class="duration" value="Paid" checked="checked">
                  <label for="radio_1">Paid</label>
                 <!--  <input name="status" type="radio" id="radio_2" data-value="Process" class="type" value="Process">
                  <label for="radio_2">Process</label> -->
                  
              </div>
                 </div>
                 <div class="col-md-6">
                             <div class="form-group " >
                <label class="control-label text-left hidden" style="display: none;">Paid Type</label><br>
                <div class="">
                <input name="paid_type" type="radio" id="radio_3" data-value="Hand Cash" class="hidden" value="Hand Cash" checked="checked" >
                <label for="radio_3" style="display: none;">Hand Cash</label>
                <input name="paid_type" type="radio" id="radio_4" data-value="Bank" class="type hidden" value="Bank">
                <label for="radio_4" style="display: none;">Bank</label>
                </div>
            </div>
                 </div> 
                </div>
              </div>                                        
                           
             <!--  </div>              
              </div>  -->  
              <!--<div class="form-group row" style="margin-top: 25px;">
                <label class="control-label text-left col-md-3">Paid Type
                </label>
                <div class="col-md-9">
                <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="paid_type" required>
                  <option value="#">Select Here
                  </option>
                  <option value="Hand Cash">Hand Cash
                  </option>
                  <option value="Bank">Bank
                  </option>
                </select>
                </div>                 
            </div>-->
                               
            </div>
            <div class="modal-footer">
              <input type="hidden" name="action" value="add" class="form-control" id="formAction">              
              <input type="hidden" name="loan_id" value="" class="form-control" id="loanID">                                      
              <input type="hidden" name="type_id" value="" class="form-control" id="type_id">                                      
              <input type="hidden" name="busunitid" value="" class="form-control" id="busunitid">                                      
              <input type="hidden" name="leave_deduction" value="" class="form-control" id="leave_deduction">                                      
              
              <button type="submit" class="btn btn-primary" id="add_salary">Submit
              </button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
          $(document).ready(function () {
          $(document).on('keyup','.hours_worked',function() {
            var finalsalary = 0;  
            //var total;  
            var deduction = 0; 
            var rows = this.closest('#generatePayrollForm div');
             
            var hrate = parseFloat($('.hrate').val()); 
            var final =parseFloat($('.total_paid').val());
            var loan = parseFloat($('.loan').val());  
            var hwork =parseFloat($('.hours_worked').val());
            var thour =parseFloat($('.thour').val());
              
              finalsalary = (hwork*hrate) - loan;
              $(".total_paid").val(finalsalary.toFixed(2));
              var total = thour - hwork;
              var deduction = (total*hrate) + loan;
              $(".diduction").val(deduction.toFixed(2));
              $(".wpay").html(total.toFixed(2));

           

          });
        });
          </script>
    <script type="text/javascript">

      //check box
       $(document).ready(function () {  
   
        $('#master').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".sub_chk").prop('checked', true);    
         } else {    
            $(".sub_chk").prop('checked',false);    
         }    
        }); 
        });

       /*--generate salaray-*/
        $(document).ready(function () { 
          //$('.delete_all').on('click', function(e) {  
           $(document).on('click', '.delete_all', function() {
           
            //var allEM = [];    
            var allVals = [];    
            var allloans = [];    
            $(".sub_chk:checked").each(function() {    
                allVals.push($(this).attr('data-id'));  
                allloans.push($(this).attr('data-loanstatus'));  
            });    
             var busunit = $(this).attr('data-busunit');
             var datetime = $(this).attr('data-month');
             var loan_status = $(this).attr('data-loanstatus');

          //New 
          // Create an array to store pairs of em_id and loan_status
          var selectedData = [];

          $(".sub_chk:checked").each(function() {    
              var em_id = $(this).attr('data-id');
              var loan_status = $(this).attr('data-loanstatus');
              // Create a pair and push it to the selectedData array
              selectedData.push(em_id + ',' + loan_status);
          });

          // Join the selectedData array into a single string
          var joinedData = selectedData.join(',');
           //console.log(joinedData)
                    
          //New 

            if(allVals.length <=0)    
            {    
                alert("Please select row.");    
            }  else {    
   
                var check = confirm("Are you sure you want to generate?");    
                if(check == true){  
                  if(allVals.length > 0)    
                {    
                    $('.loadercell').show()  
                }  
                  
   
                    var join_selected_values = allVals.join(",");
                    var Allloan_data = allloans.join(",");
                    
                   $.ajax({
                      url: 'generate_payroll_bulk',
                      method: 'POST',
                      data: {emids:join_selected_values,
                      busunit:busunit,
                      datetime:datetime,
                      joinedData:joinedData
                      },
                     /* beforeSend: function() {  },
                        complete: function(){
                         $('.loader').hide();
                      },*/
                    
                        success: function (resp) {  
                        //$('.loader').hide();
                        var data = $.parseJSON(resp);
                          //console.log(data)
                      if (data.status == 'success') { 
                        
                          $.wnoty({
                                    type: 'success',
                                    message:'Successfully Generated',
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });
                          // setTimeout(function() {
                          //       location.reload(true);
                          //   }, 2000)
                           }else if (data.status == 'error') { 
                        
                         $.wnoty({
                                    type: 'error',
                                    message:data.message,
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });
                           }

                       $('.loadercell').hide()

                        },  
                        error: function (data) {  
                            alert(data.responseText);  
                        }  
                    });  
   
                
                }    
            }    
        });  
    });  

        /*Paid status*/
                $(document).ready(function () { 
          $('.paid_status').on('click', function(e) {  
            
           
            //var allEM = [];    
            var allVals = [];    
            $(".sub_chk:checked").each(function() {    
                allVals.push($(this).attr('data-id'));  
            });    
             var busunit = $(this).attr('data-busunit');
             var datetime = $(this).attr('data-month');

            if(allVals.length <=0)    
            {    
                alert("Please select row.");    
            }  else {    
   
                var check = confirm("Are you sure you want to change status?");    
                if(check == true){  
                  if(allVals.length > 0)    
                {    
                    $('.loadercell').show()  
                }  
                  
   
                    var join_selected_values = allVals.join(",");
                     
                   $.ajax({
                      url: 'update_payroll_paid_status',
                      method: 'POST',
                      data: {emids:join_selected_values,
                      busunit:busunit,
                      datetime:datetime
                      },
                     /* beforeSend: function() {  },
                        complete: function(){
                         $('.loader').hide();
                      },*/
                    
                        success: function (resp) {  
                        //$('.loader').hide();
                        var data = $.parseJSON(resp);

                      if (data.status == 'success') { 
                        
                          $.wnoty({
                                    type: 'success',
                                    message:'Status Updated Successfully ',
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });

                            //   setTimeout(function() {
                            //     location.reload(true);
                            // }, 2000);
                           }else if (data.status == 'error') { 
                        
                         $.wnoty({
                                    type: 'error',
                                    message:data.message,
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });
                           }

                       $('.loadercell').hide()

                        },  
                        error: function (data) {  
                            alert(data.responseText);  
                        }  
                    });  
   
                
                }    
            }    
        });  
    });  


         //$(document).ready(function () {

        $(document).on('click', "#master", function (e) { 

          $(".sub_chk:checked").each(function() {    
               var emid = $(this).data('id');
                var month = $(this).data('month');
                var year = $(this).data('year');
                var has_loan = $(this).data('has_loan');
                var datetime = $(this).data('datetime');

                var busunit = $(this).data('busunit'); 
            });  
        })
        //})
    

       /*---*/

    // Populate salary data on generate salary click
      $(document).ready(function () {

        $(document).on('click', ".salaryGenerateModal", function (e) {
          e.preventDefault(e);

          $('#generatePayrollModal').modal('show');

          var emid = $(this).data('id');
          var month = $(this).data('month');
          var year = $(this).data('year');
          var has_loan = $(this).data('has_loan');
          var datetime = $(this).data('datetime');

          var busunit = $(this).data('busunit');
   
          //console.log(datetime);

          $('#generatePayrollForm').find('[name="emid"]').val(emid).attr('readonly', true).end();
          $('#generatePayrollForm').find('[name="month"]').val(Math.abs(month)).attr('readonly', true).end();

          $.ajax({
            url: 'generate_payroll_for_each_employee?month='+month+'&year='+year+'&employeeID='+emid+'&datetime='+datetime+'&busunit='+busunit,
            method: 'GET',
            data: '',
            dataType: 'json',
          }).done(function (response) {
            

            if(response.addition == 0) {
                $('#generatePayrollForm').find('[id="addition"]').val('').hide().end();
            }
            if(response.diduction == 0) {
                $('#generatePayrollForm').find('[id="diduction"]').val('').hide().end();
            }
            if(response.loan == 0) {
                $('#generatePayrollForm').find('[id="loan"]').val('').hide().end();
            }

            $('#generatePayrollForm').find('[name="basic"]').val(response.basic_salary).attr('readonly', true).end();
            $('#generatePayrollForm').find('[name="total_working_days"]').val(response.total_working_days).attr('readonly', true).end();
            $('#generatePayrollForm').find('[name="emp_worked_days"]').val(response.emp_working_days).attr('readonly', true).end();
            $('#generatePayrollForm').find('[name="addition"]').val(response.sum_allowance).attr('readonly', true).end();
            $('#generatePayrollForm').find('[name="diduction"]').val(response.sum_deduction).attr('readonly', true).end();
              $('#generatePayrollForm').find('[name="loan"]').val(response.loan_amount).prop('readonly', true).end();
            $('#generatePayrollForm').find('[name="total_paid"]').val(response.final_salary).attr('readonly', true).end();
           
            $('#generatePayrollForm').find('[name="type_id"]').val(response.type_id).attr('readonly', true).end();
            $('#generatePayrollForm').find('[name="leave_deduction"]').val(response.leave_deduction).attr('readonly', true).end();

            //old
       /*     $('#generatePayrollForm').find('[name="month_work_hours"]').val(response.total_work_hours).attr('readonly', true).end();
            $('#generatePayrollForm').find('[name="hours_worked"]').val(response.employee_actually_worked).attr('readonly', true).end();*/
           /* $('#generatePayrollForm').find('[name="addition"]').val(response.addition).end();
            $('#generatePayrollForm').find('[name="diduction"]').val(response.diduction).end();*/


            $('#generatePayrollForm').find('[class="wpay"]').html(response.wpay).end();
          
            $('#generatePayrollForm').find('[name="loan_id"]').val(response.loan_id).end();
            //$('#generatePayrollForm').find('[name="total_paid"]').val(response.final_salary).end();
            $('#generatePayrollForm').find('[name="year"]').val(year).end();
            $('#generatePayrollForm').find('[name="hrate"]').val(response.rate).end();
      });
});
        });


          //save

          $('.custom-select').on('change', function() {
            //$('input:required').remove();
            $(this).removeClass('error');
            $(this).addClass('valid');
            $(this).next('.error').css({
                display: 'none'
            });
        })
        $(document).on('click', '#add_salary', function() {
            event.preventDefault();
            $("#generatePayrollForm").valid();

            var paydate = $("#paydate").val();
            var hours_worked = $("#hours_worked").val();
           
            
            if (paydate != '' && hours_worked != '' ) {

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("Payroll/pay_salary_add_record");?>',
                    data: new FormData($("#generatePayrollForm")[0]),
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        var data = $.parseJSON(resp);
                        if (data.status == 'success') {

                            $('#generatePayrollModal').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#generatePayrollForm')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });
                           // }, 2000);
                            setTimeout(function() {
                                location.reload(true);
                            }, 2000);
                        } else if (data.status == 'error') {
                            $('#generatePayrollForm')[0].reset();
                            $('#generatePayrollModal').modal('hide');
                            $(".modal-backdrop").remove();

                            $.wnoty({
                                type: 'error',
                                message: data.message,
                                autohideDelay: 3000,
                                position: 'top-right'

                            });
                        }
                    },
                });
            }

            return false;
        })


        // New Loan 
        $(document).ready(function() {
      // Attach a change event handler to the loan_sts checkboxes
      //$('.loan_sts').change(function() {
         $(document).on('click', '.loan_sts', function() {
          var isChecked = $(this).prop('checked'); // Check if the loan_sts checkbox is checked
          //console.log(isChecked);
          // Find the corresponding sub_chk checkbox in the same row
          var sub_chk = $(this).closest('tr').find('.sub_chk');

          // If loan_sts checkbox is unchecked, add the data-loanstatus attribute to sub_chk
          if (!isChecked) {
               //console.log("Test");
              sub_chk.attr('data-loanstatus', 'unchecked');
          } else {
              // If loan_sts checkbox is checked, remove the data-loanstatus attribute from sub_chk
             // sub_chk.removeAttr('data-loanstatus');
             sub_chk.attr('data-loanstatus', 'checked');
          }
      });
  });

    </script>                             
    <?php
$this->load->view('backend/footer');
?>