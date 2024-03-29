<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<style>
.fc-fri {
background-color: #FFEB3B;
}
.fc-event, .fc-event-dot {
background-color: #FF5722;
}
.fc-event {
border: 0;
}
.fc-day-grid-event {
margin: 0;
padding: 0;
}
.dayWithEvent {
background: #FFEB3B;
cursor: pointer;
}

</style>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-calendar" style="color:#1976d2"></i> Monthly TimeSheet</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Monthly TimeSheet</li> -->
                <?php if($this->role->User_Permission('generate_timesheet','can_view')  && $this->role->User_Permission('generate_timesheet','can_add')){?>
                <button type="button" class="btn btn-info" style="width: ;"><a data-toggle="modal" data-target="#monthlytimesheetmodel" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Create  Timesheet </a></button>

               <a data-toggle="modal" data-target="#monthlytimesheetmodel1" data-whatever="@getbootstrap" class="btn btn-info TimesheetModal text-white">Bulk Import  Timesheet </a>
                
                <?php } else{ ?>
                      <button type="button" class="btn btn-info" style="width: ;"><a data-toggle="modal" data-target="#monthlytimesheetmodel" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Create  Timesheet </a></button>
                <?php }  ?>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
             
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Monthly TimeSheet List  </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Employee Name</th>
                                        
                                        <th>Month</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody >
                                    
                                    <?php
                                if($this->role->User_Permission('generate_timesheet','can_view') && $this->role->User_Permission('generate_timesheet','can_delete') && $this->role->User_Permission('generate_timesheet','can_add') && $this->role->User_Permission('generate_timesheet','can_edit')){
                                    $i = 1;
                                    
                                    foreach($monthlytimesheetdata as $value):
                                    $orderdate = explode('-', $value->month);
                                    $month = $orderdate[0];
                                    $year  = $orderdate[1];
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                        <td><?php echo date("F Y", strtotime($year."-".$month));?></td>
                                        <!-- monthlytimesheet -->
                                        <td>
                                            <?php if($this->role->User_Permission('generate_timesheet','can_edit')){?>
                                            <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light monthlytime " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <a href="<?php echo base_url(); ?>TimeSheet/CreateTimesheet?id=<?php echo $value->id;  ?>&em_id=<?php echo $value->em_id;  ?>" title="View" class="btn btn-sm btn-info waves-effect waves-light  " ><i class="fa fa-eye"></i></a>
                                             <?php if($this->role->User_Permission('generate_timesheet','can_delete')   ){?>
                                              <button   title="Delete"class="btn btn-sm btn-info waves-effect waves-light deltimesheet" data-id="<?php echo $value->id; ?>"data-month="<?php echo $value->month; ?>" data-emp="<?php echo $value->emp_id; ?>"><i class="fa fa-trash-o"></i></button> 
                                               <?php } ?>
                                               </td>
                                        </tr>
                                        <?php $i++; endforeach;
                                        }elseif ($this->role->User_Permission('generate_timesheet','can_view')) {
                                    //EmpMonthlyTimesheet($id)

                                    $id = $this->session->userdata('user_login_id');
                                    $emp_timesheet = $this->Timesheet_modal->EmpMonthlyTimesheet($id);
                                    
                                    $j = 1;
                                    
                                    foreach($emp_timesheet as $value):
                                    $orderdate = explode('-', $value->month);
                                    $month = $orderdate[0];
                                    $year  = $orderdate[1];
                                    ?>
                                    <tr>
                                        <td><?php echo $j ?></td>
                                        <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                        <td><?php echo date("F Y", strtotime($year."-".$month));?></td>
                                        <!-- monthlytimesheet -->
                                        <td>
                                            <?php if($this->role->User_Permission('generate_timesheet','can_edit')){?>
                                            <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light monthlytime " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <a href="<?php echo base_url(); ?>TimeSheet/CreateTimesheet?id=<?php echo $value->id;  ?>" title="View" class="btn btn-sm btn-info waves-effect waves-light  " ><i class="fa fa-eye"></i></a>
                                             <?php if($this->role->User_Permission('generate_timesheet','can_delete')   ){?>
                                              <button   title="Delete"class="btn btn-sm btn-info waves-effect waves-light deltimesheet" data-id="<?php echo $value->id; ?>" data-month="<?php echo $value->month; ?>" data-emp="<?php echo $value->emp_id; ?>"><i class="fa fa-trash-o"></i></button> 
                                               <?php } ?>
                                               </td>
                                        </tr>
                                    <?php $j++; endforeach; } ?>
                                    </tbody>        
                             
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($this->role->User_Permission('generate_timesheet','can_view')  && $this->role->User_Permission('generate_timesheet','can_add')){?>
            <div class="modal fade" id="monthlytimesheetmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Create Timesheet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post"  id="monthlytimesheet" enctype="multipart/form-data">
                            <div class="modal-body"><!-- action="Add_Holidays" -->
                            <div class="form-group  ">

                              <label class="">Business Unit</label><span class="error"> </span>
                              <select name="busunit" id="busunit"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;"  >
                                <option  value="">Select Business Unit</option>
                                <?Php foreach($businessunitvalue as $value): ?>
                                <option value="<?php echo $value->id ?>"> <?php echo $value->name ?></option>
                                <?php endforeach; ?>
                              </select>
                              <span class="">(Select Businessunit or Employee) </span>
                              <label id="" class="error" for="busunit" style="display: none;">This field is required.</label>
                            </div>
                            <div class="form-group">
                                <label>Employee</label><label class="error"> </label>
                                <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emp_id" id="emp_id" >
                                    <option value="">Select Employee</option>
                                    <?php foreach($employee as $value): ?>
                                    <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" name="month" id="month" class="form-control mydatetimepicker" placeholder="Month" required>
                                
                            </div>
                            
                            <span class="errmonth"></span>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="" class="form-control" id="sid">
                            
                            <button type="submit" class="btn btn-primary" id="add_monthlysheet">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                        <form method="post"  id="importtimesheet" action="<?php echo base_url();?>TimeSheet/BulkImportTimesheet" enctype="multipart/form-data">
                            <div class="modal-body"><!-- action="Add_Holidays" -->
                         
                          
                            <div class="form-group ">
                                <label>Upload excel file : </label>
                              <input type="file" name="uploadFile" value="" />
                                
                            </div>

                   
                           <h6 class="">Bulk Excel Sample :</h6>

                            <div class="form-group ">
                            <label class="">Business Unit</label><span class=""> (Select Businessunit and Click Download Button) </span>
                              <select name="busunit" id="busunitid"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;"  >
                                <option  value="">Select Business Unit</option>
                                <?Php foreach($businessunitvalue as $value): ?>
                                <option value="<?php echo $value->id ?>"> <?php echo $value->name ?></option>
                                <?php endforeach; ?>
                              </select>
                            
                              <label id="" class="error" for="busunit" style="display: none;">This field is required.</label>
                            </div>
                              

                           <!-- <a  class="btn btn-info text-white" href="<?php echo base_url("assets/SampleTimsheet.xls");?>"  download>Download</a>  -->
                          <a  class="btn btn-info text-white download"  id="busunit_button" disabled>Download</a> 
                          <!-- href="<?php echo base_url("TimeSheet/SampleBulksTimesheet");?>"  -->
                        </div>
                        <div class="modal-footer">
                           <input type="hidden" name="daily_id">
                             <!--  <input type="hidden" name="emp_id" value="<?php echo $monthlytimedata->emp_id; ?>">
                               <input type="hidden" name="month" value="<?php echo $monthlytimedata->month ?>"> -->
                              <input type="hidden" name="startdate">
                              <!-- <input type="hidden" name="month_id" value="<?php echo $this->input->get('id'); ?>"> -->
                            
                            <button type="submit" class="btn btn-primary" id="add_monthlysheet1">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--  -->
           <?php } if( $this->role->User_Permission('generate_timesheet','can_view')  ){
         
         $id = $this->session->userdata('user_login_id');
          $basicinfo = $this->employee_model->GetBasic($id);
        ?>   
         <div class="modal fade" id="monthlytimesheetmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel1">Create Timesheet</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post"  id="monthlytimesheet" enctype="multipart/form-data">
                            <div class="modal-body"><!-- action="Add_Holidays" -->
                         <!--    <div class="form-group  ">
                              <label class="">Business Unit</label><span class="error"> </span>
                              <select name="busunit" id="busunit"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" data-placeholder="Select Business Unit" >
                                <option hidden>Select Business Unit</option>
                                <?Php foreach($businessunitvalue as $value): ?>
                                <option value="<?php echo $value->id ?>"> <?php echo $value->name ?></option>
                                <?php endforeach; ?>
                              </select>
                              <label id="" class="error" for="busunit" style="display: none;">This field is required.</label>
                                        </div> -->
                            <div class="form-group">
                                <label>Employee</label><label class="error"> </label>
                                <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emp_id" id="emp_id" required>
                                         <option value="<?php echo $basicinfo->em_id ?>" selected><?php echo $basicinfo->first_name.' '.$basicinfo->last_name?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" name="month" id="month" class="form-control mydatetimepicker" placeholder="Month" required>
                                
                            </div>
                            
                            <span class="errmonth"></span>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="" class="form-control" id="sid">
                            
                            <button type="submit" class="btn btn-primary" id="add_monthlysheet">Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
        <script>
        
        </script>
        <script type="text/javascript">
        $(document).ready(function () {
        $(".monthlytime").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute
        var iid = $(this).attr('data-id');
        $('#monthlytimesheet').trigger("reset");
        $('#monthlytimesheetmodel').modal('show');
        $.ajax({
        url: 'Monthtimesheetib?id=' + iid,
        method: 'GET',
        data: '',
        dataType: 'json',
        }).done(function (response) {
        
        // Populate the form fields with the data returned from server
                        $('#monthlytimesheet').find('[name="id"]').val(response.Monthtimesheetvalue.id).end();
        $('#monthlytimesheet').find('[name="emp_id"]').val(response.Monthtimesheetvalue.emp_id).end();
        $('#monthlytimesheet').find('[name="month"]').val(response.Monthtimesheetvalue.month).end();
        
                    });
        });
        });
        //timesheet
        $('.close , .btn-default').on('click',function(){
        $('#monthlytimesheet')[0].reset();
        $('#sid').val('');
        });
        $(document).on('click','#add_monthlysheet',function(){
        event.preventDefault();
        $("#monthlytimesheet").valid();
        var emp_id=$('#emp_id').val();
        var month=$('#month').val();
       if (emp_id === '' && $('#busunit').val() === '') {
            alert("Please select Business unit or employee");
            return;
        }

        if( month !=''){
        $.ajax({
        type:'post',
        url: '<?php echo base_url("TimeSheet/Add_Monthtimesheet");?>',
        data: $("#monthlytimesheet").serialize(),
        success:function(resp){
        var data=$.parseJSON(resp);;
        if(data.status == 'success'){
        $('#monthlytimesheetmodel').modal('hide');
        $(".modal-backdrop").remove();
        $('#monthlytimesheet')[0].reset();
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
        }else if(data.status == 'error'){
        $('#monthlytimesheetmodel').modal('hide');
        $(".modal-backdrop").remove();
        $('#monthlytimesheet')[0].reset();
        $('#sid').val('');
        $.wnoty({
        type: 'error',
        message: data.message,
        autohideDelay: 1000,
        position: 'top-right'
        });
        
        
        setTimeout(function(){
        location.reload(true);
        },2000);
        }else if(data.error){

       $('.errmonth').html(data.error).css({'color':'red'});
        setTimeout(function(){
         
         $('.errmonth').remove();
        
        },4000); 
        }
        },
        });
        }
        return false;
        })
   //delete timehseet
    $(document).on('click','.deltimesheet', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    var month = $(this).attr('data-month');
    var emp = $(this).attr('data-emp');
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
    url: '<?php echo base_url('TimeSheet/Monthlytimesheetdelete') ?>',
    data: {id:id,month:month,emp:emp},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
    setTimeout(function(){
         location.reload(true);
        },2000);
     }
    } 
   });
    }
    },
    close: function () {
    }
    }
    });

    });  

   //Bulk time sheet
        $(document).ready(function() {
        // Listen for changes in the busunit dropdown
        $("#busunitid").on("change", function() {
            var selectedBusunit = $(this).val();
            
            // Check if a busunit is selected
            if (selectedBusunit !== '') {
                // Enable the Download button
                //$(".download").prop("disabled", false);
                 // Enable the busunit_button
                $("#busunit_button").prop("disabled", false);
                
                // Create the URL with the selected busunit value
                var downloadUrl = "<?php echo base_url('TimeSheet/SampleBulksTimesheet/');?>" + selectedBusunit;
                
                // Update the href attribute of the Download button
                $("#busunit_button").attr("href", downloadUrl);
            } else {
                // If no busunit is selected, disable the Download button
                $(".download").prop("disabled", true);
            }
        });
    });  
        </script>
      
        <?php $this->load->view('backend/footer'); ?>