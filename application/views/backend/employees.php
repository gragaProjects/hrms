<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<style type="text/css">
    .table{
    margin-bottom:0px!important;
}

</style>
        <?php   $eid = $this->session->userdata('user_login_id'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-user-circle-o " aria-hidden="true"></i><?php  if($this->role->User_Permission('employee_list','can_view') && $this->role->User_Permission('disciplinary','can_view')&& $this->role->User_Permission('inactive_user','can_view') && !$this->dashboard_model->Emplist_teamhead($eid)){?> Employees <?php }else{ ?> My Profile <?php } ?> </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><?php  if($this->role->User_Permission('employee_list','can_view') && $this->role->User_Permission('disciplinary','can_view')&& $this->role->User_Permission('inactive_user','can_view') && !$this->dashboard_model->Emplist_teamhead($eid)){?> Employees <?php }else{ ?> My Profile <?php } ?></li> -->
                        <?php if($this->role->User_Permission('employee_list','can_add')){?>
                        <button type="button" class="btn btn-info" style=""><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>employee/Add_employee" class="text-white"><i class="" aria-hidden="true"></i> Add Employee</a></button>
                     
                        <!--  <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 130px;">Cancel</a> -->
                         <?php }?>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                     

                            <!-- <button type="button" class="btn btn-info" style=""><i class="fa fa-navicon"></i><a href="<?php echo base_url(); ?>employee/Employee_holidays" class="text-white"><i class="" aria-hidden="true"></i> Holidays List</a></button> -->
                      
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;<i class="fa fa-user-o" aria-hidden="true"></i> <?php  if($this->role->User_Permission('employee_list','can_view') && $this->role->User_Permission('disciplinary','can_view')&& $this->role->User_Permission('inactive_user','can_view') && !$this->dashboard_model->Emplist_teamhead($eid)){?> Employee List <?php }else{ ?> My Profile <?php } ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered " cellspacing="0" width="100%" >
                                        <thead>
                                            <tr>
                                                <th>S.NO</th>
                                                <th>Employee </th>
                                                <th>Code</th><!-- PIN -->
                                                <th>Email </th>
                                                <th>Contact </th>
                                                <th>User Type</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                      <!--  -->
                                        <?php if($this->role->User_Permission('employee_list','can_view') && $this->role->User_Permission('employee_list','can_add') && $this->role->User_Permission('employee_list','can_edit')){?>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                           foreach($employee as $value): ?>
                                            <tr>
                                                  <td><?php echo $i; ?></td>
                                                <td title="<?php echo $value->first_name .' '.$value->last_name; ?>"><?php echo $value->first_name .' '.$value->last_name; ?></td>
                                                <td><?php echo $value->em_code; ?></td>
                                                <td><?php echo $value->em_email; ?></td>
                                                <td><?php echo $value->em_phone; ?></td>
                                               <td><?php if($value->em_role)
                                               {$id = $value->em_role;
                                                $data = $this->employee_model->matchrole($id); 
                                                if($data){echo $data->role;}} ?></td>
                                                <td class="jsgrid-align-center ">
                                                      <?php if($this->role->User_Permission('employee_list','can_edit')){?>
                                                    <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($value->em_id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>


                                                    <?php }?>
                                               <a href="<?php echo base_url(); ?>employee/Disciplinary" class="btn btn-sm btn-info waves-effect waves-light" title="Disciplinary"><i class="fa fa-user-o"></i></a>

                                             <!-- Appointment  -->
                                                     <!-- <a href="<?php echo base_url(); ?>Employee/CertificatePdf?em=<?php echo $value->em_id;?>" title="Appointment Letter" class="btn btn-sm btn-info waves-effect waves-light" target="_blank"><i class="fa fa-print"></i></a>  -->
                                                    <!-- Generate Appointment  -->
                                                 <a href="" data-toggle="modal" data-target="#supportmodel" data-whatever="@getbootstrap"  title="Generate Appointment Letter"  class="btn btn-sm btn-info waves-effect waves-light add_appointmentbtn " data-id="<?php echo $value->id; ?>" data-emp_id = '<?php echo $value->em_id;?>' data-busunit = '<?php echo $value->busunit;?>'><i class="fa fa-plus"></i></a>


                                               </td>




                                            </tr>
                                            <?php   $i++;
                                             endforeach; ?>
                                        </tbody>
                                        <?php }elseif ($this->role->User_Permission('employee_list','can_view')) {
                                         $id = $this->session->userdata('user_login_id');
                                         $basicinfo = $this->employee_model->GetBasic($id);
                                         $i = count($basicinfo);
                                        ?>
                                        <tbody>
                                             <tr>
                                                <td><?php echo $i; ?></td>
                                                <td title="<?php echo $basicinfo->first_name .' '.$basicinfo->last_name; ?>">
                                                    <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>"><?php echo $basicinfo->first_name .' '.$basicinfo->last_name; ?></a></td>
                                                <td><?php echo $basicinfo->em_code; ?></td>
                                                <td><?php echo $basicinfo->em_email; ?></td>
                                                <td><?php echo $basicinfo->em_phone; ?></td>
                                               <td><?php if($basicinfo->em_role)
                                               {$id = $basicinfo->em_role;
                                                $data = $this->employee_model->matchrole($id); 
                                                if($data){echo $data->role;}} ?></td>
                                                <td class="jsgrid-align-center ">
                                                      <?php if($this->role->User_Permission('employee_list','can_edit')){?>
                                                    <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                    <?php }?>
                                               <a href="<?php echo base_url(); ?>employee/Disciplinary" class="btn btn-sm btn-info waves-effect waves-light" title="Disciplinary"><i class="fa fa-user-o"></i></a>
                                               


                                               </td>
                                            </tr>
                                        </tbody>

                                        <?php }?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                   <!-- sample modal content -->
                <!--         <div class="modal fade" id="supportmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1"> Create Appointment Letter </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="" id="appointmentform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                           <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <label class="control-label">Employee Name</label><span class="error"> *</span>
                                                <select class="select2 form-control custom-select search"  tabindex="1" name="employee_name" id="employee_name" style="width: 100%" required>
                                                 
                                                </select>
                                                 <label id="assignval-error" class="error" for="assignval" style="display:none;">This field is required.</label>
                                            </div> 

                                            </div>
                                    
          
                                           <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <input type="text" name="position" class="form-control" id="position" value="" >
                                                  
                                            </div>
                                            </div>  
                                            <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Place of work</label>
                                                                                            <input type="text" name="place_of_work" class="form-control" id="place_of_work" value="" placeholder="Work from office/home">
                                            
                                                  
                                            </div>
                                            </div>
                                         
                                            <div class="col-md-4">                                        
                                            <div class="form-group">
                                                <label class="control-label">Joining Date</label><span class="error"> </span>
                                                <input type="text" name="joining_date" id="joining_date" class="form-control mydatetimepickerdate" value="" >
                                            </div>                                         
                                            </div> 
                                         
                                     
                                                
                                             <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Basic <small></small></label>
                                                <input type="text" name="basic" class="form-control" id="basic" value="">
                                                   
                                            </div>
                                            </div>  
                                            <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">HRA  <small></small></label>
                                                <input type="text" name="hra" class="form-control" id="hra" value="" >
                                                   
                                            </div>
                                            </div>     
                                             <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Conveyance </label>
                                                <input type="text" name="conveyance" class="form-control" id="conveyance" value="" >
                                                   
                                            </div>
                                            </div> 
                                            <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Other Benefits <small>(Allowance)</small></label>
                                                <input type="text" name="other_benefits" class="form-control" id="other_benefits" value="" >
                                                   
                                            </div>
                                            </div> 
                                            <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Total Gross Salary<small>(Monthly)</small></label>
                                                <input type="text" name="total_gross_salary_monthly" class="form-control" id="total_gross_salary_monthly" value="" >
                                                   
                                            </div>
                                            </div>  
                                            <div class="col-md-4"> 

                                            <div class="form-group">
                                                <label class="control-label">Total Gross Salary<small>(Annually)</small></label>
                                                <input type="text" name="total_gross_salary_annually" class="form-control" id="total_gross_salary_annually" value="" >
                                                   
                                            </div>
                                            </div>
                                          
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <textarea class="form-control "  name="address" id="address" ></textarea>
                                               
                                            </div>                                            
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    
                                        <input type="hidden" name="emp_id">
                                        <input type="hidden" name="busunit_id">
                                        <input type="hidden" name="id">
                                        <button type="submit" class="btn btn-primary" id="add_appointment">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>   -->



                         <div class="modal fade" id="supportmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1"> Create Appointment Letter <span id="appointmentemployee"></span></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="" id="appointmentform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                    <div class="row">
                                    <div class="form-group  col-md-4">
                                    <label class="control-label">Select Template</label><span class="error"> *</span>
                                    <select class="select2 form-control custom-select search" tabindex="1" name="template_id" id="template_id" style="width: 100%" required>
                                        <option value="">Select Template</option>
                                        
                                       <!--  <?php foreach ($templates as $template): ?>
                                            <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
                                        <?php endforeach; ?> -->
                                    </select>
                                    <label id="template-error" class="error" style="display:none;">This field is required.</label>
                                  </div>
                                     <div class="form-group  col-md-4" >
                                     <label class="control-label"></label>
                                      <div id="pdf"></div>
                                      </div>
                                  </div>
                                  <div id="dynamicInputFields" class="row">
                                   
                                </div>
                                    </div>
                                    <div class="modal-footer">
                                     <!--   <input type="hidden" name="assid" value=""> -->
                                        <input type="hidden" name="emp_id">
                                        <input type="hidden" name="busunit_id">
                                        <input type="hidden" name="id">
                                        <button type="submit" class="btn btn-primary" id="add_appointment">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<?php $this->load->view('backend/footer'); ?>
<script>
  $(document).ready(function() {
   
    $('#employees123').DataTable({
       // "aaSorting": [[1,'asc']],
       //scrollY: '50vh',
        "scrollY": "50vh",
        "scrollCollapse": true,
        "pageLength": 50,
         "ordering": false,
          "scrollX": true,
         "scroller": true,
       dom: 'Bfrtip',
        buttons: [
         
               {
                extend: 'excel'  ,
                exportOptions: {
                    columns: [ 0, 1, 2, 4 ]
                }
              }, 
              {
                extend: 'pdfHtml5',
                header: true,
                footer: true,
                download : 'open',
                exportOptions: {
                    columns: [ 0, 1, 2, 4 ]
                },
             customize: function (doc) {
                        
                        //Remove the title created by datatTables
                        //doc.content.splice(0,1);
                        var now = new Date();
                        var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                       
                        doc.pageMargins = [20,60,20,30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 10;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 7;
                        doc.content[1].table.widths = [90,90,90,90,90,90,90,90];
                       /* doc.content[1].table.widths = [ '2%',  '14%', '14%', '14%', 
                                                           '14%', '14%', '14%', '14%'];*/
                  
                        doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        
                       
                        doc['header']=(function() {
                            return {
                                columns: [
                               /*    // {
                                        image: logo,
                                        width: 24
                                   // },*/
                                    {
                                        alignment: 'center',
                                        italics: true,
                                        text: '',
                                        fontSize: 18,
                                        margin: [10,0]
                                    },
                                    {
                                        alignment: 'center',
                                        fontSize: 14,
                                        text: ''
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Created on: ', { text: jsDate.toString() }],
                                        fontSize: 10,
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                                        fontSize: 10,
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below

                        doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) { return .5; };
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function(i) { return 4; };
                        objLayout['paddingRight'] = function(i) { return 4; };
                        doc.content[0].layout = objLayout;
                }
              }, 
               
             

        ]
    });
  } );


//------------ Appointment 7-12-23---------------------
 //    $(document).ready(function() {
 //        $(".add_appointmentbtn").click(function(e) {
 //            e.preventDefault(e);
 //            // Get the record's ID via attribute
 //            var iid = $(this).attr('data-id');
 //            var emp_id = $(this).attr('data-emp_id');
 //             $('#appointmentform').find('[name="emp_id"]').val(emp_id).end();
 //            $('#appointmentform').trigger("reset");
 //            $('#supportmodel').modal('show');
 //            $.ajax({
 //                url: 'getappointment?id=' + iid + '&emp_id='+ emp_id,
 //                method: 'GET',
 //                data: '',
 //                dataType: 'json',
 //            }).done(function(response) {
               
 //              // console.log(response)

 //                // Populate the form fields with the data returned from server
 //                $('#appointmentform').find('[name="id"]').val(response.employee_data.id).end();
 //                $('#appointmentform').find('[name="busunit_id"]').val(response.employee_data.busunit).end();
 //                $('#appointmentform').find('[name="emp_id"]').val(response.employee_data.em_id).end();
 //                $('[name="employee_name"]').prop('disabled', true);
 //                $('#appointmentform').find('[name="employee_name"]').html('<option value='+response.employee_data.first_name+ ' ' + response.employee_data.last_name+' selected>'+response.employee_data.first_name+ ' ' + response.employee_data.last_name+'</option>').end();
          
 //                 $('#appointmentform').find('[name="position"]').val(response.employee_data.des_name).end();

 //                 $('#appointmentform').find('[name="basic"]').val(response.employee_data.basic).end();
 //                 //console.log(response.employee_data.basic)

 //                 $('#appointmentform').find('[name="hra"]').val(response.employee_data.hra).end();

 //                 //$('#appointmentform').find('[name="grosspay"]').val(response.employee_data.total).end();

 //                 $('#appointmentform').find('[name="address"]').text(response.address).end();
             
 //                 // Trigger the salary calculation after populating default values
 //                calculateSalary();
        

             
 //            });

 //        });
 //         //Appointment calculation
 //        // Function to calculate and update salary
 //            function calculateSalary() {
 //                var basic = parseFloat($('#basic').val()) || 0;
 //                var hra = parseFloat($('#hra').val()) || 0;
 //                var conveyance = parseFloat($('#conveyance').val()) || 0;
 //                var otherBenefits = parseFloat($('#other_benefits').val()) || 0;

 //                var monthlySalary = basic + hra + conveyance + otherBenefits;
 //                var annuallySalary = monthlySalary * 12;

 //                // Update the salary fields
 //                $('#total_gross_salary_monthly').val(monthlySalary.toFixed(2));
 //                $('#total_gross_salary_annually').val(annuallySalary.toFixed(2));
 //            }

 //            // Bind the function to input change events
 //            $('#basic, #hra, #conveyance, #other_benefits').on('input', function () {
 //                calculateSalary();
 //            });
 //    });

 // //Appointment save
 //   $(document).on('click', '#add_appointment', function(e) {
 //        e.preventDefault();
 //         $('[name="employee_name"]').prop('disabled', false);
 //        $("#appointmentform").valid();

 //        // var busunit = $("#busunit").val();
 //        // var title = $("#title").val();



 //      //  if (busunit != '' && title != '') {
 //            $.ajax({
 //                type: 'post',
 //                url: '<?php echo base_url("Employee/Save_Appointment");?>',
 //                data: new FormData($("#appointmentform")[0]),
 //                contentType: false,
 //                processData: false,
 //                success: function(resp) {
 //                    var data = $.parseJSON(resp);
 //                    if (data.status == 'success') {
 //                        $('#appointmentform')[0].reset();
 //                        $.wnoty({
 //                            type: 'success',
 //                            message: 'Added Successfully',
 //                            autohideDelay: 1000,
 //                            position: 'top-right'
 //                        });
 //                    }  else if (data.error) {
 //                        $.wnoty({
 //                            type: 'error',
 //                            message: data.error,
 //                            autohideDelay: 1000,
 //                            position: 'top-right'
 //                        });
 //                    }
 //                },
 //            });
 //       // }
 //        return false;
 //    });

 
//------------ Appointment 7-12-23---------------------
//------------ Appointment 9-12-23---------------------
    $(document).ready(function() {
        $(".add_appointmentbtn").click(function(e) {
            e.preventDefault(e);
             // Clear existing input fields
            $('#dynamicInputFields').empty();
            // Get the record's ID via attribute
            var iid = $(this).attr('data-id');
            var emp_id = $(this).attr('data-emp_id');
            var busunit = $(this).attr('data-busunit');
          
             //$('#appointmentform').find('[name="emp_id"]').val(emp_id).end();
            $('#appointmentform').trigger("reset");
            $('#supportmodel').modal('show');
            $.ajax({
                url: 'getappointment?id=' + iid + '&emp_id='+ emp_id+ '&busunit='+ busunit,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function(response) {
               
              // Clear existing options in the dropdown
                var templateDropdown = $('#appointmentform').find('[name="template_id"]');
                templateDropdown.empty();
                  templateDropdown.append(' <option value="">Select template</option>');
                // Populate the dropdown with template options
                $.each(response.employee_data, function (index, template) {
                    templateDropdown.append('<option value="' + template.id + '">' + template.title + '</option>');
                });

                $('#appointmentemployee').text('('+response.employees.first_name+ ' ' +response.employees.last_name +' )')

                // Populate the form fields with the data returned from server
                $('#appointmentform').find('[name="id"]').val(iid).end();
                $('#appointmentform').find('[name="busunit_id"]').val(busunit).end();
                $('#appointmentform').find('[name="emp_id"]').val(emp_id).end();
     
                // $('#appointmentform').find('[name="template_id"]').html('<option value='+response.employee_data.id+' selected>'+response.employee_data.title+'</option>').end();
          });

        });
        });

    // Add an event listener for the template dropdown change
        $('#template_id').on('change', function () {
            var selectedTemplateId = $(this).val();
             $('#appointmentform').find('#pdf').find('.pdf_file').remove()
            // Call a function to fetch tags based on the selected template
            fetchTemplateTags(selectedTemplateId);


            var emp_id = $('#appointmentform').find('[name="emp_id"]').val();
            var busunit_id = $('#appointmentform').find('[name="busunit_id"]').val();
         
             // Append new anchor tag with updated URL
            var pdfUrl = "<?php echo base_url(); ?>Employee/CertificatePdf?em=" +emp_id+"&tem_id=" + selectedTemplateId+"&busunit="+busunit_id;
            $('#appointmentform').find('#pdf').append('<a href="' + pdfUrl + '" title="Appointment Letter" class="btn btn-sm btn-info waves-effect waves-light pdf_file" target="_blank"><i class="fa fa-print"></i></a>'); 
            
        });

          // Function to check for existing data and fetch it if it exists
        function checkExistingData(templateId) {
            var empId = $('#appointmentform').find('[name="emp_id"]').val();

            $.ajax({
                type: 'GET',
                url: '<?php echo base_url("Employee/getExistingData"); ?>',
                data: { template_id: templateId, emp_id: empId },
                dataType: 'json',
                success: function(existingData) {
                    // If existing data exists, populate dynamic fields
                    if (existingData.length > 0) {
                        populateDynamicFields(existingData);
                    } 

                    // else {
                    //     // No existing data, generate dynamic fields based on the selected template
                    //     fetchTemplateTags(templateId);
                    // }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Function to populate dynamic fields with existing data
        function populateDynamicFields(existingData) {
            // Loop through existing data and populate dynamic fields
            $.each(existingData, function(index, dataItem) {
                // Find the dynamic field by name (use the original tag name as data attribute)
                 var inputTagName = dataItem.tag_name.replace(/{|}/g, '');
                var dynamicField = $('#dynamicInputFields').find('[name="' + inputTagName + '"]');
                if (dynamicField.length > 0) {
                    // Populate the value
                    dynamicField.val(dataItem.tag_value);
                }
            });
        }

        // Function to fetch tags based on the selected template
        function fetchTemplateTags(templateId) {
            // Make an AJAX request to fetch tags for the selected template
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url("Employee/getTemplateTags"); ?>',
                data: { template_id: templateId },
                dataType: 'json',
                success: function (data) {
                    // Call a function to dynamically generate input fields based on fetched tags
                    generateInputFields(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Function to dynamically generate input fields based on fetched tags
        function generateInputFields(tags) {
            // Clear existing input fields
            $('#dynamicInputFields').empty();

            // Generate input fields for each tag
            $.each(tags, function (index, tag) {
                // Format the tag name by removing curly braces and converting underscores
             var formattedTagName = formatTagName(tag.tag_name);
               var inputTagName = tag.tag_name.replace(/{|}/g, '');

                var inputField = '<div class="col-md-4"><div class="form-group">';
                inputField += '<label class="control-label">' + formattedTagName + '</label>';
                inputField += '<input type="text" name="' + inputTagName + '" class="form-control dynamic-field" data-original-tag="' + tag.tag_name + '" value="">';
                inputField += '</div></div>';

                // Append the input field to the container
                $('#dynamicInputFields').append(inputField);
            });

             // After generating fields, check for existing data and populate if it exists
                var selectedTemplateId = $('#template_id').val();
                checkExistingData(selectedTemplateId);
        }

        // Function to format tag name
        function formatTagName(tagName) {
            // Remove curly braces
            tagName = tagName.replace(/{|}/g, '');

            // Convert underscored names to human-readable form
            tagName = tagName.replace(/_/g, ' ');

            // Capitalize the first letter of each word
            tagName = tagName.replace(/\b\w/g, function (match) {
                return match.toUpperCase();
            });

            return tagName;
        }



        // Submit form with dynamic fields
        $(document).on('click', '#add_appointment', function (e) {
            e.preventDefault();
            $('[name="employee_name"]').prop('disabled', false);
            $("#appointmentform").valid();

            // Validate dynamic fields
            var dynamicFieldsValid = validateDynamicFields();

            if (dynamicFieldsValid) {
                // Continue with form submission

                // Extract dynamic fields and prepare data
                var dynamicFieldsData = [];
                $('.dynamic-field').each(function () {
                    var originalTagName = $(this).data('original-tag');
                    var fieldValue = $(this).val();
                    dynamicFieldsData.push({ tag_name: originalTagName, tag_value: fieldValue });
                });

                // Prepare form data including dynamic fields
                var formData = new FormData($("#appointmentform")[0]);

                // Add dynamic fields as a JSON string
                formData.append('dynamic_fields', JSON.stringify(dynamicFieldsData));

                // Submit form with dynamic fields
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("Employee/Save_TempalteFields");?>',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (resp) {
                        var data = $.parseJSON(resp);
                        if (data.status == 'success') {
                            $('#appointmentform')[0].reset();
                            $.wnoty({
                                type: 'success',
                                message: 'Added Successfully',
                                autohideDelay: 1000,
                                position: 'top-right'
                            });
                              $('#supportmodel').modal('hide');
                        } else if (data.error) {
                            $.wnoty({
                                type: 'error',
                                message: data.error,
                                autohideDelay: 1000,
                                position: 'top-right'
                            });
                        }
                    },
                });

            } else {
                // Show an error message or handle validation failure
                console.log('Dynamic fields validation failed');
            }

            return false;
        });


        // Function to validate dynamic fields
        function validateDynamicFields() {
            var isValid = true;

            $('.dynamic-field').each(function () {
                var fieldValue = $(this).val();

                // Check if the field is required and empty
                if ($(this).prop('required') && !fieldValue.trim()) {
                    isValid = false;
                    // Add your error handling logic (e.g., show an error message)
                    console.log('Dynamic field validation failed for:', $(this).attr('name'));
                }
            });

            return isValid;
        }

//------------ Appointment 9-12-23---------------------
</script>