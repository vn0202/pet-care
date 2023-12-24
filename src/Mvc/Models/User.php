<?php
namespace Vannghia\PetCare\Mvc\Models;

use Vannghia\PetCare\Database\QueryBuilder;

class User extends QueryBuilder{
    protected $table = 'users';

    public function isRegister(){
        
    }
}