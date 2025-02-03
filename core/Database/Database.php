<?php

namespace Core\Database;

use Core\Environment\DotEnv;

class Database
{
public static function getPdo() : \PDO
{
    $dotEnv = new Dotenv();

    $host =$dotEnv->getVariable('DBHOST');
    $port =$dotEnv->getVariable('DBPORT');
    $database =$dotEnv->getVariable('DBNAME'); // DotEnv->getVariable("DBHOST")
    $dbUsername =$dotEnv->getVariable('DBUSERNAME');
    $dbPassword =$dotEnv->getVariable('DBPASSWORD');

    $pdo = new \PDO("mysql:host=$host:$port;dbname=$database", $dbUsername, $dbPassword, [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
    ]);

    return $pdo;

}
}