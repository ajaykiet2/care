<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
			parent::__construct();
		$this->load->model("admin");
		if(!$this->admin->isLoggedIn()){
			redirect('/', 'refresh');
			return;
		}
	}

	public function index(){

		$this->session->set_userdata("active_manu","dashboard");
		$this->load->view('dashboard');
	}
}
