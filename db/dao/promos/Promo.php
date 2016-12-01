<?php

class Promo {

    private $id;
    private $text;
    private $img;
    private $from;
    private $to;

    /**
     * Promo constructor.
     */
    public function __construct()
    {
    }


    function __toString(){
        $contingut =" 
        <ul>
            <li>Texto:  \" . $this->text . \"</li>
            <li>De: \" . $this->from . \" </li>
            <li>To: \" . $this->to . </li >

        <ul>";

        return $contingut;


    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }




}


?>