<?php

namespace App\Database\System;

use App\Helpers\Helper;
use PDO;

class Database
{
    /**
     * @var string
     */
    private string $host;

    /**
     * @var string
     */
    private string $database = '';

    /**
     * @var string
     */
    private string $user;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var string
     */
    private string $charset;

    public function __construct()
    {
        $this->host = Helper::config('database.host');
//        $this->database = Helper::config('database.database');
        $this->user = Helper::config('database.username');
        $this->password = Helper::config('database.password');
        $this->charset = Helper::config('database.charset');
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->user;

    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }
}