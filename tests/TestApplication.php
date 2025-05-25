<?php declare(strict_types=1);

namespace Test;

use App\core\Application;
use PHPUnit\Framework\TestCase;

final class TestApplication extends TestCase
{
    private Application $app;
    private $test = ''; 
   
    

    public function testInti()
    {
        // 
        $this->app = new Application();
        $this->app->init();
        $this->assertEmpty($this->test);
    }

    public function testRun()
    {
        //
        $this->assertEmpty($this->test);
    }

    public function testHandleRequest()
    {
        // 
        $this->assertEmpty($this->test);
    }

    public function testTest()
    {
        $this->assertTrue(true);
    }

    public function testTest2()
    {
        $dirNotExist = "/";
        $this->assertDirectoryExists($dirNotExist);
    }
}