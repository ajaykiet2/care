<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct("admin");
		$this->load->model([]);
	}
	public function index(){
		$this->load->view('login');
	}


	public function resetPassword(){
		$email_id = $this->input->post("email");
		$this->admin->sendPasswordLink($email_id);
	}
}
