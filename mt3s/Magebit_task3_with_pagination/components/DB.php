<?php


class DB
{
    public static function getConnection()
    {
        $paramsPath = ROOT . "/config/db_parameters.php";
        $params = include($paramsPath);
        /*$connection = mysqli_connect(
            $params['db']['server'],
            $params['db']['username'],
            $params['db']['password'],
            $params['db']['name']
        );
        if (!$connection) {
            echo "Connection to Database unsuccessful <br>";
            echo mysqli_connect_error();
            die();
        }
        return($connection); */
        try {
            $pdo = new PDO("mysql:host={$params['server']};dbname={$params['name']}", $params['username'], $params['password']);
        }   catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
        return $pdo;
    }
}