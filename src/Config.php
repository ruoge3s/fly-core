<?php

namespace core;

class Config extends Single
{
    protected $info = [];

    /**
     * 加载配置
     * @param $info
     */
    public function load($info)
    {
        $this->info = $info;
    }

    /**
     * 获取配置
     * @param string|null $name
     * @return null
     */
    public function get(string $name=null)
    {
        if ($name !== null) {
            $data = explode('.', $name);
            $buffer = $this->info;
            foreach ($data as $name) {
                $buffer = $buffer[$name];
            }
            return $buffer;
        }
        return $this->info;
    }
}