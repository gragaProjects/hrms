<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<style type="text/css">
      .table{
    margin-bottom:0px!important;
}
</style>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-fax" style="color:#1976d2"> </i> Leave Report</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
              <!--   <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave Report</li> -->
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Report List</h4>
                    </div>
                    <div class=" card-body row">
                        <div class="col-12">
                            <div class="">
                                <div class="">
                                    <form method="post" action="" id="salaryform" class=" row"><!-- form-material -->
                                        <div class="col-md-3">
                                              <label>Month</label>
                                            <input type="text" name="datetime" id="date_from" class="form-control monthdatetimepicker" placeholder="From" required>
                                        </div>
                              
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
                                        <!-- emp -->
                                        <div class=" col-md-3">
                                            <label>Employee</label>
                                            <select class="select2 form-control custom-select search "  tabindex="1" id="emid" name="emid" required>
                                                <option value="#">Select Here</option>
                                                <option value="all">All Employees</option>
                                              <!--   <?php foreach($employee as $value): ?>
                                                <option value="<?php echo $value->em_id ?>">
                                                    <?php echo $value->first_name.' '.$value->last_name; ?>
                                                </option>
                                                <?php endforeach; ?> -->
                                            </select>
                                        </div>
                                        <div class="col-md-6   ">
                                            <input type="submit" class="btn btn-info" value="Submit" name="submit" id="BtnSubmit">
                                            <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" style=" padding-top: 0px; ">
                         <a href="<?php echo base_url(); ?>Payroll/Busunitpdf" title="Export Pdf" class="btn btn-primary  leave_report " style="margin-bottom: ;text-align: right; display:none;" target="_blank" >Pdf</a>
                        <div class="table-responsive ">
                            <table id="leavereport" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Emp Code</th>
                                        <th>Employee</th>
                                        <th>Type</th>
                                        <th>No. of Days</th>
                                        <!-- <th>Days</th> -->
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Paid Status</th>
                                        <th>Leave Status</th>
                                        <!--<th>Total</th>-->
                                    </tr>
                                </thead>
                         
                                <tbody class="leave">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#BtnSubmit").on("click", function(event) {

                    event.preventDefault();

                    var busid = $('#busunit').val();
                    var emid = $('#emid').val();
                    var datetime = $('.monthdatetimepicker').val();
                    //console.log(datetime);
                    $('.leave_report').attr('href',"<?php echo base_url(); ?>Leave/printleave?busunit="+busid+"&datetime="+datetime+ "&emid=" + emid);
                    $.ajax({
                        url: "Get_LeaveDetails?date_time=" + datetime + "&busid=" + busid+ "&emid=" + emid,
                        type: "GET",
                        data: 'data',
                        success: function(response) {
                            $('tbody').html(response);
                           /* $('.table-responsive').before().append('<button type="submit" class="btn btn-primary" id="add_salary">Print </button>')*/
                            $('.leave_report').show();
                        }
                    });
                });
            });
        
        //busniess unit employee
        $(document).ready(function(){
        $("#busunit").change(function(){
        
        var busunit = $(this).val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Employee/GetReportEmp");?>",
        data: { busunit : busunit },
        success:function(data){
        var info=$.parseJSON(data);
        $("#emid").html(info.content);
        }
        })
        });
        
        });
   
        </script>
        <?php $this->load->view('backend/footer'); ?>
      <script>
    $(document).ready(function() {
      $('#leavereport').DataTable({
       "scrollY": "50vh",
        "scrollCollapse": true,
        "pageLength": 50,
         "ordering": false,
        "searching": false,
        "lengthChange": false,
        "info": false, 

        });
        });
    </script>
 