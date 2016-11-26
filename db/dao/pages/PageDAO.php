<?php

class PageDAO{
    
    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT * from page_content";
        $list = $ds->fetchAllToClass($sql,"Page");
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT * from page_content where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"Page",$params);
        $ds->close();
        
        return $obj;
        
    }
    
    
    public function getByPage($page){
        
        $ds = new DataSource();
        $sql = "SELECT * from page_content where page=?";
        $params = array($page);
        $obj = $ds->fetchToClass($sql,"Page",$params);
        $ds->close();
        
        return $obj;
        
    }
    
    
    public function getOptionPage(){
        $pages=$this->getAll();
        $select=""; $selected=" ";
        foreach($pages as $page){
            $id=$page->getId();

            if(isset($_GET['id'])) {


                if ($id == $_GET['id'])
                    $selected = " selected";


            }

            $select.="<option value='".$page->getId()."' ".$selected.">".$page->getDescription()."</option>";
        }
        
        return $select;
    }
    
   
   
    public function update($page){
        
        $ds = new DataSource();
        
        $sql = "update page_content set 
                page = :page,
                content=:content/*, 
               / template=:template*/
                 where id=:id";
                
        $params = array(
                        ":page" => $page->getPage(),
                        ":content" => $page->getContent(),
                        //":template" => $page->getTemplate(),
                        ":id" => $page->getId()
                        );
        $result = $ds->execute($sql,$params);  
        $ds->close();
        
        return $result; 
        
    }
    
    
 
    
    
    
}


?>