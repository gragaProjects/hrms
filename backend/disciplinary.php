<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 
        <div class="message"></div>
         <div class="page-wrapper">
                <?php 
                $allemployees = $this->employee_model->GetAllEmployee(); 
                ?> 
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-compass" style="color:#1976d2"></i> Disciplinary</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Disciplinary</li> -->
                        <?php if($this->role->User_Permission('disciplinary','can_add')){?>
                        <button type="button" class="btn btn-info" style=""><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"  class="text-white"><i class="" aria-hidden="true"></i> Add Disciplinary </a></button>
                         <?php }?>
                    </ol>
                </div>
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row m-b-10"> 
                    <div class="col-12">
                       
                   
                    </div>
                </div>         
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Disciplinary Action List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Employee </th>
                                                 <th>Title </th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <?php if($this->role->User_Permission('disciplinary','can_edit') || $this->role->User_Permission('disciplinary','can_delete')){?>
                                                <th>Action</th>
                                                <?php }?>
                                            </tr>
                                        </thead>
                                <?php if($this->role->User_Permission('disciplinary','can_view') && $this->role->User_Permission('disciplinary','can_add') && $this->role->User_Permission('disciplinary','can_edit')){?>
                                        <tbody>
                                           <?php $i = 1;
                                           foreach($desciplinary as $value): ?>
                                            <tr>
                                                <td ><?php echo $i; ?></td>
                                                <td ><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                               <!--  <td ><?php //echo $value->em_code; ?></td> -->
                                                <td ><?php echo substr("$value->title",0,15).'...' ?></td>
                                                <td><?php echo substr("$value->description",0,10).'...' ?> </td>
                                                <td> <?php echo $value->action; ?></td>
                                                 <?php if($this->role->User_Permission('disciplinary','can_edit') || $this->role->User_Permission('disciplinary','can_delete')){?>
                                                <td  class="jsgrid-align-center ">
                                                    <?php if($this->role->User_Permission('disciplinary','can_edit')){?>
                                                    <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light disiplinary" data-id="<?php echo $value->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                     <?php }?>
                                                   <?php if($this->role->User_Permission('disciplinary','can_delete')){?>
                                                    <button   title="Delete" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light disdel" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button>
                                                     <?php }?>
                                                </td>
                                                 <?php }?>
                                            </tr>
                                            <?php  $i++; endforeach; ?>
                                        </tbody>
                                        <!--  -->
                                           <?php }elseif ($this->role->User_Permission('disciplinary','can_view')) {
                                            $id = $this->session->userdata('user_login_id');
                                         $disciplinaryinfo = $this->employee_model->GetUserDisciplinary($id);
                                         //$i = count($disciplinaryinfo);
                                         if(!empty( $disciplinaryinfo)){
                                         
                                        ?>
                                        <tbody>
                                            <?php $i = 1;
                                           foreach($disciplinaryinfo as $data): ?>
                                            <tr>
                                                <td ><?php echo $i; ?></td>
                                                <td ><?php echo $data->first_name.' '.$data->last_name; ?></td>
                                               <!--  <td ><?php //echo $data->em_code; ?></td> -->
                                                <td ><?php echo substr("$data->title",0,15).'...' ?></td>
                                                <td><?php echo substr("$data->description",0,10).'...' ?> </td>
                                                <td> <?php echo $data->action; ?></td>
                                                 <?php if($this->role->User_Permission('disciplinary','can_edit') || $this->role->User_Permission('disciplinary','can_delete')){?>
                                                <td  class="jsgrid-align-center ">
                                                    <?php if($this->role->User_Permission('disciplinary','can_edit')){?>
                                                    <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light disiplinary" data-id="<?php echo $data->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                     <?php }?>
                                                   <?php if($this->role->User_Permission('disciplinary','can_delete')){?>
                                                    <button   title="Delete" <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?> hidden <?php } ?> class="btn btn-sm btn-info waves-effect waves-light disdel" data-id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></button>
                                                     <?php }?>
                                                </td>
                                                 <?php }?>
                                            </tr>
                                            <?php  $i++; endforeach; ?>
                                        </tbody>

                                        <?php }}?>
                                        <!--  -->
                                    </table>
                                    <!-- sample modal content -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel1">Disciplinary Notice</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form method="post"  id="btnSubmit" enctype="multipart/form-data"><!-- action="add_Desciplinary" -->
                                                <div class="modal-body">
                                                    
                                                        <div class="form-group">
                                                            <label class="control-label">Employee Name</label><span class="error"> *</span>
                                                            <select class="form-control custom-select" name="emid" id="emid" data-placeholder="Choose a Category" tabindex="1" value="" required>
                                                               <?php foreach($allemployees as $value): ?>
                                                                <option value="<?php echo $value->em_id ?>"><?php echo $value->first_name.' '.$value->last_name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Disciplinary Action</label><span class="error"> *</span>
                                                            <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="warning" id="warning" value="" required>
                                                                <option value="Verbel Warning">Verbel Warning</option>
                                                                <option value="Writing Warning">Writing Warning</option>
                                                                <option value="Demotion">Demotion</option>
                                                                <option value="Suspension">Suspension</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="control-label">Title</label><span class="error"> *</span>
                                                            <input type="text" name="title" class="form-control" id="title" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="control-label">Details</label>
                                                            <textarea class="form-control" value="" name="details" id="message-text1" rows="4"></textarea>
                                                        </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                   <input type="hidden" name="id" value="">
                                                     <button type="submit" class="btn btn-info" id="add_disciplinary">Submit</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<script type="text/javascript">
$(document).ready(function () {
    $(".disiplinary").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#btnSubmit').trigger("reset");
        $('#exampleModal').modal('show');
        $.ajax({
            url: 'DisiplinaryByID?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).done(function (response) {
            console.log(response);
            // Populate the form fields with the data returned from server
			$('#btnSubmit').find('[name="id"]').val(response.desipplinary.id).end();
            $('#btnSubmit').find('[name="emid"]').val(response.desipplinary.em_id).end();
            $('#btnSubmit').find('[name="warning"]').val(response.desipplinary.action).end();
            $('#btnSubmit').find('[name="title"]').val(response.desipplinary.title).end();
            $('#btnSubmit').find('[name="details"]').val(response.desipplinary.description).end();
		});
    });
});
 $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })
      $(document).on('click','#add_disciplinary',function(){
        event.preventDefault();
           $("#btnSubmit").valid();
        
            var emid=$("#emid").val();
            var warning=$('#warning').val();
            var title=$('#title').val();
           
        if(emid != '' && warning != '' && title != ''){
          
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Employee/add_Desciplinary");?>',
        data: new FormData($("#btnSubmit")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#exampleModal').modal('hide');
        $(".modal-backdrop").remove();
      
        $('#btnSubmit')[0].reset();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 5000,
        position: 'top-right'
        });
         
        setTimeout(function(){
         location.reload(true);
        },3000);
       }else if(data.status == 'error'){
      
              $.wnoty({
                    type: 'error',
                    message: data.message,
                    autohideDelay: 3000,
                    position: 'top-right'

                    });
        }else if(data.status == 'valid'){
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
      //delete
    $(document).on('click','.disdel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this disciplinary ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Employee/disciplinarydelete') ?>',
    data: {id:id},
    success: function (response) {
     var data=$.parseJSON(response);
     if(data.status == 'success'){

    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
         location.reload(true);
        },3000);
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
    <?php $this->load->view('backend/footer'); ?>