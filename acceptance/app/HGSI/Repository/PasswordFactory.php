<?php 

namespace HGSI\Repository;

use HGSI\Library\Password;

class PasswordFactory {

    public static function create($interface){
     return new Password($interface);   
    }
}
