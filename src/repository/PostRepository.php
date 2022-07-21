<?php

namespace Application\Repository;

use Application\Lib\DatabaseConnection;
use Application\Model\PostModel;


class PostRepository
{
    public function getPost(string $identifier): PostModel
    {
        $statement = DatabaseConnection::getConnection()->prepare(
            "SELECT id, title, chapo, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%imin%ss') AS french_modification_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new PostModel();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->frenchModificationDate = $row['french_modification_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];
        $post->chapo = $row['chapo'];
        $post->author = $row['author'];

        return $post;
    }

    public function getPosts(): array
    {
        $statement = DatabaseConnection::getConnection()->query(
            "SELECT id, title, chapo, content, author,  DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, DATE_FORMAT(modification_date, '%d/%m/%Y à %Hh%imin%ss') AS french_modification_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new PostModel();
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->frenchModificationDate = $row['french_modification_date'];
            $post->content = $row['content'];
            $post->author = $row['author'];
            $post->identifier = $row['id'];
            $post->chapo = $row['chapo'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function createPost(string $title, string $chapo, string $content, string $author): bool
    {
        $statement = DatabaseConnection::getConnection()->prepare(
            'INSERT INTO posts(title, chapo, content, author, creation_date, modification_date) VALUES(?, ?, ?, ?, NOW(), NOW())'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $author]);

        return ($affectedLines > 0);
    }

    public function updatePost(string $identifier, string $title, string $chapo, string $content, string $author): bool
    {
        $statement = DatabaseConnection::getConnection()->prepare(
            'UPDATE posts SET title = ?, chapo = ?, content = ?, author = ?, modification_date = NOW() WHERE id = ?'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $author, $identifier]);
        return ($affectedLines > 0);
    }

    public function deletePost(string $identifier): bool
    {
        $statement = DatabaseConnection::getConnection()->prepare(
            'DELETE FROM posts WHERE id = ?'
        );
        $affectedLines = $statement->execute([$identifier]);
        return ($affectedLines > 0);
    }
}
