<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 02/12/2016
 * Time: 12:56
 */
class SessionTypeDAO
{

    const _CLASS = "SessionType";
    const _TABLE = "session_type";
    const ID = "id";
    const TYPE = "type";




    /**
     * CONSULTAS GENERALES
     */

    public function getAll()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s ", self::_TABLE);
        $SessionTypeList = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $SessionTypeList;

    }


    public function getById($id)
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s=?", self::_TABLE, self::ID);
        $array = array($id);
        $sessionType = $ds->fetchToClass($sql, self::_CLASS, $array);
        $ds->close();

        return $sessionType;

    }



}