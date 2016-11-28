<?php

class PromosDAO{

    public function getAll(){

        $ds = new DataSource();
        $sql = "SELECT * from promo";
        $list = $ds->fetchAllToClass($sql,"Promo");
        $ds->close();

        return $list;

    }


    public function getById($id){

        $ds = new DataSource();
        $sql = "SELECT * from promo where id=?";
        $params = array($id);
        $obj = $ds->fetchToClass($sql,"Promo",$params);
        $ds->close();

        return $obj;

    }

    public function insert($promo){

        $ds = new DataSource();

        $sql = "insert into promo (text,from,to) 
                 values ( 
                    :text,
                    :from,
                    :to)";

        $params = array(
            ":text" => $promo->getText(),
            ":from" => $promo->getFrom(),
            ":to" => $promo ->getTo()
        );
        $result = $ds->execute($sql,$params);
        $ds->close();

        return $result;

    }

    public function update($promo){

        $ds = new DataSource();

        $sql = "update promo set text = :text,from = :from, to = :to where id=:id";

        $params = array(
            ":text" => $promo->getText(),
            ":from" => $promo->getFrom(),
            ":to" => $promo ->getTo(),
            ":id" => $promo->getId()
        );
        $result = $ds->execute($sql,$params);
        $ds->close();

        return $result;

    }


    public function delete($id){

        $ds = new DataSource();
        $sql = "delete from promo where id = ?";
        $params = array($id);
        $result = $ds->execute($sql,$params);
        $ds->close();

        return $result;

    }



}


?>