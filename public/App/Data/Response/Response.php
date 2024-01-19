<?php

namespace App\Data\Response;

class Response
{
    /**
     * @return void
     */
    public function output(): void
    {
        echo static::class;
    }
}