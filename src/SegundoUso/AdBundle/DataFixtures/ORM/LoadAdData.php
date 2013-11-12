<?php

namespace SegundoUso\AdBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SegundoUso\AdBundle\Entity\Ad;

class LoadAdData extends AbstractFixture implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $ad = new Ad();
        $ad
            ->setTitle('Anuncio 1')
            ->setDescription('Descripción 1')
            ->setLocation('Barcelona')
            ->setPublished(true)
            ->setPid('1234')
            ->setCategory($this->getReference('category_muebles'));
        $manager->persist($ad);

        $ad = new Ad();
        $ad
            ->setTitle('Anuncio 2')
            ->setDescription('Descripción 2')
            ->setLocation('Mataró')
            ->setPublished(true)
            ->setPid('4321')
            ->setCategory($this->getReference('category_muebles'));
        $manager->persist($ad);

        $ad = new Ad();
        $ad
            ->setTitle('Anuncio 3')
            ->setDescription('Descripción 3')
            ->setLocation('Sabadell')
            ->setPublished(true)
            ->setPid('5678')
            ->setCategory($this->getReference('category_muebles'));
        $manager->persist($ad);

        $manager->flush();
    }
}
