<?php

namespace SegundoUso\AdBundle\Model;


interface AdvertiserManagerInterface
{
    /**
     * @return AdvertiserInterface
     */
    public function createAdvertiser();

    public function updateAdvertiser(AdvertiserInterface $advertiser, $andFlush);

    public function findByEmail($email);
}