<?php

class SessionUser{
    
    private $id;
    private $session;
    private $user;
    private $kart;

    
    function getId(){
        return $this->id;    
    }
    
    function getSession(){
        return $this->session;    
    }
    
    function getUser(){
        return $this->user;    
    }
    
    function getKart(){
        return $this->kart;    
    }
    
   
    
    function setId($id){
        $this->id = $id;    
    }
    
    function setSession($session){
        $this->session = $session;    
    }
    
    function setUser($user){
        $this->user = $user;    
    }
    
    function setKart($kart){
        $this->kart = $kart;    
    }
    
  
}


?>