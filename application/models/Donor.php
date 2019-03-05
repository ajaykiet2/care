<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Datatable.php");
class Donor extends CI_Model{
  use Datatable;
  var $table = 'donor';
  var $column_order = array('name','mobile','email','address','status','created_date');
  var $column_search = array('name','mobile','email','address','status');
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
    $donorMobile = $this->db->get_where("donor", ["mobile" => $mobile])->row();
    if(!empty($donorMobile)){
      return (object)[
        "status" => false,
        "message" => "Mobile number is already exists"
      ];
    }
    $donorEmail = $this->db->get_where("donor", ["email" => $email])->row();
    if(!empty($donorEmail)){
      return (object)[
        "status" => false,
        "message" => "Email ID is already exists"
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

}
