<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function homePage()
    {
        return new Response('Let start!');
    }

    /**
     * @Route("/article/{id}/")
     */
    public function show($id)
    {
        return new Response(sprintf('I am showing article № %s to you.', $id));
    }
}