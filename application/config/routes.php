<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// menu beranda
$route['tatacara'] = 'beranda/tatacara';
$route['pedoman'] = 'beranda/pedoman';
$route['tentang'] = 'beranda/tentang';
$route['manfaat'] = 'beranda/manfaat';
$route['bantuan'] = 'beranda/bantuan';

$route['notifikasi'] = 'notifikasi';
$route['notifikasi/(:num)'] = 'notifikasi/read/$1';
$route['notifikasi/(:num)/dilihat'] = 'notifikasi/tandai/$1';

// user
$route['profil'] = 'user/profil';
$route['updateprofil'] = 'user/updateprofil';
$route['updatesandi'] = 'user/updatesandi';

// penilaian
$route['penilaian']['get'] = 'penilaian/index';
$route['penilaian/nilai/(:num)/(:num)']['get'] = 'penilaian/nilaipegawai/$1/$2';
$route['penilaian/nilai/(:num)/(:num)']['post'] = 'penilaian/nilaipegawai/$1/$2';
$route['penilaian/(:num)/lihat']['get'] = 'penilaian/result/$1';

// grafik
$route['grafik/pegawai/(:num)']['get'] = 'penilaian/grafik_pegawai/$1';

$route['riwayat'] = 'penilaian/riwayat';
$route['riwayat/hapus'] = 'penilaian/hapus';

// auth
$route['login']['get'] = 'auth/login_page';
$route['login']['post'] = 'auth/login_proc';
$route['logout']['get'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['forgot_password'] = 'auth/forgot_password';
$route['password_reset_pin'] = 'auth/password_reset_pin';
$route['password_reset_request'] = 'auth/password_reset_request';
$route['new_password'] = 'auth/new_password';

$route['admin/dashboard'] = 'admin';
$route['dinas_jabatan'] = 'organisasi/dinas_jabatan';

// dinas
$route['dinas/tambah'] = 'organisasi/dinas_tambah';
$route['dinas/hapus'] = 'organisasi/dinas_hapus';
$route['dinas/(:num)/edit'] = 'organisasi/dinas_edit/$1';
// jabatan
$route['jabatan/tambah'] = 'organisasi/jabatan_tambah';
$route['jabatan/hapus'] = 'organisasi/jabatan_hapus';
$route['jabatan/(:num)/edit'] = 'organisasi/jabatan_edit/$1';

// = pegawai
$route['pegawai'] = 'organisasi/pegawai';
$route['pegawai/import'] = 'organisasi/pegawai_import';
$route['pegawai/import/file'] = 'organisasi/pegawai_import_file';
$route['pegawai/hapus'] = 'organisasi/pegawai_delete';
$route['pegawai/(:num)/edit'] = 'organisasi/pegawai_edit/$1';

// faktor
$route['faktor'] = 'penilaian/faktor_index';
$route['faktor/(:num)/edit'] = 'penilaian/faktor_edit/$1';
$route['faktor/hapus'] = 'penilaian/faktor_hapus';
$route['faktor/tambah'] = 'penilaian/faktor_tambah';

// jadwal
$route['jadwal'] = 'penilaian/jadwal';
$route['jadwal/(:num)'] = 'penilaian/jadwal_lihat/$1';
$route['jadwal/tambah'] = 'penilaian/jadwal_tambah';
$route['jadwal/hapus'] = 'penilaian/jadwal_hapus';
$route['jadwal/(:num)/edit'] = 'penilaian/jadwal_edit/$1';
$route['jadwal/selesai'] = 'penilaian/jadwal_selesai';

// notifikasi
$route['pengaturan_notifikasi'] = 'notifikasi/pengaturan_index';
$route['notifikasi/new'] = 'notifikasi/new';
$route['notifikasi/(:num)/edit'] = 'notifikasi/edit/$1';
