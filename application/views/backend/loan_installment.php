<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Loan Installment</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Loan Installment</li> -->
                <?php if($this->role->User_Permission('loan_installment','can_add') ){?>
                <button type="button" class="btn btn-info" style=""><i class="fa fa-plus"></i><a data-toggle="modal"
                        data-target="#loanmodel" data-whatever="@getbootstrap" class="text-white" ><i class=""
                            aria-hidden="true"></i> Add  Installment </a></button>

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
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Loan Installment
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="loan123" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                       <th>S.NO </th> 
                                       <th>Employee </th> 
                                        <th>Code</th>
                                        <th>Loan Id</th>
                                        <th>Loan Number </th>
                                        <th>Install Amount </th>
                                        <!--<th>Pay Amount</th>-->
                                        <th>Approve Date </th>
                                        <th>Receiver </th>
                                        <th>Install No </th>
                                         <?php if($this->role->User_Permission('loan_installment','can_edit') || $this->role->User_Permission('loan_installment','can_delete') ){?>
                                        <th>Action </th>
                                         <?php } ?>
                                    </tr>
                                </thead>
                            <?php if( $this->role->User_Permission('loan_installment','can_view') &&  $this->role->User_Permission('loan_installment','can_add')&&  $this->role->User_Permission('loan_installment','can_edit')){?>
                                <tbody>
                                    <?php $i = 1;
                                    foreach($installment as $value): ?>
                                    <tr>
                                         <td><?php echo $i ?></td>
                                         <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                                        <td><?php echo $value->em_code ?></td>
                                        <td><?php echo $value->loan_id ?></td>
                                        <td><?php echo $value->loan_number ?></td>
                                        <td><?php echo $value->install_amount ?></td>
                                        <!--<td><?php #echo $value->pay_amount ?></td>-->
                                        <td><?php echo date('d M Y',strtotime($value->app_date)); ?></td>
                                        <td><?php echo $value->receiver ?></td>
                                        <td><?php echo $value->install_no ?></td>
                                          <?php if($this->role->User_Permission('loan_installment','can_edit') || $this->role->User_Permission('loan_installment','can_delete') ){?>
                                        <td class="jsgrid-align-center">
                                              <?php if($this->role->User_Permission('loan_installment','can_edit')  ){?>
                                            <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light installment" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <?php } if($this->role->User_Permission('loan_installment','can_delete')   ){?>
                                           <a  title="Delete" class="btn btn-sm btn-info waves-effect waves-light noticedel text-white" data-id="<?php echo $value->id; ?>"><i  class="fa fa-trash-o"></i></a>   
                                                <?php } ?>
                                        </td>
                                         <?php } ?>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                                </tbody>  
                                    <?php }elseif($this->role->User_Permission('loan_installment','can_view')){ 

                                 $id = $this->session->userdata('user_login_id');
                                     $loan_installmentinfo = $this->loan_model->installmentSelectemp($id);
                                     $i = count($loan_installmentinfo);
                                       if(!empty( $loan_installmentinfo)){
                                    ?>    
                                <tbody>
                                    <?php $i = 1;
                                    foreach($loan_installmentinfo as $value): ?>
                                    <tr>
                                         <td><?php echo $i ?></td>
                                         <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                                        <td><?php echo $value->em_code ?></td>
                                        <td><?php echo $value->loan_id ?></td>
                                        <td><?php echo $value->loan_number ?></td>
                                        <td><?php echo $value->install_amount ?></td>
                                        <!--<td><?php #echo $value->pay_amount ?></td>-->
                                        <td><?php echo date('d M Y',strtotime($value->app_date)); ?></td>
                                        <td><?php echo $value->receiver ?></td>
                                        <td><?php echo $value->install_no ?></td>
                                          <?php if($this->role->User_Permission('loan_installment','can_edit') && $this->role->User_Permission('loan_installment','can_delete') ){?>
                                        <td class="jsgrid-align-center">
                                              <?php if($this->role->User_Permission('loan_installment','can_edit')  ){?>
                                            <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light installment" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                                        <?php } if($this->role->User_Permission('loan_installment','can_delete')   ){?>
                                            <!-- <a href="#" title="Delete" class="btn btn-sm btn-info waves-effect waves-light"><i  class="fa fa-trash-o"></i></a>  --> 
                                                <?php } ?>
                                        </td>
                                         <?php } ?>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                                </tbody>
                                <?php }}?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sample modal content -->
    <div class="modal fade" id="loanmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Loan Installment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form role="form" method="post"  id="loanvalueform"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Assign To</label><span class="error"> *</span>
                                    <select class="form-control custom-select search" 
                                        tabindex="1" name="emid" id="employee" required>
                                        <option value="">Select Here</option>
                                        <?php foreach($employee as $value): ?>
                                        <option value="<?php echo $value->em_id; ?>">
                                            <?php echo $value->first_name.' '.$value->last_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Loan Number</label>
                                    <input type="text" name="loanno" class="form-control" id="recipient-name1" readonly
                                        >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Install Amount</label>
                                    <input type="text" name="amount" class="form-control" id="amount" readonly>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Date</label><span class="error"> *</span>
                                    <input type="text" name="appdate" class="form-control mydatetimepickerFull"
                                        id="appdate" required>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Receiver</label> <span class="error"> *</span>
                                    <input type="text" name="receiver" class="form-control" id="receiver"
                                        required>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="control-label"> Install No</label>
                                    <input type="text" name="installno" class="form-control" id="installno"
                                        readonly >
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="control-label"> Notes</label>
                                    <textarea class="form-control" name="notes" id="message-text1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="loanid" value="">
                        <input type="hidden" name="id" value="">
                         <button type="submit" class="btn btn-primary" id="add_loaninstall">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <script>
    $('.amount, .period').on('input', function() {
        var amount = parseInt($('.amount').val());
        var period = parseFloat($('.period').val());
        $('.installment').val((amount / period ? amount / period : 0).toFixed(2));
    });
    </script>
    
    <script>
          //save

          $('.custom-select').on('change', function() {
            //$('input:required').remove();
            $(this).removeClass('error');
            $(this).addClass('valid');
            $(this).next('.error').css({
                display: 'none'
            });
        })
        $(document).on('click', '#add_loaninstall', function() {
            event.preventDefault();
            $("#loanvalueform").valid();
           var employee = $("#employee").val();
            var appdate = $("#appdate").val();
            var receiver = $('#receiver').val();
        
            
            if (employee != '' && appdate != ''  && receiver != '' ) {

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("Loan/Add_Loan_Installment");?>',
                    data: new FormData($("#loanvalueform")[0]),
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        var data = $.parseJSON(resp);
                        if (data.status == 'success') {

                            $('#loanmodel').modal('hide');
                            $(".modal-backdrop").remove();
                            //setTimeout(function() {
                                $('#loanvalueform')[0].reset();
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
                            $('#loanvalueform')[0].reset();
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
        //get

    $(document).ready(function() {
        $(".installment").click(function(e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#loanvalueform').trigger("reset");
            $('#loanmodel').modal('show');
            $.ajax({
                url: 'LoanByID?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                $('#loanvalueform').find('[name="id"]').val(response.loanvalueinstallment.id)
                    .end();
                $('#loanvalueform').find('[name="loanid"]').val(response.loanvalueinstallment
                    .loan_id).end();
                $('#loanvalueform').find('[name="emid"]').val(response.loanvalueinstallment
                    .emp_id).end();
                $('#loanvalueform').find('[name="loanno"]').val(response.loanvalueinstallment
                    .loan_number).end();
                $('#loanvalueform').find('[name="amount"]').val(response.loanvalueinstallment
                    .install_amount).end();
                $('#loanvalueform').find('[name="appdate"]').val(response.loanvalueinstallment
                    .app_date).end();
                $('#loanvalueform').find('[name="receiver"]').val(response.loanvalueinstallment
                    .receiver).end();
                $('#loanvalueform').find('[name="installno"]').val(response.loanvalueinstallment
                    .install_no).end();
                $('#loanvalueform').find('[name="notes"]').val(response.loanvalueinstallment
                    .notes).end();
            });
        });
    });

    $(document).ready(function() {
        $("#employee").change(function(e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = +this.value;
            //console.log(this.value);
            $("#loanvalueform").change();
            //$('#salaryform').trigger("reset");
            $.ajax({
                url: 'LoanByID?id=' + this.value,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                if (response.loanvalueem == null) {
                    $('#loanvalueform').find('[class="form-control"]').val("", "true").end();
                }
                $('#loanvalueform').find('[name="loanid"]').val(response.loanvalueem.id).end();
                $('#loanvalueform').find('[name="amount"]').val(response.loanvalueem
                    .installment).end();
                $('#loanvalueform').find('[name="loanno"]').val(response.loanvalueem
                    .loan_number).end();
                $('#loanvalueform').find('[name="installno"]').val(response.loanvalueem
                    .install_period).end();
            });
        });
    });
    </script>
    <?php $this->load->view('backend/footer'); ?>
    <script>
    $('#loan123').DataTable({
        
    });

     //delete
    $(document).on('click','.noticedel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this loan ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Loan/Loaninstalldelete') ?>',
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