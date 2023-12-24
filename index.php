<?php
session_start();
ob_start();
use Vannghia\PetCare\Mvc\Models\User;
require "./vendor/autoload.php";
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');    
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
}   
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//         header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
//     if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//         header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

//     exit(0);
// } 
// session_destroy();
$uri = $_SERVER['REQUEST_URI'];

 include "./src/routes.php";

 if(!$_SESSION['user_id'] && $uri != '/login' && $uri !='/api/login' && $uri != '/api/register' )
 {
    header("Location: /login");
 }

$route->handle($uri);