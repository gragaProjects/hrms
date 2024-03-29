<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>

      <?php
       if($this->input->get('id')){
             $id = $this->input->get('id');
             $monthlytimedata = $this->Timesheet_modal->Monthtimesheetvalue($id);
               $getdate = explode('-', $monthlytimedata->month);
                 $tmonth = $getdate[0];
                 $tyear  = $getdate[1];

         //print_r($dailytimesheetdata);die();
         }
        ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <!-- dailytimesheetdata -->
                    <h3 class="text-themecolor"><i class="fa fa-calendar" style="color:#1976d2"></i> <?php echo $employeeData->first_name .' '.$employeeData->last_name; ?> TimeSheet <?php if($monthlytimedata->month){echo date("F Y", strtotime($tyear."-".$tmonth));}?>  </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> TimeSheet</li> -->
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">


                <div class="row m-b-10"> 
                    <div class="col-12">
                  <!--   -->

                    <a data-toggle="modal" data-target="#monthlytimesheetmodel1" data-whatever="@getbootstrap" class="btn btn-info TimesheetModal text-white">Import  Timesheet </a>
                    <!-- end -->
                       <!--  <button type="button" class="btn btn-info" style="width: 150px;"><a data-toggle="modal" data-target="#add-new-event" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Add Leave </a></button> -->
                         <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url('TimeSheet/TimeSheet'); ?>" >Back</a> 
                       
                    
    
                    </div>
                </div>  
                <div class="row">
                    <div class="col-12">
          <!--               <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;  TimeSheet List  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>SNO</th>
                                                <th>Employee Name</th>
                                                <th>Month</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                      
                                        <tbody >
                              
 
                                 <?php 
                                        $i = 1;
    
                                   foreach($dailytimesheetdata as $value):
                                     $orderdate = explode('-', $value->timesheetmonth);
									 $month = $orderdate[0];
									 $year  = $orderdate[1];
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                        <td><?php echo date("F Y", strtotime($year."-".$month));?></td>
                                        <td><?php echo date("d F Y", strtotime($value->date));?></td>
                                     
                                   <td><a href="" title="Edit" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light dailytime " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                   	<a data-toggle="modal" data-target="#TimesheetDataModal" data-whatever="@getbootstrap" class="btn btn-sm btn-info waves-effect waves-light text-white AdditionDataModal timesheetbtn" data-id="<?php echo $value->id ?>" data-employee="<?php echo $value->emp_id ?>"><i class="fa fa-plus"></i></a></td>
                                    </tr>
                                    <?php $i++; endforeach;
                                    
                                ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                         <div class="col-md-12">
                            <div class="card-body b-l calender-sidebar">
                                <div id="calendar"></div>
                                
                            </div>
                           </div>
                    </div>
                </div>
                <?php 
                  if($this->input->get('id')){
                     $id = $this->input->get('id');
                     $monthlytimedata = $this->Timesheet_modal->Monthtimesheetvalue($id);
             
            }?>

            <?php 
             $sql = "SELECT * FROM `leave_types` WHERE `status`='1' ORDER BY `type_id` DESC";
                $query = $this->db->query($sql);
                $leavetypes = $query->result();
             ?>
                       <!-- Add Leave -->
                <div class="modal fade none-border" id="add-new-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add  Leave</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                              <form role="form" id="addleave" method="post">
                            <div class="modal-body">
                              
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Date</label><label class="error"> *</label>
                                            <input class="form-control form-white" placeholder="" type="date" name="startdate"id="startdate" required />
                                        </div>
                                        <div class="col-md-6">
                                          <label>Leave Type</label><label class="error"> *</label>
                                    <select class="form-control custom-select assignleave"  tabindex="1" name="punchdescription" id="punchdescription" required>
                                      <option value="">Select Here..</option> 
                                         <?php foreach($leavetypes as $value): ?>

                                        <option value="<?php echo $value->name //echo $value->type_id ?>"><?php echo $value->name ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="emp_id" value="<?php echo $monthlytimedata->emp_id; ?>">
                                  <!-- <input type="hidden" name="startdate"> -->
                                  <input type="hidden" name="month" value="<?php echo $monthlytimedata->month ?>">
                                  <input type="hidden" name="month_id" value="<?php echo $this->input->get('id'); ?>">
                                <button type="button" class="btn btn-primary save-category" id="save-category">Save</button>
                                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        
                 
                        <div class="modal fade" id="createtimesheetmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Add Timesheet</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="createtimesheetform" enctype="multipart/form-data">
                                    <div class="modal-body"><!-- action="Add_Holidays" -->
                                      
                                        <div class="form-group">
		                                    <label>Employee</label><label class="error"> *</label>
		                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emp_id" id="emp_id" required readonly>
		                                        <option value="">Select Employee</option>
		                                        <?php foreach($employee as $value): ?>
		                                        <option value="<?php echo $value->em_id ?>" <?php if($monthlytimedata->emp_id == $value->em_id) {echo "selected";}?>><?php echo $value->first_name.' '.$value->last_name?></option>
		                                        <?php endforeach; ?>
		                                    </select>
		                                </div>
		                               <div class="form-group">
		                                 <label>Month</label><label class="error"> *</label>
                                            <input type="text" name="timesheetmonth" id="timesheetmonth" class="form-control mydatetimepicker" placeholder="Month" value="<?php if($monthlytimedata->month){echo $monthlytimedata->month;} ?>" required readonly>
                                        
		                               </div>
                                               
                                         <div class="form-group">
		                                 <label>Date</label><label class="error"> *</label>
                                            <input type="text" name="date" id="date" class="form-control mydatetimepickerFull" placeholder="Date" required>
                                        
		                               </div>
                                                                       
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id" value="" class="form-control" id="sid">                                       
                                    <input type="hidden" name="month_id" value="<?php if($id){ echo $id;} ?>" class="form-control" id="month_id">                                       
                                        
                                        <button type="submit" class="btn btn-primary" id="add_dailytimesheet">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                     
                <!-- Time sheet Data -->
                 <!-- <div class="modal fade" id="TimesheetDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		        <div class="modal-dialog modal-lg">
		          <div class="modal-content">
		            <div class="modal-header float-right">
		              <h5>Timesheet Data</h5>
		              <div class="text-right">
		                <i data-dismiss="modal" aria-label="Close" class="fa fa-close closebtn "></i>
		              </div>
		            </div>
		                <form name="add_timesheetdetailsform" id="add_timesheetdetailsform" method="post"> 
		            <div class="modal-body">
		         
		                    <div class="table-responsive">  
		                         <table class="table table-bordered" id="dynamic_field">  
		                              <tr>  
		                                   <td><label>Name</label><span class="error"> *</span>
		                                   
                                            <select  name="punchname[]" class="form-control name_list" >
                                                <option value="">Select Option</option>
                                               
                                                <option value="login">Log In</option>
                                                <option value="breakin">Break In</option>
                                                <option value="breakout">Break Out</option>
                                                <option value="logout">Log Out</option>
                                            </select>
                                           </td> 
		                                   <td>  <label>Time</label><span class="error"> *</span>
									        <div class="input-group time timepicker1" id="">
									          <input class="form-control timepicker" type="text"  name="punchtime[]" /><span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
									        </div></td>
                                            <td><label>Description</label>
                                            <textarea type="text" name="punchdescription[]" rows="1" placeholder="Enter Description" class="form-control name_list"  /></textarea></td> 
		                                 
		                                
                                          <td><label></label><button type="button" name="add" id="add" class="btn btn-success mt-4">+</button></td>
		                              </tr>  
                                      <tr>
                                           
                                      </tr>
		                         </table>  
                               
		                        
		                    </div>  
		              
		             <div class="table-responsive">
		                
		              <table class="table table-bordered">
		              <thead>
		                <tr>
		                  <th scope="col">Sno</th>
		                  <th scope="col">Name</th>
		                  <th scope="col">Time</th>
                          <th scope="col">Description</th>
		                  <th scope="col">Action</th>
		                </tr>
		              </thead>
		              <tbody class="timesheettbl">
		             
		             
		              </tbody>
		            </table>
		 
		              </div>
		             
		            </div>
		            <div class="modal-footer">
		              <input type="hidden" name="daily_id">
		              <input type="hidden" name="emp_id" value="<?php echo $monthlytimedata->emp_id; ?>">
                      <input type="hidden" name="startdate">
                      <input type="hidden" name="month">
                      <input type="hidden" name="month_id" value="<?php echo $this->input->get('id'); ?>">
		              
		              <button type="button" class="btn btn-primary" id="add_Timesheetdata">Save </button>
		               <button type="button" class="btn btn-secondary closebtn " data-dismiss="modal">Close</button>
		            </div>
		             </form> 
		          </div>
		        </div>
            </div> -->  
            <div class="modal fade" id="TimesheetDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header float-right">
                      <h5>Add Timesheet Logs</h5>
                      <div class="text-right">
                        <i data-dismiss="modal" aria-label="Close" class="fa fa-close closebtn "></i>
                      </div>
                    </div>
                        <form name="add_timesheetdetailsform" id="add_timesheetdetailsform" method="post"> 
                    <div class="modal-body">
                 
                            <div class="table-responsive">  
                                 <table class="table table-bordered" id="dynamic_field">  
                                      <tr>  
                                           <td><label>Login</label><span class="error"> *</span>
                                            <div class="input-group time timepicker1" id="">
                                              <input class="form-control timepicker" type="text"  name="login" /><span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                            </div>
                                            
                                           </td>
                                            <td><label>Breakin</label><span class="error"> *</span>
                                                <div class="input-group time timepicker1" id="">
                                              <input class="form-control timepicker" type="text"  name="breakin" /><span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                            </div>
                                            
                                           </td> 
                                           <td>  <label>Breakout</label><span class="error"> *</span>
                                            <div class="input-group time timepicker1" id="">
                                              <input class="form-control timepicker" type="text"  name="breakout" /><span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                            </div></td>
                                            <td><label>Logout</label>
                                                <div class="input-group time timepicker1" id="">
                                              <input class="form-control timepicker" type="text"  name="logout" /><span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                            </div>
                                            </td> 
                                     
                                         <!--  <td><label></label><button type="button" name="add" id="add" class="btn btn-success mt-4">+</button></td> -->
                                      </tr>  
                                      <tr>
                                           
                                      </tr>
                                 </table>  
                               
                                
                            </div>  
                      
                     <div class="table-responsive">
                        
                      <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Sno</th>
                          <th scope="col">Login</th>
                          <th scope="col">Breakin</th>
                          <th scope="col">Breakout</th>
                          <th scope="col">Logout</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody class="timesheettbl">
                     
                     
                      </tbody>
                    </table>
         
                      </div>
                     
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="daily_id">
                      <input type="hidden" name="emp_id" value="<?php echo $monthlytimedata->emp_id; ?>">
                      <input type="hidden" name="startdate">
                      <input type="hidden" name="month">
                      <input type="hidden" name="month_id" value="<?php echo $this->input->get('id'); ?>">
                      
                      <button type="button" class="btn btn-primary" id="add_Timesheetbydate">Save </button>
                       <button type="button" class="btn btn-secondary closebtn " data-dismiss="modal">Close</button>
                    </div>
                     </form> 
                  </div>
                </div>
            </div>
        
            <!-- Time sheet import -->
                     <div class="modal fade" id="monthlytimesheetmodel1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1"> Timesheet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post"  id="importtimesheet" action="<?php echo base_url();?>TimeSheet/importFile" enctype="multipart/form-data">
                            <div class="modal-body"><!-- action="Add_Holidays" -->
                         
                          
                            <div class="form-group">
                                <label>Upload excel file : </label>
                              <input type="file" name="uploadFile" value="" />
                                
                            </div>
                          <!--   <div>
                                <h5>Instructions :</h5>
                                <p>punchname : (Login,Logout,Breakin,Breakout)</p>
                                <p>punchtime : use 24 hours format</p>
                                <p>punchdescription (optional)</p>
                                <p>startdate <span class="error"> *</p>
                            </div> -->
                           <!--  <span class="err"></span> -->
                           <h6 class=""> Sample :</h6><!-- assets/Timesheet.xlsx -->
                           <a  class="btn btn-info text-white" href="<?php echo base_url("assets/SampleTimsheet.xls");?>"  download>Download</a> 
                          <!--  <a  class="btn btn-info text-white" href="<?php echo base_url("TimeSheet/SampleTimesheet");?>"  >Download</a> -->
                        </div>
                        <div class="modal-footer">
                           <input type="hidden" name="daily_id">
                              <input type="hidden" name="emp_id" value="<?php echo $monthlytimedata->emp_id; ?>">
                               <input type="hidden" name="month" value="<?php echo $monthlytimedata->month ?>">
                              <input type="hidden" name="startdate">
                              <input type="hidden" name="month_id" value="<?php echo $this->input->get('id'); ?>">
                            
                            <button type="submit" class="btn btn-primary" id="add_monthlysheet1">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--  -->
    <script>

    //push data
             $(document).ready(function () {

                $(document).on('click', ".TimesheetModal", function (e) {
                  e.preventDefault(e);
                  var emp_id = $(this).attr('data-employee');
                  var dailyid = $(this).attr('data-id');
                 // $('#generatePayrollModal').modal('show');
               //  $('#importtimesheet').find('[name="emp_id"]').val(emp_id).end();
                 $('#importtimesheet').find('[name="daily_id"]').val(dailyid).end();

                   });
             });  
   
    $(document).ready(function() {
        $('.closebtn ').click(function(){
            $('.addfields').remove();
        })
    })
    //timesheet data
    	     
       $(document).ready(function(){  
            var i=1;  
            $('#add').click(function(){  /*  <?php foreach($timemasterselect as $value): ?><option value="<?php echo $value->id ?>" ><?php echo $value->typename?></option> <?php endforeach; ?>*/
                 i++;  
                 $('#dynamic_field').append('<tr id="row'+i+'" class="addfields"><td> <select  name="punchname[]" class="form-control name_list" ><option value="">Select Option</option>  <option value="login">Log In</option> <option value="breakin">Break In</option> <option value="breakout">Break Out</option> <option value="logout">Log Out</option>                                             </select></td><td> 									        <div class="input-group time timepicker1" id=""> <input class="form-control timepicker" type="text" name="punchtime[]" /><span class="input-group-addon"><span class="fa fa-clock-o"></span></span>									        </div></td>  <td><textarea type="text" name="punchdescription[]" rows="1" placeholder="Enter Description" class="form-control name_list"  /></textarea></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
            });  
            $(document).on('click', '.btn_remove', function(){  
                 var button_id = $(this).attr("id");   
                
                 $('#row'+button_id+'').remove();  
                  allowtotal();
            });
            //push data
             $(document).ready(function () {

	            $(document).on('click', ".AdditionDataModal", function (e) {
	              e.preventDefault(e);
	              var emp_id = $(this).attr('data-employee');
	              var dailyid = $(this).attr('data-id');
	             // $('#generatePayrollModal').modal('show');
	             $('#add_timesheetdetailsform').find('[name="emp_id"]').val(emp_id).end();
	             $('#add_timesheetdetailsform').find('[name="daily_id"]').val(dailyid).end();

	               });
             });  
            //save
            $('#add_Timesheetbydate').click(function(){  
              if($('[name="login"]').val() != '' || $('[name="breakin"]').val() != '' || $('[name="breakout"]').val() != '' || $('[name="logout"]').val() != ''   ){          
                 $.ajax({  
                      url:"<?php echo base_url("TimeSheet/Add_timesheet_details");?>",  
                      method:"POST",  
                      data:$('#add_timesheetdetailsform').serialize(),  
                      success:function(data)  
                      {  
                           var data = $.parseJSON(data);
                        if (data.status == 'success') {

                            $('#TimesheetDataModal').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#add_timesheetdetailsform')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 2000,
                                    position: 'top-right'
                                });
                                $('.addfields').remove();
                                 loadtimesheetdata();
                                     setTimeout(function(){
                                     location.reload(true);
                                    },2000);
                        } 
                      }  
                 });
                 } 
            });  
       });  /*  $('#add_Timesheetdata').click(function(){  
              if($('[name="punchname[]"]').val() != '' && $('[name="punchtime[]"]').val() != '' ){          
                 $.ajax({  
                      url:"<?php echo base_url("TimeSheet/Add_timesheet_details");?>",  
                      method:"POST",  
                      data:$('#add_timesheetdetailsform').serialize(),  
                      success:function(data)  
                      {  
                           var data = $.parseJSON(data);
                        if (data.status == 'success') {

                            $('#TimesheetDataModal').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#add_timesheetdetailsform')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 2000,
                                    position: 'top-right'
                                });
                                $('.addfields').remove();
                                 loadtimesheetdata();
                                     setTimeout(function(){
                                     location.reload(true);
                                    },2000);
                        } 
                      }  
                 });
                 } 
            });  
       });  */
       //get allowance
       function loadtimesheetdata(date){
        $(document).ready(function () {
        //$(document).on("click", '.timesheetbtn',function (event) {
        //event.preventDefault();
        //var emid = $(this).attr("data-employee");  
         //var daily_id = $(this).attr('data-id');
        
        var emid = '<?php echo $monthlytimedata->emp_id; ?>';
        if(emid != '' ){
        //&& daily_id != ''
        $.ajax({
          url: "Get_timesheet?emid="+emid+'&&date='+date,
          type:"GET",
          dataType:'',
          data:'data',          
          success: function(response) {
            // console.log(response);
            $('.timesheettbl').html(response);
           
          },
          error: function(response) {
            
          }
        });
      }
     // });
      });

      }
      loadtimesheetdata();
      //delete allowance
      $(document).ready(function () {
        $(document).on("click", '.delsheetdetails',function (event) {
        event.preventDefault();
        var id = $(this).attr("data-id");  
         var row = $(this).closest("tr");
        if(id != ''  ){
        $.ajax({
          url: '<?php echo base_url("TimeSheet/deletetimesheetdetails")?>',
          type:"POST",
          data: {id:id},          
          success: function(response) {
           //console.log(row);
           row.remove();

             $('#TimesheetDataModal').modal('hide');
             $(".modal-backdrop").remove();
            $.wnoty({
            type: 'success',
            message: "Deleted   Successfully",
            autohideDelay: 1000,
            position: 'top-right'
            });
              setTimeout(function(){
               location.reload(true);
              },2000);
          },
          error: function(response) {
            
          }
        });
      }
      });
      });


      $(document).ready(function () {

          $(document).on("change", '.allowamount',function () {
            allowtotal();
            });
      });

    
    </script>                        
    <script type="text/javascript">
        $(document).ready(function () {
            $(".dailytime").click(function (e) {
                e.preventDefault(e);
                // Get the record's ID via attribute  
                var iid = $(this).attr('data-id');
                $('#createtimesheetform').trigger("reset");
                $('#createtimesheetmodel').modal('show');
                $.ajax({
                    url: 'Dailytimesheetib?id=' + iid,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).done(function (response) {
                    
                    // Populate the form fields with the data returned from server
    				$('#createtimesheetform').find('[name="id"]').val(response.Dailytimesheetvalue.id).end();
                    $('#createtimesheetform').find('[name="emp_id"]').val(response.Dailytimesheetvalue.emp_id).end();
                    $('#createtimesheetform').find('[name="timesheetmonth"]').val(response.Dailytimesheetvalue.timesheetmonth).end();
                    $('#createtimesheetform').find('[name="date"]').val(response.Dailytimesheetvalue.date).end();
                 
    			});
            });
        });

    
    //timesheet
   $('.close , .btn-default').on('click',function(){
    $('#createtimesheetform')[0].reset();
     $('#sid').val('');
    });
    $(document).on('click','#add_dailytimesheet',function(){
    event.preventDefault();
    $("#createtimesheetform").valid();
    var emp_id=$('#emp_id').val();
    var month=$('#timesheetmonth').val();
    var date=$('#date').val();
   
     if( date !=''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("TimeSheet/Add_Dailytimesheet");?>',
    data: $("#createtimesheetform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#createtimesheetmodel').modal('hide');
    $(".modal-backdrop").remove();

    $('#createtimesheetform')[0].reset();
    $('#sid').val('');
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },2000);
    //  
    }else if(data.error) {
        $("#date").after(data.error);
        $('#date').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#date").next().remove(); 
          $('#createtimesheetform')[0].reset();
        
         },2000); 
    }
    },
    });
    }
    return false;
    })
