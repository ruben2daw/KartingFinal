<?php
/*TANDA O CARRERA*/
class Session{
    
    private $id;
    private $name;
    private $date;
    private $type;

    
    function getId(){
        return $this->id;    
    }
    
    function getName(){
        return $this->name;    
    }
    
    function getDate(){
        return $this->date;    
    }
    
    function getType(){
        return $this->type;    
    }
    
   
    
    
    function setId($id){
        $this->id = $id;    
    }
    
    function setName($name){
        $this->name = $name;    
    }
    
    function setDate($date){
        $this->date = $date;    
    }
    
    function setLastName($type){
        $this->type = $type;    
    }
    
  
}


?>