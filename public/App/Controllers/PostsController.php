<?php


namespace App\Controllers;

use App\Data\Response\JsonResponse;
use App\Exceptions\PostNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Factories\PostFactory;
use Monolog\Logger;

class PostsController extends BaseController
{
    protected PostFactory $postFactory;

    protected Logger $logger;

    public function __construct()
    {
        $this->postFactory = new PostFactory();
        $this->logger = new Logger(static::class);
    }

    public function addLikeAction(int $postId, int $userId): JsonResponse
    {
        try {
            $this->postFactory->createPostService()->addLike(
                postId: $postId,
                userId: $userId,
            );
        } catch (UserNotFoundException|PostNotFoundException $exception) {
            $this->logger->error($exception->getMessage(), [
                'postId' => $postId,
                'userId' => $userId,
            ]);
        }
        return new JsonResponse(['d' => 'ВСе круто']);
    }
}