<?php


namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(){
        return $this->render('article/homepage.html.twig', [
            'title'=>ucwords('home page')
        ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug){
        $comments = [
            ["text"=>"This is a comment", "author"=>"William Gay", "time"=>"30 minutes ago", "avatar"=>"https://bootdey.com/img/Content/user_1.jpg"],
            ["text"=>"This is a second comment", "author"=>"Tammy Montgomery", "time"=>"28 minutes ago", "avatar"=>"https://bootdey.com/img/Content/user_2.jpg"],
            ["text"=>"This is a third comment", "author"=>"John Doe", "time"=>"45 minutes ago", "avatar"=>"https://bootdey.com/img/Content/user_3.jpg"]
        ];
        return $this->render('article/show.html.twig', [
            'title' =>ucwords(str_replace('-', ' ', $slug)),
            'comments'=>$comments
        ]);
    }
}