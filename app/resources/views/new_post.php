<?php
include_once(dirname(__FILE__).'\..\..\Auth\auth_session.php');
include_once(dirname(__FILE__).'\..\..\Controllers\PostController.php');
if(empty($_POST['title']) || empty($_POST['body'])){
    header('Location: index.php');
    exit();
}
PostController::newPost($_SESSION['ID'], $_POST);
header('Location: index.php');
exit();

