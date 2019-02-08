<?php

require 'classes/excel/reader.php';
require 'minus.php';

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read('docs/Maestro de Proveedores.xls');

$cadena = "INSERT INTO INVOICES.INVOICESELLER_T (code_k, invoicedebtor_k, name_c, status_c, vat_c, type_c) VALUES (";

$array = $data->sheets[0]['cells'];

for($i = 2; $i < count($array); $i++){
    //var_dump($array[$i]); 
    
    $type = ['PRO', 'AGE', 'NOT', 'GES'];
    
    $n = array_rand($type);
    
    $code = $array[$i]['1'];
    $name = $array[$i]['2'];
    
    $cadena2 = $cadena . "'" . $code . "','ESP','" . formatWord($name) . "','A','" . $code . "','" . $type[$n] . "'); <br>";
    
    /*$searchVal = array("Ñ", "á", "é","í", "ó", "ú");
    $replaceVal = array("n", "a", "e", "i", "o" , "u");
    str_replace($searchVal, $replaceVal, $cadena2);*/
    
    //echo utf8_decode($cadena2); 
    echo $cadena2; 
}