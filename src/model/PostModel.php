<?php

namespace Application\Model;

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

