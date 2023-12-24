<?php
namespace Vannghia\PetCare\Mvc\Controllers;
use Vannghia\PetCare\Database\QueryBuilder;
use Vannghia\PetCare\Mvc\BaseController;
use Vannghia\PetCare\Mvc\Models\User;

class UserController extends BaseController{
    public function index(){
        $name = $_SESSION['user_name'];
        $this->render('User/index', [$name]);
    }
    public function without_login(){
        $this->render('User/without_login');
    }
    public function logout(){
        $_SESSION['user_id'] = null;
        header("Location: /login");
    }




}