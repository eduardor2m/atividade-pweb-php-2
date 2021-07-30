<?php
session_start();

if (isset($_GET["view"])) {
    require_once "src/pages/" . $_GET["view"] . "/index.php";
} else if (isset($_GET["action"]) && isset($_GET["class"])) {
    $controlador = $_GET["class"] . "Controller";
    $action = $_GET["action"];
    require_once "src/controllers/" . $controlador . ".php";
    $controlador = new $controlador();
    $controlador->$action();
} else if (isset($_SESSION["loggedUser"])) {
    require_once "src/pages/home/index.php";
} else {
    require_once "src/pages/login/index.php";
}
