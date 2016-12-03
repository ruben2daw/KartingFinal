<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 03/12/2016
 * Time: 10:11
 */
class UserRoles
{
    private $id;
    private $role;

    /**
     * UserRoles constructor.
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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }





}