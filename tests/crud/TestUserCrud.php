<?php

include_once '../../lib/autoload.php';


class TestUserCrud extends PHPUnit_Framework_TestCase
{
    private $dao=null;
    private $value='test';
    private $value2='test2';

    public function setUp()
    {
        $this->dao=new UserDAO();

    }

    public function testInsertUser(){

        $user=new User($this->value);
        $user->setEmail($this->value);
        $user->setFirstName($this->value);
        $user->setLastName($this->value);
        $user->setLogin($this->value);
        $user->setPassword(password_hash($this->value,true));
        $user->setRole(2);

        $this->assertEquals(1,$this->dao->insert($user));

        $insertedUser=$this->dao->getByLogin($this->value);
        $this->assertEquals($this->value,$insertedUser->getLastName());

    }


    public function  testUpdateUser(){

        $user=$this->dao->getByLogin($this->value);
        $user->setLastName($this->value2);
        var_dump("VAR DUMPPPP................".$user);
        $this->assertEquals(1,$this->dao->update($user));

        $updatedUser=$this->dao->getByLogin($this->value);
        $this->assertEquals($this->value2,$updatedUser->getLastName());

   }

   public function  testDeleteUser(){

       $user=$this->dao->getByLogin($this->value);
       $this->assertEquals(1,$this->dao->delete($user->getId()));

       $deletedUser=$this->dao->getByLogin($this->value);
       $this->assertFalse($deletedUser);

   }

    public function  tearDown(){

        $this->dao=null;
    }
}
