<?php

require __DIR__ . '/../vendor/autoload.php';


class Foo extends \core\Middleware
{
    public function handle($request, $response, $next)
    {
        // TODO: Implement handle() method.
    }

    public function run($request, $response)
    {
        // TODO: Implement run() method.
    }
}

class Bar extends \core\Middleware
{
    public function handle($request, $response, $next)
    {
        // TODO: Implement handle() method.
    }

    public function run($request, $response)
    {
        return $response;
    }
}


$foo = new Foo();
$bar = new Bar();

$request = [];
$response = [];


