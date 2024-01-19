<?php

namespace App\Data\Response;

class JsonResponse extends Response
{
    /**
     * @param array $data
     * @param int $statusCode
     */
    public function __construct(protected array $data = [], protected int $statusCode = 204)
    {
        if ($this->data && $this->statusCode === 204) {
            $this->statusCode = 200;
        }
    }

    /**
     * @return void
     */
    public function output(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($this->statusCode);
        echo json_encode($this->data);
    }
}