<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Tasks</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tasks</li> -->
                        <?php if($this->role->User_Permission('task_list','can_add')){?>                     
                        <button type="button" class="btn btn-info" style="width: 100px;"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Task </a></button>
                       <!--  <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 100px;">Cancel</a> -->
                     
                        <?php } ?>
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Task List                   
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Project Title</th>
                                                <th>Tasks Title </th>
                                                <th>Start Date </th>
                                                <th>End Date </th>
                                                <th>Assigned Employee </th>
                                               <th>Action </th>
                                              <!--  <?php if($this->role->User_Permission('task_list','can_delete') || $this->role->User_Permission('task_list','can_edit')){?>
                                                    <th>Action </th>
                                                    <?php } ?> -->
                                            </tr>
                                        </thead>
                                 
                                        <tbody>
                                           <?php foreach($tasks as $value): ?>
                                            <tr>
                                                <td><?php echo substr($value->pro_name,0,50).'...' ?></td>
                                                <td><?php echo substr($value->task_title,0,50).'...' ?></td>
                                                <td><?php echo date('d M Y',strtotime($value->start_date))  ?></td>
                                                <td><?php echo date('d M Y',strtotime($value->end_date)) ?></td>
                                                <td>
                                                <?php
                                                $id = $value->id;
                                                $assignvalue = $this->project_model->getTaskAssignUser($id);  ?>
                                                <?php foreach($assignvalue as $value1): ?>
                                                <img src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $value1->em_image ?>" height="40px" width="40px" style="border-radius:50px" alt="" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $value1->first_name; ?>">
                                                <?php endforeach; ?>
                                                </td>
                                           
                                                        <?php if($this->role->User_Permission('task_list','can_delete') || $this->role->User_Permission('task_list','can_edit')){?>
                                                        <td class="jsgrid-align-center ">
                                                              <?php if( $this->role->User_Permission('task_list','can_edit')){?>
                                                          <!--   <button  title="Edit"
                                                                class="btn btn-sm btn-info waves-effect waves-light exampleModal"
                                                                data-id="<?php echo $value->id ?>"><i
                                                                    class="fa fa-pencil-square-o"></i></button> -->
                                                                      <?php } if($this->role->User_Permission('task_list','can_delete')){?>
                                                            <button 
                                                                 title="Delete"
                                                                class="btn btn-sm btn-info waves-effect waves-light  delofficetask"
                                                                data-id="<?php echo $value->id ?>"><i
                                                                    class="fa fa-trash-o"></i></button>
                                                                    <?php } ?>
                                                        </td>
                                                        <?php } ?> 
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
                        <!-- sample modal content -->
                        <div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Add Tasks</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="tasksModalform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row"> 
                                            <div class="col-md-4">
                                                  <div class="form-group">
                                            <label class="control-label ">Project List</label><span class="error"> *</span>
                                                <select class="form-control custom-select   proid"  tabindex="1" name="projectid" id="projectid" required>
                                                   <!-- <option value=""> Select Project</option> -->
                                                   <option value=""> Select Project</option>
                                                   <?php foreach($projects as $value): ?>
                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->pro_name; ?></option>
                                                   <?php endforeach; ?>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label ">Project Start Date</label>
                                                <input type="text" value="" name="prostart" class="form-control " id="" readonly>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                  <div class="form-group">
                                                <label class="control-label ">Project End Date</label>
                                                <input type="text" value="" name="proend" class="form-control " id="" readonly>
                                            </div>
                                            </div>
                                        </div>   
                                        <div class="row"> 
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label ">Assign To</label><span class="error"> *</span>
                                                <select class="select2 form-control custom-select search "  style="width:25%" tabindex="1" name="teamhead" id="teamhead" required>
                                                  <option value="">Select Here</option>
                                                   <?php foreach($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                               
                                            </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                     <label class="control-label ">Collaborators</label><span class="error"> *</span>
                                                <select class="select2 form-control select2-multiple "  multiple="multiple" style="width:25%" tabindex="1" name="assignto[]" id="assignto" >
                                                  <option value="">Select Here</option>
                                                   <?php foreach($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                   <div class="form-group">
                                                <label class="control-label ">Task Title</label><span class="error"> *</span>
                                                <input type="text" name="tasktitle" class="form-control " id="tasktitle"  maxlength="250" placeholder="Task....">
                                            </div>
                                            </div>
                                        </div>   
                                         <div class="row"> 
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                     <label class="control-label ">Task Start Date</label><span class="error"> *</span>
                                                <input type="text" name="startdate" class="form-control  datetimepickerFull" id="startdate" required>
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                   <div class="form-group">
                                               
                                                <label class="control-label ">Task End Date</label><span class="error"> *</span>
                                                <input type="text" name="enddate" class="form-control  datetimepickerFull" id="enddate" required>
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                 
                                            <div class="form-group">
                                                <label for="message-text" class="control-label ">Details</label>
                                                <textarea class="form-control" rows="1" name="details" id="details" minlength="10" maxlength="1400"></textarea>
                                            </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                <div class="form-group">
                                               <label class="control-label ">Status: </label>
                                                <input name="status" type="radio" id="radio_1" data-value="Logistic" class="type" value="complete">
                                                <label for="radio_1">Completed</label>
                                                <input name="status" type="radio" id="radio_2" data-value="Logistic" class="type" value="running" checked>
                                                <label for="radio_2">Running</label>
                                                <input name="status" type="radio" id="radio_3" data-value="Logistic" class="type" value="cancel">
                                                <label for="radio_3">Cancel</label>
                                            </div>
                                                <div class="form-group">
                                               <label class="control-label " style="display:none;">Type: </label>
                                                <input name="type" type="radio" id="radio_4" data-value="Logistic" class="type" value="Office" style="display:none;" checked>
                                                <label for="radio_4" style="display:none;">Office</label>
                                               <!-- <input name="type" type="radio" id="radio_5" data-value="Logistic" class="type" value="Field">
                                                <label for="radio_5">Field</label>-->
                                              </div>  
                                    </div>
                                        </div>   
                                    
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="form-control" id="">                                       
                                        <input type="hidden"  class="form-control" name="projectid">                                       
                                      
                                        <button type="submit" class="btn btn-primary" id="add_task">Submit</button>
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
$(document).ready(function () {
    $(".assetsstock").change(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = +this.value;
        //console.log(this.value);
        //"#taskval option:selected" ).text();
        $( "#qty" ).change();
        //$('#salaryform').trigger("reset");
        $.ajax({
            url: '<?php echo base_url();?>logistice/GetInstock?id=' + this.value,
            method: 'GET',
            data: 'data',
        }).done(function (response) {
            console.log(response);
            // Populate the form fields with the data returned from server
            $('.qty').html(response);  
             $('#tasksModalform').find('[name="qty"]').attr("max",response);           
		});
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".proid").change(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).val();
            //console.log(iid);
            $('#tasksModalform').trigger("reset");
            $('#tasksmodel').modal('show');
            $.ajax({
                url: 'projectbyId?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                //console.log(response);
                // Populate the form fields with the data returned from server
				$('#tasksModalform').find('[name="prostart"]').val(response.provalue.pro_start_date).end();
                $('#tasksModalform').find('[name="proend"]').val(response.provalue.pro_end_date).end();
                $('#tasksModalform').find('[name="projectid"]').val(iid).end();
			});
        });
    });
