<?php

namespace SegundoUso\AdBundle\Model;

use SegundoUso\LocationBundle\Model\MunicipalityInterface;

interface AdManagerInterface
{
    public function createAd();

    public function updateAd(AdInterface $ad, $andFlush);

    public function publishAd(AdInterface $ad);

    public function find($id);

    public function findByPid($pid);

    public function findAllPublished();

    public function findByCategoryAndPublished(CategoryInterface $category);

    public function findByCategoryMunicipalityAndPublished(CategoryInterface $category, MunicipalityInterface $municipality);

    public function remove(AdInterface $ad, $endFlush);
}