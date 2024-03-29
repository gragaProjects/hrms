<!-- drop down modals -->
<script>
	//add dep 
    $(document).on('click','#add_dep',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_dep");?>',
    data: $("#depform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#depmodel').modal('hide');
    $(".modal-backdrop").remove();
    setTimeout(function(){
    var dep = $('#department').val();
    $("#dept").append("<option value="+data.dep_success+">" + dep + "</option>");
    $('#depform')[0].reset();
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Department Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
     },2000);
    //  
    }else if(data.error){
        $("#department").after(data.error);
        $('#department').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#department").next().remove();
          $('#depform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    }) 
    //add des
    $(document).on('click','#add_des',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_des");?>',
    data: $("#desform").serialize(),
    success:function(res){
    var data=$.parseJSON(res); 
     if(data.status == 'success' ){
           $('#desmodel').modal('hide');
     $(".modal-backdrop").remove(); 
    
    var des = $('#designation').val();
 
    $("#deg").append("<option value="+data.des_success+">" + des + "</option>");
    $("#exp_com_position").append("<option value="+data.des_success+">" + des + "</option>");
    $('#desform')[0].reset();
    //alert('Designation Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Designation Added successfully',
    autohideDelay: 1000,
    position: 'top-right'
     });
    
     }else if(data.error){
        $("#designation").after(data.error);
        $('#designation').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#designation").next().remove(); 
          $('#desform')[0].reset();
        
         },2000); 
    }  
    }
    });
    return false;
    })
    //add prefix
    $(document).on('click','#pre_btn',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_PrefixTitle");?>',
    data: $("#preform").serialize(),
    success:function(resp){
      var data =$.parseJSON(resp); 
      if(data.status == 'success' ){
     $('#prefixModal').modal('hide');
     $(".modal-backdrop").remove(); 
    setTimeout(function(){
    var dep = $('#prefixtitle').val();
    $("#prefix").append("<option value="+data.prefix_success+">" + dep + "</option>");
    $('#preform')[0].reset();
    //alert('Prefix Added successfully');
     $.wnoty({
    type: 'success',
    message: 'Prefix Added successfully',
    autohideDelay: 5000,
    position: 'top-right'
     });
     },2000); 
      }else if(data.error){
        $("#prefixtitle").after(data.error);
        $('#prefixtitle').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#prefixtitle").next().remove(); 
          $('#preform')[0].reset();
        
         },2000); 
    } 
 
    }
    });
    return false;
    })
    //add role
    $(document).on('click','#role_btn',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_role");?>',
    data: $("#roleform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#rolemodel').modal('hide');
    $(".modal-backdrop").remove();
    
    var role_val = $('#roledata').val();
    $("#role").append("<option value="+data.role_success+">" + role_val + "</option>");
    $('#roleform')[0].reset();
    //alert('Role Added successfully');
    $.wnoty({
    type: 'success',
    message: 'Role Added successfully',
    autohideDelay: 1000,
    position: 'top-right'
     });

    
    //  
    }else if(data.error){
        $("#roledata").after(data.error);
        $('#roledata').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#roledata").next().remove(); 
          $('#roleform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    }) 

    //add prefix
    $(document).on('click','#pre_btn',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_PrefixTitle");?>',
    data: $("#preform").serialize(),
    success:function(resp){
      var data =$.parseJSON(resp); 
      if(data.status == 'success' ){
     $('#prefixModal').modal('hide');
     $(".modal-backdrop").remove(); 
    
    var dep = $('#prefixtitle').val();
    $("#prefix").append("<option value="+data.prefix_success+">" + dep + "</option>");
    $('#preform')[0].reset();
    //alert('Prefix Added successfully');
     $.wnoty({
    type: 'success',
    message: 'Prefix Added successfully',
    autohideDelay: 1000,
    position: 'top-right'
     });
    
      }else if(data.error){
        $("#prefixtitle").after(data.error);
        $('#prefixtitle').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#prefixtitle").next().remove(); 
          $('#preform')[0].reset();
        
         },2000); 
    } 
 
    }
    });
    return false;
    })
    //personal 
    $(document).on('click','#add_nation',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Nationality");?>',
    data: $("#nationform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var pre = $('#nationality').val();
     var nationalityval = $('#nationalityval').val();
    $('#nationform')[0].reset();
    $('#nationalitymodel').modal('hide');
    $(".modal-backdrop").remove();
  
    $("#nationality").append("<option value="+data.national_success+">" + nationalityval + "</option>");
    $('#nationform')[0].reset();
    //alert('Department Added successfully');
    $.wnoty({
    // 'success', 'info', 'error', 'warning'
    type: 'success',
    message: 'Nationality Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
  
   }else if(data.error){
        $("#nationalityval").after(data.error);
        $('#nationalityval').next().css({'color':'red'});
        setTimeout(function(){ 
          $("#nationalityval").next().remove();
          $('#nationform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    })
    //salary type
     $(document).on('click','#add_salarytype',function(){
    event.preventDefault();
    $("#typeform").valid();
    var typename=$('#typename').val();
   
     if( typename !=''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("Payroll/Add_Sallary_Type");?>',
    data: new FormData($("#typeform")[0]),
    contentType: false,
    processData: false,
    success:function(resp){
    var data=$.parseJSON(resp);;
    if(data.status == 'success'){
    $('#SalaryTypemodel').modal('hide');
    $(".modal-backdrop").remove();//typeid
     var typename = $('#typename').val();
   $("#typeid").append("<option value="+data.data+">" + typename + "</option>");
    $('#typeform')[0].reset();
    $('#id').val('');
    $.wnoty({
    type: 'success',
    message: data.message,
    autohideDelay: 1000,
    position: 'top-right'

    });
 
   /*
   setTimeout(function(){
     location.reload(true);
    },3000);*/
    //  
    }
    },
    });
    }
    return false;
    })

    //add cityy state country
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
   // $("#country").append("<option value="+data.country_success+">" + country + "</option>");
    $("[name='country']").append("<option value="+data.country_success+">" + country + "</option>");
    $(".permanentcountry").append("<option value="+data.country_success+">" + country + "</option>");
    $(".presentcountry").append("<option value="+data.country_success+">" + country + "</option>");
    $("#countryid").append("<option value="+data.country_success+">" + country + "</option>");
    $('#countryform')[0].reset();
   
    $.wnoty({
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
 
    var state = $('#state_name').val();
   $("#state").append("<option value="+data.state_success+">" + state + "</option>");
   $(".permanentstate").append("<option value="+data.state_success+">" + state + "</option>");
   $(".presentstate").append("<option value="+data.state_success+">" + state + "</option>");
    $('#stateform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'State Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
  
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
    var city = $('#city_name').val();
    $("#city").append("<option value="+data.state_success+">" + city + "</option>");
    $(".permanentcity").append("<option value="+data.state_success+">" + city + "</option>");
    $(".presentcity").append("<option value="+data.state_success+">" + city + "</option>");
    $('#cityform')[0].reset();
    
    $.wnoty({
    type: 'success',
    message: 'City Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });

  /*  setTimeout(function(){
     location.reload(true);
    },3000);*/
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
     $("#permanentdistrict").append("<option value="+data.state_success+">" + district + "</option>");
     $("#presentdistrict").append("<option value="+data.state_success+">" + district + "</option>");
    $.wnoty({
    type: 'success',
    message: 'District Added successfully',
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
     //select matched state
    $(document).ready(function(){
    $("#permanentcountry").change(function(){
       
      var country = $("#permanentcountry").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#permanentstate").html(info.content);
             } 
        })
    });
 
    });  
    //select matched state
    $(document).ready(function(){
    $("#presentcountry").change(function(){
       
      var country = $("#presentcountry").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#presentstate").html(info.content);
             } 
        })
    });
 
    }); 
    //model 
    $(document).ready(function(){
    $("#countryid").change(function(){
       
      var country = $("#countryid").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_state");?>",
            data: { country : country },
             success:function(data){
                var info=$.parseJSON(data);
                $("#stateid").html(info.content);
             } 
        })
    });
 
    });
    //present 
/*    $(document).ready(function(){
   $("#presentstate").change(function(){
       
      var state = $("#presentstate").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $("#presentcity").html(info.content);
             } 
        })
    });

    });  
    $(document).ready(function(){
   $("#permanentstate").change(function(){
       
      var state = $("#permanentstate").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $("#permanentcity").html(info.content);
             } 
        })
    });
    });*/
    //presenrt district
        $(document).ready(function(){
   $("#presentstate").change(function(){
       
      var state = $(this).val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_district");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $("#presentdistrict").html(info.content);
             } 
        })
    });

    });  
    $(document).ready(function(){
   $("#permanentstate").change(function(){
       
      var state = $("#permanentstate").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_district");?>",
            data: { state : state },
             success:function(data){
                var info=$.parseJSON(data);
                $("#permanentdistrict").html(info.content);
             } 
        })
    });
    });
     $(document).ready(function(){
   $("#presentdistrict").change(function(){
       
      var district = $("#presentdistrict").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { district : district },
             success:function(data){
                var info=$.parseJSON(data);
                $("#presentcity").html(info.content);
             } 
        })
    });

    });  
    $(document).ready(function(){
   $("#permanentdistrict").change(function(){
       
      var district = $("#permanentdistrict").val();
       $.ajax({
            type: "POST",
            url: "<?php echo base_url("Settings/get_match_city");?>",
            data: { district : district },
             success:function(data){
                var info=$.parseJSON(data);
                $("#permanentcity").html(info.content);
             } 
        })
    });
    });
    //modal
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

 
    //add Education
    $(document).on('click','#edulevel_btn',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Education");?>',
    data: $("#edform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#edutypemodel').modal('hide');
    $(".modal-backdrop").remove();
    setTimeout(function(){
    var educlevel = $('#educationlevel').val();
    //$(".course").append("<option value="+data.dep_success+">" + educlevel + "</option>");
    $('[name="course"]').append("<option value="+data.dep_success+">" + educlevel + "</option>");
    //$('#educationmodal').find("#course1").append("<option value="+data.dep_success+">" + educlevel + "</option>");
    $('#edform')[0].reset();
    //alert('Role Added successfully');
    $.wnoty({
    type: 'success',
    message: 'Education Added successfully',
    autohideDelay: 2000,
    position: 'top-right'
     });

     },1000);
    //  
    }else if(data.error){
        $("#educationlevel").after(data.error);
        $('#educationlevel').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#educationlevel").next().remove(); 
          $('#edform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    }) 
    //add Course
    $(document).on('click','#course_btn',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/SaveCourse");?>',
    data: $("#courseform").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#coursemodel').modal('hide');
    $(".modal-backdrop").remove();
    setTimeout(function(){
    var courseName = $('#coursename').val();
    $("#course").append("<option value="+data.course_success+">" + courseName + "</option>");
    $('#courseform')[0].reset();
    //alert('Role Added successfully');
    $.wnoty({
    type: 'success',
    message: 'Course Added successfully',
    autohideDelay: 2000,
    position: 'top-right'
     });

     },1000);
    //  
    }else if(data.error){
        $("#courseName").after(data.error);
        $('#courseName').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#courseName").next().remove(); 
          $('#courseform')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    }) 
    //add govt id
    $(document).on('click','#add_govtid',function(){
    event.preventDefault();
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_govid");?>',
    data: $("#govtidmodal").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#govtModal').modal('hide');
    $(".modal-backdrop").remove();
 
    var govID_name = $('#govID_name').val();
    $("#gov_id").append("<option value="+data.success+">" + govID_name + "</option>");
    $('#govtidmodal')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Govt ID Added successfully',
    autohideDelay: 1000,
    position: 'top-right'

    });
    
    //  
    }else if(data.error){
        $("#govID_name").after(data.error);
        $('#govID_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#govID_name").next().remove();
          $('#govtidmodal')[0].reset();
        
         },2000); 
    } 
    },
    });
    return false;
    }) 
     //add Currency
    $(document).on('click','#add_currency',function(){
    event.preventDefault();
        $("#savecurrency").valid();
    var currency_name=$("#currency_name").val();
    var currency_symbol=$("#currency_symbol").val();
   if( currency_name!= '' && currency_symbol != ''){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Currency");?>',
    data: $("#savecurrency").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#currencyModal').modal('hide');
    $(".modal-backdrop").remove();
    setTimeout(function(){
    var currency_name = $('#currency_name').val();
     var currency_symbol=$("#currency_symbol").val();
    $("#currencytype").append("<option value="+data.success+">" +currency_symbol+' '+currency_name+  "</option>");
    $("#currency").append("<option value="+data.success+">" +currency_name+  "</option>");
    $('#savecurrency')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Currency Added successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
     },2000);
    //  
    }else if(data.error){
        $("#currency_name").after(data.error);
        $('#currency_name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#currency_name").next().remove();
          $('#savecurrency')[0].reset();
        
         },2000); 
    } 
    },
    });
   }
    return false;
    }) 
</script>