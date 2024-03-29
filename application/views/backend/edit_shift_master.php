<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Edit Shift </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Shift</li> -->
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Shift  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    <form  id="editdepform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                     
                                            <div class="form-group clearfix m-3">
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <label class="">Business Unit</label><span class="error"> *</span>
                                    <select name="busunit" id="busunit" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                        <option value="">Select Business Unit</option>
                                        
                                      
                                             <?Php foreach($businessunitvalue as $value): ?>
                                                <option value="<?php echo $value->id ?>" <?php if($shiftselectval->busunit == $value->id){echo 'selected';}?>> <?php echo $value->name ?></option>
                                         
                                            <?php endforeach; ?>
                                    </select>
                                    <label id="busunit-error" class="error" for="busunit" style="display: none;">This field is required.</label>
                                </div>
                                <div class="col-md-3">
                                    <label for="title" class="">Shift Name</label><span class="error"> *</span>
                                    <input type="text" class="form-control validate" name="shift_name"  id="shift_name" placeholder=""   style="text-transform: capitalize;" maxlength="120" required <?php if(isset($shiftselectval->shift_name)){ ?> value="<?php echo $shiftselectval->shift_name; ?>" <?php }?>>
                                </div>
                                <div class="col-md-3">
                                    <label for="title" class="">Shift Code</label><span class="error"> *</span>
                                    <input type="text" class="form-control validate" name="shift_code" id="shift_code" placeholder=""   maxlength="120" required <?php if(isset($shiftselectval->shift_code)){ ?>value="<?php echo $shiftselectval->shift_code; ?>" <?php }?>>
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
                                           
                                        </div>                                    
                                         <div class="form-group clearfix">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id"  id="id" value="<?php echo $shiftselectval->id; ?>"/>
                                                <button type="submit" name="update_shift" id="update_shift" class="btn btn-info">Submit</button>
                                                 <a href="<?php echo base_url()?>Shift/ShiftManagement" class="btn btn-info">Back</a>
                                                
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

   
    $(document).on('click','#update_shift',function(){ 
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("shift/Update_Shift");?>',
    data: new FormData($("#editdepform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#bussinessunitform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Shift Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

      setTimeout(function(){
   
        window.location.href = '<?php echo base_url('shift/ShiftManagement')?>';
        
        },2000);


    }
    }
    });
    return false;
    })  
  
    
     
    </script>
