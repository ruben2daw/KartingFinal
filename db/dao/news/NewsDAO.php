<?php

class NewsDAO{
    
    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT * from news";
        $list = $ds->fetchAllToClass($sql,"News");
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT * from news where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"News",$params);
        $ds->close();
        
        return $obj;
        
    }
    
     public function insert($news){
        
        $ds = new DataSource();
        
        $sql = "insert into news (title,content) 
                 values ( 
                    :title,
                    :content)";
                
        $params = array(
                        ":title" => $news->getTitle(),
                        ":content" => $news->getContent()
                        );
        $result = $ds->execute($sql,$params); 
        $ds->close();
        
        return $result; 
        
    }
 
    public function update($news){
        
        $ds = new DataSource();
        
        $sql = "update news set title = :title,content = :content where id=:id";
                
        $params = array(
                        ":title" => $news->getTitle(),
                        ":content" => $news->getContent(),
                        ":id" => $news->getId()
                        );
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result; 
        
    }
    
    
  public function delete($id){
        
        $ds = new DataSource();
        $sql = "delete from news where id = ?";
        $params = array($id);
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result;
        
    }
    
    
    
}


?>