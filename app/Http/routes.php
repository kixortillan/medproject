<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('diseases', 'Core\DiseaseController@index');
$app->get('diseases/{id}', 'Core\DiseaseController@index');
$app->post('diseases', 'Core\DiseaseController@store');
$app->patch('diseases/{id}', 'Core\DiseaseController@edit');
$app->delete('diseases/{id}', 'Core\DiseaseController@delete');

$app->get('departments', 'Core\DepartmentController@index');
$app->get('departments/{id}', 'Core\DepartmentController@index');
$app->get('departments/{id}/diseases', 'Core\DepartmentController@index');
$app->get('departments/{id}/diseases/{diseaseId}', 'Core\DepartmentController@index');
$app->post('departments', 'Core\DepartmentController@store');
$app->patch('departments/{id}', 'Core\DepartmentController@edit');
$app->delete('departments/{id}', 'Core\DepartmentController@delete');

$app->get('patients', 'Core\PatientController@index');
$app->get('patients/{id}', 'Core\PatientController@index');
$app->post('patients', 'Core\PatientController@store');
$app->patch('patients/{id}', 'Core\PatientController@edit');
$app->delete('patients/{id}', 'Core\PatientController@delete');