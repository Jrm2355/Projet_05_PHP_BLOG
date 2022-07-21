<?php

namespace Application\Model;

use Application\Lib\DatabaseConnection;

class CommentModel
{
    public string $identifier;
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $post;
    public string $status;
}