</script>
                         
<?php $this->load->view('backend/footer'); ?>
<script>

   $(document).on("mouseenter ", '.timepicker1',function (event) {
    event.preventDefault();

    timepicker();

  });
    function timepicker() {
   $(".timepicker").datetimepicker({
	//format: "LT",
    format: "HH:mm",
	icons: {
	  up: "fa fa-chevron-up",
	  down: "fa fa-chevron-down"
	}
  });
    }
    timepicker();
  
</script>
<script>

//calender
 $(document).ready(function() {

  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
 //var today = new Date('2022-11-2');
    
  var emid = '<?php echo $monthlytimedata->emp_id; ?>';
  var month = '<?php echo $tmonth.'-'.$tyear; ?>';

  var calendar = $('#calendar').fullCalendar({

   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
   },
   defaultDate: moment('<?php echo $tyear.'-'.$tmonth; ?>'),
    
   events: '<?php echo base_url(); ?>TimeSheet/load?emid='+emid+'&&month='+month ,
  allDayDefault: false,
 
   eventRender: function(event, element, view) {
    // new
   /*new*/
    element.find('.fc-event-time').hide();
        element.find('.fc-time').hide();
    element.attr('data-id', event.dataid);
     // console.log(element)
     // console.log(view)
   if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   selectable: true,
   selectHelper: true,
   eventOrder: true,
    showNonCurrentDates: false, // Prevents rendering of dates from previous and next months in month view.

   select: function(start, end, allDay) {
   
    $('[name="startdate"]').val(start.format("YYYY-MM-DD"));
    $('[name="month"]').val(start.format("MM-YYYY"));
    $('#TimesheetDataModal').modal('show');  // modal show

    var date = start.format("YYYY-MM-DD");
    loadtimesheetdata(date);
  
   if (title) {
   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
   $.ajax({
       url: 'add_events.php',
       data: 'title='+ title+'&start='+ start +'&end='+ end,
       type: "POST",
       success: function(json) {
       alert('Added Successfully');
       }
   });
   calendar.fullCalendar('renderEvent',
   {
       title: title,
       start: start,
       end: end,
       allDay: allDay
   },
   true
   );
   }
   calendar.fullCalendar('unselect');
   },


   editable: true,
   eventDrop: function(event, delta) {
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
   $.ajax({
       url: 'update_events.php',
       data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
       type: "POST",
       success: function(json) {
        alert("Updated Successfully");
       }
   });
   },
   eventClick: function(event) {
/*    var decision = confirm("Do you really want to do that?"); 
    if (decision) {
    $.ajax({
        type: "POST",
        url: "delete_event.php",
        data: "&id=" + event.id,
         success: function(json) {
             $('#calendar').fullCalendar('removeEvents', event.id);
              alert("Updated Successfully");}
    });
    }*/
     var date = event.start.format("YYYY-MM-DD");
    loadtimesheetdata(date);
     $('#TimesheetDataModal').modal('show'); //modal show
    },
   eventResize: function(event) {
       var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
       var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
       $.ajax({
        url: 'update_events.php',
        data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
        type: "POST",
        success: function(json) {
         alert("Updated Successfully");
        }
       });
    },
    /**/
  
   
  });
  
  });

