<?php

require_once('DB.php');
require_once('Message.php');

class Action{
		
	private $db;
		
	public function __construct($db){
		$this->db = $db;

	}

	public function kill($list){
		$attack = rand(0 , count($list) - 1);
		do{
			$def = rand(0 , count($list) - 1);
		}while ($attack === $def);

		//var_dump($list[$def]);

		$this->db->kill($list[$def]);

		echo '<br><br><br>';
		//var_dump();

		$msg = $list[$attack]->name . ' ' . $list[$attack]->formas[rand(0, count($list[$attack]->formas) - 1)] . ' ' . $list[$def]->name . PHP_EOL; 

		$this->db->saveMuerte($list[$attack]->id, $list[$def]->id);
		$this->db->saveRegistro($msg);

		if($this->db->getCountRes() > 1){
			$msg .= 'Quedan ' . $this->db->getCountRes() . ' restantes';
		}else{
			$msg .= $list[$attack]->name . ' ha conquistado el EPS';
		}

		Message::sendMessage($msg);

	}

	public function revive($list, $lived){

		$possible = [];
		foreach ($list as $key => $value) {
			if($value->count === '0'){
				$possible[] = $value;
			}
		}

		//var_dump($possible);

		if(count($possible) > 0){
			$revive = rand(0 , count($possible) - 1);
		

			$this->db->revive($list[$revive]);

			$msg = $list[$revive]->name . ' ha resucitado y esta listo para volver al ruedo.' . PHP_EOL . 'Quedan ' . $this->db->getCountRes() . ' restantes';

			$this->db->saveRess($list[$revive]->id);
			$this->db->saveRegistro($msg);

			Message::sendMessage($msg);
		}else{
			$this->kill($lived);
		}
	}

	public function events(){
		$lived = $this->db->getLive(); //getCounters
		$deaths = $this->db->getDeath();
		$counters = $this->db->getCounters();

		$rand = rand(0,1);

		switch ($rand) {
			case 0:	// VALLHALA
				if(!is_null($deaths) && count($deaths) > 3){
					$this->vallhala($deaths);
				}else{
					$this->sedSangre($lived, $counters);
				}	
				break;
			case 1: // SED DE SANGRE
				$this->sedSangre($lived, $counters);
				break;
		}
	}

	private function sedSangre($lived, $counters){
		$numRand = rand(0, count($counters) - 1);

		$event = false;
		foreach ($counters as $key => $value) {

			$p1 = $this->countersLived($lived, $value->people1);
			$p2 = $this->countersLived($lived, $value->people2);

			if($p1 && $p2){
				$win = rand(0, 1);
				if($win === 0){
					$attack = $this->db->getPeopleById($value->people1);
					$def = $this->db->getPeopleById($value->people2);
				}else{
					$attack = $this->db->getPeopleById($value->people2);
					$def = $this->db->getPeopleById($value->people1);
				}

				$this->db->kill($def);
				$msg = 'EVENTO SED DE SANGRE: ' . PHP_EOL . '2 antiguos enemigos se han reencontrado y han empezado a luchar con fiereza.' . PHP_EOL;
				$msg .= $attack->name . ' ' . $attack->formas[rand(0, count($attack->formas) - 1)] . ' ' . $def->name . PHP_EOL; 

				$this->db->saveMuerte($attack->id, $def->id);
				$this->db->saveRegistro($msg);

				Message::sendMessage($msg);

				$event = true;
				break;
			}
		}

		if(!$event){
			$this->kill($lived);
		}
	}

	private function countersLived($lived, $counter){
		$p = false;
		foreach ($lived as $key => $value) {
			if($value->id === $counter){
				$p = true;
				break;
			}
		}

		return $p;
	}

	private function vallhala($death){
		$listRev = [];
		$cont = 0;
		$msg = 'EVENTO: Vallhala' . PHP_EOL . 'La diosa ha revivido a:' . PHP_EOL;
		foreach ($death as $key => $value) {
			$rand = rand(0, count($death) - 1);

			if(!in_array($value, $listRev)){
				$listRev[] = $value;
				$cont++;
			}

			if($cont === 3){
				break;
			} 
		}

		foreach ($listRev as $key => $value) {
			$this->db->revive($value);
			$msg .= $value->name . ', ';
		}

		$msg = substr($msg, 0, -2);
		$this->db->saveRegistro($msg);
		Message::sendMessage($msg);
	}
}
