<?php
namespace app\command;


use core\Command;
use core\Log;

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

    public function log()
    {
        Log::instance()->info('你好');
    }
}
