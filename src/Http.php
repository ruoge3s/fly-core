<?php

namespace core;

use core\abstracts\Handler;
use core\interfaces\Init;
use Swoole\Http\Request;

/**
 * Class Http
 * @package core
 */
class Http extends Handler implements Init
{
    protected $classes = [];

    protected $classMethods = [];

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
        $this->classes = (new Controller())->getControllerClasses();

        foreach ($this->classes as $className => $classInfo) {
            $this->classMethods[$className] = $this->publicMethodsParse(new $className);
        }
    }

    /**
     * 获取控制器的公开方法
     * @param Controller $class
     * @return array
     */
    public function publicMethodsParse(Controller $class)
    {
        return array_keys($class->publicMethods());
    }

    /**
     * @return array|mixed|string
     */
    public function run()
    {
        list($cn, $m) = $this->cm();

        $className = Controller::getNamespace() . $cn;

        if (isset($this->classes[$className])) {
            $class = new $className;
            if ($class instanceof Controller) {
                return $class->execute($m);
            }
        } else {
            return 'class not exist.';
        }
    }

    public function parse(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function cm()
    {
        if (isset($this->request->server['path_info'])) {
            $res = explode("/", trim($this->request->server['path_info'], '/'));

            if (count($res) >=2) {
                return [$res[0], $res[1]];
            }
        }

        return ['Index', 'index'];
    }
}