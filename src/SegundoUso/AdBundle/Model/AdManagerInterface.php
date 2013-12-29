<?php

namespace SegundoUso\AdBundle\Model;

use FOS\UserBundle\Model\UserInterface;
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

    public function findFraudulent();

    public function findAdsForUser(UserInterface $user);

    public function findBySearchedTerm($searchedTerm, MunicipalityInterface $municipality);

    public function remove(AdInterface $ad, $endFlush);
}