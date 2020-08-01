<?php

namespace core;

/**
 * Class Single
 * @package core
 */
class Single
{
    protected static $instance = [];

    public static function instance()
    {
        if (!isset(self::$instance[static::class])) {
            self::$instance[static::class] = new static();
        }
        return self::$instance[static::class];
    }
}
