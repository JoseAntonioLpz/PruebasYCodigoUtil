<?php
/*
 * AUTHOR: Jose Antonio Lopez Lopez
 * GITHUB: https://github.com/JoseAntonioLpz
 */

Class Ramdonizer{
    
    private $exit;
    private $char;
    private $lenght;

    function __construct($lenght = 8, $char = 'abcdefghijklmnopqrstuvwxyz1234567890'){
        $this->char = $char;
        $this->lenght = $lenght;
    }

    private function generateRandomStr(){
    	$this->exit = substr(str_shuffle(str_repeat($this->char, 5)), 0, $this->lenght);

    	return $this->exit;
    }

    function get(){
    	return $this->generateRandomStr();
    }

    function setChar($char){
    	$this->char = $char;
    }

    function setLenght($lenght){
    	$this->lenght = $lenght;
    }

}
