<?php

if (!function_exists('env')) {
    /**
     * 获取环境变量
     * @param $key
     * @param null $default
     * @return mixed
     */
    function env(string $key, $default=null) {
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }
}

if (!function_exists('dir2namespace')) {
    /**
     * @param string $dir
     * @return string
     */
    function dir2namespace(string $dir) : string {
        return str_replace('/', '\\', $dir);
    }
}

if (!function_exists('namespace2dir')) {
    /**
     * @param string $dir
     * @return string
     */
    function namespace2dir(string $dir) : string {
        return str_replace('\\', '/', $dir);
    }
}
