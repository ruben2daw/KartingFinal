<?php 

define ("ROOT",$_SERVER["DOCUMENT_ROOT"]);

class Config {
    
    //items de configuración
    static $items= array();
    
    
    /* recupera parámetro configuración */
    public static function get($key){
        
        self::load();
        
        if (!empty($key)){
            return self::$items[$key]; 
            
        }
        
        return false;
    }
    
    
    /* carga parámetros de configuración desde fichero */
    public static function load()
    {
        self::$items = include('conf.php');
        
    }
}

?>