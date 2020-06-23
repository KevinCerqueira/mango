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
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="description" cols="" class="form-control" maxlength="100"
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
            <p name="description" type="text" id="description" class="border form-control" style="word-wrap: break-word;">
                <?php echo $user['description'];?></p>
        </div>
        <button class="btn-edit btn btn-dark btn-block" data-toggle="modal" data-target="#edit-description">
            Editar
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
    </div>
</div>
<div id="container-post" color="bg-info" class="container-fluid  p-4 border-20 bg-info mt-2">
    <p class="h3">Novo Postshit</p>
    <form action="new_post.php" method="post">
        <div class="form-group">
            <input required maxlength="50" name="title" placeholder="Assunto" type="text" class="form-control">
        </div>
        <div class="form-group">
            <textarea required maxlength="170" name="body" placeholder="Texto" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <select onchange="alternateColor()" name="type" id="type" class="form-control">
                <?php foreach($types_posts as $type_post):?>
                <option color="bg-<?php echo $type_post['type_name'];?>"
                    value="<?php echo $type_post['type_post_ID'];?>">
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