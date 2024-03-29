<!--<script>
$(document).ready(function () {
    $('#tasksModalform input').on('change', function(e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var duration = $('input[name=type]:checked', '#tasksModalform').attr('data-value');
        if(duration =='Field'){
            console.log(duration);
            $('#location').show();
        } 
        else if(duration =='Office'){
            console.log(duration);
          $('#location').hide();  
        }
    });
});                                                          
</script> -->
    <script type="text/javascript">
$(document).ready(function() {
    $(".taskclass").change(function(e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = +this.value;
        //console.log(this.value);
        $("#assignval").change();
        //$('#salaryform').trigger("reset");
        $.ajax({
            url: '<?php echo base_url(); ?>logistice/GetAssignforlogistic?id=' + this.value,
            method: 'GET',
            data: 'data'
        }).done(function(response) {
            console.log(response);
            // Populate the form fields with the data returned from server
            $('#assignval').html(response);
        });
    });
});
    </script>
    <script type="text/javascript">
$(document).ready(function() {
    $(".assetsstock").change(function(e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = +this.value;
        //console.log(this.value);
        //"#taskval option:selected" ).text();
        $("#qty").change();
        //$('#salaryform').trigger("reset");
        $.ajax({
            url: '<?php echo base_url();?>logistice/GetInstock?id=' + this.value,
            method: 'GET',
            data: 'data',
        }).done(function(response) {
            //console.log(response);
            // Populate the form fields with the data returned from server
            $('.qty').html('Qty : '+response);
            $('#tasksModalform').find('[name="qty"]').attr("max", response);
        });
    });
});
    </script>
    <!--<script type="text/javascript">
    $(document).ready(function () {
        $(".proid").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).val();
            console.log(iid);
            $('#tasksModalform').trigger("reset");
            $('#tasksmodel').modal('show');
            $.ajax({
                url: 'projectbyId?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                console.log(response);
                // Populate the form fields with the data returned from server
				$('#tasksModalform').find('[name="prostart"]').val(response.provalue.pro_start_date).end();
                $('#tasksModalform').find('[name="proend"]').val(response.provalue.pro_end_date).end();
			});
        });
    });
</script>  -->

    <script>
//update project details
$('.custom-select').on('change', function() {
    //$('input:required').remove();
    $(this).removeClass('error');
    $(this).addClass('valid');
    $(this).next('.error').css({
        display: 'none'
    });
})
$(document).on('click', '#upd_project', function() {
    event.preventDefault();
    $("#upd_projectform").valid();
    var protitle = $("#protitle").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    var prostatus = $("#prostatus").val();

    if (protitle != '' && startdate != '' && startdate != '' && enddate != '' && prostatus != '') {

        $.ajax({
            type: 'post',
            url: '<?php echo base_url("Projects/Add_Projects");?>',
            data: new FormData($("#upd_projectform")[0]),
            contentType: false,
            processData: false,
            success: function(resp) {
                var data = $.parseJSON(resp);
                if (data.status == 'success') {
                    setTimeout(function() {
                        $('#upd_projectform')[0].reset();
                        $.wnoty({
                            type: 'success',
                            message: data.message,
                            autohideDelay: 5000,
                            position: 'top-right'
                        });
                    }, 2000);
                    setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                } else if (data.status == 'error') {

                    $.wnoty({
                        type: 'error',
                        message: data.message,
                        autohideDelay: 3000,
                        position: 'top-right'

                    });
                }
            },
        });
    }

    return false;
})


    </script>
    <script >
    $(document).ready(function() {
    $(".taskmodal").click(function(e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#tasksModalform').trigger("reset");
        $('#tasksmodel').modal('show');
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
                .end();
            /* $('#tasksModalform').find('[name="teamhead"]').val(response.tasksvalue
            .assign_user).end(); */
            /*$('#tasksModalform').find('[name="teamhead"]').
            append('<option selected value=' + response.tasksvalue.assign_user + '>' + response
                    .tasksvalue.first_name + '' + response.tasksvalue.last_name + '</option>')
                .end();*/ //$("#tmhead option[value='" +  response.tasksvalue.assign_user +"']").attr("selected","selected");
            //$('#tmhead').select2("val", "Your_value").trigger('change');
               
               $('#tmhead').val(response.tasksvalue.assign_user);
          

           var str='';

            for (x in response.membervalue) {

                str+='<option selected value='+response.membervalue[x]['assign_user']+'>'+response.membervalue[x]['first_name']+''+ response.membervalue[x]['last_name']+'</option>';
               
               //str += response.membervalue[x]['assign_user'];


            }

          // $("#assigntotask option[value='" + str+"']").attr("selected","selected");
           
            $('#tasksModalform').find('[id="assigntotask"]').html(str);

            $('#tasksModalform').find('[name="tasktitle"]').val(response.tasksvalue
                .task_title).end();
            $('#tasksModalform').find('[name="startdate"]').val(response.tasksvalue
                .start_date).end();
            $('#tasksModalform').find('[name="enddate"]').val(response.tasksvalue.end_date)
                .end();
            $('#tasksModalform').find('[name="details"]').val(response.tasksvalue
                .description).end();
            //$('#tasksModalform').find('[name="status"]').val(response.tasksvalue.status).end();
            $("input[name=status][value=" + response.tasksvalue.status + "]").attr('checked', 'checked');
        });
    });
});



