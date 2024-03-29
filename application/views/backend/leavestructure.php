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
            <h3 class="text-themecolor"><i class="fa fa-bullhorn" style="color:#1976d2"></i> Leave Structure</h3>
        </div>
        <div class="col-md-7 align-self-center">
           <!--  <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave Structure</li>
            </ol> -->
             <ol class="breadcrumb">
              <?php if($this->role->User_Permission('leave_structure','can_add')){?>
                <button type="button" class="btn btn-info" ><a data-toggle="modal" data-target="#leavestrucmodel" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Add Leave Structure </a></button>
            
                
                <?php } ?>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <?php if($this->role->User_Permission('leave_structure','can_add')){?>
                <!-- <button type="button" class="btn btn-info" ><a data-toggle="modal" data-target="#leavestrucmodel" data-whatever="@getbootstrap" class="text-white"><i class="fa fa-plus"></i> Add Leave Structure </a></button> -->
            
                
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Leave Structure List  </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="examplesearch" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Name</th>
                                        <?php if($this->role->User_Permission('leave_structure','can_edit')){?>
                                        <th>Status</th>
                                        <?php }; ?>
                                        <?php if($this->role->User_Permission('leave_structure','can_edit')|| $this->role->User_Permission('leave_structure','can_view')){?>
                                        <th>Action</th>
                                        <?php }; ?>
                                    </tr>
                                </thead>
                                
                                <tbody id="leavestructbl">
                                    <?php $i = 1;
                                    foreach($leavestruc as $value): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->leavestructure ?></td>
                                        <?php if($this->role->User_Permission('leave_structure','can_edit')){?>
                                                  <!-- new -->
                                       <td>
                                            <div class="">
                                                <!-- bt-switch -->
                                                <!-- Add unique IDs and values to your checkboxes -->
                                                <?php if($value->Active_status == "1"){ ?>
                                                    <!--  jackColor: '#fcf45e', jackSecondaryColor: '#c8ff77' -->
                                                <input type="checkbox" class="js-switch on" id="" data-color="#28a745" data-secondary-color="#f62d51" checked data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff' />

                                                    <!-- <input type="checkbox" class="switchbtn" checked data-on-color="success" data-off-color="danger" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>" data-id="<?php echo $value->id; ?>" > -->

                                                  <?php }elseif ($value->Active_status == "0"){ ?>
                                                      <input type="checkbox" class="js-switch off" id="" data-color="#28a745" data-secondary-color="#f62d51" data-id="<?php echo $value->id; ?>" data-size="small" data-jackColor="#fff" data-jackSecondaryColor= '#fff' />
                                                <?php }; ?>
                                           
                                            </div>
                                            </td>
                                  <!--       <td>
                                            <?php //echo $value->Active_status;
                                            if($value->Active_status == "1"){ ?>
                                            
                                            <button type="button" class="btn btn-primary" id="inactive" value="0" data-id="<?php echo $value->id; ?>" name="inactive" >ACTIVE</button><?php
                                            }elseif ($value->Active_status == "0"){ ?>
                                            <button type="button" class="btn btn-info" id="active" value="1" data-id="<?php echo $value->id; ?>" name="active">INACTIVE</button><?php
                                            }?>
                                            
                                        </td> -->
                                        <?php }; ?>
                                        <td class="jsgrid-align-center ">
                                            <?php if($value->Active_status == "1"){?>
                                            <?php if($this->role->User_Permission('leave_structure','can_edit')){?>
                                            <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light holiday " data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } if($this->role->User_Permission('holiday','can_add')){?>
                                            <a href="" data-toggle="modal" data-target="#leavemodel" data-whatever="@getbootstrap"  title="Add Holiday"  class="btn btn-sm btn-info waves-effect waves-light leavemodel " data-id="<?php echo $value->id; ?>"><i class="fa fa-plus"></i></a>
                                            <?php }; ?>
                                            <?php if($this->role->User_Permission('holiday','can_view')){?>
                                            <!--  href="<?php echo base_url(); ?>leave/Holidays?id=<?php echo base64_encode($value->id)?>" -->
                                            <a title="View"  class="btn btn-sm btn-info waves-effect waves-light  accordion-toggle text-white" data-toggle="collapse" data-target="#demo<?php echo $i ?>"  data-id="<?php echo $value->id; ?>"><i class="fa fa-eye"></i></a>
                                            <?php } if($this->role->User_Permission('leave_structure','can_delete') ){?>
                                                                <button   title="Delete" data-id="<?php echo $value->id; ?> "class="btn btn-sm btn-info waves-effect waves-light strucdel"><i class="fa fa-trash-o"></i></button>
                                                                <?php } }; ?>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <?php
                                    $id =  $value->id;
                                    $leavetypes =  $this->leave_model->GetLeaveInfo( $id);
                                    ?>
                                    <tr>
                                        <td colspan="12" class="hiddenRow">
                                            <div class="accordian-body collapse" id="demo<?php echo $i ?>">
                                                <table class="display nowrap table table-hover table-striped table-bordered">
                                                    <thead class="card-header" >
                                                        <tr class="info" style="background: #1976d2; color :white;">
                                                            
                                                            <th>ID </th>
                                                            <th>Leave Type</th>
                                                            <th>Number Of Days</th>
                                                            <th>Paid Status</th>
                                                            <?php if($this->role->User_Permission('leave_structure','can_edit') || $this->role->User_Permission('leave_structure','can_delete')){?>
                                                            <th>Action</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <?php  $j = 1;
                                                        foreach($leavetypes as $value): ?>
                                                        <tr>
                                                            <td><?php echo $j; ?></td>
                                                            <td><?php echo $value->name ?></td>
                                                            <td><?php echo $value->leave_day ?></td>
                                                            <td><?php echo $value->paidstatus ?></td>
                                                            <?php if($this->role->User_Permission('leave_structure','can_edit') || $this->role->User_Permission('leave_structure','can_delete')){?>
                                                            <td class="jsgrid-align-center ">
                                                                <?php if($this->role->User_Permission('leave_structure','can_edit') ){?>
                                                                <a href="" title="Edit"  class="btn btn-sm btn-info waves-effect waves-light leavetype" data-id="<?php echo $value->type_id; ?>" data-structure="<?php echo $value->leavestrucid; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                                <?php } ?>
                                                                <?php if($this->role->User_Permission('leave_structure','can_delete') ){?>
                                                                <button   title="Delete" data-id="<?php echo $value->type_id; ?> "class="btn btn-sm btn-info waves-effect waves-light leavedel"><i class="fa fa-trash-o"></i></button>
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
                                    <?php $i++; endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="leavestrucmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Leave Structure</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="post"  id="leavestrucform" enctype="multipart/form-data">
                        <div class="modal-body"><!-- action="Add_Holidays" -->
                        
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" name="leavestructure" class="form-control" id="leavestructure" minlength="4" maxlength="25"  required>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="" class="form-control" id="id">
                        
                        <button type="submit" class="btn btn-primary" id="add_leavestruc">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="leavemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Leave</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="Add_leaves_Type" id="leaveform" enctype="multipart/form-data">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label class="control-label">Leave name</label><label class="error"> *</label>
                            <input type="text" name="leavename" class="form-control" id="leavename" minlength="1" maxlength="35" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day</label><label class="error"> *</label>
                            <input type="text" name="leaveday" class="form-control" id="leaveday" value="" required >
                        </div>
                        <div class="form-group">
                            <label class="control-label">Paid Status</label><label class="error"> *</label>
                            <select class="form-control custom-select" id="paidstatus" data-placeholder="Choose a Category" tabindex="1" name="paidstatus" required>
                                <option value="">Select Here</option>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label">status</label><label class="error"> *</label>
                            <select class="form-control custom-select" id="status" data-placeholder="Choose a Category" tabindex="1" name="status" required>
                                <option value="">Select Here</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div> -->
                        
                        <div class="form-group " >
                            <label class="control-label text-left hidden" >Is this annual leave?</label>
                            
                            <input name="annual_leave" type="radio" id="radio_3" data-value="1" class="" value="1"  >
                            <label for="radio_3" >Yes</label>
                            <input name="annual_leave" type="radio" id="radio_4" data-value="0" class="type " value="0" checked="checked">
                            <label for="radio_4" >No</label>
                            
                        </div>
                        <div class="form-group " >
                            <label class="control-label text-left hidden" >Is a document needed?</label>
                            
                            <input name="document_status" type="radio" id="radio_5" data-value="1" class="" value="1"  >
                            <label for="radio_5" >Yes</label>
                            <input name="document_status" type="radio" id="radio_6" data-value="0" class="type " value="0" checked="checked">
                            <label for="radio_6" >No</label>
                            
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="leavestrucid" id="leavestrucid" value="<?= base64_decode($this->input->get('id')); ?>">
                        <input type="hidden" name="id" value="" class="form-control" id="ltypeid">
                        
                        <button type="submit" class="btn btn-primary" id="add_leavetype">Submit</button>
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
    $('#leavestrucform').trigger("reset");
    $('#leavestrucmodel').modal('show');
    $.ajax({
    url: 'leavestrucbyib?id=' + iid,
    method: 'GET',
    data: '',
    dataType: 'json',
    }).done(function (response) {
    console.log(response);
    // Populate the form fields with the data returned from server
    $('#leavestrucform').find('[name="id"]').val(response.leavestrucvalue.id).end();
    $('#leavestrucform').find('[name="leavestructure"]').val(response.leavestrucvalue.leavestructure).end();
    
    });
    });
    });
    //fetch data
    function showLeave(){
    var url = '<?php echo base_url(); ?>';
    $.ajax({
    type: 'POST',
    url: url + 'Leave/fetch_leavestructure',
    success:function(response){
    $('#leavestructbl').html(response);
    }
    });
    }
    //showLeave();
    //leave
    $('.close , .btn-default').on('click',function(){
    $('#leavestrucform')[0].reset();
    $('#id').val('');
    });
    //leave
    $(document).on('click','#add_leavestruc',function(){
    event.preventDefault();
    $("#leavestrucform").valid();
    var leavestructure=$('#leavestructure').val();
    if(leavestructure !='' ){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/Add_leavestructure");?>',
    data: $("#leavestrucform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#leavestrucmodel').modal('hide');
    $(".modal-backdrop").remove();
    $('#leavestrucform')[0].reset();
    $('#id').val('');
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'
    });
    //showLeave();
    setTimeout(function(){
    location.reload(true);
    },2000);
    }else if(data.error){

          $("#leavestructure").after(data.error);
        $('#leavestructure').next().css({'color':'red'});
        //$('#holystrucmodel').modal('hide');
        //$(".modal-backdrop").remove();

        $('#leavestrucform')[0].reset();
        setTimeout(function(){
        $("#leavestructure").next().remove();
        $('#leavestructure').next().css();   
        },3000)
    }
    },
    });
    }
    return false;
    })
    </script>
    <script type="text/javascript">

    //leave modal
    $(document).ready(function () {
    $(".leavetype ").click(function (e) {
    e.preventDefault(e);
    // Get the record's ID via attribute
    var iid = $(this).attr('data-structure');
    $('#leaveform').find('[name="leavestrucid"]').val(iid).end();
    });
    });    
    $(document).ready(function () {
    $(".leavemodel ").click(function (e) {
    e.preventDefault(e);
    // Get the record's ID via attribute
    var iid = $(this).attr('data-id');
    $('#leaveform').find('[name="leavestrucid"]').val(iid).end();
    });
    });
    $(document).ready(function () {
    $(".leavetype").click(function (e) {
    e.preventDefault(e);
    $('#radio_4').prop('checked', false);
    // Get the record's ID via attribute
    var iid = $(this).attr('data-id');
    $('#leaveform').trigger("reset");
    $('#leavemodel').modal('show');
    $.ajax({
    url: 'LeaveTypebYID?id=' + iid,
    method: 'GET',
    data: '',
    dataType: 'json',
    }).done(function (response) {
    
    // Populate the form fields with the data returned from server
    $('#leaveform').find('[name="id"]').val(response.leavetypevalue.type_id).end();
    $('#leaveform').find('[name="leavename"]').val(response.leavetypevalue.name).end();
    $('#leaveform').find('[name="leaveday"]').val(response.leavetypevalue.leave_day).end();
    $('#leaveform').find('[name="paidstatus"]').val(response.leavetypevalue.paidstatus).end();
    //$('#leaveform').find('[name="annual_leave"]').val(response.leavetypevalue.isAnnual_leave).end();
    $('input:radio[name="annual_leave"][value='+response.leavetypevalue.isAnnual_leave+']').prop('checked', true);
    $('input:radio[name="document_status"][value='+response.leavetypevalue.document_status+']').prop('checked', true);
    
    });
    });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
    $(".holidelet").click(function (e) {
    e.preventDefault(e);
    // Get the record's ID via attribute
    var iid = $(this).attr('data-id');
    $.ajax({
    url: 'HOLIvalueDelet?id=' + iid,
    method: 'GET',
    data: 'data',
    }).done(function (response) {
    console.log(response);
    $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
    window.setTimeout(function(){location.reload()},2000)
    // Populate the form fields with the data returned from server
    });
    });
    });
    
    $('.custom-select').on('change',function(){
    //$('input:required').remove();
    $(this).removeClass('error');
    $(this).addClass('valid');
    $(this).next('.error').css({display:'none'});
    })
    //leave
    $('.close , .btn-default').on('click',function(){
    $('#leaveform')[0].reset();
    $('#ltypeid').val('');
    });
    //Save type
    $(document).on('click','#add_leavetype',function(){
    event.preventDefault();
    $("#leaveform").valid();
    
    var leavename=$("#leavename").val();
    var leaveday=$('#leaveday').val();
    var status=$('#paidstatus').val();
    
    if(leavename != '' && leaveday != '' && status != '' ){
    
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/Add_leaves_Type");?>',
    data: new FormData($("#leaveform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#leavemodel').modal('hide');
    $(".modal-backdrop").remove();
    
    $('#leaveform')[0].reset();
    $('#ltypeid').val('');
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

          $("#leavename").after(data.error);
        $('#leavename').next().css({'color':'red'});
        //$('#holystrucmodel').modal('hide');
        //$(".modal-backdrop").remove();

        $('#leaveform')[0].reset();
        setTimeout(function(){
        $("#leavename").next().remove();
        $('#leavename').next().css();   
        },3000)
    }
    },
    });
    }
    
    return false;
    })
    //delete
    $(document).on('click','.leavedel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this leavetype?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Leave/LeaveDelete') ?>',
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
    //delete structure
    $(document).on('click','.strucdel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this leavestructure?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Leave/LeaveStructureDelete') ?>',
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

    $(document).on('click','#inactive',function(){
    event.preventDefault();
    //var inactivestatus = $(this).val();
    var id = $(this).attr('data-id');
    var status = $('#inactive').val()
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/leavestructureinactive");?>',
    data: {
    id:id,status:status},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $.wnoty({
    type: 'success',
    message: 'Status  Changed Successfully',
    autohideDelay: 3000,
    position: 'top-right'
    });
    //showLeave();
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
    var status = $('#active').val()
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Leave/leavestructureactive");?>',
    data: {
    
    id:id,status:status},
    success:function(resp){
    var data=$.parseJSON(resp);
    
    if(data.status == 'success'){
    $.wnoty({
    type: 'success',
    message: 'Status  Changed Successfully',
    autohideDelay: 3000,
    position: 'top-right'
    });
    //showLeave();
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
                    // var inactivestatus = $(this).val();
                       // var id = $(this).attr('data-id');
                        var status = 1;
                        $.ajax({
                        type:'post',
                        url: '<?php echo base_url("Leave/leavestructureactive");?>',
                        data: {
                        
                        id:id,status:status},
                        success:function(resp){
                        var data=$.parseJSON(resp);
                        
                        if(data.status == 'success'){
                        $.wnoty({
                        type: 'success',
                        message: 'Status  Changed Successfully',
                        autohideDelay: 3000,
                        position: 'top-right'
                        });
                        //showLeave();
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
                    
                    
                    // Display the "on" values
                    console.log('Switch is ON');
                    console.log('ID: ' + id);
                } else {
                     $(this).removeClass("on").addClass("off");
                    // Switch is in the "off" position
                     var status = 0;
                       $.ajax({
                        type:'post',
                        url: '<?php echo base_url("Leave/leavestructureinactive");?>',
                        data: {
                        id:id,status:status},
                        success:function(resp){
                        var data=$.parseJSON(resp);
                        if(data.status == 'success'){
                        $.wnoty({
                        type: 'success',
                        message: 'Status  Changed Successfully',
                        autohideDelay: 3000,
                        position: 'top-right'
                        });
                        //showLeave();
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
                
                    console.log('Switch is OFF');
                    console.log('ID: ' + id);
                }
            });
        });
</script>
    <?php $this->load->view('backend/footer'); ?>