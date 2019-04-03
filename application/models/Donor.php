<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Datatable.php");
class Donor extends CI_Model{
  use Datatable;
  var $table = '(SELECT donor.*,donee.name as donee_name FROM donor INNER JOIN donee ON donor.added_by = donee.id) tempTable';
  var $column_order = array('name','mobile','email','amount','status','donee_name','created_date');
  var $column_search = array('name','mobile','email',"donee_name");
  var $order = array('name' => 'asc');

  public function __construct(){
    parent::__construct();
    $this->load->library(array("sms"));
  }

  public function get($donor_id){
    return $this->db->get_where("donor",["id"=>$donor_id])->row();
  }
  public function add($donor){
    $this->db->insert("donor",$donor);
    return $this->db->insert_id();
  }

  public function update($donor_id, $data){
    $this->db->where("id",$donor_id);
    return $this->db->update("donor",$data);
  }

  public function isExists($mobile, $email){
    $this->db->where("mobile",$mobile)
      ->or_where("email",$email);
    $donor = $this->db->get("donor")->row();
    if(!empty($donor)){
      return (object)[
        "status" => false,
        "message" => "Donor is already exists",
        "donor_id" => $donor->id
      ];
    }
    return (object)[
      "status" => true,
      "message" => "Successfully validated"
    ];
  }

  public function sendOTP($mobile){
    $otp = mt_rand(100000, 999999);
    $message = "{$otp} is your OTP to validate your careIndia account.";
    if($this->sms->send($mobile, $message)){
      return (object)[
        "status" => true,
        "otp" => (string)$otp,
        "message" => "OTP has been sent successfully"
      ];
    }else{
      return (object)[
        "status" => false,
        "otp" => "",
        "message" => "Unable to send OTP"
      ];
    }
  }

  public function getAll($params){
    if(!empty($params)){
      foreach($params as $col => $val){
        $this->db->where($col,$val);
      }
    }
    return $this->db->get("donor")->result();
  }

  public function validateData($donor){
    $errors = [];
    if($donor->name == "" || strlen($donor->name) < 3 || strlen($donor->name) > 20)
      array_push($errors,"Name must be valid! Ex. not empty, min length 3, max length 20");
    if($donor->mobile == "" || strlen($donor->mobile) != 10 || !is_numeric($donor->mobile))
      array_push($errors,"Mobile number is not valid!");
    if($donor->email == "" || !filter_var($donor->email, FILTER_VALIDATE_EMAIL))
      array_push($errors,"Invalid email id!");
    if($donor->pan_number == "" || strlen($donor->pan_number) != 10)
      array_push($errors,"PAN number is not valid!");
    if(!is_numeric($donor->amount)) 
      array_push($errors,"Amount is not valid!");
    if(strlen($donor->address) < 10) 
      array_push($errors,"Invalid address found!");
    return $errors;
  }
}
