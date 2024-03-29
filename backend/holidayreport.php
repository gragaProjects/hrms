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
      <h3 class="text-themecolor"><i class="fa fa-money"></i> Holiday Report
      </h3>
    </div>
    <!-- <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="javascript:void(0)">Home
          </a>
        </li>
        <li class="breadcrumb-item active">Holiday Report
        </li>
      </ol>
    </div> -->
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
              <h4 class="m-b-0 text-white">&nbsp;&nbsp; Monthly Holidays List
            </h4>
          </div>
          <div class="card-body">
          
                <div class="">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <form method="post" action="" id="salaryform" >
                          
                                    <div class="row">
                                    <div class=" col-md-3">
                                    
                                         <label>Holiday Structure</label><label class="error"> </label>
                                            <select class="form-control custom-select assignleave search"  tabindex="1" name="holidaystructureid" id="holidaystructureid" required>
                                                <option value="">Select Here..</option>
                                                    <?php if(isset($organisationvalue->holidaystructureid)){?>
                                                <?php foreach($holidaystruc as $value): ?>

                                                <option value="<?php echo $value->id ?>"  ><?php echo $value->holidaystructure ?></option>

                                                <?php endforeach; ?>
                                            <?php } else {?>
                                                 <?php foreach($holidaystruc as $value): ?>

                                                <option value="<?php echo $value->id ?>"  ><?php echo $value->holidaystructure ?></option>

                                                <?php endforeach; ?>
                                            <?php } ?>

                                            </select>
                                        
                                    </div>   
                                    <div class="col-md-3">
                                      <label> Month
                                      </label>
                                   
                                        <div class="">
                                          <div class='input-group date' id=''>
                                            <input type='text' name="datetime" class="form-control monthdatetimepicker" placeholder="Month"/>
                                          </div>
                                        </div>
                                     
                                      </div>
                                       <div class=" col-md-6  mt-4 ">
                                        <p></p>
                                      <button  type="submit" id="BtnSubmit" class="btn btn-info">Submit</button> 
                                      <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>         
                                       </div>
                                    </div> 
                                     
                                </form>
                            </div>
                        </div>
                    </div>
                </div>            
            
            <div class="salaryr">
             <div class="card-body">
                        <div class="table-responsive ">
                            <table id="holiday-report" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Holiday</th>
                                        <th>Month</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>No. Of days</th>
                                        
                                    </tr>
                                </thead>
                              
                                <tbody  class="holidayreport">

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>

   <script>
    $(document).ready(function() {
      $('#holiday-report').DataTable({
 
         "ordering": false,
        "searching": false,
        "lengthChange": false,
        "info": false, 

        });
        });
    </script>
 
    <script>
   
        // Populate the payroll table to generate the payroll for each individual
      $("#BtnSubmit").on("click", function(event){
        event.preventDefault();
       // var emid = $('#emid').val();
        var datetime = $('.monthdatetimepicker').val();
        var structureid = $('#holidaystructureid').val();
        //console.log(structureid);
        
        $.ajax({
          url: "getholidayreport?date_time="+datetime+'&structureid='+structureid,
          type:"GET",
          dataType:'',
          data:'data',          
          success: function(response) {
            // console.log(response);
              //var info=$.parseJSON(response);
            //$('.leave').html('<tr><td>'+info.holidayname+'</td><td>'+info.month+'</td><td>'+info.monthcount+'</td></tr>');
             $('.holidayreport').html(response);
             
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