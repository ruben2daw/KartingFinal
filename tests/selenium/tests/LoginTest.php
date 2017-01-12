<?php

namespace Facebook\WebDriver;

require_once dirname(__FILE__) . '/../WebDriverTestBase.php';


class LoginTest extends WebDriverTestBase
{

    function __construct()
    {
        $this->browser = "Chrome";
        //$this->browser="Firefox";
        $this->url = "http://localhost/karting/index.php";

        parent::__construct($this->browser, $this->url);
    }

    function testAdminLogin()
    {

        $this->login("bimbo", "bimbo");

        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::textToBePresentInElement(WebDriverBy::cssSelector(".col-md-10 > h1:nth-child(1)"), "Tandas")
        );

        $adminUrl = "http://localhost/karting/private/admin.php";
        $this->assertStringStartsWith($adminUrl, $this->driver->getCurrentURL());

    }

    function login($user, $pass)
    {

        $this->driver->get($this->url);


        $link = $this->driver->findElement(
            WebDriverBy::cssSelector('#personal')
        );
        $link->click();

        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector("#ulogin"))
        );

        $userLogin = $this->driver->findElement(
            WebDriverBy::cssSelector("#ulogin")
        );
        $userLogin->sendKeys($user);

        $userPass = $this->driver->findElement(
            WebDriverBy::cssSelector("#upass")
        );
        $userPass->sendKeys($pass);
        $userPass->submit();

    }

    function testUserLogin()
    {

        $this->login("manolo", "manolo");

        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::textToBePresentInElement(WebDriverBy::cssSelector(".active > a:nth-child(1)"), "Datos Personales")
        );

        $userUrl = "http://localhost/karting/private/user.php";
        $this->assertStringStartsWith($userUrl, $this->driver->getCurrentURL());

    }

}