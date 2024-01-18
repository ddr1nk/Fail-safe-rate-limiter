<?php

namespace App\Database;

use PDO;

final class DatabaseConnection
{
    protected static ?PDO $pdo = null;

    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        if (!DatabaseConnection::$pdo) {
            $host = 'localhost';
            $db   = 'test';
            $user = 'user';
            $pass = 'password';
            $charset = 'utf8';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            DatabaseConnection::$pdo = new PDO($dsn, $user, $pass, $opt);
        }

        return DatabaseConnection::$pdo;
    }

    public static function isConnected(): bool
    {

        return true;
//        return !is_null(DatabaseConnection::$pdo);
    }
}