<?php
declare(strict_types=1);

use core\traits\AttributeLoader;
use PHPUnit\Framework\TestCase;

class Demo
{
    use AttributeLoader;

    public $a;
    protected $b;
    private $c;
    public static $d;
    protected static $e;
    private static $f;
}

class AttributeLoaderTest extends TestCase
{
    public function testLoadPublicAttribute()
    {
        $this->assertEquals(1, (new Demo())->load(['a' => 1])->a);
    }

    public function testLoadNotExistPublicAttribute()
    {
        $this->assertObjectNotHasAttribute('q', (new Demo())->load(['q' => 1]));
    }
}
