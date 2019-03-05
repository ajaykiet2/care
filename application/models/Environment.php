<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on environment
#======================================================

class Environment extends CI_Model{
	public $adminSession = null;
	public function __construct(){
		parent::__construct();
		$this->adminSession = $this->session->userdata("adminSession");
	}

	#Settingup the breadcrumb
	public function setBreadcrumb($data){
		$this->session->set_userdata($data);
	}

	private function _getAllMenus(){
		return array(
			(object) array(
				'name' => 'Dashboard',
				'link' => 'dashboard',
				'icon' => 'now-ui-icons design_app',
				'status' => 'active',
				'sub_menus' => array()
			),
			(object) array(
				'name' => 'Donees',
				'link' => 'donees',
				'icon' => 'now-ui-icons business_badge',
				'status' => 'active',
				'sub_menus' => array()
			),
			(object) array(
				'name' => 'Donors',
				'link' => 'donors',
				'icon' => 'now-ui-icons users_single-02',
				'status' => 'active',
				'sub_menus' => array()
			),
			(object) array(
				'name' => 'Transactions',
				'link' => 'transactions',
				'icon' => 'now-ui-icons design_bullet-list-67',
				'status' => 'active',
				'sub_menus' => array()
			),
			(object) array(
				'name' => 'Admins',
				'link' => 'admins',
				'icon' => 'now-ui-icons users_circle-08',
				'status' => 'active',
				'sub_menus' => array()
			),
			(object) array(
				'name' => 'Logout',
				'link' => 'logout',
				'icon' => 'now-ui-icons media-1_button-power',
				'status' => 'active',
				'sub_menus' => array()
			)
		);
	}

	public function getMenus(){
		$menus = $this->_getAllMenus();
		array_walk($menus, function(&$menu){
			$menu->status = ($this->session->userdata('active_manu') == $menu->link) ? "active" : "";
		});
		return $menus;
	}

}
