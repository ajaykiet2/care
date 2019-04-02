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
  LEFT JOIN donee ON txn.donee_id = donee.id
  WHERE txn.status != "initiated")tempTable';
  var $column_order = array(null,'id','donee','donor','amount','payment_type','payment_mode','status','transaction_date');
  var $column_search = array('id','donee','donor');
  var $order = array('id' => 'desc');

  public function __construct(){
    parent::__construct();
  }

  public function get($txn_id){
    return $this->db->get_where("transaction",["id"=>$txn_id])->row();
  }

  public function generateTxnID(){
    $uniqueID = "TXN".date("ym").str_pad(mt_rand(10000,99999),9,"0",STR_PAD_LEFT);
    $exists   = $this->db->get_where("transaction",array("id",$uniqueID))->num_rows();
    if($exists) return $this->generateTxnID();
    return $uniqueID;
  }

  public function createTransaction($transaction){
    $txn_id = $this->generateTxnID();
    if(is_array($transaction)) $transaction["id"] = $txn_id;
    else $transaction->id = $txn_id;

    if($this->db->insert("transaction",$transaction)) return $txn_id;
    else return null;
  }

  public function updateTransaction($txn_id, $data){
    $this->db->where("id",$txn_id);
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
