<?php


$array =  file("docs/normal.sql", FILE_SKIP_EMPTY_LINES);
$supl = array();

foreach($array as $pos => $element){
    $posPa = strrpos($element, ")");
    $var = substr($element, $posPa);
    $ini = substr($element, 0 ,strlen($element) - strlen($var));
    if($pos % 2 == 0){
        $ini = $ini . ', CREATIONUSER_C, CREATIONDATE_C, LASTUSER_C, LASTUPDATE_C' . $var;
        //echo $ini;
    }else{ 
        $ini = $ini . ", '', '', '', ''" . $var;
    }
    
    array_push($supl, $ini);
}


foreach($supl as $pos => $element){
    echo $element . '<br>';
}











