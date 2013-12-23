<?php

namespace SegundoUso\LocationBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;
use SegundoUso\AdBundle\Util\RandomStringGeneratorInterface;
use SegundoUso\LocationBundle\Model\MunicipalityInterface;

class MunicipalityManager implements MunicipalityManagerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $objectManager;
    protected $class;
    protected $repository;

    public function __construct(ObjectManager $om, $class)
    {

        $this->objectManager = $om;
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * @return MunicipalityInterface
     */
    public function create()
    {
        $class = $this->class;
        $ad = new $class;

        return $ad;
    }

    public function update(MunicipalityInterface $ad, $andFlush = true)
    {
        $this->objectManager->persist($ad);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @return MunicipalityInterface
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return MunicipalityInterface
     */
    public function findBySlug($slug)
    {
        return $this->repository->findOneBy(array('slug' => $slug));
    }
}