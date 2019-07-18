<?php

require 'minus.php';


$array =  file("docs\accounts.sql", FILE_SKIP_EMPTY_LINES);

$desc = array();
$search = array();

foreach($array as $pos => $element){
    if($pos % 2 != 0){
        $var = $element;
        $posPr;
        $posUl;
        for($i = 5; $i > 0; $i--){
            $posPr = strpos($var, "'");
            $var = substr($var, $posPr + 1);
        }
        $var = strrev ($var);
        for($j = 7; $j > 0; $j--){
            $posUl = strpos($var, "'");
            $var = substr($var, $posUl + 1);
        }
        $var = strrev ($var);
        //$var1 = $var;
        //echo $var . '<br>';
        array_push($search, '/'.$var.'/');
        //var_dump($search);
        
        $var = formatWord($var);
        //echo $var . '<br>';
        array_push($desc, $var); 
        
        //$array = str_replace($var1, $var, $array);
    }
}


$array = preg_replace($search, $desc, $array);

foreach($array as $pos => $element){
    //echo $element . '<br>';
    echo $element . '<br>';
}











