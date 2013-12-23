<?php

namespace SegundoUso\LocationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gedmo\Sluggable\Util\Urlizer;
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
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $this->addReference('municipality_barcelona', $municipality);

        $municipality = new Municipality();
        $municipality->setName('L\'Hospitalet');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Sabadell');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Terrassa');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Badalona');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Madrid');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Valencia');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $municipality = new Municipality();
        $municipality->setName('Bilbao');
        $municipality->setSlug(Urlizer::urlize($municipality->getName()));
        $manager->persist($municipality);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
