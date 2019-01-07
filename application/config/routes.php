<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

#============= Admin Routes ================
$route['login'] = 'login/login';
$route['logout'] = 'login/logout';
$route['reset-password/(:any)'] = 'login/resetPassword/$1';
$route['dashboard'] = 'dashboard';
$route['admins'] = "admin/AdminController";
$route['donees'] = "admin/AdminController/donees";
$route['donors'] = "admin/AdminController/donors"; 
$route['users'] = "admin/AdminController/users";
$route['transactions'] = "admin/AdminController/transactions";
$route['about-us'] = "admin/AdminController/companyProfile";
$route['add_new_donee'] = "admin/AdminController/addDonee";
$route['update_donee/(:any)'] = "admin/AdminController/updateDonee/$1";

#============== Ajax Requests ================
$route['admin/ajax/getAdmins'] = 'admin/ajax/getAdmins';
$route['admin/ajax/getDonees'] = 'admin/ajax/getDonees';
$route['admin/ajax/addDonee'] = 'admin/ajax/addDonee';
$route['admin/ajax/getDonors'] = 'admin/ajax/getDonors';
$route['admin/ajax/doneeActions'] = "admin/ajax/doneeActions";
$route['admin/ajax/getRevenueCart'] = 'admin/ajax/getRevenueCartData';
$route['admin/ajax/getAggregationData'] = 'admin/ajax/getAggregationData';
$route['admin/ajax/forgotPassword'] = 'admin/ajax/forgotPassword';
$route['admin/ajax/resetPassword'] = 'admin/ajax/resetPassword';

#============== API Requests ===================
$route['api/login']["post"] = 'api/api/login';
$route['api/requestOTP']["post"] = 'api/api/requestOTP';
$route['api/addDonor']["post"] = 'api/api/addDonor';
$route['api/completeTransaction']['post'] = 'api/api/completeTransaction';


#============= API Routes ==============

$route['default_controller'] = 'login';
$route['404_override'] = 'login/not_found';
$route['translate_uri_dashes'] = FALSE;
