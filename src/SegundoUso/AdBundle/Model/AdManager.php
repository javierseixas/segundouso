<?php

namespace SegundoUso\AdBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;
use SegundoUso\AdBundle\Util\PublicIdGeneratorInterface;

class AdManager implements AdManagerInterface
{
    /**
     * @var \SegundoUso\AdBundle\Util\PublicIdGeneratorInterface
     */
    protected $pidGenerator;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $objectManager;
    protected $class;
    protected $repository;

    public function __construct(PublicIdGeneratorInterface $pidGenerator, ObjectManager $om, $class)
    {
        $this->pidGenerator = $pidGenerator;

        $this->objectManager = $om;
        $this->repository = $this->objectManager->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * @return AdInterface
     */
    public function createAd()
    {
        $class = $this->class;
        $ad = new $class;

        return $ad;
    }

    public function updateAd(AdInterface $ad, $andFlush = true)
    {
        if (null === $ad->getPid()) $this->setPublicId($ad);

        $this->objectManager->persist($ad);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    public function publishAd(AdInterface $ad)
    {
        $ad->setPublished(true);
        $this->updateAd($ad);
    }

    public function findByPid($pid)
    {
        return $this->repository->findOneBy(array('pid' => $pid));
    }

    protected function setPublicId(AdInterface $ad)
    {
        $ad->setPid($this->pidGenerator->generate());
    }

    public function findAllPublished()
    {
        return $this->repository->findBy(array('published' => true));
    }

    public function findByCategoryAndPublished(CategoryInterface $category)
    {
        return $this->repository->findBy(array(
            'published' => true,
            'category' => $category
        ));
    }
}