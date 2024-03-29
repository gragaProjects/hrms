<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Organisation Settings</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Organisation Settings</li> -->
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
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Organisation Info  </h4>
                    </div>
                    <div class="card-body">
                        <div class="table_body">
                            <form  id="organisationform"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="form-group clearfix m-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="title" >Organisation Name</label> <span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="organisation"  <?php if(isset($organisationvalue->organisation)){ ?>value="<?php echo $organisationvalue->organisation; ?>" <?php }?>  id="organisation" placeholder=""   maxlength="120" style="text-transform: capitalize;" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="title" >Email</label> <span class="error"> *</span>
                                            <input type="email" class="form-control validate" name="email"  <?php if(isset($organisationvalue->email)){ ?>value="<?php echo $organisationvalue->email; ?>" <?php }?>  id="email" placeholder="" required >
                                        </div>
                                        <div class="col-md-3">
                                            <label for="description" >Business Domain</label> <span class="error"> *</span>
                                            <input type="text"class="form-control validate" id="domain"  name="domain" value="<?php if(isset($organisationvalue->domain)){ ?><?php echo $organisationvalue->domain; ?> <?php }?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="website" >Website</label> <span class="error"> *</span>
                                            <input type="text" class="form-control validate" name="website" <?php if(isset($organisationvalue->website)){ ?>  value="<?php echo $organisationvalue->website; ?>" <?php }?> id="website" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix m-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="contact" class="">Started On</label><span class="error"> *</span>
                                            
                                            <input type="date" class="form-control" name="startedon" <?php
                                            if(isset($organisationvalue->startedon)) {
                                            $newdate = date("Y-m-d", strtotime($organisationvalue->startedon));
                                            }
                                            
                                            if(isset($newdate)){ ?> value="<?php echo $newdate ?>" <?php }?>  id="startedon" placeholder="" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="number" class="">Fax </label>
                                            <input type="text" class="form-control"
                                            <?php if(isset($organisationvalue->fax)){ ?> value="<?php echo $organisationvalue->fax; ?>" <?php }?> id="fax" name="fax"  placeholder="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="number" class="">Po Box</label>
                                            <input type="text" class="form-control"
                                            <?php if(isset($organisationvalue->pobox)){ ?> value="<?php echo $organisationvalue->pobox; ?>" <?php }?> id="pobox" name="pobox" maxlength="15" placeholder="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="number" class="">Primary No</label><span class="error"> *</span>
                                            <input type="number" class="form-control"
                                            <?php if(isset($organisationvalue->primarynum)){ ?> value="<?php echo $organisationvalue->primarynum; ?>" <?php }?> id="primarynum" name="primarynum" maxlength="15" placeholder="" required>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix m-3">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <label for="" class="">Secondary No</label>
                                            <input type="number" class="form-control" id="secondarynum" name="secondarynum"  <?php if(isset($organisationvalue->secondarynum)){ ?>   value="<?php echo $organisationvalue->secondarynum; ?>" <?php }?> placeholder="" >
                                        </div>
                                        <div class="col-md-3">
                                            <label for="currency" >Currency</label>
                                            <input type="text" class="form-control" name="currency" value="<?php if(isset($organisationvalue->currency)){ echo $organisationvalue->currency;} ?>"  id="currency">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="currency">Symbol</label>
                                            <input type="text" class="form-control" name="symbol" value="<?php if(isset($organisationvalue->symbol)){ echo $organisationvalue->symbol;} ?>"  id="symbol" >
                                        </div>
                                        <div class="col-md-3">
                                            <label for="description" >Address</label>
                                            <!-- <span class="error"> *</span> -->
                                    <textarea class="form-control validate" id="address"  name="address" rows="1" required ><?php if(isset($organisationvalue->address)){ ?><?php echo $organisationvalue->address;?><?php }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group clearfix m-3">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <label class="">Country</label> <span class="error"> *</span>
                                            <select name="country" id="country" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                                <option value="">Select Country</option>
                                                <?php if(isset($organisationvalue->state)){?>
                                                <?Php foreach($countryvalue as $cvalue): ?>
                                                <option value="<?php if($cvalue->id){ echo $cvalue->id; } ?>"
                                                <?php if($organisationvalue->country== $cvalue->id){echo 'selected';}?> ><?php echo $cvalue->country_name ?></option>
                                                
                                                <?php endforeach; }else{ ?>
                                                <?Php foreach($countryvalue as $cvalue): ?>
                                                <option value="<?php if($cvalue->id){ echo $cvalue->id; } ?>"
                                                ><?php echo $cvalue->country_name; ?></option>
                                                <?php  endforeach; } ?>
                                            </select>
                                            <label id="country-error" class="error" for="country" style="display: none;">This field is required.</label>
                                            <a href="" data-target="#countrymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtn">Add Country</a>
                                        </div>
                                        <div class="col-md-3 ">
                                            
                                            <label class="">State</label> <span class="error"> *</span>
                                            <div class="input-group">
                                                <select name="state" id="state" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                                    
                                                    <?php if(isset($organisationvalue->state)){?>
                                                    <option value="<?php if($organisationvalue->state){ echo $organisationvalue->state;} ?>"> <?php
                                                        $id = $organisationvalue->state;//){$organisationvalue->state;}
                                                        $data = $this->settings_model->matchstate($id); echo $data->state_name;
                                                    ?></option>
                                                    <?php }?>
                                                </select>
                                                <span class="input-group-addon"> <!-- <img id="loader" style="display:none" src="<?php echo base_url();?>assets/loader.gif" /> -->   <i class="fa fa-refresh stateloader"></i></span>
                                            </div>
                                            
                                            <label id="state-error" class="error" for="state" style="display: none;">This field is required.</label>
                                            <a href="" data-target="#statemodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtn">Add State</a>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="">District</label> <span class="error"> *</span>
                                            <div class="input-group">
                                                <select name="district" id="district" value="" class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
                                                    
                                                    <?php if(isset($organisationvalue->district)){?>
                                                    <option value="<?php if($organisationvalue->district){ echo $organisationvalue->district;} ?>"> <?php
                                                        $id = $organisationvalue->district;//){$organisationvalue->state;}
                                                        $data = $this->settings_model->matchdistrict($id); echo $data->district_name;
                                                    ?></option>
                                                    <?php }?>
                                                </select>
                                                <span class="input-group-addon"> <i class="fa fa-refresh districtloader"></i></span>
                                            </div>
                                            <label id="district-error" class="error" for="district" style="display: none;">This field is required.</label>
                                            <a href="" data-target="#districtmodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtn">Add District</a>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="">City</label><span class="error"> *</span>
                                            <div class="input-group">
                                                <select name="city" id="city" value="" class="form-control custom-select search validation city" style="width: 100%; min-height: 38px;" required>
                                                    <!--  <option value="">Select City</option> -->
                                                    <?php if(isset($organisationvalue->city)){?>
                                                    <option value="<?php if($organisationvalue->city){ echo $organisationvalue->city;} ?>"> <?php
                                                        $id = $organisationvalue->city;
                                                    $data = $this->settings_model->matchcity($id); echo $data->city_name; ?></option>
                                                    <?php }?>
                                                    
                                                </select>
                                                <span class="input-group-addon"> <i class="fa fa-refresh cityloader"></i></span>
                                            </div>
                                            <label id="city-error" class="error" for="city" style="display: none;">This field is required.</label>
                                            <a href="" data-target="#citymodel" data-toggle="modal" data-whatever="@getbootstrap"  class="float-right modalbtns">Add City</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix m-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="" class="">Zip Code</label>
                                            <input type="number" class="form-control" id="zipcode" name="zipcode"  <?php if(isset($organisationvalue->zipcode)){ ?>   value="<?php echo $organisationvalue->zipcode; ?>" <?php }?> placeholder="" >
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label >Email Settings</label><br>
                                            <input name="smtp" type="radio" id="radio_1" value="Yes" <?php if(isset($organisationvalue->smtp )){ if($organisationvalue->smtp == "Yes"){echo 'checked';}}?>/>
                                            <label for="radio_1">SMTP</label>
                                            <input name="smtp" type="radio" id="radio_2"  value="No" <?php  if(isset($organisationvalue->smtp )){  if($organisationvalue->smtp == "No"){echo 'checked';}}?>/>
                                            <label for="radio_2">Mail Function</label>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="file_prev inb">
                                        <?php if(isset($organisationvalue->logo)){ ?>
                                        <img src="<?php echo base_url(); ?>assets/uploads/logo/<?php  if(isset($organisationvalue->logo)){ echo $organisationvalue->logo; } ?>" height="" width="100">
                                        <?php } else { ?>
                                        <!-- <img src="<?php echo base_url(); ?>assets/img/ci-logo.png" height="100" width="167"> -->
                                        <?php } ?>
                                    </div>
                                    <label>Logo</label><span class="error"> *</span><br>
                                    <input type="file" name="logo"  id="logo" <?php if(isset($organisationvalue->logo)){ ?>  value="<?php echo base_url() ?>assets/uploads/logo/<?php if(isset($organisationvalue->logo)){ echo $organisationvalue->logo;} ?>"  <?php }?> class=""
                                    accept="image/png,  image/jpeg" >
                                </div>
                                 <?php if($this->role->User_Permission('organisation_info','can_edit') || $this->role->User_Permission('organisation_info','can_add') ){?>
                                <div class="form-group clearfix">
                                    <div class="col-md-9 col-md-offset-3">
                                        <input type="hidden" name="id"  <?php if(isset($organisationvalue->id)){ ?>  value="<?php if(isset($organisationvalue->id)){echo $organisationvalue->id; }?>"
                                        <?php }else{?> value='' <?php }?> />
                                        <button type="submit" name="add_organisation" id="add_organisation" class="btn btn-info">Submit</button>
                                        <a type="button" class="btn btn-info text-white ecancel" href="<?php echo base_url(); ?>">Cancel</a>
                                        
                                    </div>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="countrymodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Country</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" id="countryform" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label class="control-label">Country Name</label>
                                <input type="text" name="country_name" id="country_name" value="" class="form-control" placeholder="" minlength="3" >
                            </div>
                            <div class="fielderror"> </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="add_country">Save</button>
                            <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="statemodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add State</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" id="stateform" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label class="">Country</label>
                                <select name="country" id="country" value="" class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                    <option>Select Country</option>
                                    <?Php foreach($countryvalue as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">State Name</label>
                                <input type="text" name="state_name" id="state_name" value="" class="form-control" placeholder="" minlength="3" >
                            </div>
                            <div class="fielderror"> </div>
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" id="add_state">Save</button>
                            <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="districtmodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add District</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" id="districtform" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label class="">Country</label>
                                <select name="country" id="districtmodel_country"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                    <option value="">Select Country</option>
                                    <?Php foreach($countryvalue as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">State Name</label>
                                <select name="state" id="districtmodel_state" value="" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                    <option value="">Select State</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">District Name</label>
                                <input type="text" name="district_name" id="district_name" value="" class="form-control" placeholder="" minlength="3" >
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" id="add_district">Save</button>
                            <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="citymodel" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add City</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form method="post" id="cityform" enctype="multipart/form-data">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label class="">Country</label>
                                <select name="country" id="citymodel_country"  class="form-control custom-select search country" style="width: 100%; min-height: 38px;" required>
                                    <option value="">Select Country</option>
                                    <?Php foreach($countryvalue as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->country_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">State Name</label>
                                <select name="state" id="citymodel_state" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                    <option value="">Select State</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">District Name</label>
                                <select name="district" id="citymodel_district" class="form-control custom-select search state" style="width: 100%; min-height: 38px;" required>
                                    <option value="">Select District</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">City Name</label>
                                <input type="text" name="city_name" id="city_name"  class="form-control" placeholder="" minlength="3" >
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" id="add_city">Save</button>
                            <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('backend/footer'); ?>
        <!-- permisson -->

        <?php if(!$this->role->User_Permission('organisation_info','can_edit') || !$this->role->User_Permission('organisation_info','can_add') ){?>
        <script type="text/javascript">
            $('input').prop('readonly', true);
            $('textarea').prop('readonly', true);
            $('select').prop('disabled', true);
            $('#logo').prop('disabled', true);
            $('[name="smtp"]').prop('disabled', true);
            $('[name="smtp"]:checked').prop('disabled', false);
            $('.modalbtn').hide();
        </script>
        <?php } ?>
        <!-- permisson -->
        <script type="text/javascript">
        $(".search").select2({
        theme:"bootstrap"
        });
        //add organisation
        $(document).on('click','#add_organisation',function(){
        event.preventDefault();
        $("#organisationform").valid();
        if($('#organisation').val() != '' && $('#email').val() != '' && $('#domain').val() != '' && $('#website').val()  != '' && $('#startedon').val()  != '' && $('#primarynum').val()  != '' && $('#address').val() != '' && $('#country').val()  != '' && $('#state').val()  != '' && $('#city').val()  != '' && $('#district').val()  != '' && $('#holidaystructureid').val()  != '' && $('#leavestructureid').val()  != '' ){
        var email = $('#email').val();
        var url = $('#website').val();
        if(IsEmail(email)==false){
        // alert('Enter Valid Email Address');
        $('[name="email"]').next().text('Please enter a valid email address');
        return false;
        }
        /*   if(is_valid_url(url)==false){
        $('#website').next().text('Please enter a valid URL.');
        return false;
        }*/
        
        $.ajax({
        type:'post',
        url: '<?php echo base_url("settings/Update_organisation");?>',
        data: new FormData($("#organisationform")[0]),
        contentType: false,
        processData: false,
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        ///var dep = $('#department').val();
        //$('#organisationform')[0].reset();
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
        },
        });
        }
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
        $("[name='country']").append("<option value="+data.country_success+">" + country + "</option>");
        $('#countryform')[0].reset();
        //alert('Department Added successfully');
        $.wnoty({
        // 'success', 'info', 'error', 'warning'
        type: 'success',
        message: 'Country Added Successfully',
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
        $("#state_name").append("<option value="+data.state_success+">" + state + "</option>");
        $("#stateid").append("<option value="+data.state_success+">" + state + "</option>");
        $('#stateform')[0].reset();
        
        $.wnoty({
        type: 'success',
        message: 'State Added Successfully',
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
        //$("#loader").show();
        $(".stateloader").addClass('fa-spin');
        var country = $("#country").val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/get_match_state");?>",
        data: { country : country },
        success:function(data){
        var info=$.parseJSON(data);
        $("#state").html(info.content);
        //$("#loader").hide();
        $(".stateloader").removeClass('fa-spin');
        }
        })
        });
        
        });
        //select matched state modal
        $(document).ready(function(){
        $("#districtmodel_country").change(function(){
        
        var country = $(this).val();
        //console.log(country);
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
        // console.log(country);
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
        $(".districtloader").addClass('fa-spin');
        var state = $("#state").val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/get_match_district");?>",
        data: { state : state },
        success:function(data){
        var info=$.parseJSON(data);
        $("#district").html(info.content);
        $(".districtloader").removeClass('fa-spin');
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
        $(".cityloader").addClass('fa-spin');
        var district = $("#district").val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/get_match_city");?>",
        data: { district : district },
        success:function(data){
        var info=$.parseJSON(data);
        $("#city").html(info.content);
        $(".cityloader").removeClass('fa-spin');
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
        //select matched city
        /*$(document).ready(function(){
        $("#state").change(function(){
        
        var state = $("#state").val();
        $.ajax({
        type: "POST",
        url: "<?php echo base_url("Settings/get_match_city");?>",
        data: { state : state },
        success:function(data){
        var info=$.parseJSON(data);
        $("#city").html(info.content);
        }
        })
        });
        });*/
        </script>