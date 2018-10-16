<?php
require_once("Datatable");
class Transaction extends CI_Model{
  use Datatable;

  public function __construct(){
    parent::__construct();
  }

  public function get($transaction_id){
    return $this->db->get_where("transaction",["transaction_id"=>$transaction_id])->row();
  }


}
