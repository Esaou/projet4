<?php

declare(strict_types=1);

namespace App\Controller\front_office;


class AppController extends Controller {

    protected $template = '/templates/default';

    public function __construct(){

        $this->viewPath = ROOT .'/app/Views/';

    }


}