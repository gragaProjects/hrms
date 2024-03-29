<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<?php 
        $id = base64_decode($this->input->get('id'));
         $sql = "SELECT * FROM `leavestructure` WHERE `id`='$id'";
            $query = $this->db->query($sql);
            $result = $query->row();
        ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-bullhorn" style="color:#1976d2"></i> <?= $result->leavestructure?>  Based Leave Types</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leave</li>
            </ol>
        </div>
    </div>
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <?php if($this->role->User_Permission('leave_structure','can_add')){?>
                <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#leavemodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Leave Types</a></button>
                <?php } ?>
               <a href="<?php echo base_url(); ?>leave/LeaveStructure" class="text-white btn btn-info" style="width: 100px;"><i  class="fa fa-bars" aria-hidden="true"></i>   Back</a>
               <input type="hidden" name="lid" id="lid" value="<?= base64_decode($this->input->get('id')); ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Leave Types  </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="examplesearch" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th>Leave Type</th>
                                        <th>Number Of Days</th>
                                        <th>Paid Status</th>
                                        <?php if($this->role->User_Permission('leave_structure','can_edit') || $this->role->User_Permission('leave_structure','can_delete')){?>
                                         <th>Action</th>
                                         <?php } ?>
                                    </tr>
                                </thead>
                          
                                <tbody id="leavetypetbl"> 
                                            
                                    <?php  $i = 1;
                                    foreach($leavetypes as $value): ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->name ?></td>
                                        <td><?php echo $value->leave_day ?></td>
                                        <td><?php echo $value->paidstatus ?></td>
                                         <?php if($this->role->User_Permission('leave_structure','can_edit') || $this->role->User_Permission('leave_structure','can_delete')){?>
                                        <td class="jsgrid-align-center ">
                                               <?php if($this->role->User_Permission('leave_structure','can_edit') ){?>
                                            <a href="" title="Edit"  class="btn btn-sm btn-info waves-effect waves-light leavetype" data-id="<?php echo $value->type_id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                             <?php if($this->role->User_Permission('leave_structure','can_delete') ){?>
                                            <button   title="Delete" data-id="<?php echo $value->type_id; ?> "class="btn btn-sm btn-info waves-effect waves-light leavedel"><i class="fa fa-trash-o"></i></button>
                                             <?php } ?>
                                        </td>
                                           <?php } ?>
                                    </tr>
                                    <?php $i++;
                                endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        <script type="text/javascript">

         /*   //fetch data 
            function viewLeavetype(){
            var url = '<?php echo base_url(); ?>';
            var id = $('#lid').val();
           // console.log(id);
            $.ajax({
                type: 'GET',
                url: url + 'Leave/fetch_leavetypes?id=' + id,
                data : '',
                success:function(response){
                    $('#leavetypetbl').html(response);
                }
            });
           }
            viewLeavetype();*/

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
            autohideDelay: 3000,
            position: 'top-right'
            });
       
        setTimeout(function(){
         location.reload(true);
        },3000);
         
       }else if(data.status == 'error'){
      
              $.wnoty({
                    type: 'error',
                    message: data.message,
                    autohideDelay: 3000,
                    position: 'top-right'

                    });
        }else if(data.status == 'valid'){
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
        </script>
        <?php $this->load->view('backend/footer'); ?>