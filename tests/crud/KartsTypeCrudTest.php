<?php

include_once '../../lib/autoload.php';


class KartsTypeCrudTest extends PHPUnit_Framework_TestCase
{

    private $dao = null;
    private $id = 9999;


    private $value1 = 'Value1';
    private $value2 = 'Value2';
    private $value3 = 'Value3';


    public function setUp()
    {
        $this->dao = new KartsTypeDAO();

    }

    public function testInsert()
    {
        $kart_type = new KartType();
        $kart_type->setDescription($this->value1);
        $kart_type->setImgPath($this->value2);
        $kart_type->setType($this->value3);
        $this->assertEquals(1, $this->dao->insert($kart_type));
    }


    public function testUpdateUser()
    {

        $kart_type = $this->dao->getById(1);

        $kart_type->setDescription($this->value1);
        $kart_type->setImgPath($this->value2);
        $kart_type->setType($this->value3);


        $this->assertEquals(1, $this->dao->update($kart_type));

        // $this->assertEquals($this->value2,$updatedUser->getLastName());

    }

    public function testDeleteUser()
    {


        $this->assertEquals(1, $this->dao->delete(2));


    }


    public function tearDown()
    {
        $this->dao = null;
    }

}
