<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#======================================================
# This module will oprate the actions on environment
#======================================================

class Environment extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		// $this->load->model(array("permission",'walletAdmin','notification'));
	}

	// public function get(){
	// 	$admin_id = $this->encrypt->decode($this->session->userdata('admin_id'));
	// 	$data = (object)array(
	// 		'session' => $this->session->userdata(),
	// 		'permissions' => $this->permission->myPermissions(),
	// 		'adminInfo' => $this->walletAdmin->get(array('admin_id' => $admin_id)),
	// 		'notifications' => $this->notification->get(array('conditions' => array("status"=>'unread')))
	// 	);
	// 	return $data;
	// }
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
				'name' => 'Admins',
				'link' => 'admins',
				'icon' => 'now-ui-icons users_circle-08',
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
				'name' => 'Reports',
				'link' => 'reports',
				'icon' => 'now-ui-icons files_single-copy-04',
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
				'name' => 'Settings',
				'link' => 'settings',
				'icon' => 'now-ui-icons education_atom',
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
		// $myPermissions = $this->permission->myPermissions();
		// $menus = $this->filterMenues($allMenus,$myPermissions);
		return $menus;
	}

}
