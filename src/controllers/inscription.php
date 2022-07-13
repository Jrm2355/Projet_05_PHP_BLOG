<?php

namespace Application\Controllers\Inscription;

require_once 'src/lib/database.php';
require_once 'src/model/user.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\UserRepository;

class Inscription
{
    public function execute(array $input)
    {
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
}
   


    

