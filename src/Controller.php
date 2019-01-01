<?php

namespace core;

use core\abstracts\App;

/**
 * Class Controller
 * @package core
 */
class Controller extends App
{
    protected static $commandNamespace = 'app\controller';

    public static function getNamespace()
    {
        return self::$commandNamespace;
    }

    public function execute($m)
    {
        if (method_exists($this, $m)) {
            return $this->$m();
        } else {
            return ['方法不存在'];
        }
    }

    /**
     * 获取所有的控制器类
     * @return array
     */
    public function getControllerClasses()
    {
        $dir = self::$baseDir . '/' . namespace2dir(self::$commandNamespace);
        return $this->classes($dir, self::$commandNamespace, static::class);
    }
}

