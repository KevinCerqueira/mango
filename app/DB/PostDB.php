<?php
include_once(dirname(__FILE__).'\..\DB\Database.php');
class PostDB{

    private $database;

    function __construct()
    {
        $this->database = new Database();
    }

    public function NEW_POST($user_ID, $post)
    {
        $title_post = mysqli_real_escape_string($this->database->getConnection(), $post['title']);
        $body_post = mysqli_real_escape_string($this->database->getConnection(), $post['body']);
        $type_ID = intval(mysqli_real_escape_string($this->database->getConnection(), $post['type']));
        date_default_timezone_set('America/Bahia');
        $date = date('Y-m-d');
        // var_dump($date);exit;
        $time = date('H:i:s');
        $sql = "INSERT INTO post (user_ID, title, body, type, date, time) VALUES (
            $user_ID,
            '$title_post',
            '$body_post',
            $type_ID,
            '$date',
            '$time'
        )";
        return $this->database->executeSQL($sql);
    }
    public function GET_POSTS(){
        $result = $this->database->getResultFromQuery("SELECT * FROM post, type_post WHERE post.type = type_post.type_post_ID ORDER BY date, time DESC");
        if($result->num_rows < 1){
            return null;
        }
        $posts = $result->fetch_all(MYSQLI_ASSOC);

        $result = $this->database->getResultFromQuery("SELECT * FROM comment");
        $comments = $result->fetch_all(MYSQLI_ASSOC);

        $posts_comments = [
            'posts' => $posts,
            'commments' => $comments
        ];
        return $posts_comments;
    }
    public function GET_POST($post_ID)
    {
        $result = $this->database->getResultFromQuery("SELECT * FROM post WHERE post_ID = $post_ID");
        return $result->fetch_assoc();
    }
    public function GET_TOP_POST()
    {
        $result = $this->database->getResultFromQuery("SELECT * FROM post ORDER BY `like` DESC");
        if($result->num_rows < 1){
            return null;
        }
        // var_dump($result->fetch_assoc());exit;
        $topPost = intval($result->fetch_assoc()['post_ID']);
        $result = $this->database->getResultFromQuery("SELECT * FROM post, type_post WHERE post.post_ID = $topPost AND post.type = type_post.type_post_ID");
        return $result->fetch_assoc();
    }
    public function SELECT_ALL_TYPES()
    {
        $result = $this->database->getResultFromQuery("SELECT * FROM type_post");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function GET_COMMENTS_FROM_POST($post_ID)
    {
        $result = $this->database->getResultFromQuery("SELECT * FROM comment WHERE post_ID = $post_ID");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function GET_POSTS_FROM_USER($user_ID)
    {
        $result = $this->database->getResultFromQuery("SELECT * FROM post WHERE user_ID = $user_ID");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function GET_USER_FROM_POST($post_ID)
    {
        $result = $this->database->getResultFromQuery("SELECT user_ID FROM post WHERE post_ID = $post_ID");
        $row = $result->fetch_assoc();
        $user_ID = $row['user_ID'];
        $result = $this->database->getResultFromQuery("SELECT * FROM user WHERE user_ID = $user_ID");
        return $result->fetch_assoc();
    }
    public function DELETE_POST($post_ID)
    {
        return $this->database->getResultFromQuery("DELETE FROM post WHERE post_ID = $post_ID");
    }
    public function SET_LIKE($str_user_ID, $str_post_ID)
    {
        $user_ID = intval($str_user_ID);
        $post_ID = intval($str_post_ID);
        if($this->IS_INTERACTION($user_ID, $post_ID)){
            $this->UNSSET_LIKE($user_ID, $post_ID);
        }
        $result =  $this->database->getResultFromQuery("SELECT interaction_ID FROM post_interaction WHERE user_ID = $user_ID AND post_ID = $post_ID");
        if($result->num_rows == 0){
            $interaction = $this->database->executeSQL("INSERT INTO post_interaction (user_ID, post_ID, like_unlike) VALUES (
                $user_ID,
                $post_ID,
                'like'
            )");
        }else{
            $row = $result->fetch_assoc();
            $interaction_ID = intval($row['ID']);
            $interaction = $this->database->getResultFromQuery("UPDATE post_interaction SET like_unlike = 'like' WHERE interaction_ID = $interaction_ID");
        }
        $result = $this->database->getResultFromQuery("SELECT * FROM post WHERE post_ID = $post_ID");
        $row = $result->fetch_assoc();
        $newValue = intval($row['like']) + 1;
        $this->database->getResultFromQuery("UPDATE post SET `like` = $newValue WHERE post_ID = $post_ID");
        return $this->database->getResultFromQuery("SELECT * FROM post WHERE post_ID = $post_ID")->fetch_assoc();
    }
    public function SET_UNLIKE($user_ID, $post_ID)
    {
        if($this->IS_INTERACTION($user_ID, $post_ID)){
            $this->UNSSET_LIKE($user_ID, $post_ID);
        }
        $result =  $this->database->getResultFromQuery("SELECT interaction_ID FROM post_interaction WHERE user_ID = $user_ID AND post_ID = $post_ID");
        if($result->num_rows == 0){
            $interaction = $this->database->executeSQL("INSERT INTO post_interaction (user_ID, post_ID, like_unlike) VALUES (
                $user_ID,
                $post_ID,
                'unlike'
            )");
        }else{
            $row = $result->fetch_assoc();
            $interaction_ID = intval($row['ID']);
            $interaction = $this->database->getResultFromQuery("UPDATE post_interaction SET like_unlike = 'unlike' WHERE interaction_ID = $interaction_ID");
        }
        $result = $this->database->getResultFromQuery("SELECT unlike FROM post WHERE post_ID = $post_ID");
        $row = $result->fetch_assoc();
        $newValue = intval($row['unlike']) + 1;
        $this->database->getResultFromQuery("UPDATE post SET unlike = $newValue WHERE post_ID = $post_ID");
        return $this->database->getResultFromQuery("SELECT * FROM post WHERE post_ID = $post_ID")->fetch_assoc();
    }
    public function UNSSET_LIKE($user_ID, $post_ID)
    {   
        $result =  $this->database->getResultFromQuery("SELECT * FROM post_interaction WHERE user_ID = $user_ID AND post_ID = $post_ID");
        $interaction = $result->fetch_assoc();
        if($interaction['like_unlike'] == 'like'){
            $result = $this->database->getResultFromQuery("SELECT `like` FROM post WHERE post_ID = $post_ID");
            $row = $result->fetch_assoc();
            $newValue = intval($row['like']) - 1;
            $this->database->getResultFromQuery("UPDATE post SET `like` = $newValue WHERE post_ID = $post_ID");
        }else if($interaction['like_unlike'] == 'unlike'){
            $result = $this->database->getResultFromQuery("SELECT unlike FROM post WHERE post_ID = $post_ID");
            $row = $result->fetch_assoc();
            $newValue = intval($row['unlike']) - 1;
            $this->database->getResultFromQuery("UPDATE post SET unlike = $newValue WHERE post_ID = $post_ID");
        }
        $interaction_ID = intval($interaction['interaction_ID']);
        $this->database->getResultFromQuery("DELETE FROM post_interaction WHERE interaction_ID = $interaction_ID");
        return $this->database->getResultFromQuery("SELECT * FROM post WHERE post_ID = $post_ID")->fetch_assoc();
    }
    public function IS_INTERACTION($user_ID, $post_ID)
    {
        $result =  $this->database->getResultFromQuery("SELECT * FROM post_interaction WHERE user_ID = $user_ID AND post_ID = $post_ID");
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public function SELECT_INTERACTION($user_ID ,$post_ID)
    {
        $result =  $this->database->getResultFromQuery("SELECT * FROM post_interaction WHERE user_ID = $user_ID AND post_ID = $post_ID");
        return $result->fetch_assoc();
    }
}