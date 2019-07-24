<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/config/eventDate.php';
require_once $root_dir_path.'/views/partials/header.php';
require_once $root_dir_path.'/models/Shirt.php';
require_once $root_dir_path.'/models/Event.php';

if(!isset($_SESSION['logged'])){
    header('Location: '.$root_url);
    die;
}else{
    $user = unserialize($_SESSION['user']);
    $userInfo = $user->getInfo();
}
?>

<button class="scroll-down">v</button>

<main class="container-fluid account">
    <section id="user-info" class="container-fluid">
        <div class="row h-100 align-items-center px-3">
          
            <div class="col-12 col-lg-6 h-75">
                <?php if(!$user->hasPayment()){ ?>
                <!-- Noscript content for added SEO -->
                <noscript><a href="https://www.eventbrite.com/e/scti-2019-teste-tickets-62441107032" rel="noopener noreferrer" target="_blank"></noscript>
                    <!-- You can customize this button any way you like -->
                    <button id="eventbrite-widget-modal-trigger-62441107032" type="button">Buy Tickets</button>
                    <noscript></a>Buy Tickets on Eventbrite</noscript>

                    <script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>

                    <script type="text/javascript">
                        var exampleCallback = function() {
                            console.log('Order complete!');
                        };

                        window.EBWidgets.createWidget({
                            widgetType: 'checkout',
                            eventId: '62441107032',
                            modal: true,
                            modalTriggerElementId: 'eventbrite-widget-modal-trigger-62441107032',
                            onOrderComplete: exampleCallback
                        });
                    </script>

                    <form id="verifyPayment" method="POST">
                        <div class="form-group">
                            <input required class="form-control" name="codigoPedido" type="text" placeholder="Código do pedido">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Confirmar">
                    </form>
                    <?php }else{ ?>
                        <div class="row align-items-center justify-content-center h-100">
                            <div class="row m-0">
                                
                            </div>
                        </div>
                <?php } ?>
            </div>
  
        <div class="col-6 d-flex justify-content-center align-items-center">
        <div class="row w-75">
        <form class="w-100" id="change" method="post">
        <h1 class="mb-4">Informações pessoais</h1>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" required name="firstname" type="text" value="<?=$userInfo['firstName']?>">
                        <label class="translated-label">Nome</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" required name="lastname" type="text" value="<?=$userInfo['lastName']?>">
                        <label class="translated-label">Sobrenome</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" required name="email" type="email" value="<?=$userInfo['email']?>">
                <label class="translated-label">Email</label>
            </div>
            <div class="form-group">
                <input class="form-control" name="phone" type="tel" pattern="[0-9]{11}" value="<?=$userInfo['phone']?>">
                <label class="<?php echo count($userInfo['phone']) > 0 ? 'translated-label':''?>">Telefone</label>
            </div>
            <div class="row">
                <input class="btn btn-primary" type="submit" value="Cadastrar">
                <input class="btn btn-secondary" type="submit" value="Alterar senha">
            </div>
            
            
        </form>
        </div>
    </div>
        </div>
    </section>
    <?php 
        $day = date('j', strtotime(COURSE_END))-1;
        $month = MONTHS[$month = date('m', strtotime(COURSE_END))];
    ?>
    <section id="courses" class="container-fluid">
        <div class="row h-100 align-items-center pt-5 px-3">
            <div class="col-12 col-lg-3 h-25">
                <h1 class="sec-title">Escolha dois cursos incríveis!</h1>
                <p class="sec-text">E não se preocupe, você pode alterar os cursos escolhidos até o dia <?=$day?> de <?=$month?></p>
                <div class="sec-text help">
                    Vagas alternativas
                    <button data-toggle="popover" data-placement="bottom" data-trigger="focus" data-content="As vagas alternativas são destinadas a participantes que possam levar seu próprio notebook para participarem dos minicursos.">
                        <i class="far fa-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-9 pl-3 h-75">
                <div id="courses-slider" class="">

                </div>

                 <!-- Modal de requisitos de curso -->
                 <div class="modal fade" id="requisitos-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pré-requisitos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Pra esse curso é necessário que você tenha conhecimento de: </p>
                            <p id="modal-req-tec"></p>
                            <p>Caso vá levar seu próprio notebook, prepare-o com:</p>
                            <p id="modal-req-org"></p>
                        </div>
                        <div class="modal-footer">
                            <div class="btns-confirm">
                                <button data-dismiss="modal" type="button" class="btn btn-primary">Ok</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                <div class="sec-btns">
                    <button data-toggle="modal" data-target="#course-confirm-modal" id="confirm-courses" class="btn btn-primary">Confirmar</button>
                  

                    <!-- Modal de confirmação de curso -->
                    <div class="modal fade" id="course-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="modal-courses"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="btns-confirm">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button id="confirm-course-btn" type="button" class="btn btn-primary">Confirmar</button>
                            </div>
                            <div class="btn-ok">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php 
        $day = date('j', strtotime(SHIRT_END))-1;
        $month = MONTHS[$month = date('m', strtotime(SHIRT_END))];
    ?>
    <section id="shirts" class="container-fluid">
    <div class="row h-100 align-items-center pt-5 px-3">
            <div class="col-12 col-lg-3 h-25">
                <h1 class="sec-title">Escolha sua camisa :)</h1>
                <p class="sec-text">Uma dessas camisas iradas é sua! Escolhe a que mais gostar, e manda ver.</p>
                <p class="sec-text">*A camisa escolhida pode ser alterada até o dia <?=$day?> de <?=$month?>.</p>
            </div>
            <div class="col-12 col-lg-9 pl-3 h-75">
                <div id="shirt-slider" class="">

                </div>
                <div class="sec-btns">
                    <button data-toggle="modal" data-target="#shirt-confirm-modal" id="confirm-shirt" class="btn btn-primary">Confirmar</button>

                     <!-- Modal de confirmação de curso -->
                     <div class="modal fade" id="shirt-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="modal-shirt"></div>
                        </div>
                        <div class="modal-footer">
                            <div class="btns-confirm">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button id="confirm-shirt-btn" type="button" class="btn btn-primary">Confirmar</button>
                            </div>
                            <div class="btn-ok">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?=$root_url?>/assets/js/requests/chooseRequests.js"></script>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>