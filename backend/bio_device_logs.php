<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-user-secret" aria-hidden="true"></i>Biometric Device Logs</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Biometric Device Logs</li> -->
                        <a href="<?php echo base_url('Biometric/ViewBiometric') ?>"class="btn btn-info">Back</a>
                    </ol>
                </div>
            </div>
            <div class="message"></div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                         <!-- <a href="<?php echo base_url('Biometric/ViewBiometric') ?>"class="btn btn-info">Back</a> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;<i class="fa fa-user-o" aria-hidden="true"></i>  Device List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th> S.NO</th>
                                             
                                                <th>Serial No</th>
                                                <th>Ip Address</th>
                                                <th>Employee ID</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Verification</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                  

                                       <tbody id="orgdep_tbl">
                                          <?php 
                                          
                                           $i = 1;
                                        foreach($devicelogs as $value): ?>
                                    <tr>
                                       
                                        <td><?php echo $i; ?></td>
                                     
                                        <td><?php echo $value->serial_no; ?></td>
                                        <td><?php echo $value->ip_address; ?></td>
                                        <td><?php echo $value->em_id; ?></td>
                                        <td><?php echo $value->date; ?></td>
                                        <td><?php echo $value->time; ?></td>
                                        <td><?php echo $value->status; ?></td>
                                        <td><?php echo $value->verification; ?></td>
                                     
                                      <?php if($this->role->User_Permission('business_unit','can_edit')){?>
                                   
                                          <?php }; if($this->role->User_Permission('business_unit','can_edit')){?>
                                        <td class="jsgrid-align-center ">
                                            <input type="hidden" name="id"  id="id" value="<?php echo $value->id; ?>"/>
                                            <a href="<?php echo base_url(); ?>Biometric/EditBioDevice?I=<?php echo base64_encode($value->id); ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>
                                           <button  href="" title="Delete" class="btn btn-sm btn-info waves-effect waves-light deltype" data-id="<?php echo $value->id;?>" >
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                           
                                        </td>
                                         <?php }; ?>
                                    </tr>
                                    <?php $i++;
                                     endforeach; ?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php $this->load->view('backend/footer'); ?>
<script>
    $('#employees123').DataTable({
        
    });

 
</script>
<script type="text/javascript">

       //delete
    $(document).on('click','.deltype', function (e) {
    /*var enroll = $(this).parents('tr').find('td:nth-child(3)').text().trim();*/
    var id = $(this).parents('tr').find('#id').val();
    //console.log(id);

    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this logs ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Biometric/Delete_device') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message:  data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
     location.reload(true);
    },3000);

     }else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
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