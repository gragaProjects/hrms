
<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Invoice</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-university" aria-hidden="true"></i> Invoice</li> -->
                    </ol>
                </div>
            </div>
            <style type="text/css">
                table.table.table-hover thead{
                    background-color: #e8e8e8;
                }
       
    
                   .table-bordered td, .table-bordered th {
                        border: 1px solid #263238 !important;
                        color: black;
                        font-size: 15px;
                    }
                    table td, .table th {
                        /* //border: 1px solid #263238 !important;
                        //border-color: #263238 !important; */
                        padding: 5px !important;
                    }
                    tr td:nth-child(even) {
                        color: black;
                        font-weight: bold;
                    }
                    table td {
                        width: 15%;
                    }
                                    
            </style>
            <div class="container">
                <div class="row m-b-10"> 
                    <div class="col-12">

                        <button type="button" class="btn btn-primary"><i class="fa fa-bars"></i><a href="<?php echo base_url(); ?>Payroll/Salary_List" class="text-white"><i class="" aria-hidden="true"></i>  Back</a></button>
                        <a type="button" class="btn btn-primary "  href="<?php echo base_url(); ?>Payroll/Pdf?Id=<?php echo $this->input->get('Id') ?>&em=<?php echo $this->input->get('em'); ?>"><i class="fa fa-print"></i><i class="" aria-hidden="true" ></i>  Print</a><!-- onclick="printDiv()" --> <!-- print_payslip_btn -->
                    </div><!-- ?emid=<?=$this->input->get('em')?> -->
                </div> 
                  <!--// assets/images/dri_Logo.png -->
                 
                <div class="row payslip_print" id="payslip_print">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card card-body "><!--  style="border: 5px solid black;" -->
                            <div class="row">
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                    <!-- <img src="<?php echo base_url();?>/assets/images/logo/logo1.png" style=" width:180px; margin-right: 10px;" /> -->
                                </div>
                           <!--      <div class="col-md-6 col-xs-6 col-sm-6 text-left payslip_address">
                                    <p>
                                        <?php echo $settingsvalue->address; ?>   <?php echo $settingsvalue->address2; ?>
                                    </p>
                                    <p>
                                        <?php  ?>
                                    </p>
                                    <p>
                                        Phone: <?php echo $settingsvalue->contact; ?>, Email: <?php echo $settingsvalue->system_email; ?>
                                    </p>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h5 style="margin-top: 15px;">PAY SLIP (<?php echo date('M', strtotime($salary_info->month)) .'-'.$salary_info->year ?>)</h5>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-md-12"><!-- 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php $obj_merged = (object) array_merge((array) $employee_info, (array) $salaryvaluebyid, (array) $salarypaybyid, (array) $salaryvalue, (array) $loanvaluebyid);  ?>
                                            
                                        </div>
                                    </div> --><!-- table-condensed borderless -->
                                    <table class="table table-bordered  payslip_info table-responsive">
                                        <tr>
                                            <td>Employee No</td>
                                            <td><?php echo $obj_merged->em_code; ?></td>
                                            <td>Employee Name</td>
                                            <td><?php echo $obj_merged->first_name; ?> <?php  echo $obj_merged->last_name; ?></td>
                                            <td>Department</td>
                                            <td> <?php echo $otherInfo[0]->dep_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nationality</td>
                                            <td> <?php echo $otherInfo[0]->nationality;?></td>
                                            <td>Designation</td>
                                            <td> <?php echo $otherInfo[0]->designation; ?></td>
                                            <td>Location</td>
                                            <td> <?php echo $otherInfo[0]->city; ?></td>
                                           
                                        </tr>
                                        
                                        <tr>
                                            <td>Total No of Days</td>
                                            <td> <?php echo date('t',strtotime($salary_info->month)); ?></td>
                                            <td>Total Working Days</td>
                                            <td> 
                                                <?php
                                                   $days = ceil($salary_info->total_days / 8);
                                                   echo $days;
                                                ?>
                                            </td>

                                            <td>Total Absent Days</td>
                                            <td><?php echo date('t',strtotime($salary_info->month)) - $days  ?></td>
                                        </tr>
                               
                                    </table>
                                </div>
                            </div>
                            <style>
                                .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td { padding: 2px 5px; }
                            </style>
                            <div class="row">
                                <div class="col-md-12"><!-- table-condensed borderless -->
                                    <table class="table table-bordered " style="border-left: 1px solid #ececec;">
                                        <thead class="thead-light" style="border: 1px solid #ececec;">
                                            <tr>
                                                <th colspan="2"class="text-center"  style="width:30%">Earnings</th>
                                
                                                <th colspan="2"  class="text-center"  style="width:30%">Allowance</th>
                                                <th  colspan="2" class="text-center"  style="width:30%">Deductions</th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #ececec;">
                                            <tr>
                                                <td>Basic Salary</td>
                                                <td class="text-right"><?php echo $addition[0]->basic; ?> <!-- BDT --><?php echo $salarycurrencytype->currency_symbol;?>  </td>
                                                <td class="">Internet Allowance</td>
                                                <td class="text-right"></td>
                                                <td class="">Loan</td>
                                                <td class="text-right"><?php if(!empty($salary_info->loan)) {
                                                    echo $salary_info->loan .$salarycurrencytype->currency_symbol;
                                                } ?> </td>
                                            </tr>
                                     
                                            <tr>
                                                <td>HRA</td>
                                                <td class="text-right"><?php echo $addition[0]->house_rent; ?>  <?php echo $salarycurrencytype->currency_symbol;?></td>
                                              <td class="">Madical Allowance</td>
                                                <td class="text-right"><?php echo $addition[0]->medical; ?>  <?php echo $salarycurrencytype->currency_symbol;?></td>
                                                <td class="">Salary Advance</td>
                                                <td class="text-right">  </td>
                                            </tr>
                                            <tr>
                                             
                                                <td>Arrears</td>
                                                <td class="text-right"></td>
                                                  <td class="">Transportation</td>
                                                <td class="text-right"> </td>
                                               
                                                <td class="">Unpaid Leave </td>
                                                <td class="text-right">  </td>
                                            </tr>
                                                  <tr>
                                             
                                                <td></td>
                                                <td class="text-right"><?php echo $salary_info->bonus; ?></td>
                                                  <td class="">Others</td>
                                                <td class="text-right">  </td>
                                               
                                                <td class="">Other Deduction </td>
                                                <td class="text-right">  </td>
                                            </tr>
                                     
                                 <!--            <tr>
                                            <td>Working Hour (<?php echo $salary_info->total_days; ?> hrs)</td>
                                               <td class="text-right">  </td>
                                                <td class="text-right"> </td>
                                                <td class="text-right">
                                                    <?php
                                                        if($a > 0) { echo round($a,2).$salarycurrencytype->currency_symbol;//' BDT';
                                                         }
                                                    ?>
                                                </td>
                                                <td class="text-right">  </td>
                                               <td class="text-right">
                                                    <?php
                                                        if($wd > 0) { echo round($wd,2).$salarycurrencytype->currency_symbol;//' BDT';
                                                         }
                                                    ?>        
                                                </td>
                                              
                                               
                                            </tr> -->
                                    
                                            <tr>
                                                <td></td>
                                                <td class="text-right"> </td>
                                                <td class="text-right"> </td>
                                                <td class="text-right">  </td>
                                                <td > Tax</td>
                                                <td class="text-right">  </td>
                                                
                                            </tr>
                                        </tbody>
                                        <tfoot class="tfoot-light">
                                            <tr>
                                                <th>Total Salary</th>
                                                <th class="text-right"><?php $total_add = $salary_info->basic + $salary_info->medical + $salary_info->house_rent + $salary_info->bonus+$a; echo round($total_add,2); ?> <?php echo $salarycurrencytype->currency_symbol;?></th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class=""> Total Deduction </th>
                                                <th class="text-right"><?php echo round($d,2).$salarycurrencytype->currency_symbol;?>  </th>
                                            </tr>
                                            <tr>
                                               
                                                <th class="" style="border: none !important">Net Pay</th>
                                                <th class="text-right"  style="border: none !important;"><?php echo $salary_info->total_pay/*round($total_add - $total_did,2)*/; ?> <?php echo $salarycurrencytype->currency_symbol;?></th>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal fade" id="Salarymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Salary Form</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form method="post" action="Add_Salary" id="salaryform" enctype="multipart/form-data">
                            <div class="modal-body">
                                    <!--   <div class="form-group">
                                        <label>Salary Type</label>
                                        <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="typeid" required>
                                            <?php #foreach($typevalue as $value): ?>
                                            <option value="<?php #echo $value->id ?>"><?php #echo $value->salary_type; ?></option>
                                            <?php #endforeach; ?>
                                        </select>
                                    </div> -->                                        
                                    <div class="form-group">
                                        <label class="control-label">Employee Id</label>
                                        <input type="text" name="emid" class="form-control" id="recipient-name1" value="" readonly>
                                    </div>                                         
                                    <div class="form-group">
                                        <label class="control-label">Basic</label>
                                        <input type="text" name="basic" class="form-control" id="recipient-name1" value="">
                                    </div>
                                    <h4>Addition</h4>                                         
                                    <div class="form-group">
                                        <label class="control-label">Medical</label>
                                        <input type="text" name="medical" class="form-control" id="recipient-name1"  value="">
                                    </div>                                         
                                    <div class="form-group">
                                        <label class="control-label">House Rent</label>
                                        <input type="text" name="houserent" class="form-control" id="recipient-name1" value="">
                                    </div>                                         
                                    <div class="form-group">
                                        <label class="control-label">Bonus</label>
                                        <input type="text" name="bonus" class="form-control" id="recipient-name1" value="">
                                    </div>
                                    <h4>Deduction</h4>                                         
                                    <div class="form-group">
                                        <label class="control-label">Provident Fund</label>
                                        <input type="text" name="provident" class="form-control" id="recipient-name1" value="">
                                    </div>                                         
                                    <div class="form-group">
                                        <label class="control-label">Bima</label>
                                        <input type="text" name="bima" class="form-control" id="recipient-name1" value="" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tax</label>
                                        <input type="text" name="tax" class="form-control" id="recipient-name1"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Others</label>
                                        <input type="text" name="others" class="form-control" id="recipient-name1"  value="">
                                    </div>                                          
                                
                            </div>
                            <div class="modal-footer">                                       
                            <input type="hidden" name="sid" value="" class="form-control" id="recipient-name1">                                       
                            <input type="hidden" name="aid" value="" class="form-control" id="recipient-name1">                                       
                            <input type="hidden" name="did" value="" class="form-control" id="recipient-name1">                                       
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".SalarylistModal").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#salaryform').trigger("reset");
            $('#Salarymodel').modal('show');
            $.ajax({
                url: 'GetSallaryById?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                console.log(response);
                // Populate the form fields with the data returned from server
                $('#salaryform').find('[name="sid"]').val(response.salaryvalue.id).end();
                $('#salaryform').find('[name="aid"]').val(response.salaryvalue.addi_id).end();
                $('#salaryform').find('[name="did"]').val(response.salaryvalue.de_id).end();
               /* $('#salaryform').find('[name="typeid"]').val(response.salaryvalue.type_id).end();*/
                $('#salaryform').find('[name="emid"]').val(response.salaryvalue.emp_id).end();
                $('#salaryform').find('[name="basic"]').val(response.salaryvalue.basic).end();
                $('#salaryform').find('[name="medical"]').val(response.salaryvalue.medical).end();
                $('#salaryform').find('[name="houserent"]').val(response.salaryvalue.house_rent).end();
                $('#salaryform').find('[name="bonus"]').val(response.salaryvalue.bonus).end();
                $('#salaryform').find('[name="provident"]').val(response.salaryvalue.provident_fund).end();
                $('#salaryform').find('[name="bima"]').val(response.salaryvalue.bima).end();
                $('#salaryform').find('[name="tax"]').val(response.salaryvalue.tax).end();
                $('#salaryform').find('[name="others"]').val(response.salaryvalue.others).end();
            });
        });
    });
</script>    
    <script src="<?php echo base_url(); ?>assets/js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $(".print_payslip_btn").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.payslip_print").printArea(options);
        });
    });
    </script>                          
<?php $this->load->view('backend/footer'); ?>