<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 30/11/2016
 * Time: 18:37
 */
class ReservesTypeDAO
{


    const _CLASS = "ReserveType";
    const _TABLE = "reserve_type";
    const ID = "id";
    const DESC = "description";




    /**
     * CONSULTAS GENERALES
     */

    public function getAll()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s ", self::_TABLE);
        $reserveTypeList = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $reserveTypeList;

    }


    public function getById($id)
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s=?", self::_TABLE, self::ID);
        $reserveType = array($id);
        $user = $ds->fetchToClass($sql, self::_CLASS, $reserveType);
        $ds->close();

        return $user;

    }




}