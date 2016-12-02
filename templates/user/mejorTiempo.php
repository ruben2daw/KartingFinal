<?php
/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 25/11/2016
 * Time: 9:56
 */



//echo   $_SESSION['user'];
class MejorTiempo {
    public function bestTime()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT kt.type, sl.time
                       from kart_type as kt, session_laps as sl, karts as k, session_users as su, users as u where u.id=id ",
            self::_TABLE); //EL WHERE ESTA MAL!!
        $mejorTiempo = $ds->fetchAll($sql, self::_CLASS);
        $ds->close();

        return $mejorTiempo;

    }
}

?>

