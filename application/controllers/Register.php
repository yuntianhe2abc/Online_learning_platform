<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  if($this->session->userdata('id'))
  {
   redirect('private_area');
  }
  $this->load->library('form_validation');
//   $this->load->library('encryption');
  $this->load->model('register_model');
 }

 function index()
 {
   $captcha_image=$this->create_captcha();
  $this->load->view('register',$captcha_image);
 }

 public function create_captcha()
 {
     $this->load->helper('captcha');
     $vals = array(
     //'word'          => 'Randdfdom word',
     'img_path'      => './uploads/captcha/',
     'img_url'       => base_url().'uploads/captcha/',
     'font_path'     => './path/to/fonts/texb.ttf',
     'img_width'     => '150',
     'img_height'    => 30,
     'expiration'    => 7200,
     'word_length'   => 6,
     'font_size'     => 16,
     'img_id'        => 'Imageid',
     'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
 
     // White background and border, black text and red grid
     'colors'        => array(
             'background' => array(255, 255, 255),
             'border' => array(255, 255, 255),
             'text' => array(0, 0, 0),
             'grid' => array(255, 40, 40)
             )
     );
 
     $cap = create_captcha($vals);
     $image= $cap['image'];
     echo $cap['image'];
     
     $captchaword= $cap['word'];
     echo $captchaword;
     $captcha_data['cap_image']=$image;
     $this->session->set_userdata('captchaword',$captchaword);
     return $captcha_data;
     // $this->load->view('index',['captcha_image'=>$image]);
 }
function check_captcha()
	{
		$captcha=$this->input->post('captcha');
		$captcha_answer=$this->session->userdata('captchaword');

		///check both captcha
		if($captcha==$captcha_answer)
		{
			// $this->session->set_flashdata('error','<div class="alert alert-success">Captcha is matched.</div>');
			return True;
		}
		else{
			// $this->session->set_flashdata('error','<div class="alert alert-danger">Captcha does not match.</div>');
			// redirect('register');
      return False;
		}
	}
  
  

 function validation()
 {
  $this->form_validation->set_rules('username', 'Username', 'required|trim');
  $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');

  $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[25]|callback_check_strong_password');
  $check_captcha=$this->check_captcha();
  if($this->form_validation->run()&& $check_captcha)
  {
   $verification_key = md5(rand());
//    $encrypted_password = $this->encryption->encode($this->input->post('user_password'));
   $data = array(
    'username'  => $this->input->post('username'),
    'email'  => $this->input->post('email'),
    'password'=>$this->input->post('password'),
    
    // 'password' => $encrypted_password,
    'verification_key' => $verification_key,
    'is_email_verified'=> 0
   );
   $id = $this->register_model->insert($data);

   if($id)
   {
  
    $subject = "Please verify email for login";
    $message = "
    <p>Hi ".$this->input->post('name')."</p>
    <p>This is email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
    <p>Once you click this link your email will be verified and you can login into system.</p>
    <p>Thanks,</p>
    ";

    $config = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'mailhub.eait.uq.edu.au',
    'smtp_port' => 25,
    'starttls'=>True,
    'mailtype'  => 'html',
    'charset'    => 'iso-8859-1',
    'wordwrap'   => TRUE,
    'newline'=>"\r\n"
    );
    
    $this->load->library('email');
    $this->email->initialize($config);
    $this->email->from('sdsdsds@student.uq.edu.au');
    $this->email->to($this->input->post('email'));
    $this->email->subject($subject);
    $this->email->message($message);
    $sent=$this->email->send();
    if($sent)
    {
      echo 'Check in your email for email verification mail';
      // echo('email sent to '.$this->input->post('name'));
      // $this->session->set_flashdata('message', 'Check in your email for email verification mail');
      // redirect('welcome');
    }else{
      $this->email->print_debugger();
    }
   }
  }
  else
  {
    if(!$check_captcha){
      $this->session->set_flashdata('error','<div class="alert alert-danger">Captcha does not match.</div>');
    }
   $this->index();
  }
 }
function check_strong_password($str)
 {
    if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
      return TRUE;
    }
    $this->form_validation->set_message('check_strong_password', 'The password field must be contains at least one letter and one digit.');
    return FALSE;
 }
 
 
 function verify_email()
 {
  if($this->uri->segment(3))
  {
   $verification_key = $this->uri->segment(3);
   if($this->register_model->verify_email($verification_key))
   {
    $data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
   }
   else
   {
    $data['message'] = '<h1 align="center">Invalid Link</h1>';
   }
   $this->load->view('email_verification', $data);
  }
 }

}

?>
