<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddPokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'add_pokemon', methods: ['POST'])]
    public function addPokemon(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Vérifier les champs manquants
        $requiredFields = ['name', 'type1', 'total', 'hp', 'attack', 'defense', 'sp_atk', 'sp_def', 'speed', 'generation', 'legendary'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field]) && !isset($data[$field])) {
                return new JsonResponse(['message' => "Le champ '$field' est manquant."], JsonResponse::HTTP_BAD_REQUEST);
            }
        }

        // Vérifier si le Pokémon existe déjà
        $existingPokemon = $em->getRepository(Pokemon::class)->findOneBy(['name' => $data['name']]);
        if ($existingPokemon) {
            return new JsonResponse(['message' => 'Le Pokémon existe déjà.'], JsonResponse::HTTP_CONFLICT);
        }

        // Créer et persister le nouveau Pokémon
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