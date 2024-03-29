<?php 
class Notification_model extends CI_Model {
  
  public function get_notifications_count($user_id) {
    $this->db->where('user_id', $user_id);
    $this->db->where('status', 'unread');
    return $this->db->count_all_results('notifications');
  }

  public function get_notifications($user_id) {
    $this->db->where('user_id', $user_id);
    $this->db->where('status', 'unread');
    $this->db->order_by('created_at', 'desc');
    return $this->db->get('notifications')->result();
  }

  public function mark_notification_as_read($notification_id) {
    $this->db->where('id', $notification_id);
    $this->db->update('notifications', array('status' => 'read'));
  }
}
 ?>
