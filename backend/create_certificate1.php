<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Generate Certificate </h3>
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
                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Generate Certificate  </h4>
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
                                    <label for="title" class="">Title</label><span class="error"> *</span>
                                    <input type="text" class="form-control validate" name="title"  id="title" placeholder=""   style="text-transform: capitalize;" maxlength="120" required>
                                </div>

                                  
                               
                            </div>
                            <!-- Text editor -->
                               <div class="row " id="dynamic_field">
                                <div class="col-12 mt-2">
                                    <!-- <div class="card">
                                        <div class="card-body"> -->
                                            <label class="">Annexure 1</label>
                                            <!-- <form method="post"> -->
                                                <textarea id="content1" class="mymce content" name="content[]"></textarea>
                                            <!-- </form> -->
                                       <!--  </div>
                                    </div> -->
                                    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                </div>
                                 </div>
                            <!-- Text editor -->
                            
                        </div>
                       <div class="form-group clearfix">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="hidden" name="id"  id="id" />
                                <button type="submit"  id="add_data" class="btn btn-info">Submit</button>
                                <a href="<?php echo base_url('Certificate') ?>"class="btn btn-info">Back</a>
                                
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


    <!-- wysuhtml5 Plugin JavaScript -->
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/tinymce/tinymce.min.js"></script> -->

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
        
        // $(document).ready(function () {
        
        // $(document).on('click', '#add_data', function(e) {
        // //$('#depform').submit(function(event) {
        // e.preventDefault();
        // $("#shiftform").valid();
       
        // var busunit=$("#busunit").val();
        // var title=$("#title").val();
        // console.log($("[name='content[]']").val())
    
        // if( busunit != '' && title != ''   ){
        // //console.log( $(".content").val())
        // $.ajax({
        // type:'post',
        // url: '<?php echo base_url("Certificate/Save_certificate");?>',
        // // data: new FormData($("#shiftform")[0]),
        // // contentType: false,
        // // processData: false,
        //  data: $("#shiftform").serialize(), // Serialize the form data
        // success:function(resp){
        // var data=$.parseJSON(resp);
        // if(data.status == 'success'){
        // //var dep = $('#department').val();
        // $('#shiftform')[0].reset();
        
        // $.wnoty({
        // type: 'success',
        // message: 'Added Successfully',
        // autohideDelay: 1000,
        // position: 'top-right'
        // });
        // // setTimeout(function(){
        // // window.location.href = '<?php echo base_url('Certificate')?>';
        // // },3000);
        // }else if(data.error){
        
        // $.wnoty({
        // type: 'error',
        // message: 'This  Is Already Exist',
        // autohideDelay: 3000,
        // position: 'top-right'
        // });
        // }else if(data.valid){
        // $.wnoty({
        // type: 'error',
        // message: data.valid,
        // autohideDelay: 3000,
        // position: 'top-right'
        // });
        // }
        // },
        // });
        // }
        
        // return false;
        // })
        // })
        
       
    //      $(document).ready(function() {

    //     if ($(".mymce").length > 0) {
    //         tinymce.init({
    //             selector: "textarea#mymce",
    //             theme: "modern",
    //             height: 200,
    //             plugins: [
    //                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
    //                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    //                 "save table contextmenu directionality emoticons template paste textcolor"
    //             ],
    //             toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

    //         });
    //     }
    // });   

  

        $(document).ready(function() {

    function initializeTinyMCE(selector) {
        tinymce.init({
            selector: selector,
            theme: "modern",
            height: 200,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
        });
    }

    // Initial TinyMCE initialization
    initializeTinyMCE("textarea.mymce");

    var i = 1;

    $('#add').click(function() {
        i++;
        var newElement = $('<div class="col-12 mt-2"> <label class="">Annexure ' + i + '</label> <textarea id="content' + i + '" class="mymce content" name="content[]"></textarea> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button></div>');
        $('#dynamic_field').append(newElement);

        // Initialize TinyMCE for the dynamically added textarea
        //initializeTinyMCE('textarea[name="area_' + i + '"]');
        initializeTinyMCE('textarea[name="content[]"]');
    });
    
    
    // Remove dynamic elements
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).parent().remove();
    });

});

//add new
         $(document).on('click', '#add_data', function(e) {
        e.preventDefault();
        $("#shiftform").valid();

        var busunit = $("#busunit").val();
        var title = $("#title").val();

        var contentArray = [];
        // Iterate through all TinyMCE instances and retrieve content
        $('.mymce').each(function() {
            var content = tinyMCE.get($(this).attr('id')).getContent();
            contentArray.push(content);
        });

        if (busunit != '' && title != '') {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url("Certificate/Save_certificate");?>',
                data: {
                    busunit: busunit,
                    title: title,
                    content: contentArray
                },
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
                    } else if (data.error) {
                        $.wnoty({
                            type: 'error',
                            message: 'This Is Already Exist',
                            autohideDelay: 3000,
                            position: 'top-right'
                        });
                    } else if (data.valid) {
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
    });
          
    </script>