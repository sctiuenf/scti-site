<?php 
require_once __DIR__.'/utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';
require_once $root_dir_path.'/models/User.php';
?>

<main class="home-main">
    <section id="banner" class="container-fluid gradient-banner vh-100 row align-items-center ">
        <div class="row container-fluid">
        <div class="col-12">
        <div class="row justify-content-center">
            <div class="main-logo">
                <img src="assets/imgs/logo_branco.png">
            </div>
        </div>
        <div class="row justify-content-center">
            <p class="title">9ª Semana de Ciência da Computação e Tecnologia da Informação<br><span class="subtitle">04 a 09 de novembro no Centro de Convenções da UENF</span></p>
            
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-info" onclick="window.location.href='user/access'">Inscreva-se</button>
        </div>
</div>
        </div>
    </section>
    <section class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <h2>/ Sobre</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti alias itaque ipsa, ipsam voluptatum ratione earum consequatur incidunt doloribus ad libero tempora ea est illum, totam praesentium nihil ullam pariatur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere quisquam labore, repudiandae assumenda fuga deserunt id debitis, sint beatae commodi ad illum quibusdam quas, accusantium nisi hic! Mollitia, corporis dolores! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit harum nisi cumque et quaerat ullam cupiditate placeat pariatur maxime numquam explicabo quidem veritatis odio nam eos officiis, animi quo vel.</p>

            
            <div class="row events justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/lecture.png">
                                </div> 
                            </div>
                            <h4>Palestras</h4>
                            <div class="row text-justify px-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis veniam eius tempore, facere nam sapiente nulla facilis?</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/minicourse.png">
                                </div>
                            </div>
                            <h4>Minicursos</h4>
                            <div class="row text-justify px-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis veniam eius tempore, facere nam sapiente nulla facilis?</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/networking.png">
                                </div>
                            </div>
                            <h4>Networking</h4>
                            <div class="row text-justify px-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis veniam eius tempore, facere nam sapiente nulla facilis?</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/coffee-break.png">
                                </div>
                            </div>
                            <h4>Coffee-break</h4>
                            <div class="row text-justify px-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis veniam eius tempore, facere nam sapiente nulla facilis?</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/gift.png">
                                </div>
                            </div>
                            <h4>Brindes e sorteios</h4>
                            <div class="row text-justify px-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis veniam eius tempore, facere nam sapiente nulla facilis?</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/championship.png">
                                </div>
                            </div>
                            <h4>Competições</h4>
                            <div class="row text-justify px-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis veniam eius tempore, facere nam sapiente nulla facilis?</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="programacao" class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <h2>/ Programação</h2>

            <div class="scroll-carousel">
                
                    <div class="day-circle-container">
                        <div class="day-circle">4<br>Segunda</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                
              
                    <div class="day-circle-container">
                        <div class="day-circle">5<br>Terça</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
               
           
                    <div class="day-circle-container">
                        <div class="day-circle">6<br>Quarta</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
              
         
                    <div class="day-circle-container">
                        <div class="day-circle">7<br>Quinta</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
           
          
                    <div class="day-circle-container">
                        <div class="day-circle">8<br>Sexta</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
           
    
                    <div class="day-circle-container">
                        <div class="day-circle">9<br>Sábado</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
            
            </div>
        </div>
    </section>
    <section class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <h2>/ Patrocinadores</h2>
        </div>
    </section>

    <section class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
        <h2>/ Contato</h2>
            <div class="row justify-content-center">
            <div class="col-12 col-md-7 mr-3"> 
                    <p>Tem dúvidas, críticas ou sugestões?<br>
                    Tem uma empresa e gostaria de apoiar o evento?<br>
                    Entre em contato com a gente!</p>
                    <div class="row justify-content-center">
                        <div class="col-12">
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
                </div>
                <div class="col-12 col-md-4 mt-5">
                    <div class="row mb-1">
                        <div class="col-1 pr-0"><i class="fab fa-facebook-f text-gradient"></i></div>
                        <div class="col-11 pl-4 pr-0">/sctiuenf</div>
                    </div>
                    <div class="row mb-1"> 
                        <div class="col-1 pr-0"><i class="fab fa-instagram text-gradient"></i></div>
                        <div class="col-11 pl-4 pr-0">@sctiuenf</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-1 pr-0"><i class="fas fa-phone text-gradient"></i></div>
                        <div class="col-11 pl-4 pr-0">(22)91231-1231</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-1 pr-0"><i class="fas fa-envelope text-gradient"></i></div>
                        <div class="col-11 pl-4 pr-0">sctiuenf@gmail.com</div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-1 pr-0"><i class="fas fa-map-marker-alt text-gradient"></i></div>
                        <div class="col-11 pl-4 pr-0">Universidade Estadual do Norte Fluminense Darcy Ribeiro, Av. Alberto Lamego, 2000 - Parque Califórnia, Campos dos Goytacazes - RJ, CEP: 28013-602</div>
                    </div>
                </div>

            </div>
        </div>
        
    </section>
    <div style="position:relative; overflow:hidden;">
        <iframe style="position:absolute; top:0; left:0; width:100%; height:100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3705.4356947356514!2d-41.29398945029754!3d-21.763392303468844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xbdd5908f484d27%3A0x8c06a7ab4cbb9289!2sUENF!5e0!3m2!1spt-BR!2sbr!4v1560035526059!5m2!1spt-BR!2sbr" width="1920" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>
