<?php

namespace Application\Controllers;

use Application\Repository\PostRepository;
use Application\Repository\CommentRepository;

class DashboardController
{
    public function execute()
    {
        if(isset($_SESSION['logged'])){
            $postRepository = new PostRepository();
            $posts = $postRepository->getPosts();

            $commentRepository = new CommentRepository();
            $comments = $commentRepository->getAllComments();

            include 'templates/dashboard.php';
        } else {
            header('Location: index.php?action=login');
        }
    }
}
