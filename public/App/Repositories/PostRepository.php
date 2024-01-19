<?php


namespace App\Repositories;

use App\Database\DatabaseCollection;
use App\Database\Models\PostModel;
use App\Database\Orm;

class PostRepository extends Orm
{
    public function getById(int $id): PostModel
    {
        return new PostModel();
    }
}