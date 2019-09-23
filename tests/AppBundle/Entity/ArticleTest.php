<?php


namespace App\Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Article;
class ArticleTest extends TestCase
{
    public function testSettingsLength()
    {
        $article = new Article();
        //$this->assertIsString('authored');
       $this->getAnnotations();
    }


}