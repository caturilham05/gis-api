<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

// admin login API
$route['api/admin/auth'] = 'api/admin/user_c/cek_login';
// USER login API
$route['api/admin/auth-user'] = 'api/admin/user_c/auth_login_user';

// API USER
$route['api/admin/get-user'] = 'api/admin/user_c/get_user';
$route['api/admin/add-user'] = 'api/admin/user_c/add_user';
$route['api/admin/edit-user'] = 'api/admin/user_c/edit_user';
$route['api/admin/delete-user'] = 'api/admin/user_c/hapus_user';


// API DESA
$route['api/admin/get-desa'] = 'api/admin/data_all_c/desa';
// API UPT
$route['api/admin/get-upt'] = 'api/admin/data_all_c/upt';
// API OPD
$route['api/admin/get-opd'] = 'api/admin/data_all_c/opd';


// GET API DETAIL PENGADUAN
$route['api/admin/get-pengaduan'] = 'api/admin/pengaduan_c/pengaduanAll';
// GET API STATUS BELUM DIATASI
$route['api/admin/get-status'] = 'api/admin/pengaduan_c/status';
// GET API STATUS SELESAI DIATASI
$route['api/admin/get-status-selesai'] = 'api/admin/pengaduan_c/statusSelesai';

// POST API PENGADUAN USER
$route['api/admin/add-pengaduan'] = 'api/admin/pengaduan_c/addPengaduan';
// PUT API PENGADUAN USER
$route['api/admin/edit-pengaduan'] = 'api/admin/pengaduan_c/edit_pengaduan';
// DELETE API PENGADUAN USER
$route['api/admin/delete-pengaduan'] = 'api/admin/pengaduan_c/hapus_pengaduan';







$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
