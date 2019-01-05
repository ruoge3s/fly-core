<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Demo
{
    use \core\traits\AttributeLoader;

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
        $this->assertEquals((new Demo())->load(['a' => 1])->a, 1);
    }

    public function testLoadNotExistPublicAttribute()
    {
        $this->assertObjectNotHasAttribute('q', (new Demo())->load(['q' => 1]));
    }
}