<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Course_model extends CI_Model
{

	function insert_course($arr){
		$this->db->insert('course',$arr);
	}
    
	function getAll()
	{
		$keyword = $this->input->get('keyword');
		if($keyword){
			$this->db->like(array('course_name'=>$keyword));
			// $this->db->or_like(array('course_description'=>$keyword));
			$this->db->or_like(array('course_author'=>$keyword));
		}

		$this->db->order_by('course_id DESC');
		return $this->db->get('course')->result();
	}
  
	function countAll()
	{
		$keyword = $this->input->get('keyword');
		if($keyword){
			$this->db->like(array('course_name'=>$keyword));
			// $this->db->or_like(array('course_description'=>$keyword));
			$this->db->or_like(array('course_author'=>$keyword));
		}
		return $this->db->get('course')->num_rows();
	}

    function get_courses($query,$limit,$start)
    {
        if($query == '')
        {
            return null;
        }else{
            $this->db->select("*");
            $this->db->from("course");
            $this->db->like('course_name', $query);
            // $this->db->or_like('course_description', $query);
            $this->db->order_by('course_id', 'DESC');
            $this->db->limit($limit,$start);
            return $this->db->get();
        }
    }
	function get_courses_by_name($query)
    {
        if($query == '')
        {
            return null;
        }else{
            $this->db->select("*");
            // $this->db->from("course");
            $this->db->like('course_name', $query);
            return $this->db->get('course');
        }
    }
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
	function get_user_created_courses($user_id)
    {
		if(!$user_id==NULL){
			$this->db->select("*");
            $this->db->from("course");
            $this->db->where('user_id', $user_id);
			$result=$this->db->get()->row();
		}else{
			return NULL;
		}
    }
}
?>