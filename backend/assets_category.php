<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
         <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><i class="fa fa-cart-plus"></i> Assets</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Assets Category</li> -->
                        <button type="button" class="btn btn-info" style=""><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#assetsmodel" data-whatever="@getbootstrap" class="text-white TypeModal"><i class="" aria-hidden="true"></i> Add Category </a></button>
                         <!-- <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="">Cancel</a> -->
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Assets Category List                       
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.NO </th>
                                                <th>Type</th>
                                                <th>Name </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                  
                                        <tbody>
                                           <?php $i = 1;
                                           foreach($catvalue as $value): ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                          
                                                <td><?php echo $value->cat_status ?></td>
                                                <td><?php echo $value->cat_name; ?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="" title="Edit" class="btn btn-sm btn-info waves-effect waves-light AssetsModal" data-id="<?php echo $value->cat_id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                     <?php if( $this->role->User_Permission('assets','can_delete') ){?>
                                       <button   title="Delete"  class="btn btn-sm btn-info waves-effect waves-light noticedel" data-id="<?php echo $value->cat_id; ?>"><i class="fa fa-trash-o"></i></button>   <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="modal fade" id="assetsmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="assettitle">Assets Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="" id="assetsform" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        
                                        <div class="form-group">
                                       <label>Category Type </label><span class="error"> *</span>
                                        <select name="cattype" id="cattype" class="form-control custom-select" required>
                                            <option value="">Select Category</option>
                                            <option value="ASSETS">Assets</option>
                                            <option value="LOGISTIC">Logistice</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Category Name </label><span class="error"> *</span>
                                        <input type="text" name="catname" id="catname" class="form-control" value="" placeholder="Category name..." minlength="2" required>
                                        </div>                                          
                                        
                                    </div>
                                    <div class="modal-footer">
                                    <input type="hidden" name="catid" value="" class="form-control" id="catid">   
                                    <button type="submit" class="btn btn-primary" id="btn_assets">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                       
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function () {
                            $(".AssetsModal").click(function (e) {
                                e.preventDefault(e);
                                // Get the record's ID via attribute  
                                var iid = $(this).attr('data-id');
                                $('#assetsform').trigger("reset");
                                $('#assetsmodel').modal('show');
                                $.ajax({
                                    url: 'AssetscatByID?id=' + iid,
                                    method: 'GET',
                                    data: '',
                                    dataType: 'json',
                                }).done(function (response) {
                                    console.log(response);
                                    // Populate the form fields with the data returned from server
                        			$('#assetsform').find('[name="catid"]').val(response.assetscatval.cat_id).end();
                                    $('#assetsform').find('[name="catname"]').val(response.assetscatval.cat_name).end();
                                    $('#assetsform').find('[name="cattype"]').val(response.assetscatval.cat_status).end();
                        /*                                                     if (response.assetsByid.Assets_type == 'Logistic')
                                   $('#btnSubmit').find(':checkbox[name=type][value="Logistic"]').prop('checked', true);*/
                                   
                        		});
                            });
                        });
                        </script>                             
<?php $this->load->view('backend/footer'); ?>
<script>
    $('.custom-select').on('change', function() {
        //$('input:required').remove();
        $(this).removeClass('error');
        $(this).addClass('valid');
        $(this).next('.error').css({
            display: 'none'
        });
    })
   $('.close , .btn-default').on('click',function(){
    $('#assetsform')[0].reset();
     $('#catid').val('');
         location.reload(true);
    });
    $(document).on('click','#btn_assets',function(){
    event.preventDefault();
    $("#assetsform").valid();
    var catname=$('#catname').val();
    var cattype=$('#cattype').val();
   
     if( catname !='' && cattype !=''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Logistice/Add_Assets_Category");?>',
    data: new FormData($("#assetsform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);;
    if(data.status == 'success'){
    $('#assetsmodel').modal('hide');
    $(".modal-backdrop").remove();

    $('#assetsform')[0].reset();
    $('#catid').val('');
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
       $('#assetsmodel').modal('hide');
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

       //delete
    $(document).on('click','.noticedel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this asset ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Logistice/AssetCatdelete') ?>',
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
     }else if (data.status == 'error') {
    
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