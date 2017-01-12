<?php

namespace Facebook\WebDriver;

use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

class WebDriverTestBase extends \PHPUnit_Framework_TestCase
{
    /** @var RemoteWebDriver $driver */
    protected $driver;
    protected $browser;
    protected $url;

    function __construct($browser, $url)
    {
        $this->browser = $browser;
        $this->url = $url;
    }

    protected function setUp()
    {
        $host = 'http://localhost:4444/wd/hub';

        if ($this->browser == "Firefox") {

            $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());

        } elseif ($this->browser == "Chrome") {

            $caps = DesiredCapabilities::chrome();
            $options = new ChromeOptions();
            //Descomentar en Linux
            //$options->setBinary('/usr/bin/chromium');
            $caps->setCapability(ChromeOptions::CAPABILITY, $options);

            $this->driver = RemoteWebDriver::create($host, $caps);
        }

        $this->driver->manage()->window()->maximize();

    }


    protected function tearDown()
    {
        if ($this->driver) {
            $this->driver->quit();
        }
    }


    protected function getTestPath($path)
    {
        return 'file:///' . __DIR__ . '/html/' . $path;
    }
}

?>