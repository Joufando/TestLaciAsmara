<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); // Halaman utama
$routes->get('/pages', 'Pages::index'); // Halaman daftar halaman
$routes->get('/pages/about', 'Pages::about'); // Halaman tentang

// Rute untuk operasi CRUD pengguna
$routes->get('/user', 'User::index');
$routes->get('/user/create', 'User::create');
$routes->post('/user/store', 'User::store');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/update', 'User::update');
$routes->get('/user/delete/(:num)', 'User::delete/$1');
$routes->get('/user/search', 'User::search');



// Test Database Connection
$routes->get('/test', 'Test::index');
