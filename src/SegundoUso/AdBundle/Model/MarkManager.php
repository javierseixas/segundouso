<?php

namespace SegundoUso\AdBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class MarkManager implements MarkManagerInterface
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
     * @return MarkInterface
     */
    public function create()
    {
        $class = $this->class;
        $category = new $class;

        return $category;
    }

    public function update(MarkInterface $mark, $andFlush = true)
    {
        $this->objectManager->persist($mark);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

}