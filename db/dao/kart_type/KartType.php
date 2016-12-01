<?php


class KartType
{
    private $id;
    private $description;
    private $type;
    private $img_path;


    public function getImgPath()
    {
        return $this->img_path;
    }

    public function setImgPath($img_path)
    {
        $this->img_path = $img_path;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
    }



    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }



    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
    }
}

?>