<?php

namespace App\Controllers;

use App\Factories\PostFactory;
use Monolog\Logger;

abstract class BaseController
{
    protected Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger(static::class);
    }
}