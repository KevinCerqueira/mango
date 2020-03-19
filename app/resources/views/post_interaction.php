<?php
include_once(dirname(__FILE__).'\..\..\Auth\auth_session.php');
include_once(dirname(__FILE__).'\..\..\Controllers\PostController.php');
if(empty($_POST['post_ID']) || empty($_POST['like_unlike'])){
    header('Location: index.php');
    exit();
}
$post = new PostController();
$msg = [
    'data' => $post->likePost($_SESSION['ID'], $_POST['post_ID'], $_POST['like_unlike']),
    'erro' => 'Não foi possível interagir com este Post!',
    'success' => 'Interação registrada com sucesso'
];
echo json_encode($msg);