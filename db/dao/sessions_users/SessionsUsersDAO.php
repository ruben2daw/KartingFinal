<?php

class SessionsUsersDAO{
    
    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT * from session_users";
        $list = $ds->fetchAllToClass($sql,"SessionUser");
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT * from session_users where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"SessionUser",$params);
        $ds->close();
        
        return $obj;
        
    }
    
    
    public function getAllBySession($session){
        
        $ds = new DataSource();
        $sql = "SELECT * from session_users where session=?";
        $params = array($session);
        $list = $ds->fetchAllToClass($sql,"SessionUser",$params);
        $ds->close();
        
        return $list;
        
    }    



    public function insert($sessionUser){
        
        $ds = new DataSource();
        
        $sql = "insert into session_users (user,session,kart) 
                 values ( 
                    :user,
                    :session,
                    :kart)";
                
        $params = array(
                        ":user" => $sessionUser->getUser(),
                        ":session" => $sessionUser->getSession(),
                        ":kart" => $sessionUser->getKart()
                        );
        $result = $ds->execute($sql,$params); 
        $ds->close();
        
        return $result; 
        
    }
    
    
    public function update($sessionUser){
        
        $ds = new DataSource();
        
        $sql = "update session_users set
                user = :user,
                session_ = :session,
                kart=:kart 
                 where id=:id";
                
        $params = array(
                       ":user" => $sessionUser->getUser(),
                       ":session" => $sessionUser->getSession(),
                       ":kart" => $sessionUser->getKart(),
                       ":id" => $sessionUser->getId()
                        );
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result; 
        
    }
    
    
    public function delete($id){
        
        $ds = new DataSource();
        $sql = "delete from session_users where id = ?";
        $params = array($id);
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result;
        
    }
    
    
    
}


?>