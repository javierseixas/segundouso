<?php

namespace SegundoUso\LocationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SegundoUso\LocationBundle\Entity\Municipality;

class LoadMunicipalityData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $municipality = new Municipality();
        $municipality->setName('Barcelona');
        $manager->persist($municipality);

        $this->addReference('municipality_barcelona', $municipality);

        $municipality = new Municipality();
        $municipality->setName('L\'Hospitalet');
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Sabadell');
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Terrassa');
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Badalona');
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Madrid');
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Valencia');
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Bilbao');
        $manager->persist($municipality);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
