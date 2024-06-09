<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeletePokemonController extends AbstractController
{
    #[Route('/pokemon/{id}', name: 'delete_pokemon', methods: ['DELETE'])]
    public function deletePokemon(int $id, EntityManagerInterface $em): JsonResponse
    {
        $pokemon = $em->getRepository(Pokemon::class)->find($id);
        if (!$pokemon) {
            return $this->json(['message' => 'Pokemon not found'], JsonResponse::HTTP_NOT_FOUND);
        }
        $em->remove($pokemon);
        $em->flush();

        return $this->json(['message' => 'Pokemon deleted'], JsonResponse::HTTP_OK);
    }
}
