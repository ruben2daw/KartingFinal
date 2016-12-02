<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 13:22
 */
class Promo
{
    private $id;
    private $text;
    private $img;
    private $from_date;
    private $to_date;

    function __toString(){
        $contingut =" 
        <ul>
            <h2>   $this->text  </h2>
              </br><img src='$this->img'/>\"  ;
            <li>De: \" . $this->from_date . \" </li>
            <li>Hasta: \" . $this->to_date . </li >

        <ul>";

        return $contingut;


    }
    /**
     * Promo constructor.
     */
    public function __construct()
    {
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
        return $this->from_date;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from_date)
    {
        $this->from_date = $from_date;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to_date;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to_date)
    {
        $this->to_date = $to_date;
    }






}