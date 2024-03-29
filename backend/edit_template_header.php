<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
  <style type="text/css">
      .badge{
        cursor:pointer;
      }
  </style>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Template </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
               <!--  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Generate Certificate</li> -->
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
                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Template  </h4>
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
                                        <option value="<?php echo $value->id ?>" <?php if($value->id == $certificate_data->busunit){ echo 'selected';} ?>> <?php echo $value->name ?></option>
                                        
                                        <?php endforeach; ?>
                                    </select>
                                    <label id="busunit-error" class="error" for="busunit" style="display: none;">This field is required.</label>
                                </div>
                              
                                  
                               
                            </div>
                            <div class="form-group clearfix ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="">Header</label><span class="error"> *</span>
                                    <input type="file" name="header" id="header" class="form-control" required accept="image/*">
                                    <img id="header-preview" class="img-preview" alt="Header Preview" width="350px" src="<?php echo  base_url('assets/uploads/pdf_header_footer/').$certificate_data->header  ?> ">
                                </div>
                                <div class="col-md-3">
                                    <label class="">Footer</label><span class="error"> *</span>
                                    <input type="file" name="footer" id="footer" class="form-control" required accept="image/*" >
                                    <img id="footer-preview" class="img-preview" alt="Footer Preview" width="350px"  src="<?php echo  base_url('assets/uploads/pdf_header_footer/').$certificate_data->footer  ?> ">
                                </div>
                                <div class="col-md-3">
                                    <label class="">Watermark</label><span class="error"> *</span>
                                    <input type="file" name="watermark" id="watermark" class="form-control" required accept="image/*">
                                    <img id="watermark-preview" class="img-preview" alt="Watermark Preview" width="100px"  src="<?php echo  base_url('assets/uploads/pdf_header_footer/').$certificate_data->watermark  ?> ">
                                </div>
                            </div>
                        </div>
                                               

                            <!-- Text editor -->
                            
                        </div>
                       <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="hidden" name="id"  id="id" value="<?php echo $certificate_data->id ?>" />
                                <button type="submit"  id="add_data" class="btn btn-info">Submit</button>
                                <a href="<?php echo base_url('Certificate/template_header') ?>"class="btn btn-info">Back</a>
                                
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
   <?php $this->load->view('backend/footer'); ?>
       <!-- Text editor -->
       <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/tinymce/tinymce.min.js"></script>
       <!-- Text editor -->


        <script type="text/javascript">
        $(".search").select2({
        theme:"bootstrap"
        });
        
   $(document).ready(function () {
    // Function to handle image preview
    function previewImage(input, imgId) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + imgId).attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    }

    // Attach change event handlers using jQuery
    $("#header").change(function () {
        previewImage(this, 'header-preview');
    });

    $("#footer").change(function () {
        previewImage(this, 'footer-preview');
    });

    $("#watermark").change(function () {
        previewImage(this, 'watermark-preview');
    });
});



//add new
         $(document).on('click', '#add_data', function(e) {
        e.preventDefault();
        $("#shiftform").valid();

        var busunit = $("#busunit").val();
       // var title = $("#title").val();


       // if (busunit != '' ) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url("Certificate/Save_Header");?>',
               data: new FormData($("#shiftform")[0]),
                contentType: false,
                processData: false,
                success: function(resp) {
                    var data = $.parseJSON(resp);
                    if (data.status == 'success') {
                        $('#shiftform')[0].reset();
                        $.wnoty({
                            type: 'success',
                            message: 'Added Successfully',
                            autohideDelay: 1000,
                            position: 'top-right'
                        });

                           setTimeout(function(){
                            window.location.href = '<?php echo base_url('Certificate/template_header')?>';
                            },2000);
       
                    }  else if (data.valid) {
                        $.wnoty({
                            type: 'error',
                            message: data.valid,
                            autohideDelay: 3000,
                            position: 'top-right'
                        });
                    }
                },
            });
       // }
        return false;
    });

 


          
    </script>