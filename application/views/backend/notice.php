<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Notice Board</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Notice Board</li> -->
                        <?php if($this->role->User_Permission('notice','can_add') ){?>
                        <button type="button" class="btn btn-info" style="width: 110px;"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#noticemodel" data-whatever="@getbootstrap" class="text-white "><i class="" aria-hidden="true"></i> Add Notice </a></button>
                       <!--   <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 110px;">Cancel</a> -->
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
                                      <h4 class="m-b-0 text-white">&nbsp;&nbsp; Notice</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="examplesearch" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                             <?php if( $this->role->User_Permission('notice','can_delete') ){?>
                                                <th>Action</th>
                                                   <?php } ?>
                                            </tr>
                                        </thead>
                                      
                                        <tbody>

                                           <?php 
                                           $i= 1;

                                           foreach($notice as $value): ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value->title; ?></td>
                                                <td><a href="<?php echo base_url(); ?>assets/uploads/notice/<?php echo $value->file_url; ?>" target="_blank" class="btn btn-sm btn-info  waves-effect waves-light " title="<?php echo $value->file_url; ?>"><i class="fa fa-file-o"></i></a></td>
                                                <td><?php echo date('d M Y',strtotime($value->date)); ?></td>
                                                <td><?php if($value->todate) {echo date('d M Y',strtotime($value->todate));} ?></td>
                                          <?php if( $this->role->User_Permission('notice','can_delete') ){?>
                                        <td><button   title="Delete" class="btn btn-sm btn-info waves-effect waves-light noticedel" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button></td>   <?php } ?>
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <!-- sample modal content -->
                        <div class="modal fade" id="noticemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Notice Board</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form role="form" method="post" action="" id="noticeform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Notice Title</label><span class="error"> *</span>
                                                <textarea class="form-control" name="title" id="title" required minlength="" maxlength="150"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Document</label><span class="error"> *</span>
                                              
                                                <input type="file" name="file_url" class="form-control" id="file_url" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">From</label><span class="error"> *</span>
                                                <input type="date" name="nodate" class="form-control" id="nodate" required>
                                            </div> 
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">To</label>
                                                <input type="date" name="todate" class="form-control" id="todate" >
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                      
                                        <button type="submit" class="btn btn-primary" id="add_notice">Submit</button>
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal --> 
  
<?php $this->load->view('backend/footer'); ?>
<script>
       $('.close , .btn-default').on('click',function(){
    $('#noticeform')[0].reset();
     //$('#sid').val('');
    });
    $(document).on('click','#add_notice',function(){
    event.preventDefault();
    $("#noticeform").valid();
    var title=$('#title').val();
    var file_url=$('#file_url').val();
    var nodate=$('#nodate').val();
   
     if( title !='' && file_url !='' && nodate !='' ){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Notice/Published_Notice");?>',
    data: new FormData($("#noticeform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);;
    if(data.status == 'success'){
    $('#noticemodel').modal('hide');
    $(".modal-backdrop").remove();
    
    $('#noticeform')[0].reset();
    //$('#sid').val('');
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
    } else if (data.status == 'error') {
    $('#noticemodel').modal('hide');
    $(".modal-backdrop").remove();

    $.wnoty({
        type: 'error',
        message: data.message,
        autohideDelay: 1000,
        position: 'top-right'

    });
      setTimeout(function() {
        location.reload(true);
    }, 2000);
    }
    },
    });
    }
    return false;
    })
</script>
   <script type="text/javascript">
     $(document).on('click','#inactive',function(){
    event.preventDefault();
    //var inactivestatus = $(this).val();
    var id = $(this).attr('data-id');
    console.log(id);
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Notice/noticeinactive");?>',
    data: {
        id:id},
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){   
    $.wnoty({
    type: 'success',
    message: 'Status  Inactive Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
    setTimeout(function(){
         location.reload(true);
        },3000);
   }else if(data.error){
        $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'

    });
    } 
    },
    });
    return false;
    })
     
    $(document).on('click','#active',function(){
    event.preventDefault();
   // var inactivestatus = $(this).val();
    var id = $(this).attr('data-id');
    
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Notice/noticeactive");?>',
    data: {
        
        id:id},
    success:function(resp){
    var data=$.parseJSON(resp);
  
    if(data.status == 'success'){   
    $.wnoty({
    type: 'success',
    message: 'Status  Active Successfully',
    autohideDelay: 3000,
    position: 'top-right'

    });
   setTimeout(function(){
     location.reload(true);
    },3000);
   }else if(data.error){
        $.wnoty({
    type: 'error',
    message: data.error,
    autohideDelay: 3000,
    position: 'top-right'

    });
    } 
    },
    });
    return false;
    })

   //delete
    $(document).on('click','.noticedel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this notice ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Notice/Noticedelete') ?>',
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
