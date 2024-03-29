<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-hourglass-1" aria-hidden="true"></i> Expense Claim </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Expense Claim</li> -->

                <?php 
                    /*hr*/
                    $eid = $this->session->userdata('user_login_id');
                    $get_hr_approve = $this->dashboard_model->Emplist_hr($eid);

                if( $this->role->User_Permission('expenses','can_view') &&  $this->role->User_Permission('expenses','can_add') &&  $this->role->User_Permission('expenses','can_edit') &&  $this->role->User_Permission('expenses','can_delete')){?>
                      <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>Expenses/ApplyExpences" class="text-white"><i class="" aria-hidden="true"></i> Add </a></button>
                     <?php }elseif($this->role->User_Permission('expenses','can_view')){ ?>
                 <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>Expenses/ApplyExpences" class="text-white"><i class="" aria-hidden="true"></i> Add </a></button>
                  <?php } ?>
               <!--  <?php if( $get_hr_approve ){ ?>
                 <button type="button" class="btn btn-info" ><i class="fa fa-plus"></i><a href="<?php echo base_url(); ?>Expenses/ApplyExpences" class="text-white"><i class="" aria-hidden="true"></i> Add </a></button>
                  <?php } ?> -->
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row m-b-10">
            <div class="col-12">
               
              
               
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                          <h4 class="m-b-0 text-white">&nbsp;&nbsp; Expense Claim List
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="table1" class="display nowrap table table-hover table-striped table-bordered loan123"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Employee</th>
                                      
                                        <th>Submitted Date</th>
                                        <th>Approved Date</th>
                                        <th>Total Amount </th>
                                        <th> Status </th>
                                        <?php if( $this->role->User_Permission('expenses','can_edit') &&  $this->role->User_Permission('expenses','can_add')){?>
                                          <th>Action </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                            
                                <tbody>

                                <?php  
                           

                                 if( $this->role->User_Permission('expenses','can_view') &&  $this->role->User_Permission('expenses','can_add') &&  $this->role->User_Permission('expenses','can_edit') &&  $this->role->User_Permission('expenses','can_delete') || $get_hr_approve){?>
                                    <?php $i = 1;
                                    foreach($expenseview as $value): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                                         
                                            <td><?php echo date('d  M Y',strtotime($value->submited_date))   ?></td>
                                            <td><?php if(($value->approved_date)) { echo date('d  M Y',strtotime($value->approved_date));}   ?></td>
                                        <td><?php echo $value->total_amount ?></td>
                                        <td>
                                            <?php 
                                            if($value->status == 'Pending') { $bgcolor = 'label label-warning'; }
                                            elseif($value->status == 'Accepted') { $bgcolor = 'label label-primary'; }
                                            elseif($value->status == 'Claimed') { $bgcolor = 'label label-success'; }
                                            elseif($value->status == 'Rejected') { $bgcolor = 'label label-danger'; }
                                            
                                                ?>
                                            <span class="<?php  echo $bgcolor ?> " ><?php  echo $value->status ?></span>

                                         </td>
                                 
                                        
                                        <td class="jsgrid-align-center">
                                            <?php if( $this->role->User_Permission('expenses','can_edit') &&  $this->role->User_Permission('expenses','can_add')){?>
                                             <a href="<?php echo base_url(); ?>Expenses/view?I=<?php echo $value->id; ?>" title="View" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                            
                                                    <a href="<?php echo base_url(); ?>Expenses/Edit?I=<?php echo $value->id; ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a> 
                                              <?php } 
                                               if( $get_hr_approve ) { ?>

                                                    <!-- <a href="<?php echo base_url(); ?>Expenses/Edit?I=<?php echo $value->id; ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a>   -->

                                                  <?php } ?>
                                           <?php if( $this->role->User_Permission('expenses','can_delete')){?>
                                             <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delete_list" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button>

                                              <?php } ?>
                                           
                                        </td>
                                       
                                        
                                    </tr>
                                    <?php $i++; endforeach;

                                     }elseif($this->role->User_Permission('expenses','can_view')){ 

                                        $id = $this->session->userdata('user_login_id');
                                       $expensesbyid = $this->expense_model->expense_modeldatabyid($id);
                                       $i = 1;

                                             foreach($expensesbyid as $value): ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                                            
                                            <td><?php echo date('d  M Y',strtotime($value->submited_date))   ?></td>
                                            <td><?php echo $value->total_amount ?></td>
                                            <td>
                                                <?php 
                                                if($value->status == 'Pending') { $bgcolor = 'label label-warning'; }
                                                elseif($value->status == 'Accepted') { $bgcolor = 'label label-primary'; }
                                                elseif($value->status == 'Claimed') { $bgcolor = 'label label-success'; }
                                                elseif($value->status == 'Rejected') { $bgcolor = 'label label-danger'; }
                                                
                                                    ?>
                                                <span class="<?php  echo $bgcolor ?> " ><?php  echo $value->status ?></span>

                                             </td>
                                     
                                            
                                            <td class="jsgrid-align-center">
                                                <?php if( $this->role->User_Permission('expenses','can_view') &&  $this->role->User_Permission('expenses','can_add') &&  $this->role->User_Permission('expenses','can_edit') &&  $this->role->User_Permission('expenses','can_delete')){?>
                                                <?php }elseif( $this->role->User_Permission('expenses','can_view')) { ?>
                                                  <a href="<?php echo base_url(); ?>Expenses/Edit?I=<?php echo $value->id; ?>" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-pencil-square-o"></i></a> 
                                                
                                                 <?php } ?>
                                               <?php if( $this->role->User_Permission('expenses','can_delete')){?>
                                                 <button title="Delete" class="btn btn-sm btn-info waves-effect waves-light delete_list" data-id="<?php echo $value->id; ?>"><i class="fa fa-trash-o"></i></button>

                                                  <?php } ?>
                                               
                                            </td>
                                           
                                            
                                        </tr>
                                    <?php $i++; endforeach; ?>

                                        


                                         <?php } ?>
                                </tbody>
                           
                            </table>
                        </div>
                    </div>
                    </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $this->load->view('backend/footer'); ?>
    <script>
    $(document).ready(function () {
    $('#example3').DataTable({
     
          "initComplete": function (settings, json) {  
            $("#example3").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    }); 
    $('#table1').DataTable({
     
          "initComplete": function (settings, json) {  
            $("#table1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
          },
     
    });
  });
     

     //delete
    $(document).on('click','.delete_list', function (e) {
    //var id = $(this).parents('tr').find('#id').val();
    var id = $(this).attr('data-id');
   $.confirm({
    title: 'Delete Warning!',
    content: 'Are you sure, you want to delete this expense?',
    boxWidth: '25%',
    useBootstrap: false,
    buttons: {
    delete: {
    text: 'Delete',
    btnClass: 'btn-primary',
    action: function(){
    $.ajax({
    type: 'post',
    url: '<?php echo base_url('Expenses/Expenses_delete') ?>',
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