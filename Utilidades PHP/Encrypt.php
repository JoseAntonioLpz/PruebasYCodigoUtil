<?php

class Encrypt{

	private $supp, $it;

	private static $object = null;

	private function __construct($supp, $it){
		$this->supp = $supp;
		$this->it = $it;
	}

	public static function getObject($supp = '', $it = 5){
		if(self::$object === null){
			self::$object = new Encrypt($supp, $it);
		}

		return self::$object;
	}

	public static function deleteObject(){
		self::$object = null;
	}

	public function encode($word){
		$fin = $this->supp . '/@/' . $word . '/@/' . $this->supp;
		$fin = base64_encode($fin);
		for ($i=0; $i < $this->it; $i++) { 
			$rand = rand(0,2);
			switch ($rand) {
				case 0:
					$fin = $this->supp . '/@/' . base64_encode($fin) . 0;
					break;
				case 1:
					$fin = $this->supp . '/@/' . convert_uuencode($fin) . 1;
					break;
				case 2:
					$fin = $this->supp . '/@/' . strrev($fin) . 2;
					break;	
			}
		}

		$fin = strrev($fin);

		return convert_uuencode($fin);
	}

	public function decode($word){
		$fin = convert_uudecode($word);
		$fin = strrev($fin);

		for ($i=0; $i < $this->it; $i++) { -
			$num = substr($fin, -1);
			$fin = str_replace ([$this->supp . '/@/'], '', $fin);
			switch ($num) {
				case '0':
					$fin = base64_decode(substr($fin, 0, -1));
					break;
				case '1':
					$fin = convert_uudecode(substr($fin, 0, -1));
					break;
				case '2':
					$fin = strrev(substr($fin, 0, -1));
					break;	
			}
		}

		$fin = base64_decode($fin);
		$fin = str_replace ([$this->supp . '/@/', '/@/' . $this->supp ], '', $fin);
		return $fin;
	}
}