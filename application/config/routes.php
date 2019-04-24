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
$route['default_controller'] = 'Frontabsensi';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['masuk'] = 'Login/masuk';
$route['keluar'] = 'Login/keluar';

//
$route['front-absensi'] = 'Frontabsensi';

// backend admin
$route['admin-login'] = 'Login';

// cDivisi
$route['alldivisi'] = 'Divisi/AllDivisi';
$route['divisibyid'] = 'Divisi/DivisiByID';
$route['insertdivisi'] = 'Divisi/insertDivisi';
$route['deletedivisi'] = 'Divisi/deleteDivisi';
$route['updatedivisi'] = 'Divisi/updateDivisi';

// cjabatan
$route['alljabatan'] = 'Jabatan/AllJabatan';
$route['jabatanbyid'] = 'Jabatan/JabatanByID';
$route['insertjabatan'] = 'Jabatan/insertJabatan';
$route['deletejabatan'] = 'Jabatan/deleteJabatan';
$route['updatejabatan'] = 'Jabatan/updateJabatan';

// form_absensi
$route['absensitoday'] = 'Formabsensi/absensiToday';
$route['absensi'] = 'Formabsensi/absensi';

// form_cuti
$route['getallcuti'] = 'Formcuti/getAllCuti';
$route['insertcuti'] = 'Formabsensi/insert';
$route['approvalcuti'] = 'Formcuti/statusApproval';
$route['hapuscuti'] = 'Formcuti/hapusCuti';
$route['absensi'] = 'Formabsensi/absensi';

// backend Pegawai
$route['pegawai-dashboard'] = 'pegawai_backend/Pegawaidashboard';
$route['pegawai-inbox']     = 'pegawai_backend/Pegawaiinboxcuti';
$route['pegawai-kehadiran'] = 'pegawai_backend/Pegawaikehadiran';
$route['pegawai-permohonan-cuti'] = 'pegawai_backend/Pegawaipermohonancuti/buat';
$route['pegawai-login'] = 'pegawai_backend/Pegawailogin';
$route['pegawai-logout'] = 'pegawai_backend/Pegawailogin/logout';
$route['pegawai-generate-qrcode'] = 'pegawai_backend/Pegawaidashboard/gerateQrCode';
$route['download-file'] = 'pegawai_backend/Pegawaiinboxcuti/download';
