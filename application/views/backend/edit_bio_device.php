<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Edit Device </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Device</li> -->
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
                            <form  id="device_edit"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                
                                <div class="form-group clearfix m-3">
                                    <div class="row">
                                    
                                        <div class="col-md-3">
                                            <label for="title" class="">Device Name</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="device_name"  id="device_name" placeholder=""   style="text-transform: capitalize;" maxlength="120" required <?php if(isset($biovalue->device_name)){ ?>value="<?php echo $biovalue->device_name; ?>" <?php }?>>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="">Serial No</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="serial_no" id="serial_no" placeholder=""   maxlength="120" required <?php if(isset($biovalue->serial_no)){ ?>value="<?php echo $biovalue->serial_no; ?>" <?php }?>>
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="title" class="">Ip Address</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="ip_address" id="ip_address" placeholder=""   maxlength="120" required <?php if(isset($biovalue->ip_address)){ ?>value="<?php echo $biovalue->ip_address; ?>" <?php }?>>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" class="">Port</label><span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="port" id="port" placeholder=""   maxlength="120" required <?php if(isset($biovalue->port)){ ?>value="<?php echo $biovalue->port; ?>" <?php }?>>
                                        </div>
                               
                                    </div>
                                    
                                </div>
                    
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="hidden" name="id"  id="id"  value="<?php echo $biovalue->id; ?>"/>
                                        <button type="submit" name="edit_device" id="edit_device" class="btn btn-info">Submit</button>
                                        <a href="<?php echo base_url('Biometric/ViewBiometric') ?>"class="btn btn-info">Back</a>
                                        
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

   
    $(document).on('click','#edit_device',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Biometric/Update_Device");?>',
    data: new FormData($("#device_edit")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#bussinessunitform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Device Updated successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

      setTimeout(function(){
        window.location.href = '<?php echo base_url('Biometric/ViewBiometric')?>';
        },2000);

    /* setTimeout(function(){
     location.reload(true);
    },3000);*/
   }/*else if(data.error){
        $("#department").after(data.error);
        $('#department').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#department").next().remove();
          $('#identitycardmodal')[0].reset();
        
         },2000); 
    }*/ 
    },
    });
    return false;
    })  
    //country
    $(document).on('click','#add_country',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_Country");?>',
    data: $("#countryform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#countrymodel').modal('hide');
    $(".modal-backdrop").remove();
  

    var country = $('#country_name').val();
    $("#country").append("<option value="+data.country_success+">" + country + "</option>");
    $('[name="country"]').append("<option value="+data.country_success+">" + country + "</option>");
    $('#countryform')[0].reset();
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Country Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
  
    //  
    }else if(data.error){
        $("#country_name").after(data.error);
        $('#country_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#country_name").next().remove();
          $('#countryform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  
    //state
     $(document).on('click','#add_state',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_state");?>',
    data: $("#stateform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#statemodel').modal('hide');
    $(".modal-backdrop").remove();
    var country = $('#state_name').val();
    $("#state").append("<option value="+data.state_success+">" + country + "</option>");
    $('[name="state"]').append("<option value="+data.state_success+">" + country + "</option>");
    $('#stateform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'State Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
    
    //  
    }else if(data.error){
        $("#state_name").after(data.error);
        $('#state_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#state_name").next().remove();
          $('#stateform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
      //city
     $(document).on('click','#add_city',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_city");?>',
    data: $("#cityform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#citymodel').modal('hide');
    $(".modal-backdrop").remove();

 
    var country = $('#city_name').val();
    $("#city").append("<option value="+data.state_success+">" + country + "</option>");
    $('[name="city"]').append("<option value="+data.state_success+">" + country + "</option>");
    $('#cityform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'City Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
  
 
    //  
    }else if(data.error){
        $("#city_name").after(data.error);
        $('#city_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#city_name").next().remove();
          $('#cityform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
     //timezone
      $(document).on('click','#add_timezone',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_timezone");?>',
    data: $("#timezoneform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#timezonemodel').modal('hide');
    $(".modal-backdrop").remove();
    setTimeout(function(){
    var timezone = $('#timezone').val();
    $("#timezoneid").append("<option value="+data.message+">" + timezone + "</option>");
    $('#timezoneform')[0].reset();
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Timezone Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     },2000);
    //  
    }else if(data.error){
        $("#timezone").after(data.error);
        $('#timezone').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#timezone").next().remove();
          $('#timezoneform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })  


     //save district
    $(document).on('click','#add_district',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_district");?>',
    data: $("#districtform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'  ){
   $('#districtmodel').modal('hide');
    $(".modal-backdrop").remove();
    var district = $('#district_name').val();
    $('#districtform')[0].reset();
     $("#district").append("<option value="+data.state_success+">" + district + "</option>");
    $.wnoty({
    type: 'success',
    message: 'District Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
   
   }else if(data.error){
        $("#district_name").after(data.error);
        $('#district_name').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#district_name").next().remove();
          $('#districtform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
     //city
     $(document).on('click','#add_city',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Settings/Save_city");?>',
    data: $("#cityform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'){
    $('#citymodel').modal('hide');
    $(".modal-backdrop").remove();

    var city = $('#city_name').val();
    $("#city").append("<option value="+data.state_success+">" + city + "</option>");
    $('#cityform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'City Added Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
  
  
    //  
    }else if(data.error){
        $("#city_name").after(data.error);
        $('#city_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#city_name").next().remove();
          $('#cityform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })

    //select matched state
    $(document).ready(function(){
    $("#country").change(function(){
       
      var country = $("#country").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#state").html(info.content);
             } 
        })
    });
 
    });   
     //select matched state modal
    $(document).ready(function(){
    $("#districtmodel_country").change(function(){
       
      var country = $(this).val();
      console.log(country);
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $('#districtmodel_state').html(info.content);
             } 
        })
    });
 
    });  
    $(document).ready(function(){
    $("#citymodel_country").change(function(){
       
      var country = $(this).val();
      console.log(country);
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $('#citymodel_state').html(info.content);
             } 
        })
    });
 
    });

 
   //select matched district
    $(document).ready(function(){
    $("#state").change(function(){
       
      var state = $("#state").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_district");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $("#district").html(info.content);
             } 
        })
    });
 
    }); 
   //select matched district modal
    $(document).ready(function(){
    $('#citymodel_state').change(function(){
       
      var state = $(this).val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_district");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $('#citymodel_district').html(info.content);
             } 
        })
    });
 
    });

    //select matched city
    $(document).ready(function(){
    $("#district").change(function(){
       
      var district = $("#district").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { district : district },
             success:function(data){
                var info=$.parseJSON(data);
                $("#city").html(info.content);
             } 
        })
    });
 
    });    
    $(document).ready(function(){
    $("#citymodel_district").change(function(){
       
      var district = $(this).val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { district : district },
             success:function(data){
                var info=$.parseJSON(data);
                $("#citymodel_city").html(info.content);
             } 
        })
    });
 
    });

    </script>
