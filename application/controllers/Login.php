<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(["admin"]);
	}
	public function index(){
		if($this->admin->isLocked()){
			$this->load->view("locked");
		}elseif($this->admin->isLoggedIn()){
			redirect("/dashboard");
		}else{
			$this->load->view('login');
		}
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
			$savedUrl = $this->session->userdata("saved_url");
			$this->session->set_userdata("locked",false);
			$this->session->set_userdata("last_activity",date("Y-m-d H:i:s"));
			redirect($savedUrl,'refresh');
		}else{
			$response->message = "Incorrect Password";
			$this->load->view("locked",["response" => $response]);
		}
	}

	public function resetPassword($token){
		$response = $this->admin->validateToken($token);
		if($response->status){
			$this->session->set_userdata("dataToReset", $response);
			$this->load->view("reset_password",["data" => $response]);
		}else{
			$this->load->view("reset_password",["data" => $response]);
		}
	}
	
	public function logout(){
		$this->admin->logout();
		redirect("/");
	}

	public function not_found(){
		if($this->admin->isLoggedIn()){
			$this->session->set_userdata("active_manu","not_found");
			$this->load->view("not_found");
		}else{
			redirect("/");
		}
	}

}
