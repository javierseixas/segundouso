<?php

namespace SegundoUso\AdBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class CategoryManager implements CategoryManagerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected  $objectManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected  $repository;

    protected $class;

    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * @return CategoryInterface
     */
    public function createCategory()
    {
        $class = $this->class;
        $category = new $class;

        return $category;
    }

    public function updateCategory(CategoryInterface $category, $andFlush = true)
    {
        $this->objectManager->persist($category);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

}