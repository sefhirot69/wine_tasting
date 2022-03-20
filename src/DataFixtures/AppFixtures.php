<?php

namespace App\DataFixtures;

use App\Factory\MeasurementDoctrineFactory;
use App\Factory\UserDoctrineFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserDoctrineFactory::createMany(2);
        MeasurementDoctrineFactory::createMany(10);

        $manager->flush();
    }
}
