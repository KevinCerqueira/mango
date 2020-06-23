<?php
include_once(dirname(__FILE__).'\..\DB\Database.php');
class UserDB{

    private $database;

    function __construct()
    {
        $this->database = new Database();
    }
    public function INSERT($user)
    {
        $nickname = mysqli_real_escape_string($this->database->getConnection(), $user['nickname']);
        $password = mysqli_real_escape_string($this->database->getConnection(), $user['password']);
        $description = mysqli_real_escape_string($this->database->getConnection(), $user['description']);
        $nickname = strtolower($nickname);
        $sql = "INSERT INTO user (nickname, password, description) VALUES (
            '$nickname',
            md5('$password'),
            '$description'
        )";
        return $this->database->executeSQL($sql);
    }
    public function VALIDATION($user)
    {
        $result = $this->database->getResultFromQuery("SELECT * FROM user WHERE nickname = '$user'");
        if($result->num_rows > 0){
            return true;
        }
        return false;
    }
    public function SELECT($user_ID)
    {
        return $this->database->getResultFromQuery("SELECT * FROM user WHERE user_ID = $user_ID")->fetch_assoc();
    }
    public function SELECT_LOGIN($user, $user_password)
    {
        $nickname = $this->database->getConnection()->real_escape_string($user);
        $password = $this->database->getConnection()->real_escape_string($user_password);
        $result = $this->database->getResultFromQuery("SELECT user_ID FROM user WHERE nickname = '$nickname' AND password = md5('$password')");
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return $row['user_ID'];
        }else{
            return 0;
        }
    }
    public function UPDATE_NICKNAME($user_ID, $user)
    {
        return $this->database->getResultFromQuery("UPDATE user SET nickname = '$user' WHERE user_ID = $user_ID");
    }
    public function UPDATE_DESCRIPTION($user_ID, $description)
    {
        return $this->database->getResultFromQuery("UPDATE user SET description = '$description' WHERE user_ID = $user_ID");
    }
    public function UPDATE_PASSWORD($user_ID, $password)
    {
        return $this->database->getResultFromQuery("UPDATE user SET password = md5('$password') WHERE user_ID = $user_ID");
    }
}