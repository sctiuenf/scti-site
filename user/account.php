<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/config/sympla.php';
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

    $hasPayment = $user->hasPayment();

    $paymentComplete =  $hasPayment && $user->getPaymentStatus() === 'A';
    $paymentPending = $hasPayment && $user->getPaymentStatus() !== 'A';

    if(!$hasPayment){
        $statusColor = 'status-ball-red';
        $statusMessage = 'Inscrição não realizada';
    }else{
        $paymentStatus = $user->getPaymentStatus();

        switch($paymentStatus){

            case 'A':
                $statusColor = 'status-ball-green';
                $statusMessage = 'Inscrição realizada';
                break;
            case 'P':
                $statusColor = 'status-ball-yellow';
                $statusMessage = 'Aguardando aprovação do pagamento';
                break;
            case 'NA':
                $statusColor = 'status-ball-orange';
                $statusMessage = 'Pagamento não aprovado';
                break;
            case 'NP':
                $statusColor = 'status-ball-orange';
                $statusMessage = 'Pagamento não concluido';
                break;
            case 'R':
                $statusColor = 'status-ball-orange';
                $statusMessage = 'Reembolso solicitado';
                break;
            case 'C':
                $statusColor = 'status-ball-red';
                $statusMessage = 'Pagamento cancelado';
                break;

        }


        $courses = '<li class="list-group-item">Vamo lá, escolhe seus cursos!</li>';
        $shirt = 'Tem uma camisa irada te esperando ali em baixo :)';

        if($paymentStatus == 'A'){
           
            $enrolls = $user->getEnrollments();
            if($enrolls){
                $courses = '';
                foreach($enrolls as $course){
                    $courses .= '<li class="list-group-item">'.$course['tituloEvento'].'</li>';
                }
            }
            $userShirt = $user->getShirt()[0];
            if($userShirt){
                $shirt = $userShirt['tituloBrinde'].' - '.$userShirt['tamanhoBrinde'];
            }   
        }
    }

}
?>

<?php if($paymentComplete){?>
    <button class="scroll-down" title="Rolar pra baixo"><i class="fas fa-chevron-down"></i></button>
<?php } ?>

