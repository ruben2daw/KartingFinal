<?php

//include_once dirname(__FILE__).'/../../lib/autoload.php';

class Funcionalidad1Test extends PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        /*
            Éste método se ejecuta antes del primer test
            puede ser útil para inicializar variables, cargar datos, etc

        */
    }

    public static function tearDownAfterClass()
    {

        /*
            Éste método se ejecuta después del último test
            puede ser útil para liberar memoria, restaurar datos, etc

        */
    }

    public function setUp()
    {
        /*
            Éste método se ejecuta antes de cada test

        */
    }

    function test1()
    {

        //acciones ...

        // aserciones
        $this->assertEquals();
        $this->assertFalse();
        $this->assertEmpty();
        $this->assertTrue();
        $this->assertGreaterThan();
        $this->assertNull();
        $this->assertFileExists();

    }

    function test2()
    {

        /*
         * Test para probar funcionalidad X
         * */

    }

    public function tearDown()
    {
        /*
            Éste método se después de cada test

        */
    }

}
