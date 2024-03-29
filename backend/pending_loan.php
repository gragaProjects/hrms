<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-hourglass-1" aria-hidden="true"></i> Pending Loan</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Pending Loan</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                <?php if($this->role->User_Permission('apply_loan','can_add') ){?>
                <button type="button" class="btn btn-info" style="width: 100px;"><i class="fa fa-plus"></i><a data-toggle="modal"
                        data-target="#loanmodel" data-whatever="@getbootstrap" class="text-white"><i class=""
                            aria-hidden="true"></i> Add Loan </a></button>
           
                 <?php } ?>       
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Pending Loan 
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="table1" class="display nowrap table table-hover table-striped table-bordered loan123"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Employee</th>
                                        <th>Code</th>
                                        <th>Amount</th>
                                        <!--  <th>Interest Percentage </th>
                                            <th>Installment Period </th>-->
                                        <th>Installment </th>
                                        <th>Total Pay </th>
                                        <th>Total Due </th>
                                        <th>Apply Date </th>
                                        <th>Loan Status </th>
                                  
                                           <?php if( $this->role->User_Permission('apply_loan','can_edit')){?>
                                          <th>Action </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                              <?php if( $this->role->User_Permission('apply_loan','can_view') &&  $this->role->User_Permission('apply_loan','can_add') &&  $this->role->User_Permission('apply_loan','can_edit')){?>
                                <tbody>
                                    <?php $i = 1;
                                    foreach($loanview as $value): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                                        <td><?php echo $value->em_code ?></td>
                                        <td><?php echo $value->amount ?></td>
                                        <td><?php echo $value->installment ?></td>
                                        <td><?php echo $value->total_pay ?></td>
                                        <td><?php echo $value->total_due ?></td>
                                        <td><?php echo date('d  M Y',strtotime($value->approve_date)) ?></td>
                                        <td><?php echo $value->status ?></td>
                                         <?php if( $this->role->User_Permission('apply_loan','can_edit')){?>
                                      
                                         <?php if($value->hr_status == 'Granted' && $value->status == 'Pending'){?>
                                       
                                        <td class="jsgrid-align-center">
                                            <a href="#" title="Edit"
                                                class="btn btn-sm btn-info waves-effect waves-light loanmodalclass"
                                                data-id="<?php echo $value->id; ?>"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                            

                                              <a href="" title="Approve" class="btn btn-sm btn-info waves-effect waves-light adminStatus" data-employeeId="<?php echo $value->em_id; ?>"  data-employeeId="<?php echo $value->id; ?>" data-id="<?php echo $value->id; ?>" data-value1="Granted" >Approve</a>       
                                            <a href="" title="Reject" class="btn btn-sm btn-info waves-effect waves-light  adminStatus"  data-value1="Deny"  data-employeeId="<?php echo $value->id; ?>" data-id="<?php echo $value->id; ?>" >Reject</a>

                                        </td>
                                         <?php }else{
                                            echo '<td></td>';
                                         } ?>
                                         <?php } ?>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if( $this->role->User_Permission('apply_loan','can_view') &&  $this->role->User_Permission('apply_loan','can_add') &&  $this->role->User_Permission('apply_loan','can_edit') &&  $this->role->User_Permission('apply_loan','can_delete')){?>
    <!-- sample modal content -->
    <div class="modal fade" id="loanmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Loan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" method="post" action="Add_Loan" id="loanform" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label ">Assign To</label><span class="error"> *</span>
                            <select class="form-control custom-select search "
                                tabindex="1" name="emid" id="emid" required>
                                <option value="">Select Employee</option>
                                <?php foreach($employee as $value): ?>
                                <option value="<?php echo $value->em_id; ?>">
                                    <?php echo $value->first_name.' '.$value->last_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        </div>
                        <div class="col-md-6">
                        
                        <div class="form-group ">
                            <label for="message-text" class="control-label ">Amount</label><span class="error"> *</span>
                            <input type="text" name="amount"  class="form-control  amount"
                                id="amount" required>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                     <div class="form-group ">
                            <label class="control-label ">Apply Date</label><span class="error"> *</span>
                            <input type="text" name="appdate" class="form-control  mydatetimepickerFull"
                                id="appdate" value="<?php echo date('d-m-Y'); ?>" required readonly>
                        </div>
                        
                        
                        </div>
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="message-text" class="control-label ">Install Period</label><span class="error"> *</span>
                            <input type="number" name="install" value="" class="form-control  period"
                                id="install" required>
                        </div>

                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="message-text" class="control-label ">Install Amount</label>
                            <input type="number" name="installment" value="" class="form-control  installment"
                                id="installment" readonly>
                        </div>
                        
                        </div>
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="message-text" class="control-label "> Loan No</label>
                            <input type="text" name="loanno" value="<?php echo rand(100000,56000000)?>"
                                class="form-control " id="loanno" readonly>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                    <!--     <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label ">Status</label><span class="error"> *</span>
                            <select class="form-control custom-select " 
                                tabindex="1" name="status" id="status" value="" required>
                                <option value="">Select here</option>
                                <option value="Granted">Granted</option>
                                <option value="Deny">Deny</option>
                              
                            </select>
                        </div>
                        </div> -->
                        <div class="col-md-6">
                          <div class="form-group ">
                            <label for="message-text" class="control-label ">Loan Details</label>
                            <textarea class="form-control " name="details" value=""
                                id="details"></textarea>
                        </div>
                        </div>
                        </div>
                       <!--       <div class="form-group ">
                                <label for="message-text" class="control-label ">Interest Percentage</label>
                                <input type="number" name="interest" value="" class="form-control " id="recipient-name1" required>
                            </div>-->
                        
                     </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="">
                         <button type="submit" class="btn btn-primary" id="add_loan">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
   <?php }?> 
    <?php if( $this->role->User_Permission('apply_loan','can_view') &&  $this->role->User_Permission('apply_loan','can_add') ){
         
         $id = $this->session->userdata('user_login_id');
          $basicinfo = $this->employee_model->GetBasic($id);
        ?>
    <!-- sample modal content -->
    <div class="modal fade" id="loanmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Loan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" method="post" action="Add_Loan" id="loanform" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label ">Assign To</label><span class="error"> *</span>
                           <!--<select class="form-control custom-select search "
                                tabindex="1" name="emid" id="emid" required>
                                <option value="">Select Employee</option>
                                <?php foreach($employee as $value): ?>
                                <option value="<?php echo $value->em_id; ?>">
                                    <?php echo $value->first_name.' '.$value->last_name; ?></option>
                                <?php endforeach; ?>
                            </select> -->
                             <select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emid" id="emid" required>
                                       <option value="<?php echo $basicinfo->em_id ?>" selected><?php echo $basicinfo->first_name.' '.$basicinfo->last_name?></option>
                                       
                             </select>
                        </div>

                        </div>
                        <div class="col-md-6">
                        
                        <div class="form-group ">
                            <label for="message-text" class="control-label ">Amount</label><span class="error"> *</span>
                            <input type="text" name="amount"  class="form-control  amount"
                                id="amount" required>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                         <div class="form-group ">
                            <label class="control-label ">Apply Date</label><span class="error"> *</span>
                            <input type="text" name="appdate" class="form-control  mydatetimepickerFull"
                                id="appdate" value="<?php echo date('d-m-Y'); ?>" required readonly>
                        </div>
                        
                        </div>
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="message-text" class="control-label ">Install Period</label><span class="error"> *</span>
                            <input type="number" name="install" value="" class="form-control  period"
                                id="install" required>
                        </div>

                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="message-text" class="control-label ">Install Amount</label>
                            <input type="number" name="installment" value="" class="form-control  installment"
                                id="installment" readonly>
                        </div>
                        
                        </div>
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="message-text" class="control-label "> Loan No</label>
                            <input type="text" name="loanno" value="<?php echo rand(100000,56000000)?>"
                                class="form-control " id="loanno" readonly>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                     <!--    <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label ">Status</label><span class="error"> *</span>
                            <select class="form-control custom-select " data-placeholder="Choose a Category"
                                tabindex="1" name="status" id="status" value="" required>
                                <option value="">Select here</option>
                                <option value="Granted">Granted</option>
                                <option value="Deny">Deny</option>
                             
                            </select>
                        </div>
                        </div> -->
                        <div class="col-md-6">
                          <div class="form-group ">
                            <label for="message-text" class="control-label ">Loan Details</label>
                            <textarea class="form-control " name="details" value=""
                                id="details"></textarea>
                        </div>
                        </div>
                        </div>
                       <!--       <div class="form-group ">
                                <label for="message-text" class="control-label ">Interest Percentage</label>
                                <input type="number" name="interest" value="" class="form-control " id="recipient-name1" required>
                            </div>-->
                        
                     </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="">
                         <button type="submit" class="btn btn-primary" id="add_loan">Submit</button>
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
        $(document).on('click', '#add_loan', function() {
            event.preventDefault();
            $("#loanform").valid();

            var emid = $("#emid").val();
            var amount = $("#amount").val();
            var appdate = $('#appdate').val();
            var install = $("#install").val();
            var status = $("#status").val();
            
            if (emid != '' && amount != ''  && appdate != ''  && install != '' ) {//&& status != ''

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("Loan/Add_Loan");?>',
                    data: new FormData($("#loanform")[0]),
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        var data = $.parseJSON(resp);
                        if (data.status == 'success') {

                            $('#loanmodel').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#loanform')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 5000,
                                    position: 'top-right'
                                });
                           // }, 2000);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                        } else if (data.status == 'error') {
                            $('#loanform')[0].reset();
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
            $('#loanform').trigger("reset");
            $('#loanmodel').modal('show');
            $.ajax({
                url: 'LoanByID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                $('#loanform').find('[name="emid"]').val(response.loanvalue.emp_id).end();
                $('#loanform').find('[name="id"]').val(response.loanvalue.id).end();
                $('#loanform').find('[name="details"]').val(response.loanvalue.loan_details)
                    .end();
                $('#loanform').find('[name="appdate"]').val(response.loanvalue.approve_date)
                    .end();
                $('#loanform').find('[name="redate"]').val(response.loanvalue.repayment_from)
                    .end();
                $('#loanform').find('[name="amount"]').val(response.loanvalue.amount).end();
                /* $('#loanform').find('[name="interest"]').val(response.loanvalue.interest_percentage).end();*/
                $('#loanform').find('[name="install"]').val(response.loanvalue.install_period)
                    .end();
                $('#loanform').find('[name="installment"]').val(response.loanvalue.installment)
                    .end();
                $('#loanform').find('[name="loanno"]').val(response.loanvalue.loan_number)
                .end();
                $('#loanform').find('[name="status"]').val(response.loanvalue.status).end();
            });
        });
    });
    </script>

    <?php $this->load->view('backend/footer'); ?>
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
     

     /*hr approval*/
   $(".hrStatus").on("click", function(event){
      event.preventDefault();
     
      $.ajax({
          url: '<?php echo base_url("Loan/hrapproveStatus");?>',
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value1'),
             
          },
          success: function(response) {
               var data=$.parseJSON(response);
            if(data.status == 'success'){

            $.wnoty({
            type: 'success',
            message: data.message,
            autohideDelay: 1000,
            position: 'top-right'
            });
            
            window.setTimeout(function(){location.reload()}, 2000);
          }
          },
          error: function(response) {
            console.error();
          }
      });
  });         
    /*admin approval*/
   $(".adminStatus").on("click", function(event){
      event.preventDefault();
     
      $.ajax({
          url: "adminapproveStatus",
          type:"POST",
          data:
          {
              'employeeId': $(this).attr('data-employeeId'),
              'lid': $(this).attr('data-id'),
              'lvalue': $(this).attr('data-value1'),
             
          },
          success: function(response) {
               var data=$.parseJSON(response);
            if(data.status == 'success'){

            $.wnoty({
            type: 'success',
            message: data.message,
            autohideDelay: 1000,
            position: 'top-right'
            });
            
            window.setTimeout(function(){location.reload()}, 2000);
          }
          },
          error: function(response) {
            //console.error();
          }
      });
  });           
    </script>