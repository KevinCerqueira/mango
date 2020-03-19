<?php
// include_once(dirname(__FILE__).'\..\Auth\auth_login.php');
session_start();
session_destroy();
header('Location: index.php');
exit();
?>