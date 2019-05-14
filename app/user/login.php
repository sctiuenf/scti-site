<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/app/views/partials/header.php';

?> 

    <form action="authenticate" method="post">
        <label>Email</label>
        <input name="email" type="email" placeholder="Email">
        <label>Senha</label>
        <input name="password" type="password" placeholder="Senha">
        <input type="submit" value="Confirmar">
    </form>

<?php require_once $root_dir_path.'/app/views/partials/footer.php' ?>