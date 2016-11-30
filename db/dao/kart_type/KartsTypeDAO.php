<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 16:58
 */
class KartsTypeDAO
{

    const _CLASS = "KartType";
    const _TABLE = "kart_type";

    const ID = "id";
    const TYPE = "type";
    const DESC = "desc";
    const IMG_PATH="img_path";


    /**
     * CONSULTAS GENERALES
     */

    public function getAll()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s ", self::_TABLE);
        $kart_typeList = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $kart_typeList;

    }


    public function getById($id)
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s=?", self::_TABLE, self::ID);
        $params = array($id);
        $kart_type = $ds->fetchToClass($sql, self::_CLASS, $params);
        $ds->close();

        return $kart_type;

    }


    /**
     * CRUD
     */

    public function insert($tableName)
    {

        $ds = new DataSource();

        $sql = sprintf("insert into %s (%s,%s, %s) 
                 values ( 
                    :type,
                    :desc,
                    :img_path
                    
                  
                     )", self::_TABLE, self::TYPE, self::DESC, self::IMG_PATH);

        $params = array(
            ":type" => $tableName->getType(),
            ":desc" => $tableName->getDesc(),
            ":img_path" => $tableName->getImgPath()
        );

        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;
    }


    public function update($tableName)
    {

        $ds = new DataSource();

        $sql = sprintf("update %s set 
                    type=:type,
                    desc=:desc,
                    img_path=:img_path                    
                  where id=:id", self::_TABLE);

        $params = array(
            ":type" => $tableName->getType(),
            ":desc" => $tableName->getDesc(),
            ":img_path" => $tableName->getImgPath(),
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