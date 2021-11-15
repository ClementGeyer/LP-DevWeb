<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class ServiceUser extends ServiceBase
{    

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);        
    } 
    
    public function getAll()
    {
        return $this->em->getRepository(User::class)->findBy([], ['username' =>  'ASC']);
    }

    public function getUserById($userId): ?User
    {
        $user = $this->em->getRepository(User::class)->find($userId);
        return $user;
    }
}