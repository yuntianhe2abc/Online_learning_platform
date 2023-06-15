
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Controller.php");
class course_recommendation extends My_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('couse_recommendation_model');
	}
    function index(){
        $this->load->view('template/header');
        $recommend_course_list=$this->get_recommendation();
        $data["course"]=$this->couse_recommendation_model->get_courses(array_keys($recommend_course_list));
        $data["scores"]=$recommend_course_list;
		$this->load->view('course_recommendation', $data);
    }
    function user_course_matirx(){
        $matrix=array();
        // $this->model->load('Couse_recommendation_model');
        $courses=$this->couse_recommendation_model->get_all_courses();
        $users=$this->couse_recommendation_model->get_all_users();
        foreach($users as $user){
            $user_id=$user->user_id;
            $user_ratings=[];          
            foreach($courses as $course){
                $course_id=$course->course_id;
                $user_rating=$this->couse_recommendation_model->get_user_single_course_rating($user_id,$course_id);
                if($user_rating!=NULL){
                    // $user_ratings[$course_id]=$user_rating->rate;
                    $matrix[$user_id][$course_id]=$user_rating->rate;
                }
            }
        }
        return $matrix;
    }

    private function get_most_similar_users($matrix){
        $distance=array();
        $user_a=$this->session->userdata['user_id'];
        $users=$this->couse_recommendation_model->get_all_users();
        foreach($users as $user){
            $user_b=$user->user_id;
            if($user_a!=$user_b){
                $distance[$user_b]=$this->get_user_similarity($matrix,$user_a,$user_b);
            }
        }
        arsort($distance);
        return $distance;
    }
    private function get_user_similarity($matrix,$user_a,$user_b){
        $dis=0;
        // $this->model->load('Couse_recommendation_model');
        $courses= $this->couse_recommendation_model->get_user_all_course_ratings($user_a);
        // print("courses:/n");
        // print_r($courses);
        foreach($courses as $course){
            $course_id=$course->course_id;
            if(isset($matrix[$user_b][$course_id])){
                $b_rate=$matrix[$user_b][$course_id];
                $a_rate=$matrix[$user_a][$course_id];
                $dis+=pow(($b_rate-$a_rate),2);
            }
        } 
        $similarity=round(1/(1+sqrt($dis)),2);
        return $similarity;

    }
    private function get_recommendation(){
        $recommend_course_list=array();
        $rated_course_list=array();
        $current_user=$this->session->userdata['user_id'];
        // $this->model->load('Couse_recommendation_model');
        $user_courses=$this->couse_recommendation_model->get_user_all_course_ratings($current_user);
        foreach($user_courses as $course){
            array_push($rated_course_list,($course->course_id));
        }
        $matrix=$this->user_course_matirx();
        $similar_users=$this->get_most_similar_users($matrix);
        foreach($similar_users as $key=>$value) {
            // recommendation list based on both user similarity and also their ratings for the course
            $favourite_courses= $this->couse_recommendation_model->get_user_favourite_courses($key);
            foreach($favourite_courses as $course){
                if(!in_array($course->course_id,$rated_course_list)){
                    $recommend_course_list[$course->course_id]=$value*(($course->rate)/5);
                }
            }
        }
        arsort($recommend_course_list);
        return $recommend_course_list;

    }
}
