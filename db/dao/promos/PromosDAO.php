<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 17:24
 */
class PromosDAO
{

    const _CLASS = "Promo";
    const _TABLE = "promo";
    const ID = "id";

    const TEXT = "text";
    const IMG = "img";
    const VALID_FROM = "from_date";
    const VALID_TO = "to_date";


    /**
     * CONSULTAS GENERALES
     */

    public function getAll()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s ", self::_TABLE);
        $promoList = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $promoList;

    }


    public function getById($id)
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s=?", self::_TABLE, self::ID);
        $params = array($id);
        $user = $ds->fetchToClass($sql, self::_CLASS, $params);
        $ds->close();

        return $user;

    }


    /**
     * CRUD
     */

    public function insert($tableName)
    {

        $ds = new DataSource();

        $sql = sprintf("insert into %s (%s,%s,%s, %s) 
                 values ( 
                    :text,
                    :img,
                    :from,
                    :to
                                                                            
                     )", self::_TABLE, self::TEXT, self::IMG, self::VALID_FROM, self::VALID_TO);

        $params = array(
            ":text" => $tableName->getText(),
            ":img" => $tableName->getImg(),
            ":from" => $tableName->getFrom(),
            ":to" => $tableName->getTo()
        );

        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;
    }


    public function update($tableName){

        $ds = new DataSource();

        $sql = sprintf("update %s set 
                    text=:text,
                    img=:img,
                    from=:from,
                    to=:to   
                 where id=:id", self::_TABLE);

        $params = array(
            ":text" => $tableName->getText(),
            ":img" => $tableName->getImg(),
            ":from" => $tableName->getFrom(),
            ":to" => $tableName->getTo(),
            ":id" => $tableName->getId()
        );


        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;
    }

    public function delete($id)
    {

        $ds = new DataSource();
        $sql = sprintf("DELETE from %s where %s=?", self::_TABLE, self::ID);
        $params = array($id);
        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;

    }


}