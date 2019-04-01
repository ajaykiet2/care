<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(["environment","admin","donee","donor"]);
		if(!$this->admin->isLoggedIn() || $this->admin->isLocked()){
			redirect('/', 'refresh');
			return;
		}
		$this->session->set_userdata("last_activity",date("Y-m-d H:i:s"));
		$this->session->set_userdata("saved_url",base_url(uri_string()));
	}

	public function index(){
		$this->session->set_userdata("active_manu","admins");
		$this->load->view('admin_listing');
	}

	public function adminProfile($token){
		$adminId = $this->encryption->decrypt($token);
		$this->session->set_userdata("active_manu","admins");
		$option = [ "id" => $adminId ];
		$admin = $this->admin->get($option);
		$this->load->view("admin_profile",["admin"=>$admin]);
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
		$this->session->set_userdata("active_manu","users");
    $this->load->view("user_listing");
	}
	
	public function transactions(){
		$this->session->set_userdata("active_manu","transactions");
		$this->load->view("transactions");
	}

	public function companyProfile(){
		$this->load->view("about_us");
	}

	public function addDonee(){
		$this->load->view("new_donee");
	}
	
	public function addAdmin(){
		$this->load->view("new_admin");
	}

	public function doneeProfile($token){
		$id = $this->encryption->decrypt($token);
		$this->session->set_userdata("active_manu","donees");
		$donee = $this->donee->get($id);
		$this->load->view("donee_profile",["donee"=>$donee]);
	}

	public function donorProfile($token){
		$id = $this->encryption->decrypt($token);
		$this->session->set_userdata("active_manu","donors");
		$donor = $this->donor->get($id);
		$this->load->view("donor_profile",["donor"=>$donor]);
	}
}
