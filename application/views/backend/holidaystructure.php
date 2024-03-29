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
.hiddenRow {
padding: 0 !important;
}
</style>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-bullhorn" style="color:#1976d2"></i> Holiday Structure</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Holiday Structure</li> -->
                   <?php if($this->role->User_Permission('holiday','can_add')){?>
                <button type="button" class="btn btn-info" ><a data-toggle="modal" data-target="#holystrucmodel" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Add Holiday Structure </a></button>
                
                
                <?php } ?>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <?php if($this->role->User_Permission('holiday','can_add')){?>
                <!-- <button type="button" class="btn btn-info" ><a data-toggle="modal" data-target="#holystrucmodel" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Add Holiday Structure </a></button> -->
                
                
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Holiday Structure List  </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="examplesearch" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th>S.NO</th>
                                        <th>Name</th>
                                        <?php if($this->role->User_Permission('holiday','can_edit')){?>
                                        <th>Status</th>
                                        <?php }; ?>
                                        <?php if($this->role->User_Permission('holiday','can_edit')|| $this->role->User_Permission('holiday','can_view')){?>
                                        <th>Action</th>
                                        <?php }; ?>
                                    </tr>
                                </thead>
                                
                                <tbody id="holidaystructbl">
                                    <?php
                                    $i = 1;
                                    
                                    foreach($holidaystruc as $value): ?>
                                    <tr >
                                        <!--  <td><button class="btn btn-default btn-xs" data-toggle="collapse" data-target="#demo<?php echo $i ?>" class="accordion-toggle"><span class="fa fa-eye"></span></button></td> -->
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->holidaystructure ?></td>
                                        <?php if($this->role->User_Permission('holiday','can_edit')){?>
                                            <!-- new -->
                                       <td>
                                            <div class="">
                                                <!-- Add unique IDs and values to your checkboxes -->
                                                <?php if($value->Active_status == "1"){ ?>
                                                <input type="checkbox" class="js-switch on" id="" data-color="#28a745" data-secondary-color="#f62d51" checked data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff'  />
                                                  <?php }elseif ($value->Active_status == "0"){ ?>
                                                      <input type="checkbox" class="js-switch off" id="" data-color="#28a745" data-secondary-color="#f62d51"  data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff' />
                                                <?php }; ?>
                                           
                                            </div>
                                            </td>
                                            <!-- button -->
                                     <!--    <td>
                                            <?php
                                            if($value->Active_status == "1"){ ?>
                                            <button type="button" class="btn btn-primary" id="inactive" value="<?php echo $value->Active_status; ?>" data-id="<?php echo $value->id; ?>" name="inactive" >INACTIVE</button><?php
                                            }elseif ($value->Active_status == "0"){ ?>
                                            <button type="button" class="btn btn-info" id="active" value="<?php echo $value->Active_status; ?>" data-id="<?php echo $value->id; ?>" name="active">ACTIVE</button><?php
                                            }?>
                                            
                                        </td> -->
                                        <?php }; ?>
                                        <td class="jsgrid-align-center ">
                                            <?php if($value->Active_status == "1"){?>
                                            <?php if($this->role->User_Permission('holiday','can_edit')){?>
                                            <a href="" title="Edit"  class="btn btn-sm btn-info waves-effect waves-light holiday " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php }; ?>
                                            <?php if($this->role->User_Permission('holiday','can_add')){?>
                                            <a href="" data-toggle="modal" data-target="#holysmodel" data-whatever="@getbootstrap"  title="Add Holiday"  class="btn btn-sm btn-info waves-effect waves-light holidaymodal " data-id="<?php echo $value->id; ?>"><i class="fa fa-plus"></i></a>
                                            <?php }; ?>
                                            <?php if($this->role->User_Permission('holiday','can_view')){?>
                                            <!--  href="<?php echo base_url(); ?>leave/Holidays?id=<?php echo base64_encode($value->id)?>" -->
                                            <a title="View"  class="btn btn-sm btn-info waves-effect waves-light  accordion-toggle text-white" data-toggle="collapse" data-target="#demo<?php echo $i ?>"  data-id="<?php echo $value->id; ?>"><i class="fa fa-eye"></i></a>
                                              <?php } if( $this->role->User_Permission('holiday','can_delete')){?>
                                                            <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light strucdel" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button>
                                                            <?php } 

                                             }; ?>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <?php
                                    $id =  $value->id;
                                    $holidays =  $this->leave_model->GetAllHoliInfo($id);
                                    ?>
                                    <tr>
                                        <td colspan="12" class="hiddenRow">
                                            <div class="accordian-body collapse" id="demo<?php echo $i ?>">
                                                <table class="display nowrap table table-hover table-striped table-bordered">
                                                    <thead class="card-header" >
                                                        <tr class="info" style="background: #1976d2; color :white;">
                                                            <th>S.NO</th>
                                                            <th>Holiday's Name</th>
                                                            <th>From </th>
                                                            <th>To </th>
                                                            <th>Total Days</th>
                                                            <th>Year</th>
                                                            <?php if($this->role->User_Permission('holiday','can_edit') || $this->role->User_Permission('holiday','can_delete')){?>
                                                            <th>Action</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <?php
                                                        
                                                        $j = 1;
                                                        foreach($holidays as $value): ?>
                                                        <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo"><!-- <?php echo $i ?> -->
                                                        <td><?php echo $j ?></td>
                                                        <td><?php echo $value->holiday_name; ?><?php if($value->restricted == 1) { echo' <span class=" text-white" style="background:#28a745">  Restricted</span>'; } ?> </td>
                                                        <td><?php echo date('d M Y',strtotime($value->from_date)); ?></td>
                                                        <td><?php if(!empty($value->to_date)){ echo date('d M Y',strtotime($value->to_date)); } ?></td>
                                                         <td><?php echo $value->number_of_days; ?></td>
                                                        <td><?php echo date('M Y',strtotime($value->year)); ?></td>
                                                        <?php if($this->role->User_Permission('holiday','can_edit') || $this->role->User_Permission('holiday','can_delete')){?>
                                                        <td class="jsgrid-align-center ">
                                                            <?php if($this->role->User_Permission('holiday','can_edit') ){?>
                                                            <a href="" title="Edit"  class="btn btn-sm btn-info waves-effect waves-light holidayedit" data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                            <?php } if( $this->role->User_Permission('holiday','can_delete')){?>
                                                            <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light holidelet" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button>
                                                            <?php } ?>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php $j++;
                                                    endforeach;
                                                    ?>
                                                    
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <!--  -->
                                
                                <?php $i++; endforeach;
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="holystrucmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Holidays Structure</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post"  id="holidaystrucform" enctype="multipart/form-data">
                    <div class="modal-body"><!-- action="Add_Holidays" -->
                    
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="holidaystructure" class="form-control" id="holidaystructure" minlength="4" maxlength="25"  required>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="" class="form-control" id="sid">
                    
                    <button type="submit" class="btn btn-primary" id="add_holidaystruc">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
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
                 <div class="form-group " >
                            <label class="control-label text-left hidden" >Is this a restricted holiday?</label>
                            
                            <input name="restricted" type="radio" id="radio_3" data-value="1" class="" value="1"  >
                            <label for="radio_3" >Yes</label>
                            <input name="restricted" type="radio" id="radio_4" data-value="0" class="type " value="0" checked="checked">
                            <label for="radio_4" >No</label>
                            
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
<script>

</script>
<script type="text/javascript">
$(document).ready(function () {
$(".holiday").click(function (e) {
e.preventDefault(e);
// Get the record's ID via attribute
var iid = $(this).attr('data-id');
$('#holidayform').trigger("reset");
$('#holystrucmodel').modal('show');
$.ajax({
url: 'Holystrucbyib?id=' + iid,
method: 'GET',
data: '',
dataType: 'json',
}).done(function (response) {

// Populate the form fields with the data returned from server
$('#holidaystrucform').find('[name="id"]').val(response.holidaystrucvalue.id).end();
$('#holidaystrucform').find('[name="holidaystructure"]').val(response.holidaystrucvalue.holidaystructure).end();

});
});
});
//fetch data
/*    function showHolidays(){
var url = '<?php echo base_url(); ?>';
$.ajax({
type: 'POST',
url: url + 'Leave/fetch_holidaystructure',
success:function(response){
$('#holidaystructbl').html(response);


}
});
}
showHolidays();*/
//holiday
$('.close , .btn-default').on('click',function(){
$('#holidaystrucform')[0].reset();
$('#sid').val('');
});
$(document).on('click','#add_holidaystruc',function(){
event.preventDefault();
$("#holidaystrucform").valid();
var holidaystructure=$('#holidaystructure').val();

if( holidaystructure !=''){
$.ajax({
type:'post',
url: '<?php echo base_url("Leave/Add_Holystructure");?>',
data: $("#holidaystrucform").serialize(),
success:function(resp){
var data=$.parseJSON(resp);;
if(data.status == 'success'){
$('#holystrucmodel').modal('hide');
$(".modal-backdrop").remove();

$('#holidaystrucform')[0].reset();
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
}else if(data.error){

  $("#holidaystructure").after(data.error);
$('#holidaystructure').next().css({'color':'red'});
//$('#holystrucmodel').modal('hide');
//$(".modal-backdrop").remove();

$('#holidaystrucform')[0].reset();
setTimeout(function(){
$("#holidaystructure").next().remove();
$('#holidaystructure').next().css();   
},3000)
 
}
},
});
}
return false;
})
</script>
<script>
//holiday
$(document).ready(function () {
$(".holidayedit").click(function (e) {
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
    $('#holidayform').find('input:radio[name="restricted"][value='+response.holidayvalue.restricted+']').prop('checked', true);
});
});
});
//Holiday add and edit
$(function() {
$('.datetimepickerFull').datepicker({
format: "yyyy-mm-dd",
// endDate: "today"
});
});
//holidaymodal
$(document).ready(function () {
$(".holidaymodal").click(function (e) {
e.preventDefault(e);
// Get the record's ID via attribute
var iid = $(this).attr('data-id');

$('#holidayform').find('[name="structureid"]').val(iid).end();

});
});
//holiday
/* $('.close , .btn-default').on('click',function(){
$('#holidayform')[0].reset();
$('#holyid').val('');
});*/
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
autohideDelay: 1000,
position: 'top-right'
});

