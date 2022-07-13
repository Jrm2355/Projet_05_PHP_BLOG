<?php
session_start();


require_once('src/controllers/homepage.php');

use Application\Controllers\Homepage\Homepage;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
