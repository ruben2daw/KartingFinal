<?php

class Promo {

    private $id;
    private $text;
    private $img;
    private $from;
    private $to;
    function __toString(){
        $contingut =" 
        <ul>
            <li>Texto:  \" . $this->text . \"</li>
            <li>De: \" . $this->from . \" </li>
            <li>To: \" . $this->to . </li >

        <ul>";

        return $contingut;


    }

    function getId(){
        return $this->id;
    }

    function getText(){
        return $this->text;
    }

    function getTo(){
        return $this->to;
    }

    function getFrom(){
        return $this->from;
    }





    function setId($id){
        $this->id = $id;
    }


    function setText($text){
        $this->text = $text;
    }

    function setTo($to){
        $this->img = $to;
    }


    function setFrom($from){
        $this->from = $from;
    }




}
    $objeto = new PromosDAO;
    $listaPromo= $objeto->getAll();

    foreach ($listaNews as $promociones) {
        echo "$promociones <br>";
    }

?>