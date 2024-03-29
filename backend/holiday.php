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

    .table{
    margin-bottom:0px!important;
}
</style>
        <?php 
        $id = base64_decode($this->input->get('id'));
        $sql = "SELECT * FROM `holidaystructure` WHERE `id`='$id'";
        $query = $this->db->query($sql);
        $result = $query->row();
        ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-bullhorn" style="color:#1976d2"></i> <?= $result->holidaystructure?> Based Holidays</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Holiday</li> -->
                        <?php if($this->role->User_Permission('holiday','can_add')){?>
                        <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#holysmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Holiday </a></button>
                          <?php } ?>
                         <a href="<?php echo base_url(); ?>leave/HolidayStructure" class="btn btn-info text-white" ><i class="fa fa-bars"></i> Back</a>
                  
                      
                        <input type="hidden" name="sid" id="sid" value="<?= base64_decode($this->input->get('id')); ?>">
                    </div>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">


                <div class="row m-b-10"> 
                    <div class="col-12">
                 
                </div>  
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Holidays List  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="holdaytable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.NO</th>
                                                <th>Holiday's Name</th>
                                                <th>From </th>
                                                <th>To </th>
                                                <th>No. Of days</th>
                                                <th>Year</th>
                                                <?php if($this->role->User_Permission('holiday','can_edit') || $this->role->User_Permission('holiday','can_delete')){?>
                                                <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                    
                                        <tbody id="holidaytbl">
                                        <?php 
                                       
                                         $i = 1;
                                       foreach($holidays as $value): ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $value->holiday_name ?></td>
                                            <td><?php echo date('jS \of F Y',strtotime($value->from_date)); ?></td>
                                            <td><?php if(!empty($value->to_date)){ echo date('jS \of F Y',strtotime($value->to_date)); } ?></td>
                                            <td><?php echo $value->number_of_days; ?></td>
                                            <td><?php echo $value->year; ?></td>
                                             <?php if($this->role->User_Permission('holiday','can_edit') || $this->role->User_Permission('holiday','can_delete')){?>
                                            <td class="jsgrid-align-center ">
                                                    <?php if($this->role->User_Permission('holiday','can_edit') ){?>
                                                <a href="" title="Edit"  class="btn btn-sm btn-info waves-effect waves-light holiday" data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                    <?php } if( $this->role->User_Permission('holiday','can_delete')){?>
                                                <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light holidelet" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button>
                                                <?php } ?>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php $i++;
                                    endforeach; 
                                         ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="modal fade" id="holysmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Holidays</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="holidayform" enctype="multipart/form-data">
                                    <div class="modal-body"><!-- action="Add_Holidays" -->
                                        
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input type="text" name="holiname" class="form-control" id="holiname"  value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"> From </label>
                                                <input type="text" name="startdate" class="form-control datetimepickerFull" id="startdate"  value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">To</label>
                                                <input type="text" name="enddate" class="form-control datetimepickerFull" id="enddate" value="" required>
                                            </div>                                        
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id" value="" class="form-control" id="holyid">                                       
                                    <input type="hidden" name="structureid" value="<?php echo base64_decode($this->input->get('id'));?>" class="form-control" id="structureid">  
                                    <button type="submit" class="btn btn-primary" id="add_holiday">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                
<script type="text/javascript">

    $(function() {
        $('.datetimepickerFull').datepicker({
        format: "yyyy-mm-dd",
       // endDate: "today"
        });
        });
  
 /*     "scrollY": "50vh",
        "scrollCollapse": true,
        "pageLength": 20,
         "ordering": false,*/

    $(document).ready(function () {
        $(".holiday").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#holidayform').trigger("reset");
            $('#holysmodel').modal('show');
            $.ajax({
                url: 'Holidaybyib?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                console.log(response);
                // Populate the form fields with the data returned from server
				$('#holidayform').find('[name="id"]').val(response.holidayvalue.id).end();
                $('#holidayform').find('[name="holiname"]').val(response.holidayvalue.holiday_name).end();
                $('#holidayform').find('[name="startdate"]').val(response.holidayvalue.from_date).end();
                $('#holidayform').find('[name="enddate"]').val(response.holidayvalue.to_date).end();
                $('#holidayform').find('[name="nofdate"]').val(response.holidayvalue.number_of_days).end();
                $('#holidayform').find('[name="year"]').val(response.holidayvalue.year).end();
                $('#holidayform').find('[name="structureid"]').val(response.holidayvalue.structureid).end();
			});
        });
    });
     //holiday
    $('.close , .btn-default').on('click',function(){
    $('#holidayform')[0].reset();
     $('#holyid').val('');
    });
     $(document).on('click','#add_holiday',function(){
    event.preventDefault();
     $("#holidayform").valid();
    var holiname=$('#holiname').val();
    var startdate=$('#startdate').val();
    var enddate=$('#enddate').val();
     if(enddate !='' && startdate !='' && holiname !=''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/Add_Holidays");?>',
    data: $("#holidayform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#holysmodel').modal('hide');
    $(".modal-backdrop").remove();
  
    //var country = $('#city_name').val();
   // $("#state").append("<option value="+data.state_success+">" + country + "</option>");
    $('#holidayform')[0].reset();
    $('#holyid').val('');
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
    } 
    },
    });
    }
    return false;
    })

        //delete
    $(document).on('click','.holidelet', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this holiday?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Leave/HolidayDelete') ?>',
    data: {id:id},
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
</script>
                          
<?php $this->load->view('backend/footer'); ?>
<script>
      $('#holdaytable').DataTable({
   "scrollY": "50vh",
    "scrollCollapse": true,
    "pageLength": 50,
     "ordering": false,
    "searching": false,
    "lengthChange": false
    });
</script>