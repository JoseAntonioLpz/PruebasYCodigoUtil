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

		$msg = $list[$attack]->name . ' ' . $list[$attack]->killer . ' ' . $list[$def]->name . PHP_EOL; 

		if($this->db->getCountRes() > 1){
			$msg .= 'Quedan ' . $this->db->getCountRes() . ' restantes';
		}else{
			$msg .= $list[$attack]->name . ' ha conquistado el EPS';
		}

		Message::sendMessage($msg);

	}

	public function revive($list){
		$revive = rand(0 , count($list) - 1);
		

		$this->db->revive($list[$revive]);

		$msg = $list[$revive]->name . ' ha resucitado y esta listo para volver al ruedo.' . PHP_EOL . 'Quedan ' . $this->db->getCountRes() . ' restantes';

		Message::sendMessage($msg);
	}

}