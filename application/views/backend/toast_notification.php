<?php 
 if($this->session->userdata('notifications')){
if($this->role->User_Permission('dashboard','can_view') && $this->role->User_Permission('dashboard','can_add')&& $this->role->User_Permission('dashboard','can_edit')&& $this->role->User_Permission('dashboard','can_delete')){?>
         <?php if($this->dashboard_model->Pending_leave() > 0) { ?>
    <script type="text/javascript">

    $.wnoty({
    type: 'info',
      message: '<div>You have  <strong><?php echo $this->dashboard_model->Pending_leave(); ?>  </strong> Pending Approval</div>',
    autohideDelay: 5000,
    position: 'bottom-right'
    });
    setTimeout(function(){
   <?php  $this->session->unset_userdata('notifications'); ?>
    },6000);
    </script>
<?php } } } ?>

<?php //if ($this->role->User_Permission('dashboard','can_add') && $this->role->User_Permission('dashboard','can_view')) {
if($this->session->userdata('notifications')){

$eid = $this->session->userdata('user_login_id');
if($this->dashboard_model->GetPendingleave_hr($eid) > 0){
$get_hr_approve = $this->dashboard_model->Emplist_hr($eid);
if ($get_hr_approve) { ?>
         <?php if($this->dashboard_model->GetPendingleave_hr($eid) > 0) { ?>
    <script type="text/javascript">
    $.wnoty({
    type: 'info',
    message: '<div>You have  <strong><?php echo $this->dashboard_model->GetPendingleave_hr($eid); ?>  </strong> Pending Approval</div>',
    autohideDelay: 5000,
    position: 'bottom-right'
    });
    setTimeout(function(){
   <?php  $this->session->unset_userdata('notifications'); ?>
    },6000);
    </script>
<?php
}
}
}
}
?>

