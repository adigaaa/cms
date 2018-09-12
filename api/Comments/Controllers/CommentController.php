<?php

namespace Api\Comments\Controllers;

use Api\BaseController;
use Api\Comments\Services\CommentService;

class CommentController extends BaseController
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
}
