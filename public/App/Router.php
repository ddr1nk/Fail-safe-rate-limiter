<?php

namespace App;

use App\Controllers\AboutController;
use App\Controllers\BaseController;
use App\Controllers\IndexController;
use App\Controllers\PostsController;

class Router
{
    /**
     * @param string $page
     *
     * @return BaseController
     */
    public function getControllerByPage(string $page): BaseController
    {
        return match ($page) {
            'posts' => new PostsController(),
            'about' => new AboutController(),
            default => new IndexController(),
        };
    }
}