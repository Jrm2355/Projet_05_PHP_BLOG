<?php

namespace Application\Controllers\Dashboard;

require_once 'src/lib/database.php';
require_once 'src/model/post.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Post\PostRepository;
use Application\Model\Comment\CommentRepository;

class Dashboard
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
