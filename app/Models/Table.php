<?php

declare(strict_types=1);

namespace App\Models;

use App\App;

class Table{

    protected $table;
    protected $db;

    public function find(string $id):object{

        return App::getDb()->prepare("SELECT * FROM articles  WHERE id = ?", [$id], get_called_class(),true);
    
    }

    public function createE(array $fields):bool{

        $sqlParts = [];
        $attributes = [];
        foreach($fields as $k => $v){

            $sqlParts[] = "$k = ?";
            $attributes[] = $v;

        }
        $sqlPart = implode(', ', $sqlParts);
        return $this->query("INSERT INTO articles SET $sqlPart", $attributes,true);
    
    }
    public function createC(array $fields):bool{

        $sqlParts = [];
        $attributes = [];
        foreach($fields as $k => $v){

            $sqlParts[] = "$k = ?";
            $attributes[] = $v;

        }
        $sqlPart = implode(', ', $sqlParts);
        return $this->query("INSERT INTO commentaires SET $sqlPart", $attributes,true);
    
    }

    public function updateE(string $id, array $fields):bool{

        $sqlParts = [];
        $attributes = [];
        foreach($fields as $k => $v){

            $sqlParts[] = "$k = ?";
            $attributes[] = $v;

        }
        $sqlPart = implode(', ', $sqlParts);
        return $this->query("UPDATE articles SET $sqlPart WHERE id = $id", $attributes,true);
    
    }

    public function updateSignalement(string $id, array $fields):bool{

        $sqlParts = [];
        $attributes = [];
        foreach($fields as $k => $v){

            $sqlParts[] = "$k = ?";
            $attributes[] = $v;

        }
        $sqlPart = implode(', ', $sqlParts);
        return $this->query("UPDATE commentaires SET $sqlPart WHERE id = $id", $attributes,true);
    
    }

    public function deleteS(string $id, array $fields):bool{

        $sqlParts = [];
        $attributes = [];
        foreach($fields as $k => $v){

            $sqlParts[] = "$k = ?";
            $attributes[] = $v;

        }
        $sqlPart = implode(', ', $sqlParts);
        return $this->query("UPDATE commentaires SET $sqlPart WHERE id = $id", $attributes,true);
    
    }

    public function deleteE(string $id):bool{    

        return $this->query("DELETE FROM articles WHERE id = ?", [$id],true);
    
    }

    public function deleteC(string $id):bool{    

        return $this->query("DELETE FROM commentaires WHERE id = ?", [$id],true);
    
    }

    public function query($statement,array $attributes = null, bool $one = false):bool{


        if($attributes){

            return App::getDb()->prepare($statement,$attributes,str_replace('Table', 'Entity', get_class($this)),$one);

        } else {

            return App::getDb()->query(

                $statement,
                str_replace('Table', 'Entity', get_class($this)),
                $one

            );

        }

    }

    public function __get(string $key):string{

        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;

    }

    public function updateProfil(string $id, array $fields):bool{

        $sqlParts = [];
        $attributes = [];
        foreach($fields as $k => $v){

            $sqlParts[] = "$k = ?";
            $attributes[] = $v;

        }
        $sqlPart = implode(', ', $sqlParts);
        return $this->query("UPDATE users SET $sqlPart WHERE id = $id", $attributes,true);
    
    }

    public function precedent(string $id):string{

        $firstLine = App::getDb()->query("SELECT * FROM articles LIMIT 0,1 ", get_called_class(),true);
        $req = App::getDb()->query("SELECT * FROM articles WHERE id<$id ORDER BY id DESC LIMIT 0,1 ", get_called_class(),true);
        if($req < $firstLine){

           return $id;

        }else{

            return $req->id;

        }

    }

    public function suivant(string $id):string{

        $lastLine = App::getDb()->query("SELECT * FROM articles ORDER BY id DESC LIMIT 0 ", get_called_class(),true);
        $req = App::getDb()->query("SELECT * FROM articles WHERE id>$id LIMIT 0,1 ", get_called_class(),true);
        if($req !== $lastLine){

            return $req->id;
 
         }else{
 
            return $id;
 
         }
    }
}