<?php

class Lap implements JsonSerializable
{
    
    private $id;
    private $session_user;
    private $lap_num;
    private $time;
 
 
    function __construct($session_user,$lap_num,$time){
        $this->session_user=$session_user;
        $this->lap_num=$lap_num;
        $this->time=$time;
        
    }
    
    function getId(){
        return $this->id;    
    }
    
    function setId($id){
        $this->id = $id;
    }

    function getSessionUser()
    {
        return $this->session_user;
    }
    
    function setSessionUser($session_user){
        $this->session_user = $session_user;
    }

    function getLapNum()
    {
        return $this->lap_num;
    }
    
    function setLapNum($lap_num){
        $this->lap_num = $lap_num;
    }

    function getTime()
    {
        return $this->time;
    }
    
    function setTime($time){
        $this->time = $time;       
    }
    
   /* 
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'session_user' => $this->session_user,
            'lap_num' => $this->lap_num,
            'time' => $this->time
            
        ];
    }
    */
    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'sesion_user' => $this->session_user,
            'lap_num' => $this->lap_num,
            'time' => $this->time


        ];
    }
}


?>