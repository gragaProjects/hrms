<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-hard-of-hearing" style="color:#1976d2"></i>Attendance</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li> -->
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>attendance/Save_Attendance" class="text-white"><i class="" aria-hidden="true"></i> Add Attendance </a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i><a href="#" class="text-white" data-toggle="modal" data-target="#Bulkmodal"><i class="" aria-hidden="true"></i>  Add Bulk Attendance</a></button>
                        <button type="button" class="btn btn-info"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>attendance/Attendance_Report" class="text-white"><i class="" aria-hidden="true"></i> Attendance Report </a></button>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row m-b-10"> 
                    <div class="col-12">
                        <!-- <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>attendance/Save_Attendance" class="text-white"><i class="" aria-hidden="true"></i> Add Attendance </a></button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i><a href="#" class="text-white" data-toggle="modal" data-target="#Bulkmodal"><i class="" aria-hidden="true"></i>  Add Bulk Attendance</a></button>
                        <button type="button" class="btn btn-info"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>attendance/Attendance_Report" class="text-white"><i class="" aria-hidden="true"></i> Attendance Report </a></button> -->
                    </div>
                </div>  
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Attendance List  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="attendance123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>PIN</th>
                                                <th>Date </th>
                                                <th>Sign In</th>
                                                <th>Sign Out</th>
                                                <th>Working Hour</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Employee Code</th>
                                                <th>Date </th>
                                                <th>Sign In</th>
                                                <th>Sign Out</th>
                                                <th>Working Hour</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($attendancelist as $value): ?>
                                            <tr>
                                                <td><mark><?php echo $value->name; ?></mark></td>
                                                <td><?php echo $value->emp_id; ?></td>
                                                <td><?php echo $value->atten_date; ?></td>
                                                <td><?php echo $value->signin_time; ?></td>
                                                <td><?php echo $value->signout_time; ?></td>
                                                <td><?php echo $value->Hours; ?></td>
                                                <td class="jsgrid-align-center ">
                                                <?php if($value->signout_time == '00:00:00') { ?>
                                                    <a href="Save_Attendance?A=<?php echo $value->id; ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light" data-value="Approve" >Sign Out</a><br>                           
                                                <?php } ?>
                                                    <a href="Save_Attendance?A=<?php echo $value->id; ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light" data-value="Approve" ><i class="fa fa-pencil-square-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<div id="Bulkmodal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
               <form method="post" action="import" id="importform" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <label style="font-weight:bold">Import Attendance</label>&nbsp;&nbsp; <label class="error">  *</label> &nbsp;Upload only CSV file<!-- <img src="<?php echo base_url(); ?>assets/images/finger.jpg" height="100px" width="100px">Upload only CSV file</span> -->
                 
                <input type="file" name="csv_file" id="csv_file" accept=".csv" required><br><br>
                   <!-- <a type="button" href="<?php base_url() ?>assets/SampleAttendance.csv" class="btn btn-primary waves-effect" id="" download>Download Sample </a>   -->
                   <!-- href="data:text/csv;" -->
                    <a  class="btn btn-primary " href="<?php echo base_url()?>assets/SampleAttendance.csv" download>Download Sample</a>                                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info " id="import_attend">Save</button>
                    <button type="button" class="btn btn-info " data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
                                </div>                             
<?php $this->load->view('backend/footer'); ?>
<script>
    $('#attendance123').DataTable({
        "aaSorting": [[2,'desc']],
        dom: 'Bfrtip',
        buttons: [
             {
                extend: 'copy'  ,
                exportOptions: {
                    columns: [ 0, 1, 2, 4,5 ]
                }
              }, 
               {
                extend: 'csv'  ,
                exportOptions: {
                    columns: [ 0, 1, 2, 4,5 ]
                }
              },
               {
                extend: 'excel'  ,
                exportOptions: {
                    columns: [ 0, 1, 2, 4,5 ]
                }
              },  'pdf',
              {
                extend: 'print'  ,
                exportOptions: {
                    columns: [ 0, 1, 2, 4,5 ]
                }
              } 
        ]
    });
  $(document).ready(function () {
    $(document).on('click', '#import_attend', function(e) {
    e.preventDefault();
     $("#importform").valid();
    var csv_file = $('#csv_file').val();
    
   if(csv_file != ''){
   $.ajax({
    type:'post',
    url: '<?php echo base_url("Attendance/import");?>',
    data: new FormData($("#importform")[0]),
    contentType: false,
    processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#Bulkmodal').modal('hide');
     $(".modal-backdrop").remove(); 
    $('#importform')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
         location.reload(true);
        },3000);
  
   }else if(data.error){
  
          $.wnoty({
                type: 'error',
                message: data.message,
                autohideDelay: 3000,
                position: 'top-right'

                });
    }else if(data.valid){
         $.wnoty({
                type: 'error',
                message: data.valid,
                autohideDelay: 3000,
                position: 'top-right'

                });
    }
    },
    });
    }
 
    return false;
    })
    })
     $('#sample').on('click', function () {
      $(this).attr('download');
    });
</script>