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
    return $this->db->get_where("admin", $option)->row();
  }

  #Getting raw Password
  private function _getPassword($username){
    $query = $this->db->get_where("admin",["username" => $username, "status" => "active"]);
    return $query->row();
  }

  # Checking Credentials with strong security
  private function _validateCredentials($credentials){
    if(empty($credentials->username) || empty($credentials->password)) return false;
    $admin = $this->_getPassword($credentials->username);
    $decodedPassword = $this->encrypt->decode($admin->password);
    return $credentials->password == $decodedPassword;
  }

  public function isLocked(){
    if($this->session->has_userdata("locked")){
      return $this->session->userdata("locked");
    }
    return false;
  }

  public function isLoggedIn(){
    if($this->session->has_userdata("adminSession")){
      $adminSession = $this->session->userdata("adminSession");
      return $adminSession->logged_in ? true : false;
    }else{
      return false;
    }
  }

  public function isExists($email_id){
    $admin = $this->db->get_where("admin", ["email" => $email_id])->row();
    return !empty($admin) ? true : false;
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
        "message" => "Successfully logged in"
      ];
    }else{
      return (object)[
        "status" => false,
        "message" => "Incorrect username or password!"
      ];
    }
  }

  public function sendResetPasswordLink($email_id){
    $admin = $this->get(["email" => $email_id]);
    $token = $this->encrypt->encode($admin->id.date("Y-m-d H:i:s"));
    if($this->update($admin->id,["resetTokens" => $token, "resetTime" => date("Y-m-d H:i:s")])){
      $resetLink = base_url("reset-password/{$token}");
      $emailContents = $this->load->view("emails/reset_password",["resetLink"=>$resetLink], true);
      $settings = $this->config->item('emailSettings');
      $this->load->library('email');
      $this->email->initialize($settings);
      $this->email->from('ajayratm22@gmail.com', 'Care');
      $this->email->to($email_id);
      $this->email->subject('Password Reset Link');
      $this->email->message($emailContents);
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");
      try{
        if($this->email->send()){
          return true;
        }
        return false;
      }catch(Exception $e){
        return false;
      }
    }else{
      return false;
    }
  }

  public function validateToken($token){
    $this->db->where("resetTokens", $token);
    $this->db->where("resetTime >=", date("Y-m-d H:i:s",strtotime("-15 minute")));
    $admin = $this->db->get("admin")->row();
    if(!empty($admin)){
      $admin->status = true;
      return $admin;
    }else{
      return (object)["status" => false,"message" => "Invalid or expired tokens"];
    }
  }

  public function logout(){
    $this->session->sess_destroy();
    return true;
  }

  public function add($admin){
    return $this->db->insert("admin",$admin);
  }

  public function update($id, $data){
    $this->db->where("id",$id);
    return $this->db->update("admin",$data);
  }

  public function delete($id){
    $this->db->where("id",$id);
    return $this->db->delete("admin");
  }

  public function changePasword($token, $password){
    if($this->session->has_userdata("dataToReset")){
      $admin = $this->session->userdata("dataToReset");
      if($admin->resetTokens === $token){
        $saltedPassword = $this->encrypt->encode($password);
        $data = ["password" => $saltedPassword, "resetTokens" => "", "resetTime" => ""];
        if($this->update($admin->id,$data)){
          $this->session->unset_userdata('dataToReset');
          return (object)[
            "status" => true,
            "message" => "Password has been changed successfully"
          ];
        }else{
          return (object)[
            "status" => false,
            "message" => "Sorry! Unable to change password"
          ];
        }
      }else{
        return (object)[
          "status" => false,
          "message" => "Oops! Invalid tokens found!"
        ];
      }
    }else{
      return (object)[
        "status" => false,
        "message" => "Forgery request found!"
      ];
    }
  }


}