</script>
   <script type="text/javascript">
    $(document).ready(function () {
        $(".taskmodal").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            //console.log(iid);
            $('#tasksModalform').trigger("reset");
            $('#tasksmodel').modal('show');
            $.ajax({
                url: 'TasksById?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                //console.log(response);
                // Populate the form fields with the data returned from server
				$('#tasksModalform').find('[name="id"]').val(response.tasksvalue.id).end();
                $('#tasksModalform').find('[name="projectid"]').val(response.tasksvalue.pro_id).end();
                $('#tasksModalform').find('[name="assignto"]').val(response.tasksvalue.assigned_id).end();
                $('#tasksModalform').find('[name="tasktitle"]').val(response.tasksvalue.task_title).end();
                $('#tasksModalform').find('[name="startdate"]').val(response.tasksvalue.start_date).end();
                $('#tasksModalform').find('[name="enddate"]').val(response.tasksvalue.end_date).end();
                $('#tasksModalform').find('[name="details"]').val(response.tasksvalue.description).end();
                $('#tasksModalform').find('[name="status"]').val(response.tasksvalue.status).end();
			});
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function () {
    $(".TasksDelet").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $.ajax({
            url: 'TasksDeletByid?id=' + iid,
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
</script> 
    <script >
    $(document).ready(function() {
    $(".exampleModal").click(function(e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#tasksModalform').trigger("reset");
        $('#exampleModal').modal('show');
        $('.modal-title').text('Update Task');
           
           $("#projectid").attr("disabled", true); 
            $("#tmhead").attr("disabled", true); 
            $("#assigntotask").attr("disabled", true); 
            $('.collab_info').remove().css('display', 'none');

        $.ajax({
            url: 'TasksById?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function(response) {
            $('#tasksModalform').find('[name="id"]').val(response.tasksvalue.id).end();
            $('#tasksModalform').find('[name="pid"]').val(response.tasksvalue.id).end();
            $('#tasksModalform').find('[name="projectid"]').val(response.tasksvalue.pro_id)
            //$('#tasksModalform').find('[id="teamhead"]').val(response.tasksvalue.assign_user)
                .end();
                //console.log(response.tasksvalue.assign_user);
            $('[name="teamhead"]').val(response.tasksvalue.assign_user);
           var str='';

            for (x in response.membervalue) {

                str+='<option selected value='+response.membervalue[x]['assign_user']+'>'+response.membervalue[x]['first_name']+''+ response.membervalue[x]['last_name']+'</option>';
             }

          // $("#assigntotask option[value='" + str+"']").attr("selected","selected");
           
            $('#tasksModalform').find('[id="assignto"]').html(str);

            $('#tasksModalform').find('[id="tasktitle"]').val(response.tasksvalue
                .task_title).end();
            $('#tasksModalform').find('[id="startdate"]').val(response.tasksvalue
                .start_date).end();
            $('#tasksModalform').find('[id="enddate"]').val(response.tasksvalue.end_date)
                .end();
            $('#tasksModalform').find('[id="details"]').val(response.tasksvalue
                .description).end();
            //$('#tasksModalform').find('[name="status"]').val(response.tasksvalue.status).end();
            $("input[name=status][value=" + response.tasksvalue.status + "]").attr('checked', 'checked');
        });
    });
});

    //delete ofice task
    $(document).on('click','.delofficetask', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this task?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Projects/TaskDelete') ?>',
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

    $(document).on('click','#add_task',function(){
      
    event.preventDefault();
    $("#tasksModalform").valid();
   
    var projectid = $('[name="projectid"]').val();//projectid
    var prostart = $('[name="prostart"]').val();
    var proend =$('[name="proend"]').val();
    var teamhead = $('[name="teamhead"]').val();
    var taskstartdate = $('[name="startdate"]').val()
    var taskenddate = $('[name="enddate"]').val()
   
    if (projectid != '' && prostart != '' && proend != '' && teamhead != '' && taskstartdate != '' && taskenddate != '') {
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Projects/Add_Tasks");?>',
    data: new FormData($("#tasksModalform")[0]),
     contentType: false,
      processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#exampleModal').modal('hide');
    $(".modal-backdrop").remove();
  
    $('#tasksModalform')[0].reset();
    //$('#catid').val('');
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
    
   
   setTimeout(function(){
     location.reload(true);
    },3000);
    //  
    }else if (data.status == 'error') {
       $('#exampleModal').modal('hide');
         $(".modal-backdrop").remove();

                $.wnoty({
                    type: 'error',
                    message: data.message,
                    autohideDelay: 1000,
                    position: 'top-right'

                });
                  setTimeout(function() {
                    location.reload(true);
                }, 3000);
      }
    },
    });
    }
    return false;
    })
    </script>