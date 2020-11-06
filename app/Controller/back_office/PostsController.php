<?php

declare(strict_types=1);

namespace App\Controller\back_office;

use \App;

class PostsController extends AppController {

    public function __construct(){

        parent::__construct();

    }

    public function index():void{

        $instance = new App\Models\BlogManager();
        $instance->getIndex();

    }

    public function comment():void{

        $instance = new App\Models\BlogManager();
        $instance->getComment();

    }

    public function commentSignal():void{

        $instance = new App\Models\BlogManager();
        $instance->getCommentSignal();

    }

    public function add():void{

        $instance = new App\Models\BlogManager();
        $instance->getAdd();
        
    }

    public function edit():void{

        $instance = new App\Models\BlogManager();
        $instance->getEdit();
        
    }

    public function profil():void{

        $instance = new App\Models\BlogManager();
        $instance->getProfil();
        
    }

    public function delete():void{
        
        $instance = new App\Models\BlogManager();
        $instance->getDelete();

    }

    public function deleteComment():void{

        $instance = new App\Models\BlogManager();
        $instance->getDeleteComment();

    }

    public function deleteSignalement():void{

        $instance = new App\Models\BlogManager();
        $instance->getDeleteSignalement();
        
    }

    public function deconnecter():void{

        $auth = new App\Database\DbAuth(App\App::getInstance()->getDb());
        $auth->disconnect();
        header("Location: index?p=posts.index");


    }
    
}