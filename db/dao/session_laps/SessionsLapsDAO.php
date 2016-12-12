<?php

class SessionsLapsDAO
{

    public function getAll()
    {

        $ds = new DataSource();
        $sql = "SELECT * from session_laps";
        $list = $ds->fetchAllToClass($sql, "SessionLaps");
        $ds->close();

        return $list;

    }


    public function getById($id)
    {

        $ds = new DataSource();
        $sql = "SELECT * from session_laps where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql, "SessionLaps", $params);
        $ds->close();

        return $obj;

    }

    public function getAllString()
    {
        $ds = new DataSource();
        $sql = "SELECT * from session_laps";
        $params = array();
        $sesionlaps = $ds->fetchAll($sql, $params);
        $ds->close();
        $select = "";
        for ($i = 0; $i < count($sesionlaps); $i++) {
            echo "campo1->" . $sesionlaps[$i][0] .
                ", campo2->" . $sesionlaps[$i][1] .
                ", campo3->" . $sesionlaps[$i][2] .
                ", campo4->" . $sesionlaps[$i][3] . "\n\n";
        }


    }

    public function getBestTimes()
    {
        $ds = new DataSource();
        $sql = "SELECT  time FROM session_laps GROUP BY time ORDER BY time ASC LIMIT 3";
        $params = array();
        $sesionlaps = $ds->fetchAll($sql, $params);
        $ds->close();
        $select = "";
        for ($i = 0; $i < count($sesionlaps); $i++) {
            echo "campo1->" . $sesionlaps[$i][0] .
                "\n\n";
        }


    }

    public function getBestTimesMothPerCategory()
    {
        $ds = new DataSource();
        $sql = "SELECT  time FROM session_laps GROUP BY time ORDER BY time ASC LIMIT 3";
        $params = array();
        $sesionlaps = $ds->fetchAll($sql, $params);
        $ds->close();
        $select = "";
        for ($i = 0; $i < count($sesionlaps); $i++) {
            echo "campo1->" . $sesionlaps[$i][0] .
                "\n\n";
        }


    }


    public function getBestTimesPerKart($id)
    {
        $ds = new DataSource();


        $subconsulta = "SELECT sl.time , u.login, kt.type 
        From 
        session_laps sl
        inner join
        session_users su
        on sl.session_user = su.id
        inner join
        karts k
        on su.kart = k.id
        inner join 
        kart_type kt
        on k.type = kt.id		
        inner join 
        users u
        on (su.user = u.id)
	    WHERE kt.id=? 
	    ORDER BY sl.time asc LIMIT 3;";



    $params = array($id);
    $queryFields = $ds->fetchAll($subconsulta, $params);
    $ds->close();





        $html = '<table  class="table">';
        $html .= '<tr>';
        for ($a = 0; $a < count($queryFields); $a++) {
            $html .= '<th>' .  $queryFields[$a][0] . '</th>';
            $html .= '<th>' .  $queryFields[$a][1] . '</th>';
            $html .= '<th>' .  $queryFields[$a][2] . '</th>';

        }
        $html .= '</tr>';
        $html .= '</table>';

        echo $html;

        }




    public function getBestTimesPerUser($id_user, $id_kart)
    {
        $ds = new DataSource();

        $subconsulta = "SELECT sl.time , u.login, kt.type 
        From 
        session_laps sl
        inner join
        session_users su
        on sl.session_user = su.id
        inner join
        karts k
        on su.kart = k.id
        inner join 
        kart_type kt
        on k.type = kt.id		
        inner join 
        users u
        on (su.user = u.id)
	    WHERE u.id=? and kt.id=? 
	    ORDER BY sl.time asc LIMIT 1 ;";



        $params = array($id_user, $id_kart);
        $queryFields = $ds->fetchAll($subconsulta, $params);
        $ds->close();







        $html = '<table  class="table-condensed">';
        $html .= '<tr>';
        for ($a = 0; $a < count($queryFields); $a++) {
            $html .= '<th>' .  $queryFields[$a][0] . '</th>'.'';
            $html .= '<th>' .  $queryFields[$a][1] . '</th>'.'';
            $html .= '<th>' .  $queryFields[$a][2] . '</th>'.'';

        }
        $html .= '</tr>';
        $html .= '</table>';

        return $html;
    }

}


?>