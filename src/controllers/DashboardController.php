<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/model/PostModel.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\PostRepository;
use Application\Repository\CommentRepository;

class DashboardController
{
    public function execute()
    {
        if(isset($_SESSION['logged'])){
            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $posts = $postRepository->getPosts();

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();
            $comments = $commentRepository->getAllComments();

            include 'templates/dashboard.php';
        } else {
            header('Location: index.php?action=login');
        }
    }
}
