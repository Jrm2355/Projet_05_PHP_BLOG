<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/repository/PostRepository.php';
require_once 'src/repository/CommentRepository.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\CommentRepository;
use Application\Repository\PostRepository;

class PostController
{
    public function getPostAction(string $identifier)
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

    public function getListPostsAction()
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $posts = $postRepository->getPosts();

        include 'templates/list_posts.php';
    }

    public function addPostAction(array $input)
    {
        if(isset($_SESSION['logged'])){
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
        } else {
            header('Location: index.php?action=login');
        }
    }

    public function updatePostAction(string $identifier, ?array $input)
    {
        if(isset($_SESSION['logged'])){
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
        } else {
            header('Location: index.php?action=login');
        }

        include 'templates/update_post.php';
    }

    public function deletePostAction(string $identifier)
    {
        if(isset($_SESSION['logged'])){
            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $success = $postRepository->deletePost($identifier);
            if (!$success) {
                throw new \Exception('Impossible de supprimer l\'article !');
            } else {
                header('Location: index.php?action=dashboard');
            }
        } else {
            header('Location: index.php?action=login');
        }
    }
}