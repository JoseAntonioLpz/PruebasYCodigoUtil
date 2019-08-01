<?php

class DB{

	private $link;

	public function __construct(){
		$this->link = mysqli_connect("127.0.0.1", "root", "", "eps_war");
	}

	public function getLive(){
		$res = mysqli_query($this->link, 'SELECT * FROM people WHERE life = 1');

		$count = mysqli_query($this->link, 'SELECT COUNT(*) FROM muertes m where m.slasher = 1 ');	

		$lived = [];

		while ($row = $res->fetch_assoc()) { 
			$boy = new stdClass();
			$boy->id = $row["id"];
			$boy->name = $row["name"];
			$boy->life = $row["life"];
			
			$count = mysqli_query($this->link, 'SELECT count(*) FROM muertes m where m.slasher = ' . $boy->id);	
			$boy->count = $count->fetch_assoc()['count(*)'];

			$formas = mysqli_query($this->link, 'SELECT forma FROM formas m where m.people = ' . $boy->id);

			$fr = [];
			while ($r = $formas->fetch_assoc()) {
				$fr[] = $r['forma'];
			}

			$boy->formas = $fr;

			$lived[] = $boy;
		}

		return $lived; 
	}

	public function getDeath(){
		$res = mysqli_query($this->link, 'SELECT * FROM people WHERE life = 0');

		$death = [];

		while ($row = $res->fetch_assoc()) { 
			$boy = new stdClass();
			$boy->id = $row["id"];
			$boy->name = $row["name"];
			$boy->life = $row["life"];

			$count = mysqli_query($this->link, 'SELECT count(*) FROM ress m where m.ress = ' . $boy->id);	
			$boy->count = $count->fetch_assoc()['count(*)'];


			$death[] = $boy;
		}

		return $death; 
	}

	public function revive($boy){
		$res = mysqli_query($this->link, "update people set life = 1 where id = " . $boy->id);
	}

	public function kill($boy){
		$res = mysqli_query($this->link, "update people set life = 0 where id = " . $boy->id);
	}

	public function reset(){
		$res = mysqli_query($this->link, "update people set life = 1 where 1 = 1");
	}

	public function saveRegistro($msg){
		$res = mysqli_query($this->link, "INSERT INTO acciones(accion) VALUES ('" . $msg . "')");
	}

	public function deleteRegistro(){
		$res = mysqli_query($this->link, "TRUNCATE TABLE acciones");
	}

	public function getRegistro(){
		$res = mysqli_query($this->link, 'SELECT * FROM acciones');

		$acciones = [];

		while ($row = $res->fetch_assoc()) { 
			$accion = new stdClass();
			$accion->id = $row["id"];
			$accion->accion = $row["accion"];


			$acciones[] = $accion;
		}

		return $acciones;
	}

	public function getCountRegistro(){
		$res = mysqli_query($this->link, 'SELECT count(*) FROM acciones');

		$row = $res->fetch_assoc();
		$count = $row['count(*)'];

		return $count;
	}

	public function getCounters(){
		$res = mysqli_query($this->link, 'SELECT * FROM counters');

		$counters = [];

		while ($row = $res->fetch_assoc()) { 
			$counter = new stdClass();
			$counter->id = $row["id"];
			$counter->people1 = $row["people1"];
			$counter->people2 = $row["people2"];


			$counters[] = $counter;
		}

		return $counters;
	}

	public function getPeopleById($id){
		$res = mysqli_query($this->link, 'SELECT * FROM people WHERE id = ' . $id);

		$row = $res->fetch_assoc();

		$boy = new stdClass();
		$boy->id = $row["id"];
		$boy->name = $row["name"];
		$boy->life = $row["life"];

		$formas = mysqli_query($this->link, 'SELECT forma FROM formas m where m.people = ' . $id);

		$fr = [];
		while ($r = $formas->fetch_assoc()) {
			$fr[] = $r['forma'];
		}

		$boy->formas = $fr;

		return $boy;
	}

	public function getCountRes(){
		$res = mysqli_query($this->link, 'SELECT count(*) FROM people WHERE life = 1');

		$count = 0;

		while ($row = $res->fetch_assoc()) {
			$count = $row['count(*)'];
		}

		return $count;
	}

	function saveMuerte($slasher, $victim){
		//INSERT INTO `muertes`(`id`, `slasher`, `victim`) VALUES ([value-1],[value-2],[value-3])
		$res = mysqli_query($this->link, "INSERT INTO muertes  (slasher, victim) VALUES (" . $slasher . "," . $victim . ")");
	}

	function saveRess($ress){
		//INSERT INTO `ress`(`id`, `ress`) VALUES ([value-1],[value-2])
		$res = mysqli_query($this->link, "INSERT INTO ress(`ress`) VALUES (" . $ress . ")");
	}
}




//SELECT p.*, count(m.id) FROM people p INNER JOIN muertes m on p.id = m.slasher WHERE p.life = 1 AND p.id = m.slasher


//SELECT * FROM people p LEFT JOIN muertes m on p.id = m.slasher WHERE p.life = 1