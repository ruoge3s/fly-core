<?php

namespace core;

class Config extends Single
{
    protected $info = null;

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
            $buffer = $this->get();
            foreach ($data as $name) {
                $buffer = $buffer[$name];
            }
            return $buffer;
        }
        return $this->info;
    }
}