<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\News; // Importing News class
use App\Controllers\Pages;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('news', [News::class, 'index']);        
$routes->get('news/new', [News::class, 'new']); 
$routes->post('news/new', [News::class, 'new']); 
$routes->post('news', [News::class, 'create']); 
$routes->get('/news/success', 'News::success');

$routes->get('news/(:segment)', [News::class, 'show']); 
$routes->post('news/delete', 'News::delete');

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
