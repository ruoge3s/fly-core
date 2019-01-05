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

if (!function_exists('hump2dash')) {
    /**
     * @param string $string
     * @return string
     */
    function hump2dash(string $string) : string {
        return trim(preg_replace_callback('/[A-Z]/', function ($item) {
            return '-' . strtolower($item[0]);
        }, $string), '-');
    }
}

if (!function_exists('dash2hump')) {
    /**
     * @param string $string
     * @param bool $ucFirst
     * @return string
     */
    function dash2hump(string $string, $ucFirst=false) : string {
        $string = preg_replace_callback('/-([a-z])/', function ($item) {
            return strtoupper($item[1]);
        }, $string);

        return $ucFirst ? ucfirst($string) : $string;
    }
}
