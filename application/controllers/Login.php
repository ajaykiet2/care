<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(["admin"]);
	}
	public function index(){
		$this->load->view('locked');
	}

	public function login(){

		$username = $this->input->post("username");
		$password = $this->input->post("password");
		if(!isset($_POST['logMeIn'])){
			$this->load->view('login');
			return;
		}

		$credentials = (object)[
			"username" => $username,
			"password" => $password
		];
		$response = $this->admin->login($credentials);
		if($response->status){
			redirect("/dashboard");
		}else{
			$this->load->view("login",["response" => $response]);
		}
	}

	public function unlock(){
		$password = $this->input->post("password");
		$adminSession = $this->session->userdata('adminSession');
		$credentials = (object)[
			"username" => $adminSession->username,
			"password" => $password
		];
		$response = $this->admin->login($credentials);
		if($response->status){
			redirect("/dashboard");
		}else{
			$response->message = "Incorrect Password";
			$this->load->view("locked",["response" => $response]);
		}
	}

	public function resetPassword(){
		$email_id = $this->input->post("email");
		$this->admin->sendResetPasswordLink($email_id);
	}
}
