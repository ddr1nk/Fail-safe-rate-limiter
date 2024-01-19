<?php

namespace App\Database;

use App\Database\System\DatabaseConnection;
use Monolog\Logger;

abstract class Orm
{
    protected string $table;

    public function __construct()
    {
        if (!DatabaseConnection::isConnected()) {
            (new Logger('OrmLogger'))->critical('Нет подключекния к БД');
        }
    }

    public function itemById(int $id): DatabaseModel
    {
        return new DatabaseModel();
    }

    public function itemsByFilter(OrmFilter $filter): DatabaseCollection
    {
        return new DatabaseCollection();
    }
}