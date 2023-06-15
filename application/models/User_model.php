<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $user_input = array(
            'username' => $username,
            'password' => $password 	//create session variable
        );
    
        $query = $this->db->get_where('Users',$user_input);
        
        $result=$query->row();
        return $result;
    }
    // public function check_email_verified($username, $password){
    //     $user_input = array(
    //         'username' => $username,
    //         'password' => $password 	//create session variable
    //     );
    
    //     $query = $this->db->get_where('Users',$user_input);
    //     $result=$query->row_array();

    // }
    function get_userId_by_username($username, $password){
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get_where('Users');
    }
    function get_user_details($user_id){
        
        $user_input = array(
            'user_id' => $user_id,
            	
        );
        $query = $this->db->get_where('Users',$user_input);
        $result=$query->row();
        return $result;
    }
    function insert_captcha($data){
        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);
    }
    function insert_pwd_reset($data){
        return $this->db->insert('reset_pwd', $data);
    }
    function update_profile($data){
        $this->db->where('user_id', $data['user_id']);
        if($this->db->get('Users'))
        {
            $this->db->set('study_level', $data['study_level']);
            $this->db->set('university', $data['university']);
            $this->db->set('major', $data['major']);
            $this->db->update('Users');
            return true;
        }else{
            return false;
        }
    }
    function check_token($token){
        $this->db->where('token', $token);
    
        if( $this->db->get('reset_pwd')){
            $result=$this->db->get('reset_pwd');
            return $result->row();
        }
        return NULL;
        
    }
    function delete_reset_record($token,$email){
        $this->db->where('token', $token);
        $this->db->where('email', $email);
        $this->db->delete('reset_pwd');
    }
    function update_password($email,$new_password){
        $this->db->where('email', $email);
        if( $this->db->get('Users')){
            $this->db->set('password', $new_password);
            $this->db->where('email', $email);
            $this->db->update('Users');
            return true;
        }else{
            return false;
        }
    }
}
?>
