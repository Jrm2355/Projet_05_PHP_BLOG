<?php

namespace Application\Model\Comment;

require_once 'src/lib/database.php';

use Application\Lib\Database\DatabaseConnection;

class Comment
{
    public string $identifier;
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $post;
    public string $status;
}

class CommentRepository
{
    public DatabaseConnection $connection;

    public function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, status, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date, post_id FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = new Comment();
            $comment->identifier = $row['id'];
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->post = $row['post_id'];
            $comment->status = $row['status'];

            $comments[] = $comment;
        }

        return $comments;
    }

    public function getAllComments(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, status, author, comment, post_id, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments ORDER BY post_id"
        );
        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = new Comment();
            $comment->identifier = $row['id'];
            $comment->status = $row['status'];
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->post = $row['post_id'];

            $comments[] = $comment;
        }

        return $comments;
    }


    public function createComment(string $post, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments( post_id, author, comment, status, comment_date) VALUES(?, ?, ?, 0, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }

    public function validationComment(string $identifier): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET status = 1 WHERE id = ?'
        );
        $affectedLines = $statement->execute([$identifier]);

        return ($affectedLines > 0);
    }
}
