<?php 
require_once __DIR__.'/app/utils/root_dir_path.php';
require_once $root_dir_path.'/app/views/partials/header.php';
?>

<h1>Coming soon.</h1>

<a href="<?=$root_url?>/app/user/login">Entrar</a>
<a href="<?=$root_url?>/app/user/register">Cadastrar</a>
<a href="#programacao">Programação</a>

<?php require_once $root_dir_path.'/app/views/partials/footer.php' ?>
