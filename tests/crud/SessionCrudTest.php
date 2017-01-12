<?php


//include_once dirname(__FILE__).'/../../lib/autoload.php';


class SessionCrudTest extends PHPUnit_Framework_TestCase
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
        $session->setId($this->id);
        $session->setName("test");
        $session->setType(1);
        $session->setDate('0000-00-00');
        //var_dump($session);

        $this->assertEquals(1,$this->dao->insert($session));
    }


    public function tearDown()
    {
        $this->dao=null;
    }

}
