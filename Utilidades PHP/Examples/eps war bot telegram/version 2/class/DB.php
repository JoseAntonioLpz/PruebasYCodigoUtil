<?php

class DB{

	private $link;

	public function __construct(){
		$this->link = mysqli_connect("127.0.0.1", "root", "", "war");
	}

	public function getLive(){
		$res = mysqli_query($this->link, 'SELECT * FROM people WHERE life = 1');

		$lived = [];

		while ($row = $res->fetch_assoc()) { 
			$boy = new stdClass();
			$boy->id = $row["id"];
			$boy->name = $row["name"];
			$boy->life = $row["life"];
			$boy->killer = $row["killer"];
			$boy->sex = $row["sex"];
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
			$boy->killer = $row["killer"];
			$boy->sex = $row["sex"];
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

	public function getCountRes(){
		$res = mysqli_query($this->link, 'SELECT count(*) FROM people WHERE life = 1');

		$count = 0;

		while ($row = $res->fetch_assoc()) {
			$count = $row['count(*)'];
		}

		return $count;
	}
}