<?php
class connection
{
    public static function getConnection()
    {
        $database = "atividade2";
        $username = "root";
        $senha = "";
        return new PDO("mysql:host=localhost;dbname=$database", $username, $senha);
    }
}
