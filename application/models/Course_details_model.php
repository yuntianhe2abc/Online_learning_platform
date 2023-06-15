<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Course_details_model extends CI_Model
{

    function get_course_by_id($course_id)
    {
        if($course_id == '')
        {
			// $this->db->select("*");
            // $this->db->from("course");
			// return $this->db->get();
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("course");
            $this->db->where('course_id', $course_id);
			$result=$this->db->get();
            return $result->row();
        }
    }
    function fecth_course_comments($course_id)
    {
        if($course_id == '')
        {
			// $this->db->select("*");
            // $this->db->from("course");
			// return $this->db->get();
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("comment");
            $this->db->where('course_id', $course_id);
            return $this->db->get();
        }
    }
    function get_course_rate_statistics($course_id){
        if($course_id == '')
        {
            return null;
        }else{
            $this->db->select("AVG(rate) as rate, count(*) as rate_count" );
            $this->db->from("comment");
            $this->db->where('course_id', $course_id);
            return $this->db->get()->row();
        }
    }

    function insert_comment($data){
        return $this->db->insert('comment',$data);  

    }


  

}
?>