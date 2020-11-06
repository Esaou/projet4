<?php

declare(strict_types=1);

namespace App\Controller\back_office;

use \App;

class AppController extends \App\Controller\front_office\AppController {

    protected $template = '/templates/admin';

    public function __construct(){

        parent::__construct();
        $app = App\App::getInstance();

        $auth = new App\Database\DbAuth($app->getDb());

        if(!$auth->logged()){

            header('Location: index?p=posts.forbidden');
            
        }

    }
}