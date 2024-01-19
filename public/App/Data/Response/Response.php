<?php

namespace App\Data\Response;

class Response
{

    public function __construct()
    {
    }

    public function output()
    {
        echo static::class;
    }
}