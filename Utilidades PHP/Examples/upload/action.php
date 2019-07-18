<?php

include_once 'Uploader.php';

echo 'Subiendo archivo... <br>';

$uploader = new Uploader('file-' , 'francisco', '../../');

$uploader->save();

header('Location: http://localhost:8079/proyectos/pruebas/upload/');
exit;