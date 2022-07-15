<?php

namespace Application\Model;

require_once 'src/lib/database.php';

use Application\Lib\Database\DatabaseConnection;

class User
{
    public string $identifier;
    public string $username;
    public string $email;
    public string $mdp;

}