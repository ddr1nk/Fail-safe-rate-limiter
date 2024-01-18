<?php

use App\Kernel;

require_once __DIR__ . '/vendor/autoload.php';
require_once './App/Kernel.php';

$kernel = new Kernel();
$kernel->runApplication();
