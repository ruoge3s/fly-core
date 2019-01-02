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
    /**
     * @throws ReflectionException
     */
    public function testLoadPublicAttribute()
    {
        $demo = new Demo();
        $demo->load(['a' => 1]);
        $this->assertEquals($demo->a, 1);
    }

    /**
     * @throws ReflectionException
     */
    public function testLoadNotExistPublicAttribute()
    {
        $demo = new Demo();
        $demo->load(['q' => 1]);
        $this->assertObjectNotHasAttribute('q', $demo);
    }
}