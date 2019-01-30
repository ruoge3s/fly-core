<?php
namespace app\command;


use core\Command;

/**
 * Class Test
 * @describe 测试类
 * @package app\command
 */
class Test extends Command
{
    /**
     * @describe 测试
     */
    public function test()
    {
        echo "11\n";
    }
}