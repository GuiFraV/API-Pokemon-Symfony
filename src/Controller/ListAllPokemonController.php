<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;

class ListAllPokemonController extends AbstractController
{
    #[Route('/pokemons', name: 'list_pokemons', methods: ['GET'])]
    public function listPokemons(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $limit = 60;
        $offset = ($page - 1) * $limit;

        $queryBuilder = $em->getRepository(Pokemon::class)->createQueryBuilder('p');

        // Appliquer les filtres
        if ($request->query->has('type')) {
            $queryBuilder->andWhere('p.type1 = :type OR p.type2 = :type')
                         ->setParameter('type', $request->query->get('type'));
        }

        if ($request->query->has('search')) {
            $queryBuilder->andWhere('p.name LIKE :search')
                         ->setParameter('search', '%' . $request->query->get('search') . '%');
        }

        // Appliquer le tri
        if ($request->query->has('sort')) {
            $sort = $request->query->get('sort');
            $direction = $request->query->get('direction', 'asc');
            $queryBuilder->orderBy('p.' . $sort, $direction);
        }

        $queryBuilder->setFirstResult($offset)
                     ->setMaxResults($limit);

        $pokemons = $queryBuilder->getQuery()->getResult();

        // Vérifier si des Pokémon sont trouvés
        if (empty($pokemons)) {
            return $this->json(['message' => 'Aucun Pokémon trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Créer un contexte de sérialisation et ajouter les groupes
        $context = SerializationContext::create()->setGroups(['list']);

        $data = $serializer->serialize($pokemons, 'json', $context);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }
}
