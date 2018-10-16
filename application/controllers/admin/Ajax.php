<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->load->model(array('admin','donee',"report"));
		// $this->load->library(array('sms','user_agent'));
		#loading other modules
		#--------------
		if(!$this->input->is_ajax_request()){
			exit('Unautherized Access!');
		}
	}

	public function getRevenueCartData(){
		$data = $this->report->getRevenueCart();
		echo json_encode([
			"status" => true,
			"message" => "Loaded Successfully",
			"data" => $data
		]);
	}

	public function getAggregationData(){
		$data = $this->report->getAggregationData();
		echo json_encode([
			"status" => true,
			"message" => "Loaded Successfully",
			"data" => $data
		]);
	}

  public function getAdmins(){
    $admins = $this->admin->populate();
    $data = array();
    foreach ($admins as $admin) {
        $row = array();
				$row["id"] = $admin->id;
        $row["name"] = $admin->name;
        $row["mobile"] = $admin->mobile;
        $row["email"] = $admin->email;
        $row["address"] = $admin->address;
        $row["type"] = $admin->type;
        $row["action"] = '<div class="pull-right">
				<a href="'.base_url("admin/profile/").'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a>
				<button class="btn btn-sm btn-danger btn-round btn-icon" title="Remove Admin"><i class="now-ui-icons ui-1_simple-remove"></i></button></div>';
        array_push($data, $row);
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->admin->count_all(),
      "recordsFiltered" => $this->admin->count_filtered(),
      "data" => $data,
    );
    echo json_encode($output);
  }

	public function getDonees(){
    $donees = $this->donee->populate();
    $data = array();
    foreach ($donees as $donee) {
      $row = array();
			$row["id"] = $donee->id;
      $row["name"] = $donee->name;
      $row["mobile"] = $donee->mobile;
      $row["email"] = $donee->email;
      $row["address"] = $donee->address;
      $row["type"] = $donee->type;
      $row["action"] = '<div class="pull-right">
			<a href="'.base_url("admin/profile/").'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a>
			<button class="btn btn-sm btn-danger btn-round btn-icon" title="Remove Admin"><i class="now-ui-icons ui-1_simple-remove"></i></button></div>';
      array_push($data, $row);
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->donee->count_all(),
      "recordsFiltered" => $this->donee->count_filtered(),
      "data" => $data,
    );
    echo json_encode($output);
  }

	public function forgotPassword(){
		$email = $this->input->post("email");
		$response = array(
			"status" => false,
			"message" => "Sorry! This email id is not registered with us."
		);
		if($this->admin->isExists($email)){
			if($this->admin->sendResetLink($email)){
				$response = array(
					"status" => false,
					"message" => "We have send password reset link to registered email. Please check it and follow the instructions given there."
				);
			}else{
				$response = array(
					"status" => false,
					"message" => "Sorry! We aren't able to send password reset link"
				);
			}
		}
		echo json_encode($response);
	}
}
