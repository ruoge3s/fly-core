<?php

define('BASE_DIR',  dirname(__DIR__, 1) . '/');

require_once BASE_DIR . 'vendor/autoload.php';

date_default_timezone_set("Asia/Shanghai");

\core\abstracts\App::$baseDir = BASE_DIR;

\core\Config::instance()->load([
    'log' => [
        'filename'  => BASE_DIR . 'runtime/app.log',
        'name'      => 'ql',
        'level'     => \Monolog\Logger::DEBUG
    ]
]);

(new core\Console())->setArgv($argv)->run();
