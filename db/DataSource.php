<?php

class DataSource{
    
    private $connection;
    
    function __construct(){
        
        try {
            $this->connection = new PDO("mysql:host=".Config::get("db_host").";dbname=".Config::get("db_name"),/*Config::get("db_user")*/"root", Config::get("db_pass"));
            $this->query("set names 'utf8'");
        }
        catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    
    function getConnection(){
        return $this->connection;
    }
    
    
    function query($sql)
    {
        return $this->connection->query($sql);
    }
    
    
    function exec($sql){
        return $this->connection->exec($sql);
    }
    
    
    function fetchAll($sql,$values=array()){
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($values);
        $list = $stmt->fetchAll();
        
        return $list;
    }
    
    
    function fetch($sql,$values=array()){
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($values);
        $result = $stmt->fetch();
        
        return $result;
    }
    
    
    function fetchAllToClass($sql,$class,$values=array()){
        
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        $stmt->execute($values);
        $list = $stmt->fetchAll();
        
        return $list;
    }
    
    
    function fetchToClass($sql,$class,$values=array()){
        
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        $stmt->execute($values);
        $result = $stmt->fetch();
        
        return $result;
    }
    
    
    function execute($sql,$values=array()){
    
        $stmt = $this->connection->prepare($sql);
        $res=$stmt->execute($values);
        $err=$stmt->errorInfo();
        print_r($err);
        return $res;
        
    }
    
    
    function close(){
        $this->connection=null;
    }
    
}


?>