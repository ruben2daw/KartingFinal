<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 13:25
 */
class Reserve implements JsonSerializable
{

    private $id;
    private $user;
    private $date;
    private $number;
    private $type;
    private $kart_type;
    /**
     * Reserve constructor.
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
    public function getKartType()
    {
        return $this->kart_type;
    }

    /**
     * @param mixed $kart_type
     */
    public function setKartType($kart_type)
    {
        $this->kart_type = $kart_type;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {


        return [
            'user' => $this->user,
            'date' => $this->date,
            'number' => $this->number,
            'type' => $this->type,
            'kart_type' => $this->kart_type,

        ];
    }
}