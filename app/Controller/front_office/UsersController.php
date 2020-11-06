<?php

declare(strict_types=1);

namespace App\Controller\front_office;

use \App;

class UsersController extends AppController{

    public function login():void{

        $instance = new App\Models\Blog();
        $instance->getLogin();

    }

}