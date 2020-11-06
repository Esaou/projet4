<?php

declare(strict_types=1);

namespace App\Controller\front_office;

use App;

class PostsController extends App\Controller\front_office\AppController {

    public function index():void{

        $instance = new App\Models\Blog();
        $instance->getIndex();

    }

    public function liste():void{

        $instance = new App\Models\Blog();
        $instance->getListe();
        
    }
    
    public function show():void{
        
        $instance = new App\Models\Blog();
        $instance->getShow();
        
    }

    public function signalement():void{

        $instance = new App\Models\Blog();
        $instance->getSignalement();

    }

    public function notFound():void{


        $this->render('front_office.notFound');

    }

    public function forbidden():void{

        $this->render('front_office.forbidden');

    }

}