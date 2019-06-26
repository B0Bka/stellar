<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homePage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/article/{id}/", name="article_show")
     */
    public function show($id)
    {
        $comments = [
            'First',
            'Second',
            'Third'
        ];
        return $this->render('article/show.html.twig',[
            'title' => ucwords(str_replace('-', ' ', $id)),
            'comments' => $comments
        ]);
    }
}