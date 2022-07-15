<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/repository/UserRepository.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\UserRepository;

class Login
{
    public function execute(array $input)
    {
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
}
