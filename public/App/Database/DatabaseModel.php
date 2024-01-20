<?php

namespace App\Database;

class DatabaseModel
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }
}