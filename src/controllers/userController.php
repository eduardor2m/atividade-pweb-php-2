<?php

require_once "src/models/user.php";

class userController
{
    public function register()
    {
        $username = $_POST["username"];
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        if (!isset($username) || !isset($fullname) || !isset($email) || !isset($pass)) {
            require_once "src/pages/register/index.php";
        } else {
            $usuario = new User($email, $username, $fullname, $pass);
            $result = $usuario->save();
            if (!is_bool($result)) {
                require_once "src/pages/login/index.php";
            } else {
                require_once "src/pages/register/index.php";
            }
        }
    }

    public function login()
    {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        if (!isset($email) || !isset($pass)) {
            require_once "src/pages/register/index.php";
        } else {
            $result = User::logIn($email, $pass);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "username" => $result->getUsername(), "email" => $result->getEmail());
                require_once "src/pages/home/index.php";
            } else {
                require_once "src/pages/login/index.php";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?view=login");
    }
}
