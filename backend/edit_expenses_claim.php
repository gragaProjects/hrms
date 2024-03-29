<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
   <link href="<?php echo base_url(); ?>assets/css/fileupload.css" id="theme" rel="stylesheet">
<style type="text/css">
table {border-spacing: 8px 2px;}
td    {padding: 6px;width: ;}

@media (max-width: 768px) {
  table {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  tbody,
  tr,
  td {
    display: block;
    width: 100%;
  }
  td:first-child {
    padding-top: 10px;
  }
  td:last-child {
    padding-bottom: 10px;
  }
}

 td:first-child,td:last-child,td:nth-child(3)  {
  width: 12%;
  }   


</style>


      <div class="page-wrapper">
            <div class="message"></div>
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"> Expense Claim</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"> Update Expense Claim</li> -->
                    </ol>
                </div>
            </div>
           <?php echo validation_errors(); ?>
         <?php   
		         $id = $expenses->emp_id;
		          $basicinfo = $this->employee_model->GetBasic($id);  ?>
          
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                  <h4 class="m-b-0 text-white">&nbsp;&nbsp;Update Expense Claim  </h4>
                            </div>
                            <div class="card-body">
                                <div class="table_body"><!-- action="<?php echo base_url("Expenses/Save_Expenses");?>"  -->
								<form  id="expensesform" name="expensesform"   method="post" enctype="multipart/form-data" >
									
									<div class="form-group clearfix m-3">
										<div class="row">
											<div class="col-md-4">
												<label for="title" class="">Name</label><span class="error"> </span>
												<!-- <input type="text" class="form-control validation" name="name"  id="name" placeholder=""   value="<?php echo $expenses->first_name;  ?>"  maxlength="120" style="text-transform: capitalize;" value="WAF1108" > -->

												<select class=" form-control custom-select selectedEmployeeID"  tabindex="1" name="emid" id="emid" required >
                                             <option value="<?php echo $basicinfo->em_id ?>" selected><?php echo $basicinfo->first_name.' '.$basicinfo->last_name?></option>
                                       
                                            </select>
												
											</div>

												<div class="col-md-4">
												<label for="description" class="">Comments</label>
								<textarea class="form-control " id="comments"  name="comments" rows="2" required  maxlength="200" ><?php echo $expenses->comments;?></textarea>
											</div>
											
											<!-- <div class="col-md-3">
												<label for="contact" class="">Expense Date</label><span class="error"> *</span>
												<input type="date" class="form-control validation" name="expense_date" 
												 value="<?php echo ($expenses->expense_date) ? date('Y-m-d', strtotime($expenses->expense_date)) : ''  ?>"  id="expense_date" placeholder="" required >
												
											</div>
											<div class="col-md-3">
												<label for="contact" class="">Submitted Date</label><span class="error"> *</span>
												<input type="date" class="form-control validation" name="submited_date"   value="<?php echo ($expenses->submited_date) ? date('Y-m-d', strtotime($expenses->submited_date)) : '';  ?>"  id="submited_date" placeholder="" required >
												
											</div>
											<div class="col-md-3">
												<label for="contact" class="">Approved Date</label><span class="error">* </span>
												<input type="date" class="form-control validation" name="approved_date"  value="<?php echo ($expenses->approved_date) ? date('Y-m-d', strtotime($expenses->approved_date)) : '';  ?>" id="approved_date" placeholder=""  >
												
											</div> -->
											
										</div>
										
									</div>
									
									
									
									<div class="form-group clearfix m-3">
										<div class="row">
											
											<!-- <div class="col-md-6">
												<label for="description" >Description</label><span class="error"> *</span>
												<textarea class="form-control " id="description"  name="description" rows="2"   maxlength="200" required > <?php echo $expenses->description;  ?></textarea>
											</div> -->
											<!-- <div class="col-md-6">
												<label for="description" class="">Comments</label>
												<textarea class="form-control " id="comments"  name="comments" rows="2" required  maxlength="200" >
												<?php echo $expenses->comments;?>
												</textarea>
											</div> -->
										</div>
									</div>
									
									
									<h4 class="card-title m-3">Expense Details</h4>
									
									<div class="form-group clearfix m-3">

										<table style="width:100%" class="table" >
												<tbody id="education_fields">
													<?php   if($expense_data){  //print_r($expense_data);
										 foreach($expense_data as $value){ ?>
													<tr>
													<td>
														<div class=" nopadding">
															<div class="form-group">
																<label for="contact" class="">Expense Category</label>
																<select class="form-control search" id="expense_category" name="expense_category[]" >
																	
																	
																	<?php   foreach($expenseselect as $val){ ?>
																	<option value="<?= $val->category?>" <?php echo ($value->expense_category == $val->category) ? 'selected': ''?>><?= $val->category?></option>
																	<?php } ?>
																	
																</select>
																	<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#expensesModal">Add Category </a><!-- expensesModal -->
															</div>
														</div>
													</td>
													<td>
														<div class="form-group">
															<label for="contact" class="">Expense Date</label><span class="error"> </span>
															<input type="date" class="form-control validation" name="expense_date[]"  value="<?php echo ($value->expense_date) ? date('Y-m-d', strtotime($value->expense_date)) : '';  ?>"  id="expense_date" placeholder="" >
															
														</div>
													</td>
													<td>
														<div class="form-group ">
															<!-- <label for="contact" class="">Receipt Available</label><span class="error"> </span><br>
															<input  type="radio" id="radio_1" name="receipt[]" class="with-gap radio-col-light-blue" value="1" >
															<label for="radio_1">Yes</label>
															<input  type="radio" id="radio1_1" name="receipt[]" class="with-gap radio-col-grey" value="0" >
															<label for="radio1_1">No</label>
															 -->
															 <label for="contact" class="">Receipt Available</label>
																<select class="form-control search receipt" id="receipt" name="receipt[]" >
																	
																	
																	
																	<option value="1" <?php echo ($value->receipt == 1) ? 'selected': ''?>>Yes</option>
																	<option value="0" <?php echo ($value->receipt == 0) ? 'selected': ''?>>No</option>
																	
																	
																</select>
														</div>
													</td>
													<td>
														<div class=" nopadding">
															<div class="form-group">
																<label for="contact" class="">Particulars</label>
																<input type="text" class="form-control" id="details" name="details[]" value="<?php echo $value->details ?>" placeholder="Details" >
															</div>
														</div>
													</td>
													<td>
														
														<div class=" nopadding">
															<div class="form-group">
																<label class="control-label"> Currency</label><span class="error">  </span>
																<select name="currency[]" id="currency"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" >
																	
																	<?Php
																					
																	foreach($currency as $valuecurrency): ?>
																	<option value="<?php echo $valuecurrency->id ?>"  <?php echo ($valuecurrency->id == $value->currency) ? 'selected': ''?>>
																	<?php echo $valuecurrency->currency_symbol.' <br><br>'.$valuecurrency->currency_name; ?></option>
																	
																	<?php endforeach; ?>
																</select>
																<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#currencyModal">Add New Currency </a><!-- expensesModal -->
															</div>
														</div>
													</td>
													<td style="width: 12%;">
														<div class=" nopadding">
															<div class="form-group">
																<label for="contact" class=""> Amount</label>
																<input type="number" class="form-control amount" id="amount" name="amount[]" value="<?php echo $value->amount ?>"  placeholder="Amount" ><!-- onkeyup="calculate1(); " -->
															</div>
														</div>
													</td>
											<?php if($value->file_name){ ?>

													<td style="width: ;">
														<div class="form-group">
																<div class="input-group" style="margin-top: 25px;">

																		<label for="file-input1" class="files"  style="display: block ;"><i class="fa fa-upload btn btn-info"></i>
																		 
																		  <a href="<?php echo base_url(); ?>assets/uploads/temp/<?php echo $value->file_name; ?>" target="_blank" class="btn  btn-info  waves-effect waves-light " title="<?php echo $value->file_name; ?>"><i class="fa fa-file-o"></i></a>

																		 
																		
															</div>
														</div>

													</td>
													<?php } ?>
												</tr>
												<?php } }else{ ?>
																<tr>
													<td>
														<div class=" nopadding">
															<div class="form-group">
																<label for="contact" class="">Expense Category</label>
																<select class="form-control search" id="expense_category" name="expense_category[]">
																	
																	
																	<?php   foreach($expenseselect as $value){ ?>
																	<option value="<?= $value->category?>"><?= $value->category?></option>
																	<?php } ?>
																	
																</select>
																	<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#expensesModal">Add Category </a><!-- expensesModal -->
															</div>
														</div>
													</td>
													<td>
														<div class="form-group">
															<label for="contact" class="">Expense Date</label><span class="error"> </span>
															<input type="date" class="form-control validation" name="expense_date[]"  value=""  id="expense_date" placeholder="" required>
															
														</div>
													</td>
													<td>
														<div class="form-group ">
															<!-- <label for="contact" class="">Receipt Available</label><span class="error"> </span><br>
															<input  type="radio" id="radio_1" name="receipt[]" class="with-gap radio-col-light-blue" value="1" >
															<label for="radio_1">Yes</label>
															<input  type="radio" id="radio1_1" name="receipt[]" class="with-gap radio-col-grey" value="0" >
															<label for="radio1_1">No</label>
															 -->
															 <label for="contact" class="">Receipt Available</label>
																<select class="form-control search receipt" id="receipt" name="receipt[]">
																	
																	
																	
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																	
																	
																</select>
														</div>
													</td>
													<td>
														<div class=" nopadding">
															<div class="form-group">
																<label for="contact" class="">Particulars</label>
																<input type="text" class="form-control" id="details" name="details[]" value="" placeholder="Details">
															</div>
														</div>
													</td>
													<td>
														
														<div class=" nopadding">
															<div class="form-group">
																<label class="control-label"> Currency</label><span class="error">  </span>
																<select name="currency[]" id="currency"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>
																	
																	<?Php
																					
																	foreach($currency as $value): ?>
																	<option value="<?php echo $value->id ?>" >
																	<?php echo $value->currency_name; ?></option>
																	
																	<?php endforeach; ?>
																</select>
																<a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#currencyModal">Add New Currency </a>
															</div>
														</div>
													</td>
													<td>
														<div class=" nopadding">
															<div class="form-group">
																<label for="contact" class=""> Amount</label>
																<input type="number" class="form-control amount" id="amount" name="amount[]" value=""  placeholder="Amount" ><!-- onkeyup="calculate1(); " -->
															</div>
														</div>
													</td>
													<td>
														
														
														<div class=" nopadding">
															<div class="form-group">
																<div class="input-group" style="margin-top: 30px;">
																	<label for="contact" class=""> </label>
																	<div class="input-group-append">
																		<button class="btn btn-success" type="button" onclick="education_fields();"><i class="fa fa-plus"></i></button>


																		<div id="file-count"></div>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
																<div class="input-group" style="margin-top: 30px;">

																		<label for="file-input1" class="files"  style="display: block ;"><i class="fa fa-upload btn btn-info"></i></label><input type="file" id="file-input1" name="files[]" style="display:none;" >
															</div>
														</div>
													</td>
													
												</tr>
												<?php }  ?>

												</tbody>
												
											</table>
										

										<div id="education_fields"></div>
										<table style="width:100%">
										 	<tbody>
										 		<tr>
										 		
												  <td colspan="8" style="width: 60%;"></td>
												  
												 <td style="width: 30%;text-align: ;" colspan="4">
												  	<label for="contact" class="">Total Amount :</label> 

														<input type="text" class="form-control validation  total_amount" name="total_amount" id="total_amount" placeholder="" style="font-weight: 500;color: black;font-size: medium;width: 65%;/* text-align: left; */" readonly="" value="<?php echo $expenses->total_amount;?>">
												  </td>
												  
												

										 		</tr>
										 	</tbody>
										 </table>
											<!--  <table style="width:100%">
										 	<tbody>
										 		<tr>
										 		
												  <td colspan="8" style="width: 40%;"></td>
												  
												 <td style="width: 50%;text-align: center;" colspan="4">
												  	<label for="contact" class="">Total Amount :</label> 

														<input type="text" class="form-control validation  total_amount" name="total_amount" id="total_amount" placeholder="" style="font-weight: 500;color: black;font-size: medium;width: 30%;text-align: left;" readonly="">
												  </td>
												  
												

										 		</tr>
										 	</tbody>
										 </table> -->
									<!-- 	<div class="col-md-10">
											<div class="">
												<div class="form-group text-right">
													<div class="">
														<label for="contact" class="">Total Amount</label>
														<input type="text" class="form-control validation col-md-3 total_amount text-right" name="total_amount"  value="<?php echo !empty($expenses->total_amount) ? $expenses->total_amount : 0; ?>" style="font-weight: 500;color: black;font-size: medium;"  id="total_amount"  readonly >
													</div>
												</div>
												
											</div>
										</div> -->
								
									

									</div>

									<div class="form-group clearfix  ml-5">

										
									</div>	

									<div class="form-group clearfix  m-3">
										<div class="col-md-9 col-md-offset-3">
											<input type="hidden" name="id" value="<?= $this->input->get("I"); ?>" 
											/>
											<button type="submit" name="save_claim" id="save_claim" class="btn btn-info ">Update</button>
											<a href="<?php echo base_url()?>Expenses/ViewExpences" class="btn btn-info">Back</a>
											
										</div>
									</div>
									
								</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Category modal -->
                 <div id="expensesModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Add Expenses Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="savecategory">
                                            <div class="form-group">
                                                 <label class="control-label">Currency Name</label><span class="error"> *</span>
                                                        <input type="text" name="name" id="name" value="" class="form-control" placeholder="" minlength="3" required><br>
                                                       
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" id="add_category">Save</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                
    <?php $this->load->view('backend/footer'); ?>
  
    <script type="text/javascript">


    	 //add fields
    var room = 1;

	function education_fields() {

	    room++;
	    var objTo = document.getElementById('education_fields')
	    var divtest = document.createElement("tr");
	     divtest.setAttribute("class", "form-group removeclass" + room);
	    var rdiv = 'removeclass' + room;
	    divtest.innerHTML = '<td> <div class=" nopadding"> <div class="form-group"> <label for="contact" class="">Expense Category</label> <select class="form-control search" id="expense_category" name="expense_category[]">  <?php   foreach($expenseselect as $value){ ?> <option value="<?= $value->category?>"><?= $value->category?></option> <?php } ?> </select> </div> </div> </td> <td> <div class="form-group"> <label for="contact" class="">Expense Date</label><span class="error"> </span> <input type="date" class="form-control validation" name="expense_date[]"  value=""  id="expense_date" placeholder="" required> </div> </td> <td> <div class="form-group "> <label for="contact" class="">Receipt Available</label> <select class="form-control search receipt	" id="receipt' + room + '" name="receipt[]">  <option value="1">Yes</option> <option value="0">No</option> </select>  </div> </td> <td> <div class=" nopadding"> <div class="form-group"> <label for="contact" class="">Particulars</label> <input type="text" class="form-control" id="details" name="details[]" value="" placeholder="Details"> </div> </div> </td> <td> <div class=" nopadding"> <div class="form-group"> <label class="control-label"> Currency</label><span class="error">  </span> <select name="currency[]" id="currency"  class="form-control custom-select search validate" style="width: 100%; min-height: 38px;" required>  <?Php foreach($currency as $value): ?> <option value="<?php echo $value->id ?>" > <?php echo $value->currency_symbol.' <br><br>'.$value->currency_name; ?></option> <?php endforeach; ?> </select> <a href="" style="float:right; font-size: 12px;" alt="default" data-toggle="modal" data-target="#currencyModal">Add New Currency </a> </div> </div> </td> <td> <div class=" nopadding"> <div class="form-group"> <label for="contact" class=""> Amount</label> <input type="number" class="form-control amount" id="amount" name="amount[]" value=""  placeholder="Amount"><!-- onkeyup="calculate1(); " --> </div> </div> </td> <td> <div class=" nopadding"> <div class="form-group"> <div class="input-group" style="margin-top: 30px;"> <label for="contact" class=""> </label> <div class="input-group-append"><button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button> <div id="file-count"></div> </div> </div> </div> </div> </td><td><div class="form-group"><div class="input-group" style="margin-top: 30px;"><label for="file-input' + room + '" style="display:  ;" class="files"> <i class="fa fa-upload btn btn-info"></i> </label></div> <input type="file" id="file-input' + room + '" name="files[]" style="display:none;" > </td>';



	    objTo.appendChild(divtest);
	      initializeSelect2();
	}

	function remove_education_fields(rid) {
	    $('.removeclass' + rid).remove();
	}

	function remove_education_fields(rid) {
	    $('.removeclass' + rid).remove();
	}

	//calculate

     $(document).on("keyup", '.amount',function () {
            allowtotal();
            });
     
      function allowtotal(){
        var sum = 0;

              $('.amount').each(function () {
                  sum += Number($(this).val());
              });

              //$('.totalallow').text(sum);
              $('#total_amount').val(sum.toFixed(2));
      }
     // allowtotal()



         $(".search").select2({
          theme:"bootstrap"
      });

    $('.custom-select').on('change',function(){
       //$('input:required').remove();
         $(this).removeClass('error');
         $(this).addClass('valid');
         $(this).next('.error').css({display:'none'}); 
    })

	

    $(document).ready(function () {


 
    $(document).on('click', '#save_claim', function(e) {
  
    e.preventDefault();
     $("#expensesform").valid();
    var id =$('[name="id"]').val();
   
    var approved_date=$("#approved_date").val();
    //var status = $('input[name="status"]:checked').val();
    // console.log(status);

    


   var formData = new FormData($("#expensesform")[0]);
     var files = $("#expensesform input[type='file']");
    
   $.ajax({
    type:'post',
    url: '<?php echo base_url("Expenses/Update_Expenses");?>',
    data:  formData,
     cache: false,
	 contentType: false,
	 processData: false, 
    success:function(resp){
    var data=$.parseJSON(resp);
    if(data.status == 'success'){
    //var dep = $('#department').val();
    $('#expensesform')[0].reset();
  
    $.wnoty({
    type: 'success',
    message: 'Expense Claim Status Updated',
    autohideDelay: 1000,
    position: 'top-right'

    });

     setTimeout(function(){
         window.location.href = '<?php echo base_url('Expenses/ViewExpences')?>';
        },2000);
       
  
   }
    },
    });
  
 
    return false;
    })
    })
   
     $(document).on('click','#add_category',function(){
    event.preventDefault();
        $("#savecategory").valid();
    var name=$("#name").val();
   
   if( name!= '' ){
    $.ajax({
    type:'post',
    url: '<?php echo base_url("organization/Save_Category");?>',
    data: $("#savecategory").serialize(),
    success:function(resp){
    var data=$.parseJSON(resp);
    //console.log (data);
    if(data.status == 'success'  ){
    $('#expensesModal').modal('hide');
    $(".modal-backdrop").remove();
 
    var name = $('#name').val();
     $('[name="expense_category[]"]').append("<option value="+name+">" +name+  "</option>");
    $('#savecategory')[0].reset();
    $.wnoty({
    type: 'success',
    message: 'Category Added successfully',
    autohideDelay: 5000,
    position: 'top-right'

    });
    
    //  
    }else if(data.error){
        $("#name").after(data.error);
        $('#name').next().css({'color':'red'});
        setTimeout(function(){ 
         //$('#depmodel').modal('hide');
         //$(".modal-backdrop").remove();
          $("#name").next().remove();
          $('#savecurrency')[0].reset();
        
         },2000); 
    } 
    },
    });
   }
    return false;
    }) 


jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
    
      filesArr.forEach(function (f, index) {

        if (!(f.type.match('image.*') || f.type == 'application/pdf' || f.type == 'application/vnd.ms-word' || f.type == 'application/vnd.ms-excel' || f.type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || f.type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {

               //var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div> <p>" + f.name + "</p> </div></div>";

              var fileType = f.type.split('/')[0];
              var thumbnailHtml = '';
              if (fileType === 'image') {
                html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div> <p>" + f.name + " </p> </div></div>";
              } else {
                thumbnailHtml = "<i class='fa fa-file-o'></i>";
                html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'>" + thumbnailHtml + "<div class='upload__img-close'></div> <p>" + f.name + "</p> </div></div>";
              }
              // var html = "<div class='upload__img-box'><div class='upload__img-thumbnail'>" + thumbnailHtml + "<div class='upload__img-close'></div></div><div class='upload__img-filename'>" + f.name + "</div></div>";


              //imgWrap.append(html);

              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

// $('body').on('click', ".upload__img-close, .upload__file-close", function (e) {
//   var file = $(this).parent().data("file");
//   console.log(file);
//   for (var i = 0; i < imgArray.length; i++) {
//     if (imgArray[i].name === file) {
//       imgArray.splice(i, 1);
//       break;
//     }
//   }
//   $(this).parent().parent().remove();
// });
  $('body').on('click', ".upload__img-close, .upload__file-close", function (e) {
  var file = $(this).parent().data("file");
  $(this).parent().parent().remove();
  $('.upload__inputfile').val('');

  // Remove file from imgArray only after image has been removed from DOM
  var i;
  for (i = 0; i < imgArray.length; i++) {
    if (imgArray[i].name === file) {
      break;
    }
  }
  if (i < imgArray.length) {
    imgArray.splice(i, 1);
  }
 });


}


    </script>
