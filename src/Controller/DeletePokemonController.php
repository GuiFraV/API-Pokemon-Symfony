<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeletePokemonController extends AbstractController
{
    #[Route('/pokemon/{id}', name: 'delete_pokemon', methods: ['DELETE'])]
    public function deletePokemon(int $id, EntityManagerInterface $em): JsonResponse
    {
        $pokemon = $em->getRepository(Pokemon::class)->find($id);
        
        // Vérifier si le Pokémon existe
        if (!$pokemon) {
            return $this->json(['message' => 'Pokémon introuvable'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Supprimer le Pokémon
        $em->remove($pokemon);
        $em->flush();

        return $this->json(['message' => 'Pokémon supprimé'], JsonResponse::HTTP_OK);
    }
}

