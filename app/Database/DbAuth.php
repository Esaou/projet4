<?php

declare(strict_types=1);

namespace App\Database;

use \PDO;

class DbAuth{

    private $db;
    private $request;

    public function __construct(Database $db){

        $this->request = new \App\Config\Request();
        $this->db = $db;

    }

    public function login(string $username,string $password):bool{

        $instance = new \App\Models\Blog();
        $user = $instance->login($username);
        if($user){

            if($user->password === sha1($password)){

                $this->request->getSession()->set('auth',$user->id);
                return true;

            }    

       }
       return false;

    }

    public static function logged():bool{

        $request = new \App\Config\Request();
        $isConnect = $request->getSession()->get('auth');
        return isset($isConnect);

    }

    public static function disconnect(){

        $request = new \App\Config\Request();
        $isConnect = $request->getSession()->get('auth');
        $isToken = $request->getSession()->get('token');
        if(isset($isConnect)){

            unset($isToken);
            session_destroy();


        }

    }

    public static function getUserId(){

        $request = new \App\Config\Request();
        $isConnect = $request->getSession()->get('auth');

        if(static::logged()){

            return $isConnect;

        }

        return false;

    }
}
