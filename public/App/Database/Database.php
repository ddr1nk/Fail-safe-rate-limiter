<?php

namespace App\Database;

use App\Helpers\Helper;
use PDO;

class Database
{
    private string $host;
    private string $database = '';
    private string $user;
    private string $password;
    private string $charset;

    public function __construct()
    {
        $this->host = Helper::config('database.host');
//        $this->database = Helper::config('database.database');
        $this->user = Helper::config('database.username');
        $this->password = Helper::config('database.password');
        $this->charset = Helper::config('database.charset');
    }

    public function getUsername(): string
    {
        return $this->user;

    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getDsn(): string
    {
        return "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
    }

    public function getOptions(): array
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }
}