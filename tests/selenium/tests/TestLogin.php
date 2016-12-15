<?php
/**
 * Created by PhpStorm.
 * User: deivixx
 * Date: 13/12/16
 * Time: 15:50
 */

namespace selenium\tests;


use Facebook\WebDriver\WebDriverTestCase;



require_once __DIR__ .'/../WebDriverTestCase.php';

class TestLogin extends WebDriverTestCase
{

    function __construct()
    {
        $this->browser="Firefox";
        $this->url = "http://localhost/karting/index.php";

        parent::__construct($this->browser, $this->url);
    }

    function testPageOpened(){
        $this->driver->get($this->url);

        $link = $this->driver->findElement(
            WebDriverBy::id('personal')
        );
        $link->click();

    }

}