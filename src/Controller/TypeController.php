<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TypeController extends AbstractController
{
    #[Route('/types', name: 'get_types', methods: ['GET'])]
    public function getTypes(EntityManagerInterface $em): JsonResponse
    {
        $types = $em->getRepository(Pokemon::class)->findAllTypes();
        return $this->json($types);
    }
}
