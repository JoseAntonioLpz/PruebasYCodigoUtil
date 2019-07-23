<?php

$people = [ // CONECTAR A UN BD
	['Jose', 1],
	['Juanjo', 1],
	['Marcial', 1],
	['Pupu', 1],
	['Ara', 1],
	['Leti', 1],
	['Benitez', 1],
	['Rita', 1],
	['Marta', 1],
	['Ivan', 1],
	['Mauricio', 1],
	['Acentos', 1],
	['Perez', 1],
];


$life = getLife($people);

$attack = rand(0 , count($life) - 1);

do{
	$def = rand(0 , count($life) - 1);
}while ($attack === $def);

kill($people, $life, $attack, $def);

comprobateArr($people, $life);


function getLife($people){
	$life = [];
	foreach ($people as $key => $value) {
		if($value[1] === 1){
			$life[] = [$value[0], $key];
		}
	}
	return $life;
}

function comprobateArr($people, $life){
	$msg = '';
	foreach ($life as $key => $value) {
		$msg .= 'Con vida: ' . $value[0] . PHP_EOL;
	}

	return $msg;
}

function kill(&$people, &$life, $attack, $def){
	$people[$life[$def][1]][1] = 0;

	$atacante = $life[$attack][0];

	$defensor = $life[$def][0];

	unset($life[$def]);

	$msg = 'HOLA';

	if(count($life) > 1){
		$msg = $atacante . ' ha matado a ' . $defensor . ' Quedan: ' . count($life) . ' EPSers restantes';
	}else{
		$msg = $atacante . ' ha matado a ' . $defensor . ' ' . $atacante . ' ha conquistado el EPS';
	}

	sendMessage($msg);
}

function sendMessage($mensaje){

	$token = "903410626:AAHNQj1sZejA_ENOEZeYYX-3ABasr4NUxog";
	$id = "-1001364992090";
	$urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlMsg);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=" . urlencode($mensaje));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 
	$server_output = curl_exec($ch);
	curl_close($ch);

}

sendMessage(comprobateArr($people, $life));