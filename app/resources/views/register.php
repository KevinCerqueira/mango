<?php
session_start();
include_once(dirname(__FILE__).'\..\..\Controllers\UserController.php');
if(empty($_POST['nickname']) || empty($_POST['password']) || empty($_POST['password1'])){
    header('Location: index.php');
    exit();
}
UserController::createUser($_POST);