<?php

class Video{

	static function getVideoData($video_path){
		$output = null;
		exec('ffprobe -i ' . $video_path . ' -v quiet -print_format json -show_format -show_streams -hide_banner' , $output);
		//var_dump(json_decode(implode($output)));
		return json_decode(implode($output)); // Return an object with Video´s information
	}

	static function createVideoFrame($video_path, $file_name, $end = false){
		//$duration = ($end) ? self::getVideoDuration($video_path) : null;
		if($end){
			//$duration = self::formatDuration($duration);
			//echo $duration . "<br>";
			//exec('ffmpeg -i ' . $video_path . ' -ss ' . $duration . ' -vframes 1 '. $file_name .' 2>&1', $out);
			exec('ffmpeg -sseof -3 -i '. $video_path .' -update 1 -q:v 1 '.  $file_name);

			/*foreach ($out as $value) {
				echo $value . "<br>";
			}*/
		}else{
			exec('ffmpeg -i ' . $video_path . ' -ss 00:00:00.000 -vframes 1 '. $file_name .' 2>&1'); // probar
		}
	}

	static function getVideoDuration($video_path){
		return self::getVideoData($video_path)->format->duration;
	}

	static function formatDuration($duration){
		$horas = floor($duration / 3600);
	    $minutos = floor(($duration - ($horas * 3600)) / 60);
	    $segundos = ($duration - ($horas * 3600) - ($minutos * 60));

	    $horas = ($horas < 10) ? "0" . $horas : $horas;
	    $minutos = ($minutos < 10) ? "0" . $minutos : $minutos;
	    $segundos = ($segundos < 10) ? "0" . $segundos : $segundos;

	    $res = $horas . ':' . $minutos . ":" . $segundos;

	   	$time = substr($res, 0 ,strrpos($res, '.'));
	   	 
	    $ms = substr($res, -1 * (strrpos(strrev($res), '.')));
	    $ms = (strlen($ms) < 3) ? $ms . "0" : $ms;

	    return $time . "." . $ms;
	}
}