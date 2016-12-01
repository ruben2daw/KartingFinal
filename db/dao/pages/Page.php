<?php

class Page {
    
    private $id;
    private $page;
    private $content;
    private $description;
    
    
    function getId(){
        return $this->id;    
    }
    
    function getPage(){
        return $this->page;    
    }
    
  
    
    function getContent(){
        return $this->content;    
    }
    
    function getDescription(){
        return $this->description;
    }
    
   
    
    function setId($id){
        $this->id = $id;    
    }
    
    function setPage($page){
        $this->page = $page;    
    }
    

    
    function setContent($content){
        $this->content = $content;    
    }
    
    function setDescription($desc){
        $this->description = $desc;
    }
    
 
}


?>