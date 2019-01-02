<?php

namespace core\interfaces;

interface Middleware
{
    public function handle($request, $response, $next);

    public function run($request, $response);
}