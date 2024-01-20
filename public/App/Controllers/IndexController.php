<?php

namespace App\Controllers;

use App\Data\Response\JsonResponse;

class IndexController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction(): JsonResponse
    {
        return new JsonResponse(['Затест']);
    }
}