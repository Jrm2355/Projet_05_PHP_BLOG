<?php
session_start();

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/dashboard.php');

use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;
use Application\Controllers\Post\ListPosts;
use Application\Controllers\Post\AddPost;
use Application\Controllers\Post\UpdatePost;
use Application\Controllers\Post\DeletePost;
use Application\Controllers\Dashboard\Dashboard;


try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new AddComment())->execute($identifier, $_POST);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] === 'addPost') {
            (new AddPost())->execute($_POST);

        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                (new UpdatePost())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }

        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new DeletePost())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] === 'listPosts') {
            (new ListPosts())->execute();

        } elseif ($_GET['action'] === 'dashboard') {
            (new Dashboard())->execute();

        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
