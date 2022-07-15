<?php
session_start();

require_once('vendor/autoload.php');
require_once('src/controllers/CommentController.php');
require_once('src/controllers/HomepageController.php');
require_once('src/controllers/PostController.php');
require_once('src/controllers/DashboardController.php');
require_once('src/controllers/inscriptionController.php');
require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');

use Application\Controllers\PostController;
use Application\Controllers\CommentController;
use Application\Controllers\HomepageController;
use Application\Controllers\DashboardController;
use Application\Controllers\Inscription\Inscription;
use Application\Controllers\Login;
use Application\Controllers\Logout;


try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new PostController())->getPostAction($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new CommentController())->addCommentAction($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] === 'addPost') {
            (new PostController())->addPostAction($_POST);

        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                (new PostController())->updatePostAction($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }

        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new PostController())->deletePostAction($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] === 'listPosts') {
            (new PostController())->getListPostsAction();

        } elseif ($_GET['action'] === 'dashboard') {
            (new DashboardController())->execute();

        } elseif ($_GET['action'] === 'inscription') {
            (new Inscription())->execute($_POST);

        } elseif ($_GET['action'] === 'login') {
            (new Login())->execute($_POST);  

        } elseif ($_GET['action'] === 'logout') {
            (new Logout())->execute();
            
        } elseif ($_GET['action'] === 'validationComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new CommentController())->validationCommentAction($identifier);
            }
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
