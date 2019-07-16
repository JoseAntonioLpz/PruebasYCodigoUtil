<?php
/*
 * AUTHOR: Jose Antonio Lopez Lopez
 * GITHUB: https://github.com/JoseAntonioLpz
 */

class Search{
    
    private $currentList;
    private $currentRoute;
    private $currentDir;
    private $rec = array();
    private $finallyRoute;
    private $def;
    private $not_result = false;
    
    function __construct($def = ''){
        $this->def = $def;
    }
    
    private function search($file, $route){
        if($route === ""){
            $this->finallyRoute = $this->def;
            $this->not_result = true;
            return;
        }
        $this->currentList = scandir($route, 1);
        $this->currentList = $this->delete($this->currentList);
        $this->currentRoute = $route;
        $res = $this->searchFile($this->currentList, $file);

        if(is_dir($res)){
            array_push ($this->rec, $this->currentDir); 
            $this->search($file, $res);
        }elseif(is_bool($res)){
            if($res){
                $this->finallyRoute = $this->currentRoute . '/' . $file;
            }
        }elseif($res === 0){
            $res = substr($this->currentRoute, 0 , strrpos( $this->currentRoute, '/'));
            array_push ($this->rec, $this->currentDir); 
            $this->search($file, $res);
        }
    }
    
    private function searchFile($list, $file){
        $cont = 0;
        for($i = 0; $i < count($list); $i++){
            if($list[$i] == $file){
                return true;
            }
            if(count($list) === ($cont + 1)){
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
        foreach($list as $index => $value){
            foreach($this->rec as $val){
                if($value === $val){
                    $bool = true;
                }
            }
            if(is_dir($this->currentRoute . '/' . $value) && !$bool){
                $dir = $this->currentRoute . '/'. $value;
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
        $raz = getcwd();
        if(!empty($base)){
            if(!$this->comprobateDirectory($base)){
                chdir($base);
            }
            $route = explode('/', $route);
            $route = $route[count($route) - 1];

        }
        $this->search($file, $route);
        chdir($raz);
        return (!$this->not_result) ? $base . '/' . $this->finallyRoute : $this->finallyRoute;
    }

    private function comprobateDirectory($base){
        $dirAct = getcwd();
        return (strpos($dirAct, str_replace('/', '\\', $base))) ? true : false;
    }

    static public function getRouting($file, $route, $def = ''){
        $s = new Search($def);
        return $s->getRoute($file, $route);
    }   
}