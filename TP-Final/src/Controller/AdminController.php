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
use App\Service\ServiceUser;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * @Route("/gestion-roles", name="manage")
     */
    public function manageRoles(ServiceUser $serviceUser): Response
    {

        return $this->render('admin/manageRoles.html.twig',[
            'users' => $serviceUser->getAll()
        ]);
    }

    /**
    * @Route("/admin/user/{id}/role", name="change_role",
    *   methods={"POST"}
    * )
    */
    public function changeRole(Request $request, ServiceUser $serviceUser, $id){
        $user = $serviceUser->getUserById($id);        
        
        if($user === null){
            return new JsonResponse("Utilisateur inexistant", 404);
        }
        
        $role = json_decode($request->getContent())->role;

        $user->toggleRole($role);
        
        $serviceUser->save($user);
        
        return new JsonResponse("Utilisateur mit à jour");
    }
}
