<?php


namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage(){
        return new Response("My first Symfony page!");
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug){
        $comments = [
            "This is a comment",
            "This is a second comment",
            "This is a third comment"
        ];
        return $this->render('article/show.html.twig', [
            'title' =>ucwords(str_replace('-', ' ', $slug)),
            'comments'=>$comments
        ]);
    }
}