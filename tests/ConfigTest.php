<?php

declare(strict_types=1);

use core\Config;
use PHPUnit\Framework\TestCase;

/**
 * 测试类是否定义成功
 * Class ExistTest
 */
class ConfigTest extends TestCase
{
    public function testConfigGet()
    {
        $stander = '10082';
        Config::instance()->load([
            'parent' => [
                'child' => [
                    'value' => $stander
                ]
            ]
        ]);

        $this->assertEquals(Config::instance()->get('parent.child.value'), $stander);
    }
}
