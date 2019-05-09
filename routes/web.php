<?php

use App\Controllers\HomeController;
use App\Controllers\RadioController;

$app->get('/', HomeController::class . ':index');
$app->post('/api/create', RadioController::class . ':addModel');
$app->get('/api/list', RadioController::class . ':listModel');
$app->post('/api/update', RadioController::class . ':updateModel');
$app->post('/api/delete', RadioController::class . ':deleteModel');