setTimeout(function(){
location.reload(true);
},2000);


}else if(data.error){

  $("#holiname").after(data.error);
$('#holiname').next().css({'color':'red'});
//$('#holystrucmodel').modal('hide');
//$(".modal-backdrop").remove();

$('#holidayform')[0].reset();
setTimeout(function(){
$("#holiname").next().remove();
$('#holiname').next().css();   
},3000)
 
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
}
}
});
});
//structure
$(document).on('click','.strucdel', function (e) {
//var id = $(this).parents('tr').find('#id').val();
var id = $(this).attr('data-id');
$.confirm({
title: 'Delete Warning!',
content: 'Are you sure, you want to delete this holidaystructure?',
boxWidth: '25%',
useBootstrap: false,
buttons: {
delete: {
text: 'Delete',
btnClass: 'btn-primary',
action: function(){
$.ajax({
type: 'post',
url: '<?php echo base_url('Leave/HolidayStrucDelete') ?>',
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
}
}
});
});

// status
    $(document).on('click','#inactive',function(){
    event.preventDefault();
    //var inactivestatus = $(this).val();
    var id = $(this).attr('data-id');
    //console.log(id);
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/holystructureinactive");?>',
    data: {
    id:id},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $.wnoty({
    type: 'success',
    message: 'Status  InActive Successfully',
    autohideDelay: 3000,
    position: 'top-right'
    });
    setTimeout(function(){
    location.reload(true);
    },3000);
    }else if(data.error){
    $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'
    });
    }
    },
    });
    return false;
    })

    $(document).on('click','#active',function(){
    event.preventDefault();
    // var inactivestatus = $(this).val();
    var id = $(this).attr('data-id');

    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/holystructureactive");?>',
    data: {

    id:id},
    success:function(resp){
    var data=$.parseJSON(resp);

    if(data.status == 'success'){
    $.wnoty({
    type: 'success',
    message: 'Status  Active Successfully',
    autohideDelay: 3000,
    position: 'top-right'
    });
    setTimeout(function(){
    location.reload(true);
    },3000);
    }else if(data.error){
    $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'
    });
    }
    },
    });
    return false;
    })

    //------------new ----------------
        // Handle switch state change on checkbox click
        $(document).ready(function () {
            $('.js-switch').on('change', function () {
                var $row = $(this).closest('tr'); // Get the closest parent row element
                var checkedCheckbox = $row.find('.js-switch:checked'); // Get the checked checkbox within the row
                var id = $(this).data('id'); // Get the data-id attribute from the clicked checkbox

                if (checkedCheckbox.length > 0) {
                     $(this).removeClass("off").addClass("on");
                    // Switch is in the "on" position
                     $.ajax({
                        type:'post',
                        url: '<?php echo base_url("Leave/holystructureactive");?>',
                        data: {

                        id:id},
                        success:function(resp){
                        var data=$.parseJSON(resp);

                        if(data.status == 'success'){
                        $.wnoty({
                        type: 'success',
                        message: 'Status  Active Successfully',
                        autohideDelay: 1000,
                        position: 'top-right'
                        });
                        setTimeout(function(){
                        location.reload(true);
                        },2000);
                        }else if(data.error){
                        $.wnoty({
                        type: 'error',
                        message: data.error,
                        autohideDelay: 3000,
                        position: 'top-right'
                        });
                        }
                        },
                        });
                        return false;

                    
                    // Display the "on" values
                    console.log('Switch is ON');
                    console.log('ID: ' + id);
                } else {
                          $(this).removeClass("on").addClass("off");
                    // Switch is in the "off" position
                      $.ajax({
                        type:'post',
                        url: '<?php echo base_url("Leave/holystructureinactive");?>',
                        data: {
                        id:id},
                        success:function(resp){
                        var data=$.parseJSON(resp);
                        if(data.status == 'success'){
                        $.wnoty({
                        type: 'success',
                        message: 'Status  InActive Successfully',
                        autohideDelay: 1000,
                        position: 'top-right'
                        });
                        setTimeout(function(){
                        location.reload(true);
                        },2000);
                        }else if(data.error){
                        $.wnoty({
                        type: 'error',
                        message: data.error,
                        autohideDelay: 3000,
                        position: 'top-right'
                        });
                        }
                        },
                        });
                        return false;
                
                    console.log('Switch is OFF');
                    console.log('ID: ' + id);
                }
            });
        });
</script>   
<?php $this->load->view('backend/footer'); ?>