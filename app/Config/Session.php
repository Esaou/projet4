<?php

declare(strict_types=1);

namespace App\Config;

class Session{

    private $session;

    public function __construct(){
        if(!isset($_SESSION)){

            session_start();

        }
        $this->session = $_SESSION;
    }

    public function set(string $name,string $value){
        $_SESSION[$name] = $value;
    }

    public function get(string $name){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }

}