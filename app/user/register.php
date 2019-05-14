<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/app/views/partials/header.php';
?> 
    <form action="create" method="post">
        <div class="form-group">
            <label>Nome</label>
            <input required name="firstname" type="text" placeholder="Nome">
            <label>Sobrenome</label>
            <input required name="lastname" type="text" placeholder="Sobrenome">
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input name="phone" type="tel" placeholder="Telefone" pattern="[0-9]{11}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input required name="email" type="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input required name="password" type="password" placeholder="Senha">
        </div>
        
        <input type="submit" value="Cadastrar">
    </form>
<?php require_once $root_dir_path.'/app/views/partials/footer.php' ?>