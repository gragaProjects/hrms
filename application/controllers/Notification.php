<?php
class Notification extends CI_Controller {

  public function get_notifications_count() {
    $user_id = $this->session->userdata('user_login_id');
    //$user_id = 1;
    $this->load->model('notification_model');
    $count = $this->notification_model->get_notifications_count($user_id);
    echo $count;
  }

  public function get_notifications() {
    $user_id = $this->session->userdata('user_login_id');
    //$user_id = 1;
    $this->load->model('notification_model');
    $notifications = $this->notification_model->get_notifications($user_id);
    
    foreach ($notifications as $notification) {
   // href="'.$this->notification_model->mark_notification_as_read($notification->id).'"
      echo ' <a class="unreadtext" data-notification-id = "'.$notification->id.'">
                  <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                  <div class="mail-contnet ' . $notification->status . '>
                      <span class="mail-desc">' . $notification->message . '</span> <span class="time"></span> </div>
                                            </a>';
    }
  }

      public function mark_notification_as_read() {
        $this->load->model('notification_model');
        $notification_id = $this->input->post('notification_id');
        //$table = $this->input->post('table');
        // Mark the notification as read
        $this->notification_model->mark_notification_as_read($notification_id);//, $table

        // Return success response
        $response['status'] = 'success';
        echo json_encode($response);
    }
}

 ?>