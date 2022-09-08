<?php
session_start();

require_once('vendor/autoload.php');

use Application\Controllers\PostController;
use Application\Controllers\CommentController;
use Application\Controllers\HomepageController;
use Application\Controllers\DashboardController;
use Application\Controllers\UserController;
use Application\Controllers\mailController;
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

        } elseif ($request->query->get('action') === 'login') {
            (new UserController())->loginAction();  

        } elseif ($request->query->get('action') === 'logout') {
            (new UserController())->logoutAction();
            
        } elseif ($request->query->get('action') === 'validationComment') {
            (new CommentController())->validationCommentAction();

        } elseif ($request->query->get('action') === 'mailer') {
            (new HomepageController())->mailer();

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