//code close
$(document).on('click', '.cls', function(event) {
   event.preventDefault();
    $('#tasksmodel').modal('hide');
    $(".modal-backdrop").remove();
    $('#tasksModalform')[0].reset();
    location.reload(true);
           
   });
$(document).on('click', '#add_task', function(event) {
   event.preventDefault();
    $("#tasksModalform").valid();
    $('.collab_info').remove();

       $("#projectid").attr("disabled", false); 
        $("#tmhead").attr("disabled", false); 
        $("#assigntotask").attr("disabled", false);

        $('#assigntotask').change(function() {

            // $("#assigntotask :selected").each(function() {
            if ($(this).val().length > 0) {
                
                $(this).removeClass('error');
                $(this).addClass('valid');
                $(this).next().css('display', 'none');

            }

            //  }); 
        })
   
    var projectid = $("#projectid").val();
    var tmhead = $("#tmhead").val();
    var assigntotask = $("#assigntotask").val();
    var assigntasktitle = $("#assigntasktitle").val();
    var taskstartdate = $("#taskstartdate").val()
    var taskenddate = $("#taskenddate").val()
    //console.log(assigntotask);
    if (projectid != '' && tmhead != '' && assigntotask != '' && taskstartdate != '' && taskenddate != '') {

        $.ajax({
            type: 'post',
            url: '<?php echo base_url("Projects/Add_Tasks");?>',
            data: $("#tasksModalform").serialize(),
            //new FormData($("#tasksModalform")[0]),
            //contentType: false,
            //processData: false,
            success: function(resp) {
                var data = $.parseJSON(resp);
            
              if (data.status == 'success') {
                 
                   $('#tasksmodel').modal('hide');
                   $(".modal-backdrop").remove();
                    $('#tasksModalform')[0].reset();
                    $.wnoty({
                        type: 'success',
                        message: data.message,
                        autohideDelay: 5000,
                        position: 'top-right'
                    });
                  
                      setTimeout(function(){
                            location.reload(true);
                            },3000);
                } else if (data.status == 'error') {

                    $.wnoty({
                        type: 'error',
                        message: data.message,
                        autohideDelay: 3000,
                        position: 'top-right'

                    });
                }
            },
        });
    }

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

    //add Files
    $(document).on('click','#add_projectfile',function(){
    event.preventDefault();
    $("#projectfiles").valid();
    var filename=$("#filename").val();
    var fileassign=$("#fileassign").val();
   if( filename!= '' && fileassign != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Projects/Add_File");?>',
     data: new FormData($("#projectfiles")[0]),
     contentType: false,
     processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
  $('#projectfiles')[0].reset();
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
    }else if(data.error){
         $.wnoty({
            type: 'error',
            message: data.message,
            autohideDelay: 5000,
            position: 'top-right'

    });
    } 
    },
    });
   }
    return false;
    }) 
     //add Notes
    $(document).on('click','#addnotes',function(){
    event.preventDefault();
    $("#notesform").valid();
    var notesdetails=$("#notesdetails").val();
    var notes_assignto=$("#notes_assignto").val();
   if( notesdetails!= '' && notes_assignto != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Projects/Add_Pro_Notes");?>',
     data: new FormData($("#notesform")[0]),
     contentType: false,
     processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
  $('#notesform')[0].reset();
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
    }else if(data.error){
         $.wnoty({
            type: 'error',
            message: data.message,
            autohideDelay: 5000,
            position: 'top-right'

    });
    } 
    },
    });
   }
    return false;
    }) 
     //delete notes
    $(document).on('click','.notesdel', function (e) {
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this notes?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Projects/Delete_Pro_Notes') ?>',
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
      //add Expences
    $(document).on('click','#btn_expense',function(){
    event.preventDefault();
    $("#expenseform").valid();
    var expensedetails=$("#expensedetails").val();
    var expenseassignto=$("#expenseassignto").val();
    var expenseamount=$("#notes_assignto").val();
   if( expensedetails!= '' && expenseassignto != ''&& expenseamount != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Projects/Add_Expenses");?>',
     data: new FormData($("#expenseform")[0]),
     contentType: false,
     processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
  $('#expenseform')[0].reset();
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
    }else if(data.error){
         $.wnoty({
            type: 'error',
            message: data.message,
            autohideDelay: 5000,
            position: 'top-right'

    });
    } 
    },
    });
   }
    return false;
    }) 
       //delete Expense
    $(document).on('click','.expensedel', function (e) {
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this expenses?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Projects/Delete_Expenses') ?>',
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
    //logestic
    
    $(document).ready(function() {
        $("#logisticeid").click(function(e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#logisModalform').trigger("reset");
            $('#logisticmodel').modal('show');
            $.ajax({
                url: 'LogisTicById?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                $('#logisModalform').find('[name="id"]').val(response.logisticevalue.ass_id)
                    .end();
                $('#logisModalform').find('[name="proid"]').val(response.logisticevalue
                    .project_id).end();
                /*$('#logisModalform').find('[name="teamhead"]').val(response.logisticevalue
                    .assign_id).end();*/
                $('#logisModalform').find('#logistic_teamhead').val(response.logisticevalue
                    .assign_id).end();
                $('#logisModalform').find('[name="taskid"]').val(response.logisticevalue
                    .task_id).end();
                $('#logisModalform').find('[name="startdate"]').val(response.logisticevalue
                    .start_date).end();
                $('#logisModalform').find('[name="enddate"]').val(response.logisticevalue
                    .end_date).end();
                $('#logisModalform').find('[name="remarks"]').val(response.logisticevalue
                    .remarks).end();
                $('#logisModalform').find('[name="logistic"]').val(response.logisticevalue
                    .asset_id).end();
                $('#logisModalform').find('[name="qty"]').val(response.logisticevalue.log_qty)
                    .end();
            });
        });
    });

     //add logestic
    $(document).on('click','#addbtn_logistic',function(){
    event.preventDefault();
    $("#logisModalform").valid();
    var projectid = $("#logistic_proid").val();
    var prostart = $('#logistic_prostart').val();
    var proend =$('#logistic_proend').val();
    var taskid = $('#taskval').val();
    var teamhead = $('#logistic_teamhead').val();
    var taskstartdate = $('#logistic_startdate').val()
    //var taskenddate = $('[name="enddate"]').val()
    var logistic = $('#logistic_val').val()
   if( projectid!= '' && prostart != ''&& proend != '' && taskid != ''&& teamhead != '' && taskstartdate != ''&& logistic != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Projects/Add_Logistic");?>',
     data: new FormData($("#logisModalform")[0]),
     contentType: false,
     processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#logisModalform')[0].reset();
    $('#logisticmodel').modal('hide');
    $(".modal-backdrop").remove();
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
    }else if(data.error){
         $.wnoty({
            type: 'error',
            message: data.message,
            autohideDelay: 5000,
            position: 'top-right'

    });
    } 
    },
    });
   }
    return false;
    }) 
    </script>