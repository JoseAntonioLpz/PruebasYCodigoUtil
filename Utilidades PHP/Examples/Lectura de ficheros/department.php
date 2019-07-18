<?php

require 'classes/excel/reader.php';
require 'minus.php';

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read('docs/Mestro_departamentos.xls');

$cadena = "INSERT INTO INVOICES.DEPARTMENT_T (DEPARTMENT_C, NAME_C, STATUS_C, PROJECT_C, INVOICEDEBTOR_K) VALUES(";


$array = $data->sheets[0]['cells'];

for($i = 2; $i < count($array); $i++){
    
    
    
    $code = $array[$i]['2'];
    $project = $array[$i]['1'];
    $name = $array[$i]['3'];
    
    $cadena2 = $cadena . ($i - 1) . ", '" . formatWord($name) . "', 'A', '" . $project . "', 'CYC'); <br>";

    /*$searchVal = array("Ñ", "á", "é","í", "ó", "ú");
    $replaceVal = array("n", "a", "e", "i", "o" , "u");
    str_replace($searchVal, $replaceVal, $cadena2);*/
    
    //echo utf8_decode($cadena2); 
    echo $cadena2; 
}