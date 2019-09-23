<?php


namespace App\Controller;



use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(EntityManagerInterface $em){
        $repository=$em->getRepository(Article::class);
        $articles = $repository->findBy(
            array(),
            array('featured' => 'DESC'));
    // dump($articles);die;
        return $this->render('article/homepage.html.twig', [
            'title'=>ucwords('home page'),
            'articles'=>$articles,
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @param $slug
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show($slug, MarkdownHelper $markdownHelper, UserRepository $userRepository, EntityManagerInterface  $em){
        $comments = [
            ["text"=>"This is a comment", "author"=>"William Gay", "time"=>"30 minutes ago", "avatar"=>"https://bootdey.com/img/Content/user_1.jpg"],
            ["text"=>"This is a second comment", "author"=>"Tammy Montgomery", "time"=>"28 minutes ago", "avatar"=>"https://bootdey.com/img/Content/user_2.jpg"],
            ["text"=>"This is a third comment", "author"=>"John Doe", "time"=>"45 minutes ago", "avatar"=>"https://bootdey.com/img/Content/user_3.jpg"]
        ];


//        $item = $cache->getItem('markdown_'.md5($articleContent));
//        if(!$item->isHit()){
//            $item->set($markdown->transform($articleContent));
//            $cache->save($item);
//
//        }
//        $articleContent=$item->get();
       // $article = $markdown->transform($article);
        $repository = $em->getRepository(Article::class);
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }

       // $article->comments = $commentRepository->findBy(['article'=>$article]);
//        $comments = $article->getComments();
//        foreach ($comments as $comment){
//            dump($comment);
//        }
      //  $user = $article->getUser();
     // dump($user->name);die;
//        $user =$userRepository->findBy(['user'=>1]);
//        dump($article->user
//        );die;
        $article->content = $markdownHelper->parse($article->content);
        return $this->render('article/show.html.twig', [
            //'title' =>ucwords(str_replace('-', ' ', $slug)),
            //'comments'=>$comments,
           'article'=>$article,
            //'slug'=>$slug,
        ]);
    }
    /**
     * @Route("/news/{slug}/like", name="article_like", methods={"POST"})
     */
    public function toggleArticleLikes(Article $article, EntityManagerInterface $em){
       // $article->incrementLikeCount();
        $article->setLikeCount($article->getLikeCount() +1);
        $em->flush();
         return new JsonResponse(['likes' => $article->getLikeCount()]);
    }
}