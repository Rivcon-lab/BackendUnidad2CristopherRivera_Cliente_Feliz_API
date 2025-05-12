<?php

// Configuración de headers para CORS y tipo de contenido
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Rutas para Usuarios
$router->get('/usuarios', 'UsuarioController@index');
$router->get('/usuarios/{id}', 'UsuarioController@show');
$router->post('/usuarios', 'UsuarioController@store');
$router->put('/usuarios/{id}', 'UsuarioController@update');
$router->patch('/usuarios/{id}', 'UsuarioController@patch');
$router->delete('/usuarios/{id}', 'UsuarioController@destroy');

// Rutas para Ofertas Laborales
$router->get('/ofertas', 'OfertaController@index');
$router->get('/ofertas/{id}', 'OfertaController@show');
$router->post('/ofertas', 'OfertaController@store');
$router->put('/ofertas/{id}', 'OfertaController@update');
$router->patch('/ofertas/{id}', 'OfertaController@patch');
$router->delete('/ofertas/{id}', 'OfertaController@destroy');

// Rutas para Postulaciones
$router->get('/postulaciones', 'PostulacionController@index');
$router->get('/postulaciones/{id}', 'PostulacionController@show');
$router->post('/postulaciones', 'PostulacionController@store');
$router->put('/postulaciones/{id}', 'PostulacionController@update');
$router->patch('/postulaciones/{id}', 'PostulacionController@patch');
$router->delete('/postulaciones/{id}', 'PostulacionController@destroy');

// Rutas para Antecedentes Académicos
$router->get('/academicos', 'AntecedenteAcademicoController@index');
$router->get('/academicos/{id}', 'AntecedenteAcademicoController@show');
$router->post('/academicos', 'AntecedenteAcademicoController@store');
$router->put('/academicos/{id}', 'AntecedenteAcademicoController@update');
$router->patch('/academicos/{id}', 'AntecedenteAcademicoController@patch');
$router->delete('/academicos/{id}', 'AntecedenteAcademicoController@destroy');

// Rutas para Antecedentes Laborales
$router->get('/laborales', 'AntecedenteLaboralController@index');
$router->get('/laborales/{id}', 'AntecedenteLaboralController@show');
$router->post('/laborales', 'AntecedenteLaboralController@store');
$router->put('/laborales/{id}', 'AntecedenteLaboralController@update');
$router->patch('/laborales/{id}', 'AntecedenteLaboralController@patch');
$router->delete('/laborales/{id}', 'AntecedenteLaboralController@destroy'); 