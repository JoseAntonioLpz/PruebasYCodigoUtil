<?php

require_once('class/DB.php');
require_once('class/Message.php');
require_once('class/Action.php');

$db = new DB();
$action = new Action($db);

$lived = $db->getLive();
$death = $db->getDeath();

if(count($lived) <= 1){
	exit;
}

$act = rand(1, 4);

switch ($act) {
	case 4:
		if(count($death) === 0){
			$action->kill($lived);
		}else{
			$action->revive($death);
		}
		break;
	default:
		$action->kill($lived);
		break;
}

$lived = $db->getLive();
$death = $db->getDeath();

$msglived = 'Con vida: ' . PHP_EOL;
$msgdeath = 'Muertos: ' . PHP_EOL;

foreach ($lived as $key => $value) {
	$msglived .= $value->name . PHP_EOL;
}

foreach ($death as $key => $value) {
	$msgdeath .= $value->name . PHP_EOL;
}

Message::sendMessage($msglived);

if(count($death) > 0){
	Message::sendMessage($msgdeath);
}

