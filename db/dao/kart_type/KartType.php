<?php

/**
 * Created by PhpStorm.
 * User: ruben_000
 * Date: 12/11/2016
 * Time: 13:07
 */
class KartType
{
   private $id;
   private $type;
   private $desc;
   private $img_path;

    function __toString()
    {
        return "id" . $this->id . " 
        </br> typo es " . $this->type . "
         </br> desc es " . $this->desc . "         
        </br> ruta <img src=".$this->img_path."/>"  ;
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

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return mixed
     */
    public function getImgPath()
    {
        return $this->img_path;
    }

    /**
     * @param mixed $img_path
     */
    public function setImgPath($img_path)
    {
        $this->img_path = $img_path;
    }




}