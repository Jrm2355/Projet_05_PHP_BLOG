<?php

namespace Application\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\UserModel;



class UserRepository
{
    public function createUser(string $username, string $email, string $mdp): bool
    {
        $statement = DatabaseConnection::getConnection()->prepare(
            'INSERT INTO users(username, email, mdp) VALUES(?, ?, MD5(?))'
        );
        $affectedLines = $statement->execute([$username, $email, $mdp]);

        return ($affectedLines > 0);
    }

   /* public function getUsers(): array
    {
        $statement = DatabaseConnection::getConnection()->query(
            "SELECT * FROM users"
        );
        $users = [];
        while (($row = $statement->fetch())) {
            $user = new UserModel();
            $user->email = $row['email'];
            $user->mdp = $row['mdp'];
            $user->identifier = $row['id'];
            $user->username = $row['username'];

            $users[] = $user;
        }

        return $users;
    }*/

    public function getUser(string $email, string $mdp)
    {   
        $statement = DatabaseConnection::getConnection()->prepare(
            "SELECT * FROM users WHERE email = ? and mdp = MD5(?)"
        );
        $statement->execute([$email, $mdp]);

        $row = $statement->fetch();
        $user = new UserModel();
        if(isset($row['id'])) {
            $user->identifier = $row['id'];
            $user->email = $row['email'];
            $user->username = $row['username'];
        }
        return $user;        
    }

    public function getUserWithId(string $identifier)
    {   
        $statement = DatabaseConnection::getConnection()->prepare(
            "SELECT * FROM users WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $user = new UserModel();
        $user->identifier = $row['id'];
        $user->email = $row['email'];
        $user->username = $row['username'];
        return $user;        
    }
}
