<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 13:07
 */
class Kart
{
    private $id;
    private $number;
    private $type;
    private $available;

    /**
     * Kart constructor.
     * NO PUEDE HABER UN KART SIN TENER UN NUMERO DE REFERENCIA
     * @param $number
     */
    public function __construct()
    {

    }


    function __toString()
    {
        return "mi numero es" . $this->number . " 
        </br> Mi tipo  es " . $this->type . "
        </br> esta disponible " . $this->available;

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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }


}