<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Create Template </h3>
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
                    <h4 class="m-b-0 text-white">&nbsp;&nbsp;Edit Template</h4>
                </div>
                <div class="card-body">
                    <div class="table_body">
                        <form id="shiftform" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="form-group clearfix m-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="">Business Unit</label><span class="error"> *</span>
                                        <select name="busunit" id="busunit" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                            <option value="">Select Business Unit</option>
                                            <?Php foreach ($businessunitvalue as $value) : ?>
                                                <option value="<?php echo $value->id ?>" <?php if($value->id == $certificate_data->busunit){ echo 'selected';} ?> > <?php echo $value->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label id="busunit-error" class="error" for="busunit" style="display: none;">This field is required.</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="title" class="">Template Name</label><span class="error"> *</span>
                                        <input type="text" class="form-control validate" name="title" id="title" placeholder="" style="text-transform: capitalize;" maxlength="120" required value="<?php echo $certificate_data->title; ?>">
                                    </div>
                                </div>
                                <!-- Text editor -->
                                <div class="row " id="dynamic_field">
                                    <div class="col-12 mt-2">
                                        <?php 
                                        $i = 1;
                                        foreach ($content_data as $content) : ?>
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- <label class="">Annexure <?= $i; ?></label> -->
                                                        <!-- new -->
                                                      <a href="#" class="dynamic-title dynamic-title-<?= $i; ?>" data-type="text" data-pk="1" data-title="Enter title"><?php echo $content->title; ?></a>
                                                       <!-- new -->
                                                    <textarea id="content<?= $i; ?>" class="mymce content" name="content[]"><?php echo $content->content; ?></textarea>
                                                      <div id="tag-container-content<?= $i; ?>" class="tag-container"></div>
                                                    <?php if($i == 1) { ?>
                                                    <?php }else { ?>
                                                       <button type="button" name="delete_content" id="delete_content" data-id="<?php echo $content->id; ?>" class="btn btn-danger delete_content">Delete</button>
                                                        <?php } ?>
                                                </div>
                                            </div>
                                        <?php $i++; endforeach; ?>
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                    </div>
                                </div>
                                <!-- Text editor -->
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-9 col-md-offset-3">
                                    <input type="hidden" name="id" id="id" value="<?php echo $certificate_data->id; ?>" />
                                    <button type="submit" id="update_data" class="btn btn-info">Update</button>
                                    <a href="<?php echo base_url('Certificate') ?>" class="btn btn-info">Back</a>
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

        //7-12-23
          var selectedTags = [];
    $(document).ready(function () {
    var i = <?php echo count($content_data); ?>; // Set i to the number of existing editors

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

    function initializeNewEditor(editorId) {
        initializeTinyMCE('#' + editorId);
        var newTagsContainer = $('#tag-container-' + editorId);
        fetchTagsAndDisplay(editorId, newTagsContainer);
    }

    function fetchTagsAndDisplay(editorId, tagsContainer) {
        $.ajax({
            url: '<?php echo base_url('Certificate/getTags'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                displayTags(data, editorId, tagsContainer);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    // Initial TinyMCE initialization for existing editors
    <?php for ($j = 1; $j <= count($content_data); $j++) : ?>
        initializeNewEditor('content<?php echo $j; ?>');
    <?php endfor; ?>

    $('#add').click(function () {
        i++;
        var newEditorId = 'content' + i;
        // <label class="">Annexure ' + i + '</label>
        var newTitleClass = 'dynamic-title-' + i;
        var newElement = $('<div class="col-12 mt-2"><a href="#" class="dynamic-title ' + newTitleClass + '" data-type="text" data-pk="1" data-title="Enter title">Annexure ' + i + '</a>  <textarea id="' + newEditorId + '" class="mymce content" name="content[]"></textarea> <div class="tag-container" id="tag-container-' + newEditorId + '"></div><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button></div>');
        $('#dynamic_field').append(newElement);


                // Initialize editable for dynamic titles
                $('.' + newTitleClass).editable({
                    type: 'text',
                    title: 'Enter title',
                    mode: 'inline'
                });


        // Initialize TinyMCE and display tags for the dynamically added textarea
        initializeNewEditor(newEditorId);
    });
     // Initialize editable for dynamic titles
                $('.dynamic-title').editable({
                    type: 'text',
                    title: 'Enter title',
                    mode: 'inline'
                });

    // Remove dynamic elements
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).parent().remove();
    });

    // Function to insert tags into the TinyMCE editor at the current cursor position
    function insertTag(tag, editorId) {
        var editor = tinymce.get(editorId);
        if (editor) {
            editor.selection.setContent(tag);
        }
    }

    // Display tags below the TinyMCE editors
    function displayTags(tags, editorId, tagsContainer) {
        tagsContainer.empty(); // Clear existing tags

        $.each(tags, function (index, tag) {
            var tagElement = $('<span class="badge badge-primary tag m-1" data-tag="' + tag.name + '">' + tag.name + '</span>');
            tagsContainer.append(tagElement);
        });

        // Unbind previous click events
        tagsContainer.off('click', '.tag');

        // Handle click event for inserting tags
        tagsContainer.on('click', '.tag', function () {
            var tag = $(this).data('tag');
            insertTag(tag, editorId);

            // new tag addition
            if (selectedTags.indexOf(tag) === -1) {
                selectedTags.push(tag);
            }
        });
    }

    // Call fetchTagsAndDisplay for all existing editors
    <?php for ($j = 1; $j <= count($content_data); $j++) : ?>
        fetchTagsAndDisplay('content<?php echo $j; ?>', $('#tag-container-content<?php echo $j; ?>'));
    <?php endfor; ?>
});





    $(document).on('click', '#update_data', function(e) {
    e.preventDefault();
    $("#shiftform").valid();

    var busunit = $("#busunit").val();
    var title = $("#title").val();
    var contentArray = [];
      //new
            var editedTitles = [];

             $('.dynamic-title').each(function() {
            var editedTitle = $(this).text(); // Directly use text() to get the edited title
            editedTitles.push(editedTitle);
        });
    $('.mymce').each(function() {
        var content = tinyMCE.get($(this).attr('id')).getContent();
        contentArray.push(content);
    });

    if (busunit != '' && title != '') {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url("Certificate/update_certificate");?>',
            data: {
                busunit: busunit,
                title: title,
                content: contentArray,
                selectedTags: selectedTags,
                  editedTitles: editedTitles,
                id: <?php echo $certificate_data->id; ?>,
            },
            success: function(resp) {
                 var data = $.parseJSON(resp);
                    if (data.status == 'success') {
                        $('#shiftform')[0].reset();
                        $.wnoty({
                            type: 'success',
                            message: 'Updated Successfully',
                            autohideDelay: 1000,
                            position: 'top-right'
                        });
                        setTimeout(function(){
                            window.location.href = '<?php echo base_url('Certificate')?>';
                            },2000);
       
                    }
            },
        });
    }
    return false;
});


    //delete_content
     $(document).on('click','.delete_content', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
    $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this content?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Certificate/CertificateContentdelete') ?>',
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