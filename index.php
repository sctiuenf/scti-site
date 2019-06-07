<?php 
require_once __DIR__.'/utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';
require_once $root_dir_path.'/models/User.php';
?>

<main class="home-main gradient">
    <section id="banner" class="container-fluid gradient">
        <div class="row justify-content-center">
            <div class="main-logo">
                <img src="assets/imgs/logo_branco.png">
            </div>
        </div>
        <div class="row justify-content-center">
            <p class="title">9ª Semana de Ciência da Computação e Tecnologia da Informação</p>
        </div>
        <div class="row justify-content-center">
            <button onclick="window.location.href='user/access'">Inscreva-se</button>
        </div>
    </section>
    <section class="container-fluid">
            <h2>/ Sobre</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti alias itaque ipsa, ipsam voluptatum ratione earum consequatur incidunt doloribus ad libero tempora ea est illum, totam praesentium nihil ullam pariatur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere quisquam labore, repudiandae assumenda fuga deserunt id debitis, sint beatae commodi ad illum quibusdam quas, accusantium nisi hic! Mollitia, corporis dolores! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit harum nisi cumque et quaerat ullam cupiditate placeat pariatur maxime numquam explicabo quidem veritatis odio nam eos officiis, animi quo vel.</p>

            <div class="row events">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="row justify-content-center">aaaa</div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="row justify-content-center">aaaa</div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="row justify-content-center">aaaa</div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="row justify-content-center">aaaa</div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="row justify-content-center">aaaa</div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="row justify-content-center">aaaa</div>
                </div>
            </div>
    </section>
    <section class="container-fluid">
        <h2>/ Programação</h2>
    </section>
    <section class="container-fluid">
        <h2>/ Contato</h2>
        <p>Tem dúvidas, críticas ou sugestões?<br>
        Tem uma empresa e gostaria de apoiar o evento?<br>
        Entre em contato com a gente!</p>
        <div class="row justify-content-center p-5">
        <div class="row w-50">
        <form class="w-100" id="contact" method="post">
            <div class="form-group">
                
                <input id="email" class="form-control" required name="email" type="email">
                <label for="email">Email</label>
            </div>
            <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                           
                            <input id="firstname" class="form-control" required name="firstname" type="text">
                            <label for="firstname">Nome</label>
                        </div>
                    </div>
                <div class="col-6">
                    <div class="form-group">
                        
                        <input id="phone" class="form-control" name="phone" type="tel" pattern="[0-9]{11}">
                        <label for="phone">Telefone</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                
                <div class="row container">
                    <textarea id="message" required name="message" class="form-control"></textarea>
                    <label for="message">Digite sua mensagem</label>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Enviar">
        </form>
        </div>
    </div>
    </section>
    <section class="container-fluid">
        <h2>/ Informações</h2>
    </section>
    <section class="container-fluid">
        <h2>/ Patrocinadores</h2>
    </section>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>
