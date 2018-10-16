<?php

class Command extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model(["admin","donee","donor"]);
  }

  public function run(){
    # code for cronjobs and backend scripts
  }
}
