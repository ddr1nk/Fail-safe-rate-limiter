<?php

namespace App;

use App\Database\DatabaseConnection;

class Kernel
{
    public function runApplication(): void
    {
        $this->loadNecessary();

        $this->handleRequest();

        $this->handleResponse();
    }


    private function loadNecessary(): void
    {
        $connection = DatabaseConnection::getConnection();
        print_r($connection);
    }

    private function handleResponse()
    {
    }

    private function handleRequest()
    {
    }
}