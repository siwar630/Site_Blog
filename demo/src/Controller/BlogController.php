<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Entity\Commentaires;

class BlogController extends AbstractController
{

    /**
     * @Route("/blog", name="blog")
     */
    public function index(): Response
    {
      $repo=$this->getDoctrine()->getRepository(Article::class);
      $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/blog/new", name="blog_create")
     */
     public function new( Request $request){
       $manager = $this->getDoctrine()->getManager();
       $article=new Article();
       $form=$this->createForm(ArticleType::class, $article);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $article->setCreateAt(new \DateTime());
        $manager->persist($article);
        $manager->flush();
        return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
     }

     return $this->render('blog/create.html.twig', [
       'formArticle' =>$form->createView(),
       'editMode' =>false
     ]);

   }
    /**
     * @Route("/blog/{id}/edit", name="blog_edit",requirements={"id":"\d+"})
     */
     public function edit(Article $article, Request $request){
       $manager = $this->getDoctrine()->getManager();
       $form=$this->createForm(ArticleType::class, $article);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $article->setCreateAt(new \DateTime());
        $manager->persist($article);
        $manager->flush();

        return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);

      }
      return $this->render('blog/create.html.twig', [
        'formArticle' =>$form->createView(),
        'editMode' => true
      ]);
    }
    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article= null,Request $request){
      $manager = $this->getDoctrine()->getManager();
      $comment=new Commentaires();
      $form=$this->createForm(CommentType::class,$comment);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $comment->setArticle($article);
        $manager->persist($comment);
        $manager->flush();
        return $this->redirectToRoute('blog_show', ['id'=>$article->getId()]);
      }
      return $this->render('blog/show.html.twig' ,[
        'article'=>$article,
        'commentForm'=>$form->createView()
      ]);
    }

}
