<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(["environment","admin","donee","donor"]);
		if(!$this->admin->isLoggedIn()){
			redirect('/', 'refresh');
			return;
		}
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
		$param_id = $this->input->get("id");
		# Update Donee Profile
		if(!empty($param_id)){
			$donee_id = $this->encryption->decrypt($param_id);
			$donee = $this->donee->get($donee_id);
			$this->load->view("new_donee",$donee);
		}else{
			# New Profile
			$this->load->view("new_donee");
		}
	}

	public function doneeProfile($token){
		$id = $this->encryption->decrypt($token);
		$this->session->set_userdata("active_manu","donees");
		$donee = $this->donee->get($id);
		$this->load->view("donee_profile",["donee"=>$donee]);
	}
}
