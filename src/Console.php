<?php

namespace core;

use core\abstracts\Handler;

/**
 * Class Console
 * @package core
 */
class Console extends Handler
{

    protected $argv = null;

    /**
     * @param $data
     * @return $this
     */
    public function setArgv(array $data)
    {
        $this->argv = $data;
        return $this;
    }

    /**
     * run
     */
    public function run()
    {
        list($cn, $m) = $this->cm();
        if ($cn) {
            $className = Command::getNamespace() . '\\' . $cn;
            if (class_exists($className)) {
                $class = new $className($this->config);
                if ($class instanceof Command) {
                    $class->execute($m);
                    return;
                }
            }
        }
        (new Command($this->config))->cmdTips();
        return;
    }

    /**
     * 获取 class 和 method
     * @return array
     */
    protected function cm()
    {
        $class = '';
        $method = '';
        if (isset($this->argv[1])) {
            if (strpos($this->argv[1], ':')) {
                $cm = explode(':', $this->argv[1]);
                list($class, $method) = $cm;
            } else {
                $class = $this->argv[1];
            }
        }
        return [$class, $method];
    }

    public function parse()
    {
        $assignMap = [];
        if (count($this->argv) > 2) {
            $kvs = array_slice($this->argv, 2);
            foreach ($kvs as $kv) {
                if (preg_match('/(^[a-zA-Z_][0-9a-zA-Z_]*)=(.*)/', $kv, $ms)) {
                    $assignMap[$ms[1]] = $ms[2];
                } else {
                    exit("Class Attribute name isn`t correct!!!\n");
                }
            }
        }

        return $assignMap;
    }
}