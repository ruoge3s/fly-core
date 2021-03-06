<?php

namespace core;


use core\abstracts\App;

/**
 * Class Command
 * @package core
 */
class Command extends App
{
    protected static $commandNamespace = 'app\command';

    /**
     * 获取命令的命名空间
     * @return string
     */
    public static function getNamespace() : string
    {
        return self::$commandNamespace;
    }

    /**
     * 获取子类独有的方法
     * @return array
     */
    protected function getChildUniqueMethod() : array
    {
        return array_diff(
            get_class_methods(static::class),
            get_class_methods(self::class)
        );
    }

    /**
     * 执行方法
     * @param $method
     */
    public function execute($method)
    {
        if (method_exists($this, $method)) {
            if ($method == 'help') {
                $this->help($this->publicProperties(), "Property:\n");
                $this->help($this->publicMethods(), "Method:\n");
            } else {
                $this->$method();
            }
        } else {
            $this->help($this->publicMethods(), "Method:\n");
        }
    }

    /**
     * 获取public方法
     * @return array
     */
    public function publicMethods()
    {
        $publicMethods =  parent::publicMethods();
        $publicMethods['help'] = $this->publicMethodComment('help');
        return $publicMethods;
    }

    /**
     * 命令提示
     * @time 2018-12-22 12:23:57
     */
    public function cmdTips()
    {
        $classes =  $this->getCommandClasses();
        $helps = [];
        foreach ($classes as $className => $data) {
            $buff = explode('\\', $className);
            $command = array_pop($buff);
            $helps[$command] = $data;
        }

        $this->help($helps);
    }

    /**
     * 获取命令类
     * @return array
     */
    protected function getCommandClasses() : array
    {
        $dir = self::$baseDir . '/' . namespace2dir(self::$commandNamespace);
        return $this->classes($dir, self::$commandNamespace, static::class);
    }

    /**
     * @describe 获取帮助
     * @param array $helps
     * @param string $title
     */
    public function help(array $helps, $title="helps:\n")
    {
        $info = $title;
        foreach ($helps as $key => $data) {
            $describe = isset($data['describe']) ? $data['describe'] : [''];
            $start = str_repeat(' ', 4) . $key . " ";
            $info .= $start . $describe[0] . "\n";

            array_shift($describe);
            foreach ($describe as $text) {
                $info .= str_repeat(" ", strlen($start)) . $text . "\n";
            }

        }

        echo $info;
    }
}
