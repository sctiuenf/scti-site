<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';
if(!isset($_SESSION['logged'])){
    header('Location: http://localhost/scti/');
    die;
}else{
    $user = unserialize($_SESSION['user']);
    $userInfo = $user->getInfo();
}
?>
<main class="container-fluid h-auto">
    <div class="row h-75">
        <section class="col-6">
            <h1>Status do pagamento</h1>
            <div class="row container-fluid payment-monitor">
                <div class="col-12">
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
                    <div class="row">Estado atual: <?=$user->getPaymentStatus()?></div>
                <?php } ?>
            </div>
        </section>
        <section class="col-6">
            <h1>Perfil</h1>
            <ul>
                <?php foreach($userInfo as $key => $value) {?>
                    <li><?=$key?>: <?=$value?></li>
                <?php } ?>
            </ul>
        </section>
    </div>

    <div class="row h-auto">
        <section class="col-12">
            <h1>Minicursos e camisas</h1>
        </section>
    </div>
</main>

<?php require_once $root_dir_path.'/views/partials/footer.php' ?>