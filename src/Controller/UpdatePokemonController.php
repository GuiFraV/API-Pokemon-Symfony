<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdatePokemonController extends AbstractController
{
#[Route('/pokemon/{id}', name: 'update_pokemon', methods: ['PUT'])]
public function updatePokemon(int $id, Request $request, EntityManagerInterface $em): JsonResponse
{
    $pokemon = $em->getRepository(Pokemon::class)->find($id);
    if (!$pokemon) {
        return $this->json(['message' => 'Pokemon not found'], JsonResponse::HTTP_NOT_FOUND);
    }
    $data = json_decode($request->getContent(), true);

    $pokemon->setName($data['name']);
    $pokemon->setType1($data['type1']);
    $pokemon->setType2($data['type2'] ?? null);
    $pokemon->setTotal($data['total']);
    $pokemon->setHp($data['hp']);
    $pokemon->setAttack($data['attack']);
    $pokemon->setDefense($data['defense']);
    $pokemon->setSpAtk($data['sp_atk']);
    $pokemon->setSpDef($data['sp_def']);
    $pokemon->setSpeed($data['speed']);
    $pokemon->setGeneration($data['generation']);
    $pokemon->setLegendary($data['legendary']);
    $pokemon->setUpdatedAt(new \DateTime());

    $em->flush();

    return $this->json($pokemon);
}
}
