<?php

require_once "Excel.php";

$hola = array(
    array('jose', 'juan'),
    array('pepe', 'manolo'),
    array('pepico', 'elena')
);

echo Excel::generate("Hola", $hola);