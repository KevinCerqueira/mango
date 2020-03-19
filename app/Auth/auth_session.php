<?php 
session_start();
if(!$_SESSION['ID']){
    header('Location: index.php');
    exit();
}