<?php

namespace MentelistaApp\Http\Controllers\Classes;

/*
 * AUTHOR: Jose Antonio Lopez Lopez
 * GITHUB: https://github.com/JoseAntonioLpz
 */

class Search{
    
    //scandir(string $directory [, int $sorting_order = SCANDIR_SORT_ASCENDING [, resource $context ]] ) : array 
    // - Lista todos los archivos y directorios de una ruta especifica
    
    //opendir() - Abre un gestor de directorio
    //readdir() - Lee una entrada desde un gestor de directorio
    //is_dir() - Indica si el nombre de archivo es un directorio
    
    //private $directory;
    //private $nextList;
    //private $continue;
    private $currentList;
    //private $route;
    private $currentRoute;
    private $currentDir;
    private $rec = array();
    private $finallyRoute;
    private $def;
    private $not_result = false;
    
    function __construct(/*$directory = "assets",*/ $def = ''){
        //$this->directory = $directory;
        //$this->route = $directory . '/';
        $this->def = $def;
        //$rec = array($directory);
    }
    
    private function search($file, $route){
        //var_dump($route);
        if($route === ""){
            $this->finallyRoute = $this->def;
            $this->not_result = true;
            //echo 'dentro';
            return;
        }
        $this->currentList = scandir($route, 1);
        $this->currentList = $this->delete($this->currentList);
        //echo "<br> RUTA ACTUAL: " . $route . "<br>";
        $this->currentRoute = $route;
        //var_dump($this->currentList);
        $res = $this->searchFile($this->currentList, $file);

        if(is_dir($res)){
            //var_dump($this->currentList);
            array_push ($this->rec, $this->currentDir); 
            $this->search($file, $res);
            //return;
        }elseif(is_bool($res)){
            if($res){
                //echo 'TRUE';
                $this->finallyRoute = $this->currentRoute . '/' . $file;
            }
            //return $res;
        }elseif($res === 0){
            $res = substr($this->currentRoute, 0 , strrpos( $this->currentRoute, '/'));
            array_push ($this->rec, $this->currentDir); 
            $this->search($file, $res);
        }
    }
    
    private function searchFile($list, $file){
        $cont = 0;
        //var_dump($list);
        //echo '<br> dentro <br>';
        for($i = 0; $i < count($list); $i++){
            //echo $cont;
            if($list[$i] == $file){
                return true;
            }
            if(count($list) === ($cont + 1)){
                //echo 'dentro2';
                $this->nextList = $this->getFirstDir($list);
                return ($this->nextList === null) ? 0 : $this->nextList;
            }
            $cont++;    
        }

        return 0;
    }
    
    private function getFirstDir($list){
        $dir = null;
        $bool = false;
        //echo '<br>';
        //var_dump($this->rec);
        foreach($list as $index => $value){
            foreach($this->rec as $val){
                if($value === $val){
                    $bool = true;
                }
            }
            if(is_dir($this->currentRoute . '/' . $value) && !$bool){
                //echo "<br>DIRECTORIO SIGUIENTE" . $value . "<br>";
                $dir = $this->currentRoute . '/'. $value;
                //unset($list[$index]);
                $this->currentList = $list;
                $this->currentDir = $value;
                break;
            }
            $bool = false;
        }
        return $dir;
    }
    
    private function delete($list){
        foreach($list as $index => $value){
            if($value === '.' || $value === '..'){
                unset($list[$index]);
            }
        }
        return $list;
    }
    
    public function getRoute($file, $route){
        $base = substr($route, 0 , strrpos( $route, '/'));
//dump($base);
        if(!empty($base)){
//dump(getcwd());
//dump($base);

//dump($this->comprobateDirectory($base));
            //try{
            if(!$this->comprobateDirectory($base)){
                chdir($base);
            }
                
            //}
            //}catch(\Exception $e){

            //}
            
        
            //$route = strrev($route);
            //echo $route . '<br>';
            //$route = substr($route, 0 , strrpos( $route, '/'));
            //echo $route. '<br>';
            //$route = strrev($route);
            //echo $route. '<br>';
            $route = explode('/', $route);
            $route = $route[count($route) - 1];

        }
        //var_dump($base);
        $this->search($file, $route);
        return (!$this->not_result) ? $base . '/' . $this->finallyRoute : $this->finallyRoute;
    }

    private function comprobateDirectory($base){
        $dirAct = getcwd();
        return (strpos($dirAct, str_replace('/', '\\', $base))) ? true : false;
    }   
}