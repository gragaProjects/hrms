<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Inactive Employee</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Inactive Employee</li> -->
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                      
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;<i class="fa fa-user-o" aria-hidden="true"></i> Inactive Employee List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID </th>
                                                <th>Employee Code </th>
                                                <th>Employee Name</th>
                                                <th>Email </th>
                                                <th>Contact </th>
                                                <th>Role</th>
                                                <?php if($this->role->User_Permission('inactive_user','can_edit')){?>
                                                <th>Action</th>
                                                 <?php }?>
                                            </tr>
                                        </thead>
                                
                                        <tbody>
                                            <?php $i = 1 ?>
                                           <?php foreach($invalidem as $value): ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value->em_code; ?></td>
                                                <td><?php echo $value->first_name .' '.$value->last_name; ?></td>
                                                <td><?php echo $value->em_email; ?></td>
                                                <td><?php echo $value->em_phone; ?></td>
                                                <td><?php if($value->em_role){$id = $value->em_role;
                                                $data = $this->employee_model->matchrole($id); 
                                                echo $data->role;} ?></td>
                                                 <?php if($this->role->User_Permission('inactive_user','can_edit')){?>
                                                <td class="jsgrid-align-center ">
                                                    <a href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($value->em_id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                                </td>
                                                 <?php }?>
                                            </tr>
                                             <?php $i++ ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>