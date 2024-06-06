<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Commentaires;
class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker=\Faker\Factory::create('fr_FR');
        for($i=1;$i<=3;$i++){
          $category=new Category();
          $category->setTitle($faker->sentence())
                  ->setDescription($faker->paragraph());
          $manager->persist($category);

          for($j=1;$j<=mt_rand(4,6);$j++){
            $article=new Article();
            $cont='<p>' . join($faker->paragraphs(5), '</p><p>') .'</p>';

            $article->setTitle($faker->sentence())
                    ->setContent($cont)
                    ->setImage($faker->imageUrl())
                    ->setCreateAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);
                    $manager->persist($article);


                    for($l=1;$l<=mt_rand(4,6);$l++){
                      $comment= new Commentaires();

                      $content='<p>' . join($faker->paragraphs(2), '</p><p>') .'</p>';
                      $days=(new \DateTime())->diff($article->getCreateAt())->days;
                      $comment->setAuthor($faker->name)
                              ->setContent($content)
                              ->setArticle($article);
                              $manager->persist($comment);
                            }
                          }
                        }
                        $manager->flush();
                      }
                    }
