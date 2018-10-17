<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Datatable.php");
class Admin extends CI_Model{

  use Datatable;
  var $table = 'admin';
  var $column_order = array('name','mobile','email','address','type','created_date');
  var $column_search = array('name','mobile','email','address');
  var $order = array('name' => 'asc');

  public function __construct(){
    parent::__construct();
  }

  # Get the admin info
  public function get($option){
    return $this->db->get_where("admin", [$option->key => $option->value])->row();
  }

  #Getting raw Password
  private function _getPassword($username){
    $query = $this->db->get_where("admin",["username" => $username, "status" => "active"]);
    return $query->row();
  }

  # Checking Credentials with strong security
  private function _validateCredentials($credentials){
    if(empty($credentials->username) || empty($credentials->password)) return false;
    $password = $this->_getPassword($credentials->username);
    $saltedPassword = $this->encrypt->encode($credentials->password);
    return $password == $saltedPassword;
  }

  public function isLoggedIn(){
    return true;
  }

  public function login($credentials){
    if($this->_validateCredentials($credentials)){
      $option = (object)[
        "key" => "username",
        "value" => $credentials->username
      ];
      $admin = $this->get($option);
      $adminSession = (object)[
        "name" => $admin->name,
        "username" => $admin->username,
        "type" => $admin->type,
        "status" => $admin->status,
        "logged_in" => true,
        "timeStamp" => date("Y-m-d H:i:s")
      ];
      $this->session->set_userdata("adminSession",$adminSession);
      return (object)[
        "status" => true,
        "message" => "Successfully Logged In"
      ];
    }else{
      return (object)[
        "status" => false,
        "message" => "Incorrect username or password!"
      ];
    }
  }

  public function sendResetPasswordLink($email_id){

  }

}
