<?php
declare(strict_types=1);

use \PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testEnv()
    {
        $this->assertEquals(env('test', 1), 1);
    }

    public function testDir2namespace()
    {
        $this->assertEquals(dir2namespace('a/b/c'), 'a\\b\\c');
    }

    public function testNamespace2dir()
    {
        $this->assertEquals(namespace2dir('a\\b\\c'), 'a/b/c');
    }

    public function testHump2dash()
    {
        $this->assertEquals(hump2dash('AGoodName'), 'a-good-name');
    }

    public function testDash2humpWithUCFirst()
    {
        $this->assertEquals(dash2hump('a-good-name', true), 'AGoodName');
    }

    public function testDash2hump()
    {
        $this->assertEquals(dash2hump('a-good-name'), 'aGoodName');
    }
}