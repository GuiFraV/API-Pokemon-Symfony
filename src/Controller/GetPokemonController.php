<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use JMS\Serializer\SerializerInterface;

class GetPokemonController extends AbstractController
{
    #[Route('/pokemon/{id}', name: 'get_pokemon', methods: ['GET'])]
    public function getPokemon(int $id, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $pokemon = $em->getRepository(Pokemon::class)->find($id);
        if (!$pokemon) {
            return $this->json(['message' => 'Pokemon not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = $serializer->serialize($pokemon, 'json');

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }
}
