<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * 测试类是否定义成功
 * Class ExistTest
 */
class ExistTest extends TestCase
{
    public function testInterfaceInitExist()
    {
        $this->assertTrue(interface_exists('core\interfaces\Init'));
    }

    public function testInterfaceArrayAbleExist()
    {
        $this->assertTrue(interface_exists('core\interfaces\ArrayAble'));
    }
}