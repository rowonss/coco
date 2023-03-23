<?php

namespace database;

use PDO;

class database
{
    public function __construct()
    {
    }

    public function newDB(): PDO
    {
        $host = "localhost";
        $dbname = "test";
        $user = "root";
        $password = "rlak1k2k3!";

        return new PDO("mysql:host={$host};dbname={$dbname}",$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
}