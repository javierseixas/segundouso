<?php

namespace SegundoUso\AdBundle\Model;

interface AdInterface
{
    public function setPublished($published);

    public function getUser();

    public function getAdvertiser();
}