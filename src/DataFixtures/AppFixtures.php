<?php

namespace App\DataFixtures;

use App\Entity\User;
use League\Csv\Reader;
use App\Entity\Pokemon;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AppFixtures extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function load(ObjectManager $manager): void
    {
        // Load the CSV 
        $projectDir = $this->params->get('kernel.project_dir');
        $csv = Reader::createFromPath($projectDir . '/data/pokemon.csv', 'r');        $csv->setHeaderOffset(0);
        $csv->setHeaderOffset(0);

        foreach ($csv as $line) {
            $pokemon = new Pokemon();
            $pokemon->setName($line['Name']);
            $pokemon->setType1($line['Type 1']);
            $pokemon->setType2($line['Type 2']);
            $pokemon->setTotal($line['Total']);
            $pokemon->setHp($line['HP']);
            $pokemon->setAttack($line['Attack']);
            $pokemon->setDefense($line['Defense']);
            $pokemon->setSpAtk($line['Sp. Atk']);
            $pokemon->setSpDef($line['Sp. Def']);
            $pokemon->setSpeed($line['Speed']);
            $pokemon->setGeneration($line['Generation']);
            $pokemon->setLegendary($line['Legendary'] === 'True');
            $pokemon->setCreatedAt(new \DateTime());
            $pokemon->setUpdatedAt(new \DateTime());
            
            $manager->persist($pokemon);
        }

        // Load User
        $user = new User();
        $user->setEmail('user@exemple.com');
        $user->setPassword('$2y$13$8lB0oG7Echs8X9Fv1yoYWOk8F6.hd7UeCl1h1CaeiWUUrSvEn29ei');
        $user->setRoles(["ROLE_USER"]);

        $manager->persist($user);
        
        $manager->flush();
    }
}
