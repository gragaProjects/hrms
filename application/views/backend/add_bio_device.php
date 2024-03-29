<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Add Device </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Device</li>
            </ol>
        </div>
    </div>
    <?php echo validation_errors(); ?>
    <?php echo $this->upload->display_errors(); ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Device  </h4>
                    </div>
                    <div class="card-body">
                        <div class="table_body">
                            <form  id="depform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                
                                <div class="form-group clearfix m-3">
                                    <div class="row">
                                    
                                        <div class="col-md-3">
                                            <label for="title" class="">Device Name</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="device_name"  id="device_name" placeholder=""   style="text-transform: capitalize;" maxlength="120" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="">Serial No</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="serial_no" id="serial_no" placeholder=""   maxlength="120" required>
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="title" class="">Ip Address</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="ip_address" id="ip_address" placeholder=""   maxlength="120" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="">Port</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="port" id="port" placeholder=""   maxlength="120" required>
                                        </div>
                               
                                    </div>
                                    
                                </div>
                    
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="hidden" name="id"  id="id" />
                                        <button type="submit" name="add_department" id="add_department" class="btn btn-info">Submit</button>
                                        <a href="<?php echo base_url('Biometric/ViewBiometric') ?>"class="btn btn-info">Back</a>
                                        
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
        <?php $this->load->view('backend/footer'); ?>
        <script type="text/javascript">
        $(".search").select2({
        theme:"bootstrap"
        });
        
        $('.custom-select').on('change',function(){
        //$('input:required').remove();
        $(this).removeClass('error');
        $(this).addClass('valid');
        $(this).next('.error').css({display:'none'});
        })
        
        $(document).ready(function () {
        
        $(document).on('click', '#add_department', function(e) {
        //$('#depform').submit(function(event) {
        e.preventDefault();
        $("#depform").valid();
        var device_name=$("#device_name").val();
        var serial_no=$("#serial_no").val();
        var ip_address=$("#ip_address").val();
        var port=$("#port").val();
    
        if(device_name != '' && serial_no != ''   && ip_address != ''  && port != '' ){
        $.ajax({
        type:'post',
        url: '<?php echo base_url("Biometric/Save_Device");?>',
        data: new FormData($("#depform")[0]),
        contentType: false,
        processData: false,
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        //var dep = $('#department').val();
        $('#depform')[0].reset();
        
        $.wnoty({
        type: 'success',
        message: 'Device Added Successfully',
        autohideDelay: 3000,
        position: 'top-right'
        });
        setTimeout(function(){
        window.location.href = '<?php echo base_url('Biometric/ViewBiometric')?>';
        },3000);
        }else if(data.error){
        
        $.wnoty({
        type: 'error',
        message: 'This  Is Already Exist',
        autohideDelay: 3000,
        position: 'top-right'
        });
        }else if(data.valid){
        $.wnoty({
        type: 'error',
        message: data.valid,
        autohideDelay: 3000,
        position: 'top-right'
        });
        }
        },
        });
        }
        
        return false;
        })
        })
       
        </script>