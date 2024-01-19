<?php

namespace App\Helpers;

use Psr\Log\LoggerInterface;
use Monolog\Logger as MonologLogger;

class Logger
{
    /**
     * @var LoggerInterface|null
     */
    protected static ?LoggerInterface $logger = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return LoggerInterface
     */
    public static function getInstance(): LoggerInterface
    {
        if (!static::$logger) {
            static::$logger = new MonologLogger('default');
        }

        return static::$logger;
    }
}