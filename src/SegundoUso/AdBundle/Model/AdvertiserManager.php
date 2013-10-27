<?php

namespace SegundoUso\AdBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class AdvertiserManager implements AdvertiserManagerInterface
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
     * @return
     */
    public function createAdvertiser()
    {
        $class = $this->class;
        $advertiser = new $class;

        return $advertiser;
    }

    public function updateAdvertiser(AdvertiserInterface $advertiser, $andFlush = true)
    {
        $this->objectManager->persist($advertiser);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @param $email
     * @return \SegundoUso\AdBundle\Entity\Advertiser|null
     */
    public function findByEmail($email)
    {
        return $this->repository->findOneBy(array('email' => $email));
    }
}