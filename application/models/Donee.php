<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Datatable.php");
class Donee extends CI_Model{

  use Datatable;
  var $table = 'donee';
  var $column_order = array('name','mobile','email','address','status','created_date');
  var $column_search = array('name','mobile','email','address','status');
  var $order = array('name' => 'asc');

  public function __construct(){
    parent::__construct();
  }

  # Get the admin info
  public function get($id){
    $this->db->select("*")
    ->from("donee")
    ->where("id",$id);
    return $this->db->get()->row();
  }

  #Getting raw Password
  private function _getPassword($username){
    $this->db->select("password") 
      ->from("donee")
      ->where("username",$username)
      ->where("status",'active');
    return $this->db->get()->row();
  }

  # Checking Credentials with strong security
  private function _validateCredentials($credeitial){
    if(empty($credeitial->username) || empty($credeitial->password)) return false;
    $donee = $this->_getPassword($credeitial->username);
    if(empty($donee)) return false;
    $password = $this->encryption->decrypt($donee->password);
    return $password == $credeitial->password;
  }

  public function login($credentials){
    if($this->_validateCredentials($credentials)){
      $this->db->where("username", $credentials->username);
      $this->db->where("status", 'active');
      $donee = $this->db->get("donee")->row(); 
      if(!empty($donee)){
        unset($donee->password);
        return (object)[
          "status" => true,
          "message" => "Loggedin Successfully",
          "donee" => $donee
        ];
      }else{
        return (object)[
          "status" => false,
          "message" => "Oops! Unable to login, please contact to administrator",
          "donee" => (object)[]
        ];
      }
    }else{
      return (object)[
        "status" => false,
        "message" => "Invalid username or password!",
        "donee" => (object)[]
      ];
    }
  }

  private function _get($options){
    foreach($options as $key => $value){
      $this->db->where($key,$value);
    }
    return $this->db->get("donee")->row();
  }

  # Validating new donee
  private function _validate($donee){
    #check username
    $exists = $this->_get(["username" => $donee->username]);
    if(!empty($exists)) return (object)[
      "status" => false,
      "message" => "Username already exists!"
    ];

    #check mobile number
    $exists = $this->_get(["mobile" => $donee->mobile]);
    if(!empty($exists)) return (object)[
      "status" => false,
      "message" => "Mobile number already exists!"
    ];

    #check email
    $exists = $this->_get(["email" => $donee->email]);
    if(!empty($exists)) return (object)[
      "status" => false,
      "message" => "Email already exists!"
    ];

    return (object)["status" => true, "message" => "Successfully validated!"];
  }

  # Adding new donee account
  public function add($donee){
    $validations = $this->_validate($donee);
    if($validations->status){
      if($this->db->insert("donee",$donee)){
        return (object)[
          "status" => true,
          "message" => "Successfully Added."
        ];
      }
    }else{
      return $validations;
    }
  }

  public function update($id, $data){
    $this->db->where("id",$id);
    return $this->db->update("donee",$data);
  }

  public function isUsernameUnique($username){
    $exists = $this->_get(["username" => $username]);
    if(empty($exists)){
      return ["status" => true,"message"=> "Username is successfully validated"];
    }else{
      return ["status" => false,"message"=> "Username is already exists!"];
    }
  }

  public function generateUsername($name){
    $name = str_replace(" ","",strtolower($name));
    $randomNumber = mt_rand(1000,9999);
    $username = $name.$randomNumber;
    $exists = $this->_get(["username" => $username]);
    if(empty($exists)){
      return ["status" => true,"message"=> "Username is successfully generated","username"=> $username];
    }else{
      return $this->generateUsername($name); // Recursive call until unique found
    }
  }

  private function _validateParam($key,$value){
    switch($key){
      case "name":
        if(empty($value) || strlen($value)< 3) return "Name must have at least 3 characters!";
      break;
      case "mobile": 
        if(empty($value) || !is_numeric($value) || strlen($value) !=10) return "Mobile number is not valid!";
      break;
      case "email":
        if(!filter_var($value,FILTER_VALIDATE_EMAIL))
          return "Invalid email format!";
      break;
      case "address":
        if(empty($value) || strlen($value)< 10) return "Address must have at least 10 charecters!";
      break;
      default:
      return null;
    }
  }

  public function validateData($donee){
    $errors = [];
    foreach($donee as $key => $value){
      $status = $this->_validateParam($key,$value);
      if(!empty($status)) array_push($errors,$status);
    }
    return $errors;
  }
  public function getAll($params){
    if(!empty($params)){
      foreach($params as $col => $val){
        $this->db->where($col,$val);
      }
    }
    return $this->db->get("donee")->result();
  }

}
