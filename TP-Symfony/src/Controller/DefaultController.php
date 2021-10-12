<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostCategory;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/create-category", name="app_create_category")
     */
    public function createCategory(): Response
    {
        $category = new PostCategory();
        $category->setTitle('Catégorie 1');

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return $this->render('home.html.twig');
    }

    /**
     * @Route("/create-post", name="app_create_post")
     */
    public function createPost(): Response
    {
        $post = new Post();
        $post->setTitle('Post 1');
        $post->setEnable(true);
        $post->setContent('Lorem ipsum');
        $post->setDateCreated(new Datetime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->render('home.html.twig');
    }

    /**
     * @Route("/post/view", name="app_view_post")
     */
    public function viewPosts(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(PostCategory::class)->findAll();

        return $this->render('viewPosts.html.twig', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

}
