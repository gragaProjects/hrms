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
                        <li class="breadcrumb-item active">Assets List</li> -->
                        <button type="button" class="btn btn-info" style="width: 110px;"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#assetsmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Assets </a></button>
                        <!-- <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 110px;">Cancel</a>
                    </ol> -->
                </div>
            </div>
            <div class="container-fluid">
                <div class="row m-b-10"> 
                    <div class="col-12">
                        <!-- <button type="button" class="btn btn-info" style="width: 110px;"><i class="fa fa-plus"></i><a data-toggle="modal" data-target="#assetsmodel" data-whatever="@getbootstrap" class="text-white"><i class="" aria-hidden="true"></i> Add Assets </a></button>
                        <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 110px;">Cancel</a> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp; Assets List</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.NO</th>
                                            
                                                <th>Category</th>
                                                <th>Name </th>
                                                <th>Brand </th>
                                                <th>Model</th>
                                                <th>Code </th>
                                                <th>Configuration </th>
                                                <th>InStock </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                   
                                        <tbody>
                                           <?php
                                           $i = 1; 
                                           foreach($assets as $value): ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $value->cat_name ?></td>
                                                <td><?php echo $value->ass_name ?></td>
                                                <td><?php echo $value->ass_brand ?></td>
                                                <td><?php echo $value->ass_model ?></td>
                                                <td><?php echo $value->ass_code ?></td>
                                                <td><?php echo substr($value->configuration,0,25).'...'?></td>
                                                <td><?php echo $value->in_stock ?></td>
                                                <td class="jsgrid-align-center ">
                                                    <a href="#" title="Edit" class="btn btn-sm btn-info waves-effect waves-light assets" data-id="<?php echo $value->ass_id ?>"><i class="fa fa-pencil-square-o"></i></a>
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
                            <!-- sample modal content -->
                        <div class="modal fade" id="assetsmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">Add Asset </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="post" action="" id="btnSubmit" enctype="multipart/form-data">
                                    <div class="modal-body">
                                           <div class="row">
                                            <div class="col-md-4">      
                                            <div class="form-group">
                                                <label class="control-label">Asset name</label><span class="error"> *</span>
                                                <input type="text" name="assname"  id="assname" class="form-control" required>
                                            </div>
                                            </div>
                                            <div class="col-md-4"> 
                                            <div class="form-group">
                                               <label class="control-label">Category Type </label><span class="error"> *</span>
                                                <select name="catid" id="catid"  class="select2 form-control custom-select search" style="width: 100%" required>
                                                    <option value=""> Select Category</option>
                                                    <?php foreach($catvalue as $value): ?>
                                                    <option value="<?php echo $value->cat_id ?>"><?php echo $value->cat_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label id="catid-error" class="error" for="catid" style=" display: none">This field is required.</label>
                                            </div>
                                            </div>
                                             <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label class="control-label">Assets Brand</label><span class="error"> *</span>
                                                <input type="text" name="brand" id="brand" value="" class="form-control"  required>
                                            </div>
                                            </div>
                                             <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label class="control-label">Assets Model</label>
                                                <input type="text" name="model" id="model" value="" class="form-control">
                                            </div>
                                            </div>
                                             <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label class="control-label">Assets Code</label>
                                                <input type="text" name="code" id="code" value="" class="form-control">
                                            </div>                                                   
                                            </div>                                                   
                                               
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Configuration</label><span class="error"> *</span>
                                                <textarea class="form-control" name="config" id="config"  required  rows="1"></textarea>
                                            </div>
                                        </div>
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label class="control-label">Purchaseing Date</label><span class="error"> *</span>
                                                <input type="text" name="purchase" id="purchase" value="" class="form-control mydatepicker"  required>
                                            </div>
                                            </div>
                                             <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label class="control-label">Price</label><span class="error"> *</span>
                                                <input type="number" name="price" id="price" class="form-control" required>
                                            </div>
                                            </div>
                                             <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label class="control-label">Quantity</label><span class="error"> *</span>
                                                <input type="number" name="pqty" id="pqty" class="form-control"  required>
                                            </div>                                                   
                                               </div>
                                        </div>
<!--
                                            <div class="form-group">
                                                <input name="type" type="checkbox" id="radio_2" data-value="Logistic" value="Logistic" class="type">
                                                <label for="radio_2">Add To Logistic Support List</label>
                                            </div>-->       
                                    </div>
                                    <div class="modal-footer">
                                       <input type="hidden" name="aid" value="">
                               
                                        <button type="submit" class="btn btn-primary" id="add_assets">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <script type="text/javascript">
                        $(document).ready(function () {
                            $(".assets").click(function (e) {
                                e.preventDefault(e);
                                // Get the record's ID via attribute  
                                var iid = $(this).attr('data-id');
                                $('#btnSubmit').trigger("reset");
                                $('#assetsmodel').modal('show');
                                $.ajax({
                                    url: 'AssetsByID?id=' + iid,
                                    method: 'GET',
                                    data: '',
                                    dataType: 'json',
                                }).done(function (response) {
                                    console.log(response);
                                    // Populate the form fields with the data returned from server
                					$('#btnSubmit').find('[name="aid"]').val(response.assetsByid.ass_id).end();
                                    $('#btnSubmit').find('[name="catid"]').val(response.assetsByid.cat_id).end();
                                    $('#btnSubmit').find('[name="assname"]').val(response.assetsByid.ass_name).end();
                                    $('#btnSubmit').find('[name="brand"]').val(response.assetsByid.ass_brand).end();
                                    $('#btnSubmit').find('[name="model"]').val(response.assetsByid.ass_model).end();                                                   
                                    $('#btnSubmit').find('[name="code"]').val(response.assetsByid.ass_code).end();                                                   
                                    $('#btnSubmit').find('[name="config"]').val(response.assetsByid.configuration).end();          
                                    $('#btnSubmit').find('[name="purchase"]').val(response.assetsByid.purchasing_date).end();                                              
                                    $('#btnSubmit').find('[name="price"]').val(response.assetsByid.ass_price).end();                                              
                                    $('#btnSubmit').find('[name="pqty"]').val(response.assetsByid.ass_qty).end();                                              
                             
                                   
                				});
                            });
                        });
                </script>                        
    <?php $this->load->view('backend/footer'); ?>   
    <script>
       /*  $(this).next('.error').css({
            display: 'none'
        })*/
    $('.custom-select').on('change', function() {
        //$('input:required').remove();
        $(this).removeClass('error');
        $(this).addClass('valid');
        $(this).next().next('.error').css({
            display: 'none'
        });//new
    })
   $('.close , .btn-default').on('click',function(){
    $('#btnSubmit')[0].reset();
     $('#aid').val('');
         location.reload(true);
    });
    $(document).on('click','#add_assets',function(){
    event.preventDefault();
    $("#btnSubmit").valid();
    var assname=$('#assname').val();
    var catid=$('#catid').val();
    var brand=$('#brand').val();
    var config=$('#config').val();
    var purchase=$('#purchase').val();
    var price=$('#price').val();
    var pqty=$('#pqty').val();
   
     if( assname !='' && catid !=''&& brand !=''&& config !=''&& purchase !=''&& price !=''&& pqty !=''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Logistice/Add_Assets");?>',
    data: new FormData($("#btnSubmit")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);;
    if(data.status == 'success'){
    $('#assetsmodel').modal('hide');
    $(".modal-backdrop").remove();

    $('#btnSubmit')[0].reset();
    $('#aid').val('');
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

    //delete
    $(document).on('click','.noticedel', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this assets ?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Logistice/Assetsdelete') ?>',
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