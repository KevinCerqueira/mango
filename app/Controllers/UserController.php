<?php
include_once(dirname(__FILE__).'\..\DB\UserDB.php');
class UserController{

    public function createUser($data_user)
    {
        $user = new UserDB();
        $nickname = strtolower($data_user['nickname']);
        $description = $data_user['description'];
        session_start();
        if($user->VALIDATION($nickname)){
            $_SESSION['erro_register'] = 'Este nome já está sendo utilizado.';
            $_SESSION['nickname_login'] = $nickname;
            $_SESSION['description_login'] = $description;
            header('Location: index.php');
            exit();
        }elseif($data_user['password'] != $data_user['password1']){
            $_SESSION['erro_register'] = 'As senhas devem ser iguais.';
            $_SESSION['nickname_login'] = $nickname;
            $_SESSION['description_login'] = $description;
            header('Location: index.php');
            exit();
        }else{
            $user_ID = $user->INSERT($data_user);
            $_SESSION['ID'] = $user_ID;
            header('Location: index.php');
            exit();
        }
    }
    public function validateLogin($nickname, $password)
    {
        $user = new UserDB();
        $result = $user->SELECT_LOGIN(strtolower($nickname), $password);
        if($result == 0){
            $_SESSION['erro_login'] = 'Usuário e/ou senha incorreta(s)';
            header('Location: index.php');
            exit();
        }else{
            $_SESSION['ID'] = $result;
            header('Location: index.php');
            exit();
        }
    }
    public function getUser($user_ID)
    {
        $user = new UserDB();
        return $user->SELECT($user_ID);
    }
}