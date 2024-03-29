<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-bookmark-o" style="color:#1976d2"> </i> Earn Leave</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Earn Leave</li> -->
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#earnmodel" data-whatever="@getbootstrap" class="text-white TypeModal"><i class="" aria-hidden="true"></i> Assign Earned Leave </a></button>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Earn Balance                      
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee PIN</th>
                                                <th>Employee Name </th>
                                                <!--<th>Total Day </th>-->
                                                <th>Total Hour </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Employee PIN</th>
                                                <th>Employee Name </th>
                                                <!--<th>Total Day </th>-->
                                                <th>Total Hour </th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($earnleave as $value): ?>
                                            <tr>
                                                <td><?php echo $value->em_code ?></td>
                                                <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                                <!--<td><?php echo $value->present_date; ?></td>-->
                                                <td><?php echo $value->hour .' Hours' ?></td>
                                                <?php if($value->present_date > 0){ ?>
                                               <td class="jsgrid-align-center">
                                                    <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light deductionmodel" data-id="<?php echo $value->em_id; ?>"><i class="fa fa-pencil-square-o"></i></a>
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
                        <div class="modal fade" id="earnmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Earn Leave</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <!-- action="Update_Earn_Leave" -->
                                    <form method="post"  id="earnform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                        <div class="form-group">
                                       <label>Employee </label>
                                        <select name="emid" id="emid" class="form-control select2 custom-select" style="width:100%" required><label class="error"> *</label>
                                            <option value="">Select Employee</option>
                                            <?php foreach($employee as $value): ?>
                                            <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Start Date </label><label class="error"> *</label>
                                        <input type="text" name="startdate" id="startdate" class="form-control mydatepicker" value="" required>
                                        </div>
                                        <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" name="enddate" id="enddate" class="form-control mydatepicker" value="">
                                        </div>
                                        <!--<div class="form-group">
                                        <label>Number Of Days </label>
                                        <input type="text" name="days" class="form-control" value="" placeholder="number of days..." readonly>
                                        </div> -->                                         
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="eid" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="earnleave">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="earndeductionmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Earn Leave</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div><!-- action="Update_Earn_Leave_Only" -->
                                    <form method="post"  id="deductionform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                        <div class="form-group">
                                       <label>Employee </label>
                                        <input type="text" name="emname" id="emname" class="form-control" value="" readonly>
                                        <input type="hidden" name="employee" class="form-control" value="" readonly>
                                        </div> 
                                        <div class="form-group">
                                       <label>Number Of Days </label><label class="error"> *</label>
                                        <input type="number" min="0" name="day" id="day" class="form-control day" value="" required>
                                        </div> 
                                        <div class="form-group">
                                       <label>Hour </label>
                                        <input type="text" name="hour" class="form-control hour" value="" readonly>
                                        </div>                                         
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="eid" value="" class="form-control" id="recipient-name1">                                       
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="update_earn">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<script type="text/javascript">
$(document).ready(function () {
    $(".deductionmodel").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        console.log(iid);
        $('#deductionform').trigger("reset");
        $('#earndeductionmodel').modal('show');
        $.ajax({
            url: 'GetEarneBalanceByEmCode?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            console.log(response);
            // Populate the form fields with the data returned from server
			$('#deductionform').find('[name="employee"]').val(response.earnval.em_id).end();
			$('#deductionform').find('[name="emname"]').val(response.earnval.emname).end();
            $('#deductionform').find('[name="day"]').val(response.earnval.present_date).end();
            $('#deductionform').find('[name="hour"]').val(response.earnval.hour).end();
/*                                                     if (response.assetsByid.Assets_type == 'Logistic')
           $('#btnSubmit').find(':checkbox[name=type][value="Logistic"]').prop('checked', true);*/
           
		});
    });
});
</script> 
        <script type="text/javascript">
            $('.day').on('input', function() {
                var day = parseInt($('.day').val());
                console.log(hour);
                var hour = 8;
                $('.hour').val((day * hour ? day * hour : 0).toFixed(2));

            });
        </script>
        
        <script>
            $('#earnform').find('[name="enddate"]').on("change", function() {
              console.log('Yes');
              var date1 = new Date($('#earnform').find('[name="startdate"]').val());
              var date2 = new Date($('#earnform').find('[name="enddate"]').val());
              var timeDiff = Math.abs(date2.getTime() - date1.getTime());
              var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
              $('#earnform').find('[name="days"]').val(diffDays).end();
            });
        </script>
        <script type="text/javascript">
                    //save
         $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })
      $(document).on('click','#earnleave',function(){
        event.preventDefault();
           $("#earnform").valid();
        
            var emid=$("#emid").val();
            var startdate=$('#startdate').val();
            
           
        if(emid != '' && startdate != '' ){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Leave/Update_Earn_Leave");?>',
        data: new FormData($("#earnform")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#earnmodel').modal('hide');
        $(".modal-backdrop").remove();
        setTimeout(function(){
        $('#earnform')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 5000,
        position: 'top-right'
        });
         },2000);
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
        }
        },
        });
        }
     
        return false;
        }) 
      //update
       $(document).on('click','#update_earn',function(){
        event.preventDefault();
           $("#deductionform").valid();
        
            var day=$("#day").val();
           
            
           
        if(day != ''){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Leave/Update_Earn_Leave_Only");?>',
        data: new FormData($("#deductionform")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#earndeductionmodel').modal('hide');
        $(".modal-backdrop").remove();
        setTimeout(function(){
        $('#deductionform')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 5000,
        position: 'top-right'
        });
         },2000);
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
        }
        },
        });
        }
     
        return false;
        }) 
        </script>
        
<?php $this->load->view('backend/footer'); ?>