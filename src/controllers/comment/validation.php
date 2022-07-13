<?php

namespace Application\Controllers\comment\Validation;

require_once 'src/lib/database.php';
require_once 'src/model/comment.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class ValidationComment
{
    public function execute(string $identifier)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $commentRepository->validationComment($identifier);

        header('Location: index.php?action=dashboard');

    }
}