<main class="container-fluid account">
    <section id="user-info" class="container-fluid">
        <div class="row h-100 align-items-center px-3">
          
            <div class="col-12 col-lg-6 h-75 left-side">
                        <div class="row h-100 align-items-center" >
                            <div class="col-12 status-container h-100">
                                <div class="status-col row align-items-center justify-content-center">
                                    <div class="col-12 col-sm-9 h-100" >
                                        <div class="row h-100 justify-content-center">
                                            <div class="card status">
                                                <div class="status-label">
                                                    <div class="row m-0">
                                                        <div class="<?=$statusColor?>">&nbsp;</div>
                                                        <span class="status-text"><?=$statusMessage?><span>
                                                    </div>

                                                    <?php if(!$paymentComplete && $paymentPending){ ?>
                                                    <button type="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Ao confirmar o pedido no Sympla, será disponibilizado um 'Nº do pedido', seja no próprio site, ou através de um email de confirmação. Basta inserir o código no campo abaixo para acompanhar o status do seu pedido/confirmar sua inscrição." aria-label="Código do pedido">
                                                        <i class="far fa-question-circle"></i>
                                                    </button>
                                                    <?php } ?>
                                                </div>

                                                <?php if($paymentPending){?>
                                                <button onclick="updatePaymentStatus()" class="btn btn-refresh"><i class="fas fa-sync-alt"></i></button>
                                                <?php }?>

                                            <?php 
                                            $list_display = '';
                                            $widget_display = '';
                                            if($paymentComplete){ 
                                                $widget_display = 'hide';
                                            }else
                                                $list_display = 'hide';
                                            ?>
                                                <div class="list-group-container <?=$list_display?>">
                                                <ul class="list-group m-0">
                                                    <li class="primary-bg light-color list-group-item">Cursos escolhidos</li>
                                                    <?=$courses?>
                                                </ul>
                                                <ul class="list-group">
                                                    <li class=" primary-bg light-color list-group-item">Camisa escolhida</li>
                                                    <li class="list-group-item"><?=$shirt?></li>
                                                </ul>
                                                </div>
                                                    

                                                <?php if(!$paymentComplete){ ?>
                                               <button class="mt-3 w-100 pl-5" type="button" data-html="true"  data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Caso deseje efetuar o pagamento da sua inscrição diretamente com a comissão organizadora do evento, entre em <a href='<?=$root_url?>?#sec-contato'><b>contato</b></a> conosco." aria-label="Código do pedido">
                                               Quero pagar presencialmente
                                                </button>
                                                <div id="sympla-widget-<?=$EVENT_ID?>" class="sympla-widget <?=$widget_display?>" height="auto"></div> <script src="https://www.sympla.com.br/js/sympla.widget-pt.js/<?=$EVENT_ID?>"></script>
                                                <?php } ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if(!$hasPayment || $paymentStatus != 'A'){?>
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-12 col-sm-9">
                                        <div class="row">
                                            <div class="col-12 col-sm-10 form-group p-0 pr-3 m-0">
                                                <form id="verifyPayment">
                                                    <input id="code" name="codigoPedido" class="form-control" placeholder="Digite o código do seu pedido">
                                                </form>
                                            </div>
                                            <div class="col-3 col-sm-2 p-0">
                                                <button id="verifyPayment-btn" class="btn  btn-3d-primary w-100">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>

                                <div class="row mt-5 justify-content-center">
                                    <div class="col-12 col-sm-8">
                                        <div class="row">
                                            <div class="col-6 pl-0" >
                                                <button  onclick="scrollToDiv('#courses')" class=" w-100 h-100 btn btn-3d-secondary"><i class="fas fa-laptop-code"></i>Cursos</button>
                                            </div>
                                            <div class="col-6 pr-0">
                                                <button onclick="scrollToDiv('#shirts')" class=" w-100 h-100 btn btn-3d-secondary"><i class="fas fa-tshirt"></i>Camisas</button>
                                            </div>
                                        </div>
                                        <!-- lista de cursos e camisas 
                                        <div class="row mt-4">
                                            <ul class="p-0">
                                                <li>
                                                    Cursos inscritos:
                                                    <ul>
                                                        <li>curso 1 doisandhiosajdiojsadsa</li>
                                                        <li>curso 2 eiouwqeiouwqioeuwqioeu</li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    Camisa escolhida:
                                                    <ul>
                                                        <li>Camisa 1 eiuwqhgeuiwqhewq</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
  
            <div class="col-12 col-lg-6 h-75 d-flex justify-content-center align-items-center right-side">
                <div id="" class="row w-100 justify-content-center" style="max-width:unset;">
                    <div class="card info col-12 col-sm-9 col-lg-11 col-xl-10 p-5" style="max-width:unset;">
                        <form class="w-100" id="changeInfo" method="post">
                            <h2 class="mb-5 primary-color text-center">Informações pessoais</h2>
                            <div class="alert alert-success alert-dismissible mb-5">
                                <a href="#" class="close" aria-label="close">&times;</a>
                                    Informações alteradas com sucesso.
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <input class="form-control" required id="firstname" name="firstname" type="text" value="<?=$userInfo['firstName']?>">
                                        <label for="firstname" class="label-float translated-label">Nome</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <input class="form-control" required id="lastname" name="lastname" type="text" value="<?=$userInfo['lastName']?>">
                                        <label for="lastname" class="label-float translated-label">Sobrenome</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control" required id="email" name="email" type="email" value="<?=$userInfo['email']?>">
                                <label for="email" class="label-float translated-label">Email</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" maxlength="16"  pattern="[\(][0-9]{2}[\)] [0-9]{1} [0-9]{4}[\-][0-9]{4}" id="phone" name="phone" type="tel" value="<?=$userInfo['phone']?>">
                                <label for="phone"class="label-float <?php echo count($userInfo['phone']) > 0 ? 'translated-label':''?>">Telefone</label>
                            </div>
                            <div class="row m-0">
                                <input class="btn btn-3d-primary mr-3 changeInfo-btn" type="submit" value="Alterar informações">
                                
                                <button id="showModalChangePass" type="button" data-toggle="modal" data-target="#changePass-modal"  class="btn btn-3d-primary">Alterar senha</button>
                            </div>
                        </form>
                         <!-- Modal de requisitos de curso -->
                         <div class="modal fade" id="changePass-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Trocar senha</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="alert alert-success">Senha alterada com sucesso!</div>

                                            <div class="changePassBody">
                                                <div class="mb-4 alert alert-danger">Erro</div>
                                                <form id="changePass">

                                                    <div class="form-group">
                                                        <input required id="currentPass" name="currentPass" type="password" class="form-control">
                                                        <label class="label-float" for="currentPass">Senha atual</label>
                                                    </div>

                                                    <div class="form-group">
                                                        <input required id="newPass" name="newPass" type="password" class="form-control">
                                                        <label class="label-float" for="newPass">Nova senha</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input required id="newPass-confirm" name="newPass-confirm" type="password" class="form-control">
                                                        <label class="label-float" for="newPass-confirm">Confirmar senha</label>
                                                    </div>
                                                </form>
                                            </div>
                                           
                                        </div>
                                        <div class="modal-footer">
                                       
                                            <div class="btns-confirm">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="button" id="changePassBtn" class="btn btn-primary">Confirmar</button>
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
        </div>
    </section>
    <?php 
        $day = date('j', strtotime(COURSE_END))-1;
        $month = MONTHS[$month = date('m', strtotime(COURSE_END))];
    ?>
    <section id="courses" class="container-fluid">

        <?php if(!$paymentComplete){ ?>
        <div class="overlay">Após a confirmação de seu pagamento você poderá escolher 2 cursos bem legais!</div>
        <?php } ?>

        <div class="row h-100 align-items-center pt-5 pb-3 px-3">
            <div class="col-12 col-lg-3 light-color">
                <h1 class="sec-title light-color text-center">Escolha dois cursos incríveis!</h1>
                <p class="sec-text text-center">E não se preocupe, você pode alterar os cursos escolhidos até o dia <?=$day?> de <?=$month?></p>
                <div class="sec-text help">
                    Vagas alternativas
                    <button data-toggle="popover" data-placement="bottom" data-trigger="focus" data-content="As vagas alternativas são destinadas a participantes que possam levar seu próprio notebook para participarem dos minicursos." aria-label="Vagas alternativas">
                        <i class="far fa-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="courses-slider-container col-12 col-lg-9 pl-3 pt-3 h-75">
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
                            <p>Conhecimento necessário: <b>(Não se preocupe, é apenas desejável que conheça os seguintes temas, nada te impede de participar do minicurso)</b> </p>
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
                    <button data-toggle="modal" data-target="#course-confirm-modal" id="confirm-courses" class="btn btn-3d-primary">Confirmar</button>
                  

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

    <?php if(!$paymentComplete){ ?>
    <div class="overlay">Além de uma camisa muito bacana :D</div>
    <?php } ?>

        <div class="row h-100 align-items-center pt-5 pb-3 px-3">
            <div class="col-12 col-lg-3 light-color">
                <h1 class="sec-title light-color text-center">Escolha sua camisa :)</h1>
                <p class="sec-text text-center">Uma dessas camisas iradas é sua! Escolhe a que mais gostar, e manda ver. Lembrando que a camisa escolhida pode ser alterada até o dia <?=$day?> de <?=$month?>.</p>
                <div class="sec-text help">
                    Guia de tamanhos
                    <button onclick="window.open('../assets/imgs/shirt-sizes.jpg')">
                        <i class="far fa-question-circle"></i>
                    </button>
                </div>
            </div>
            <div class="shirt-slider-container col-12 col-lg-9 pl-3 h-75">
                <div id="shirt-slider" class="">

                </div>
                <div class="sec-btns">
                    <button data-toggle="modal" data-target="#shirt-confirm-modal" id="confirm-shirt" class="btn btn-3d-accent">Confirmar</button>

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