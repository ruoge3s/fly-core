<?php

namespace core\abstracts;

use core\traits\AttributeLoader;

/**
 * Class App
 * @package core
 */
abstract class App
{
    use AttributeLoader;

    /**
     * 项目的根目录,由外部传递
     * @var string
     */
    public static $baseDir = '';

    abstract public function execute($m);

    abstract public static function getNamespace();

    /**
     * 获取子类独有的方法
     * @return array
     */
    abstract protected function getChildUniqueMethod() : array ;

    public function __construct(array $config = [])
    {
        App::configure($this, $config);
    }

    /**
     * 把一个键值对数据配置给一个类的属性
     * @param $object
     * @param array $data
     */
    public static function configure($object, array $data)
    {
        foreach ($data as $k => $v) {
            $object->$k = $v;
        }
    }

    /**
     * 解析注释
     * @param $text
     * @return array
     * @time 2018-12-22 11:11:50
     */
    protected function parseComment($text)
    {
        $res = preg_replace(['/^\/\*{2}/', '/\*{1}/', '/\/$/'], '', $text);
        $lines = explode("\n", $res);

        $key = 'default';
        $comments = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }
            if ($line[0] == '@') {
                $lineKV = explode(' ', $line);
                $key = substr($lineKV[0], 1);
                $line = ltrim($line, $lineKV[0] . " ");
            }
            $comments[$key] = isset($comments[$key]) ? array_merge($comments[$key], [$line]): [$line];
        }

        return $comments;
    }

    /**
     * @param string $dir
     * @param string $namespace
     * @param string $restrain
     * @return array
     */
    protected function classes(string $dir, string $namespace, string $restrain) : array
    {
        $handlers = [];
        $list = scandir($dir);
        foreach ($list as $filename) {
            if (preg_match('/(^[A-Z]\w+)(\.php)$/', $filename, $matches)) {
                $className = $namespace . '\\' . $matches[1];
                if (class_exists($className)) {
                    try {
                        $r = new \ReflectionClass($className);
                        if ($r->getParentClass() and $r->getParentClass()->name == $restrain) {
                            $handlers[$className] = $this->parseComment($r->getDocComment());
                        } else {
                            echo sprintf("Class $className need to extend from %s\n", $restrain);
                            exit();
                        }
                    } catch (\Exception $e) {
                        echo $e->getMessage();
                        exit();
                    }
                }
            }
        }
        return $handlers;
    }

    /**
     * 获取public方法
     * @return array
     * @time 2018-12-22 10:20:53
     */
    public function publicMethods()
    {
        $uniqueMethods = $this->getChildUniqueMethod();
        $publicMethods = [];
        foreach ($uniqueMethods as $method) {
            $comment =  $this->publicMethodComment($method);
            $comment !== null && $publicMethods[$method] = $comment;
        }

        return $publicMethods;
    }

    protected function publicMethodComment($method)
    {
        try {
            $methodObj = new \ReflectionMethod(static::class, $method);
        } catch (\Exception $e) {
            echo __FILE__ . ' ' . $e->getMessage() . "\n";
            exit();
        }

        if ($methodObj->isPublic()) {
            return $this->parseComment($methodObj->getDocComment());
        } else {
            return null;
        }
    }

    /**
     * 获取public属性
     * @return array
     */
    public function publicProperties()
    {
        $publicProperties = [];
        try {
            $rc = new \ReflectionClass(static::class);
            $properties = $rc->getProperties();
            foreach ($properties as $property) {
                if ($property->class != self::class) {
                    $publicProperties[$property->name] = $this->parseComment($property->getDocComment());
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            exit();
        }
        return $publicProperties;
    }
}