<?php

declare(strict_types=1);

namespace core;

use core\traits\AttributeLoader;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class Log
 * @method log($level, $message, array $context = [])
 * @method debug($message, array $context = [])
 * @method info($message, array $context = [])
 * @method notice($message, array $context = [])
 * @method warning($message, array $context = [])
 * @method error($message, array $context = [])
 * @method critical($message, array $context = [])
 * @method alert($message, array $context = [])
 * @method emergency($message, array $context = [])
 * @package core
 */
class Log extends Single
{
    use AttributeLoader;

    public $name = 'app';

    protected $logger;

    public $filename;

    public $level = Logger::WARNING;

    public function __construct()
    {
        $config = Config::instance()->get('log');
        $this->load($config);
        $this->logger = new Logger($this->name);

        $stream = new StreamHandler($this->filename, $this->level);

        $formatter = new LineFormatter("[%datetime%] %channel%.%level_name% > %message% %context% %extra%\n", 'Y-m-d H:i:s');
        $stream->setFormatter($formatter);

        $this->logger->pushHandler($stream);

    }

    public function __call($name, $arguments)
    {
        return $this->logger->$name(...$arguments);
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     * @return LoggerInterface
     */
    public function setLogger(LoggerInterface $logger)
    {
        return $this->logger = $logger;
    }
}
