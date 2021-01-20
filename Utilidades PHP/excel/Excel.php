<?php

class Excel{
    
    protected $data, $filename;
    
    public function __construct($filename, $data){
        $this->filename = $filename;
        $this->data = $data; //Array de dos dimensiones
        
    }
    
    public function get(){
        return self::generateExcel($filename, $data);
    }
    
    public static function generate($filename, $data){
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $res = '<table>';
        
        foreach($data as $d){
            $res .= '<tr>';
            
            foreach($d as $a){
                $res .= '<td>';
                $res .= $a;
                $res .= '</td>';
            }
            
            $res .= '</tr>';
        }
        
        $res .= '</table>';
        
        return $res;
    }
    
}