<?php

namespace core;

use core\interfaces\Middleware as IMiddleware;


class Middleware implements IMiddleware
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