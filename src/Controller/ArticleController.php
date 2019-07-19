<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;

class ArticleController extends AbstractController
{
    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homePage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{slug}/", name="article_show")
     */
    public function show(Article $article, SlackClient $slack)
    {
        if ($article->getSlug() === 'slack') {
            $slack->sendMessage('New Ghost', 'Grrrrr...');
        }

        $comments = [
            'First',
            'Second',
            'Third'
        ];


        return $this->render('article/show.html.twig',[
            'article' => $article,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/article/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }
}