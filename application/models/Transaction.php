<?php
require_once("Datatable.php");
class Transaction extends CI_Model{
  use Datatable;
  var $table = '(SELECT transaction.*, donor.name FROM transaction
  INNER JOIN donor USING(donor_id))tempTable';
  var $column_order = array('name','mobile','email','address','status','created_date');
  var $column_search = array('name','mobile','email','address','status');
  var $order = array('name' => 'asc');

  public function __construct(){
    parent::__construct();
  }

  public function get($txn_number){
    return $this->db->get_where("transaction",["txn_number"=>$txn_number])->row();
  }

  public function createTransaction($transaction){
    return $this->db->insert("transaction",$transaction);
  }

  public function updateTransaction($txn_number, $data){
    $this->db->where("txn_number",$txn_number);
    return $this->db->update("transaction", $data);
  }

}
