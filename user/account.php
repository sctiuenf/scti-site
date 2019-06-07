<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';
require_once $root_dir_path.'/models/Shirt.php';
require_once $root_dir_path.'/models/Event.php';

if(!isset($_SESSION['logged'])){
    header('Location: http://localhost/scti/');
    die;
}else{
    $user = unserialize($_SESSION['user']);
    $userInfo = $user->getInfo();
}
?>
<main class="container-fluid">
    <div class="row h-100">
        <section class="col-4">
        
            <div class="row container-fluid payment-monitor h-50">
            <h1>Status do pagamento</h1>
                
                    <?php if(!$user->hasPayment()){ ?>
                    <div class="col-12">
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
                </div>   

                <div class="col-12">
                    <form id="verifyPayment" method="POST">
                        <div class="form-group">
                            <input required class="form-control" name="codigoPedido" type="text" placeholder="Código do pedido">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Confirmar">
                    </form>
                </div>
                <?php }else{ ?>
                    <div class="row container">Estado atual: <?=$status = $user->getPaymentStatus()?></div>
                <?php } ?>
            </div>
            <div class="row h-50">
            <div class="col-12">
                <h1>Perfil</h1>
                <ul>
                    <?php foreach($userInfo as $key => $value) {?>
                        <li><?=$key?>: <?=$value?></li>
                    <?php } ?>
                </ul>
            </div>
            </div>
        </section>
        
        <section class="col-8 <?php if($status !== 'placed') echo 'disabled'?>">
            <div class="row container-fluid h-50">
                <h1>Minicursos</h1>
                <div class="col-12 courses-carousel">
                <form method="post" id="chooseCourses">
                        <div class="form-group">
                            <label>Minicurso 1</label>
                            <select name="course1" class="form-control">
                            <option value="-1">Nenhum minicurso</option>
                            <?php 
                                $courses = Event::getCourseList();
                                foreach($courses as $course){
                            ?>
                                <option value="<?=$course['idEvento']?>"><?=$course['tituloEvento'].'  -------  '.$course['inicioEvento']?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input required name="c1-tipoInscricao" type="radio" value="padrao">Padrão
                            <input name="c1-tipoInscricao" type="radio" value="alternativa">Alternativa
                        </div>
                        <div class="form-group">
                            <label>Minicurso 2</label>
                            <select name="course2" class="form-control">
                            <option value="-1">Nenhum minicurso</option>
                            <?php 
                                $courses = Event::getCourseList();
                                foreach($courses as $course){
                            ?>
                                <option value="<?=$course['idEvento']?>"><?=$course['tituloEvento'].'  -------  '.$course['inicioEvento']?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input required name="c2-tipoInscricao" type="radio" value="padrao">Padrão
                            <input name="c2-tipoInscricao" type="radio" value="alternativa">Alternativa
                        </div>
                        <input class="btn btn-primary" type="submit" value="Escolher">
                    </form>
                </div>
            </div>
            <div class="row container-fluid h-50">
                <h1>Camisas</h1>
                <div class="col-12 shirts-carousel">
                    <form id="chooseShirt">
                        <div class="form-group">
                            <select name="shirt" required class="form-control">
                            <?php 
                                $shirts = Shirt::getShirtList();
                                foreach($shirts as $shirt){
                            ?>
                                <option value="<?=$shirt['tituloBrinde']?>"><?=$shirt['tituloBrinde']?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="shirt-size" required class="form-control" >
                                <option>PP</option>
                                <option>P</option>
                                <option>M</option>
                                <option>G</option>
                                <option>GG</option>
                            </select>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Escolher">
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="<?=$root_url?>/assets/js/requests/chooseRequests.js"></script>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>