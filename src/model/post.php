<?php

namespace Application\Model\Post;

require_once 'src/lib/database.php';

use Application\Lib\Database\DatabaseConnection;

class Post
{
    public string $title;
    public string $frenchCreationDate;
    public string $content;
    public string $identifier;
    public string $chapo;
}

class PostRepository
{
    public DatabaseConnection $connection;

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, chapo, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];
        $post->chapo = $row['chapo'];

        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, chapo, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['id'];
            $post->chapo = $row['chapo'];

            $posts[] = $post;
        }

        return $posts;
    }

    public function createPost(string $title, string $chapo, string $content): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO posts(title, chapo, content, creation_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content]);

        return ($affectedLines > 0);
    }

    public function updatePost(string $identifier, string $title, string $chapo, string $content): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts SET title = ?, chapo = ?, content = ? WHERE id = ?'
        );
        $affectedLines = $statement->execute([$title, $chapo, $content, $identifier]);
        return ($affectedLines > 0);
    }

    public function deletePost(string $identifier): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM posts WHERE id = ?'
        );
        $affectedLines = $statement->execute([$identifier]);
        return ($affectedLines > 0);
    }
}
