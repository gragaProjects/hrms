<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-university" aria-hidden="true"></i> Projects</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Projects</li>
            </ol>
        </div>
    </div>
    <?php
/*            $startDate = strtotime('2015-06-21');
            $endDate = strtotime('2015-08-01');
            for($i = $startDate; $i <= $endDate; $i = strtotime('+1 day', $i))
                        echo date('Y-m-d',$i);*/
/*                if($result == "Friday"){  
                   echo date("Y-m-d", strtotime($i)). " ".$result."<br>";
                } */
           ?>
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
                  <?php if($this->role->User_Permission('all_projects','can_add')){?>
                <button type="button" class="btn btn-info" style="width: ;"><i class="fa fa-plus"></i><a data-toggle="modal"
                        data-target="#ProjectModal" data-whatever="@getbootstrap" class="text-white"><i class=""
                            aria-hidden="true"></i> Add Project </a></button>
                     <?php } ?>
              <!--    <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>" style="width: 110px;">Cancel</a> -->
               
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp;Upcoming Projects
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Project Title</th>
                                        <th>Status </th>
                                        <th>From </th>
                                        <th>To </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                              
                                <tbody>
                                    <?php $i = 1;
                                    foreach($projects as $value): ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo substr($value->pro_name,0,50).'....' ?></td>
                                        <td><?php echo $value->pro_status ?></td>
                                        <td><?php echo date('d M Y',strtotime($value->pro_start_date)); ?></td>
                                        <td><?php echo date('d M Y',strtotime($value->pro_end_date)) ?></td>
                                        <td class="jsgrid-align-center ">
                                            <a href="view?P=<?php echo base64_encode($value->id); ?>" title="Edit"
                                                class="btn btn-sm btn-info waves-effect waves-light"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                                <?php if($this->role->User_Permission('all_projects','can_delete')){?>
                                                    <button  href="" title="Delete" data-id="<?php echo $value->id;?>" class="btn btn-sm btn-info waves-effect waves-light deleteproject" >
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                 <?php } ?>
                                                    <input type="hidden" name="id" value="<?php echo $value->id;?>" id="id">
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
        <div class="modal fade" id="ProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">Add Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div> <!-- action="Add_Projects" -->
                    <form method="post"  id="projectfrom" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Project Title</label><span class="error"> *</span>
                                        <input type="text" name="protitle" class="form-control" id="protitle"
                                          maxlength="250" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Project Start Date</label><span class="error"> *</span>
                                        <input type="text" name="startdate" class="form-control mydatepicker"
                                            id="startdate" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Project End Date</label><span class="error"> *</span>
                                        <input type="text" name="enddate" class="form-control mydatepicker"
                                            id="enddate" required placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Summery</label>
                                        <textarea class="form-control" name="summery" id="message-text1"
                                            placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Details</label>
                                        <textarea class="form-control" name="details" id="message-text1" 
                                            maxlength="1300" rows="8" placeholder=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label><span class="error"> *</span>
                                        <select class="form-control custom-select" data-placeholder="Choose a Category"
                                            tabindex="1" name="prostatus" id="prostatus" required>
                                            <option value="">Select Status</option>
                                            <option value="Upcoming">Upcoming</option>
                                            <option value="Running">Running</option>
                                            <option value="Completed">Completed</option>
                                         
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          
                            <button type="submit" class="btn btn-primary" id="add_project" >Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <script type="text/javascript">
        //save

        $('.custom-select').on('change', function() {
            //$('input:required').remove();
            $(this).removeClass('error');
            $(this).addClass('valid');
            $(this).next('.error').css({
                display: 'none'
            });
        })
        $(document).on('click', '#add_project', function() {
            event.preventDefault();
            $("#projectfrom").valid();

            var protitle = $("#protitle").val();
            var startdate = $("#startdate").val();
            var startdate = $('#startdate').val();
            var enddate = $("#enddate").val();
            var prostatus = $("#prostatus").val();
            
            if (protitle != '' && startdate != ''  && startdate != ''  && enddate != '' && prostatus != '') {

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url("Projects/Add_Projects");?>',
                    data: new FormData($("#projectfrom")[0]),
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        var data = $.parseJSON(resp);
                        if (data.status == 'success') {

                            $('#ProjectModal').modal('hide');
                            $(".modal-backdrop").remove();
                            setTimeout(function() {
                                $('#projectfrom')[0].reset();
                                $.wnoty({
                                    type: 'success',
                                    message: data.message,
                                    autohideDelay: 5000,
                                    position: 'top-right'
                                });
                            }, 2000);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                        } else if (data.status == 'error') {

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
    $(document).on('click','.deleteproject', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this project?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Projects/projectDelete') ?>',
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

     }/* else if(data.status == 'failed'){
    $.wnoty({
    type: 'error',
    message: "",
    autohideDelay: 3000,
    position: 'top-right'

    });
     } */
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