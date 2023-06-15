<?php
class Couse_recommendation_model extends CI_Model
{
    function get_all_courses(){
        $this->db->select('course_id');
        $result=$this->db->get('course');
        return $result->result();
    }
    function get_all_users(){
        $this->db->select('user_id');
        $result=$this->db->get('Users');
        return $result->result();
    }
    function get_user_single_course_rating($user_id,$course_id){
        $this->db->select('*');
        $this->db->from('comment');
        $this->db->where('user_id',$user_id);
        $this->db->where('course_id',$course_id);
        $result=$this->db->get();
        return $result->row();
    }
    function get_user_all_course_ratings($user_id){
        $this->db->select('user_id,course_id,rate');
        $this->db->from('comment');
        $this->db->where('user_id',$user_id);
        $result=$this->db->get();
        return $result->result();
    }
    function get_user_favourite_courses($user_id){
        $this->db->select('course_id,rate');
        $this->db->from('comment');
        $this->db->where('user_id',$user_id);
        $this->db->order_by("rate", "desc");
        $this->db->limit(3);
        $result=$this->db->get();
        return $result->result();
    }
    function get_courses($course_list){
        $this->db->select('*');
        $this->db->from('course');
        if(!empty($course_list)){
            $this->db->where_in('course_id', $course_list);
            $result=$this->db->get();
            return $result->result();
        }else{
            return NULL;
        }
        
    }

}

?>
