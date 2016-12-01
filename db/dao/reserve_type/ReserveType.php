<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 30/11/2016
 * Time: 18:32
 */
class ReserveType
{

    private $id;
    private $description;

    /**
     * ReserveType constructor.
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }




}