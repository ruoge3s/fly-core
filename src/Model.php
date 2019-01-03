<?php

namespace core;

use core\abstracts\App;

class Model
{
    public function __construct(Array $data = [])
    {
        App::configure($this, $data);
    }

    protected function set()
    {

    }

    protected function get()
    {

    }
}
