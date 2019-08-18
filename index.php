<?php 
require_once __DIR__.'/utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';
require_once $root_dir_path.'/models/User.php';
?>

<main class="home-main">
    <section id="banner" class="container-fluid gradient-banner vh-100 row align-items-center ">
        <canvas id="drawCanvas"></canvas>
        <div class="row container-fluid">
        <div class="col-12">
        <div class="row justify-content-center">
            <div class="main-logo">
                <img src="assets/imgs/logo_branco.png" alt="SCTI">
            </div>
        </div>
        <div class="row justify-content-center">
            <h1 class="title">9ª Semana de Ciência da Computação e Tecnologia da Informação<br><span class="subtitle">04 a 09 de novembro no Centro de Convenções da UENF</span></h1>
            
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-3d-secondary mt-3" onclick="window.location.href='user/access'">Inscreva-se</button>
        </div>
        </div>
        </div>
    </section>
    <section id="sec-sobre" class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <h2>/ Sobre</h2>
            <p>A Semana de Ciência da Computação e Tecnologia da Informação da UENF (SCTI) tem como principais objetivos o aprimoramento técnico-científico dos par&shy;ti&shy;ci&shy;pan&shy;tes, a difusão de novas tecnologias e a aproximação dos estudantes uni&shy;ver&shy;sitários com a realidade do mercado de trabalho. A SCTI busca também incentivar e mo&shy;tivar a pesquisa científica, a inovação tecnológica e o em&shy;preende&shy;dorismo na região, fortalecendo a formação dos alunos de graduação em Ciência da Com&shy;pu&shy;ta&shy;ção e áreas afins e oferecendo a oportunidade de conhecer tópicos não abordados nos cursos regulares. Confira abaixo as atividades que você pode aproveitar durante o evento:</p>

            
            <div class="row events justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/lecture2.png" alt="">
                                </div> 
                            </div>
                            <h3 class="text-center">Palestras</h3>
                            <div class="row text-justify px-3">As palestras são uma ótima oportunidade de aprendizado com vários profissionais de diversas áreas apresentando temas super atuais no mercado de trabalho. Você não pode ficar de fora!</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/minicourse.png" alt="">
                                </div>
                            </div>
                            <h3 class="text-center">Minicursos</h3>
                            <div class="row text-justify px-3">Os minicursos são uma ótima maneira de introduzir técnicas, ferramentas e boas práticas que podem ser essenciais para sua carreira na área de computação. Quer aprender rápido e com uma visão geral do assunto? Então vem!</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/networking.png" alt="">
                                </div>
                            </div>
                            <h3 class="text-center">Networking</h3>
                            <div class="row text-justify px-3">Um dos pontos altos do evento é a possibilidade de conhecer gente nova da área da informática e afins, em busca de aprendizado, oportunidades e de compartilhar boas histórias. Queremos te conhecer :)</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/coffee-break.png" alt="">
                                </div>
                            </div>
                            <h3 class="text-center">Coffee break</h3>
                            <div class="row text-justify px-3">Não precisa ficar com fome durante a SCTI. A gente dá uma pausa, faz uma boquinha, bate um papo e volta com todo gás para mais uma carga de conhecimento. Além disso, a gente capricha nos petiscos!</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/gift.png" alt="">
                                </div>
                            </div>
                            <h3 class="text-center">Brindes e sorteios</h3>
                            <div class="row text-justify px-3">Se inscrevendo agora você garante os brindes que a comissão do evento oferece aos participantes. Além dos diversos livros, cursos, cupons de desconto e muitas outras coisas bacanas que são sorteadas para os participantes presentes.</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 py-4">
                            <div class="row justify-content-center mb-3">
                                <div class="circle gradient row">
                                    <img class="col-12" src="assets/imgs/championship.png" alt="">
                                </div>
                            </div>
                            <h3 class="text-center">Competições</h3>
                            <div class="row text-justify px-3">A novidade da edição desse ano são as competições! Teste suas habilidades numa competição de programação, e seja consciente trazendo seu lixo eletrônico para um descarte adequado (e com prêmios hehe).</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="programacao" class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <h2>/ Programação</h2>
            <p style="margin-bottom:3rem;">Preparamos uma programação muito bacana contando tudo vai rolar no evento do dia <b>4 (segunda-feira) ao 9 (sábado)</b> de novembro. Ah! O <b>credenciamento</b> é realizado a partir das <b>07:30 horas</b>, durante todo o evento. Além disso, contamos com um <b>coffee-break</b> caprichado todos os dias na pausa do minicurso de <b>10:00 às 10:30</b>, e outro um pouquinho maior de <b>16:00 às 17:00</b> visando o networking entre os participantes e convidados, e outras atividades bem legais :) Vale lembrar que a elaboração da programação está em andamento, então fique ligado nos próximos eventos anunciados ;) </p>

            <div class="day-slider slider">
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
            </div>
          
            <select class="form-control" id="day-select">
                <option value="4">Segunda-feira</option>
                <option value="5">Terça-feira</option>
                <option value="6">Quarta-feira</option>
                <option value="7">Quinta-feira</option>
                <option value="8">Sexta-feira</option>
                <option value="9">Sábado-feira</option>
            </select>
          
            <div id="programacao-slider" class="card-slider slider">
                <!-- Programação do evento -->
            </div>
        </div>
    </section>
    <section id="patrocinadores-sec" class="container-fluid justify-content-center d-flex">
        <div class="col-12 col-sm-11 col-xl-10">
            <!--<h2>/ Patrocinadores</h2>-->

            <h3 class="text-center">Patrocínio Diamante</h3>
            <div class="container-fluid sponsors diamante">
                <div class="row justify-content-center align-items-center">
                
                    <a class="row justify-content-center align-items-center" href="https://www.respondeai.com.br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/respondeai.jpeg" alt="Responde aí"></a>
                   
                </div>
            </div>

            <h3 class="text-center">Patrocínio Prata</h3>
            <div class="container-fluid sponsors prata">
                <div class="row justify-content-around align-items-center">
                   
                    <a class="row justify-content-center align-items-center" href="https://www.alura.com.br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/alura.jpeg" alt="Alura cursos online de tecnologia"></a>
                
                    <a class="row justify-content-center align-items-center" href="http://choicessistemas.com.br/" target="_blank" rel="noopener"><img class="img-fluid choices" src="assets/imgs/patrocinadores/choices.jpeg" alt="Choices Sistemas"></a>
                
                    <a class="row justify-content-center align-items-center" href="http://www.fortetelecom.com.br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/fortetelecom.jpeg" alt="Forte Telecom"></a>
                </div>
            </div>

            <h3 class="text-center">Patrocínio Bronze</h3>
            <div class="container-fluid sponsors bronze">
                <div class="row justify-content-around align-items-center">
                 
                    <a class="row justify-content-center align-items-center" href="https://www.facebook.com/cerejalojanerd/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/cerejanerd.jpeg" alt="Loja Cereja Nerd"></a>
            
                    <a class="row justify-content-center align-items-center" href="https://www.facebook.com/camposinfotrade/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/infotrade.jpeg" alt="Info Trade"></a>
            
                    <a class="row justify-content-center align-items-center" href="https://www.stickersdevs.com.br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/stickersdev.jpeg" alt="Stickers Dev"></a>
                  
                </div>
            </div>

            <h3 class="text-center">Apoio</h3>
            <div class="container-fluid sponsors apoio">
                <div class="row justify-content-around align-items-center">
                 
                    <a class="row justify-content-center align-items-center" href="https://www.facebook.com/alobrownie/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/alobrownie.jpeg" alt="Alô Brownie"></a>
                   
                </div>
            </div>

            <h3 class="text-center">Apoio institucional</h3>
            <div class="container-fluid sponsors apoio-inst">
                <div class="row justify-content-around align-items-center">
                 
                    <a class="row justify-content-center align-items-center" href="http://cc.uenf.br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/computacao.jpeg" alt="Ciência da Computação UENF"></a>
                
                    <a class="row justify-content-center align-items-center" href="http://www.uenf.br/portal/index.php/br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/uenf.jpeg" alt="UENF"></a>
            
                     <a class="row justify-content-center align-items-center" href="https://www.campos.rj.gov.br/" target="_blank" rel="noopener"><img class="img-fluid" src="assets/imgs/patrocinadores/prefeituracampos.jpeg" alt="Prefeitura de Campos dos Goytacazes"></a>
                  
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
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Falha ao enviar mensagem. Por favor, contate a equipe através do email: sctiuenf@gmail.com.
                </div>
                    <p>Tem dúvidas, críticas ou sugestões?<br>
                    Tem uma empresa e gostaria de apoiar o evento?<br>
                    Entre em contato com a gente!</p>
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                        <form class="w-100" id="contact" method="post">
                            <div class="form-group">
                                
                                <input id="email" class="form-control" required name="email" type="email">
                                <label for="email" class="label-float">Email</label>
                            </div>
                            <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input id="firstname" class="form-control" required name="firstname" type="text">
                                            <label for="firstname" class="label-float">Nome</label>
                                        </div>
                                    </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        
                                        <input id="phone" pattern="[\(][0-9]{2}[\)] [0-9]{1} [0-9]{4}[\-][0-9]{4}" class="form-control" name="phone" type="tel" maxlength="16">
                                        <label for="phone" class="label-float">Telefone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <div class="row container mx-0 px-0">
                                    <textarea id="message" required name="message" class="form-control"></textarea>
                                    <label for="message" class="label-float">Digite sua mensagem</label>
                                </div>
                            </div>
                            <input class="btn btn-3d-primary" type="submit" value="Enviar">
                        </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-5" id="scti-info">
                    <div class="row mb-1">
                        <a class="col-1 pr-0" href="https://www.facebook.com/sctiuenf/" target="_blank" rel="noopener" title="facebook"><i class="fab fa-facebook-f text-gradient"></i></a>
                        <div class="col-11 pl-4 pr-0">/sctiuenf</div>
                    </div>
                    <div class="row mb-1"> 
                        <a class="col-1 pr-0" href="https://www.instagram.com/sctiuenf/" target="_blank" rel="noopener"><i class="fab fa-instagram text-gradient" title="instagram"></i></a>
                        <div class="col-11 pl-4 pr-0">@sctiuenf</div>
                    </div>
                    <div class="row mb-1">
                        <a class="col-1 pr-0" href="tel:(22)91231-1231" rel="noopener" title="telefone"><i class="fas fa-phone text-gradient"></i></a>
                        <div class="col-11 pl-4 pr-0">(22) 91231-1231</div>
                    </div>
                    <div class="row mb-1">
                        <a class="col-1 pr-0" href="mailto:sctiuenf@gmail.com" rel="noopener" title="email"><i class="fas fa-envelope text-gradient"></i></a>
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
        <iframe title="Mapa da UENF" style="position:absolute; top:-50px; left:0; width:100%; height: calc(100% + 50px);" src="https://www.google.com/maps/d/embed?mid=1XbXpi0odlYGq3b-98rMmPHlTxk5Xz_Et&hl=pt-BR" width="1920" height="200" allowfullscreen frameborder="0"></iframe>
    </div>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>
