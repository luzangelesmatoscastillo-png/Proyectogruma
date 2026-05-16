<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* PRODUCTOS */
$route['productos'] = 'productos/index';

/* CARRITO */
$route['productos/carrito'] = 'productos/carrito';

$route['productos/agregar_carrito'] = 'productos/agregar_carrito';

$route['productos/eliminar_carrito'] = 'productos/eliminar_carrito';

$route['productos/actualizar_cantidad'] = 'productos/actualizar_cantidad';