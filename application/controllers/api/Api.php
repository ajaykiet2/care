<?php
defined('BASEPATH') OR exit('No direct script access allowed'); # Prevent from direct access
require_once APPPATH . 'libraries/REST_controller.php'; # Using library for restful api

#=================================================================
# Api class for handling all API requests
class Api extends REST_Controller {
	// Default controller
	public function __construct(){
		parent::__construct();
		$this->load->model(array("donee","donor","transaction"));
	}
	# Login Donee
	public function login_post(){
		$request = json_decode($this->input->raw_input_stream);
		$credentials = (object)[
			"username" => $request->username,
			"password" => $request->password
		];
		
		$response = $this->donee->login($credentials);
		$this->response($response, REST_Controller::HTTP_OK); 
	}

	public function requestOTP_post(){
		$response = (object)["status" => false,"otp" => "","message" => "Unable to send OTP"];
		$request = json_decode($this->input->raw_input_stream);
		$mobile = $request->mobile;
		$email = $request->email;
		$response = $this->donor->isExists($mobile, $email);
		if($response->status){
			$response = $this->donor->sendOTP($mobile);
		}else{
			$response->otp = "";
		}
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function addDonor_post(){
		$request = json_decode($this->input->raw_input_stream);

		// Prepare default response
		$response = (object)["status" => false,"message" => "Unable to add donor","donor" => (object)[]];

		// Check if already exists
		$existance = $this->donor->isExists($request->mobile, $request->email);
		if(!$existance->status){
			$response->message = $existance->message;
			$this->response($response, REST_Controller::HTTP_OK);
			return;
		}

		// Lets create donor account
		$donor = [
			"name" => $request->name,
			"mobile" => $request->mobile,
			"email" => $request->email,
			"address" => $request->address,
			"pan_number" => $request->pan_number,
			"payment_mode" => $request->payment_mode,
			"payment_schedule" => $request->payment_schedule,
			"purpose" => $request->purpose,
			"amount" => $request->amount,
			"added_by" => $request->donee_id,
			"status" => "active",
 			"created_date" => date("Y-m-d H:i:s")
		];
		$donor_id = $this->donor->add($donor);
		if($donor_id){
			$donor = $this->donor->get($donor_id);
			$response = (object)[
				"status" => true,
				"message" => "Donor has been added successfully",
				"donor" => $donor
			];
		}
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function createTransaction_post(){
		$txn_number = createUniqID(12);
		$this->transaction->createTransaction([
			"txn_number" => $txn_number,
			"donor_id" => $donor_id,
			"amount" => $donor->amount,
			"txn_date" => date("Y-m-d H:i:s")
		]);
	}
	public function completeTransaction_post(){
		$request = json_decode($this->input->raw_input_stream);
		$response = (object)["status" => false,"message" => "Unable to complete transaction"];
		$txn_number = $request->txn_number;
		$payment_gateway = $request->payment_gateway;
		$payment_mode = $request->payment_mode;
		$status = $request->status;
		if($status === "Success"){
			$this->transaction->updateTransaction($txn_number,[
				"payment_gateway" => $payment_gateway,
				"payment_mode" => $payment_mode,
				"status" => "success"
			]);
			$response = (object)["status" => true,"message" => "Transaction successfully completed"];
		}else{
			$this->transaction->updateTransaction($txn_number,[
				"payment_gateway" => $payment_gateway,
				"payment_mode" => $payment_mode,
				"status" => "failed"
			]);
			$response = (object)["status" => true,"message" => "Transaction has been failed"];
		}
		$this->response($response, REST_Controller::HTTP_OK);
	}

}
