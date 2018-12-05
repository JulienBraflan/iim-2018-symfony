<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Contact;



class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("blog/about", name="about")
     */
    public function about() {
        return $this->render('blog/about.html.twig');
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog{id}/edit", name="blog_edit")
     */
    public function form(Article $article = null, Request $request, ObjectManager $manager) {

        if(!$article) {
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' =>$article->getId() !== null
        ]);
    }

    /**
     * @Route("blog/delete/{id}", name="blog_delete")
     */
    public function delete(int $id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($article);
        $manager->flush();

        return $this->redirectToRoute('blog');
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article){

        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/contact", name="blog_contact")
     */
    public function contact() {

        return $this->render('blog/contact.html.twig');
    }

}
