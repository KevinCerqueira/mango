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
                minlength="3" maxlength="16" placeholder="Repita a senha" type="text" class="form-control">
            <?php unset($_SESSION['nickname_login']);else:?>
            <input required name="nickname" id="nickname" minlength="3" maxlength="16" placeholder="Usuário" type="text"
                class="form-control">
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
            <input required name="password1" id="password1" minlength="6" maxlength="12" placeholder="Repita a senha"
                type="password" class="form-control">
        </div>
        <button class="btn btn-info">Cadastrar</button>
        <div>
            <small>
                Por cadastrar-se, você está aceita os <a href="terms-and-conditions.php">Termos de serviçoes e a
                    Política
                    de privacidade.</a>
            </small>
        </div>
    </form>
</div>