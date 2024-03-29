             <div class="modal fade" id="depmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Add Department</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post"  id="depform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Department Name</label>
                                            
                                            <input type="text" name="department" id="department" value="" class="form-control" placeholder=""><!-- <?php  echo $editdepartment->dep_name;?> -->
                                            <input type="hidden" name="depval" value="depval">
                                        </div>
                                         <div class="fielderror"> </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="catid" value="" class="form-control" id="recipient-name1">
                                        <button type="submit" id='add_dep'class="btn btn-info">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <div class="modal fade" id="desmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel1">Add Designation</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post" id="desform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Designation </label>
                                            
                                            <input type="text" name="designation" id="designation" value="" class="form-control" placeholder="">
                                            <input type="hidden" name="desval" value="desval">
                                        </div>
                                        <div class="fielderror"> </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="add_des" class="btn btn-info">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                       <div id="prefixModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Prefix</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="preform" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Prefix:</label>
                                        <input type="text" class="form-control" id="prefixtitle" name="prefixtitle">
                                          <input type="hidden" name="preval" value="preval">
                                    </div>
                                    <div class="fielderror"> </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" id="pre_btn">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div>
                    </div>
                </div>             
                <div id="rolemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Role</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="roleform" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Role:</label>
                                        <input type="text" class="form-control" id="roledata" name="role">
                                          <input type="hidden" name="roleval" value="roleval">
                                    </div>
                                    <div class="fielderror"> </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" id="role_btn">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                            </div>
                        </div>
                    </div>
                </div>

             <!-- //edit -->

            <?php $Coursevalue = $this->employee_model->getcourse(); ?>

                <div id="nationalitymodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Nationality</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="nationform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label">Nationality </label>
                                          <input type="text" name="nationality" id="nationalityval"  class="form-control nationality"  minlength="" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-info" id="add_nation">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                               
                            </div>
                             </form>
                        </div>
                    </div>
                </div> 
                <div id="countrymodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Country</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="countryform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label">Country Name</label>
                                          <input type="text" name="country_name" id="country_name" value="" class="form-control" placeholder="" minlength="3" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-info" id="add_country">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                               
                            </div>
                             </form>
                        </div>
                    </div>
                </div>     <!-- tabindex="-1" -->
                <div id="statemodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add State</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="stateform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="country" value="" class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option>Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                          <input type="text" name="state_name" id="state_name" value="" class="form-control" placeholder="" minlength="3" >
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-info" id="add_state">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                               
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                 <!--  <div id="citymodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add City</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="cityform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="countryid"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                           <select name="state" id="stateid" value="" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select State</option>

                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                     <label class="control-label">City Name</label>
                                            <input type="text" name="city_name" id="city_name" value="" class="form-control" placeholder="" minlength="3" >

                                     </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-info" id="add_city">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                               
                            </div>
                             </form>
                        </div>
                    </div>
                </div> -->
                <!-- tabindex="-1" -->
                 <div id="districtmodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add District</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="districtform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="districtmodel_country"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                           <select name="state" id="districtmodel_state" value="" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select State</option>

                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                     <label class="control-label">District Name</label>
                                            <input type="text" name="district_name" id="district_name" value="" class="form-control" placeholder="" minlength="3" >

                                     </div>
                               
                            </div>
                            <div class="modal-footer">
                          
                                <button type="button" class="btn btn-primary" id="add_district">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                <!-- tabindex="-1" -->
                  <div id="citymodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add City</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="cityform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                        <label class="">Country</label>
                                        <select name="country" id="citymodel_country"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Country</option>
                                             <?Php foreach($countryvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                            <?php endforeach; ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">State Name</label>
                                           <select name="state" id="citymodel_state" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select State</option>

                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label">District Name</label>
                                           <select name="district" id="citymodel_district" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select District</option>

                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                     <label class="control-label">City Name</label>
                                            <input type="text" name="city_name" id="city_name"  class="form-control" placeholder="" minlength="3" >

                                     </div>
                               
                            </div>
                            <div class="modal-footer">
                          
                                <button type="button" class="btn btn-primary" id="add_city">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                  <!-- skills modal content -->
                        <div class="modal fade" id="skillsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Update Skills</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" id="skillsform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                             <label>Skill Name</label><span class="error"> *</span>
                                                    <input type="text" name="name"id="name" class="form-control form-control-line" placeholder="Ex: Angular JS" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="1" required> 
                                        </div>
                                         <div class="form-group">
                                             <label>Year of Experience</label><span class="error"> *</span>
                                                    <input type="number" name="yearofexp" id="yearofexp" class="form-control form-control-line" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="" required> 
                                         </div>
                                        
                                        <div class="form-group">
                                             <label>Competency Level</label>
                                                <select name="skilllevel" id="skilllevel" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select edu_validate">
                                                    <option value="Beginner">Beginner</option>
                                                    <option value="Intermediate">Intermediate</option>
                                                    <option value="Above Intermediate">Above Intermediate </option>
                                                    <option value="Advanced">Advanced</option>
                                                    <option value="Expert">Expert</option>
                                                </select>  
                                        </div>
                                        <div class="form-group">
                                              <label>Skill Last Used Year</label>
                                                    <input type="date" name="last_used_year"id="last_used_year" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control form-control-line" placeholder="Skill Used Last Year"> 
                                        </div>
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="em_id" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                         <button type="submit" id="update_skill" class="btn btn-info">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>      
                           <?php $eduvalue = $this->employee_model->geteducationmaster(); ?>     
                        <!-- sample modal content -->
                        <div class="modal fade" id="EduModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Update Education</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" id="educationmodal" enctype="multipart/form-data">
                                    <div class="modal-body">
	                                    <div class="form-group">
	                                        <label>Education Level</label>
                                                <select name="edulevel" id="edulevel" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select edulevel">
                                                  
                                         <option value="">Select Education Level</option>
                                            <?Php foreach($eduvalue as $value): ?>
                                             <option value="<?php echo $value->id ?>"><?php echo $value->education ?></option>
                                            <?php endforeach; ?>
                                               
                                        </select> 
                                               
	                                    </div>
                                         <div class="form-group">
                                              <label>Course</label>
                                        
                                                 <select name="course" id="course" class="form-control custom-select course"  >
                                                   <?Php foreach($Coursevalue as $value): ?>
                                                     <option value="<?php echo $value->cId ?>" ><?php echo $value->courseName ?></option>
                                                    <?php endforeach; ?> 
                                                </select>
                                         </div>
                                         <div class="form-group">
                                             <label>Institution Name</label>
                                                <input type="text" name="institute" id="institute" class="form-control form-control-line duty" placeholder="Institution Name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="7" required>
                                         </div>
	                                    <div class="form-group">
	                                        <label> From </label>
                                                <input type="date" name="from_year"id="from_year" class="form-control form-control-line company_name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="" minlength="2" required> 
	                                    </div>
	                                    <div class="form-group">
	                                        <input type="date" name="to_year" id="to_year" class="form-control form-control-line position_name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="" minlength="5" required> 
	                                    </div>
	                                    <div class="form-group">
	                                       <label>Percentage</label>
                                                <input type="number" name="percentage" id="percentage" class="form-control form-control-line duty" placeholder=" Enter Percentage" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="" required>  
	                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="emid" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                        <button type="submit" id="update_edu" class="btn btn-info">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>                        
                        <!-- sample modal content -->
                      
    
                        <?php $govtIDvalue = $this->employee_model->getgovtID(); ?>
                        <!-- Identity Card modal content -->
                        <div class="modal fade" id="IDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Identity Card Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="Update_GovIdentityCard" id="identitycardmodal" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label> ID Type</label>
                                                <select name="GIDType" id="GIDType" class="form-control custom-select" readonly >
                                                    <?Php foreach($govtIDvalue as $value): ?>
                                                     <option value="<?php echo $value->id ?>" ><?php echo $value->govID_name ?></option>
                                                    <?php endforeach; ?><!--  <?php  if(( $value->id == $basic->pre_id)){ echo 'selected';} ?>  -->
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>ID Number</label>
                                                <input type="text" name="GIDnumber" class="form-control form-control-line GIDnumber" placeholder="Enter the Number" minlength="3" required> 
                                            </div>
                                            <div class="form-group">
                                                <label>Expiry Date</label>
                                                <input type="date" name="GIDExpriy" class="form-control form-control-line GIDExpriy" placeholder="Expiry Date" minlength="7" required> 
                                            </div> 
                                               <div class="form-group">
                                               <label>Document </label>
                                                <input type="file" name="gov_doc" id="gov_doc" class="form-control"   > 
                                                 <div class="error"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="emp_id" value=""> 
                                            <input type="hidden" name="id" value=""> 
                                            <button type="submit" id="btn_govtid" class="btn btn-info">Submit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="govtModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Add New ID Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="govtidmodal">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Name of the ID</label>
                                                <input type="text" class="form-control" id="govID_name" name="govID_name" placeholder="Ex: Iqama">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" id="add_govtid">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- certificate-->
                         <div id="certificate_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Update Certification</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="certificateform" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <label> Certification Name</label>
                                                    <input type="text" name="certificate_name" id="certificate_name" class="form-control form-control-line certificate_validate" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="Certification Name" minlength="2" required> 
                                            </div>
                                            <div class="form-group">
                                                 <label>Certificate No</label>
                                                    <input type="text" name="certificate_no"id="certificate_no" class="form-control form-control-line certificate_validate" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="Certificate No" minlength="3" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Expiry Date</label>
                                                    <input type="date" name="certificate_expdate" id="certificate_expdate" class="form-control form-control-line "  placeholder=" Duty" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="" required> 
                                            </div>
                                            <div class="form-group">
                                                 <label>Document </label>
                                                <input type="file" name="certificate" id="certificate" class="form-control" value=""  > 
                                            </div>
                                           
                                             <input type="hidden" name="emid" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" id="update_certificate">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- add eduction document -->
                        <div id="edudocmodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="edudocform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label"> Name </label><span class="error"> *</span>
                                          <input type="text" name="edudoc_name" id="edudoc_name"  class="form-control nationality"  minlength="" required>
                                    </div>
                                    <div class="form-group">
                                         <label>Document</label><span class="error"> *</span>
                                        <input type="file" class="form-control" name="edufiles[]" id="edufiles" multiple required />
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
                                 <input type="hidden" name="edu_id" value="" id="edu_id">
                                 <button type="button" class="btn btn-info" id="save_edudoc">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                                
                            </div>
                             </form>
                        </div>
                    </div>
                </div> 
                <!-- edit experience -->
                  <?php $degvalue = $this->employee_model->getdesignation(); ?>
                  <div class="modal fade" id="ExpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Edit Experience </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="experiencemodal" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row">
                                        <div class="form-group col-md-6">
                                            <label> Company Name</label>
                                            <input type="text" name="exp_company"  class="form-control form-control-line company_name" placeholder="Company Name" minlength="2" required> 
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label>Designation </label><span class="error"> *</span>
                                        <select name="exp_com_position"  <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select"required>
                                            <option value="">Select Designation</option>
                                        <?Php foreach($degvalue as $value): ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->des_name ?></option>
                                        <?php endforeach; ?>
                                        </select> 
                                        </div>
                                        </div>
                                        <div class="row">
                                             <div class="form-group col-md-6">
                                            <label>Company website</label>
                                            <input type="text" name="exp_com_address"  class="form-control form-control-line duty" placeholder=" Company Website" minlength="7" required> 
                                        </div>
                                        <div class="form-group col-md-6">
                                           <label>Reason for Leaving</label>
                                            <input type="text" name="leaving_reason" class="form-control form-control-line duty" placeholder=" " required> 
                                        </div> 
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                    <label> From </label><span class="error"> *</span>
                                                    <input type="date" name="workstart"  class="form-control form-control-line company_name" placeholder="" minlength="2" required> 
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>To</label><span class="error"> *</span>
                                                    <input type="date" name="workend"  class="form-control form-control-line "  placeholder="" minlength="5" required> 
                                                </div>  
                                        </div>
                                        <div class="row">
                                             <div class="form-group col-md-6">
                                                    <label>Referrer Name</label>
                                                    <input type="text" name="referrer_name" class="form-control form-control-line duty"  > 
                                                </div> <div class="form-group col-md-6 ">
                                                    <label>Referrer Contact</label>
                                                    <input type="number" name="referrer_contact"  class="form-control form-control-line duty"  > 
                                                </div>
                                        </div>                                        
                                        <div class="row">
                                            <div class="form-group col-md-6 ">
                                                    <label>Referrer Email</label>
                                                    <input type="email" name="referrer_email" class="form-control form-control-line duty"  > 
                                                </div>
                                            
                                        </div>
                                    
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="em_id" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                         <button type="submit" class="btn btn-info" id="update_exp" >Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
             <!-- add experience document -->
                        <div id="expdocmodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Experience Document</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                              <form method="post" id="expdocform" enctype="multipart/form-data">
                            <div class="modal-body">
                              
                                    <div class="form-group">
                                         <label class="control-label">Document Name </label><span class="error"> *</span>
                                          <input type="text" name="expdoc_name" id="expdoc_name"  class="form-control nationality"  minlength="" required>
                                    </div>
                                    <div class="form-group">
                                         <label>Document</label><span class="error"> *</span>
                                        <input type="file" class="form-control" name="expfiles[]" id="expfiles" multiple required />
                                    </div>
                                    <div class="fielderror"> </div>
                               
                            </div>
                            <div class="modal-footer">
                                 <input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
                                 <input type="hidden" name="exp_id" value="" id="exp_id">
                                 <button type="button" class="btn btn-info" id="save_expdoc">Save</button>
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                                
                            </div>
                             </form>
                        </div>
                    </div>
                </div> 
                <!-- currency modal -->
                 <div id="currencyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Add New ID Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="savecurrency">
                                            <div class="form-group">
                                                 <label class="control-label">Currency Name</label><span class="error"> *</span>
                                                        <input type="text" name="currency_name" id="currency_name" value="" class="form-control" placeholder="" minlength="3" required><br>
                                                        <label class="control-label mt-3">Currency symbol </label><span class="error"> *</span>
                                                        <input type="text" name="currency_symbol" id="currency_symbol" value="" class="form-control" placeholder="" minlength="" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" id="add_currency">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- dependency -->
                          <div class="modal fade" id="DependencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Edit Dependency </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="dependencyform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row">
                                             <div class="form-group col-md-6 ">
                                                    <label>Dependent Name</label><span class="error"> *</span>
                                                    <input type="text" name="name" id="updatedependentname" class="form-control form-control-line duty" placeholder=" Name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="" required> 
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Dependent Relation</label><span class="error"> *</span>
                                                    <select name="relation" id="updatedependentrelation" placeholder="" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> class="form-control custom-select" required>
                                                         <option value="">Select Relation</option>
                                                          <option value="Father">Father</option>
                                                         <option value="Mother">Mother</option>
                                                         <option value="Wife">Wife</option>
                                                         <option value="Son">Son</option>
                                                         <option value="Daughter">Daughter</option>
                                                         <option value="Brother">Brother</option>
                                                         <option value="Sister">Sister</option>
                                                         <option value="Husband">Husband</option>
                                                        </select> 
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-md-6 ">
                                                    <label> Dependent DOB  </label><span class="error"> *</span>
                                                    <input type="date" name="dob" id="updatedependentdob" class="form-control form-control-line dob" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> placeholder="" minlength="" required> 
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Dependent Age</label><span class="error"> *</span>
                                                    <input type="number" name="age" id="updatedependentage" class="form-control form-control-line duty" placeholder="Age" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="" required> 
                                                </div>
                                        </div>
                                       </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="em_id" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                        <button type="submit" class="btn btn-info" id="update_dependency" >Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                  <!-- disability -->
                          <div class="modal fade" id="DisabilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Edit Dependency </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post"  id="disabilityform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row">
                                             <div class="form-group col-md-6 ">
                                                    <label>Disablitiy Name</label><span class="error"> *</span>
                                                    <input type="text" name="disability_name" id="disable_name" class="form-control form-control-line" placeholder=" Disablitiy Name" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="1" required> 
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Disablitiy Type</label><span class="error"> *</span>
                                                    <input type="text" name="disability_type" id="disable_type" class="form-control form-control-line" placeholder=" Disablitiy Type" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> readonly <?php } ?> minlength="1" required> 
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-md-12 ">
                                                   <label>Description</label>
                                                    <textarea class="form-control" id="disable_description" name="description" rows="3" placeholder="Message" rows="6" cols="50"></textarea>
                                                </div>
                                             
                                        </div>
                                       
                                      </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="em_id" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                        <button type="submit" class="btn btn-info" id="update_disability" >Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                                       <div class="modal fade" id="SalaryTypemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Salary Type</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="" id="typeform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                            <div class="form-group">
                                                <label class="control-label">Salary Type</label>
                                                <input type="text" name="typename" class="form-control" id="typename" minlength="4" maxlength="25" value="" required>
                                            </div>
                                         <!--    <div class="form-group">
                                                <label class="control-label">Create Date</label>
                                                <input type="date" name="createdate" class="form-control" id="recipient-name1"  value="">
                                            </div> -->                                          
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="id" value="" class="form-control" id="id">                                       
                                        
                                        <button type="submit" class="btn btn-primary" id="add_salarytype">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                          <div id="personaldoc_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Update Personal Document</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="personaldocform" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <label> Name</label>
                                                    <input type="text" name="title"  class="form-control" required="" aria-invalid="false"  style="text-transform: capitalize;" required>
                                            </div>
                                          
                                            <div class="form-group">
                                                <label class="">Document</label><span class="error"> *</span>
                                                <input type="file" name="file_url"  class="form-control" required="" aria-invalid="false" required>
                                            </div>
                                           
                                             <input type="hidden" name="emid" value=""> 
                                        <input type="hidden" name="id" value=""> 
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" id="update_personal">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

             <div id="edutypemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Education</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="edform" enctype="multipart/form-data">
                  
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Education Level</label>
                                <input type="text" class="form-control" id="educationlevel" name="education">
                                <!-- <input type="hidden" name="roleval" value="roleval"> -->
                            </div>
                            <div class="fielderror"> </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-info" id="edulevel_btn">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
