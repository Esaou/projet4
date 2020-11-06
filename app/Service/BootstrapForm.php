<?php

declare(strict_types=1);

namespace App\Service;

class BootstrapForm{

    private $data;

    
    public function __construct($data = array()){

        $this->data = $data;

    }

    protected function surround(string $html):string{

        return "<div class=\"form-group\">{$html}</div>";

    }

    public function input(string $name):string{

        return $this->surround(
            '<label class="font-weight-bold" style="font-size:15px;">' . ucfirst($name) . '</label><input type="text" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">'
        );

    }

    public function password(string $name):string{

        return $this->surround(
            '<label class="font-weight-bold" style="font-size:15px;">' . ucfirst($name) . '</label><input type="password" name="' . $name . '" value="" class="form-control">'
        );

    }

    public function textArea(string $name):string{

        return $this->surround(
            '<label class="font-weight-bold" style="font-size:15px;">' . ucfirst($name) . '</label><textarea name="' . $name . '" class="form-control">' . $this->getValue($name) .'</textarea>'
        );

    }

    public function textAreaEditor(string $name):string{

        return $this->surround(
            '<label class="font-weight-bold" style="font-size:15px;">' . ucfirst($name) . '</label><textarea name="' . $name . '" class="form-control" id="myEditor">' . $this->getValue($name) .'</textarea>'
        );

    }

    public function getValue($index){

        if(is_object($this->data)){

            return $this->data->$index;

        }else{

            return isset($this->data[$index]) ? $this->data[$index] : null;

        }

    }

}