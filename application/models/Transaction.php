<?php
require_once("Datatable.php");
class Transaction extends CI_Model{
  use Datatable; 
  var $table = '(SELECT 
    txn.*, 
    donor.name as donor, 
    donee.name as donee 
  FROM transaction txn 
  LEFT JOIN donor ON txn.donor_id = donor.id 
  LEFT JOIN donee ON txn.donee_id = donee.id)tempTable';
  var $column_order = array('id','donee','donor','amount','status','transaction_date');
  var $column_search = array('donee','donor');
  var $order = array('id' => 'desc');

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

  public function countTransactions($params){
    if(!empty($params)){
      foreach($params as $col => $val){
        $this->db->where($col,$val);
      }
    }
    return $this->db->get("transaction")->num_rows();
  }

  public function getRevenue(){
    $this->db->select("SUM(amount) as revenue")
      ->where("status","success");
    return  $this->db->get("transaction")->row()->revenue;
  }

}
