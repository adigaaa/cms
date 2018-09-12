<?php
namespace Api\Comments\Repositories;
use Api\Comments\Models\Comment;
class CommentRepository
{
    public function getModel()
    {
        return new Comment;
    }
}
