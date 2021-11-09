<?php
namespace App\Service;

use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class ServiceWork extends ServiceBase
{    
    
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public function saveWork($work): void
    {
        $this->em->persist($work);
        $this->em->flush();
    }
}