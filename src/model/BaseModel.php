<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        try {
            $hostname = "mysql-mallekr.alwaysdata.net";
            $db = "mallekr_terre_des_anges";
            $login = "mallekr";
            $password = "TerreDesAnges123*";

            $pdo = new PDO("mysql:host=$hostname;dbname=$db", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        } catch (PDOException $e) {

            die("SQL Error $db : " . $e->getMessage());

          }
    }
}