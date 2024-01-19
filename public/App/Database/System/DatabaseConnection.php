<?php

namespace App\Database\System;

use PDO;

final class DatabaseConnection
{
    protected static ?PDO $pdo = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getConnection(): PDO
    {
        if (!DatabaseConnection::$pdo) {
            $database = new Database();

            DatabaseConnection::$pdo = new PDO(
                dsn: $database->getDsn(),
                username: $database->getUsername(),
                password: $database->getPassword(),
                options: $database->getOptions(),
            );
        }

        return DatabaseConnection::$pdo;
    }

    public static function isConnected(): bool
    {
        return !is_null(DatabaseConnection::$pdo);
    }
}