<?php

class SessionsLapsDAO{
    
    public function getAll(){
        
        $ds = new DataSource();
        $sql = "SELECT * from session_laps";
        $list = $ds->fetchAllToClass($sql,"SessionLaps");
        $ds->close();
        
        return $list;
        
    }
    
    
    public function getById($id){
        
        $ds = new DataSource();
        $sql = "SELECT * from session_laps where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"SessionLaps",$params);
        $ds->close();
        
        return $obj;
        
    }

    public function getAllString(){
        $ds = new DataSource();
        $sql = "SELECT * from session_laps";
        $params = array();
        $sesionlaps = $ds->fetchAll($sql, $params);
        $ds->close();
        $select="";
        for($i=0; $i<count($sesionlaps); $i++){
                echo "campo1->".$sesionlaps[$i][0].
                ", campo2->". $sesionlaps[$i][1].
            ", campo3->". $sesionlaps[$i][2].
            ", campo4->". $sesionlaps[$i][3]."\n\n";
        }


    }

    public function getBestTimes(){
        $ds = new DataSource();
        $sql = "SELECT  time FROM session_laps GROUP BY time ORDER BY time ASC LIMIT 3";
        $params = array();
        $sesionlaps = $ds->fetchAll($sql, $params);
        $ds->close();
        $select="";
        for($i=0; $i<count($sesionlaps); $i++){
            echo "campo1->".$sesionlaps[$i][0].
               "\n\n";
        }


    }

    public function getBestTimesMothPerCategory(){
        $ds = new DataSource();
        $sql = "SELECT  time FROM session_laps GROUP BY time ORDER BY time ASC LIMIT 3";
        $params = array();
        $sesionlaps = $ds->fetchAll($sql, $params);
        $ds->close();
        $select="";
        for($i=0; $i<count($sesionlaps); $i++){
            echo "campo1->".$sesionlaps[$i][0].
                "\n\n";
        }


    }


    
    
}


?>