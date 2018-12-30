<?php
require __DIR__ . '/../vendor/autoload.php';


class Test
{
    use \core\traits\AttributeLoader;

    public $a;
    protected $b;
    private $c;
    public static $d;
    protected static $e;
    private static $f;
}

$res = (new Test())->load(['a' => 1]);

var_dump($res);
