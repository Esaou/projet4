<?php

declare(strict_types=1);

namespace App\Database;

use App;

use \PDO;

class Database{

    private $dbName;
    private $dbUser;
    private $dbPass;
    private $dbHost;
    private $pdo;


    public function __construct(string $dbName,string $dbUser = 'root',string $dbPass ='',string $dbHost='localhost'){

        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbHost = $dbHost;

    }

    private function getPDO():object{

        if($this->pdo === null){

            $pdo = new PDO("mysql:dbname=$this->dbName;host=$this->dbHost", "$this->dbUser" , "$this->dbPass");
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;

        }
        return $this->pdo;

    }

    public function query($statement, string $className = null,bool $one=false){

        $req = $this->getPDO()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0){

            return $req;

        }
        if($className === null){

            $req->setFetchMode(PDO::FETCH_OBJ);

        }else{

            $req->setFetchMode(PDO::FETCH_CLASS, $className);

        }
        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        
        return $datas;

    }

    public function prepare($statement,array $attributes,string $className = null,bool $one = false){
       
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0){

            return $res;

        }
        $req->setFetchMode(PDO::FETCH_OBJ);
        if($className === null){

            $req->setFetchMode(PDO::FETCH_OBJ);

        }else{

            $req->setFetchMode(PDO::FETCH_CLASS, $className);

        };
        if($one){
            $datas = $req->fetch();
        }else{
            $datas = $req->fetchAll();
        }
        return $datas;


    }

}