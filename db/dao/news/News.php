<?php

class News {
    
    private $id;
    private $title;
    private $created;
    private $content;

    function __toString(){
        $contingut =" 
        <ul>
            <li>Titulo:  \" . $this->title . \"</li>
            <li>Fecha: \" . $this->created . \"</li> 
            <li>Contenido: \" . $this->content . </li>
        <ul>";

        return $contingut;


    }

    function getId(){
        return $this->id;    
    }
    
    function getTitle(){
        return $this->title;    
    }
    
    function getCreated(){
        return $this->created;       
    }  
    
    function getContent(){
        return $this->content;    
    }
    

    
   

    function setId($id){
        $this->id = $id;    
    }
    

    function setTitle($title){
        $this->title = $title;       
    }
    
      function setCreated($created){
        $this->created = $created;       
    }

    
    function setContent($content){
        $this->content = $content;    
    }

  
    
 
}


?>