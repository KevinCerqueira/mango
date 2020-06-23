<?php
include('layout/_head.php');
include_once(dirname(__FILE__).'\..\..\Controllers\PostController.php');
$posts = PostController::getPosts();
$types_posts = PostController::getTypesPosts();
$topPost = PostController::getTopPost();
$posts_empty = false;
$topPost_empty = false;
if($posts == null){
    $posts_empty = true;
}
if($topPost == null){
    $topPost_empty = true;
}
;?>
<title>Postshits da UEFS</title>

<div class="row">
    <div class="col-md-3">
        <?php if(!$login){include('not_logged/login.php');}?>
        <?php if($login){include('logged/home.php');}?>
    </div>
    <?php include('feed.php');?>
</div>
<script>
function alternateColor() {
    var color = $('#type').val();
    var color_post = $('#container-post').attr('color');
    $('#container-post').removeClass(color_post);
    $('#container-post').attr('color', '');
    console.log(color, color_post);
    if(color == '1'){
        $('#container-post').addClass('bg-warning');
        
        $('#container-post').attr('color', 'bg-warning');
    }else if(color == '2'){
        $('#container-post').addClass('bg-success');
        $('#container-post').attr('color', 'bg-success');
    }else if(color == '3'){
        $('#container-post').addClass('bg-primary');
        $('#container-post').attr('color', 'bg-primary');
    }else if(color == '4'){
        $('#container-post').addClass('bg-danger');
        $('#container-post').attr('color', 'bg-danger');
    }else{
        $('#container-post').addClass('bg-info');
        $('#container-post').attr('color', 'bg-info');
    }
    return;
}
</script>
<?php
include('layout/_footer.php');
;?>