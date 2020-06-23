<div class="col-md-9">
    <div class="container-fluid bg-white p-4 border-20">
        <p class="h3">#1 Postshit</p>
        <?php if($topPost_empty):?>
        <p class="h5 font-weight-light">Não há um TOP Post no momento.</p>
        <?php else:?>
        <div class="container-fluid bg-<?php echo $topPost['type_name'];?> shadow pt-3 border-20 mt-2 pb-1">
            <p class="h5" style="word-wrap: break-word;">
                <?php echo $topPost['icon'];?>
                <?php echo $topPost['title'];?>
            </p>
            <p class="post-body" style="word-wrap: break-word;font-size: 24px">
                <?php echo $topPost['body'];?>
            </p>
            <hr class="mb-0">
            <div class="row text-center">
                <div class="col-sm-3 p-0">
                    <form name="interaction_like" action="post_interaction.php" method="post" class="mt-1">
                        <input type="hidden" name="post_ID" value="<?php echo $topPost['post_ID'];?>">
                        <?php if($login && PostController::isInteraction($_SESSION['ID'], $topPost['post_ID'])):?>
                        <?php $interaction = PostController::getInteraction($_SESSION['ID'], $topPost['post_ID']);?>
                        <?php if($interaction['like_unlike'] == 'like'):?>

                        <a style="font-size:20px" like_unlike="true" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="true" data-toggle="button" type="submit"
                            id="like<?php echo $topPost['post_ID'];?>"
                            class="btn-like border-100 mr-3 btn pb-0 text-light">
                            <i class="fa fa-angle-double-up"></i>
                            <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                        </a>

                        <a style="font-size:20px" like_unlike="false" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="false" data-toggle="button" type="submit"
                            id="unlike<?php echo $topPost['post_ID'];?>" class="btn-unlike ml-3 btn pb-0 text-dark">
                            <i class="fa fa-angle-double-down"></i>
                            <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                        </a>
                        <?php elseif($interaction['like_unlike'] == 'unlike'):?>
                        <a style="font-size:20px" like_unlike="false" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="false" data-toggle="button" type="submit"
                            id="like<?php echo $topPost['post_ID'];?>"
                            class="btn-like border-100 mr-3 btn pb-0 text-dark">
                            <i class="fa fa-angle-double-up"></i>
                            <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                        </a>

                        <a style="font-size:20px" like_unlike="true" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="true" data-toggle="button" type="submit"
                            id="unlike<?php echo $topPost['post_ID'];?>" class="btn-unlike ml-3 btn pb-0 text-light">
                            <i class="fa fa-angle-double-down"></i>
                            <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                        </a>
                        <?php else:?>
                        <a style="font-size:20px" like_unlike="false" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="false" data-toggle="button" type="submit"
                            id="like<?php echo $topPost['post_ID'];?>"
                            class="btn-like border-100 mr-3 btn pb-0 text-dark">
                            <i class="fa fa-angle-double-up"></i>
                            <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                        </a>

                        <a style="font-size:20px" like_unlike="false" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="false" data-toggle="button" type="submit"
                            id="unlike<?php echo $topPost['post_ID'];?>" class="btn-unlike ml-3 btn pb-0 text-dark">
                            <i class="fa fa-angle-double-down"></i>
                            <span class="countUnlikes<?php echo $topPost['post_ID'];?>"
                                id="labelUnlike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['unlike'];?></span>
                        </a>
                        <?php endif;?>
                        <?php else:?>
                        <a style="font-size:20px" like_unlike="false" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="false" data-toggle="button" type="submit"
                            id="like<?php echo $topPost['post_ID'];?>"
                            class="btn-like border-100 mr-3 btn pb-0 text-dark">
                            <i class="fa fa-angle-double-up"></i>
                            <span class="countLikes<?php echo $topPost['post_ID'];?>"
                                id="labelLike<?php echo $topPost['post_ID'];?>"><?php echo $topPost['like'];?></span>
                        </a>

                        <a style="font-size:20px" like_unlike="false" value="<?php echo $topPost['post_ID'];?>"
                            aria-pressed="false" data-toggle="button" type="submit"
                            id="unlike<?php echo $topPost['post_ID'];?>" class="btn-unlike ml-3 btn pb-0 text-dark">
                            <i class="fa fa-angle-double-down"></i>
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

        <?php if($login):?>
        <div class="custom-control custom-switch">
            <input status='off' type="checkbox" class="custom-control-input" id="turn-my-posts">
            <label class="custom-control-label" for="turn-my-posts">Somente meus posts</label>
        </div>
        <?php endif;?>


        <div id="feed">

            <?php if($posts_empty):?>
            <p class="h5 font-weight-light">Não há um posts no momento :'(... Que tal publicar um?</p>
            <?php else:?>
            <?php foreach($posts['posts'] as $post):?>
            <?php $userPopover = PostController::getUserFromPost($post['post_ID']);?>
            <?php if($login && $userPopover['nickname'] == $user['nickname']):?>
            <div class="container-fluid bg-<?php echo $post['type_name'];?> shadow pt-3 border-20 mt-2 pb-1">
                <?php else:?>
                <div
                    class="not-my-post container-fluid bg-<?php echo $post['type_name'];?> shadow pt-3 border-20 mt-2 pb-1">
                    <?php endif;?>
                    <p class="h5" style="word-wrap: break-word;">
                        <?php echo $post['icon'];?>
                        <?php echo $post['title'];?>
                    </p>
                    <p class="post-body" style="word-wrap: break-word;font-size: 24px">
                        <?php echo $post['body'];?>
                    </p>
                    <hr class="mb-0">
                    <div class="row text-center">
                        <div class="col-sm-3 p-0 ">
                            <form name="interaction_like" action="post_interaction.php" method="post" class="mt-1">
                                <input type="hidden" name="post_ID" value="<?php echo $post['post_ID'];?>">
                                <?php if($login && PostController::isInteraction($_SESSION['ID'], $post['post_ID'])):?>
                                <?php $interaction = PostController::getInteraction($_SESSION['ID'], $post['post_ID']);?>
                                <?php if($interaction['like_unlike'] == 'like'):?>

                                <a style="font-size:20px" like_unlike="true" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="true" data-toggle="button" type="submit"
                                    id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like border-100 mr-3 btn pb-0 text-light">
                                    <i class="fa fa-angle-double-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a style="font-size:20px" like_unlike="false" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="false" data-toggle="button" type="submit"
                                    id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike ml-3 btn pb-0 text-dark">
                                    <i class="fa fa-angle-double-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php elseif($interaction['like_unlike'] == 'unlike'):?>
                                <a style="font-size:20px" like_unlike="false" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="false" data-toggle="button" type="submit"
                                    id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like border-100 mr-3 btn pb-0 text-dark">
                                    <i class="fa fa-angle-double-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a style="font-size:20px" like_unlike="true" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="true" data-toggle="button" type="submit"
                                    id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike ml-3 btn pb-0 text-light">
                                    <i class="fa fa-angle-double-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php else:?>
                                <a style="font-size:20px" like_unlike="false" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="false" data-toggle="button" type="submit"
                                    id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like border-100 mr-3 btn pb-0 text-dark">
                                    <i class="fa fa-angle-double-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a style="font-size:20px" like_unlike="false" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="false" data-toggle="button" type="submit"
                                    id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike ml-3 btn pb-0 text-dark">
                                    <i class="fa fa-angle-double-down"></i>
                                    <span class="countUnlikes<?php echo $post['post_ID'];?>"
                                        id="labelUnlike<?php echo $post['post_ID'];?>"><?php echo $post['unlike'];?></span>
                                </a>
                                <?php endif;?>
                                <?php else:?>
                                <a style="font-size:20px" like_unlike="false" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="false" data-toggle="button" type="submit"
                                    id="like<?php echo $post['post_ID'];?>"
                                    class="btn-like border-100 mr-3 btn pb-0 text-dark">
                                    <i class="fa fa-angle-double-up"></i>
                                    <span class="countLikes<?php echo $post['post_ID'];?>"
                                        id="labelLike<?php echo $post['post_ID'];?>"><?php echo $post['like'];?></span>
                                </a>

                                <a style="font-size:20px" like_unlike="false" value="<?php echo $post['post_ID'];?>"
                                    aria-pressed="false" data-toggle="button" type="submit"
                                    id="unlike<?php echo $post['post_ID'];?>"
                                    class="btn-unlike ml-3 btn pb-0 text-dark">
                                    <i class="fa fa-angle-double-down"></i>
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
                            <a tabindex="0" class="btn" role="button" data-toggle="popover" data-trigger="focus"
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