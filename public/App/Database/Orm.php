<?php

namespace App\Database;

use Monolog\Logger;

abstract class Orm
{
    public function __construct()
    {
        if (!DatabaseConnection::isConnected()) {
            (new Logger('OrmLogger'))->critical('Нет подключекния к БД');
        }
    }
}