</script>
<script>
    //leave
     $(document).on('click','#save-category',function(){

        event.preventDefault();
        $("#addleave").valid();
        var emp_id=$('#emp_id').val();
        var punchdescription=$('#punchdescription').val();
        var startdate=$('#startdate').val();
       
         if( startdate !=''){
        $.ajax({
        type:'post',
        url: '<?php echo base_url("TimeSheet/Add_timesheetleave");?>',
        data: $("#addleave").serialize(),
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#add-new-event').modal('hide');
        $(".modal-backdrop").remove();

        $('#addleave')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 5000,
        position: 'top-right'

        });
        setTimeout(function(){
         location.reload(true);
        },3000);
        //  
        }else if(data.error) {
           /* $("#startdate").after(data.error);
            $('#startdate').next().css({'color':'red'});
            setTimeout(function(){ 
              $("#startdate").next().remove(); 
              $('#addleave')[0].reset();
            
             },2000); */
        }
        },
        });
        }
        return false;
        })
        //delete
    $(document).on('click','.leave_event_del', function (e) {
    $('#createtimesheetmodel').modal('hide');
    $(".modal-backdrop").remove();
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this timesheet ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('TimeSheet/TimsheetLeaveDelete') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
         location.reload(true);
        },3000);
     }
    } 
   });
    }
    },
    close: function () {
       location.reload(true); 
    }
    }
    });

    });

 
</script>