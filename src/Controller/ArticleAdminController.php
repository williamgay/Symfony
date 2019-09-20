<?php


namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em){
        $article = new Article();
        $article->setTitle("This is the first Article");
        $article->setSlug("this-is-the-first-article");
        $article->setUser_id(1);
        $article->setContent(
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
         Et netus et malesuada fames ac. Dignissim sodales ut eu sem integer vitae. Convallis convallis tellus id interdum velit laoreet id donec. 
         Aenean euismod elementum nisi quis eleifend quam adipiscing vitae. In est ante in nibh mauris cursus. Cras adipiscing enim eu turpis egestas pretium aenean. 
         Risus sed vulputate odio ut. In nulla posuere sollicitudin aliquam ultrices. Fames ac turpis egestas integer. Ut consequat semper viverra nam libero justo laoreet.
          Sit amet luctus venenatis lectus magna fringilla urna. Orci dapibus ultrices in iaculis nunc. Dignissim cras tincidunt lobortis feugiat. Cras tincidunt lobortis feugiat vivamus at. 
          Sagittis purus sit amet volutpat consequat mauris nunc congue nisi. Nulla malesuada pellentesque elit eget gravida cum sociis. Quam pellentesque nec nam aliquam sem. 
          Neque sodales ut etiam sit amet nisl purus in mollis. Scelerisque viverra mauris in aliquam.
          Sit amet nisl suscipit adipiscing bibendum est. Ornare lectus sit amet est placerat in egestas erat imperdiet. Morbi blandit cursus risus at. 
          Arcu dui vivamus arcu felis bibendum ut tristique. In massa tempor nec feugiat nisl. Quis ipsum suspendisse ultrices gravida dictum fusce. 
          Molestie nunc non blandit massa enim nec dui nunc mattis. Odio ut sem nulla pharetra diam sit amet nisl. Amet consectetur adipiscing elit ut aliquam purus.
          Leo a diam sollicitudin tempor id eu nisl nunc."
        );

        // publish most articles
        if (rand(1, 10) > 2) {
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        }
        $em->persist($article);
        $em->flush();
        return new Response(sprintf(
            'Hiya! New Article id: #%d slug: %s',
            $article->getId(),
            $article->getSlug()
        ));

    }
}