<?php

namespace Facebook\WebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
require_once __DIR__ .'/../../vendor/autoload.php';


class WebDriverTestCase extends \PHPUnit_Framework_TestCase
{
    /** @var RemoteWebDriver $driver */
    protected $driver;
    protected $browser;
    protected $url;

    function __construct($browser,$url)
    {
        $this->browser=$browser;
        $this->url=$url;
    }

    protected function setUp()
    {
        $host = 'http://localhost:4444/wd/hub';

        if($this->browser=="Firefox") {

            $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());

        }elseif ($this->browser=="Crhome"){

            $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        }
    }


    protected function tearDown()
    {
        if ($this->driver) {
            $this->driver->quit();
        }
    }


    /**
     * Get the URL of the test html.
     *
     * @param $path
     * @return string
     */
    protected function getTestPath($path)
    {
        return 'file:///' . __DIR__ . '/html/' . $path;
    }
}

?>