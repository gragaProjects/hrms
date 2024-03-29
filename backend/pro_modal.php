                        <!-- logistic model -->
                        <div class="modal fade" id="logisticmodel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Assign Logistic Support</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="logisModalform" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label ">Project List</label>
                                                    <span class="error">*</span>
                                                     <select class="form-control custom-select "
                                                        tabindex="1" id="logistic_proid" name="proid">
                                                        <option value=""> select project</option>
                                                        <option value="<?php echo $details->id; ?>">
                                                            <?php echo $details->pro_name; ?></option>
                                                     </select>
                                                      </div>
                                                </div>
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label ">Project Date</label>
                                                        <input type="text" value="<?php echo $details->pro_start_date; ?>"
                                                            name="prostart" class="form-control " id="logistic_prostart"
                                                            readonly>
                                                        
                                                </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label class="control-label ">Project Date</label>
                                                    <input type="text" value="<?php echo $details->pro_end_date; ?>"
                                                            name="proend" class="form-control " id="logistic_proend"
                                                            readonly>
                                                        </div>
                                                        </div>
                                                  
                                                </div>
                                              
                                            <div class="row">
                                                <div class="col-md-4">

                                                  <div class="form-group">
                                                 <label class="control-label ">Task List</label> <span class="error">*</span>
                                                <select class="form-control custom-select taskclass search "
                                                    data-placeholder="" tabindex="1" name="taskid"
                                                    id="taskval" >
                                                    
                                                    <?php foreach($tasklist AS $value): ?>
                                                    <option value="<?php echo $value->id ?>">
                                                        <?php echo $value->task_title ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                               
                                                </div>
                                                <div class="col-md-4">
                                                      <div class="form-group">
                                                  <label class="control-label ">Assign To</label> <span class="error">*</span>
                                                   
                                                  <select class="select2 form-control custom-select search "
                                                    data-placeholder="" style="width:25%" tabindex="1"
                                                    name="teamhead" id="logistic_teamhead">
                                                   
                                                    <?php foreach($proemployee as $value): ?>
                                                    <option value="<?php echo $value->em_id; ?>">
                                                        <?php echo $value->first_name .' '.$value->last_name; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                                   
                                                </div>
                                                <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label class="control-label ">Start Date</label> <span class="error">*</span>
                                                        <input type="text" name="startdate" id="logistic_startdate"
                                                            class="form-control  mydatetimepickerFull"
                                                            id="">
                                                       
                                                    </div>
                                                   
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="col-md-4">    
                                                 <div class="form-group">
                                                     <label class="control-label ">End Date</label>
                                                        <input type="text" name="enddate"
                                                            class="form-control  mydatetimepickerFull"
                                                            id="">
                                                 
                                              </div>
                                            </div>
                                                <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label for="message-text" class="control-label ">Remarks</label>
                                                        <textarea class="form-control " name="remarks"
                                                            id="message-text1" minlength="10" maxlength="1400"
                                                            rows="1"></textarea>
                                                    </div>
                                           
                                                </div>
                                                <div class="col-md-4">

                                                 <label class="control-label ">Logistic Support</label> <span class="error">*</span>
                                                <select class="select2 form-control custom-select search assetsstock"
                                                     style="width:35%" tabindex="1"
                                                    name="logistic" id="logistic_val">
                                                    <option value="">Select Here</option>
                                                    <?php foreach($assets as $value): ?>
                                                    <option value="<?php echo $value->ass_id; ?>">
                                                        <?php echo $value->ass_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                             
                                              
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                 <div class="form-group">
                                                 <label class="control-label ">Quantity</label> <span class="error">*</span>
                                              
                                                <input type="number" name="qty" id="qty" class="form-control "
                                                    id="recipient-name1" placeholder="Qty" >
                                                     <div style="color:red" class="qty "></div>
                                                </div>  
                                                </div>
                                                
                                            </div>
                                         </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" value="" class="form-control"
                                                id="recipient-name1">
                                        
                                            <button type="submit"
                                                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> disabled
                                                <?php } ?> class="btn btn-info" id="addbtn_logistic">Submit</button>
                                                    <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- add task -->

 
                 <!--   <div class="modal fade" id="addtasksmodel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="">Add Tasks</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                           
                                    <form method="post" id="addtasksModalform" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Project List <span
                                                                class="error">*</span></label>
                                                        <select class="form-control custom-select  proid validate"
                                                             tabindex="1"
                                                            name="projectid" id="addprojectid" required>
                                                            <option value="">Select project</option>
                                                            <option value="<?php echo $details->id; ?>">
                                                                <?php echo $details->pro_name; ?></option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Project Start Date</label>
                                                        <input type="text"
                                                            value="<?php echo $details->pro_start_date; ?>"
                                                            name="prostart" class="form-control " id="addprojectstart"
                                                            readonly>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Project End Date</label>
                                                        <input type="text" value="<?php echo $details->pro_end_date; ?>"
                                                            name="proend" class="form-control " id="addprojectend"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group  ">
                                                        <label class="control-label ">Assign To<span
                                                                class="error">*</span></label>
                                                        <select class="select2 form-control custom-select "
                                                            style="width:25%" tabindex="1" name="teamhead" id="addtmhead"
                                                            required>
                                                            <option value="">Select Assign</option>
                                                            <?php foreach($employee as $value): ?>
                                                            <option value="<?php echo $value->em_id; ?>">
                                                                <?php echo $value->first_name.' '.$value->last_name; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Collaborators <span class="error"
                                                                style="font-size : ;"> *</span> </label><span
                                                            class="collab_info" style="color: #e57676;"> You can select
                                                            multiple collabrators</span>
                                                        <select class=" form-control select2  select2-multipe"
                                                            tabindex="1" name="assignto[]" id="addassigntotask" required
                                                            multiple="multiple">
                                                            <option value="" disabled>Select One or More</option>
                                                            <?php foreach($employee as $value): ?>
                                                            <option value="<?php echo $value->em_id; ?>" >
                                                                <?php echo $value->first_name.' '.$value->last_name; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Task Title<span
                                                                class="error">*</span></label>
                                                        <input type="text" name="tasktitle" class="form-control "
                                                            id="addassigntasktitle" minlength="8" maxlength="250"
                                                            placeholder="Task Title..." required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Task Start Date <span
                                                                class="error">*</span></label>
                                                        <input type="text" name="startdate"
                                                            class="form-control mydatepicker" id="addtaskstartdate"
                                                            required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formgroup">
                                                        <label class="control-label ">Task End Date <span
                                                                class="error">*</span></label>
                                                        <input type="text" name="enddate"
                                                            class="form-control  mydatepicker" id="addtaskenddate"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group ">
                                                        <label for="message-text" class="control-label ">Details</label>
                                                        <textarea class="form-control " name="details"
                                                            id="adddetails" minlength="10" maxlength="1400"
                                                            rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="control-label col-md-3">Status: </label>
                                                        <input name="status" type="radio" id="addradio_1"
                                                            data-value="Logistic" class="type" value="complete">
                                                        <label for="radio_1">Complete</label>
                                                        <input name="status" type="radio" id="addradio_2"
                                                            data-value="Logistic" class="type" value="running">
                                                        <label for="radio_2">Running</label>
                                                        <input name="status" type="radio" id="addradio_3"
                                                            data-value="Logistic" class="type" value="cancel">
                                                        <label for="radio_3">Cancel</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="form-group ">
                                                        <label class="control-label col-md-3">Type: </label>
                                                        <input name="type" type="radio" id="add" data-value="Office"
                                                            class="type" value="Office" checked>
                                                        <label for="radio_4">Office</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" class="form-control"
                                                    id="tid">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit"
                                                    <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                                                    disabled <?php } ?> class="btn btn-info"
                                                    id=''>Submit</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>   -->
                        <!-- update task -->
                        <div class="modal fade" id="tasksmodel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Add Tasks</h4>
                                        <button type="button" class="close cls" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <!-- action="Add_Tasks" -->
                                    <form method="post" id="tasksModalform" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Project List <span
                                                                class="error">*</span></label>
                                                        <select class="form-control custom-select  proid validate"
                                                             tabindex="1"
                                                            name="projectid" id="projectid" required>
                                                            <option value="">Select project</option>
                                                            <option value="<?php echo $details->id; ?>">
                                                                <?php echo $details->pro_name; ?></option>
                                                        </select>

                                                    </div>
                                                </div>
                                                       <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Project Start Date</label>
                                                        <input type="text"
                                                            value="<?php echo $details->pro_start_date; ?>"
                                                            name="prostart" class="form-control " id="projectstart"
                                                            readonly>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Project End Date</label>
                                                        <input type="text" value="<?php echo $details->pro_end_date; ?>"
                                                            name="proend" class="form-control " id="projectend"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                         
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Assign To<span
                                                                class="error">*</span></label>
                                                        <select class=" form-control custom-select "
                                                          tabindex="1" name="teamhead" id="tmhead"
                                                            required>
                                                            <option value="">Select Assign</option>
                                                            <?php foreach($employee as $value): ?>
                                                            <option value="<?php echo $value->em_id; ?>">
                                                                <?php echo $value->first_name.' '.$value->last_name; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Collaborators <span class="error"
                                                                style="font-size : ;"> *</span> </label><!-- <span
                                                            class="collab_info" style="color: #e57676;"> You can select
                                                            multiple collabrators</span> -->
                                                        <select class=" form-control  select2  select2-multipe "
                                                            tabindex="1" name="assignto[]" id="assigntotask" required
                                                            multiple="multiple"><!--select2  select2-multipe -->
                                                            <!-- <option value="" >Select Collaborators</option> -->
                                                            <option value="" disabled>Select One or More</option>
                                                            <?php foreach($employee as $value): ?>
                                                            <option value="<?php echo $value->em_id; ?>" >
                                                                <?php echo $value->first_name.' '.$value->last_name; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Task Title<span
                                                                class="error">*</span></label>
                                                        <input type="text" name="tasktitle" class="form-control "
                                                            id="assigntasktitle"  maxlength="250"
                                                            placeholder="Task Title..." required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                              
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="control-label ">Task Start Date <span
                                                                class="error">*</span></label>
                                                        <input type="text" name="startdate"
                                                            class="form-control mydatepicker" id="taskstartdate"
                                                            required>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="formgroup">
                                                        <label class="control-label ">Task End Date <span
                                                                class="error">*</span></label>
                                                        <input type="text" name="enddate"
                                                            class="form-control  mydatepicker" id="taskenddate"
                                                            required>
                                                    </div>
                                                </div>
                                                  <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label for="message-text" class="control-label ">Details</label>
                                                        <textarea class="form-control " name="details"
                                                            id="message-text1"  maxlength="1400"
                                                            rows="1"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                              
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="control-label col-md-3">Status: </label>
                                                        <input name="status" type="radio" id="radio_1"
                                                            class="type" value="completed">
                                                        <label for="radio_1">Completed</label>
                                                        <input name="status" type="radio" id="radio_2"
                                                            class="type" value="running">
                                                        <label for="radio_2">Running</label>
                                                        <input name="status" type="radio" id="radio_3"
                                                            class="type" value="cancel">
                                                        <label for="radio_3">Cancel</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="form-group ">
                                                        <label class="control-label col-md-3">Type: </label>
                                                        <input name="type" type="radio" id="radio_4" data-value="Office"
                                                            class="type" value="Office" checked>
                                                        <label for="radio_4">Office</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" class="form-control"
                                                    id="tid">
                                              
                                                <button type="submit" class="btn btn-info"
                                                    id='add_task'>Submit</button>
                                                      <button type="button" class="btn btn-default cls"
                                                    data-dismiss="modal">Close</button><!-- onClick="sendContact();" -->
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- fieldmodel -->
                        <div class="modal fade" id="fieldmodel" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Field Tasks</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="Add_Field_Tasks" id="tasksModalform"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Project List</label>
                                                <select class="form-control custom-select col-md-6 proid"
                                                     tabindex="1" name="projectid">
                                                    <option value="<?php echo $details->id; ?>">
                                                        <?php echo $details->pro_name; ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Project Date</label>
                                                <input type="text" value="<?php echo $details->pro_start_date; ?>"
                                                    name="prostart" class="form-control col-md-4" id="recipient-name1"
                                                    readonly>
                                                <input type="text" value="<?php echo $details->pro_end_date; ?>"
                                                    name="proend" class="form-control col-md-4" id="recipient-name1"
                                                    readonly>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Assign To</label>
                                                <select class="select2 form-control custom-select col-md-3"
                                                     style="width:25%" tabindex="1"
                                                    name="teamhead">
                                                    <option value="">Select Here</option>
                                                    <?php foreach($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id; ?>" >
                                                        <?php echo $value->first_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label class="control-label col-md-2">Collaborators</label>
                                                <select class="select2 form-control select2-multiple col-md-3"
                                                     multiple="multiple"
                                                    style="width:25%" tabindex="1" name="assignto[]">
                                                    <option value="">Select Here</option>
                                                    <?php foreach($employee as $value): ?>
                                                    <option value="<?php echo $value->em_id; ?>">
                                                        <?php echo $value->first_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Task Title</label>
                                                <input type="text" name="tasktitle" class="form-control col-md-8"
                                                    id="recipient-name1" minlength="8" maxlength="250">
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Start Date</label>
                                                <input type="text" name="startdate"
                                                    class="form-control col-md-3 mydatepicker" id="recipient-name1">
                                                <label class="control-label col-md-1">End Date</label>
                                                <input type="text" name="enddate"
                                                    class="form-control col-md-3 mydatepicker" id="recipient-name1">
                                            </div>
                                            <div class="form-group row">
                                                <label for="message-text" class="control-label col-md-3">Details</label>
                                                <textarea class="form-control col-md-8" name="details"
                                                    id="message-text1" minlength="10" maxlength="1400"
                                                    rows="4"></textarea>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Status: </label>
                                                <input name="status" type="radio" id="radio_7" data-value="completed"
                                                    class="type" value="completed">
                                                <label for="radio_7">Completed</label>
                                                <input name="status" type="radio" id="radio_5" data-value="running"
                                                    class="type" value="running">
                                                <label for="radio_5">Running</label>
                                                <input name="status" type="radio" id="radio_6" data-value="cancel"
                                                    class="type" value="cancel">
                                                <label for="radio_6">Cancel</label>
                                            </div>
                                            <div class="form-group row">
                                                <label for="message-text"
                                                    class="control-label col-md-3">Location</label>
                                                <textarea class="form-control col-md-8" name="location"
                                                    id="message-text1" minlength="10" maxlength="1400"
                                                    rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" class="form-control" id="recipient-name1">
                                         
                                            <button type="submit"
                                                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> disabled
                                                <?php } ?> class="btn btn-info">Submit</button>
                                                   <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
        