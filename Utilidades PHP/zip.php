<?php

function create_zip($ruta = '', $nombre = '', $archivos = []){
 
	$zip = new ZipArchive(); 
	 
	$filename = $ruta . '/' . $nombre; // Creo la ruta de mi zip
	$r = false;

	if($zip->open($filename,ZIPARCHIVE::CREATE) === true) {
			foreach ($archivos as $archivo) {
				$zip->addFile($archivo); // $archivo es un STRING con la ruta del archivo
			}
	        $zip->close(); 
	        $r = $filename; // Cuando todo acabe retorno la ruta del ZIP
	}
 	return $r;
}