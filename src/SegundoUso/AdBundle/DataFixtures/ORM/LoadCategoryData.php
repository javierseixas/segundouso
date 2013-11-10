<?php

namespace SegundoUso\AdBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SegundoUso\AdBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Muebles');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Electrodomésticos');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Menaje del hogar');
        $manager->persist($category);

        $manager->flush();
    }
}
