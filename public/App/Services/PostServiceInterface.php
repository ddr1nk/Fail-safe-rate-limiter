<?php

namespace App\Services;

use App\Exceptions\PostNotFoundException;
use App\Exceptions\UserNotFoundException;

interface PostServiceInterface
{

    /**
     * @param int $postId
     * @param int $userId
     *
     * @throws UserNotFoundException
     * @throws PostNotFoundException
     *
     * @return void
     */
    public function addLike(int $postId, int $userId): void;
}