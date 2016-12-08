<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 17:25
 */
class ReservesDAO
{

//TODO: VAMOS POR AQUI

    const _CLASS = "Reserve";
    const _TABLE = "reserves";
    const ID = "id";

    const USER = "user";
    const DATE = "date";
    const NUMBER = "number";
    const TYPE = "type";
    const KART_TYPE = "kart_type";

    /**
     * CONSULTAS GENERALES
     */

    public function getAll()
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s ", self::_TABLE);
        $reserve = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $reserve;

    }
    public function getAllofUser($id_user)
    {

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where user=$id_user", self::_TABLE, $id_user);
        $reserve = $ds->fetchAllToClass($sql, self::_CLASS);
        $ds->close();

        return $reserve;

    }

    //Muestra ficheros dentro de directorio
    public function showList($userId)
    {


        $ds = new DataSource();
        $array = array($userId);
        $sql = sprintf("SELECT * from %s where %s=?", self::_TABLE, self::USER);

        $dirFileList = "<h2>Listado de Reservas</h2>";
        foreach ($ds->fetchAll($sql, $array) as $row) {
            $id = $row['id'];
            $dirFileList .= "- " . $id . "&nbsp;<a href='" . $_SERVER['PHP_SELF'] . "?section=reserves&delete=".$id." '>Borrar</a>&nbsp;|&nbsp;<a href='" . $_SERVER['PHP_SELF'] . "?section=reserves&watch=$id'>Ver</a>|&nbsp;<a href='" . $_SERVER['PHP_SELF'] . "?section=reserves&edit=$id'>Editar</a><br>";

        }

        $ds->close();

        return $dirFileList;
    }


    public function getDateQuery($date)
    {
        $hayCoincidencias = false;

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s = $date", self::_TABLE, self::DATE);
        $result = $ds->query($sql);
        $ds->close();

        foreach ($result as $row) {
            $hayCoincidencias = true;
        }

        return $hayCoincidencias;

    }

    public function getDateFech($date)
    {
        $hayCoincidencias = false;

        $ds = new DataSource();
        $sql = sprintf("SELECT * from %s where %s = ?", self::_TABLE, self::DATE);
        $array = array($date);
        $result = $ds->fetch($sql, $array);
        $ds->close();

        if ($result)
            $hayCoincidencias = true;


        return $hayCoincidencias;

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
     * @param $id
     * @return bool
     * const USER = "user";
    const DATE = "date";
    const NUMBER = "number";
    const TYPE = "type";
    const KART_TYPE = "kart_type";
     */





    /**
     * CRUD
     */



    public function insert($reserve){
        $ds = new DataSource();

        $sql = "insert into reserves (user,date,number,type, kart_type)
                    values (
                        :user,
                        :date,
                        :number,
                        :type,
                        :kart_type)";

        $params = array(
            ":user" => $reserve->getUser(),
            ":date" => $reserve->getDate(),
            ":number" => $reserve->getNumber(),
            ":type" => $reserve->getType(),
            ":kart_type" => $reserve->getKartType()
        );

        $result = $ds->execute($sql,$params);
        $ds->close();

        return $result;
    }



    public function update($reserve){
        $ds = new DataSource();

        $sql = "update reserves set 
                     user = :user,
                     date = :date,
                     number = :number,
                     type = :type,
                     kart_type =:kart_type
                    where id=:id";

        $params = array(
            ":user" => $reserve->getUser(),
            ":date" => $reserve->getDate(),
            ":number" => $reserve->getNumber(),
            ":type" => $reserve->getType(),
            ":kart_type" => $reserve->getKartType(),
            ":id" => $reserve->getId()
        );

        $result = $ds->execute($sql,$params);
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