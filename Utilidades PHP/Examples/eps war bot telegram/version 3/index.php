<?php

require_once('class/DB.php');
require_once('class/Message.php');
require_once('class/Action.php');

$db = new DB();
$action = new Action($db);

$lived = $db->getLive();
$death = $db->getDeath();


//var_dump($lived);

//echo '<br><br><br>';

//var_dump($death);

//exit();

if(count($lived) <= 1){ // AQUI HAY QUE REINICIAR
	Message::sendMessage('REINICIO DE LA GUERRA');
	$db->reset();
	$db->deleteRegistro();
	$lived = $db->getLive();
	$death = $db->getDeath();
	//exit;
}

if($db->getCountRegistro() % 10 === 0){
	$action->events();
	exit;
}

$act = rand(1, 100);

switch ($act) {
	case 4:  
	case 15:
	case 36:
	case 78:
	case 85:
		if(count($death) === 0){
			$action->kill($lived);
		}else{
			$action->revive($death, $lived);
		}
		break;
	default:
		$action->kill($lived);
		break;
}

$lived = $db->getLive();

$msglived = 'Con vida: ' . PHP_EOL;

foreach ($lived as $key => $value) {
	$msglived .= $value->name . ' (' . $value->count . '), ';
}

$msglived = substr($msglived, 0, -2);

Message::sendMessage($msglived);