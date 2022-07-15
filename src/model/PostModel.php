<?php

namespace Application\Model;

require_once 'src/lib/database.php';

use Application\Lib\Database\DatabaseConnection;

class Post
{   
    public string $identifier;
    public string $title;
    public string $chapo;    
    public string $content; 
    public string $author;  
    public string $frenchCreationDate;
    public string $frenchModificationDate;
    
}
