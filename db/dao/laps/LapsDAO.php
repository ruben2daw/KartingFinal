<?php

class LapsDAO{
    
    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT * from laps";
        $list = $ds->fetchAllToClass($sql,"Lap");
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT * from laps where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"Lap",$params);
        $ds->close();
        
        return $obj;
        
    }
    
    
    public function getBySession($session){
        
        $ds = new DataSource();
        $sql = "SELECT * from laps where session=?";
        $params = array($session);
        $list = $ds->fetchAllToClass($sql,"Lap",$params);
        $ds->close();
        
        return $list;
        
    }    


    public function getByUser($lap){
        
        $ds = new DataSource();
        $sql = "SELECT * from laps where user=?";
        $params = array($lap);
        $list = $ds->fetchAllToClass($sql,"Lap",$params);
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getBySessionUser($session,$user){
        
        $ds = new DataSource();
        $sql = "SELECT * from laps where session=? and user=?";
        $params = array($session,$user);
        $list = $ds->fetchAllToClass($sql,"Lap",$params);
        $ds->close();
        
        return $list;
        
    }
    


    public function insert($lap){
        
        $ds = new DataSource();
        
        $sql = "insert into laps (session_user,kart,lap_num,time) 
                 values ( 
                    :session_user,
                    :kart,
                    :lap_num, 
                    :time)";
                
        $params = array(
                        ":session_user" => $lap->getSessionUser(),
                        ":kart" => $lap->getKart(),
                        ":lap_num" => $lap->getLapNum(),
                        ":time" => $lap->getTime()
                        );
        $result = $ds->execute($sql,$params); 
        $ds->close();
        
        return $result; 
        
    }
    
    
    public function update($lap){
        
        $ds = new DataSource();
        
        $sql = "update laps set 
                session_user = :session_user,
                kart=:kart, 
                lap_num=:lap_num,
                time=:time where id=:id";
                
        $params = array(
                       ":session_user" => $lap->getSessionUser(),
                        ":kart" => $lap->getKart(),
                        ":lap_num" => $lap->getLapNum(),
                        ":time" => $lap->getTime(),
                        ":id" => $lap->getId()
                        );
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result; 
        
    }
    
    
    public function delete($id){
        
        $ds = new DataSource();
        $sql = "delete from laps where id = ?";
        $params = array($id);
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result;
        
    }
    
    
    
}


?>