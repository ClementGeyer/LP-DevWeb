<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Work;
use App\Entity\UserLikedPosts;
use App\Form\UploadType;
use App\Form\UserType;
use App\Service\ServiceWork;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('default/index.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/modidier", name="app_modify_user")
     */
    public function modifyUser(Request $request, ServiceWork $serviceWork): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $serviceWork->save($user);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('default/modifyUser.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/upload", name="app_upload")
     */
    public function upload(Request $request, ServiceWork $serviceWork): Response
    {
        $work = new Work();
        $user = $this->getUser();

        $form = $this->createForm(UploadType::class, $work);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $work->setFile($request->files->get('upload')['file']);
            $work->setOwner($user);
            $work->setLikeCount(0);

            $serviceWork->save($work);
            return $this->redirectToRoute('app_works');
        }
        

        return $this->render('default/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/work/{id}", name="app_work")
     */
    public function displayWork(Work $work): Response
    {
        return $this->render('default/work.html.twig', [
            'work' => $work,
        ]);
    }

    /**
     * @Route("/works", name="app_works")
     */
    public function displayWorks(): Response
    {
        $userWorks = $this->getUser()->getWorks();

        return $this->render('default/works.html.twig', [
            'works' => $userWorks,
        ]);
    }

    /**
     * @Route("/all-works", name="app_all_works")
     */
    public function displayAllWorks(Request $request): Response
    {
        $allWorks = $this->getDoctrine()->getRepository(Work::class)->findAll();
        $allCategories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $user = $this->getUser();
        $likedPosts = $this->getDoctrine()->getRepository(UserLikedPosts::class)->findBy(['user' => $user]);
        $filtre = $request->query->get('filtre');
        $category = $request->query->get('category');

        return $this->render('default/allWorks.html.twig', [
            'allWorks' => $allWorks,
            'likedPosts' => $likedPosts,
            'filtre' => $filtre,
            'allCategories' => $allCategories,
            'category' => $category
        ]);
    }

    /**
     * @Route("/all-works/find", name="app_all_foundWorks")
     */
    public function displayFoundWorks(Request $request): Response
    {
        $filtre = json_decode($request->getContent(), true);

        return $this->redirectToRoute('app_all_works', ['filtre' => $filtre]);
    }

    /**
     * @Route("/all-works/findc", name="app_all_foundWorksByCategory")
     */
    public function displayFoundWorksByCategory(Request $request): Response
    {
        $filtre = json_decode($request->getContent(), true);
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['name' => $filtre]);

        return $this->redirectToRoute('app_all_works', ['category' => $category]);
    }

    /**
     * @Route("/top", name="app_top")
     */
    public function displayTop(): Response
    {
        $user = $this->getUser();
        $likedPosts = $this->getDoctrine()->getRepository(UserLikedPosts::class)->findBy(['user' => $user]);
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $works = [];
        foreach ($categories as $category) {
            $work = $this->getDoctrine()->getRepository(Work::class)->findTop($category->getName());
            array_push($work, $category);
            array_push($works, $work);
        }

        return $this->render('default/topWorks.html.twig', [
            'allWorks' => $works,
            'likedPosts' => $likedPosts
        ]);
    }

    /**
     * @Route("/like-post/{id}", name="app_like_post")
     */
    public function likePost(Work $work, ServiceWork $serviceWork)
    {
        $user = $this->getUser();

        $work->addLikeCount();

        $userlikedpost = new UserLikedPosts();
        $userlikedpost->setPost($work);
        $userlikedpost->setUser($user);
        $user->addUserLikedPost($userlikedpost);
        $work->addUserLikedPost($userlikedpost);
        $serviceWork->save($userlikedpost);

        return $this->redirectToRoute('app_all_works');
    }
}
