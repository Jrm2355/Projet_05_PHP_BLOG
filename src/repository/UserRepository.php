<?php

namespace Application\Repository;

require_once 'src/lib/database.php';
require_once 'src/model/UserModel.php';

use Application\Lib\Database\DatabaseConnection;
use Application\model\User;



class UserRepository
{
    public DatabaseConnection $connection;

    public function createUser(string $username, string $email, string $mdp): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO users(username, email, mdp) VALUES(?, ?, MD5(?))'
        );
        $affectedLines = $statement->execute([$username, $email, $mdp]);

        return ($affectedLines > 0);
    }

    public function getUsers(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM users"
        );
        $users = [];
        while (($row = $statement->fetch())) {
            $user = new User();
            $user->email = $row['email'];
            $user->mdp = $row['mdp'];
            $user->identifier = $row['id'];
            $user->username = $row['username'];

            $users[] = $user;
        }

        return $users;
    }

    public function getUser(string $email, string $mdp)
    {   
        $statement = $this->connection->getConnection()->prepare(
            "SELECT * FROM users WHERE email = ? and mdp = MD5(?)"
        );
        $statement->execute([$email, $mdp]);

        $row = $statement->fetch();
        $user = new User();
        if(isset($row['id'])) {
            $user->identifier = $row['id'];
            $user->email = $row['email'];
            $user->username = $row['username'];
        }
        return $user;        
    }
}
