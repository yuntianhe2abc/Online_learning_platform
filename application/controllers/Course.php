<?php
require_once("application/core/My_Controller.php");
class course extends My_Controller
{
    function __construct()
	{
		parent::__construct();
		// if(!$this->session->userdata('logged_in')){
		// 	redirect('login');
		// }else{
			$this->load->model('course_model');
		// }
	}
	function index(){
        
    }
    function add()
	{
		
		$this->load->view('courses/add_multiple');
	}
	function details(){
		$course_id=$this->uri->segment(3);
		$query=$this->course_model->get_course_by_id($course_id);
		
		$data['course_data']=$query;
		// print_r($data);
		// $this->load->view('template/header');
		$this->load->view('courses/course_details',$data);
		// $this->output->enable_profiler(TRUE);
	}
    function save()
	{
		$arr['user_id']=$this->session->userdata['user_id'];
		$arr['course_name'] = $this->input->post('course_name');
		$arr['course_author'] = $this->input->post('course_author');
		$arr['course_description'] = $this->input->post('course_description');

		if(isset($_FILES['course_image']['name']))
		{
			$arr['course_image'] = $this->upload_single_image();
			$this->resize_image(APPPATH.'../uploads/'.$arr['course_image'],900);
			
			$this->createThumbnail(APPPATH.'../uploads/'.$arr['course_image'],APPPATH.'../uploads/thumbnails/'.$arr['course_image'],200,150);
		}
		$a=$this->course_model->insert_course($arr);
        print_r($a);
		$this->session->set_flashdata('success','course saved successfully');

		$data=$this->upload_muptiple_pdfs();
		print_r($data);
		// redirect('course/index');
	}
	


	private function upload_muptiple_pdfs() { 
		$data = [];
		$count = count($_FILES['pdfs']['name']);
		for($i=0;$i<$count;$i++){
		  if(!empty($_FILES['pdfs']['name'][$i])){
			$this->load->library('upload'); 
			$_FILES['file']['name'] = $_FILES['pdfs']['name'][$i];
			$_FILES['file']['type'] = $_FILES['pdfs']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['pdfs']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['pdfs']['error'][$i];
			$_FILES['file']['size'] = $_FILES['pdfs']['size'][$i];
			$config['upload_path'] =  APPPATH.'../uploads/pdfs'; 
			$config['allowed_types'] = 'gif|jpg|png|pdf';
			$config['max_size'] = 100000;
			$config['file_name'] = $_FILES['pdfs']['name'][$i];
			
			$this->upload->initialize($config);
			if($this->upload->do_upload('file')){
			  $uploadData = $this->upload->data();
			  $filename = $uploadData['file_name'];
	 
			  $data['totalFiles'][] = $filename;
			}else{
				$data = array('error' => $this->upload->display_errors());
            	$this->load->view('file', $data);
			}
		  }
		}
		$this->output->enable_profiler(True);
		return $data;
	 }
	private function upload_single_image(){
		$this->load->library('upload');
		$config['upload_path'] = APPPATH.'../uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = date('YmdHms').'_'.rand(1,999999);
		$this->upload->initialize($config);
		if($this->upload->do_upload('course_image'))
		{
			$uploaded = $this->upload->data();	
			return $uploaded['file_name'];
		}
	}
	private function resize_image($source,$width)
	{
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = $width;
		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
		$this->image_lib->clear();
		
	}
    private function createThumbnail($source,$destination,$width,$height)
	{
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source;
		$config['new_image'] = $destination;
		$config['maintain_ratio'] = FALSE;
		$config['width']         = $width;
		$config['height'] = $height;

		$this->image_lib->initialize($config);

		$this->image_lib->resize();
		$this->image_lib->clear();
	}
}
?>