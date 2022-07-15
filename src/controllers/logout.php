<?php

namespace Application\Controllers;

class Logout
{
    public function execute()
    {
        session_destroy();

        header('Location: index.php?action=login'); 

    }  
}
