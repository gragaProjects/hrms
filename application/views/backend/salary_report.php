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
      <h3 class="text-themecolor"><i class="fa fa-money"></i> Payroll Report
      </h3>
    </div>
    <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item">
          <a href="javascript:void(0)">Home
          </a>
        </li>
        <li class="breadcrumb-item active">Payroll Report
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
              <h4 class="m-b-0 text-white">&nbsp;&nbsp; Monthly Payroll Report
            </h4>
          </div>
          <div class="card-body">
          
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="card-body">
                                <form method="post" action="" id="salaryform" class=" row">
                                <!--     <div class=" col-md-3">
                                      <label>Employee</label>
                                        <select class="form-control custom-select"  tabindex="1" name="emid" id="emid"  required>
                                        <option>Employee</option>
                                         <?php foreach($employee as $value): ?>
                                         <option value="<?php echo $value->em_id; ?>">
                                            <?php echo $value->first_name ?>
                                            <?php echo $value->last_name ?>
                                         </option>
                                         <?php endforeach; ?>
                                        </select>
                                    </div> -->
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
                                    <div class=" col-md-3">
                                      <label> Month</label>
                                     
                                        <div class="">
                                          <div class='input-group date' id=''>
                                            <input type='text' name="datetime" class="form-control mydatetimepicker" placeholder="Month"/>
                                          </div>
                                        </div>
                                      
                                    </div> 
                                      <div class=" col-md-6  mt-4">
                                      <button type="submit" id="BtnSubmit" class="btn btn-info">Submit</button>   
                                       <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>       
                                       </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>            
            
            <!-- <div class="salaryr">
         
            </div> -->
              <div class="table-responsive ">
                                    <table id="example123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                 <!-- <th class="">S NO </th> -->
                                                <th>Emp Code </th>
                                                <th>Employee </th>
                                                 <th>Paid Date</th>
                                                <th>Status</th>
                                                <th class="jsgrid-align-center">Action</th>
                                            </tr>
                                        </thead>
                                   
                                        <tbody class="salaryr">

                                        </tbody>
                                    </table>
                                </div>
            
          </div>
        </div>
      </div>
    </div>


    <script>
        $('.print_payslip_btn').hide();
        // Populate the payroll table to generate the payroll for each individual
      $("#BtnSubmit").on("click", function(event){
        event.preventDefault();
        var busunit = $('#busunit').val();
        //var emid = $('#emid').val();
        var datetime = $('.mydatetimepicker').val();
        
        $.ajax({
          url: "load_employee_Invoice_by_EmId_for_pay?date_time="+datetime+"&busunit="+busunit,
          type:"GET",
          dataType:'',
          data:'data',          
          success: function(response) {
            // console.log(response);
           $('.salaryr').html(response);
              $('.print_payslip_btn').show();
          },
          error: function(response) {
            
          }
        });
      });
    </script>


                            
    <?php
$this->load->view('backend/footer');
?>
   <script src="<?php echo base_url(); ?>assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $(".print_payslip_btn").click(function() {
            //console.log('sfsdfs');
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.salaryr").printArea(options);
        });
    });
    </script>