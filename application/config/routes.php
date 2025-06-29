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
// Route PORTFOLIO
$route['portfolio'] = 'welcome/portfolio';
$route['portfolio/(:num)'] = 'welcome/portfolio/$1';
$route['portfolio/kategori/(:any)'] = 'welcome/kategori_portfolio/$1';
$route['portfolio/kategori/(:any)/(:num)'] = 'welcome/kategori_portfolio/$1/$2';
$route['portfolio/search'] = 'welcome/search_portfolio';
$route['portfolio/search/(:any)'] = 'welcome/search_portfolio/$1';

$route['portfolio/(:any)'] = 'welcome/portfolio_single/$1';

// ----------------------------
// Route PAGE
$route['page/(:any)'] = 'welcome/page/$1';

// ----------------------------
// Route TESTIMONIAL
$route['testimonial'] = 'welcome/testimonial';

// ----------------------------
// Route KONTAK
$route['kontak'] = 'welcome/kontak';
$route['kirim-pesan'] = 'welcome/kirim_pesan';
$route['dashboard/kontak'] = 'dashboard/kontak';

// ----------------------------
// Route Client Logo
$route['dashboard/client_logo'] = 'dashboard/client_logo';
$route['dashboard/client_logo_tambah'] = 'dashboard/client_logo_tambah';
$route['dashboard/client_logo_aksi'] = 'dashboard/client_logo_aksi';
$route['dashboard/client_logo_hapus/(:num)'] = 'dashboard/client_logo_hapus/$1';


// ----------------------------
// 404 dan default lainnya
$route['404_override'] = 'welcome/notfound';
$route['translate_uri_dashes'] = FALSE;

// Pastikan route notfound didefinisikan sebelum SEO SLUG artikel
$route['notfound'] = 'welcome/notfound';

// ----------------------------
// Route SEO SLUG artikel
$route['(:any)'] = 'welcome/single/$1';
