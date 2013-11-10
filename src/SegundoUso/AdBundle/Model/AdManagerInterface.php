<?php

namespace SegundoUso\AdBundle\Model;

interface AdManagerInterface
{
    public function createAd();

    public function updateAd(AdInterface $ad, $andFlush);

    public function publishAd(AdInterface $ad);

    public function findByPid($pid);

    public function findAllPublished();
}