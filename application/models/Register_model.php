<?php
class Register_model extends CI_Model
{
 function insert($data)
 {
    return $this->db->insert('Users', $data);
 }
 
 function verify_email($key)
 {
  $this->db->where('verification_key', $key);
  $this->db->where('is_email_verified', 0);
 
  if($this->db->get('Users'))
  {
   $this->db->set('is_email_verified', 1);
   $this->db->update('Users');
   return true;
  }else{
      return false;
  }
 }
}

?>
