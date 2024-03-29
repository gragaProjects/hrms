<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Add Shift Master </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Add Shift Master</li>
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
                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Add Shift Master  </h4>
            </div>
            <div class="card-body">
                <div class="table_body">
                    <form  id="shiftform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        
                        <div class="form-group clearfix m-3">
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label class="">Business Unit</label><span class="error"> *</span>
                                    <select name="busunit" id="busunit" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                        <option value="">Select Business Unit</option>
                                        
                                        <?Php foreach($businessunitvalue as $value): ?>
                                        <option value="<?php echo $value->id ?>"> <?php echo $value->name ?></option>
                                        
                                        <?php endforeach; ?>
                                    </select>
                                    <label id="busunit-error" class="error" for="busunit" style="display: none;">This field is required.</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="title" class="">Shift Name</label><span class="error"> *</span>
                                    <input type="text" class="form-control validate" name="shift_name"  id="shift_name" placeholder=""   style="text-transform: capitalize;" maxlength="120" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="title" class="">Shift Code</label><span class="error"> *</span>
                                    <input type="text" class="form-control validate" name="shift_code" id="shift_code" placeholder=""   maxlength="120" required>
                                </div>

                                   <div class="col-md-3">
                                    <label class="">Night Shift</label><span class="error"> *</span>
                                    <select name="night_shift" id="night_shift"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                        
                                        <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                        
                                    </select>
                                </div>
                               
                            </div>
                            
                        </div>
                       <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="hidden" name="id"  id="id" />
                                <button type="submit" name="add_department" id="add_shift" class="btn btn-info">Submit</button>
                                <a href="<?php echo base_url('Shift/ShiftManagement') ?>"class="btn btn-info">Back</a>
                                
                            </div>
                        </div>
                        
                    </form>
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
        
        $(document).on('click', '#add_shift', function(e) {
        //$('#depform').submit(function(event) {
        e.preventDefault();
        $("#shiftform").valid();
       
        var busunit=$("#busunit").val();
        var shift_name=$("#shift_name").val();
        var shift_code=$("#shift_code").val();
        var night_shift=$("#night_shift").val();
   
    
        if( busunit != '' && shift_name != ''  && shift_code != ''  && night_shift != '' ){
        $.ajax({
        type:'post',
        url: '<?php echo base_url("Shift/Save_Shift");?>',
        data: new FormData($("#shiftform")[0]),
        contentType: false,
        processData: false,
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        //var dep = $('#department').val();
        $('#shiftform')[0].reset();
        
        $.wnoty({
        type: 'success',
        message: 'Shift Added Successfully',
        autohideDelay: 3000,
        position: 'top-right'
        });
        setTimeout(function(){
        window.location.href = '<?php echo base_url('shift/ShiftManagement')?>';
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