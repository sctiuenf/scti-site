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
                            <h4 class="text-center">Palestras</h4>
                            <div class="row text-justify px-3">As palestras são uma ótima oportunidade de aprendizado com vários profissionais de diversas áreas apresentando temas super atuais no mercado de trabalho. Você não pode ficar de fora!!</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/minicourse.png">
                                </div>
                            </div>
                            <h4 class="text-center">Minicursos</h4>
                            <div class="row text-justify px-3">Os minicursos são uma ótima maneira de introduzir técnicas, ferramentas e boas práticas que podem ser essenciais para sua carreira na área de computação. Quer aprender rápido e com uma visão geral do assunto? Então vem!</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/networking.png">
                                </div>
                            </div>
                            <h4 class="text-center">Networking</h4>
                            <div class="row text-justify px-3">Um dos pontos altos do evento é a possibilidade de conhecer gente nova da área da informática e afins, em busca de aprendizado, oportunidades e de compartilhar boas histórias. Queremos te conhecer :D</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/coffee-break.png">
                                </div>
                            </div>
                            <h4 class="text-center">Coffee-break</h4>
                            <div class="row text-justify px-3">Não precisa ficar com fome durante a SCTI. A gente dá uma pausa, faz uma boquinha, bate um papo e volta com todo gás para mais uma carga de conhecimento. Além disso, a gente capricha nos petiscos!!</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/gift.png">
                                </div>
                            </div>
                            <h4 class="text-center">Brindes e sorteios</h4>
                            <div class="row text-justify px-3">Se inscrevendo agora você garante os brindes que a comissão do evento oferece aos participantes. Além dos diversos livros, cursos, cupons de desconto e muitas outras coisas bacanas que são sorteadas para os participantes presentes.</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/championship.png">
                                </div>
                            </div>
                            <h4 class="text-center">Competições</h4>
                            <div class="row text-justify px-3">A novidade da edição desse ano são as competições! Teste suas habilidades numa competição de programação, e seja consciente trazendo seu lixo eletrônico para um descarte adequado(e com prêmios hehe).</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="programacao" class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <h2 style="margin-bottom:3rem;">/ Programação</h2>
           
            <section class="day-slider slider">
                <div class="slide">
                    <div class="day-circle-container">
                        <div id="day-4" class="day-circle circle-hovered">4<br>Segunda</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                </div>

                <div class="slide">
                    <div class="slide day-circle-container">
                        <div id="day-5" class="day-circle">5<br>Terça</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                </div>
            
                <div class="slide">
                    <div class="slide day-circle-container">
                        <div id="day-6" class="day-circle">6<br>Quarta</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                </div>
            
                <div class="slide">
                    <div class="slide day-circle-container">
                        <div id="day-7" class="day-circle">7<br>Quinta</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                </div>

                <div class="slide">
                    <div class="slide day-circle-container">
                        <div id="day-8" class="day-circle">8<br>Sexta</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                </div>
        
                <div class="slide">
                    <div class="slide day-circle-container">
                        <div id="day-9" class="day-circle">9<br>Sábado</div>
                        <div class="day-circle-border">&nbsp;</div>
                    </div>
                </div>
            </section>
          
            <section id="programacao-slider" class="card-slider slider">
                <!-- Programação do evento -->
            </section>
        </div>
    </section>
    <section class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <!--<h2>/ Patrocinadores</h2>-->

            <h3 class="text-center">Patrocínio Diamante</h3>
            <div class="container-fluid sponsors diamante">
                <div class="row justify-content-center align-items-center">
                
                    <img class="img-fluid" src="assets/imgs/patrocinadores/respondeai.jpeg">
                   
                </div>
            </div>

            <h3 class="text-center">Patrocínio Prata</h3>
            <div class="container-fluid sponsors prata">
                <div class="row justify-content-around align-items-center">
                   
                    <img class="img-fluid" src="assets/imgs/patrocinadores/alura.jpeg">
                
                    <img class="img-fluid choices" src="assets/imgs/patrocinadores/choices.jpeg">
                
                    <img class="img-fluid" src="assets/imgs/patrocinadores/fortetelecom.jpeg">
                </div>
            </div>

            <h3 class="text-center">Patrocínio Bronze</h3>
            <div class="container-fluid sponsors bronze">
                <div class="row justify-content-around align-items-center">
                 
                    <img class="img-fluid" src="assets/imgs/patrocinadores/cerejanerd.jpeg">
            
                    <img class="img-fluid" src="assets/imgs/patrocinadores/infotrade.jpeg">
            
                    <img class="img-fluid" src="assets/imgs/patrocinadores/stickersdev.jpeg">
                  
                </div>
            </div>

            <h3 class="text-center">Apoio</h3>
            <div class="container-fluid sponsors apoio">
                <div class="row justify-content-around align-items-center">
                 
                    <img class="img-fluid" src="assets/imgs/patrocinadores/alobrownie.jpeg">
                   
                </div>
            </div>

            <h3 class="text-center">Apoio institucional</h3>
            <div class="container-fluid sponsors apoio-inst">
                <div class="row justify-content-around align-items-center">
                 
                    <img class="img-fluid" src="assets/imgs/patrocinadores/computacao.jpeg">
                
                    <img class="img-fluid" src="assets/imgs/patrocinadores/uenf.jpeg">
            
                    <img class="img-fluid" src="assets/imgs/patrocinadores/prefeituracampos.jpeg">
                  
                </div>
            </div>
        </div>
    </section>

    <section id="sec-contato" class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
        <h2>/ Contato</h2>
            <div class="row justify-content-center">
            <div class="col-12 col-md-7 mr-3"> 
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Sua mensagem foi enviada com sucesso!
                </div>
                <div class="alert alert-danger alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Falha ao enviar mensagem. Por favor, contate a equipe através do email: sctiuenf@gmail.com.
                </div>
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
    <div style="position:relative; overflow:hidden; height: 200px; width: 100%;">
        <iframe style="position:absolute; top:-50px; left:0; width:100%; height: calc(100% + 50px);" src="https://www.google.com/maps/d/embed?mid=1XbXpi0odlYGq3b-98rMmPHlTxk5Xz_Et&hl=pt-BR" width="1920" height="200" allowfullscreen frameborder="0"></iframe>
    </div>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>
