<?php
include_once('layout/_head.php');
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
// var_dump($posts['posts']);exit;
;?>
<title>Postshits da UEFS</title>

<div class="row">
    <div class="col-md-3">
        <?php if(!$login):?>
        <div class="bg-white container-fluid p-3 border-20">
            <p class="h3 font-weight-light ">Olá!</p>
            <p class="h5 font-weight-light">Para fazer publicações ou interagir na página, é necessário estar logado.
            </p>
            <p class="h6">
                Não possui uma conta?
            </p>
            <p class="h3 text-info">
                Cadastre-se:
            </p>
            <?php if(isset($_SESSION['erro_register'])):?>
            <div class="alert alert-danger" role="alert">
                <p class="font-weight-light"><?php echo $_SESSION['erro_register'];?></p>
            </div>
            <?php unset($_SESSION['erro_register']); endif;?>
            <form action="register.php" method="post" class="">
                <div class="form-group">
                    <?php if(isset($_SESSION['nickname_login'])):?>
                    <input required value="<?php echo $_SESSION['nickname_login'];?>" name="nickname" id="nickname"
                        minlength="3" maxlength="15" placeholder="Repita a senha" type="text" class="form-control">
                    <?php unset($_SESSION['nickname_login']);else:?>
                    <input required name="nickname" id="nickname" minlength="3" maxlength="12" placeholder="Usuário"
                        type="text" class="form-control">
                    <?php endif;?>
                </div>
                <div class="form-group">
                    <?php if(isset($_SESSION['description_login'])):?>
                    <textarea name="description" type="text"
                        class="form-control"><?php echo $_SESSION['description_login'];?></textarea>
                    <?php unset($_SESSION['description_login']);else:?>
                    <textarea name="description" type="text" class="form-control"></textarea>
                    <?php endif;?>
                </div>
                <div class="form-group">
                    <input required name="password" id="password" minlength="6" maxlength="12" placeholder="Senha"
                        type="password" class="form-control">
                </div>
                <div class="form-group">
                    <input required name="password1" id="password1" minlength="6" maxlength="12"
                        placeholder="Repita a senha" type="password" class="form-control">
                </div>
                <button class="btn btn-info">Cadastrar</button>
                <div>
                    <small>
                        Por cadastrar-se, você está aceita os <a href="">Termos de serviçoes</a> e a <a href="">Política
                            de privacidade.</a>
                    </small>
                </div>
            </form>
        </div>
        <?php endif;?>
        <?php if($login):?>
        <div class="container-fluid  p-4 border-20 bg-white mt-2">
            <div class="form-group">
                <p class="h3"><?php echo $user['nickname'];?></p>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="description">Descrição: </label>
                        </div>
                        <div class="col-sm-2">

                            <div class="modal fade" id="edit-description" tabindex="-1" role="dialog"
                                aria-labelledby="edit-descriptionTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="edit_description.php" method="post">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit-descriptionTitle">Editar descrição</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea name="description" cols="" class="form-control"
                                                    maxlength="100"
                                                    rows="3"><?php echo $user['description'];?></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fechar</button>
                                                <button type="submit" class="btn btn-info">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p name="description" type="text" id="description" class="border form-control">
                        <?php echo $user['description'];?></p>
                </div>
                <button class="btn btn-dark btn-block" data-toggle="modal" data-target="#edit-description">
                    Editar
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div id="container-post" color="bg-white" class="container-fluid  p-4 border-20 bg-white mt-2">
            <p class="h3">Novo Postshit</p>
            <form action="new_post.php" method="post">
                <div class="form-group">
                    <input name="title" placeholder="Assunto" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="body" placeholder="Texto" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <select onchange="alternateColor()" name="type" id="type" class="form-control">
                        <?php foreach($types_posts as $type_post):?>
                        <option color="bg-<?php echo $type_post['type_name'];?>" value="<?php echo $type_post['type_post_ID'];?>">
                            <?php echo $type_post['alternative_name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark border-30 btn-block">Enviar
                        <i class="fa fa-send"></i>
                    </button>
                </div>
            </form>
        </div>
        <?php endif;?>

    </div>
    <div class="col-md-9">
        <div class="container-fluid bg-white p-4 border-20">
            <p class="h3">#1 Postshit</p>
            <?php if($topPost_empty):?>
            <p class="h5 font-weight-light">Não há um TOP Post no momento.</p>
            <?php else:?>
            <div class="container-fluid bg-<?php echo $topPost['type_name'];?> shadow pt-3 border-20 mt-2 pb-1">
                <p class="h5">
                    <?php echo $topPost['icon'];?>
                    <?php echo $topPost['title'];?>
                </p>
                <p>
                    <?php echo $topPost['body'];?>
                </p>
                <hr class="mb-0">
                <div class="row text-center">
                    <div class="col-sm-3 p-0">
                        <form name="interaction_like" action="post_interaction.php" method="post">
                            <input type="hidden" name="post_ID" value="<?php echo $topPost['post_ID'];?>">
                            <?php if($login && PostController::isInteraction($_SESSION['ID'], $topPost['post_ID'])):?>
                            <?php $interaction = PostController::getInteraction($_SESSION['ID'], $topPost['post_ID']);?>
                            <?php if($interaction['like_unlike'] == 'like'):?>

                            <a like_unlike="true" value="<?php echo $topPost['post_ID'];?>" aria-pressed="true"
                                data-toggle="button" type="submit" id="like<?php echo $topPost['post_ID'];?>"
                                class="btn-like btn pb-0 text-light">
                                <i class="fas fa-chevron-circle-up"></i>
                                <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                    id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                            </a>

                            <a like_unlike="false" value="<?php echo $topPost['post_ID'];?>" aria-pressed="false"
                                data-toggle="button" type="submit" id="unlike<?php echo $topPost['post_ID'];?>"
                                class="btn-unlike btn pb-0 text-dark">
                                <i class="fas fa-chevron-circle-down"></i>
                                <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                    id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                            </a>
                            <?php elseif($interaction['like_unlike'] == 'unlike'):?>
                            <a like_unlike="false" value="<?php echo $topPost['post_ID'];?>" aria-pressed="false"
                                data-toggle="button" type="submit" id="like<?php echo $topPost['post_ID'];?>"
                                class="btn-like btn pb-0 text-dark">
                                <i class="fas fa-chevron-circle-up"></i>
                                <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                    id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                            </a>

                            <a like_unlike="true" value="<?php echo $topPost['post_ID'];?>" aria-pressed="true"
                                data-toggle="button" type="submit" id="unlike<?php echo $topPost['post_ID'];?>"
                                class="btn-unlike btn pb-0 text-light">
                                <i class="fas fa-chevron-circle-down"></i>
                                <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                    id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                            </a>
                            <?php else:?>
                            <a like_unlike="false" value="<?php echo $topPost['post_ID'];?>" aria-pressed="false"
                                data-toggle="button" type="submit" id="like<?php echo $topPost['post_ID'];?>"
                                class="btn-like btn pb-0 text-dark">
                                <i class="fas fa-chevron-circle-up"></i>
                                <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                    id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                            </a>

                            <a like_unlike="false" value="<?php echo $topPost['post_ID'];?>" aria-pressed="false"
                                data-toggle="button" type="submit" id="unlike<?php echo $topPost['post_ID'];?>"
                                class="btn-unlike btn pb-0 text-dark">
                                <i class="fas fa-chevron-circle-down"></i>
                                <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                    id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                            </a>
                            <?php endif;?>
                            <?php else:?>
                            <a like_unlike="false" value="<?php echo $topPost['post_ID'];?>" aria-pressed="false"
                                data-toggle="button" type="submit" id="like<?php echo $topPost['post_ID'];?>"
                                class="btn-like btn pb-0 text-dark">
                                <i class="fas fa-chevron-circle-up"></i>
                                <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                    id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                            </a>

                            <a like_unlike="false" value="<?php echo $topPost['post_ID'];?>" aria-pressed="false"
                                data-toggle="button" type="submit" id="unlike<?php echo $topPost['post_ID'];?>"
                                class="btn-unlike btn pb-0 text-dark">
                                <i class="fas fa-chevron-circle-down"></i>
                                <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                    id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                            </a>
                            <?php endif;?>
                        </form>
                    </div>
                    <!-- <div class="col-md-0">
                        <p class="btn mb-0 pl-3">|</p>
                    </div> -->
                    <div class="col-sm-3 p-0">
                        <?php $userPopover = PostController::getUserFromPost($topPost['post_ID']);?>
                        <button tabindex="0" class="btn popover-dismiss" role="button" data-placement="bottom"
                            data-toggle="popover" data-trigger="focus" title="<?php echo $userPopover['nickname'];?>"
                            data-content="<?php echo $userPopover['description'];?>"><?php echo $userPopover['nickname'];?></a>
                    </div>
                    <!-- <div class="col-md-0">
                        <p class="btn mb-0 pl-0">|</p>
                    </div> -->
                    <div class="col-sm-3 p-0">
                        <p class="btn mb-0 pl-0">
                            <?php echo substr($topPost['date'], -5, -3).'/'.substr($topPost['date'], -2).' às '.substr($topPost['time'], 0, 5);?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
        <div class="container-fluid bg-white p-4 border-20 mt-3">
            <p class="h3">Feed</p>
            <div id="feed">
                <?php if($posts_empty):?>
                <p class="h5 font-weight-light">Não há um posts no momento :'(... Que tal publicar um?</p>
                <?php else:?>
                <?php foreach($posts['posts'] as $post):?>
                <div class="container-fluid bg-<?php echo $post['type_name'];?> shadow pt-3 border-20 mt-2 pb-1">
                    <p class="h5">
                        <?php echo $post['icon'];?>
                        <?php echo $post['title'];?>
                    </p>
                    <p>
                        <?php echo $post['body'];?>
                    </p>
                    <hr class="mb-0">
                    <div class="row text-center">
                        <div class="col-sm-3 p-0 ">
                            <form name="interaction_like" action="post_interaction.php" method="post">
                                <input type="hidden" name="post_ID" value="<?php echo $post['post_ID'];?>">
                                <?php if($login && PostController::isInteraction($_SESSION['ID'], $post['post_ID'])):?>
                                <?php $interaction = PostController::getInteraction($_SESSION['ID'], $post['post_ID']);?>
                                <?php if($interaction['like_unlike'] == 'like'):?>

                                <a like_unlike="true" value="<?php echo $post['post_ID'];?>" aria-pressed="true"
                                    data-toggle="button" type="submit" id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like btn pb-0 text-light">
                                    <i class="fas fa-chevron-circle-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a like_unlike="false" value="<?php echo $post['post_ID'];?>" aria-pressed="false"
                                    data-toggle="button" type="submit" id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike btn pb-0 text-dark">
                                    <i class="fas fa-chevron-circle-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php elseif($interaction['like_unlike'] == 'unlike'):?>
                                <a like_unlike="false" value="<?php echo $post['post_ID'];?>" aria-pressed="false"
                                    data-toggle="button" type="submit" id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like btn pb-0 text-dark">
                                    <i class="fas fa-chevron-circle-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a like_unlike="true" value="<?php echo $post['post_ID'];?>" aria-pressed="true"
                                    data-toggle="button" type="submit" id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike btn pb-0 text-light">
                                    <i class="fas fa-chevron-circle-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php else:?>
                                <a like_unlike="false" value="<?php echo $post['post_ID'];?>" aria-pressed="false"
                                    data-toggle="button" type="submit" id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like btn pb-0 text-dark">
                                    <i class="fas fa-chevron-circle-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a like_unlike="false" value="<?php echo $post['post_ID'];?>" aria-pressed="false"
                                    data-toggle="button" type="submit" id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike btn pb-0 text-dark">
                                    <i class="fas fa-chevron-circle-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php endif;?>
                                <?php else:?>
                                <a like_unlike="false" value="<?php echo $post['post_ID'];?>" aria-pressed="false"
                                    data-toggle="button" type="submit" id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like btn pb-0 text-dark">
                                    <i class="fas fa-chevron-circle-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a like_unlike="false" value="<?php echo $post['post_ID'];?>" aria-pressed="false"
                                    data-toggle="button" type="submit" id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike btn pb-0 text-dark">
                                    <i class="fas fa-chevron-circle-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php endif;?>
                            </form>
                        </div>
                        <!-- <div class="col-md-0">
                            <p class="btn mb-0 pl-3">|</p>
                        </div> -->
                        <div class="col-sm-3 p-0">
                            <?php $userPopover = PostController::getUserFromPost($post['post_ID']);?>
                            <button tabindex="0" class="btn popover-dismiss" role="button" data-placement="bottom"
                                data-toggle="popover" data-trigger="focus"
                                title="<?php echo $userPopover['nickname'];?>"
                                data-content="<?php echo $userPopover['description'];?>"><?php echo $userPopover['nickname'];?></a>
                        </div>
                        <!-- <div class="col-md-0">
                            <p class="btn mb-0 pl-0">|</p>
                        </div> -->
                        <div class="col-sm-3 p-0">
                            <p class="btn mb-0">
                                <?php echo substr($post['date'], -5, -3).'/'.substr($post['date'], -2).' às '.substr($post['time'], 0, 5);?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<script>
function alternateColor() {
    
    var color = $('#type').val();
    var color_post = $('#container-post').attr('color');
    $('#container-post').removeClass(color_post);
    $('#container-post').attr('color', '');
    console.log(color, color_post);
    // return;
    if(color == '1'){
        $('#container-post').addClass('bg-warning');
        
        $('#container-post').attr('color', 'bg-warning');
    }else if(color == '2'){
        $('#container-post').addClass('bg-info');
        $('#container-post').attr('color', 'bg-info');
    }else if(color == '3'){
        $('#container-post').addClass('bg-primary');
        $('#container-post').attr('color', 'bg-primary');
    }else if(color == '4'){
        $('#container-post').addClass('bg-danger');
        $('#container-post').attr('color', 'bg-danger');
    }else{
        $('#container-post').addClass('bg-white');
        $('#container-post').attr('color', 'bg-white');
    }
    return;
}
</script>
<?php
include_once('layout/_footer.php');
;?>