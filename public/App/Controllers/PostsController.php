<?php


namespace App\Controllers;

use App\Data\Response\JsonResponse;

class PostsController extends BaseController
{
    public function addLikeAction(): JsonResponse
    {
        return new JsonResponse();
    }
}