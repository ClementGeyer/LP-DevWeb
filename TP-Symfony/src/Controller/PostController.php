<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\PostCategory;

class PostController extends AbstractController
{
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

        $this->addFlash(
            'message',
            'Catégorie crée'
        );

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

        $category = $this->getDoctrine()->getRepository(PostCategory::class)->findOneBy(['id' => 1]);
        $post->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        $this->addFlash(
            'message',
            'Post crée'
        );

        return $this->render('home.html.twig');
    }

    /**
     * @Route("/delete-post", name="app_delete_post")
     */
    public function deletePost(): Response
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['title' => 'Post 1']);

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash(
            'message',
            'Post supprimé'
        );

        return $this->render('home.html.twig');
    }

    /**
     * @Route("/post/view", name="app_view_post")
     */
    public function viewPosts(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll(['id' => 'ASC']);
        $categories = $this->getDoctrine()->getRepository(PostCategory::class)->findAll(['id' => 'ASC']);

        return $this->render('viewPosts.html.twig', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }
}