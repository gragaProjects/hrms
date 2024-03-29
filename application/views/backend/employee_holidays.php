<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<style type="text/css">
@media print {
  /* Hide the header and footer on all printed pages */
  @page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
  }

  /* Hide the header and footer elements on all printed pages */
  body {
    margin: 0;
    padding: 0;
  }

  /* Hide the header and footer elements on individual pages */
  .no-print {
    display: none !important;
  }

}
#calendar .fc-today-button {
     display: block; 
}
</style>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-calendar" style="color:#1976d2"></i> Holidays <?php //if($monthlytimedata->month){echo date("F Y", strtotime($tyear."-".$tmonth));}?>  </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                      <!--   <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> Holidays</li> -->
                                <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url('Employee/Employees'); ?>">Back</a> 
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">


                <div class="row m-b-10"> 
                    <div class="col-12">
                     
                      <!-- <a type="button" class="btn btn-info text-white "   id="print-btn" >Print</a>  -->
                         <!-- <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url('Employee/Employees'); ?>">Back</a>  -->
                       
                    
    
                    </div>
                </div>  
                <div class="row">
                    <div class="col-12">
      
                         <div class="col-md-12">
                            <div class="card-body b-l calender-sidebar">
                                <div id="calendar"></div>
                                
                            </div>
                           </div>
                    </div>
                </div>
                <?php 
                  if($this->input->get('id')){
                     $id = base64_decode($this->input->get('id'));
                    // $monthlytimedata = $this->Timesheet_modal->Monthtimesheetvalue($id); 
                 }
             
            ?>

            <?php 
            /* $sql = "SELECT * FROM `leave_types` WHERE `status`='1' ORDER BY `type_id` DESC";
                $query = $this->db->query($sql);
                $leavetypes = $query->result();*/
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
        
                 
                        <div class="modal fade" id="add_holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Add Holiday</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="createtimesheetform" enctype="multipart/form-data">
                                    <div class="modal-body"><!-- action="Add_Holidays" -->
                                      
                                       <div class="form-group">
		                                    <label>Employee</label><label class="error"> *</label>
		                                    <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emp_id" id="emp_id" required >
		                                        <option value="">Select Employee</option>
		                                        <?php foreach($employee as $value): ?>
		                                        <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name?></option>
		                                        <?php endforeach; ?>
		                                    </select>
		                                </div> 
		                            <!--    <div class="form-group">
		                                 <label>Month</label><label class="error"> *</label>
                                            <input type="text" name="timesheetmonth" id="timesheetmonth" class="form-control mydatetimepicker" placeholder="Month" value="" required readonly>
                                        
		                               </div> -->
                                               
                                         <div class="form-group">
		                                 <label>Date</label><label class="error"> *</label>
                                            <input type="text" name="date" id="date" class="form-control mydatetimepickerFull" placeholder="Date" required>
                                        
		                               </div>    

                                       <div class="form-group">
                                        <select class=" form-control custom-select" name="color">
                                          <option value="" disabled selected>Select a color</option>
                                          <option class="bg-primary text-white" value="primary">Blue</option>
                                          <option class="bg-secondary" value="secondary">Gray</option>
                                          <option class="bg-success" value="success">Green</option>
                                          <option class="bg-danger text-white" value="danger">Red</option>
                                          <option class="bg-warning" value="warning">Yellow</option>
                                          <option class="bg-info text-white" value="info">Cyan</option>
                                          <option class="bg-light" value="light">White</option>
                                          <option class="bg-dark text-white" value="dark">Black</option>
                                        </select>

                                        
                                       </div>


                                                                       
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="em_id" value="<?php //if($id){ echo $id;} ?>" class="form-control" id="sid">                                       
                                    <input type="hidden" name="month_id" value="<?php //if($id){ echo $id;} ?>" class="form-control" id="month_id">                                       
                                        
                                        <button type="submit" class="btn btn-primary" id="save_holiday">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>


        <!--  -->
    <script>

       //get allowance
       function loadtimesheetdata(date){
        $(document).ready(function () {
        //$(document).on("click", '.timesheetbtn',function (event) {
        //event.preventDefault();
        //var emid = $(this).attr("data-employee");  
         //var daily_id = $(this).attr('data-id');
        
        var emid = ''; 
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
    $(document).on('click','#save_holiday',function(){
    event.preventDefault();
    $("#createtimesheetform").valid();
    var emp_id=$('#emp_id').val();
   // var month=$('#timesheetmonth').val();
    var date=$('#date').val();
    var color=$('#color').val();
   
     if( emp_id != '' && date !=''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Employee/Add_HolidayList");?>',
    data: $("#createtimesheetform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#add_holiday').modal('hide');
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
   


  var myDate = localStorage.getItem('myDate');

  var calendar = $('#calendar').fullCalendar({

   editable: true,
   header: {
    left: 'today',
    center: 'title',
    right: 'prev,next '//month,agendaWeek,agendaDay
   },
   defaultDate: (myDate) ? myDate+ '-' + '01' : moment(),//myDate+'-1',

    
   events: '<?php echo base_url(); ?>Employee/load',//?emid='+emid+'&&month='+month'
  allDayDefault: false,

  
   eventRender: function(event, element, view) {

  //new
    element.find('.fc-event-time').hide();
    element.find('.fc-time').hide();
    element.attr('data-id', event.dataid);
  
   if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
    selectable: true,
   selectHelper: true,
   eventOrder: true,


   select: function(start, end, allDay) {
   
    $('[name="date"]').val(start.format("YYYY-MM-DD"));
   // $('[name="month"]').val(start.format("MM-YYYY"));

    <?php $eid = $this->session->userdata('user_login_id');
    $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
    if($get_hr_approve){
    ?>
    $('#add_holiday').modal('show');  // modal show
   <?php } ?>

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

  });


   
  });
 //set dates
  $(document).ready(function() {
  $('.fc-prev-button, .fc-next-button .fc-today-button').on('click', function() {
    // alert($('div.fc-toolbar > div.fc-center > h2').text());
    var dateString = $('div.fc-toolbar > div.fc-center > h2').text();
    var date = new Date(dateString);
    var year = date.getFullYear();
    var month = date.getMonth() + 1; 
    var formattedDate = year + '-' + (month < 10 ? '0' : '') + month;
    localStorage.setItem('myDate', formattedDate);
   }); 
  $('.fc-button').on('click', function() {
     //alert($('div.fc-toolbar > div.fc-center > h2').text());
    var dateString = $('div.fc-toolbar > div.fc-center > h2').text();
    var date = new Date(dateString);
    var year = date.getFullYear();
    var month = date.getMonth() + 1; 
    var formattedDate = year + '-' + (month < 10 ? '0' : '') + month;
    localStorage.setItem('myDate', formattedDate);
   });
  });



</script>
<script>
    <?php if($get_hr_approve){
    ?>
    //delete
    $(document).on('click','.leave_event_del', function (e) {
    $('#createtimesheetmodel').modal('hide');
    $(".modal-backdrop").remove();
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this holiday list ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Employee/HolidayListDelete') ?>',
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

<?php } ?>

  
  /*   // Bind a click event to the print button
  $('#print-btn').click(function() {
    setTimeout(function(){
   html2canvas(document.querySelector('#calendar')).then(function(canvas) {
      // Create a new window to display the image
      var win = window.open();
      win.document.write('<img src="' + canvas.toDataURL() + '" style="width:100%;">');
      win.print();
      win.close();
    });


  },1000);
  });*/
/* $(document).ready(function() {
  $('#print-btn').click(function() {
  // Delay the execution of html2canvas by 2 seconds to ensure that the calendar is fully loaded
  setTimeout(function() {
    html2canvas(document.querySelector('#calendar')).then(function(canvas) {
      // Create a new window to display the image
      var win = window.open();
      win.document.write('<img src="' + canvas.toDataURL() + '" style="width:100%;">');
      win.print();
      win.close();
    });
  }, 2000);
});
});*/

    

</script>