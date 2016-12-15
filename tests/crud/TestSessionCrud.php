<?php

include_once '../../lib/autoload.php';


class TestSessionCrud extends PHPUnit_Framework_TestCase
{

    private $dao=null;
    private $id=9999;
    private $value='test';

    public function setUp()
    {
        $this->dao=new SessionsDAO();

    }

    public function  testInsertSession(){
        $session=new Session();
        //$session->setId($this->id);
        $session->setName("test");
        $session->setType(1);
        $session->setDate('2001-10-10');
        //$session->setDate('0000-00-00');
        $this->assertEquals(1,$this->dao->insert($session));
    }


    public function tearDown()
    {
        $this->dao=null;
    }

}
