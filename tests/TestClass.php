<?php

namespace Test;

use PHPUnit\Framework\TestCase;

class TestClass extends TestCase
{
    public function testFunc()
    {
        // $view = view('index');
        // dd($view);
        // $viewfile = dirname(__DIR__).'/views/index.php';
        // $this->assertStringEqualsFile($viewfile, $view);
        $this->assertTrue(true);
        $this->assertSame(5, 5);
        $testArray1 = [1,2,3];
        $testArray2 = [1,2,3];
        $this->assertArrayIsEqualToArrayIgnoringListOfKeys($testArray1,$testArray2, [0]);
        $nedle = 'test';
        $this->assertContains($nedle, ['test']);
        
        $arr = [1,2,4,5];
        $this->assertCount(4, $arr);

    }
}