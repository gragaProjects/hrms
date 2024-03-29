
<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-hourglass-1" aria-hidden="true"></i>Shift Details</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Shift Details</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
              
              <!--   <button type="button" class="btn btn-info" style="width: 100px;"><i class="fa fa-plus"></i><a data-toggle="modal"
                        data-target="#loanmodel" data-whatever="@getbootstrap" class="text-white"><i class=""
                            aria-hidden="true"></i> Add Shift </a></button> -->

            <a href="<?=base_url('Shift/ShiftManagement')?>" class="btn btn-info ">Back</a>
           
                        
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Shift List
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="table1" class="display nowrap table table-hover table-striped table-bordered loan123"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Day</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>Break In</th>
                                        <th>Break Out</th>
                                        <th>Grace Period </th>
                                        <th>Normal Hour </th>
                                        <th>Round Off Min </th>
                                        <th>Overtime </th>
                                          <?php if( $this->role->User_Permission('Shift','can_edit')){?>
                                          <th>Action </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                             
                              <tbody>
                                    <?php $i = 1;
                                    foreach($shiftdetailsselect as $value): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->day ?></td>
                                        <td><?php echo $value->clockin ?></td>
                                        <td><?php echo $value->clockout ?></td>
                                        <td><?php echo $value->breakin ?></td>
                                        <td><?php echo $value->breakout ?></td>
                                        <td><?php echo $value->grace_period ?></td>
                                        <td><?php echo $value->normal_hour ?></td>
                                        <td><?php echo $value->round_off_min ?></td>
                                        <td><?php echo $value->overtime ?></td>
                                         <?php if( $this->role->User_Permission('Shift','can_edit')){?>
                                   
                                       
                                        <td class="jsgrid-align-center">
                                      <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light loanmodalclass"
                                         data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>

                                         
                                         </td>
                                         <?php }else{
                                            echo '<td></td>';
                                         } ?>
                                    
                                    </tr>
                                    <?php $i++; endforeach; ?>
                                </tbody>                             
                            </table>
                        </div>
                    </div>
                    </div>

            </div>
        </div>
    </div>
    <?php if( $this->role->User_Permission('Shift','can_view') &&  $this->role->User_Permission('Shift','can_add') &&  $this->role->User_Permission('Shift','can_edit') &&  $this->role->User_Permission('Shift','can_delete')){?>
    <!-- sample modal content -->
    <div class="modal fade" id="loanmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Shift Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" method="post"  id="shiftform" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                   <!--      <div class="col-md-3">
                        <div class="form-group ">
                            <label class="control-label ">Day </label><span class="error"> *</span>
                            <select class="form-control custom-select search "
                                tabindex="1" name="day" id="day" required>
                                <option value="">Select Here</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                
                            </select>
                        </div>

                        </div> -->
                        <div class="col-md-3">
                        
                       <div class="form-group ">
                           <label>Clock In</label><span class="error"> *</span>
                            <div class="input-group time timepicker1" id="timepicker1">
                              <input class="form-control timepicker" type="text"  name="clockin" />
                            </div>
                        </div> 
                        
                        </div>      
                        <div class="col-md-3">
                        <div class="form-group ">
                         <label>Clock Out</label><span class="error"> *</span>
                        <div class="input-group time timepicker1" id="">
                          <input class="form-control timepicker" type="text"  name="clockout" />
                        </div>
                        </div>

                        </div>
                        <div class="col-md-3">
                        
                        <div class="form-group ">
                           <label>Break In</label><span class="error"> *</span>
                            <div class="input-group time timepicker1" id="">
                              <input class="form-control timepicker" type="text"  name="breakin" />
                            </div>
                        </div>
                        </div>
                             <div class="col-md-3">
                        
                        <div class="form-group ">
                           <label>Break Out</label><span class="error"> *</span>
                            <div class="input-group time timepicker1" id="">
                              <input class="form-control timepicker" type="text"  name="breakout" />
                            </div>
                        </div>
                        </div> 
                        </div>       
                        <div class="row">
               
                        
                        <div class="col-md-3">
                        <div class="form-group ">
                         <label>Grace Period</label><span class="error"> *</span>
                        <div class="input-group time timepicker1" id="">
                          <input class="form-control " type="number"  name="grace_period" />
                        </div>
                        </div>

                        </div>
                        <div class="col-md-3">
                        
                        <div class="form-group ">
                           <label>Normal Hour</label><span class="error"> *</span>
                            <div class="input-group time timepicker1" id="">
                              <input class="form-control " type="number"  name="normal_hour" />
                            </div>
                        </div>
                        </div>    
                        <div class="col-md-3">
                        
                        <div class="form-group ">
                           <label>Round Off Min</label><span class="error"> *</span>
                            <div class="input-group time timepicker1" id="">
                              <input class="form-control " type="number"  name="round_off_min" />
                            </div>
                        </div>
                        </div>
                       <!--  </div>   
                        <div class="row"> -->
               
                        <div class="col-md-3">
                        
                        <div class="form-group ">
                           <label>Overtime</label><span class="error"> *</span>
                            <div class="input-group time timepicker1" id="">
                              <input class="form-control " type="number"  name="overtime" />
                            </div>
                        </div>
                        </div>      
                     </div>
                 
                       
                   
                        
                     </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="shift_id" value="<?=base64_decode($this->input->get('id'))?>">
                         <button type="submit" class="btn btn-primary" id="add_details">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
   <?php }?> 
    
    <!-- /.modal -->
    <script type="text/javascript">
    $('.amount, .period').on('input', function() {
        var amount = parseInt($('.amount').val());
        var period = parseFloat($('.period').val());
        $('.installment').val((amount / period ? amount / period : 0).toFixed(2));
    });
    </script>
    
    <script type="text/javascript">
          //save

          $('.custom-select').on('change', function() {
            //$('input:required').remove();
            $(this).removeClass('error');
            $(this).addClass('valid');
            $(this).next('.error').css({
                display: 'none'
            });
        })
        $(document).on('click', '#add_details', function() {
            event.preventDefault();
            $("#shiftform").valid();

            var day = $("#day").val();
            var clockin = $("#clockin").val();
            var clockout = $('#clockout').val();
            var breakin = $("#breakin").val();
            var breakout = $("#breakout").val();
            
            if (day != '' && clockin != ''    && breakin != '' && breakout != '' ) {//

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("Shift/Add_Shift_details");?>',
                    data: new FormData($("#shiftform")[0]),
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        var data = $.parseJSON(resp);
                        if (data.status == 'success') {

                            $('#loanmodel').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#shiftform')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 1000,
                                    position: 'top-right'
                                });
                           // }, 2000);
                            setTimeout(function() {
                                location.reload(true);
                            }, 2000);
                        } else if (data.status == 'error') {
                            $('#shiftform')[0].reset();
                            $('#loanmodel').modal('hide');
                            $(".modal-backdrop").remove();

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

        // get modal
    $(document).ready(function() {
        $(".loanmodalclass").click(function(e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#shiftform').trigger("reset");
            $('#loanmodel').modal('show');
            $.ajax({
                url: 'ShiftByID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
              

                   //$("#day option[value="+response.shiftvalue.day+"]").prop('selected', true);
               
                // Populate the form fields with the data returned from server
                $('#shiftform').find('[name="day"]').val(response.shiftvalue.day).end();
                $('#shiftform').find('[name="id"]').val(response.shiftvalue.id).end();
                $('#id').val(response.shiftvalue.id).end();
                $('#shiftform').find('[name="clockin"]').val(response.shiftvalue.clockin)
                    .end();
                $('#shiftform').find('[name="clockout"]').val(response.shiftvalue.clockout)
                    .end();
                $('#shiftform').find('[name="breakin"]').val(response.shiftvalue.breakin)
                    .end();
                $('#shiftform').find('[name="breakout"]').val(response.shiftvalue.breakout).end();
                /* $('#shiftform').find('[name="interest"]').val(response.shiftvalue.interest_percentage).end();*/
                $('#shiftform').find('[name="grace_period"]').val(response.shiftvalue.grace_period)
                    .end();
                $('#shiftform').find('[name="normal_hour"]').val(response.shiftvalue.normal_hour)
                    .end();
                $('#shiftform').find('[name="round_off_min"]').val(response.shiftvalue.round_off_min)
                .end();
                $('#shiftform').find('[name="overtime"]').val(response.shiftvalue.overtime).end();
            });
        });
    });
    </script>


    <script>
    $(document).ready(function () {
    $('#example3').DataTable({
     
          "initComplete": function (settings, json) {  
            $("#example3").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    }); 
    $('#table1').DataTable({
     
          "initComplete": function (settings, json) {  
            $("#table1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    });
  });
     
       
    </script>
   <?php $this->load->view('backend/footer'); ?>
    <script>
  $(document).ready(function() {
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
    });
</script>