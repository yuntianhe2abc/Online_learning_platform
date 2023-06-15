<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Controller.php");
class profile extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('logged_in')){
		// 	redirect('login');
		// }else{
			$this->load->model('user_model');
			$this->load->model('course_model');

		// }
	}
    public function index()
    
    {   
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}else{
			$this->load->view('template/header');
			$user_id=$this->session->userdata('user_id');
			$data['user_id']=$user_id;
			$user_data=$this->user_model->get_user_details($user_id);
			$data['user_data']=$user_data;
			
			$user_created_courses=$this->course_model->get_user_created_courses($user_id);
			$data['user_created_courses']=$user_created_courses;
			
			$this->load->view('profile',$data);
			// $this->output->enable_profiler(True);
		}
		
    }

	public function update_profile(){
		$result=NULL;
		$this->load->view('template/header');
		$user_id=$this->session->userdata('user_id');
		$data['user_id']=$user_id;
		$user_data=$this->user_model->get_user_details($user_id);
		$data['user_data']=$user_data;

		$this->load->view('update_profile',$data);
		if(!$this->input->post('study_level')==NULL){
			$data['user_id']=$this->session->userdata('user_id');
			$data['study_level']=$this->input->post('study_level');
			$data['university']=$this->input->post('university');
			$data['major']=$this->input->post('major');
			$result=$this->user_model->update_profile($data);
		}
		
		if(!$result==NULL){
			redirect('profile');
		}
		// $this->output->enable_profiler(True);
	}
	
	
   
}

?>