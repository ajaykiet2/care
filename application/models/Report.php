<?php
class Report extends CI_Model{
  public function __construct(){}

  public function getRevenueChart(){
    return array(
      ["month" => "JAN 2018", "revenue" => "23"],
      ["month" => "FEB 2018", "revenue" => "12"],
      ["month" => "MAR 2018", "revenue" => "28"],
      ["month" => "APR 2018", "revenue" => "18"],
      ["month" => "MAY 2018", "revenue" => "33"],
      ["month" => "JUN 2018", "revenue" => "12"],
      ["month" => "JUL 2018", "revenue" => "23"],
      ["month" => "AUG 2018", "revenue" => "19"],
      ["month" => "SEP 2018", "revenue" => "30"],
      ["month" => "OCT 2018", "revenue" => "23"],
      ["month" => "NOV 2018", "revenue" => "29"],
      ["month" => "DEC 2018", "revenue" => "13"]
    );
  }

  public function getAggregationData(){
    return array(
      "donees" => 223,
      "donors" => 5643,
      "transactions" => 1323,
      "total_revenue" => 2323345
    );
  }
}
