<?php

namespace Application\Controllers\Logout;

class Logout
{
    public function execute()
    {
        session_destroy();

        header('Location: index.php?action=login'); 

    }  
}
