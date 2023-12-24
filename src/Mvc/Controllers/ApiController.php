<?php

namespace Vannghia\PetCare\Mvc\Controllers;
session_start();
ob_start();
use Vannghia\PetCare\Mvc\Models\User;
use Vannghia\PetCare\Mvc\BaseController;
class ApiController extends BaseController{

    public function registerUser(){
        $data = json_decode(file_get_contents('php://input'), true);
    
        $records = [
            'first_name' => $data['first_name'], 
            'last_name' => $data['last_name'],
            'birthday' => date('Y-m-d', strtotime($data['birthday'])),
            'email'=> $data['email'],
            'gender' => $data['gender'],
            'password' => md5($data['password']),
        ];
        $user = new User();
      $result =   $user->insert($records);
      if($result){
        $data = [
            'status' => 'success',
            'message' => "Dang ky thanh cong",
        ];
      }else{
        $data = [
            'status' => 'false',
            'message' => "Khong the dang ky",
        ];
      }
    
        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($data);
    }

    public function login()
    {
      $data = json_decode(file_get_contents('php://input'), true);
      $user = new User();
      $test = $user->where([['email', '=',$data['email']]])->get();
      if($test)
      {
      
        header('Content-Type: application/json; charset=utf-8');

         echo json_encode(['status' =>'success']);
         $_SESSION['user_id'] = 100;
         $_SESSION['user_name'] = $test[0]['first_name'] . ' ' . $test[0]['last_name'];

      }
      else{
                header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['status' => 'fail', 'error' => "Tai khoan chua duoc dang ky tren he thong!"]);

      }
 
   
     



    }
}