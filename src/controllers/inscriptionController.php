<?php

namespace Application\Controllers;

require_once 'src/lib/database.php';
require_once 'src/model/UserModel.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Repository\UserRepository;

class InscriptionController
{
    public function inscriptionAction(array $input)
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
   


    

