<?php

use Vannghia\PetCare\Mvc\Controllers\ApiController;
use Vannghia\PetCare\Mvc\Controllers\UserController;
use Vannghia\PetCare\Router;

$route = new Router();
$route->addRoutes('/',UserController::class,'index');
$route->addRoutes('/login', UserController::class, 'without_login');

$route->addRoutes('/api/register', ApiController::class, 'registerUser');
$route->addRoutes('/api/login', ApiController::class, 'login');
$route->addRoutes('/logout', UserController::class,'logout');
