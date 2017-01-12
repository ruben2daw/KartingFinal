<?php
// An example of using php-webdriver.

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('vendor/autoload.php');

// Inicia Firefox con 5 segundos de retardo
$host = 'http://localhost:4444/wd/hub'; // this is the default
$driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox(), 5000);

// Navega a la página 'http://docs.seleniumhq.org/'
$driver->get('http://docs.seleniumhq.org/');

// Añadimos cookie
$driver->manage()->deleteAllCookies();
$driver->manage()->addCookie([
    'name' => 'cookie_name',
    'value' => 'cookie_value',
]);

//Obtenemos cookies e imprimimos
$cookies = $driver->manage()->getCookies();
print_r($cookies);

// click en 'About'
$link = $driver->findElement(
    WebDriverBy::id('menu_about')
);
$link->click();

// imprime el titulo de la página actual
echo "The title is '" . $driver->getTitle() . "'\n";
// imprime URL de la página actual
echo "The current URI is '" . $driver->getCurrentURL() . "'\n";

// Busca 'php' en caja de búsqueda
$input = $driver->findElement(
    WebDriverBy::id('q')
);

$element = $driver->findElement(
    WebDriverBy::className('bright')
);

//Espera 10 segundos
$driver->wait(10);


//Espera hasta que se cumpla una condición
//se comprueba cada 500 milisegundos
//esperando 10s como máximo
wait(10, 500)->until(
    WebDriverExpectedCondition::textToBePresentInElement(WebDriverBy::cssSelector(".col-md-10 > h1:nth-child(1)"), "Tandas")
);

wait(10, 500)->until(
    WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id("el1"))
);

wait(10, 500)->until(
    WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("heaader"))
);

wait(10, 500)->until(
    WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::linkText("Press here"))
);


$input->sendKeys('php')->submit();

// espera como mucho 10 segundos hasta que el primer resultado se muestre
$driver->wait(10)->until(
    WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
        WebDriverBy::className('gsc-result')
    )
);

// cierra Firefox
$driver->quit();