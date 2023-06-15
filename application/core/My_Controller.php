<?php
class My_Controller extends CI_Controller

{
	function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }
	function render($view,$data)
	{
	
		$this->load->view('template/header');
		$this->load->view($view,$data);
		// $this->load->view('template/footer');
	}
}