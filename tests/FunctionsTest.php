<?php
declare(strict_types=1);

use \PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testEnv()
    {
        $this->assertEquals(1, env('test', 1));
    }

    public function testDir2namespace()
    {
        $this->assertEquals('a\\b\\c', dir2namespace('a/b/c'));
    }

    public function testNamespace2dir()
    {
        $this->assertEquals('a/b/c', namespace2dir('a\\b\\c'));
    }

    public function testHump2dash()
    {
        $this->assertEquals('a-good-name', hump2dash('AGoodName'));
    }

    public function testDash2humpWithUCFirst()
    {
        $this->assertEquals('AGoodName', dash2hump('a-good-name', true));
    }

    public function testDash2hump()
    {
        $this->assertEquals('aGoodName', dash2hump('a-good-name'));
    }
}
