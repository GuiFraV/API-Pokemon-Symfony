<?php

namespace App\DataFixtures;

use League\Csv\Reader;
use App\Entity\Pokemon;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Load the CSV 
        $csv = Reader::createFromPath('%kernel.project_dir%/data/pokemon.csv', 'r');
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
        
        $manager->flush();
    }
}
