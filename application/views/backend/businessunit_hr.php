<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Business Unit HR</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Business Unit HR</li> -->
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
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Business Unit HR</h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body">
                                    <form  id="bussinessunitform" name="bussinessunitform"  method="post" enctype="multipart/form-data" >
                     
                                        
                                    
                                          <div class="col-md-3">
                                            <label> Busniess Unit HR</label><span class="error"> *</span>
                                            <select name="hr" id="hr"  class="form-control custom-select search" style="width: 100%; min-height: 38px;" required>
                                                
                                               </select>
                                            <label id="hr-error" class="error" style="display: none;" for="hr">This field is required.</label>
                                             </div>
                                          <div class="form-group clearfix mt-3">
                                            <div class="col-md-9 col-md-offset-3">
                                                <input type="hidden" name="id" value="<?php echo $Getbusinessunit->id; ?>" 
                                                />
                                                <button type="submit" name="update_businessunit" id="update_businessunit" class="btn btn-info">Submit</button>
                                                 <a href="<?php echo base_url()?>settings/BusinessUnit" class="btn btn-info">Back</a>
                                                
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

    $(document).on('click','#update_businessunit',function(){
    event.preventDefault();
      $("#bussinessunitform").valid();
    if($('#hr').val() != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("settings/Add_hr_businessunit");?>',
    data: new FormData($("#bussinessunitform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    ///var dep = $('#department').val();
    //$('#bussinessunitform')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Business Unit Updated Successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

       setTimeout(function(){
        window.location.href = '<?php echo base_url('settings/BusinessUnit')?>';
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
    }
    return false;
    })  

    //add Bussiness Unit
 
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
    setTimeout(function(){
    var country = $('#country_name').val();
     $("#country").append("<option value="+data.country_success+">" + country + "</option>");
    $('[name="country"]').append("<option value="+data.country_success+">" + country + "</option>");
    $('#countryform')[0].reset();
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Country Added Successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
     },2000);
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

    var state = $('#state_name').val();
     $("#state").append("<option value="+data.state_success+">" + state + "</option>");
   $("#stateid").append("<option value="+data.state_success+">" + state + "</option>");
    $('#stateform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'State Added Successfully',
    autohideDelay: 5000,
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
      /*//city
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
    autohideDelay: 5000,
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
    })*/
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
    //alert('Department Added Successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Timezone Added Successfully',
    autohideDelay: 5000,
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
    autohideDelay: 3000,
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
    autohideDelay: 5000,
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
  /* var country = $("#country option:selected").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#state").html(info.content);
             } 
        })*/
 
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

    //HR
        //Reporting employee
        $(document).ready(function(){
     /*   $("#busunit").change(function(){
        
        var busunit = $(this).val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/GetReportEmp");?>",
        data: { busunit : busunit },
        success:function(data){
        var info=$.parseJSON(data);
        $("#hr").html(info.content);
        }
        })
            
        });*/
       //default
        var busunit = <?php echo $busid ?>;
        var hr = '<?=$Getbusinessunit->hr;?>';
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/Gethr");?>",
        data: { busunit : busunit,hr:hr },
        success:function(data){
        var info=$.parseJSON(data);
        $("#hr").html(info.content);
        }
        })
        });

    </script>
