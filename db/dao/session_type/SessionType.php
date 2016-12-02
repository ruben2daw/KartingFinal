<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 02/12/2016
 * Time: 12:56
 */
class SessionType
{
    private $id;
    private $type;

    /**
     * SessionTypeDAO constructor.
     * @param $id
     * @param $type
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



}