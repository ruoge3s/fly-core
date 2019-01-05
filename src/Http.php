<?php

namespace core;

use core\abstracts\App;
use core\abstracts\Handler;
use core\interfaces\Init;
use Swoole\Http\Request;

/**
 * Class Http
 * @package core
 */
class Http extends Handler implements Init
{
    /**
     * 路由map
     * @var array
     */
    public $routers = [];

    /**
     * @var \Swoole\Http\Request
     */
    protected $request = null;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    /**
     * 初始化
     */
    public function init()
    {
        $this->parseRouter();
    }

    /**
     * 解析路由
     */
    public function parseRouter()
    {
        $classes = (new Controller())->getControllerClasses();
        foreach ($classes as $className => $classInfo) {
            $classNameInfo = explode('\\', $className);
            $n = array_pop($classNameInfo);
            $cName = hump2dash($n);
            $methods = (new $className)->publicMethods();
            foreach ($methods as $mName => $methodInfo) {
                if (isset($methodInfo['route'][0])) {
                    $key = $methodInfo['route'][0];
                } else {
                    $key = sprintf("/%s/%s", $cName, hump2dash($mName));
                }
                if (isset($this->routers[$key])) {
                    echo "Router defined error.";
                    exit();
                } else {
                    $this->routers[$key] = [$className, $mName];
                }
            }
        }
    }

    /**
     * @return array|mixed|string
     */
    public function run()
    {
        list($className, $method) = $this->routers[$this->request->server['path_info']];

        # TODO 自动注入
        return (new $className)->load(array_merge(['request' => $this->request], $this->config))->$method();
    }

    public function parse(Request $request)
    {
        $this->request = $request;
        return $this;
    }
}