<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['login'] = 'login';
$route['dashboard'] = 'dashboard';

// ----------------------------
// Route LAYANAN
$route['layanan'] = 'welcome/layanan';              
$route['layanan/(:num)'] = 'welcome/layanan/$1';    
$route['layanan/search'] = 'welcome/search_layanan';
$route['layanan/search/(:any)'] = 'welcome/search_layanan/$1';
$route['layanan/(:any)'] = 'welcome/layanan_single/$1';
$route['layanan/kategori/(:any)'] = 'welcome/kategori_layanan/$1';
$route['layanan/kategori/(:any)/(:num)'] = 'welcome/kategori_layanan/$1/$2';
$route['layanan/kategori/(:any)'] = 'welcome/kategori_layanan/$1';  

// ----------------------------
// Route BLOG / ARTIKEL
$route['blog'] = 'welcome/blog';
$route['blog/(:num)'] = 'welcome/blog/$1';
$route['kategori/(:any)'] = 'welcome/kategori/$1';
$route['kategori/(:any)/(:num)'] = 'welcome/kategori/$1/$2';
$route['search'] = 'welcome/search';
$route['search/(:any)'] = 'welcome/search/$1';
$route['search/(:any)/(:num)'] = 'welcome/search/$1/$2';

// ----------------------------
// Route PAGE
$route['page/(:any)'] = 'welcome/page/$1';

// ----------------------------
// 404 dan default lainnya
$route['404_override'] = 'welcome/notfound';
$route['translate_uri_dashes'] = FALSE;

// Pastikan route notfound didefinisikan sebelum SEO SLUG artikel
$route['notfound'] = 'welcome/notfound';

// ----------------------------
// Route SEO SLUG artikel
$route['(:any)'] = 'welcome/single/$1';
