<?php
session_start();
include_once(dirname(__FILE__).'\..\..\Controllers\UserController.php');
if(empty($_POST['user']) || empty($_POST['password'])){
    header('Location: index.php');
    exit();
}
UserController::validateLogin($_POST['user'], $_POST['password']);