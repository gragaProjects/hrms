<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Email Settings</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Email Settings</li> -->
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Email  Configuration  </h4><!-- SMTP -->
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                      <!--  <div class="switchery-demo m-b-30">
                                      <label>SMTP</label>
                                            <input type="checkbox" checked class="js-switch" data-color="#1976d2" data-secondary-color="#009efb" data-size="small"/>
                                            <label>Mail Function</label> 
                                            </div>-->
                                    <div class="row">
                                    <div class="col-md-2"> 
                                    <input name="group1" type="radio" id="radio_1"  checked/>
                                    <label for="radio_1">SMTP</label> </div>
                                    <div class="col-md-2"> 
                                    <input name="group1" type="radio" id="radio_2"  />
                                    <label for="radio_2">Mail Function</label>
                                    </div>
                                  </div>
                                       
                                     <div class="mail">
                                    <form  id="mailfunctionform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                
                                                                   
                                     <div class="row">
                                        <div class="col-md-3">                                                   
                                        <div class="form-group clearfix">
                                          <label for="frommail" >Mail From Address</label><span class="error"> *</span>
                                                <input type="email" class="form-control " name="from_mail"  id="from_mail1" <?php if(isset($email_veiw->from_mail)){ ?>  value="<?php echo $email_veiw->from_mail; ?>" <?php }?> required>
                                            </div>
                                        </div> 
                                            <div class="col-md-3">
                                            <div class="form-group clearfix">
                                          <label for="fromname" >Mail From Name</label><span class="error"> *</span>
                                                <input type="text" class="form-control " name="from_name"  id="from_name1" <?php if(isset($email_veiw->from_name)){ ?>  value="<?php echo $email_veiw->from_name; ?>" <?php }?> required>
                                            </div>
                                        </div>                                
                                       </div>  
                                           <div class="row">
                                         <div class="form-group clearfix">
                                            <div class="col-md-12 col-md-offset-3">
                                                <input type="hidden" name="id" <?php 
                                                if(isset($email_veiw->id)){ ?>  value="<?php echo $email_veiw->id; ?>"
                                                 <?php }else{?> value='' <?php }?> >
                                                 <input type="hidden" name="mail" value="mail">
                                                <button type="submit" name="save_mailfunc" id="save_mailfunc" class="btn btn-info">Update</button>
                                                <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                                
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </form>
                                     </div> 
                                     <div class="smtpmail" style="display: none;">
                                          <form  id="mailform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                
                                       <div class="row">
                                        <div class="col-md-3">
                                        <div class="form-group clearfix">
                                           <label for="title" >Mail Host</label><span class="error"> *</span>
                                                <input type="text" class="form-control " name="host"   id="host" placeholder="smtp.gmail.com" <?php if(isset($smtp_veiw->host)){ ?>  value="<?php echo $smtp_veiw->host; ?>" <?php }?>  required>
                                            </div>
                                          </div>                                    
                                        <div class="col-md-3">                                                   
                                        <div class="form-group clearfix">
                                          <label for="port" >Mail Port</label><span class="error"> *</span>
                                                <input type="number" class="form-control " name="port"  id="port" <?php if(isset($smtp_veiw->port)){ ?>  value="<?php echo $smtp_veiw->port; ?>" <?php }?> placeholder="587" required>
                                            </div>
                                        </div>                                
                                      
                                         <div class="col-md-3">
                                        <div class="form-group clearfix">
                                           <label for="title" >Mail Username</label><span class="error"> *</span>
                                                <input type="text" class="form-control " name="username"  id="username" <?php if(isset($smtp_veiw->username)){ ?>  value="<?php echo $smtp_veiw->username; ?>" <?php }?>  required>
                                            </div>
                                          </div>                                    
                                        <div class="col-md-3">                                                   
                                        <div class="form-group clearfix">
                                          <label for="password" >Mail Password</label><span class="error"> *</span>
                                                <input type="password" class="form-control " name="password"  id="password" <?php if(isset($smtp_veiw->password)){ ?>  value="<?php echo $smtp_veiw->password; ?>" <?php }?> required>
                                            </div>
                                        </div>                                
                                       </div>                                
                                        
                                        <div class="row">
                                          <div class="col-md-3">                                                   
                                        <div class="form-group clearfix">
                                          <label for="frommail" >Mail From Address</label><span class="error"> *</span>
                                                <input type="email" class="form-control " name="from_mail"  id="from_mail" <?php if(isset($smtp_veiw->from_mail)){ ?>  value="<?php echo $smtp_veiw->from_mail; ?>" <?php }?> required>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                          <label for="fromname" >Mail From Name</label><span class="error"> *</span>
                                                <input type="text" class="form-control " name="from_name"  id="from_name" <?php if(isset($smtp_veiw->from_name)){ ?>  value="<?php echo $smtp_veiw->from_name; ?>" <?php }?> required>
                                            </div>
                                        </div>                               
                                        </div>                               
                                        
                                                                       
                                                                          
                                         <div class="row">
                                         <div class="form-group clearfix">
                                            <div class="col-md-12 col-md-offset-3">
                                                <input type="hidden" name="mail" value="smtp">
                                                <input type="hidden" name="id" <?php 
                                                if(isset($smtp_veiw->id)){ ?>  value="<?php echo $smtp_veiw->id; ?>"
                                                 <?php }else{?> value='' <?php }?> >
                                                <button type="submit" name="save_mail" id="save_mail" class="btn btn-info">Update</button>
                                                <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                                
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </form>
                                     </div> 
                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Email  Alert  </h4><!-- SMTP -->
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    
                               <form  id="emailalertform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                    <?php $govtIDvalue = $this->employee_model->getgovtID(); ?>
                                                                   
                                     <div class="row">
                                     
                                            <div class=" form-group col-md-3 clearfix">
                                                <label> ID Type</label><span class="error"> *</span>
                                                <select name="govt_id" id="govt_id" class="form-control custom-select" style="width: 100%; min-height: 38px;" required>
                                                    <option value="" > Select Id Type</option>
                                                    <?Php foreach($govtIDvalue as $value): ?>
                                                    <option value="<?php echo $value->id ?>"><?php echo $value->govID_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                    <a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#govtModal" class="modalbtn">Add New ID Type</a>
                                                    <div class="error"></div>
                                                </div>
                                            <div class="col-md-3">
                                            <div class="form-group clearfix">
                                          <label for="fromname" >Alert Frequency (Days)</label><span class="error"> *</span>
                                                <input type="number" class="form-control " name="sequence"  id="sequence"required>
                                            </div>
                                        </div>                                
                                       </div>  
                                           <div class="row">
                                         <div class="form-group clearfix">
                                            <div class="col-md-12 col-md-offset-3">
                                                <input type="hidden" name="id" >
                                                 
                                                <button type="submit" name="save_sequence" id="save_sequence" class="btn btn-info">Save</button>
                                                <a type="button" class="btn btn-info text-white cancel" href="<?php echo base_url(); ?>">Cancel</a>
                                                
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </form>
                                   
                                  <div class="table-responsive ">
                                    <table id="employees123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th> S.NO</th>
                                                <th>Goverment Id</th>
                                                <th>Alert Frequency (Days)</th>
                                          
                                               <?php if($this->role->User_Permission('department','can_edit')){?>
                                                <th>Action</th>
                                                 <?php }; ?>
                                            </tr>
                                        </thead>
                                  

                                       <tbody >
                                        
                                        <?php  $i = 1;
                                        foreach($email_sequence as $val){ ?>
                                       <tr>
                                        <td><?=$i?></td>
                                        <td><?php $gid = $val->govt_id;
                                            $get_name =  $this->settings_model->Getgovid_name($gid);
                                            echo $get_name->govID_name;
                                         ?></td>
                                        <td><?=$val->sequence?></td>
                                        <td class="jsgrid-align-center ">
                                           <a href="" title="Edit"  class="btn btn-sm btn-info waves-effect waves-light editsequence" data-id="<?php echo $val->id; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                           <button   title="Delete" data-id="<?php echo $val->id; ?> "class="btn btn-sm btn-info waves-effect waves-light delete"><i class="fa fa-trash-o"></i></button>
                                            
                                        </td>
                                      </tr>
                                     
                                     
                                        <?php $i++; }?>
                                         
                                        </tbody> 
                                    </table>
                                </div>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
    <?php $this->load->view('backend/footer'); ?>
    <?php $this->load->view('backend/em_modal'); ?>
    <?php $this->load->view('backend/em_view'); ?>

    <script type="text/javascript">
         $(".search").select2({
          theme:"bootstrap"
      });

          $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
             $('#encryption-error').removeClass('error');
         $('#encryption-error').css({display:'none'});
    })

   $(document).on('click','#save_mail',function(){
    event.preventDefault();
   $("#mailform").valid();
    
    var host=$("#host").val();
    var port=$("#port").val();
    var username=$("#username").val();
    var password=$("#password").val();
    var encryption=$("#encryption").val();
    var from_mail=$("#from_mail").val();
    var from_name=$("#from_name").val();
    var mail =$("[name='mail']").val();
    var id =$("[name='id']").val();
     

    
  if(host != '' && username != ''  && password != '' && encryption != '' && from_mail != '' && from_name != '' && port != '') 
  {
   
    $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Save_EmailSettings");?>',
    data: new FormData($("#mailform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#mailform')[0].reset();
    $.wnoty({
    type: 'success',
    message: data.message ,
    autohideDelay: 3000,
    position: 'top-right'

    });
     $("#radio_1").prop("checked", true);
    /* setTimeout(function(){
     location.reload(true);
    },3000);*/
   } 
    },
    });
    }
  
   
    return false;
    })  

   $(document).on('click','#save_mailfunc',function(){
    event.preventDefault();
   $("#mailfunctionform").valid();
    
    var from_mail=$("#from_mail1").val();
    var from_name=$("#from_name1").val();
    var mail =$("[name='mail']").val();
    var id =$("[name='id']").val();
     

    
  if( from_mail != '' && from_name != '') 
  {
   
    $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Save_EmailSettings");?>',
    data: new FormData($("#mailfunctionform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#mailform')[0].reset();
    $.wnoty({
    type: 'success',
    message: data.message ,
    autohideDelay: 3000,
    position: 'top-right'

    });
     $("#radio_2").prop("checked", true);
    /* setTimeout(function(){
     location.reload(true);
    },3000);*/
   } 
    },
    });
    }
    return false;
    }) 


    // Switchery
    $(document).ready(function() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
    new Switchery($(this)[0], $(this).data());
    });
    });
    $(document).ready(function() {
    $("#radio_1").click(function() {
    $(".mail").hide();
    $(".smtpmail").show();
    //$('#mailform')[0].reset();
    //$("[name='mail']").val('smtp');



    });
    });
    $(document).ready(function() {
    $("#radio_2").click(function() {
    $(".mail").show();
    $(".smtpmail").hide();

    });

    });
    if ($('#radio_1').is(":checked")) {
    $(".mail").hide();
    $(".smtpmail").show();

    } else {
    $(".mail").show();
    $(".smtpmail").hide();

    }
   
   /*Sequenc tab*/
   //seqence settings
 $(document).on('click','#save_sequence',function(){
    event.preventDefault();
   $("#mailfunctionform").valid();
    
    var govt_id=$("#govt_id").val();
    var sequence=$("#sequence").val();

      if( govt_id != '' && sequence != '') 
     {
   
    $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Save_EmailSequence");?>',
    data: new FormData($("#emailalertform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    $('#emailalertform')[0].reset();
    $.wnoty({
    type: 'success',
    message: data.message ,
    autohideDelay: 1000,
    position: 'top-right'

    });
      setTimeout(function(){
     location.reload(true);
    },2000);
    } 
    },
    });
    }
    return false;
    })  

   // Get data
     $(document).ready(function () {
        $(".editsequence").click(function (e) {
        e.preventDefault(e);
        // Get the record's ID via attribute
        var iid = $(this).attr('data-id');
     /*   $('#leaveform').trigger("reset");
        $('#leavemodel').modal('show');*/
        $.ajax({
        url: 'GetSequenceBYID?id=' + iid,
        method: 'GET',
        data: '',
        dataType: 'json',
        }).done(function (response) {
       
        // Populate the form fields with the data returned from server
         $('#emailalertform').find('[name="id"]').val(response.sequencevalue.id).end();
        $('#emailalertform').find('[name="govt_id"]').val(response.sequencevalue.govt_id).end();
        $('#emailalertform').find('[name="sequence"]').val(response.sequencevalue.sequence).end();
    
          });
        });
        });
    //delete
    $(document).on('click','.delete', function (e) {
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure delete?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('settings/DeleteSquence') ?>',
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
    </script>
