<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Work;
use App\Entity\FileType;
use App\Entity\UserLikedPosts;
use App\Form\UploadType;
use App\Service\ServiceWork;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => 1]);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
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

            $serviceWork->save($work);
        }
        

        return $this->render('default/upload.html.twig', [
            'form' => $form->createView(),
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
    public function displayAllWorks(): Response
    {
        $allWorks = $this->getDoctrine()->getRepository(Work::class)->findAll();
        $user = $this->getUser();
        $likedPosts = $this->getDoctrine()->getRepository(UserLikedPosts::class)->findBy(['user' => $user]);

        return $this->render('default/allWorks.html.twig', [
            'allWorks' => $allWorks,
            'likedPosts' => $likedPosts,
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
