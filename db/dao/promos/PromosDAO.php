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
    const VALID_FROM = "valid_from";
    const VALID_TO = "valid_to";


    /**
     * CONSULTAS GENERALES
     */

    public function getAll()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s ", self::_TABLE);
        $promolist = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $promolist;

    }


    public function getById($id)
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s=?", self::_TABLE, self::ID);
        $params = array($id);
        $tableName = $ds->fetchToClass($sql, self::_CLASS, $params);
        $ds->close();

        return $tableName;

    }


    /**
     * CRUD
     */
   /* public function getAllForAdmin(){
        $ds = new DataSource();
        $sql = "SELECT id,type,desc,img_path from kart_type";
        $kartList = $ds->fetchAllToClass($sql,"KartType", $params);
        $ds->close();

        return $kartList;


    } ESTO ES DE KART_TYPE!!*/
    public function updateForAdmin($tableName){

        $ds = new DataSource();

        $sql = "update promo set 
                text=:text,
                img=:img,
                from=:from, 
                to=:to where id=:id";


        $params = array(
            ":login" => $tableName->getText(),
            ":password" => $tableName->getImg(),
            ":email" => $tableName->getFrom(),
            ":firstname" => $tableName->getTo(),
            ":id" => $tableName->getId()
        );
        $result = $ds->execute($sql,$params);
        $ds->close();

        return $result;

    }
    public function getByIdForAdmin($id){

        $ds = new DataSource();
        $sql = "SELECT id,type,desc, img_path from kart_type";
        $params = array($id);
        $promo = $ds->fetchToClass($sql,"KartType",$params);
        $ds->close();

        return $promo;

    }


    public function insert($tableName)
    {

        $ds = new DataSource();

        $sql = sprintf("insert into %s (%s,%s,%s, %s) 
                 values ( 
                    :text,
                    :img,
                    :valid_from,
                    :valid_to
                                                                            
                     )", self::_TABLE, self::TEXT, self::IMG, self::VALID_FROM, self::VALID_TO);

        $params = array(
            ":text" => $tableName->getText(),
            ":img" => $tableName->getImg(),
            ":valid_from" => $tableName->getValidFrom(),
            ":valid_to" => $tableName->getValidTo()
        );

        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;
    }


    public function update($tableName)
    {

        $ds = new DataSource();

        $sql = sprintf("update %s set 
                    text=:text,
                    img=:img,
                    valid_from=:valid_from,
                    valid_to=:valid_to   
                 where id=:id", self::_TABLE);

        $params = array(
            ":text" => $tableName->getText(),
            ":img" => $tableName->getImg(),
            ":valid_from" => $tableName->getValidFrom(),
            ":valid_to" => $tableName->getValidTo(),
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