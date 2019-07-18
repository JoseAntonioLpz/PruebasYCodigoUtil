<?php

/*
 * AUTHOR: Jose Antonio Lopez Lopez
 * GITHUB: https://github.com/JoseAntonioLpz
 */
class Uploader{

	private $file_name, $dir_name, $final_arr, $root, $response;

	function __construct($file_name = '', $dir_name = '', $root = ''){

		if($file_name !== ''){
			$this->file_name = $file_name;
		}else{
			$this->file_name = base64_encode(rand());
		}

		if($dir_name !== ''){
			$this->dir_name = $dir_name;
		}else{
			$this->dir_name = 'uploads';
		}
		$this->setFinalArr($_FILES);
		$this->root = $root;
		$this->response = array();
	}

	function save(){
		if($this->checkDir()){
			foreach ($this->final_arr as $key => $value) {
				$ext = $this->getExt($value['name']);
				$cont = '';
				if(count($this->final_arr) > 1){
					$cont = $key;
				}
				$res[] = move_uploaded_file($value['tmp_name'], $this->file_name . $cont . $ext);
			}
		}

		return $res;
	}

	static function upload($file_name = '', $dir_name = '', $root = ''){
		$u = new Uploader($file_name, $dir_name, $root);
		return $u->save();
	}

	private function setFinalArr($files){
		foreach ($files as $input => $fil) {
			foreach ($fil as $key => $value) {
				for ($i=0; $i < count($value); $i++) { 
					$this->final_arr[$i][$key] = $value[$i]; 
				}
			}
		}
		return $this->final_arr;
	}

	private function checkDir(){
		if($this->root != '') chdir($this->root);

		$r = false;

		if(!is_dir($this->dir_name)){
			$r = mkdir($this->dir_name, 0777, true);
			
		}

		$res = is_dir($this->dir_name);

		if($res) chdir($this->dir_name);
		
		return $res;
	}

	private function getExt($name){
		return strrchr($name, '.');
	}

}