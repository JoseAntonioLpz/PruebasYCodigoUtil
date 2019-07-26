<?php

require_once('class/DB.php');
require_once('class/Message.php');
//require_once('class/Action.php');

$db = new DB();

$resgistros = $db->getRegistro();

$msg = 'Registro de Muertes:' . PHP_EOL;
foreach ($resgistros as $key => $value) {
	$msg .= $value->accion . PHP_EOL;
}

Message::sendMessage($msg);

$lived = $db->getDeath();

$msgdeath = 'Muertos: ' . PHP_EOL;

foreach ($lived as $key => $value) {
	$msgdeath .= $value->name ', ';
}

$msgdeath = substr($msgdeath, 0, -2);

Message::sendMessage($msgdeath);