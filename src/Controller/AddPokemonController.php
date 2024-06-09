<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AddPokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'add_pokemon', methods: ['POST'])]
    public function addPokemon(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $pokemon = new Pokemon();
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
        $pokemon->setCreatedAt(new \DateTime());
        $pokemon->setUpdatedAt(new \DateTime());

        $em->persist($pokemon);
        $em->flush();

        return $this->json($pokemon, JsonResponse::HTTP_CREATED);
    }
}
