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
  public function get($admin_id){
    $this->db->select("*")
    ->from("admin")
    ->where("admin_id",$admin_id);
    return $this->db->get()->result();
  }

  #Getting raw Password
  private function _getPassword($user_name){
    $this->db->select("password")
      ->from("admin")
      ->where("id",$user_name);
    return $this->db->get()->row();
  }

  # Checking Credentials with strong security
  private function _validateCredentials($user){
    $credeitial = $this->_getPassword($user->user_name);
    $password = $this->encrypt->encode($user->password);
    return $password == $credeitial->password;
  }

  public function isLoggedIn(){
    return true;
  }

  public function login($credentials){
    if($this->_validateCredentials($credentials)){
      $this->session->set_userdata([

      ]);
    }

  }


}
