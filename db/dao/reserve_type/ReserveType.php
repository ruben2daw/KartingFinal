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
    private $descripcion;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }




}