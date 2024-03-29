<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
   <div class="message"></div>
   <div class="row page-titles">
      <div class="col-md-5 align-self-center">
         <h3 class="text-themecolor"><i class="fa fa-briefcase"></i> Field Authorization Application
         </h3>
      </div>
      <div class="col-md-7 align-self-center">
         <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item">
               <a href="javascript:void(0)">Home
               </a>
            </li>
            <li class="breadcrumb-item active">Field Authorization Application
            </li> -->
            <?php if($this->role->User_Permission('field_visit','can_add')){ ?>
            <button type="button" class="btn btn-info">
            <i class="fa fa-plus"></i>
            <a data-toggle="modal" data-target="#appmodel" data-whatever="@getbootstrap" class="text-white" id="addNewApplication" style="width: 140px;">
               <i class="" aria-hidden="true"></i> Add Application
            </a>
            </button>
            <?php } ?>
         </ol>
      </div>
   </div>
   <div class="container-fluid">
      <div class="row m-b-10">
         <div class="col-12">
          
            <!-- <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 140px;">Cancel</a> -->
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card card-outline-info">
               <div class="card-header">
                    <h4 class="m-b-0 text-white">&nbsp;&nbsp; Field  Application List
                  </h4>
               </div>
               <div class="card-body">
                  <div class="table-responsive " style=" overflow-x: auto;">
                     <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th>S.NO</th>
                              <th>Project Name</th>
                              <th>Location</th>
                              <th>Code</th>
                              <th>Employee Name</th>
                              <th>Start Date</th>
                              <th>Approx. End Date</th>
                              <th>Total Days</th>
                              <th>Actual Return Date</th>
                              <th>Status</th>
                              <?php if($this->role->User_Permission('field_visit','can_delete') || $this->role->User_Permission('field_visit','can_edit')){?>
                              <th>Action </th>
                              <?php } ?>
                           </tr>
                        </thead>
                        
                        <tbody>
                           <?php
                           if($this->role->User_Permission('field_visit','can_view') && $this->role->User_Permission('field_visit','can_add') && $this->role->User_Permission('field_visit','can_edit')) {
                           $i = 1;
                           foreach($application as $value): ?>
                           <tr style="vertical-align:top">
                              <td> <?php echo $i; ?> </td>
                              <td> <?php echo substr($value->pro_name,0,22).'...'; ?> </td>
                              <td><?php echo $value->field_location; ?></td>
                              <td><?php echo $value->em_code; ?> </td>
                              <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                              <td><?php echo date('d M Y',strtotime($value->start_date)); ?></td>
                              <td><?php echo date('d M Y',strtotime($value->approx_end_date)); ?></td>
                              <td><?php echo $value->total_days; ?></td>
                              <td><?php if($value->actual_return_date) {echo date('d M Y',strtotime($value->actual_return_date)); }?></td>
                              <td> <?php echo $value->status; ?></td>
                              <td class="jsgrid-align-center">
                                 <?php if($value->status =='Approve'){ ?>
                                 <?php } elseif($value->status =='Pending'){ ?>
                                 <?php if($this->role->User_Permission('field_visit','can_delete') && $this->role->User_Permission('field_visit','can_edit')){?>
                                 <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light Status " data-id="<?php echo $value->id; ?>" data-value="Approved" data-duration="<?php echo $value->total_days; ?>">Approve
                                 </a>
                                 <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light  Status" data-id = "<?php echo $value->id; ?>" data-value="Rejected" >Reject
                                 </a>
                                 <?php }  ?>
                                 <?php } elseif($value->status =='Rejected'){ ?>
                                 <?php } ?>
                                 <?php if( $this->role->User_Permission('field_visit','can_edit')){?>
                                 <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light fieldAuthEdit" data-id="<?php echo $value->id; ?>" >
                                    <i class="fa fa-pencil-square-o"></i>
                                 </a>
                                 <?php } ?>
                                 <?php if ($value->attendance_updated !== 'done' AND $value->status == 'Approved'): ?>
                                 <a href="" id="closeAndUpdateFieldVisit" data-confirm="Are you sure want to close his field visit and update the attendance?" title="Mark as done" class="btn btn-sm btn-info waves-effect waves-light" data-id="<?php echo $value->id; ?>" data-employeeID="<?php echo $value->em_code; ?>">
                                    <i class="fa fa-scissors"></i> Update attendance
                                 </a>
                                 <?php endif; ?>
                              </td>
                              
                           </tr>
                           <?php $i++; endforeach; ?>
                           <?php }elseif ($this->role->User_Permission('field_visit','can_view')) {
                           $id = $this->session->userdata('user_login_id');
                           $field_data = $this->project_model->GetFieldvisit($id);
                           $i = 1;
                           foreach($field_data as $value): ?>
                           <tr style="vertical-align:top">
                              <td> <?php echo $i; ?> </td>
                              <td> <?php echo substr($value->pro_name,0,22).'...'; ?> </td>
                              <td><?php echo $value->field_location; ?></td>
                              <td><?php echo $value->em_code; ?> </td>
                              <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                              <td><?php echo date('d M Y',strtotime($value->start_date)); ?></td>
                              <td><?php echo date('d M Y',strtotime($value->approx_end_date)); ?></td>
                              <td><?php echo $value->total_days; ?></td>
                              <td><?php if($value->actual_return_date) {echo date('d M Y',strtotime($value->actual_return_date)); }?></td>
                              <td> <?php echo $value->status; ?></td>
                              <?php $i++; endforeach; ?>
                              <?php } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <script>
         $(document).on('click', '#closeAndUpdateFieldVisit', function(e){
         //console.log($(this).attr('data-id'));
         //console.log($(this).attr('data-employeeID'));
         if(!confirm($(this).data('confirm'))){
         e.stopImmediatePropagation();
         e.preventDefault();
         } else {
         e.stopImmediatePropagation();
         e.preventDefault();
         $.ajax({
         url: "closeAndUpdateFieldVisit",
         type:"POST",
         data:
         {
         'fieldApplicationID': $(this).attr('data-id'),
         'employeeID': $(this).attr('data-employeeid')
         },
         success: function(response) {
         //console.log(' ');
         $(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
         window.setTimeout(function(){
         location.reload()} ,3000);
         }
         ,
         error: function(response) {
         console.error();
         }
         });
         }
         });
         </script>
         <?php if($this->role->User_Permission('field_visit','can_add') && $this->role->User_Permission('field_visit','can_edit')&& $this->role->User_Permission('field_visit','can_delete')){?>
         <div class="row">
            <div class="col-md-12">
               <ul>
                  <li>When you edit the applied forms from the edit button, don't forget to reauthorize approving the info.</li>
                  <li>Once you give the final approval and confirm final closing, the attendance will be permanently updated.</li>
               </ul>
            </div>
         </div>
         <?php } ?>
             <?php if($this->role->User_Permission('field_visit','can_add') && $this->role->User_Permission('field_visit','can_edit')&& $this->role->User_Permission('field_visit','can_delete')){?>
         <div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content ">
                  <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel1">Field Authorization
                     </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;
                     </span>
                     </button>
                  </div>
                  <form method="post" action="" id="fieldAuthForm" enctype="multipart/form-data">
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Project Name
                                    </label><span class="error"> *</span>
                                    <select class="form-control select2 custom-select search emid"  tabindex="1" name="projectID"  id="projectID" style="width:100%" >
                                       <option value="">Select project</option>
                                       <?php foreach($projects as $project): ?>
                                       <option value="<?php echo $project->id; ?>">
                                          <?php echo substr($project->pro_name,0,60).'...' ?>
                                       </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Employee
                                       </label><span class="error"> *</span>
                                       <select class="form-control select2 custom-select search emid"  tabindex="1" name="emid" id="emid" style="width:100%"  >
                                          <option value="">Select employee</option>
                                          <?php foreach($employee as $value): ?>
                                          <option value="<?php echo $value->em_id; ?>">
                                             <?php echo $value->first_name.' '.$value->last_name ?>
                                          </option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label for="fieldLocation" class="control-label">Field Location</label><span class="error"> *</span>
                                       <input type="text" class="form-control" placeholder="Field location" name="fieldLocation" id="fieldLocation">
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="control-label">Approximate Start Date</label><span class="error"> *</span>
                                       <input type="text" name="startdate" id="startdate" class="form-control mydatetimepickerFull" id="recipient-name1" >
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group" id="enddate">
                                       <label class="control-label">Approximate End Date
                                       </label>
                                       <input type="text" name="enddate" class="form-control mydatetimepickerFull" id="recipient-name1">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group" id="totalDays">
                                       <label class="control-label">Total Days
                                       </label>
                                       <input type="number" name="totalDays" class="form-control" id="recipient-name1" readonly>
                                    </div>
                                 </div>
                                 
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="control-label">Notes
                                       </label>
                                       <textarea name="notes" id="notes" class="form-control" rows="1"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group" id="returnDate">
                                       <label class="control-label">Actual Return Date
                                       </label>
                                       <input type="date" name="actualReturnDate" class="form-control" id="">
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <div class="modal-footer">
                              <input type="hidden" name="fid">
                              
                              <button type="submit" class="btn btn-primary" id="add_field">Submit
                              </button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
                <?php }
                if($this->role->User_Permission('field_visit','can_add') && $this->role->User_Permission('field_visit','can_view') ) {
                 
                 
                    $id = $this->session->userdata('user_login_id');
                    $basicinfo = $this->employee_model->GetBasic($id);
                  ?>
                
                  <div class="modal fade" id="appmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content ">
                  <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel1">Field Authorization
                     </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;
                     </span>
                     </button>
                  </div>
                  <form method="post" action="" id="fieldAuthForm" enctype="multipart/form-data">
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Project Name
                                    </label><span class="error"> *</span>
                                    <select class="form-control select2 custom-select search "  tabindex="1" name="projectID"  id="projectID" style="width:100%" >
                                       <option value="">Select project</option>
                                       <?php foreach($projects as $project): ?>
                                       <option value="<?php echo $project->id; ?>">
                                          <?php echo substr($project->pro_name,0,60).'...' ?>
                                       </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Employee</label><span class="error"> *</span>
                                        <select class="form-control select2 custom-select search emid"  tabindex="1" name="emid" id="emid" style="width:100%"  >
                                          <option value="">Select employee</option>
                                      
                                          <option value="<?php echo $basicinfo->em_id; ?>" >
                                             <?php echo $basicinfo->first_name.' '.$basicinfo->last_name ?>
                                          </option>
                                       
                                       </select> 

                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label for="fieldLocation" class="control-label">Field Location</label><span class="error"> *</span>
                                       <input type="text" class="form-control" placeholder="Field location" name="fieldLocation" id="fieldLocation">
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="control-label">Approximate Start Date</label><span class="error"> *</span>
                                       <input type="text" name="startdate" id="startdate" class="form-control mydatetimepickerFull" id="recipient-name1" >
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group" id="enddate">
                                       <label class="control-label">Approximate End Date
                                       </label>
                                       <input type="text" name="enddate" class="form-control mydatetimepickerFull" id="recipient-name1">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group" id="totalDays">
                                       <label class="control-label">Total Days
                                       </label>
                                       <input type="number" name="totalDays" class="form-control" id="recipient-name1" readonly>
                                    </div>
                                 </div>
                                 
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label class="control-label">Notes
                                       </label>
                                       <textarea name="notes" id="notes" class="form-control" rows="1"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group" id="returnDate">
                                       <label class="control-label">Actual Return Date
                                       </label>
                                       <input type="date" name="actualReturnDate" class="form-control" id="">
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <div class="modal-footer">
                              <input type="hidden" name="fid">
                              
                              <button type="submit" class="btn btn-primary" id="add_field">Submit
                              </button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <?php } ?>
               <script>
               
               $("#addNewApplication").on("click", function() {
               console.log('Yes');
               $('#fieldAuthForm').find('[name="fid"]').val("").end();
               $('#fieldAuthForm').find('[name="projectID"]').val("").end();
               $('#fieldAuthForm').find('[name="emid"]').val("").end();
               $('#fieldAuthForm').find('[name="fieldLocation"]').val("").end();
               $('#fieldAuthForm').find('[name="startdate"]').val("").end();
               $('#fieldAuthForm').find('[name="enddate"]').val("").end();
               $('#fieldAuthForm').find('[name="notes"]').val("").end();
               $('#fieldAuthForm').find('[name="enddate"]').on("change", function() {
               console.log('Yes');
               var date1 = new Date($('#fieldAuthForm').find('[name="startdate"]').val());
               var date2 = new Date($('#fieldAuthForm').find('[name="enddate"]').val());
               var timeDiff = Math.abs(date2.getTime() - date1.getTime());
               var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
               $('#fieldAuthForm').find('[name="totalDays"]').val(diffDays).end();
               });
               $('#fieldAuthForm').find('[name="totalDays"]').val("").end();
               $('#fieldAuthForm').find('[name="actualReturnDate"]').val("").end();
               $('#fieldAuthForm').find('[id="returnDate"]').css("display", "none").end();
               });
               </script>
               <script type="text/javascript">
               $(document).ready(function() {
               $(".fieldAuthEdit").click(function(e) {
               e.preventDefault(e);
               // Get the record's ID via attribute
               var fieldAppID = $(this).attr('data-id');
               $('#fieldAuthForm').trigger("reset");
               $('#fieldAuthForm #returnDate').css("display", "block !IMPORTANT");
               $('#appmodel').modal('show');
               $.ajax({
               url: 'getFieldVisitAppData?id=' + fieldAppID,
               method: 'GET',
               data: '',
               dataType: 'json',
               }).done(function(response) {
               console.log(response);
               // Populate the form fields with the data returned from server
               $('#fieldAuthForm').find('[name="fid"]').val(response.id).end();
               $('#fieldAuthForm').find('[name="projectID"]').val(response.project_id).end();
               $('#fieldAuthForm').find('[name="emid"]').val(response.emp_id).end();
               $('#fieldAuthForm').find('[name="fieldLocation"]').val(response.field_location).end();
               $('#fieldAuthForm').find('[name="startdate"]').val(response.start_date).end();
               $('#fieldAuthForm').find('[name="enddate"]').val(response.approx_end_date).end();
               var date1 = new Date(response.start_date);
               var date2 = new Date(response.approx_end_date);
               var timeDiff = Math.abs(date2.getTime() - date1.getTime());
               var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
               $('#fieldAuthForm').find('[name="totalDays"]').val(diffDays).end();
               $('#fieldAuthForm').find('[name="notes"]').val(response.notes).end();
               $('#fieldAuthForm').find('[id="returnDate"]').css("display", "block").end();
               $('#fieldAuthForm').find('[name="actualReturnDate"]').val(response.actual_return_date).end();
               });
               });
               });
               </script>
               <script type="text/javascript">
               $(document).ready(function () {
               $(".assignleave").click(function (e) {
               e.preventDefault(e);
               // Get the record's ID via attribute
               var iid = $(this).val();
               if(iid){
               console.log(iid);
               $.ajax({
               url: 'LeaveAssign?id=' + iid,
               method: 'GET',
               data: '',
               }
               ).done(function (response) {
               //console.log(response);
               $("#total").html(response);
               }
               );
               }
               else {
               $("#total").val('');
               }
               }
               );
               }
               );
               </script>
               <script type="text/javascript">
               $(document).ready(function () {
               $(".emleavetype").click(function (e) {
               e.preventDefault(e);
               // Get the record's ID via attribute
               var iid = $(this).val();
               //console.log(iid);
               $.ajax({
               url: 'LeaveType?id=' + iid,
               method: 'GET',
               data: '',
               }
               ).done(function (response) {
               //console.log(response);
               $("#leavetype").html(response);
               }
               );
               }
               );
               }
               );
               </script>
               <script type="text/javascript">
               $(document).ready(function () {
               $(".leaveapp").click(function (e) {
               e.preventDefault(e);
               // Get the record's ID via attribute
               var iid = $(this).attr('data-id');
               $('#leaveapply').trigger("reset");
               $('#appmodel').modal('show');
               $.ajax({
               url: 'LeaveAppbyid?id=' + iid,
               method: 'GET',
               data: '',
               dataType: 'json',
               }
               ).done(function (response) {
               console.log(response);
               // Populate the form fields with the data returned from server
               $('#leaveapply').find('[name="id"]').val(response.id).end();
               $('#leaveapply').find('[name="emid"]').val(response.em_id).end();
               $('#leaveapply').find('[name="applydate"]').val(response.apply_date).end();
               $('#leaveapply').find('[name="typeid"]').val(response.typeid).end();
               $('#leaveapply').find('[name="startdate"]').val(response.start_date).end();
               $('#leaveapply').find('[name="enddate"]').val(response.end_date).end();
               $('#leaveapply').find('[name="duration"]').val(response.leave_duration).end();
               $('#leaveapply').find('[name="reason"]').val(response.reason).end();
               $('#leaveapply').find('[name="status"]').val(response.leave_status).end();
               $('#leaveapply').find('[name="type"]').val(response.leave_type).end();
               }
               );
               }
               );
               }
               );
               </script>
               <script>
               $(".Status").on("click", function(event){
               event.preventDefault();
               
               $.ajax({
               url: "authorizeFieldVisit",
               type:"POST",
               data:
               {
               'fieldApplicationID': $(this).attr('data-id'),
               'approvalStatus': $(this).attr('data-value')
               }
               ,
               success: function(response) {
               //console.log(' ');
               //$(".message").fadeIn('fast').delay(3000).fadeOut('fast').html(response);
                $.wnoty({
               type: 'success',
               message: 'Status Updated Successfully',
               autohideDelay: 1000,
               position: 'top-right'
               });
              
               window.setTimeout(function(){
               location.reload()}
               ,2000)
               }
               ,
               error: function(response) {
               console.error();
               }
               }
               );
               }
               );
               </script>
               <?php $this->load->view('backend/footer'); ?>
               <script>
               $(document).on('click','#add_field',function(){
               event.preventDefault();
               $("#fieldAuthForm").valid();
               
               var projectID = $("#projectID").val();
               var emid = $('#emid').val();
               var fieldLocation =$('#fieldLocation').val();
               var startdate = $('#startdate').val();
               
               //console.log(assigntotask);
               if (projectID != '' && emid != '' && fieldLocation != '' && startdate != '') {
               $.ajax({
               type:'post',
               url: '<?php echo base_url("Projects/Field_Application");?>',
               data: new FormData($("#fieldAuthForm")[0]),
               contentType: false,
               processData: false,
               success:function(resp){
               var data=$.parseJSON(resp);;
               if(data.status == 'success'){
               $('#appmodel').modal('hide');
               $(".modal-backdrop").remove();
             
               $('#fieldAuthForm')[0].reset();
               //$('#catid').val('');
               $.wnoty({
               type: 'success',
               message: data.message,
               autohideDelay: 1000,
               position: 'top-right'
               });
              
               
               setTimeout(function(){
               location.reload(true);
               },2000);
               //
               }
               },
               });
               }
               return false;
               })
               </script>