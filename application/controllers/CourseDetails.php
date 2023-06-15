<?php
require_once("application/core/My_Controller.php");
class courseDetails extends My_Controller
{
    var $course_id;
    function __construct()
	{
		parent::__construct();
		$this->load->model('course_details_model');
        $course_id=$this->uri->segment(3);
	}

	function index(){
		// // $course_id=$this->uri->segment(2);
		// $course_data=$this->course_details_model->get_course_by_id($course_id);
		// $course_comments=$this->course_details_model->get_course_comments($course_id);
		// $data['course_data']=$course_data;
        // $data['course_comments']=$course_comments->result();
        // // $string = $this->load->view('courses/comments', $data, TRUE);
        // // echo $string;
        
		// $this->load->view('courses/course_details',$data);
		// $this->output->enable_profiler(TRUE);
	}
    function details(){
        $this->load->view('template/header');
		$course_id=$this->uri->segment(3);
		$course_data=$this->course_details_model->get_course_by_id($course_id);
		$course_comments=$this->course_details_model->fecth_course_comments($course_id);
        $course_rate=$this->course_details_model->get_course_rate_statistics($course_id);
		$data['course_data']=$course_data;
        $data['course_comments']=$course_comments->result();
        $data['course_rate']=$course_rate;
        
		$this->load->view('courses/course_details',$data);
		// $this->output->enable_profiler(TRUE);
	}
    function add_comment(){
        $this->load->model('user_model');
        
        if(!empty($this->input->post('comment_content'))){
            $user_id=$this->session->userdata['user_id'];
            $user_data=$this->user_model->get_user_details($user_id);
           
            $username=$user_data->username;
            $data=array(
                'user_id'=>$user_id,
                'comment_sender_name'=>$username,
                'course_id'=>$this->input->post('course_id'),
                'comment' =>$this->input->post('comment_content'),
                'rate' =>$this->input->post('rate')
            );
            $this->course_details_model->insert_comment($data);
        }
        $error = '<label class="text-success">Comment Added</label>';
        $notification = array(
            'error'  => $error
           );
           
        echo json_encode($notification);
        // $this->output->enable_profiler(TRUE);

    }
    
    function fetch_comments(){
        $course_id=$this->uri->segment(3);
        echo($course_id);
        $result=$this->course_details_model->fecth_course_comments($course_id);
        if(!$result == null){
            $data["course_comments"]=$result->result();
            $string = $this->load->view('courses/comments', $data, TRUE);
			echo $string;
        }else{
            echo  ""; 
        }
        // $this->output->enable_profiler(TRUE);
    }
   
}
?>