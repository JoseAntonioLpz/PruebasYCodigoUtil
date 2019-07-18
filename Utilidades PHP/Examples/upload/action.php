<?php

include_once 'Uploader.php';

echo 'Subiendo archivo... <br>';

//$uploader = new Uploader();

//$uploader->save();

Uploader::upload('Francisco', 'pepe', '../');

header('Location: http://localhost:8079/proyectos/pruebas/upload/');
exit;