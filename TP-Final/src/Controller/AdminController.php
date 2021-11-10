<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Work;
use App\Entity\Category;
use App\Entity\UserLikedPosts;
use App\Form\CategoryType;
use App\Service\ServiceWork;

/**
 * @Route("/admin", name="app_admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/creer-categorie", name="create")
     */
    public function createCategory(Request $request, ServiceWork $serviceWork): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceWork->save($category);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/createCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
