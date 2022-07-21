<?php

namespace Application\Controllers;

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
                $user = $userRepository->getUser($email, $mdp);
                if ($user->identifier) {
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
