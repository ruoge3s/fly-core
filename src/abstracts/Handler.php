<?php

namespace core\abstracts;

use core\Config;

abstract class Handler
{
    protected $config;

    public function __construct()
    {
        $this->config = Config::instance()->get();
    }

    /**
     * 执行处理
     * @return mixed
     */
    abstract public function run();
}