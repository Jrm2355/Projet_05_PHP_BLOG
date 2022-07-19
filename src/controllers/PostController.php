<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/repository/PostRepository.php';
require_once 'src/repository/CommentRepository.php';
require_once 'src/repository/UserRepository.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\CommentRepository;
use Application\Repository\PostRepository;
use Application\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController
{
    public function getPostAction()
    {
        $request = Request::createFromGlobals();
        if ( null !== $request->query->get('action') && (null !== $request->query->get('id')) > 0) {
            $identifier = $request->query->get('id');
            $connection = new DatabaseConnection();

            $postRepository = new PostRepository();
            $postRepository->connection = $connection;
            $post = $postRepository->getPost($identifier);

            $commentRepository = new CommentRepository();
            $commentRepository->connection = $connection;
            $comments = $commentRepository->getComments($identifier);

            $userId = $post->author;
            $userRepository = new UserRepository();
            $userRepository->connection = $connection;
            $user = $userRepository->getUserWithId((string)$userId);
            
            include 'templates/post.php';
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
        
    }

    public function getListPostsAction()
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $posts = $postRepository->getPosts();

        include 'templates/list_posts.php';
    }

    public function addPostAction()
    {
        $request = Request::createFromGlobals();
        $input = $request->request->all();
        /*$response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );*/
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
                    $author = $_SESSION['loggedId'];

                    $postRepository = new PostRepository();
                    $postRepository->connection = new DatabaseConnection();
                    $success = $postRepository->createPost($title, $chapo, $content, $author);
                    header('Location: index.php?action=dashboard');

                    /* $response->prepare($request);
                    $response->send(); */
                
                }
            }
                include 'templates/add_post.php';
        } else {
            header('Location: index.php?action=login');
        }
    }

    public function updatePostAction()
    {
        $request = Request::createFromGlobals();
        if (null !== $request->query->get('id') && $request->query->get('id') > 0) {
            $identifier = $request->query->get('id');
            // It sets the input only when the HTTP method is POST (ie. the form is submitted).
            $input = null;
            if ($request->server->get('REQUEST_METHOD') === 'POST') {
                $input = $request->request->all();
            }
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
                        $author = $_SESSION['loggedId'];
                    } else {
                        throw new \Exception('Les données du formulaire sont invalides.');
                    }
    
                    $postRepository = new PostRepository();
                    $postRepository->connection = new DatabaseConnection();
                    $postRepository->updatePost($identifier, $title, $chapo, $content, $author);
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
    }

    public function deletePostAction()
    {
        $request = Request::createFromGlobals();
        if (null !== $request->query->get('id') && $request->query->get('id') > 0){
            $identifier = $request->query->get('id');
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
}
