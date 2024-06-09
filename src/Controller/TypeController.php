<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    #[Route('/types', name: 'get_types', methods: ['GET'])]
    public function getTypes(EntityManagerInterface $em): JsonResponse
    {
        $types = $em->getRepository(Pokemon::class)->findAllTypes();

        // Vérifier si des types sont trouvés
        if (empty($types)) {
            return $this->json(['message' => 'Aucun type trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json($types, JsonResponse::HTTP_OK);
    }
}