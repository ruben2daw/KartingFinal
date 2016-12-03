<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 03/12/2016
 * Time: 10:11
 */
class UserRolesDAO
{


    const _CLASS = "UserRoles";
    const _TABLE = "user_roles";
    const ID = "id";




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
        $array = array($id);
        $item = $ds->fetchToClass($sql, self::_CLASS, $array);
        $ds->close();

        return $item;

    }






}