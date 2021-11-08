<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Work;
use App\Form\UploadType;

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
    public function upload(Request $request): Response
    {
        $work = new Work();

        $form = $this->createForm(UploadType::class, $work);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            // Manque le user
            $work->setDescription($request->request->get('upload')['description']);
            $work->setTitle($request->request->get('upload')['title']);
            $work->setFile($request->files->get('upload'));
            $work->setType($request->request->get('upload')['type']);
            // Sauvegarder work
        }
        

        return $this->render('default/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
