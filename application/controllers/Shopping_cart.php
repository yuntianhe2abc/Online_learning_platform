
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/My_Controller.php");
class Shopping_cart extends My_Controller {
 
 function index()
 {

  $this->load->view("template/header");
  $this->load->model("shopping_cart_model");
  $user_id=$this->session->userdata('user_id');
  $data["user_shopping_cart_items"] = $this->shopping_cart_model->fetch_user_shopping_cart($user_id);
  $data["user_id"]= $user_id;
  $this->load->view("shopping_cart", $data);
    // $this->output->enable_profiler(TRUE);
 }

 function add_course(){
		
  $arr['course_id']=$this->input->post('course_id');
  $arr['user_id']=$this->session->userdata['user_id'];
  $this->load->model('shopping_cart_model');
  $add_status=$this->shopping_cart_model->add_course($arr);
  if($add_status){
      $this->load->view('verification/added_cart');
          
      }
      // $this->output->enable_profiler(TRUE);
}
function remove_from_cart(){
    $item_id=$this->uri->segment(3);
    
    $this->load->model('shopping_cart_model');
    $this->shopping_cart_model->remove_from_cart($item_id);
    redirect('shopping_cart');
    $this->output->enable_profiler(TRUE);
}
function empty_cart(){
    $user_id=$this->uri->segment(3);
    $this->load->model('shopping_cart_model');
    $this->shopping_cart_model->empty_shopping_cart($user_id);
    redirect('shopping_cart');
}
function payment_success(){

    echo"<h1>Payment success!</h1>";
}
function payment_cancel(){
    echo"<h1>Payment has been cancelled!!</h1>";
}
}
