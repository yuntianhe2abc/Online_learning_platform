<?php
require_once("application/core/My_Controller.php");
class Home extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('course_model');
		$this->load->helper('url');
	}
	public function index($offset=0)
	{
		$data['course'] = $this->course_model->getAll();
	
		$this->render('home',$data);
		// $this->output->enable_profiler(TRUE);
	}

	function detail($id)
	{
		$data['model'] = $this->course_model->getById($id);
		
	}
	// public function find_course()
    // {	
	// 	$query = '';
	// 	if(isset($_POST["query"])){
	// 		$query=$_POST["query"];
	// 		$limit=$_POST["query"];
	// 		$start=$_POST["query"];
	// 		$result = $this->course_model->get_courses($query);
	// 		if(!$result == null){
	// 			$data["course"]=$result->result();
				
	// 			$string = $this->load->view('courses/course_list', $data, TRUE);
	// 			echo $string;
         
    //         }else{
    //             echo  ""; 
    //         }
	// 	 }
		 

	// 	$this->output->enable_profiler(True);
    // }
	public function find_course()
    {	
		$query = '';
		if(isset($_POST["query"])){
			$query=$_POST["query"];
			$limit=$_POST["limit"];
			$start=$_POST["start"];
			$result = $this->course_model->get_courses($query,$limit,$start);
			if(!$result == null){
				$data["course"]=$result->result();
				
				$string = $this->load->view('courses/course_list', $data, TRUE);
				echo $string;
         
            }else{
                echo  ""; 
            }
		 }
		 

		// $this->output->enable_profiler(True);
    }
	public function course_name_auto_complete(){
		$query = '';
		$response = array();
		if(isset($_GET["search"])){
			$query=$_GET["search"];
			$result = $this->course_model->get_courses_by_name($query);
			$rows=$result->result();
			
			foreach($rows as $row ){
				$response[] = array("value"=>$row->course_id,"label"=>$row->course_name);
			 }
		}
		// $this->output->enable_profiler(True);
		echo json_encode($response);
		
	}

}
