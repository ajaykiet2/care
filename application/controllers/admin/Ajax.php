<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	#Default Constructor
	public function __construct(){
		#calling parent controller
		parent::__construct();
		$this->load->model(array('admin','donee',"report","donor","transaction"));
		if(!$this->input->is_ajax_request()){
			exit('Unautherized Access!');
		}
		$activityAction = $this->input->post("action");
		if(empty($activityAction) || !in_array($activityAction,['checkLocker','lockit'])){
			$this->session->set_userdata("last_activity",date("Y-m-d H:i:s"));
		}
	}

	public function getRevenueChartData(){
		$data = $this->report->getRevenueChart();
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

	public function getDonerRegistrationChart(){
		$data = $this->report->getDonerRegistrationChart();
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
			$token = $this->encryption->encrypt($admin->id);
			$actions = ($this->session->userdata("adminSession")->type == "super_admin") 
				? '<a href="'.base_url("admin/profile/{$token}").'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a>'
				:'N/A'; 
			$row = array();
			$row["id"] = $admin->id;
			$row["name"] = $admin->name;
			$row["mobile"] = $admin->mobile;
			$row["email"] = $admin->email;
			$row["type"] = $admin->type;
			$row["status"] = $admin->status;
			$row["action"] = "<div class='pull-right'>{$actions}</div>";
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
	
	public function updateAdmin(){
		$adminID = $this->encryption->decrypt($this->input->post("id"));
		$data = array(
			"name" => $this->input->post("name"),
			"mobile" => $this->input->post("mobile"),
			"email" => $this->input->post("email"),
			"address" => $this->input->post("address"),
			"type" => $this->input->post("type")
		);
		$errors = $this->admin->validateData($data);
		if(!empty($errors)){
			echo json_encode([
				'status' => false,
				'message' => "Validation Failed!",
				"errors" => $errors
			]);
			return;
		}

		if($this->admin->update($adminID,$data)){
			echo json_encode([
				'status' => true,
				'message' => "Successfully Updated!",
				"errors" => []
			]);
		}else{
			echo json_encode([
				'status' => false,
				'message' => "Unable to update admin information!",
				"errors" => []
			]);
		}
	}

	public function getDonees(){
    $donees = $this->donee->populate();
    $data = array();
    foreach ($donees as $donee) {
			$doneeToken = $this->encryption->encrypt($donee->id); 
      $row = array();
			$row["id"] = $donee->id;
      $row["name"] = $donee->name;
      $row["username"] = $donee->username;
      $row["mobile"] = $donee->mobile;
      $row["email"] = $donee->email;
      $row["status"] = $donee->status;
      $row["action"] = '<div class="pull-right">
			<a href="'.base_url("/donee/profile/{$doneeToken}").'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a></div>';
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
		if(strlen($mobile) != 10 || !is_numeric($mobile)){
			echo json_encode([
				"status" => false,
				"message" => "Mobile number is not valid!"
			]);
			return;
		}
		
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			echo json_encode([
				"status" => false,
				"message" => "Please enter the valid email id!"
			]);
			return;
		}
		
		if(strlen($address) < 10){
			echo json_encode([
				"status" => false,
				"message" => "Address must have at least 10 characters!"
			]);
			return;
		}
		$donee = (object)[
			"name" => $name,
			"mobile" => $mobile,
			"username" => $username,
			"email" => $email,
			"password" => $this->encryption->encrypt($password),
			"address" => $address
		];
		$response = $this->donee->add($donee);
		echo json_encode($response);
	}

	public function checkDoneeUsername(){
		$username = $this->input->post("username");
		$response = $this->donee->isUsernameUnique($username);
		echo json_encode($response);
		return;
	}

	public function updateDonee(){
		$id= $this->encryption->decrypt($this->input->post("id"));
		$name = $this->input->post("name");
		$mobile = $this->input->post("mobile");
		$email = $this->input->post("email");
		$address = $this->input->post("address");
		$status = $this->input->post("status");
		
		$donee = (object)[
			"name" => $name,
			"mobile" => $mobile,
			"email" => $email,
			"address" => $address,
			"status" => $status
		];
		$errors = $this->donee->validateData($donee);
		if(!empty($errors)){
			echo json_encode([
				"status" => false,
				"message" => "Invalid parameters found!",
				"errors" => $errors
			]);
			return;
		}
		if($this->donee->update($id, $donee)){
			echo json_encode([
				"status" => true,
				"message" => "Successfully Updated.",
				"errors" => []
			]);
		}else{
			echo json_encode([
				"status" => false,
				"message" => "Unable to update",
				"errors" => []
			]);
		}
	}
	public function getDonors(){
    $donors = $this->donor->populate();
    $data = array();
    foreach ($donors as $donor){
      $row = array();
			$row["id"] = $donor->id;
      $row["name"] = $donor->name;
      $row["mobile"] = $donor->mobile;
      $row["email"] = $donor->email;
      $row["status"] = $donor->status;
      $row["date"] = date("d M Y h:i A",strtotime($donor->created_date));
      $row["action"] = '<div class="pull-right">
			<a href="'.base_url("donor/profile/".$this->encryption->encrypt($donor->id)).'" class="btn btn-sm btn-facebook btn-round btn-icon" title="View Profile"><i class="now-ui-icons users_circle-08"></i></a></div>';
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
	

	public function getTransactions(){
		$transactions = $this->transaction->populate();
    $data = array();
    foreach ($transactions as $transaction){
      $row = array();
			$row["id"] = $transaction->id;
      $row["donee"] = $transaction->donee;
      $row["donor"] = $transaction->donor;
      $row["amount"] = $transaction->amount;	
      $row["status"] = $transaction->status;
      $row["date"] = date("d M Y h:i A",strtotime($transaction->transaction_date));
      array_push($data, $row);
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->transaction->count_all(),
      "recordsFiltered" => $this->transaction->count_filtered(),
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

	public function checkActivity(){
		$action = $this->input->post("action");
		switch($action){
			case "checkLocker":
				$lastActivity = $this->session->userdata("last_activity");
				$now = strtotime(date("Y-m-d H:i:s"));
				$waitTime = round(abs($now - strtotime($lastActivity))/60,2);
				if($waitTime > 1){
					echo json_encode([
						"status" => true,
						"message" => "System is ideal from long time, Please lock it.",
						"last_activity" => $this->session->userdata("last_activity"),
						"now" => date("Y-m-d H:i:s")
					]);
				}else{
					echo json_encode([
						"status" => false,
						"message" => "Admin is working on machine.",
						"last_activity" => $this->session->userdata("last_activity"),
						"now" => date("Y-m-d H:i:s")
					]);
				}
			break;
			case "lockit":
				$this->session->set_userdata("locked",true);
				echo json_encode([
					"status" => true,
					"message" => "System is locked for security purpose!"
				]);
			break;
			default:
				echo json_encode([
					"status" => false,
					"message" => "Invalid Action"
				]);
		}
	}
}
