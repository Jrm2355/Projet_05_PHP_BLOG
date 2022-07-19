<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/repository/UserRepository.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class UserController
{
    public function inscriptionAction()
    {
        $request = Request::createFromGlobals();
        $input = $request->request->all();
        // It handles the form submission when there is an input.
        if ($input !== null) {
            $email = null;
            $mdp = null;
            $username = null;
            if (!empty($input['email']) && !empty($input['mdp']) && !empty($input['username'])) {
                $email = $input['email'];
                $mdp = $input['mdp'];
                $username = $input['username'];

                $userRepository = new UserRepository();
                $userRepository->connection = new DatabaseConnection();
                $success = $userRepository->createUser($username, $email, $mdp);
                header('Location: index.php?action=login');
            } 
            include 'templates/inscription.php';
        }
           
    }

    public function loginAction()
    {
        $request = Request::createFromGlobals();
        $input = $request->request->all();
        // It handles the form submission when there is an input.
        if ($input !== null) {
            $email = null;
            $mdp = null;
            if (!empty($input['email']) && !empty($input['mdp'])) {
                $email = $input['email'];
                $mdp = $input['mdp'];
            
                $userRepository = new UserRepository();
                $userRepository->connection = new DatabaseConnection();
                $user = $userRepository->getUser($email, $mdp);
                if ($user->identifier) {
                    //  $session = $session->requestStack->getSession();
                    // $session->set('logged', 1);
                    // $session->set('name' , $user->username);
                    // $session->set('name' , $user->identifier);
                    $_SESSION['logged']=1;
                    $_SESSION['name']= $user->username;
                    $_SESSION['loggedId'] = $user->identifier;
                    header('Location: index.php?action=dashboard');
                } else {
                    $Error_message = "Les identifiants ne sont pas corrects";
                }

            }
            include 'templates/login.php';
        }
    }

    public function logoutAction()
    {
        session_destroy();

        header('Location: index.php?action=login'); 

    }  

}
