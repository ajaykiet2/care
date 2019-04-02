<?php
class Report extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->model(["transaction","donee","donor"]);
  }

  public function getRevenueChart(){
    $sql = "SELECT 
      SUM(amount) as revenue, 
      date_format(DATE(transaction_date),'%Y-%m') as month 
    FROM transaction 
    WHERE status = 'success' 
    GROUP BY date_format(DATE(transaction_date),'%Y-%m') 
    ORDER BY date_format(DATE(transaction_date),'%Y-%m') DESC LIMIT 12";
    $txns = $this->db->query($sql)->result();
    $end = strtotime(date("Y-m"));
    $start = strtotime(date("Y-m")." -11 months");
    $resultIndex = 0;
    $result = [];
    while($end >= $start){
      $month = date("M Y",$end);
      if(!isset($txns[$resultIndex])){
        array_unshift($result,["month" => $month, "revenue" => 0]);
      }elseif($end == strtotime($txns[$resultIndex]->month)){
        array_unshift($result,["month" => $month, "revenue" => $txns[$resultIndex]->revenue]);
        $resultIndex++;
      }else{
        array_unshift($result,["month" => $month, "revenue" => 0]);
      }
      $end = strtotime(date("Y-m",$end)." -1 month");
    }
    return $result;
  }

  public function getAggregationData(){
    $sql = "SELECT 
      (SELECT COUNT(*) FROM donee WHERE status = 'active') as total_donees,
      (SELECT COUNT(*) FROM donor WHERE status = 'active') as total_donors,
      (SELECT COUNT(*) FROM transaction WHERE status = 'success') as total_txns,
      (SELECT SUM(amount) FROM transaction WHERE status = 'success') as total_revenue
    FROM donee limit 1";
    $aggregation = $this->db->query($sql)->row();

    return array(
      "donees" => $aggregation->total_donees,
      "donors" => $aggregation->total_donors,
      "transactions" => $aggregation->total_txns,
      "total_revenue" => $aggregation->total_revenue,
    );
  }

  public function getDonerRegistrationChart(){
    $sql = "SELECT 
      COUNT(id) as number, 
      date_format(date(created_date),'%Y-%m') as month 
    FROM donor 
    GROUP BY date_format(date(created_date),'%Y-%m') 
    ORDER BY date_format(date(created_date),'%Y-%m') ASC 
    LIMIT 12 ";
    $txns = $this->db->query($sql)->result();
    $start = strtotime(date("Y-m"));
    $end = strtotime(date("Y-m")." - 11 months");
    $resultIndex = 0;
    $result = [];
    while($end <= $start){
      if($end == strtotime($txns[$resultIndex]->month)){
        $month = date("M Y",strtotime($txns[$resultIndex]->month));
        array_push($result,["month" => $month, "count" => $txns[$resultIndex]->number]);
        $resultIndex++;
      }else{
        $month = date("M Y",$end);
        array_push($result,["month" => $month, "count" => 0]);
      }
      $end = strtotime(date("Y-m",$end)." + 1 month");
    }
    return $result;
  }
}
