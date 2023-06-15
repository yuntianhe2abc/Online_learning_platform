<?php
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
			redirect('admin');
	}
	function index()
	{
		$this->load->view('admin/dashboard');
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
}