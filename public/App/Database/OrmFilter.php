<?php

namespace App\Database;

class OrmFilter implements OrmFilterInterface
{
    public function toDatabaseFormat(): array
    {
        return [];
    }
}