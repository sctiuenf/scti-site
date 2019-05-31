<?php 
require_once __DIR__.'/utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';
require_once $root_dir_path.'/models/User.php';
?>

<h1>Coming soon.</h1>
<?php
if(isset($_SESSION['logged'])){ ?>
<h2>Bem vindo, <?=$user->getName()?>!</h2>
<?php } ?>


<?php require_once $root_dir_path.'/views/partials/footer.php' ?>
