<?php

namespace App\Database;

interface OrmFilterInterface
{
    public function toDatabaseFormat(): mixed;
}