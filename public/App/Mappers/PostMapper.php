<?php

namespace App\Mappers;

use App\Database\Models\PostModel;

class PostMapper
{
    public function mapDbObjectToModel(): PostModel
    {
        return new PostModel();
    }
}