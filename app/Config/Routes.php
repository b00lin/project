<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// The second route does a GET request to the /pages and will map it to the /index method of the pages class.
$routes->get('pages', [Pages::class, 'index']);
// Third rule does a GET request using the segment placeholder. Passes to the view() method of the pages class.
$routes->get('(:segment)', [Pages::class, 'view']);
