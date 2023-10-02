<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie; // Import this line while creating new Fixture11111

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setReleaseYear(2008);
        $movie->setDescription('This is a description for the Dark Knight movie');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2023/01/31/14/28/superhero-7758253_1280.jpg');
        // add actor to the movie (Relation ship)
        $movie->addActor($this->getReference('actor_1'));
        $movie->addActor($this->getReference('actor_2'));
        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2->setTitle('Avengers: Endgame');
        $movie2->setReleaseYear(2019);
        $movie2->setDescription('This is a description for the Avengers: Endgame movie');
        $movie2->setImagePath('https://filmyfool.com/wp-content/uploads/2019/04/avengersendgame-blogroll-2-1555518573008_1280w.jpg');
        // add actor to the movie (Relation ship)
        $movie2->addActor($this->getReference('actor_3'));
        $movie2->addActor($this->getReference('actor_4'));
        $manager->persist($movie2);
        
        $manager->flush();
    }
}
