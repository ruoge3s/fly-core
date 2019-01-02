<?php

declare(strict_types=1);

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
        \core\Config::instance()->load([
            'parent' => [
                'child' => [
                    'value' => $stander
                ]
            ]
        ]);

        $this->assertEquals(\core\Config::instance()->get('parent.child.value'), $stander);
    }
}