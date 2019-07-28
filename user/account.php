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

    $hasPayment = $user->hasPayment();

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
<button class="scroll-down">v</button>

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
                                                    <div class="<?=$statusColor?>">&nbsp;</div>
                                                    <span class="status-text"><?=$statusMessage?><span>
                                                </div>

                                                <?php if($paymentStatus != 'A'){?>
                                                <button onclick="updatePaymentStatus()" class="btn btn-refresh"><i class="fas fa-sync-alt"></i></button>
                                                <?php }?>

                                            <?php 
                                            $list_css = '';
                                            $widget_css = '';
                                            if($hasPayment && $paymentStatus == 'A'){ 
                                                $widget_display = 'hide';
                                            }else
                                                $list_display = 'hide';
                                            ?>
                                                <div class="list-group-container <?=$list_display?>">
                                                <ul class="list-group">
                                                    <li class="list-group-item active">Cursos escolhidos</li>
                                                    <?=$courses?>
                                                </ul>
                                                <ul class="list-group">
                                                    <li class="list-group-item active">Camisa escolhida</li>
                                                    <li class="list-group-item"><?=$shirt?></li>
                                                </ul>
                                                </div>
                                                    
                                         
                                                <div id="sympla-widget-539997" class="sympla-widget <?=$widget_display?>" height="auto""></div> <script src="https://www.sympla.com.br/js/sympla.widget-pt.js/539997"></script>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if(!$hasPayment || $paymentStatus != 'placed'){?>
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-12 col-sm-9">
                                        <div class="row">
                                            <div class="col-9 form-group p-0 m-0">
                                                <form id="verifyPayment">
                                                    <input id="code" name="codigoPedido" class="form-control">
                                                    <label for="code">Digite o código da sua inscrição</label>
                                                </form>
                                            </div>
                                            <div class="col-2">
                                                <button id="verifyPayment-btn" class="btn btn-3d">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>

                                <div class="row mt-5 justify-content-center">
                                    <div class="col-12 col-sm-8">
                                        <div class="row">
                                            <div class="col-6 pl-0" >
                                                <button onclick="scrollToDiv('#courses')" class="btn-3d w-100 h-100 btn"><i class="fas fa-book"></i>Cursos</button>
                                            </div>
                                            <div class="col-6 pr-0">
                                                <button onclick="scrollToDiv('#shirts')" class="btn-3d w-100 h-100 btn"><i class="fas fa-tshirt"></i>Camisas</button>
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
                <div class="row w-100 h-75 justify-content-center" style="max-width:unset;">
                    <div class="card col-12 col-sm-9 col-lg-11 col-xl-10 p-5" style="max-width:unset;">
                        <form class="w-100" id="change" method="post">
                        <h1 class="mb-5">Informações pessoais</h1>
                            <div class="row">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <input class="form-control" required name="firstname" type="text" value="<?=$userInfo['firstName']?>">
                                        <label class="translated-label">Nome</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
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
                                <input class="btn btn-3d mr-3" type="submit" value="Cadastrar">
                                <input class="btn btn-3d" type="submit" value="Alterar senha">
                            </div>
                            
                            
                        </form>
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
            <div class="col-12 col-lg-9 pl-3 pt-3 h-75">
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