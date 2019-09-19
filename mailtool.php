<!DOCTYPE html>
<html>

<head>
	<meta name="robots" content="noindex">
	<meta charset="utf-8">
	<title>SCTI Mail Tool</title>
</head>

<?php 
require_once __DIR__.'/utils/root_url.php';
?>

<body>
	<form method="POST" action="<?= $root_url ?>/utils/sendMails.php">
		Autenticação<br />
		<input type="password" size="75"  name="key" />
		<br /><br />
		Assunto<br />
		<input type="text" name="subject" size="75" />
		<br /><br />
		Destinatários<br />
		<input type="radio" id="toAllInput" name="to" value="all" checked/>
		<label for="toAllInput">Todos</label><br />
		<input type="radio" id="toPendingInput" name="to" value="pending"/>
		<label for="toPendingInput">Pendentes</label><br />
		<input type="radio" id="toConfirmedInput" name="to" value="confirmed"/>
		<label for="toConfirmedInput">Confirmados</label>
		<br /><br />
		Corpo do email<br />
		<textarea cols="77" rows="15" name="body"></textarea>
		<br />
		<input type="submit" value="Enviar emails"/>
</body>
</form>

</html>