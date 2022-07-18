<?php
session_start();

require_once('vendor/autoload.php');
require_once('src/controllers/CommentController.php');
require_once('src/controllers/HomepageController.php');
require_once('src/controllers/PostController.php');
require_once('src/controllers/DashboardController.php');
require_once('src/controllers/UserController.php');

use Application\Controllers\PostController;
use Application\Controllers\CommentController;
use Application\Controllers\HomepageController;
use Application\Controllers\DashboardController;
use Application\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

try {
    if (null !== $request->query->get('action') && $request->query->get('action') !== '') {
        if ($request->query->get('action') === 'post') {
            (new PostController())->getPostAction();

        } elseif ($request->query->get('action') === 'addComment') {
            (new CommentController())->addCommentAction();

        } elseif ($request->query->get('action') === 'addPost') {
            (new PostController())->addPostAction();

        } elseif ($request->query->get('action') === 'updatePost') {
            (new PostController())->updatePostAction();

        } elseif ($request->query->get('action') === 'deletePost') {
            (new PostController())->deletePostAction();

        } elseif ($request->query->get('action') === 'listPosts') {
            (new PostController())->getListPostsAction();

        } elseif ($request->query->get('action') === 'dashboard') {
            (new DashboardController())->execute();

        } elseif ($request->query->get('action') === 'inscription') {
            (new UserController())->inscriptionAction();

        } elseif ($_GET['action'] === 'login') {
            (new UserController())->loginAction();  

        } elseif ($request->query->get('action') === 'logout') {
            (new UserController())->logoutAction();
            
        } elseif ($request->query->get('action') === 'validationComment') {
            (new CommentController())->validationCommentAction();

        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new HomepageController())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
