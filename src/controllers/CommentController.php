<?php

namespace Application\Controllers;

use Application\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;

class CommentController
{
    public function addCommentAction()
    {
        $request = Request::createFromGlobals();
        if(null !== $request->query->get('id') && $request->query->get('id') > 0){
            $identifier = $request->query->get('id');
            $author = null;
            $comment = null;
            $input = $request->request->all();
            if (!empty($input['author']) && !empty($input['comment'])) {
                $author = $input['author'];
                $comment = $input['comment'];
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }
            $commentRepository = new CommentRepository();
            $success = $commentRepository->createComment($identifier, $author, $comment);

            header('Location: index.php?action=post&id=' . $identifier);
        }     
    }

    public function validationCommentAction()
    {
        $request = Request::createFromGlobals();
        if(null !== $request->query->get('id') && $request->query->get('id') > 0){
            $identifier = $request->query->get('id');
            if(isset($_SESSION['logged'])){
                $commentRepository = new CommentRepository();
                $commentRepository->validationComment($identifier);

                header('Location: index.php?action=dashboard');
            } else {
                header('Location: index.php?action=login');
            }
        }
    }
}
