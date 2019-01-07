<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->load->model(array('admin','donee',"report","donor"));
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
			$doneeToken = $this->encrypt->encode($donee->donee_id); 
      $row = array();
			$row["id"] = $donee->donee_id;
      $row["name"] = $donee->name;
      $row["mobile"] = $donee->mobile;
      $row["email"] = $donee->email;
      $row["address"] = $donee->address;
      $row["status"] = $donee->status;
      $row["action"] = '<div class="pull-right">
			<a href="'.base_url("/update_donee/{$doneeToken}").'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a>
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

	public function addDonee(){
		$name = $this->input->post("name");
		$mobile = $this->input->post("mobile");
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");
		$address = $this->input->post("address");
		if(strlen($password) < 8 || $password != $re_password){
			echo json_encode([
				"status" => false,
				"message" => "Password must contain at least 8 characters and must be equal to repeat!"
			]);
			return;
		}

		$donee = (object)[
			"name" => $name,
			"mobile" => $mobile,
			"username" => $username,
			"email" => $email,
			"password" => $password,
			"address" => $address
		];
		$response = $this->donee->add($donee);
		echo json_encode($response);
	}
	
	public function getDonors(){
    $donors = $this->donor->populate();
    $data = array();
    foreach ($donors as $donor){
      $row = array();
			$row["id"] = $donor->donor_id;
      $row["name"] = $donor->name;
      $row["mobile"] = $donor->mobile;
      $row["email"] = $donor->email;
      $row["address"] = $donor->address;
      $row["status"] = $donor->status;
      $row["action"] = '<div class="pull-right">
			<a href="'.base_url("admin/profile/").'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a>
			<button class="btn btn-sm btn-danger btn-round btn-icon" title="Remove Admin"><i class="now-ui-icons ui-1_simple-remove"></i></button></div>';
      array_push($data, $row);
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->donor->count_all(),
      "recordsFiltered" => $this->donor->count_filtered(),
      "data" => $data,
    );
    echo json_encode($output);
	}
	
	#TODO: #FIXME: #FIXME: #FIXME: 
	public function doneeActions(){
		$action = $this->input->post("action");
		switch($action){
			# Checking uniqueness for username of donee
			case "checkUserName":
				$username = $this->input->post("username");
				$response = $this->donee->isUsernameUnique($username);
				echo json_encode($response);
				return;
			break;
			# Generating Unique donee username
			case "generateUserName":
				$name = $this->input->post("name");
				$response = $this->donee->generateUsername($name);
				echo json_encode($response);
				return;
			break;
			default:
			# invalidate action
			echo json_encode([
				"status" => false,
				"message" => "Invalid Action!"
			]);
		}
	}

	public function forgotPassword(){
		$email = $this->input->post("email");
		$response = array(
			"status" => false,
			"message" => "Sorry! This email id is not registered with us."
		);
		if($this->admin->isExists($email)){
			if($this->admin->sendResetPasswordLink($email)){
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

	public function resetPassword(){
		$token = $this->input->post("token");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");
		if($password != $re_password){
			$response = ["status" => false, "message" => "Password not matched"];
		}elseif(empty($token)){
			$response = ["status" => false, "message" => "Unable to receive tokens"];
		}else{
			$response = $this->admin->changePasword($token, $password);
		}
		echo json_encode($response);
	}
}
