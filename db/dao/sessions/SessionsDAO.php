<?php

class SessionsDAO{
    
    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT * from session";
        $list = $ds->fetchAllToClass($sql,"Session");
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT * from session where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"Session",$params);
        $ds->close();
        
        return $obj;
        
    }
    
    
    public function getByType($type){
        
        $ds = new DataSource();
        $sql = "SELECT * from session where type=?";
        $params = array($type);
        $list = $ds->fetchAllToClass($sql,"Session",$params);
        $ds->close();
        
        return $list;
        
    }    


    public function getByDate($lap){
        
        $ds = new DataSource();
        $sql = "SELECT * from session where user=?";
        $params = array($lap);
        $list = $ds->fetchAllToClass($sql,"Session",$params);
        $ds->close();
        
        return $list;
        
    }
  


    public function insert($session){
        
        $ds = new DataSource();

        $sql = "insert into session (name,date,type) 
                 values ( 
                    :name,
                    :date,
                    :type)";
                
        $params = array(
                        ":name" => $session->getName(),
                        ":date" => $session->getDate(),
                        ":type" => $session->getType()
                        );
        $result = $ds->execute($sql,$params); 
        $ds->close();
        
        return $result; 
        
    }
    
    
    public function update($session){
        
        $ds = new DataSource();

        $sql = "update session set 
                name = :name,
                date=:date, 
                type=:type
                 where id=:id";
                
        $params = array(
                        ":name" => $session->getName(),
                        ":date" => $session->getDate(),
                        ":type" => $session->getType(),
                        ":id" => $session->getId()
                        );
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result; 
        
    }


    
    public function delete($id){
        
        $ds = new DataSource();
        $sql = "delete from session where id = ?";
        $params = array($id);
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result;
        
    }
    
    
    
}


?>