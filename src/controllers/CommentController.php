<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/repository/CommentRepository.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\CommentRepository;

class CommentController
{
    public function addCommentAction(string $post, array $input)
    {
        $author = null;
        $comment = null;
        if (!empty($input['author']) && !empty($input['comment'])) {
            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($post, $author, $comment);

        header('Location: index.php?action=post&id=' . $post);        
    }

    public function validationCommentAction(string $identifier)
    {
        if(isset($_SESSION['logged'])){
            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();
            $commentRepository->validationComment($identifier);

            header('Location: index.php?action=dashboard');
        } else {
            header('Location: index.php?action=login');
        }
    }
}
