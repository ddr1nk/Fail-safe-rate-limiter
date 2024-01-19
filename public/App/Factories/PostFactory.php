<?php

namespace App\Factories;

use App\Services\PostService;
use App\Services\PostServiceInterface;

class PostFactory
{
    public function createPostService(): PostServiceInterface
    {
        return new PostService();
    }
}