<?php $this->load->view('backend/header'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
<?php $this->load->view('backend/sidebar'); ?>
<style type="text/css">
/*	#example1 th:first-child{
    white-space: nowrap; 
    min-width: 10px;
    }
	#example1 th:nth-child(3){
	    white-space: nowrap; 
	    min-width: 50px !important;
	}
	#example1 th{
	    white-space: nowrap; 
	    min-width: 350px;
	}*/

  /*New*/
   /*.dataTables_filter{
    position: relative;
    left: 25%; 
	}
	.dataTables_wrapper .dataTables_paginate{
	 position: relative;
	    left: 25%; 
	}*/

	   .description-text {
        display: block;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .description-text.expanded {
        white-space: normal;
        overflow: visible;
    }
</style>
<div class="page-wrapper">
	<div class="message"></div>
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor"><i class="fa fa-user-secret" style="color:#1976d2"></i> <?php echo $basic->first_name .' '.$basic->last_name; ?></h3>
		</div>
		<div class="col-md-7 align-self-center">
			<!-- <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Profile</li>
			</ol> -->
		</div>
	</div>
	<?php $degvalue = $this->employee_model->getdesignation(); ?>
	<?php $depvalue = $this->employee_model->getdepartment();
	
	?>
	<?php $Coursevalue = $this->employee_model->getcourse(); ?>
	<?php $prefixvalue = $this->employee_model->getprefix(); ?>
	<?php $govtIDvalue = $this->employee_model->getgovtID(); ?>
	<?php $rolevalue = $this->employee_model->getemprole(); ?>
	<?php $eduvalue = $this->employee_model->geteducationmaster(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-xlg-12 col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4 col-lg-2 col-sm-6">
								<div class="card-body">
									
									<?php if(!empty($basic->em_image)){ ?>
									<img src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $basic->em_image; ?>" class="img-circle" width="150" />
									<?php } else { ?>
									<img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle" width="150" alt="<?php echo $basic->first_name ?>" title="<?php echo $basic->first_name ?>"/>
									<?php } ?>
									
								</div>
							</div>
							<div class="col-md-6 col-lg-10 col-sm-6">
								<div class="card-body">
									
									<h4>
									<?php echo $basic->first_name .' '.$basic->last_name; ?>
									</h4>
									<h6 class="card-subtitle"><?php echo $basic->des_name; ?></h6>
									<small class="text-muted">Email address </small>
									<h6><?php echo $basic->em_email; ?></h6>
									<small class="text-muted p-t-30 db">Phone</small>
									<h6><?php echo $basic->em_phone; ?></h6>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wrapper pt-0">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					
					<!-- Nav tabs -->
					<div class="vtabs" style="
    width: 100%;
">
						<ul class="nav nav-tabs tabs-vertical" role="tablist">
							
							<li class="nav-item" >
								<a class="nav-link active" data-toggle="tab" href="#home" title="Official" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"> Official </span></a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#personal" role="tab" style="font-size: 14px;" title="Personal">
									<span class="hidden-sm-up"><i class="fa fa-address-book-o"></i></span> <span class="hidden-xs-down">Personal</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#education" title="Education" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa fa-book"></i></span> <span class="hidden-xs-down">Education</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#experience" title="Experience" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa  fa-desktop"></i></span> <span class="hidden-xs-down">Experience</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#training" title="Training" role="tab" style="font-size: 14px;">
										<span class="hidden-sm-up"><i class="mdi mdi-receipt"></i></span> <span class="hidden-xs-down">Training & Certification</span></a>
									</li>
									<!-- <li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#visa_and_immigration" title="Visa" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa fa-drivers-license-o"></i></span> <span class="hidden-xs-down">Visa and Immigration</span></a>
									</li> -->
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#skills" title="Skills" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="mdi mdi-clipboard-account"></i></span> <span class="hidden-xs-down">Skills</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#officialdoc" title="Official Document" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="mdi mdi-book-open"></i></span> <span class="hidden-xs-down">Official Documents</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#document" title="Personal Document" role="tab" style="font-size: 14px;"><span class="hidden-sm-up"><i class="mdi mdi-book-open-variant"></i></span> <span class="hidden-xs-down">Personal  Document</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#salary" title="Salary" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa fa-money"></i></span> <span class="hidden-xs-down">Salary</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bank" title="Bank" role="tab" style="font-size: 14px;"><span class="hidden-sm-up"><i class="fa fa-bank "></i></span> <span class="hidden-xs-down"> Bank Account</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#dependency" title="Dependency" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa  fa-users"></i></span> <span class="hidden-xs-down">Dependency</span></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#disablity" title="Disability" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa fa-child"></i></span> <span class="hidden-xs-down">Disability</span></a>
									</li>	
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#policy" title="Policies" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="fa fa-child"></i></span> <span class="hidden-xs-down">Policies</span></a>
									</li>
									<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#password1" title="Password" role="tab" style="font-size: 14px;">
											<span class="hidden-sm-up"><i class="mdi mdi-account-circle"></i></span> <span class="hidden-xs-down">Change Password</span></a>
										</li>
										<?php } else { ?>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#password1" title="Password" role="tab" style="font-size: 14px;"> <span class="hidden-sm-up"><i class="mdi mdi-account-circle"></i></span> <span class="hidden-xs-down">Change Password</span></a>
										</li>
										<?php } ?>
									</ul>
									<!-- Tab panes -->
									<div class="tab-content">
										<div class="tab-pane active" id="home" role="tabpanel">
											<div class="p-20">
												<h3>Official Details </h3>
												<form class="row" id="upd_emp_form" method="post" enctype="multipart/form-data">
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label class="">Business Unit</label><span class="error"> *</span>
														<select name="busunit" id="busunit"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
															<option value="">Select Business Unit</option>
															
															<?Php
															//echo $basic->busunit;
															foreach($businessunitvalue as $value): ?>
															<option value="<?php echo $value->id ?>" <?php if( $value->id == $basic->busunit){ echo 'selected';} ?>> <?php echo $value->name ?></option>
															
															<?php endforeach; ?>
														</select>
															<a href="<?php echo base_url('settings/Add_BusinessUnit')?>" target="_blank"  class="float-right modalbtn">Add BusinessUnit</a>
													</div>
													
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Employee Code </label>
														<input type="text" name="em_code" id="em_code" class="form-control form-control-line" value="<?php echo $basic->em_code; ?>"  style="text-transform: uppercase;">
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Employement Status </label><span class="error"> *</span>
														<select name="em_status" id="em_status" class="form-control custom-select search" required style="width: 100%; min-height: 38px;">
															<option value="">Select Employee Status</option>
															<!-- <option value="<?php echo $basic->em_status; ?>" selected><?php echo $basic->em_status; ?></option> -->
															<option value="Contract" <?php if(!empty($basic->em_status)) if($basic->em_status === "Contract"){echo 'selected';}?>>Contract</option>
															<option value="Deputation"  <?php if(!empty($basic->em_status)) if($basic->em_status === "Deputation"){echo 'selected';}?>>Deputation</option>
															<option value="Full Time"  <?php if(!empty($basic->em_status)) if($basic->em_status === "Full Time"){echo 'selected';}?>>Full Time</option>
															<option value="Part Time"  <?php if(!empty($basic->em_status)) if($basic->em_status === "Part Time"){echo 'selected';}?>>Part Time</option>
															<option value="Permanent"  <?php if(!empty($basic->em_status)) if($basic->em_status === "Permanent"){echo 'selected';}?>>Permanent</option>
															<option value="Probationary"  <?php if(!empty($basic->em_status)) if($basic->em_status === "Probationary"){echo 'selected';}?>>Probationary</option>
															<option value="Temporary"  <?php if(!empty($basic->em_status)) if($basic->em_status === "Temporary"){echo 'selected';}?>>Temporary</option>
														</select>
													</div>
													<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>  <?php } else { ?>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>User Role Permission </label>
														<select name="role" id="role" class="form-control custom-select" style="width: 100%; min-height: 38px;" required >
															
															<!-- <option value="<?php echo $basic->em_role; ?>" selected><?php echo $basic->em_role; ?></option> -->
															<option value="" >Select Role</option>
															<?Php foreach($rolevalue as $value): ?>
															<option value="<?php echo $value->id ?>" <?php  if(( $value->id === $basic->em_role)){ echo 'selected';} ?>><?php echo $value->role ?></option>
															<?php endforeach; ?>
														</select>
														<a href="" data-target="#rolemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtn">Add Role</a>
													</div>
													<?php } ?>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Prefix</label>
														<select name="prefix" id="prefix" class="form-control custom-select" style="width: 100%; min-height: 38px;">
															<!--  <option value="<?php echo $basic->id; ?>"><?php echo $basic->prefixname; ?></option> -->
															<?Php foreach($prefixvalue as $value): ?>
															<option value="<?php echo $value->id ?>"<?php  if(( $value->id == $basic->pre_id)){ echo 'selected';} ?>><?php echo $value->prefixname ?></option>
															<?php endforeach; ?>
														</select>
														<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#prefixModal" class="modalbtn">Add Prefix</a>
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>First Name</label>
														<input type="text" class="form-control form-control-line" placeholder="Enter First Name" name="fname" style="text-transform: capitalize;" value="<?php echo $basic->first_name; ?>"  minlength="3" required>
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Middle Name</label>
														<input type="text" class="form-control form-control-line" placeholder="Enter Middle Name" name="mname" value="<?php echo $basic->middle_name; ?>"  minlength="3">
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Last Name </label>
														<input type="text" style="text-transform: capitalize;" id="" name="lname" class="form-control form-control-line" value="<?php echo $basic->last_name; ?>" placeholder="Enter Last Name"  required>
													</div>
													
													
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Department</label>
														<select name="dept" id="dept"  class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
															
															<option value="">Select Department</option>
														<!-- 	<?php if(!empty($basic->dep_id)){?>
															<option value="<?php echo $basic->dep_id; ?>" selected> <?php
																if(isset($basic->dep_id)) {
																$id = $basic->dep_id;
																$data = $this->employee_model->matchdep($id);
																
																echo $data->depname." (".$data->depcode.")";}
															?></option>
															<?php } ?> -->
														</select>
														
														<a href="<?php echo base_url('settings/AddOrganisationDepartment')?>" target="_blank"  class="float-right modalbtn">Add Department</a>
													</div>
																
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Report To</label><!-- <span class="error"> *</span> -->
														<select name="reportto" id="reportto"  class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
															
															<option value="">Select Employee</option>

															
														<!-- 	<?php if(!empty($basic->report_to)){?>
															<option value="<?php echo $basic->report_to; ?>" selected> <?php
																if(isset($basic->report_to)) {
																$id = $basic->report_to;
																$edata = $this->employee_model->matchemp($id);
																
																echo $edata->first_name .' '.$edata->last_name;}
															?></option>
															<?php } ?> -->
												
														</select>
														
														
													</div>
													
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Designation</label>
														<select name="deg" id="deg"  class="form-control custom-select" style="width: 100%; min-height: 38px;" required>
															
															<?Php foreach($degvalue as $value): ?>
															<option value="<?php echo $value->id ?>" <?php if(( $value->id == $basic->des_id)){ echo 'selected';} ?> ><?php echo $value->des_name ?></option>
															<?php endforeach; ?>
														</select>
														<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#desmodel" class="modalbtn">Add Designation</a>
													</div>
												
													
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Date Of Joining </label>
														<input type="date"  id="joindate" name="joindate" class="form-control" value="<?php echo $basic->em_joining_date; ?>" placeholder="" max="<?php echo date("Y-m-d"); ?>">
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Date of Leaving</label>
														<input type="date" id="leavedate" name="leavedate" class="form-control"  value="<?php echo $basic->em_contact_end; ?>" placeholder="">
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Email </label>
														<input type="email" id="email" name="email" class="form-control"  value="<?php echo $basic->em_email; ?>" placeholder="email@mail.com" minlength="7" required>
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Contact Number </label>
														<input type="text" class="form-control" placeholder="" name="contact"  value="<?php echo $basic->em_phone; ?>" minlength="10" maxlength="15" required>
													</div>
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>User Image</label><span class="error"></span><br>
														<input type="file" name="em_image"  id="em_image"   class="form-control" accept="image/png,  image/jpeg" >

														<span><span style="color: #ef5350;font-size: 15px;">*</span>The image size must not exceed 1MB.</span><br>
														<span><span style="color: #ef5350;font-size: 15px;">*</span>Please upload JPG, PNG images only.</span><br>
														<span><span style="color: #ef5350;font-size: 15px;">*</span>Max image dimensions: 600x600 pixels.</span>
													</div>
													
													<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 m-t-10">
														<label>Status </label>
														<select name="status" id="status" class="form-control custom-select" >
															<option value="1"   <?php if($basic->empstatus == 1){ echo 'selected';} ?>>ACTIVE</option>
															<option value="0"  <?php if($basic->empstatus == 0){ echo 'selected';} ?>>INACTIVE</option>
														</select>
													</div>
													
													
												
													<div class="form-actions col-md- col-sm-12 col-12" >
														<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
														<button type="submit" class="btn btn-info" id="update_employee"> Save</button>
														<button type="reset" class="btn btn-info" id="">Reset</button>
														<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
													</div>
													
												</form>
											</div>
										</div>
										<!--Official Documents-->
										<div class="tab-pane p-20" id="officialdoc" role="tabpanel">
											<h3>Official Documents</h3><!--  action="Add_GovIdentityCard" -->
											<form class="row" id="govtid_form" method="post" enctype="multipart/form-data">
												<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
													<label> ID Type</label><span class="error"> *</span>
													<select name="gov_id" id="gov_id" class="form-control custom-select" style="width: 100%; min-height: 38px;" required>
														<option value="" > Select Id Type</option>
														<?Php foreach($govtIDvalue as $value): ?>
														<option value="<?php echo $value->id ?>"><?php echo $value->govID_name ?></option>
														<?php endforeach; ?>
													</select>
													<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#govtModal" class="modalbtn">Add New ID Type</a>
													<div class="error"></div>
												</div>
												<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
													<label>ID Number</label><span class="error"> *</span>
													<input type="text" name="gid_number" id="gid_number" class="form-control form-control-line GIDnumber" placeholder="Enter the Id Number" minlength="8" required>
													<div class="error"></div>
												</div>
												<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
													<label>Document </label>
													<input type="file" name="gov_doc" id="gov_doc" class="form-control" value=""  >
													<div class="error"></div>
												</div>
												<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
													<label>Expiry Date</label><span class="error"> *</span>
													<input type="date" name="gid_expiry" id="gid_expiry" class="form-control form-control-line GIDExpriy" placeholder="Expiry Date" minlength="7" required>
													<div class="error"></div>
												</div>
												
												<div class="form-actions col-md-12" style="">
													<input type="hidden" name="emp_id" id="emp_id" value="<?php echo $basic->em_id; ?>">
													<button type="submit" id="govtid" class="btn btn-info"> Save</button>
														<button type="reset" class="btn btn-info" id="">Reset</button>
													<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
												</div>
												
											</form>
											<div class="table-responsive m-t-4" >
												<table id="" class="table table-bordered table-striped" style="width:100%">
													<!-- myTable -->
													<thead>
														<tr>
															<th>S.No </th>
															<th>ID Name</th>
															<th>ID Number</th>
															<th>Expiry Date </th>
																<th>Attachments</th>
															<th>Action</th>
														
														</tr>
													</thead>
													<tbody>
														<?php $cnt=1;
														foreach($identitycards as $value):  ?>
														<tr>
															<td><?php echo $cnt; ?></td>
															<td><?php echo $value->govID_name ?></td>
															<td><?php echo $value->gid_number ?></td>
															<td><?php echo $value->gid_expiry ?></td>
															<td>
																<a href="<?=base_url()?>assets/uploads/govdoc/<?php echo $value->gov_doc ?>" title="Attachments" class="btn btn-sm btn-warning waves-effect waves-light " target="_blank"><i class="fa fa-file-o"></i></a>
															</td>
															<td class="jsgrid-align-center ">
																<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
																<?php } else { ?>
																<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light identitycard" data-id="<?php echo $value->gid ?>"><i class="fa fa-pencil-square-o"></i></a>
																<button   title="Delete" class="btn btn-sm btn-info waves-effect waves-light del_gid " ><i class="fa fa-trash-o"></i></button>
																<input type="hidden" name="gid" value="<?php echo $value->gid;?>" id="gid">
																<?php } ?>
															</td>
															
														</tr>
														<?php $cnt=$cnt+1; endforeach; ?>
													</tbody>
												</table>
											</div>
											
										</div>
										<!--personal tab-->
										<div class="tab-pane p-20" id="personal" role="tabpanel">
											<h3 class="card-title">Personal Information</h3>
											<form class="row" id="personal_data" method="post" enctype="multipart/form-data">
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Gender </label><span class="error"> *</span>
													<select name="gender"  id="gender" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
														<option value="">Select gender</option>
														<option value="Male"   <?php if(!empty($personalvalue->gender)) if($personalvalue->gender === "Male"){echo 'selected';}?>>Male</option>
														<option value="Female"  <?php if(!empty($personalvalue->gender)) if($personalvalue->gender === "Female"){echo 'selected';}?>>Female</option>
														<option value="Transgender"  <?php if(!empty($personalvalue->gender)) if($personalvalue->gender === "Transgender"){echo 'selected';}?>>Transgender</option>
													</select>
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Blood Group </label>
													<select name="bloodgroup"name="bloodgroup"  value="<?php echo $basic->em_blood_group; ?>" class="form-control custom-select search" style="width: 100%; min-height: 38px;">
														<option value="">Select Blood group</option>
														<option value="O+" <?php if(!empty($personalvalue->bloodgroup)) if($personalvalue->bloodgroup === "O+"){echo 'selected';}?>>O+</option>
														<option value="O-" <?php  if(!empty($personalvalue->bloodgroup))  if($personalvalue->bloodgroup === "O-"){echo 'selected';}?>>O-</option>
														<option value="A+" <?php  if(!empty($personalvalue->bloodgroup))  if($personalvalue->bloodgroup === "A+"){echo 'selected';}?>>A+</option>
														<option value="A-" <?php  if(!empty($personalvalue->bloodgroup))  if($personalvalue->bloodgroup === "A-"){echo 'selected';}?>>A-</option>
														<option value="B+" <?php  if(!empty($personalvalue->bloodgroup))  if($personalvalue->bloodgroup === "B+"){echo 'selected';}?>> B+</option>
														<option value="B-" <?php   if(!empty($personalvalue->bloodgroup)) if($personalvalue->bloodgroup === "B-"){echo 'selected';}?>>B-</option>
														<option value="AB+" <?php  if(!empty($personalvalue->bloodgroup))  if($personalvalue->bloodgroup === "AB+"){echo 'selected';}?>>AB+</option>
													</select>
												</div>
												
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Nationality</label><span class="error"> *</span>
													<select name="nationality" id="nationality" class="form-control custom-select search" style="width: 100%; min-height: 38px;" required >
														
														<option value="" >Select Nationality</option>
														<?Php foreach($nationalityvalue as $value): ?>
														<option value="<?php echo $value->id ?>" <?php  if(!empty($personalvalue->nationality)) if($personalvalue->nationality == $value->id){echo 'selected';}?>><?php echo $value->nationality_name ?></option>
														<?php endforeach; ?>
													</select>
													<a href="" data-target="#nationalitymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtn">Add Nationality</a>
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Date Of Birth </label><span class="error"> *</span>
													<input type="date" id="dob" name="dob" class="form-control"value="<?php if(!empty($personalvalue->dob)) echo $personalvalue->dob  ?>"   required max="<?php echo date("Y-m-d"); ?>">
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Marital Status </label><span class="error"> *</span>
													<select name="maritalstatus"id="maritalstatus"  class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
														<option value="" >Select Marital status</option>
														
														<option value="Married" <?php if(!empty($personalvalue->maritalstatus)) if($personalvalue->maritalstatus ==="Married"){echo 'selected';}?>
														>Married</option>
														<option value="Widowed" <?php if(!empty($personalvalue->maritalstatus)) if($personalvalue->maritalstatus == "Widowed"){echo 'selected';}?>>Widowed </option>
														<option value="Separated" <?php if(!empty($personalvalue->maritalstatus)) if($personalvalue->maritalstatus === "Separated"){echo 'selected';}?>>Separated </option>
														<option value="Divorced" <?php if(!empty($personalvalue->maritalstatus)) if($personalvalue->maritalstatus === "Divorced"){echo 'selected';}?>>Divorced </option>
														<option value="Unmarried" <?php if(!empty($personalvalue->maritalstatus)) if($personalvalue->maritalstatus === "Unmarried"){echo 'selected';}?>>Unmarried</option>
														
													</select>
												</div>
												<div class="col-md-12 mt-3">
													<h3 class="card-title">PERMANENT ADDRESS</h3>
													
													
													<input type="checkbox" id="same_address" name="same_address" value="same_address"  <?php if(isset($permanent->address)) { echo 'checked'; } ?>>
													<label for="same_address"> Check if permanent and current address are same.</label>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-6">
															<label>Street</label><span class="error"> *</span>
															<textarea name="permanentaddress" style="text-transform: capitalize;" id="permanentaddress" value="<?php if(!empty($permanent->address)) echo $permanent->address  ?>"  class="form-control" rows="12" minlength="" required><?php if(!empty($personalvalue->permanentaddress)) echo $personalvalue->permanentaddress  ?></textarea>
														</div>
														<div class="col-md-6">
															<div class="row">
																<div class="col-md-6">
																	<label class="">Country</label><span class="error"> *</span>
																	<select name="permanentcountry" id="permanentcountry" value="" class="form-control custom-select search validate permanentcountry" style="width: 100%; min-height: 38px;" required>
																		<option value="">Select Country </option>
																		<?Php foreach($countryvalue as $cvalue): ?>
																		<?=$cvalue->id?>
																		<option value="<?php echo $cvalue->id ?>" <?php if(!empty($personalvalue->permanentcountry))  if($personalvalue->permanentcountry === $cvalue->id){echo 'selected';}?>><?php echo $cvalue->country_name ?></option>
																		
																		<?php endforeach; ?>
																		
																	</select>
																	<a href="" data-target="#countrymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add Country</a>
																</div>
																<div class="col-md-6 ">
																	<label class="">State</label><span class="error"> *</span>
																	<select name="permanentstate" id="permanentstate" value="" class="form-control custom-select search validate permanentstate" style="width: 100%; min-height: 38px;" required>
																		<option value="">Select State</option>
																		<?php if(!empty($personalvalue->permanentstate)){?>
																		<option value="<?php echo $personalvalue->permanentstate; ?>" selected> <?php
																			$id = $personalvalue->permanentstate;
																			$data = $this->settings_model->matchstate($id); echo $data->state_name;
																		?></option>
																		<?php }?>
																		
																	</select>
																	<a href="" data-target="#statemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add State</a>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<label class="">District</label><span class="error"> *</span>
																	<select name="permanentdistrict" id="permanentdistrict" value="" class="form-control custom-select search validate permanentdistrict" style="width: 100%; min-height: 38px;" required>
																		<option value="">Select District</option>
																		<?php if(!empty($personalvalue->permanentdistrict)){?>
																		<option value="<?php echo $personalvalue->permanentdistrict; ?>" selected> <?php
																			$id = $personalvalue->permanentdistrict;
																			$data = $this->settings_model->matchdistrict($id); echo $data->district_name;
																		?></option>
																		<?php }?>
																	</select>
																	<a href="" data-target="#districtmodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add District</a>
																</div>
																<div class="col-md-6">
																	<label class="">City</label><span class="error"> *</span>
																	<select name="permanentcity" id="permanentcity" value="" class="form-control custom-select search validate permanentcity" style="width: 100%; min-height: 38px;" required>
																		<option value="">Select City</option>
																		<?php if(!empty($personalvalue->permanentcity)){?>
																		<option value="<?php echo $personalvalue->permanentcity; ?>" selected> <?php
																			$id = $personalvalue->permanentcity;
																			$data = $this->settings_model->matchcity($id); echo $data->city_name;
																		?></option>
																		<?php }?>
																		
																	</select>
																	<a href="" data-target="#citymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add City</a>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6 ">
																	<label>Pin Code </label><span class="error"> *</span>
																	<input type="text" name="permanentpincode" id="permanentpincode" class="form-control form-control-line permanentpincode" value="<?php if(!empty($personalvalue->permanentpincode)) echo $personalvalue->permanentpincode  ?>"  required>
																</div>
															</div>
														</div>
														
													</div>
												</div>
											
												<div class="col-md-12 mt-3">
													<h3 class="card-title">PRESENT ADDRESS</h3>
													<div class="">
														<div class="row">
															<div class="col-md-6">
																<label>Street</label><span class="error"> *</span>
																<textarea name="presentaddress" style="text-transform: capitalize;" id="presentaddress"   class="form-control" rows="12" minlength="" required><?php if(!empty($personalvalue->presentaddress)) echo $personalvalue->presentaddress  ?></textarea>
															</div>
															<div class="col-md-6">
																<div class="row">
																	<div class="col-md-6">
																		<label class="">Country</label><span class="error"> *</span>
																		<select name="presentcountry" id="presentcountry" class="form-control custom-select search validate presentcountry" style="width: 100%; min-height: 38px;" required>
																			<option value="">Select Country</option>
																			<?Php foreach($countryvalue as $value): ?>
																			
																			<option value="<?php echo $value->id ?>" <?php if(!empty($personalvalue->presentcountry))  if($personalvalue->presentcountry == $value->id){echo 'selected';}?>><?php echo $value->country_name ?></option>
																			
																			<?php endforeach; ?>
																			
																		</select>
																		<a href="" data-target="#countrymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add Country</a>
																	</div>
																	<div class="col-md-6">
																		<label class="">State</label><span class="error"> *</span>
																		<select name="presentstate" id="presentstate"  class="form-control custom-select search validate presentstate" style="width: 100%; min-height: 38px;" required>
																			<option value="">Select State</option>
																			<?php if(!empty($personalvalue->presentstate)){?>
																			<option value="<?php echo $personalvalue->presentstate; ?>" selected> <?php
																				$id = $personalvalue->presentstate;
																				$data = $this->settings_model->matchstate($id); echo $data->state_name;
																			?></option>
																			<?php }?>
																		</select>
																		<a href="" data-target="#statemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add State</a>
																	</div>
																	
																</div>
																<div class="row">
																	<div class="col-md-6">
																		<label class="">District</label><span class="error"> *</span>
																		<select name="presentdistrict" id="presentdistrict" value="" class="form-control custom-select search validate presentdistrict" style="width: 100%; min-height: 38px;" required>
																			<option value="">Select District</option>
																			<?php if(!empty($personalvalue->presentdistrict)){?>
																			<option value="<?php echo $personalvalue->presentdistrict; ?>" selected> <?php
																				$id = $personalvalue->presentdistrict;
																				$data = $this->settings_model->matchdistrict($id); echo $data->district_name;
																			?></option>
																			<?php }?>
																		</select>
																		<a href="" data-target="#districtmodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add District</a>
																	</div>
																	<div class="col-md-6">
																		<label class="">City</label><span class="error"> *</span>
																		<select name="presentcity" id="presentcity" class="form-control custom-select search validate presentcity" style="width: 100%; min-height: 38px;" required>
																			<option value="">Select City</option>
																			<?php if(!empty($personalvalue->presentcity)){?>
																			<option value="<?php echo $personalvalue->presentcity; ?>" selected> <?php
																				$id = $personalvalue->presentcity;
																				$data = $this->settings_model->matchcity($id); echo $data->city_name;
																			?></option>
																			<?php }?>
																			
																		</select>
																		<a href="" data-target="#citymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right ">Add City</a><!-- //modalbtn -->
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-md-6">
																		<label>Pin Code </label><span class="error"> *</span>
																		<input type="text" name="presentpincode" id="presentpincode" class="form-control form-control-line presentpincode" value="<?php if(!empty($personalvalue->presentpincode)) echo $personalvalue->presentpincode  ?>"  required>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												
												
												<div class="col-md-12 m-t-3">
													<h3 class="card-title">Emergency Contact Details </h3>
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Name </label><span class="error"> *</span>
													<input type="text" name="contactname" id="contactname" class="form-control form-control-line" value="<?php if(!empty($personalvalue->contactname)) echo $personalvalue->contactname  ?>"  style="text-transform: capitalize;" required>
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Contact No </label><span class="error"> *</span>
													<input type="number" name="contactno" id="contactno" class="form-control form-control-line" value="<?php if(!empty($personalvalue->contactno)) echo $personalvalue->contactno  ?>"  required>
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Alternative Contact No</label><span class="error"> </span>
													<input type="number" name="altercontact" id="altercontact" class="form-control form-control-line" value="<?php if(!empty($personalvalue->altercontact)) echo $personalvalue->altercontact  ?>" >
												</div>
												<div class="form-group col-lg-3 col-sm-6 col-md-4 col-xs-6 ">
													<label>Email ID </label><span class="error"> </span>
													<input type="email" name="contactemail" id="contactemail" value="<?php if(!empty($personalvalue->contactemail)) echo $personalvalue->contactemail  ?>"  class="form-control form-control-line"  >
												</div>
												
												<div class=" col-md-12 mt-3">
													<input type="hidden" name="emid" value="<?php echo $basic->em_id ?>">
													<input type="hidden" name="eid" value="<?php echo $basic->eid ?>">
													<input type="hidden" name="id" value="<?php if(!empty($personalvalue->id)) echo $personalvalue->id  ?>">
													<button type="submit" class="btn btn-info"
													id="add_personal"> Save</button>
													<button type="reset" class="btn btn-info" id="">Reset</button>
													<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
												</div>
												<?php  ?>
											</form>
										</div>
										<!--Education tab-->
										<div class="tab-pane p-20" id="education" role="tabpanel">
											<h3>Add Education</h3>
											<form class="row"  method="post" enctype="multipart/form-data" id="insert_education">
												<span id="error"></span>
												<div class="form-group col-md-4 col-sm-6 m-t-4">
													<label>Education Level</label><span class="error"> *</span>
													<select name="edulevel" id="edulevel"  class="form-control custom-select edu_validate search" required>
														<option value="">Select Education Level</option>
														<?Php foreach($eduvalue as $value): ?>
														<option value="<?php echo $value->id ?>"><?php echo $value->education ?></option>
														<?php endforeach; ?>
													</select>
														<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#edutypemodel" class="modalbtn">Add Education</a>
												</div>
												<div class="form-group col-md-4 col-sm-6 m-t-4">
													<label>Course</label><span class="error"> *</span>
													<select name="course" id="course"
														
														class="form-control custom-select edu_validate search" required>
														<option value="">Select Course</option>
														
														
													</select>
													
													<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#coursemodel" class="modalbtn">Add Course</a>
												</div>
												<div class="form-group col-md-4 col-sm-6 m-t-4">
													<label>Institution Name</label><span class="error"> *</span>
													<input type="text" name="institute" id="institute" class="form-control form-control-line duty edu_validate" placeholder="Institution Name"  minlength="7" style="text-transform: capitalize;" required>
												</div>
												<div class="form-group col-md-4 col-sm-6 m-t-4">
													<label> From </label><span class="error"> *</span>
													<input type="date" name="from_year"id="from_year" class="form-control form-control-line company_name edu_validate"  placeholder="" minlength="2" required>
												</div>
												<div class="form-group col-md-4 col-sm-6 m-t-4">
													<label>To</label><span class="error"> *</span>
													<input type="date" name="to_year" id="to_year" class="form-control form-control-line position_name edu_validate"  placeholder="" minlength="5" required>
												</div>
												<div class="form-group col-md-4 col-sm-6 m-t-4">
													<label>Percentage</label><span class="error"> </span>
													<input type="number" name="percentage" id="percentage" class="form-control form-control-line duty edu_validate" placeholder=" Enter Percentage"  minlength="" >
												</div>
											
												<div class="form-actions col-md-12" style="">
													<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
													<button type="submit" class="btn btn-info" id ="add_edu" name ="add_edu"> Save</button>
													<button type="reset" class="btn btn-info" id="">Reset</button>
													<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
												</div>
												
											</form>
											<div class="table-responsive m-t-40 ">
												<table id="educationtable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" style="width:100%">
													<!--   <div class="table-responsive m-t-40">
														<table id="educationtable" class="table table-bordered table-striped"> -->
															<thead>
																<tr>
																	<th>ID </th>
																	<th>Education Level</th>
																	<th>Institution Name</th>
																	<th>Course</th>
																	<th>From</th>
																	<th>To</th>
																	<th>Percentage</th>
																	<th>Action</th>
																</tr>
															</thead>
															
															<tbody>
																<?php $i = 1;
																foreach($education as $value): ?>
																<tr>
																	<td><?php echo $i ?></td>
																	<td><?php
																		if($value->edulevel){
																		$elevel = $value->edulevel;
																		$sql = "Select * from educationmaster where isActive = 1 And id = $elevel ";
																		$query  = $this->db->query($sql);
																		$result = $query->row();
																		echo $result->education;
																		}
																		?>
																		
																	</td>
																	<td><?php echo $value->institute ?></td>
																	<td><?php
																		if($value->course){
																		$cid = $value->course;
																		$sql = "Select * from ms_coursetype where isActive = 1 And cId = $cid ";
																		$query  = $this->db->query($sql);
																		$result = $query->row();
																		echo $result->courseName;
																		}
																	?></td>
																	<td><?php echo $value->from_year ?></td>
																	<td><?php echo $value->to_year ?></td>
																	<td><?php echo $value->percentage ?></td>
																	<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
																	<?php } else { ?>
																	<td class="jsgrid-align-center ">
																		<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light education tool" title="Edit" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
																		<button  title="Delete" class="btn btn-sm btn-info waves-effect waves-light deledu tool" title="Delete"  data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></button>
																		<button   id='edu_doc' class="btn btn-sm btn-info waves-effect waves-light edu_doc tool modalbtn"data-target="#edudocmodel" data-toggle="modal" value="<?php echo $value->id ?>" title="Add Document"><i class="fa fa-paperclip"></i></button>
																		<button   id='view_edu' class="btn btn-sm btn-info waves-effect waves-light tool" title="View Documents" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="<?php echo $value->id ?>"><i class="fa fa-eye"></i></button>
																		<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
																		<input type="hidden" name="id" value="<?php echo $value->id;?>" id="id">
																	</td>
																	<?php } ?>
																</tr>
																<?php $i++;
																endforeach; ?>
															</tbody>
														</table>
													</div>
													<div class="collapse" id="collapseExample">
														<div class="card card-body edu_document_view">
															<table  class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th>ID </th>
																		<th>Document Name</th>
																		<th>Attachment</th>
																		<th>Action</th>
																	</tr>
																</thead>
																<tbody id="edudocview">
																</tbody>
																
															</table>
														</div>
													</div>
												</div>
												<!--Experience tab-->
												<div class="tab-pane p-20" id="experience" role="tabpanel">
													<h3>Add Experience</h3>
													<form class="row" id="Experience_form" method="post" enctype="multipart/form-data">
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label> Company Name</label><span class="error"> *</span>
															<input type="text" name="exp_company" class="form-control form-control-line exp_company"  placeholder="Company Name" minlength="2" style="text-transform: capitalize;" required>
														</div>
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label>Company Website</label>
															<input type="text" name="exp_com_address" class="form-control form-control-line exp_com_address"  minlength="5" >
														</div>
														
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label>Designation </label><span class="error"> *</span>
															<select name="exp_com_position" id="exp_com_position"  class="form-control custom-select search"required>
																<option value="">Select Designation</option><!-- <option value="<?php echo $basic->id; ?>"><?php echo $basic->des_name; ?></option> -->
																<?Php foreach($degvalue as $value): ?>
																<option value="<?php echo $value->id ?>" ><?php echo $value->des_name ?></option>
																<?php endforeach; ?>
															</select>
															<a href="#desmodel" data-target="#desmodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtn">Add Designation</a>
														</div>
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label> From </label><span class="error"> *</span>
															<input type="date" name="workstart" id="workstart" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
														</div>
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label>To</label><span class="error"> *</span>
															<input type="date" name="workend" id="workend" class="form-control form-control-line "  placeholder="" minlength="5" required>
														</div>
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label>Reason for Leaving</label><span class="error"> *</span>
															<input type="text" name="leaving_reason"id="leaving_reason" class="form-control form-control-line duty" placeholder=" "  minlength="" style="text-transform: capitalize;"  required>
														</div>
														<div class="form-group col-md-4 col-sm-6 m-t-4">
															<label>Referrer Name</label>
															<input type="text" name="referrer_name"id="referrer_name" class="form-control form-control-line duty" placeholder=" "  minlength="" style="text-transform: capitalize;">
														</div> <div class="form-group col-md-4 col-sm-6 m-t-4">
														<label>Referrer Contact</label>
														<input type="number" name="referrer_contact" id="referrer_contact" class="form-control form-control-line duty" placeholder=" "  minlength="" >
													</div> <div class="form-group col-md-4 col-sm-6 m-t-4">
													<label>Referrer Email</label>
													<input type="email" name="referrer_email"id="referrer_email" class="form-control form-control-line duty" placeholder=" Ex: abc@gmail.com"  minlength="" >
												</div>
												
												
												<div class="form-actions col-md-12" style="">
													<input type="hidden" name="em_id" value="<?php echo $basic->em_id; ?>">
													<button type="submit" class="btn btn-info" id="save_exp"> Save</button>
													<button type="reset" class="btn btn-info" id="">Reset</button>
													<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
												</div>
												
											</form>
											<div class="table-responsive m-t-40">
												<table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>ID </th>
															<th>Company Name</th>
															<th>Company Website</th>
															<th>Designation</th>
															<th>Reason</th>
															<th>From</th>
															<th>To</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;
														foreach($experience as $value): ?>
														<tr>
															<td><?php echo $i++ ?></td>
															<td><?php echo $value->exp_company ?></td>
															<td><?php echo $value->exp_com_address ?></td>
															<td><?php if($value->exp_com_position){ $id = $value->exp_com_position;
															$data = $this->organization_model->selectdes($id); echo $data->des_name;} ?></td>
															
															<td><?php echo $value->leaving_reason ?></td>
															<td><?php echo $value->workstart ?></td>
															<td><?php echo $value->workend ?></td>
															<td class="jsgrid-align-center ">
																<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
																<?php } else { ?>
																<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light experience tool" title="Edit" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
																<a  href="#" title="Delete" class="btn btn-sm btn-info waves-effect waves-light deletexp tool" title="Delete" data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></a>
																<button   id='exp_doc' class="btn btn-sm btn-info waves-effect waves-light exp_doc tool modalbtn" title="Add Documents"  data-target="#expdocmodel" data-toggle="modal" value="<?php echo $value->id ?>"><i class="fa fa-paperclip"></i></button>
																<button   id='view_exp' class="btn btn-sm btn-info waves-effect waves-light tool" title="View Documents" data-toggle="collapse" data-target="#collapseExperience" aria-expanded="false" aria-controls="collapseExperience" value="<?php echo $value->id ?>"><i class="fa fa-eye"></i></button>
																<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
																<input type="hidden" name="id" value="<?php echo $value->id;?>" id="id">
															</td>
															<?php } ?>
														</td>
													</tr>
													<?php $i++; endforeach; ?>
												</tbody>
											</table>
										</div>
										<div class="collapse" id="collapseExperience">
											<div class="card card-body edu_document_view">
												<table  class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
													<thead>
														<tr>
															<th>ID </th>
															<th>Document Name</th>
															<th>Attachment</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody id="expdocview">
													</tbody>
													
												</table>
											</div>
										</div>
									</div>
									<!--Dependency tab-->
									<div class="tab-pane p-20" id="dependency" role="tabpanel">
										<h3>Dependency</h3>
										<form class="row" method="post" id="add_dependency" >
											<span id="error"></span>
											
											<div class="form-group col-md-3 m-t-4">
												<label>Dependent Name</label><span class="error"> *</span>
												<input type="text" name="name" id="dependentname" class="form-control form-control-line duty" placeholder=" Name"  minlength="" required style="text-transform: capitalize;">
											</div>
											<div class="form-group col-md-3 m-t-4">
												<label>Dependent Relation</label><span class="error"> *</span>
												<select name="relation" id="dependentrelation" placeholder=""  class="form-control custom-select search" required>
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
											
											<div class="form-group col-md-3 m-t-4">
												<label> Dependent DOB  </label><span class="error"> *</span>
												<input type="date" name="dob" id="dependentdob" class="form-control form-control-line dob"  placeholder="" minlength="" required>
											</div>
											<div class="form-group col-md-3 m-t-4">
												<label>Dependent Age</label><span class="error"> *</span>
												<input type="number" name="age" id="dependentage" class="form-control form-control-line duty" placeholder="Age"  minlength="" required>
											</div>
											
										
											<div class="form-actions col-md-12" style="">
												<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
												<button type="submit" class="btn btn-info" id="save_dependency"> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
											
										</form>
										<div class="table-responsive m-t-40">
											<table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>ID </th>
														<th>Dependent Name</th>
														<th>Dependent Relation</th>
														<th>Dependent DOB</th>
														<th>Dependent Age</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($dependency as $value): ?>
													<tr>
														<td><?php echo $value->id ?></td>
														<td><?php echo $value->name ?></td>
														<td><?php echo $value->relation ?></td>
														<td><?php echo $value->dob ?></td>
														<td><?php echo $value->age ?></td>
														<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
														<?php } else { ?>
														<td class="jsgrid-align-center ">
															<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light dependency_modal" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
															<button  title="Delete" class="btn btn-sm btn-info waves-effect waves-light deldependency"  data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></button>
															<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
															<input type="hidden" name="id" value="<?php echo $value->id;?>" id="id">
														</td>
														<?php } ?>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									<!--Disability tab-->
									<div class="tab-pane p-20" id="disablity" role="tabpanel">
										<h3>Add Disability</h3>
										<form class="row"  method="post" enctype="multipart/form-data" id="Add_Disability">
											<span id="error"></span>
											<div class="form-group col-md-6 m-t-5">
												<label>Disability Name</label><span class="error"> *</span>
												<input type="text" name="disability_name" id="disability_name" class="form-control form-control-line" placeholder=" Disability Name"  minlength="1" style="text-transform: capitalize;" required>
											</div>
											<div class="form-group col-md-6 m-t-5">
												<label>Disability Type</label><span class="error"> *</span>
												<input type="text" name="disability_type" id="disability_type" class="form-control form-control-line" placeholder=" Disability Type"  minlength="1" required>
											</div>
											<!--      <div class="form-group col-md-6 m-t-5">
												<label>Disability Type</label>
												<select name="dept" placeholder="dd"  class="form-control custom-select">
													<option value="<?php echo $basic->id; ?>"><?php echo $basic->dep_name; ?></option>
													<?Php foreach($depvalue as $value): ?>
													<option value="<?php echo $value->id ?>"><?php echo $value->dep_name ?></option>
													<?php endforeach; ?>
												</select>
											</div> -->
											<div class="form-group col-md-6 m-t-5">
												<label>Description</label>
												<textarea class="form-control" id="description" name="description" rows="3" placeholder="" rows="6" cols="50"></textarea>
											</div>
											
											
											<div class="form-actions col-md-12" >
												<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
												<button type="submit" class="btn btn-info" id="save_disablity"> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
											
										</form>
										<div class="table-responsive m-t-40">
											<table id="table" class=" table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>ID </th>
														<th>Disability Name</th>
														<th>Disability Type</th>
														<th width="30%">Description</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($disabiltydata as $value): ?>
													<tr>
														<td><?php echo $value->id ?></td>
														<td><?php echo $value->disability_name ?></td>
														<td><?php echo $value->disability_type ?></td>
														<td ><?php echo $value->description ?></td>
														
														<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
														<?php } else { ?>
														<td class="jsgrid-align-center ">
															<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light disability_modal" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
															<button  title="Delete" class="btn btn-sm btn-info waves-effect waves-light deldisability"  data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></button>
															<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
															<input type="hidden" name="id" value="<?php echo $value->id;?>" id="id">
														</td>
														<?php } ?>
													</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									<!--policy tab-->
									<div class="tab-pane p-20"  id="policy" role="tabpanel">
										<h3>Company policies</h3>
							
									 <!-- .table -->
								     	<div class="table-responsive-md  col-md-12" style="overflow-x: auto;" >
											<table id="" class=" table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														  <th style="min-width: 50px !important;">ID </th>
											                <th style="width: 100px !important;">Policy</th>
											                <th style="width: 350px !important;">Description</th>
											                <th style= "min-width: 50px !important;">Attachment</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													function limitWords($string, $limit) {
														    // Explode the string into an array of words
														    $words = explode(" ", $string);

														    // Slice the array to get only the specified number of words
														    $limitedWords = array_slice($words, 0, $limit);

														    // Implode the array back into a string
														    $result = implode(" ", $limitedWords);

														    return $result;
														}
													$i = 1;
													foreach($policy_data as $value): ?>
													<tr>
														<td><?php echo $i ?></td>
														<td><?php echo $value->policy_title ?></td>
														
														<!-- <td style="width: 250px !important;"><?php  echo limitWords($value->policy_description, 15); 
														//echo $value->policy_description ?></td> -->
														     <td>
											                    <div class="description-container">
											                        <span class="short-description"><?php echo limitWords($value->policy_description, 20); ?></span>
											                        <span class="full-description" style="display: none;"><?php echo $value->policy_description ?></span>
											                        <a class="read-more-btn text-primary">Read More</a>
											                    </div>
											                </td>

													
														<td class="jsgrid-align-center ">
												<a href="<?php echo base_url()?>assets/uploads/policy_document/<?php echo $value->file ?>" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="<?php $value->file?>"><i class="fa fa-file-o"></i></a>
														</td>
														
													</tr>
													<?php $i++; endforeach; ?>
												</tbody>
											</table>
									   </div>
									
									</div>
									<!-- password 1 -->
									<div class="tab-pane p-20" id="password1" role="tabpanel">
										<form class="row" id="Reset_pass"  method="post" enctype="multipart/form-data">
											
											<input type="hidden" class="form-control" name="usertype"  id="usertype" value="<?php echo $this->session->userdata('user_type') ?>"  >
											<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<div class="form-group col-md-4 col-sm-6 m-t-20">
												<label>Current Password</label>
												<input type="password" class="form-control" name="old" id="currentpass" value="" required minlength="8">
											</div>
											<?php } ?>
											<div class="form-group  col-md-6 col-lg-5 col-sm-6 m-t-20">
												<label class=" control-label" for="passwordinput">Password <span id="popover-password-top" class="hide pull-right block-help"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter a strong password</span></label>
												
												<input id="password" name="new1" type="password" placeholder="" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
												
												<div class="form-check mt-2">
													<input type="checkbox" class="form-check-input  toggle-password" id="exampleCheck1">
													<label class="form-check-label" for="exampleCheck1">Show Password</label>
												</div>
												<div id="popover-password">
													<p>Password Strength: <span id="result"> </span></p>
													<div class="progress">
														<div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
														</div>
													</div>
													<ul class="list-unstyled">
														<li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; 1 lowercase &amp; 1 uppercase</li>
														<li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 number (0-9)</li>
														<li class=""><span class="one-special-char"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 Special Character (!@#$%^&*).</li>
														<li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; Atleast 8 Character</li>
													</ul>
												</div>
												
											</div>
											<div class="form-group  col-md-6 col-lg-5 col-sm-6 m-t-20">
												<label class=" control-label" for="passwordinput">Password Confirmation <span id="popover-cpassword" class="hide pull-right block-help"><i class="fa fa-info-circle text-danger" aria-hidden="true"></i> Password don't match</span></label>
												
												<input id="confirm-password" name="new2" type="password" placeholder="" class="form-control input-md">
												
											</div>
											<?php //if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<?php //} else { ?>
											<div class="form-actions col-md-12">
												<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
												<button type="submit" id="savepass" class="btn btn-info "> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
											<?php //} ?>
										</form>
									</div>
									<!-- password -->
									<div class="tab-pane p-20" id="password" role="tabpanel">
										<form class="row" action="Reset_Password" method="post" enctype="multipart/form-data">
											<div class="form-group col-md-6 m-t-20">
												<label>Old Password</label>
												<input type="text" class="form-control" name="old" value="" placeholder="old password" required minlength="6">
											</div>
											<div class="form-group col-md-6 m-t-20">
												<label>Password</label>
												<input type="text" class="form-control" name="new1" value="" required minlength="6">
											</div>
											<div class="form-group col-md-6 m-t-20">
												<label>Confirm Password</label>
												<input type="text" id="" name="new2" class="form-control " required minlength="6">
											</div>
											<div class="form-actions col-md-12">
												<input type="hidden" name="emid" value="<?php if($this->session->userdata('eid') && $this->session->userdata('Empid')){ echo $basic->em_id; }?>">
												<button type="submit" class="btn btn-info pull-right"> Save</button>
											</div>
										</form>
									</div>
									<!-- salary -->
									<div class="tab-pane p-20" id="salary" role="tabpanel">
										<h3 class="card-title">Basic Salary</h3>
										<form class="row" id="Add_Salary" method="post" enctype="multipart/form-data">
											<!-- <div class="row"> -->
											<div class="form-group col-md-4 col-sm-6 m-t-5">
												<label class="control-label">Salary Type</label><span class="error">  *</span>
												<select class="form-control  custom-select search"  tabindex="1" name="typeid" id="typeid" required>
													<option value="">Select Salary Type</option>
													<?php foreach($typevalue as $value): ?>
													<option value="<?php echo $value->id; ?>"<?php  if(!empty($salaryvalue->type_id)) if( $value->id == $salaryvalue->type_id){ echo 'selected';} ?>><?php echo $value->salary_type; ?></option>
													<?php endforeach; ?>
												</select>
												<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#SalaryTypemodel" class="modalbtn">Add Salary Type</a>
											</div>
											<div class="form-group col-md-4 col-sm-6 m-t-5">
												<label class="control-label">Salary Currency</label><span class="error">  *</span>
												<select name="currencytype" id="currencytype"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
													<option value="">Select Currency</option>
													<?Php
													
													foreach($salarycurrency as $value): ?>
													<option value="<?php echo $value->id ?>" <?php  if(!empty($salaryvalue->currencytype)) if( $value->id == $salaryvalue->currencytype){ echo 'selected';} ?>>
													<?php echo $value->currency_symbol.' <br><br>'.$value->currency_name; ?></option>
													
													<?php endforeach; ?>
												</select>
												<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#currencyModal" class="modalbtn">Add New Currency </a>
											</div>
											<div class="form-group col-md-4 col-sm-6 m-t-5">
												<label>Total Salary</label>
												<input type="number" name="total" id="total"  class="form-control form-control-line total" placeholder="Total Salary" value="<?php if(!empty($salaryvalue->total)) echo $salaryvalue->total ?>" minlength="3"  readonly>
											</div>
											<!--  </div> -->
											
											<h3 class="card-title col-12">Addition</h3>
											
											<!-- <div class="row"> -->
											<div class="form-group col-md-4 col-sm-6 m-t-5">
												<label>Basic</label>
												<input type="number" name="basic"  class="form-control form-control-line basic salary" placeholder="Basic..." value="<?php if(!empty($salaryvalue->basicsalary)) echo $salaryvalue->basicsalary ?>" >
											</div>
											<div class="form-group col-md-4 col-sm-6 m-t-5">
												<label>House Rent</label>
												<input type="number" name="houserent"  class="form-control form-control-line houserent salary" placeholder="House Rent..." value="<?php if(!empty($salaryvalue->basichra)) echo $salaryvalue->basichra ?>" >
											</div>
								
											
											<div class="col-12 row">
												<div class="form-group col-md-12 m-t-5">
													<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
													<?php if(!empty($salaryvalue->sid)){ ?>
													<input type="hidden" name="id" value="<?php echo $salaryvalue->sid; ?>">                                               <?php } ?>
													<?php if(!empty($salaryvalue->addi_id)){ ?>
													<input type="hidden" name="aid" value="<?php echo $salaryvalue->addi_id; ?>">                                                  <?php } ?>
													<?php if(!empty($salaryvalue->de_id)){ ?>
													<input type="hidden" name="did" value="<?php echo $salaryvalue->de_id; ?>">
													<?php } ?>
													<button type="submit" style="" id="addsalary" class="btn btn-info">Save</button>
													<button type="reset" class="btn btn-info" id="">Reset</button>
													<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
												</div>
												
											</div>
										</form>
									</div>
									<!--Visa and Immigration tab-->
									<div class="tab-pane p-20" id="visa_and_immigration" role="tabpanel">
										<h3>Visa and Immigration</h3>
										<form class="row" action="Add_Experience" method="post" enctype="multipart/form-data">
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> Passport Number </label>
												<input type="number" name="company_name" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Passport Issued Date</label>
												<input type="date" name="position_name" class="form-control form-control-line position_name"  placeholder="" minlength="5" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> Passport Expiry Date  </label>
												<input type="date" name="company_name" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
											</div>
											
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Visa Type Code</label>
												<input type="text" name="position_name" class="form-control form-control-line position_name"  placeholder="" minlength="5" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Visa Number</label>
												<input type="number" name="address" class="form-control form-control-line duty" placeholder=" "  minlength="7" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> Visa Issued Date </label>
												<input type="date" name="company_name" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> Visa Expiry Date</label>
												<input type="date" name="company_name" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>I-9 Status</label>
												<input type="text" name="address" class="form-control form-control-line duty" placeholder=" "  minlength="7" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> I-9 Review Date</label>
												<input type="date" name="company_name" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Issuing Authority</label>
												<input type="text" name="address" class="form-control form-control-line duty" placeholder=" "  minlength="7" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>I-94 Status</label>
												<input type="text" name="address" class="form-control form-control-line duty" placeholder=" "  minlength="7" required>
											</div>
											<div class="form-group  col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> I-94 Expiry Date</label>
												<input type="date" name="company_name" class="form-control form-control-line company_name"  placeholder="" minlength="2" required>
											</div>
											
											<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<?php } else { ?>
											<div class="form-actions col-md-12" >
												<input type="hidden" name="emid" value="<?php if($this->session->userdata('eid') && $this->session->userdata('Empid')){ echo  $basic->em_id; }?>">
												<button type="submit" class="btn btn-info"> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
											<?php } ?>
										</form>
									</div>
									<!-- Add Training / Certification -->
									<div class="tab-pane p-20" id="training" role="tabpanel">
										<h3>Add Training / Certification</h3>
										<form class="row" id="certification_form" method="post" enctype="multipart/form-data">
											<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label> Certification Name</label><span class="error"> *</span>
												<input type="text" name="certificate_name" style="text-transform: capitalize;" id="certificate_name" class="form-control form-control-line certificate_validate"  placeholder="Certification Name" minlength="2" style="text-transform: capitalize;" required>
											</div>
											<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Certificate No</label><span class="error"> *</span>
												<input type="text" name="certificate_no"id="certificate_no" class="form-control form-control-line certificate_validate"  placeholder="Certificate No" minlength="3" required>
											</div>
											<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Expiry Date</label>
												<input type="date" name="certificate_expdate" id="certificate_expdate" class="form-control form-control-line "   minlength="" >
											</div>
											<div class="form-group col-md-4 col-lg-3 col-sm-6 m-t-4">
												<label>Document </label><span class="error"> *</span>
												<input type="file" name="certificate" id="certificate" class="form-control" value=""  >
												<div class="error"></div>
											</div>
											
											<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<?php } else { ?>
											<div class="form-actions col-md-12" >
												<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
												<button type="submit" class="btn btn-info" id="add_certificate"> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
											<?php } ?>
										</form>
										<div class="table-responsive m-t-40">
											<table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>ID </th>
														<th>Certification Name</th>
														<th>Certificate No</th>
														<th>Expiry Date </th>
														<th>Attachments</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$i = 1;
													foreach($getcertification as $value): ?>
													<tr>
														<td><?php echo $i ?></td>
														<td><?php echo $value->certificate_name ?></td>
														<td><?php echo $value->certificate_no ?></td>
														<td><?php
															$date = str_replace('/','-',$value->certificate_expdate);
															echo date("d-m-Y ", strtotime($date))
														//echo $value->certificate_expdate ?></td>
														<td>
															<a href="<?=base_url()?>assets/uploads/certificate/<?php echo $value->certificate ?>" title="Attachments" class="btn btn-sm btn-warning waves-effect waves-light " target="_blank"><i class="fa fa-file-o"></i></a>
														</td>
														<td class="jsgrid-align-center ">
															<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
															<?php } else { ?>
															<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light certificate_modal" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
															<button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delcertificate" data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></button>
															<input type="hidden" name="id" value="<?php echo $value->id;?>"
															id="id">
															<?php } ?>
														</td>
													</tr>
													<?php $i++;
													endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									<!--Skills tab-->
									<div class="tab-pane p-20" id="skills" role="tabpanel">
										<h3>Add Skills</h3>
										<form class="row" id="empskill" method="post" enctype="multipart/form-data" id="insert_education">
											<span id="error"></span>
											<div class="form-group col-md-3 m-t-5">
												<label>Skill Name</label><span class="error"> *</span>
												<input type="text" name="name"id="name" class="form-control form-control-line" style="text-transform: capitalize;" placeholder="Ex: Angular JS"  minlength="1" required>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Year of Experience</label><span class="error"> *</span>
												<input type="number" name="yearofexp" id="yearofexp" class="form-control form-control-line" placeholder=""  minlength="" required>
											</div>
											
											<div class="form-group col-md-3 m-t-5">
												<label>Competency Level</label>
												<select name="skilllevel" id="skilllevel"  class="form-control custom-select edu_validate search">
													<option value="Beginner">Beginner</option>
													<option value="Intermediate">Intermediate</option>
													<option value="Above Intermediate">Above Intermediate </option>
													<option value="Advanced">Advanced</option>
													<option value="Expert">Expert</option>
												</select>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Skill Last Used Year</label>
												<input type="date" name="last_used_year"id="last_used_year"  class="form-control form-control-line" placeholder="Skill Used Last Year">
											</div>
											<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<?php } else { ?>
											<div class="form-actions col-md-12" >
												<input type="hidden" name="em_id" id="em_id" value="<?php echo $basic->em_id; ?>">
												<button type="submit" id="add_skill" class="btn btn-info"> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
											<?php } ?>
										</form>
										<div class="table-responsive ">
											<table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>ID </th>
														<th>Skill Name</th>
														<th>Year Of Exp </th>
														<th>Comptency Level </th>
														<th>Last Used <br>Year</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$i = 1;
													foreach($skillvalue as $value): ?>
													<tr>
														<td><?php echo $i ?></td>
														<td><?php echo $value->name ?></td>
														<td><?php echo $value->yearofexp ?></td>
														<td><?php echo $value->skilllevel ?></td>
														<td><?php echo $value->last_used_year  ?></td>
														<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
														<?php } else { ?>
														<td class="jsgrid-align-center ">
															<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light editskills" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
															
															<button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delskill" data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></button>
															<input type="hidden" name="id" id="id " value="<?php echo $value->id ?>">
														</td>
														<?php } ?>
													</tr>
													<?php  $i++;
													endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- Bank Details -->
									<div class="tab-pane p-20" id="bank" role="tabpanel">
										<h3 class="card-title">Bank Details</h3>
										<form class="row" id="Add_bank_info" method="post" enctype="multipart/form-data">
											<div class="form-group col-md-3 m-t-5">
												<label> Bank Holder Name</label><span class="error"> *</span>
												<input type="text" name="holder_name" style="text-transform: capitalize;" value="<?php if(!empty($bankinfo->holder_name)) echo $bankinfo->holder_name  ?>" class="form-control form-control-line" placeholder="Bank Holder Name"  required>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Bank Name</label><span class="error"> *</span>
												<input type="text" name="bank_name" style="text-transform: capitalize;"  value="<?php if(!empty($bankinfo->bank_name)) echo $bankinfo->bank_name  ?>" class="form-control form-control-line" placeholder="Bank Name"  required>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Branch Name</label><span class="error"> *</span>
												<input type="text" name="branch_name" style="text-transform: uppercase;" value="<?php if(!empty($bankinfo->branch_name)) echo $bankinfo->branch_name  ?>" class="form-control form-control-line" placeholder=" Branch Name" required>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Bank Account Number</label><span class="error"> *</span>
												<input type="text" name="account_number" value="<?php if(!empty($bankinfo->account_number)) echo $bankinfo->account_number ?>" class="form-control form-control-line"  required>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Bank Account Type</label><span class="error"> *</span>
												<input type="text" name="account_type" value="<?php if(!empty($bankinfo->account_type)) echo $bankinfo->account_type ?>" class="form-control form-control-line" placeholder="Bank Account Type" required>
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>IFSC Code</label>
												<input type="text" name="ifsc" id="ifsc" value="<?php if(!empty($bankinfo->ifsc)) echo $bankinfo->ifsc ?>" class="form-control form-control-line" placeholder="IFSC Code">
											</div>
											<div class="form-group col-md-3 m-t-5">
												<label>Swift Code</label>
												<input type="text" name="swift"  id="swift" value="<?php if(!empty($bankinfo->swift)) echo $bankinfo->swift ?>" class="form-control form-control-line" placeholder="Swift Code">
											</div>
											<div class="form-actions col-md-12">
												<input type="hidden" name="emid" value="<?php echo $basic->em_id; ?>">
												<input type="hidden" name="id" value="<?php if(!empty($bankinfo->id)) echo $bankinfo->id  ?>">
												<button type="submit" id="save_bank_info" class="btn btn-info"> Save</button>
												<button type="reset" class="btn btn-info" id="">Reset</button>
												<button type="button" class="btn btn-info">Cancel</button>
											</div>
										</form>
									</div>
									<!-- document -->
									<div class="tab-pane p-20" id="document" role="tabpanel">
										<h3>Add Document</h3>
										<form class="row" id="Add_File" method="post" enctype="multipart/form-data">
											<div class="form-group col-md-6 m-t-5">
												<label class="">Document Title</label><span class="error"> *</span>
												<input type="text" name="title"  class="form-control" required="" aria-invalid="false"  style="text-transform: capitalize;" required>
											</div>
											<div class="form-group col-md-6 m-t-5">
												<label class="">Document</label><span class="error"> *</span>
												<input type="file" name="file_url"  class="form-control" required="" aria-invalid="false" required>
											</div>
											<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
											<?php } else { ?>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="hidden" name="em_id" value="<?php echo $basic->em_id; ?>">
													<button type="submit" id="addfile" class="btn btn-info">Add File</button>
													<button type="reset" class="btn btn-info" id="">Reset</button>
													<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
												</div>
											</div>
											<?php } ?>
										</form>
										<div class="table-responsive m-t-4 ">
											<table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>ID </th>
														<th>File Title</th>
														<th>File </th>
														<th>Action </th>
													</tr>
												</thead>
												<tbody>
													<?php $i = 1;
													foreach($fileinfo as $value): ?>
													<tr>
														<td><?php echo $i ?></td>
														<td><?php echo $value->file_title ?></td>
														<!-- <td><a href="<?php echo base_url(); ?>assets/images/users/<?php echo $value->file_url ?>" target="_blank"><?php echo $value->file_url ?></a></td> -->
														<td>  <a href="<?=base_url()?>assets/images/users/<?php echo $value->file_url ?>" title="Attachments" class="btn btn-sm btn-warning waves-effect waves-light " target="_blank"><i class="fa fa-file-o"></i></a></td>
														<td class="jsgrid-align-center ">
															<a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light personaldoc_modal" data-id="<?php echo $value->id ?>"><i class="fa fa-pencil-square-o"></i></a>
															
															<button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delpersonal" data-id="<?php echo $value->id ?>"><i class="fa fa-trash-o"></i></button>
															<input type="hidden" name="id" id="id " value="<?php echo $value->id ?>">
														</td>
													</tr>
													<?php $i++;
													endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									
									<!-- leave -->
									<div class="tab-pane p-20" id="leave" role="tabpanel">
										<h4 class="card-title"> Leave</h4>
										<form action="Assign_leave" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label class="">Leave Type</label>
												<select name="typeid"  class="select2 form-control custom-select search" style="width: 100%" id="" required>
													<option value="">Select Here...</option>
													<?php foreach($leavetypes as $value): ?>
													<option value="<?php echo $value->type_id ?>"><?php echo $value->name ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="form-group">
												<label>day</label>
												<input type="number"  name="noday" class="form-control form-control-line noday" placeholder="Leave Day" required>
											</div>
											<div class="form-group">
												<label class="">Year</label>                                 <select name="year" class="select2 form-control custom-select search" style="width: 100%" id="" required>
												<option value="">Select Here...</option>
												<?php
												for ($x = 2016; $x < 3000; $x++){
												echo '<option value='.$x.'>'.$x.'</option>';
												}
												?>
											</select>
										</div>
										<?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
										<?php } else { ?>
										<div class="form-group">
											<div class=" ">
												<input type="hidden" name="em_id" value="<?php echo $basic->em_id; ?>">
												<button type="submit" class="btn btn-info">Submit</button>
												<a type="button" class="btn btn-info text-white" href="<?php echo base_url(); ?>employee/Employees">Cancel</a>
											</div>
										</div>                                                                               <?php } ?>
									</form>
								</div>
								<div class="tab-pane p-20" id="messages4" role="tabpanel">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		<div id="coursemodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Add Course</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<form method="post" id="courseform" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label">Education Level</label>
								<select name="edulevel" id="edulevel" class="form-control custom-select" required>
									<option value="">Select Education Level</option>
									<?Php foreach($eduvalue as $value): ?>
									<option value="<?php echo $value->id ?>"><?php echo $value->education ?></option>
									<?php endforeach; ?>
									
								</select>
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">Course:</label>
								<input type="text" class="form-control" id="coursename" name="coursename">
								<!-- <input type="hidden" name="roleval" value="roleval"> -->
							</div>
							<div class="fielderror"> </div>
						</form>
					</div>
					<div class="modal-footer">
						
						<button type="button" class="btn btn-info" id="course_btn">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		$(document).ready(function () {
			//
		$('.total').on('keypress',function() {//input
		var amount = parseInt($('.total').val());
		$('.basic').val((amount * .50 ? amount * .50 : 0).toFixed(2));
		$('.houserent').val((amount * .40 ? amount * .40 : 0).toFixed(2));
		$('.medical').val((amount * .05 ? amount * .05 : 0).toFixed(2));
		$('.conveyance').val((amount * .05 ? amount * .05 : 0).toFixed(2));
		});
		});
		</script>
		<?php $this->load->view('backend/em_modal'); ?>
		<script type="text/javascript">
		$(document).ready(function () {
		$(".education").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#educationmodal').trigger("reset");
		$('#EduModal').modal('show');
		$.ajax({
		url: 'educationbyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		console.log(response);
		// Populate the form fields with the data returned from server
		$('#educationmodal').find('[name="id"]').val(response.educationvalue.id).end();
		$('#educationmodal').find('[name="edulevel"]').val(response.educationvalue.edulevel).end();
		console.log(response.educationvalue.course);
		$('#educationmodal').find('[name="course"]').val(response.educationvalue.course).end();
		//$('#educationmodal').find('[name="course"]').html("<option value="+response.educationvalue.cId+">"+response.educationvalue.courseName+"</option>").end();
		$('#educationmodal').find('[name="institute"]').val(response.educationvalue.institute).end();
		$('#educationmodal').find('[name="from_year"]').val(response.educationvalue.from_year).end();
		$('#educationmodal').find('[name="to_year"]').val(response.educationvalue.to_year).end();
		$('#educationmodal').find('[name="percentage"]').val(response.educationvalue.percentage).end();
		$('#educationmodal').find('[name="emid"]').val(response.educationvalue.emp_id).end();
						});
		});
		});
		</script>
		<!-- skills -->
		<script type="text/javascript">
		$(document).ready(function () {
		$(".editskills").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#skillsform').trigger("reset");
		$('#skillsmodal').modal('show');
		$.ajax({
		url: 'skillsbyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		//console.log(response);
		// Populate the form fields with the data returned from server
		$('#skillsmodal').find('[name="id"]').val(response.skillsvalue.id).end();
		$('#skillsmodal').find('[name="name"]').val(response.skillsvalue.name).end();
		$('#skillsmodal').find('[name="yearofexp"]').val(response.skillsvalue.yearofexp).end();
		$('#skillsmodal').find('[name="skilllevel"]').val(response.skillsvalue.skilllevel).end();
		$('#skillsmodal').find('[name="last_used_year"]').val(response.skillsvalue.last_used_year).end();
		
		$('#skillsmodal').find('[name="em_id"]').val(response.skillsvalue.em_id).end();
		});
		});
		});
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
		$(".identitycard").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#identitycardmodal').trigger("reset");
		$('#IDModal').modal('show');
		$.ajax({
		url: 'idCardbyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		//console.log(response);
		// Populate the form fields with the data returned from server
		$('#identitycardmodal').find('[name="id"]').val(response.idcardvalue.gid).end();
		$('#identitycardmodal').find('[name="GIDType"] ').val(response.idcardvalue.gov_id).end();
		$('#identitycardmodal').find('[name="GIDnumber"]').val(response.idcardvalue.gid_number).end();
		$('#identitycardmodal').find('[name="GIDExpriy"]').val(response.idcardvalue.gid_expiry).end();
		/* $('#identitycardmodal').find('[name="gov_doc"]').val(response.idcardvalue.gov_doc).end();*/
		$('#identitycardmodal').find('[name="emp_id"]').val(response.idcardvalue.emp_id).end();
		});
		});
		});
		$('#GIDType').attr("disabled", true);
		</script>
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
		$(".deleteID").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$.ajax({
		url: 'IDvalueDelete?id=' + iid,
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
		</script>
		<script type="text/javascript">
		//certificate
		$(document).ready(function () {
		$(".certificate_modal").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#certificateform').trigger("reset");
		$('#certificate_modal').modal('show');
		$.ajax({
		url: 'certificatebyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		console.log(response);
		// Populate the form fields with the data returned from server
							$('#certificateform').find('[name="id"]').val(response.certificatevalue.id).end();
		$('#certificateform').find('[name="certificate_name"]').val(response.certificatevalue.certificate_name).end();
		$('#certificateform').find('[name="certificate_no"]').val(response.certificatevalue.certificate_no).end();
		$('#certificateform').find('[name="certificate_expdate"]').val(response.certificatevalue.certificate_expdate).end();
		/*$('#certificateform').find('[name="work_duration"]').val(response.certificatevalue.exp_workduration).end();*/
		$('#certificateform').find('[name="emid"]').val(response.certificatevalue.emp_id).end();
						});
		});
		});
		
		//dependency
		$(document).ready(function () {
		$(document).on('click', '.dependency_modal', function(e) {
		e.preventDefault();
		var tr=$(this).parents('tr');
		var emp_id=$(tr).find('#em_id').val();
		console.log(emp_id);
		//var emp_id = $(this).val();
		
		$('#dependencyform').find('[name="em_id"]').val(emp_id).end();
		//$('#dependencyform').find('[name="em_id"]').val(response.dependencyvalue.emp_id).end();
		//alert('clicked');
		})
		})
		$(document).ready(function () {
		$(".dependency_modal").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#dependencyform').trigger("reset");
		$('#DependencyModal').modal('show');
		$.ajax({
		url: 'dependencybyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		//console.log(response);
		// Populate the form fields with the data returned from server
		$('#dependencyform').find('[name="id"]').val(response.dependencyvalue.id).end();
		$('#dependencyform').find('[name="name"]').val(response.dependencyvalue.name).end();
		$('#dependencyform').find('[name="relation"]').val(response.dependencyvalue.relation).end();
		$('#dependencyform').find('[name="dob"]').val(response.dependencyvalue.dob).end();
		$('#dependencyform').find('[name="age"]').val(response.dependencyvalue.age).end();
		//$('#dependencyform').find('[name="em_id"]').val(response.dependencyvalue.emp_id).end();
		});
		});
		});
		//disability
		$(document).ready(function () {
		$(document).on('click', '.disability_modal', function(e) {
		e.preventDefault();
		var tr=$(this).parents('tr');
		var emp_id=$(tr).find('#em_id').val();
		//console.log(emp_id);
		//var emp_id = $(this).val();
		
		$('#disabilityform').find('[name="em_id"]').val(emp_id).end();
		//$('#dependencyform').find('[name="em_id"]').val(response.dependencyvalue.emp_id).end();
		//alert('clicked');
		})
		})
		$(document).ready(function () {
		$(".disability_modal").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#disabilityform').trigger("reset");
		$('#DisabilityModal').modal('show');
		$.ajax({
		url: 'Disablitybyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		console.log(response);
		// Populate the form fields with the data returned from server
		$('#disabilityform').find('[name="id"]').val(response.disabilityvalue.id).end();
		$('#disabilityform').find('[name="disability_name"]').val(response.disabilityvalue.disability_name).end();
		$('#disabilityform').find('[name="disability_type"]').val(response.disabilityvalue.disability_type).end();
		$('#disabilityform').find('[name="description"]').val(response.disabilityvalue.description).end();
		
		});
		});
		});
		
		$(document).ready(function () {
		$(".experience").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#experiencemodal').trigger("reset");
		$('#ExpModal').modal('show');
		$.ajax({
		url: 'experiencebyib?id=' + iid,
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		
		
		// Populate the form fields with the data returned from server
		$('#experiencemodal').find('[name="id"]').val(response.expvalue.id).end();
		$('#experiencemodal').find('[name="exp_company"]').val(response.expvalue.exp_company).end();
		$('#experiencemodal').find('[name="exp_com_position"]').val(response.expvalue.exp_com_position).end();
		$('#experiencemodal').find('[name="exp_com_address"]').val(response.expvalue.exp_com_address).end();
		$('#experiencemodal').find('[name="workstart"]').val(response.expvalue.workstart).end();
		$('#experiencemodal').find('[name="workend"]').val(response.expvalue.workend).end();
		$('#experiencemodal').find('[name="leaving_reason"]').val(response.expvalue.leaving_reason).end();
		$('#experiencemodal').find('[name="referrer_name"]').val(response.expvalue.referrer_name).end();
		$('#experiencemodal').find('[name="referrer_contact"]').val(response.expvalue.referrer_contact).end();
		$('#experiencemodal').find('[name="referrer_email"]').val(response.expvalue.referrer_email).end();
		$('#experiencemodal').find('[name="em_id"]').val(response.expvalue.emp_id).end();
		});
		});
		});
		//personal document
		$(document).ready(function () {
		$(".personaldoc_modal").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$('#personaldocform').trigger("reset");
		$('#personaldoc_modal').modal('show');
		$.ajax({
		url: 'personaldocbyib?id=' + iid,//certificatebyib
		method: 'GET',
		data: '',
		dataType: 'json',
		}).done(function (response) {
		
		// Populate the form fields with the data returned from server
							$('#personaldocform').find('[name="id"]').val(response.documentvalue.id).end();
		$('#personaldocform').find('[name="title"]').val(response.documentvalue.file_title).end();
		$('#personaldocform').find('[name="emid"]').val(response.documentvalue.em_id).end();
		//$('#personaldocform').find('[name="file_url"]').val(response.documentvalue.file_url).end();
		// $('#personaldocform').find('[name="certificate_no"]').val(response.certificatevalue.certificate_no).end();
		
						});
		});
		});
		
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
		$(".deletexp").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$.ajax({
		url: 'EXPvalueDelet?id=' + iid,
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
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
		$(".edudelet").click(function (e) {
		e.preventDefault(e);
		// Get the record's ID via attribute
		var iid = $(this).attr('data-id');
		$.ajax({
		url: 'EduvalueDelet?id=' + iid,
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
		</script>
		
		<?php $this->load->view('backend/footer'); ?>
		<?php $this->load->view('backend/em_view'); ?>
		<?php $this->load->view('backend/em_tab'); ?>
		<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
		<script>
		$(document).ready(function() {
		$('.table').DataTable({
		rowReorder: {
		selector: 'td:nth-child(2)'
		},
		// responsive: true,
        // scrollX: true, // Enable horizontal scrolling
        // autoWidth: false, // Disable automatic column width calculation
   
        
		});
		});
			
	
		// $('#table123').DataTable({
	    //    "scrollX": true,
        //  "scroller": true,
        //  "scrollCollapse": true
   
        
		// });
	
		
		
		$("#prefix, #dept ,#deg, #role , #gender,#em_status,#gov_id").select2({
		theme:"bootstrap"
		});
		$(function() {
		
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		localStorage.setItem('lastTab', $(this).attr('href'));
		});
		var lastTab = localStorage.getItem('lastTab');
		
		if (lastTab) {
		$('[href="' + lastTab + '"]').tab('show');
		}
		
		});
	/*	window.setTimeout(function() {
		localStorage.removeItem('lastTab');
		}, 4 * 60 * 1000 );*/
		
	/*	//emp code
		$(document).ready(function(){
		$("#busunit").change(function(){
		
		var id = $(this).val();
		$.ajax({
		type: "POST",
		url: "<?php echo base_url("Employee/get_businesscode");?>",
		data: { id : id },
		success:function(data){
		var info=$.parseJSON(data);
		$("#em_code").val(info.content+'/');
		}
		})
		});
		
		});*/
		$(document).ready(function(){
		$("#busunit").change(function(){
		
		var busunit = $(this).val();
		$.ajax({
		type: "POST",
		url: "<?php echo base_url("Employee/get_match_department");?>",
		data: { busunit : busunit },
		success:function(data){
		var info=$.parseJSON(data);
		$("#dept").html(info.content);
		}
		})
		});

		//default
		var busunit = $("#busunit").val();
		var dep = '<?=$basic->dep_id;?>';
		$.ajax({
		type: "POST",
		url: "<?php echo base_url("Employee/get_match_department");?>",
		data: { busunit : busunit,dep:dep },
		success:function(data){
		var info=$.parseJSON(data);
		$("#dept").html(info.content);
		}
		})
		
		});
		//education level
		$(document).ready(function(){
		$(".edulevel").change(function(){
		
		var edulevel = $(".edulevel").val();
		$.ajax({
		type: "POST",
		url: "<?php echo base_url("Employee/get_match_course");?>",
		data: { edulevel : edulevel },
		success:function(data){
		var info=$.parseJSON(data);
		$(".course").html(info.content);
		}
		})
		});
		
		});

		//Reporting employee
		$(document).ready(function(){
		$("#busunit").change(function(){
		
		var busunit = $(this).val();
		$.ajax({
		type: "POST",
		url: "<?php echo base_url("Employee/GetReportEmp");?>",
		data: { busunit : busunit },
		success:function(data){
		var info=$.parseJSON(data);
		$("#reportto").html(info.content);
		}
		})
			
		});
	   //default
	    var busunit = $('#busunit').val();
	    var report = '<?=$basic->report_to;?>';
		$.ajax({
		type: "POST",
		url: "<?php echo base_url("Employee/GetReportEmp");?>",
		data: { busunit : busunit,report:report },
		success:function(data){
		var info=$.parseJSON(data);
		$("#reportto").html(info.content);
		}
		})
		});

		</script>
		<script type="">
			$(document).resize(function () {
		var screen = $(window);
		if (screen.width < 768) {
		$('.vtabs').removeClass();
		$('.nav-tabs').removeClass('tabs-vertical');//customtab
		$('.nav-tabs').addClass('customtab')
		} else {
		$('div').addClass('');
		}
		});
		function resize() {
		if ($(window).width() < 768) {
		$('.vtabs').removeClass();
		$('.nav-tabs').removeClass('tabs-vertical');//customtab
		$('.nav-tabs').addClass('customtab')
		}
		else {
			$('.nav-tabs').parent().addClass('vtabs');
			$('.nav-tabs').addClass('tabs-vertical');//customtab
		$('.nav-tabs').removeClass('customtab')
		}
		}
	
		$(document).ready( function() {
		$(window).resize(resize);
		resize();
		
		});

		// Read more
		    $(document).ready(function() {
        $('.read-more-btn').on('click', function() {
            var container = $(this).closest('.description-container');
            container.find('.short-description').toggle();
            container.find('.full-description').toggle();
            $('.read-more-btn').text('Read Less')
        });
    });
		</script>