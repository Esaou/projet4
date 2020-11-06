<?php

declare(strict_types=1);

namespace App\Controller\front_office;

class Controller {

    protected $viewPath = ROOT . '/app/Views/';
    protected $template = '/templates/default';

    public function render(string $view, array $variables = []):void{

        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.','/',$view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . $this->template . '.php');

    }

}