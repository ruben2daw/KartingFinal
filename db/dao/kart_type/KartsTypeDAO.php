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
    const DESC = "description";
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

    public function getKartIdType($id = -1){
        $ds = new DataSource();
        $sql = "SELECT id, type from kart_type";
        $params = array();
        $kart = $ds->fetchAll($sql, $params);
        $ds->close();
        $select="";
        for($i=0; $i<count($kart); $i++){
            if($id == $i+1){
                $select.="<option value='".$kart[$i][0]."' selected>".$kart[$i][1]."</option>";
            }else{
                $select.="<option value='".$kart[$i][0]."'>".$kart[$i][1]."</option>";
            }
        }

        return $select;
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
            ":desc" => $tableName->getDescription(),
            ":img_path" => $tableName->getImgPath()
        );

        $result = $ds->execute($sql, $params);
        $ds->close();

        return $result;
    }

    public function getAllForAdminKart(){
        $ds = new DataSource();
        $sql = "SELECT id,type,desc,img_path from kart_type";
        $kartList = $ds->fetchAllToClass($sql,"KartType");
        $ds->close();

        return $kartList;
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
            ":desc" => $tableName->getDescription(),
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