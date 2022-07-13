<?php

namespace Application\Controllers\Dashboard;

require_once 'src/lib/database.php';
require_once 'src/model/post.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Post\PostRepository;

class Dashboard
{
    public function execute()
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $posts = $postRepository->getPosts();

        include 'templates/dashboard.php';
    }
}
