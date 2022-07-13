<?php

namespace Application\Controllers\Post;

require_once 'src/lib/database.php';
require_once 'src/model/comment.php';
require_once 'src/model/post.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;
use Application\Model\Post\PostRepository;

class Post
{
    public function execute(string $identifier)
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $post = $postRepository->getPost($identifier);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = $connection;
        $comments = $commentRepository->getComments($identifier);

        include 'templates/post.php';
    }
}

class ListPosts
{
    public function execute()
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $posts = $postRepository->getPosts();

        include 'templates/list_posts.php';
    }
}

class AddPost
{
    public function execute(array $input)
    {
        // It handles the form submission when there is an input.
        if ($input !== null) {
            $title = null;
            $chapo = null;
            $content = null;
            if (!empty($input['title']) && !empty($input['chapo']) && !empty($input['content'])) {
                $title = $input['title'];
                $chapo = $input['chapo'];
                $content = $input['content'];

                $postRepository = new PostRepository();
                $postRepository->connection = new DatabaseConnection();
                $success = $postRepository->createPost($title, $chapo, $content);
                header('Location: index.php?action=dashboard');
            }
        }
            include 'templates/add_post.php';
    }
}


class DeletePost
{
    public function execute(string $identifier)
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $success = $postRepository->deletePost($identifier);
        if (!$success) {
            throw new \Exception('Impossible de supprimer l\'article !');
        } else {
            header('Location: index.php?action=dashboard');
        }
    }
}

class UpdatePost
{
    public function execute(string $identifier, ?array $input)
    {
        // It handles the form submission when there is an input.
        if ($input !== null) {
            $title = null;
            $chapo = null;
            $content = null;
            if (!empty($input['title'])&& !empty($input['chapo']) && !empty($input['content'])) {
                $title = $input['title'];
                $chapo = $input['chapo'];
                $content = $input['content'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $postRepository->updatePost($identifier, $title, $chapo, $content);
            header('Location: index.php?action=post&id=' . $identifier);
            
        }

        // Otherwise, it displays the form.
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);
        if ($post === null) {
            throw new \Exception("Le contentaire $identifier n'existe pas.");
        }

        include 'templates/update_post.php';
    }
}