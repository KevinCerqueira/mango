<?php
include_once(dirname(__FILE__).'\..\DB\PostDB.php');
class PostController{

    public function newPost($user, $post)
    {
        $newPost = new PostDB();
        return $newPost->NEW_POST($user, $post);
    }
    public function getPosts()
    {
        $post = new PostDB();
        return $post->GET_POSTS();
    }
    public function getTypesPosts()
    {
        $post = new PostDB();
        return $post->SELECT_ALL_TYPES();
    }
    public function getUserFromPost($post_ID)
    {
        $post = new PostDB();
        $user = $post->GET_USER_FROM_POST($post_ID);
        return $user;
    }
    public function getCommentsFromPost($post_ID)
    {
        $post = new PostDB();
        $comments = $post->GET_COMMENTS_FROM_POST(intval($post_ID));
        return $comments;
    }
    public function likePost($str_user_ID, $str_post_ID, $like_unlike)
    {
        $post = new PostDB();
        $user_ID = intval($str_user_ID);
        $post_ID = intval($str_post_ID);
        if($like_unlike == 'like'){
            return $post->SET_LIKE($user_ID, $post_ID);
        }else if($like_unlike == 'unlike'){
            return $post->SET_UNLIKE($user_ID, $post_ID);
        }else{
            return $post->UNSSET_LIKE($user_ID, $post_ID);
        }
    }
    public function getTopPost()
    {
        $post = new PostDB();
        return $post->GET_TOP_POST();
    }
    public function isInteraction($user_ID, $post_ID)
    {
        $post = new PostDB();
        if($post->IS_INTERACTION($user_ID, $post_ID)){
            return true;
        }else {
            return false;
        }
    }
    public function getInteraction($user_ID, $post_ID)
    {
        $post = new PostDB();
        return $post->SELECT_INTERACTION($user_ID, $post_ID);
    }
}