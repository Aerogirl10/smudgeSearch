<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brands = ['Parker', 'Waterman', 'Sheaffer', 'Bexley', 'MontBlanc', 'Pelikan', 'Lamy'];

        for ($index = 0; $index < count($brands); $index++) {
            $brand = new Brand();
            $brandName = $brands[$index];
            $brand->setName($brandName);

            //$brand->setSlug(str_replace(" ", "-", mb_strtolower($brandName)));
            $manager->persist($brand);
        }
        $manager->flush();
    }


}
