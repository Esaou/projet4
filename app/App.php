<?php

declare(strict_types=1); 

namespace App;

class App{

    private static $instance;
    private static $database;
    protected static $table;
    protected static $className;

    const DB_NAME = 'blog';
    const DB_USER ='root';
    const DB_PASS='';
    const DB_HOST='localhost';

    public static function getDb():object{

        if(self::$database ===null){

            self::$database = new Database\Database(self::DB_NAME,self::DB_USER,self::DB_PASS,self::DB_HOST);

        }

        return self::$database;

    }

    public static function getInstance():object{

        if(is_null(self::$instance)){

            self::$instance = new App();

        }
        return self::$instance;

    }
    
    public static function getTable(string $name = 'Table'):object{

        $className ='\\App\\Models\\' . ucfirst($name);
        return new $className;

    }

}