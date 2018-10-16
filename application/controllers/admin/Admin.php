<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(["environment"]);
	}

	public function index(){
		$this->session->set_userdata("active_manu","admins");
		$this->load->view('admin_listing');
	}

  public function donees(){

		$this->session->set_userdata("active_manu","donees");
    $this->load->view("donee_listing");
  }

  public function donors(){

		$this->session->set_userdata("active_manu","donors");
    $this->load->view("donor_listing");
  }

	public function users(){
    $this->load->view("user_listing");
  }
}
