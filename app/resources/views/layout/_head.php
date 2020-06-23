<?php
session_start();
include_once(dirname(__FILE__).'\..\..\..\Controllers\UserController.php');
if(!isset($_SESSION['ID'])){
    $login = false;
}else{
    $user = UserController::getUser($_SESSION['ID']);
    $login = true;
}
;?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- BootstrapCDN -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

    <!-- MANGO CSS -->
    <link rel="stylesheet" href="../css/mango_body.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="icon" type="../img/creator.png" href="logo.png" />
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white justify-content-between">
        <a class="navbar-brand text-white" href="index.php">
            <!-- <img src="../img/creator.png" width="30" height="30" class="d-inline-block align-top" alt=""> -->
            <i class="fas fa-location-arrow text-info d-inline-block align-top mt-2"></i>
            <label class="text-info">Post</label>shits da UEFS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <!-- <a id="nav-first" class="nav-item nav-link text-light btn" href="index.php">
                    Feed
                </a>
                <a id="nav-first" class="nav-item nav-link text-light btn" href="about.php">
                    Sobre
                </a> -->
            </div>
        </div>
        <?php if($login):?>
            <p class="h5 font-weight-light">
                <label id="username" class="text-info"><?php echo $user['nickname'];?></label> | 
                <a class="text-danger" href="exit.php">Sair</a>
            </p>
        <?php else:?>
        <form method="POST" action="login.php" class="form-inline">
            <input name="user" maxlength="16" minlength="3" class="form-control mr-sm-2" type="text" placeholder="Usuário" aria-label="Usuário" required>
            <input name="password" minlength="6" maxlength="12" class="form-control mr-sm-2" type="password" placeholder="Senha" aria-label="Senha" required>
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Entrar</button>
        </form>
        <?php endif;?>
    </nav>
    <div class="container-fluid p-4">