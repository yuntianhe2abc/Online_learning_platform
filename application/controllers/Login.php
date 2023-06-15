<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->view('template/header');
		if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array(
						'username' => $username,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					
					$this->load->view('home'); //if user already logined show main page
				}
			}else{
				$this->load->view('login');	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			$this->session->set_flashdata('user_loggedin', 'You are now logged in');
			$this->load->view('welcome_message'); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}
	public function check_login()
	{
		$this->load->model('user_model');		//load user model
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //getting remember checkbox from login form
		if(!$this->session->userdata('logged_in')){	//Check if user already login
			$user_account=$this->user_model->login($username, $password);
			// echo'here is user account';
			// print_r($user_account);
			if ( isset($user_account))//check username and password
			{	
				
				if(!($user_account->is_email_verified)){
					echo 'You have not verify your email, plase check your email box to verify your account before logging in!';
				}else{
					$user_data = array(
						'username' => $username,
						'user_id' => $user_account->user_id,
						'logged_in' => true 	//create session variable
					);
					if($remember) { // if remember me is activated create cookie
						set_cookie("username", $username, '300'); //set cookie username
						set_cookie("password", $password, '300'); //set cookie password
						set_cookie("remember", $remember, '300'); //set cookie remember
					}	
					$this->session->set_userdata($user_data); //set user status to login in session
					redirect('login'); // direct user home page
				}
			}else
			{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{

			{
				redirect('login'); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login'); // redirect user back to login
	}
	function forgot_password(){
        $this->load->view('template/header');
        $this->load->view('forgot_password');
    
    }
    // function email(){
		
    // }
	function email(){
		$this->load->model('user_model');	
		$email=$this->input->post('email');
		$SixDigitRandomNumber = mt_rand(100000,999999);
		$data=array('email'  => $email,
		'token'=>$SixDigitRandomNumber
	);
		$id = $this->user_model->insert_pwd_reset($data);
		$subject = "Please check email to get password reset token";
		$message = "
		<p>Your reset password token is: </p>
		<h1><a href='".base_url()."login/reset_link/".$SixDigitRandomNumber."'>$SixDigitRandomNumber</a>.</h1>
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
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		$sent=$this->email->send();
		if($sent)
		{
		  echo 'Check in your email for email verification mail';
	
		}else{
		  $this->email->print_debugger();
		}
	}
	function reset_link(){
		$this->load->model('user_model');	
		if($this->uri->segment(3)){
			$token = $this->uri->segment(3);
			$email1=$this->user_model->check_token($token);
			$email=$email1->email;
   			if($email){
				$data['email']=$email;
				$this->user_model->delete_reset_record($token,$email);
				$this->load->view('verification/reset_password',$data);
			}else{
				echo"invalid token";
			}
		}
	}
	function reset_password(){
		$this->load->model('user_model');	
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[25]|callback_check_strong_password');
		$this->form_validation->set_rules('confirm_password', 'Password', 'required|min_length[8]|max_length[25]|callback_check_strong_password|callback_check_password_equal['.$this->input->post('password').']');
		if($this->form_validation->run()){
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$result=$this->user_model->update_password($email,$password);
			if($result){
				$this->session->set_flashdata('pwd_reset_success','Password has been reset, You can login now');
				redirect('login');
			}
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
	function check_password_equal($password,$str){
		if($password==$str){
			return True;
		}
		$this->form_validation->set_message('check_password_equal', 'Password does not match!');
   		return FALSE;
	}
}
?>